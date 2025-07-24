<?php
session_start();
include("connection.php");
error_reporting(1);

//set ulr no in session
$sel_ulrs="select * from ulr_no where `ulr_status`=0";
$result_ulrs = mysqli_query($conn, $sel_ulrs);
if(mysqli_num_rows($result_ulrs)>0)
{
	$get_ulrs=mysqli_fetch_array($result_ulrs);
	$_SESSION["ulr_nos"]= $get_ulrs["ulr_no"];
}else{
	$_SESSION["ulr_nos"]= "TC6202200000";	
}


if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'get_material_by_category'){
		
		$txt_job_no= $_POST["txt_job_no"];
		$txt_report_no= $_POST["txt_report_no"];
		//$txt_qty= $_POST["txt_qty"];
		$txt_qty= 1;
		$report_explode= explode("/",$txt_report_no);
		$nabl_types= $_POST["nabl_types"];
		
		//if($nabl_types=="nabl"){ $whering=" AND `in_nabl`='yes'"; }else{ $whering=""; }
     
		$cate_id= $_POST["select_material_category"];
		//$get_query = "select id,mt_name from material WHERE mat_category_id=$cate_id AND `mt_isdeleted`='0'".$whering." ORDER BY mt_name ASC"; 
		$get_query = "select id,mt_name from material WHERE mat_category_id=$cate_id AND `mt_isdeleted`='0' ORDER BY mt_name ASC"; 
		$select_result = mysqli_query($conn, $get_query);
		
		
		// toset lab id by material category_ids
		$get_query_category = "select * from material_category WHERE material_cat_id=$cate_id AND `material_cat_isdelete`='0'"; 
		$select_cat_result = mysqli_query($conn, $get_query_category);
		$get_cate=mysqli_fetch_array($select_cat_result);
		$cate_prefix = $get_cate["cat_prefix"];
		
		// get engineer name by material category
		$material_engineer = $get_cate["material_engineer"];
		$sel_staff="select * from multi_login where `id`=$material_engineer";
		$query_staff=mysqli_query($conn,$sel_staff);
		$get_staff=mysqli_fetch_array($query_staff);
		$out_materials_engineer ='<option value="'.$get_staff['id'].'" >'.$get_staff['staff_fullname'].'</option>';
		
		$sel="select * from final_material_assign_master where is_deleted=0 AND `material_category`='$cate_id' AND `report_no`='$txt_report_no' AND `job_no`='$txt_job_no' order by `final_material_id` DESC";
		
		$resulting = mysqli_query($conn, $sel);
		
		if (mysqli_num_rows($resulting) > 0) {
					$job_r = mysqli_num_rows($resulting);
					$txt_job_no;
					$explode_no= explode("/",$txt_job_no);
					
					$first_explode= $explode_no[0];
					$second_explode= $explode_no[1];
					
					$plus_report_no= $job_r + 1;
					
					$final_lab_id= $first_explode."/".$cate_prefix."-".$plus_report_no;
					
					
				}else{
					
					$explode_no= explode("/",$txt_job_no);
					$final_lab_id= $explode_no[0]."/".$cate_prefix."-1";
					
				}
		
		
		$out_materials='<option value="" >Select Material</option>';
		
		
		if (mysqli_num_rows($select_result) > 0) {
			while($row = mysqli_fetch_assoc($select_result)) {
				
			$out_materials .='<option value="'.$row['id'].'" >'.$row['mt_name'].'</option>';
			}}
			
			
			$get_query_test = "select * from test_master WHERE `mat_category_id`='$cate_id' AND `test_isdeleted`='0'"; 
				$select_result_test = mysqli_query($conn, $get_query_test);
		
				$out_tests='';
		
				if (mysqli_num_rows($select_result_test) > 0) {
					
				while($rows = mysqli_fetch_assoc($select_result_test)) {
				
				$out_tests .='<option value="'.$rows['test_id'].'" selected="selected">'.$rows['test_name'].'</option>';
				}	}
		
				//$put_chk_box='<input type="checkbox" class="all_chk" style="width: 20px;height: 20px;">';
				$put_chk_box='';
			
		//generate type of sample
			//for cement
			$set_type_sample='<div class="row material_class" id="CM">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Cement</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Type Of Cement</label>
											<select class="form-control type_of_cement" id="c_type_'.$i.'"  name="type_of_cement">
												<option value="">Select-Type</option>
												<option value="OPC">OPC</option>
												<option value="PPC">PPC</option>
												<option value="PSC">PSC</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Grade</label>
											<select class="form-control cement_grade" id="c_grade_'.$i.'"  name="cement_grade">
												<option value="">Select Grade</option>
												<option value="53 OPC">53 OPC</option>
												<option value="43 OPC">43 OPC</option>
												<option value="33_grade">33_grade</option>
												<option value="flyash_type">flyash_type</option>
												<option value="calcimed_clay_type">calcimed_clay_type</option>
												<option value="OPC - 43 S">OPC - 43 S</option>
												<option value="OPC - 53 S">OPC - 53 S</option>
												<option value="PORTLAND SLAG">PORTLAND SLAG</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Brand</label>
										  <input type="text" class="form-control cement_brand" id="cement_brand" name="cement_brand"   placeholder="Brand">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Week No.</label>
										  <input type="text" class="form-control week_no" id="week_no" name="week_no"  placeholder="Week No.">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Aggregate
			$set_type_sample .='<div class="row material_class" id="CA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Aggregate</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Source</label>
										  <input type="text" class="form-control brick_source" id="brick_source" name="brick_source"  placeholder="Source">
										</div>
									</div>
								</div>
								<div class="col-md-6">
										<div class="box-body">
											<div class="form-group">
											  <label for="exampleInputEmail1">Sample Description</label>
											  <input type="text" class="form-control sample_de" id="sample_de" name="sample_de"  placeholder="Sample Description">
											</div>
										</div>
								 </div>';
				}
			$set_type_sample .='</div>';
			
			//for Brick
			$set_type_sample .='<div class="row material_class" id="BR">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Brick</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Mark</label>
										  <input type="text" class="form-control mark" id="mark"   name="mark" style="" placeholder="Mark">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
											<label>Class</label>
											<select class="form-control brick_specification" id="brick_specification" name="brick_specification">
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
								<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
											<label>Size</label>
											<select class="form-control brick_size" id="brick_size" name="brick_size">
												<option value="190 X 90 X 90">190 X 90 X 90</option>
												<option value="190 X 90 X 40">190 X 90 X 40</option>
												<option value="230 X 110 X 70">230 X 110 X 70</option>
												<option value="230 X 110 X 30">230 X 110 X 30</option>
												<option value="NS 225 X 100 X 75">NS 225 X 100 X 75</option>
												<option value="Other">Other</option>
											</select>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Bitumin
			$set_type_sample .='<div class="row material_class" id="BT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumen</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Tanker No.</label>
										  <input type="text" class="form-control tanker_no" id="tanker_no" name="tanker_no" placeholder="Tanker No">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Lot No.</label>
										  <input type="text" class="form-control lot_no" id="lot_no" name="lot_no" placeholder="Lot No.">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Grade</label>
											<select class="form-control bitumin_grade" id="bitumin_grade" name="bitumin_grade">
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
										  <input type="text" class="form-control make" id="make" name="make" placeholder="Make">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Bitumin emulsion
			$set_type_sample .='<div class="row material_class" id="BE">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumen Emulsion</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Source</label>
										  <input type="text" class="form-control tanker_no1" id="tanker_no1" name="tanker_no1" placeholder="sample Source">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Sample Description.</label>
										  <input type="text" class="form-control lot_no1" id="lot_no1" name="lot_no1" placeholder="sample Description">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Grade</label>
											<select class="form-control bitumin_grade1" id="bitumin_grade1" name="bitumin_grade1">
												<option value="RS-1">RS-1</option>
												<option value="RS-2">RS-2</option>
												<option value="MS">MS</option>
												<option value="SS-1">SS-1</option>
												<option value="SS-2">SS-2</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										 
										  <input type="hidden" class="form-control make" id="make1" name="make1" placeholder="Make">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for C C Cube
			$set_type_sample .='<div class="row material_class" id="CC">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>C C Cube</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-4">
									<div class="box-body col-sm-6">
											<div class="form-group">
												<label>Grade</label>
												<select class="form-control cube_grade" id="cube_grade" name="cube_grade">
													<option value="">Grade</option>
													<option value="M-5">M - 5</option>
													<option value="M-7.5">M - 7.5</option>
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
									<input type="text" class="form-control casting_date" id="casting_date" name="casting_date" placeholder="Casting Date" value="">
										</div>
									</div>
								</div>
								<div class="col-md-4">
										<div class="box-body col-sm-4">
											<div class="form-group">
												<label>Day</label>
											<select class="form-control day" id="day" name="day">
												<option value="7">7 Days</option>
												<option value="28">28 Days</option>
												<!--<option value="7_28">7 & 28 Days</option>-->
												<option value="other">Other</option>
											</select>
											</div>
										</div>
										<div class="box-body col-sm-6 only_remark">
											<div class="form-group">
											  <label for="exampleInputEmail1">Source of Sample</label>
											  <input type="text" class="form-control day_remark" id="day_remark" name="day_remark" placeholder="Remarks">
											</div>
										</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Identification Mark</label>
										  <input type="text" class="form-control cc_identification" id="cc_identification" name="cc_identification" placeholder="Identification Mark" Value="">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control cc_qty" id="cc_qty" name="cc_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>
								<input type="hidden" class="form-control set_of_cube" id="set_of_cube" name="set_of_cube"  Value="1">
								<input type="hidden" class="form-control no_of_cube" id="no_of_cube" name="no_of_cube" value="3" disabled>';
				}
			$set_type_sample .='</div>';
			
			//for Paver Block
			$set_type_sample .='<div class="row material_class" id="PB">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Paver Block</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-5">
									<div class="box-body col-sm-6">
										<div class="form-group">
										  <label for="exampleInputEmail1">Shape</label>
										  <select class="form-control shape" id="shape" name="shape">
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
										  <input type="text" class="form-control age" id="age" name="age" placeholder="Age">
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="box-body col-sm-6">
										<div class="form-group">
										  <label for="exampleInputEmail1">Color</label>
										  <input type="text" class="form-control color" id="color" name="color" placeholder="Color">
										</div>
									</div>
								
									<div class="box-body col-sm-6">
										<div class="form-group">
										  <label for="exampleInputEmail1">Thickness(mm)</label>
										  <select class="form-control thickness" id="thickness" name="thickness">
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
										  <select class="form-control paver_grade" id="paver_grade" name="paver_grade">
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
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Soil
			$set_type_sample .='<div class="row material_class" id="SO">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Soil</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Sample Type</label>
										  <input type="text" class="form-control sample_type" id="sample_type" name="sample_type" placeholder="Sample Type">
										</div>
									</div>
								</div>
								<div class="col-md-6">
										<div class="box-body">
											<div class="form-group">
											  <label for="exampleInputEmail1">Source</label>
											  <input type="text" class="form-control soil_source" id="soil_source" name="soil_source" placeholder="Soil Source">
											</div>
										</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Steel
			$set_type_sample .='<div class="row material_class" id="ST">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Steel</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">
												<div class="col-md-2">
												<label>Enrter Quantity:</label>
												<input type="text" class="form-control" id="steel_set_qty" name="steel_set_qty" placeholder="Enter Quantity" value="1" style="width:100px;">
												</div>
												<div class="col-md-2">
												<label>Select Grade:</label>
												<select class="form-control" name="steel_grade" id="steeling_id">
											<option value="">SELECT-GRADE</option>
											<option value="-">-</option>
											<option value="FE 415">Fe 415</option>
											<option value="FE 415 D">Fe 415D</option>
											<option value="FE 415 S">Fe 415S</option>
											<option value="FE 500">Fe 500</option>
											<option value="FE 500 D">Fe 500D</option>
											<option value="FE 500 S">Fe 500S</option>
											<option value="FE 550">Fe 550</option>
											<option value="FE 550 D">Fe 550D</option>
											<option value="FE 600">Fe 600</option>
											<option value="FE 650">Fe 650</option>
											<option value="FE 750">Fe 750</option>
											<option value="FE 415 CRS">Fe 415 CRS</option>
											<option value="FE 415 D CRS">Fe 415D CRS</option>
											<option value="FE 415 S CRS">Fe 415S CRS</option>
											<option value="FE 500 CRS">Fe 500 CRS</option>
											<option value="FE 500 D CRS">Fe 500D CRS</option>
											<option value="FE 500 S CRS">Fe 500S CRS</option>
											<option value="FE 550 CRS">Fe 550 CRS</option>
											<option value="FE 550 D CRS">Fe 550D CRS</option>
											<option value="FE 600 CRS">Fe 600 CRS</option>
											<option value="FE 650 CRS">Fe 650 CRS</option>
											<option value="FE 750 CRS">Fe 750 CRS</option>
											
										</select>
												</div>
												<div class="col-md-8">
												<label>Enrter Name Of Source:</label>
												<input type="text" class="form-control" id="steel_source" name="steel_source" placeholder="Enter Name Of Source"  style="width:300px;">
												</div>';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="box-body col-md-2" >
									<div class="form-group">
										<label>Dia (mm)</label>
										<select class="form-control dia" id="dia" name="dia">
											<option value="">SELECT-DIA</option>
											<option value="4">4 mm</option>
											<option value="5">5 mm</option>
											<option value="6">6 mm</option>
											<option value="8">8 mm</option>
											<option value="10">10 mm</option>
											<option value="12">12 mm</option>
											<option value="16">16 mm</option>
											<option value="20">20 mm</option>
											<option value="25">25 mm</option>
											<option value="28">28 mm</option>
											<option value="32">32 mm</option>
											<option value="36">36 mm</option>
											<option value="40">40 mm</option>
											<option value="45">45 mm</option>
											<option value="50">50 mm</option>
											
										</select>
									</div>
								</div>
								<div class="box-body col-md-2" >
									<div class="form-group">
										<label></label>
										<select class="form-control steel_grade" name="steel_grade" style="display:none;">
										<option vlaue="">select-grade</option>
										</select>
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Brand</label>
									  <input type="text" class="form-control steel_brand" id="steel_brand" name="steel_brand" placeholder="Brand">
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Mill Heat No.</label>
									  <input type="text" class="form-control steel_heat" id="steel_heat" name="steel_heat" placeholder="Steel Heat">
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Lot Quantity</label>
									  <input type="text" class="form-control steel_sample_qty" id="steel_sample_qty" name="steel_sample_qty" placeholder="Sample Quantity">
									</div>
								</div><br>';
				}
			$set_type_sample .='</div>';
			
			//for Water
			$set_type_sample .='<div class="row material_class" id="WA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Water</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="box-body col-md-12">
									<div class="form-group">
									  <label for="exampleInputEmail1">Source</label>
									  <input type="text" class="form-control tile_source" id="tile_source" name="tile_source" placeholder="Source">
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Tiles
			$set_type_sample .='<div class="row material_class" id="TI">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Tiles</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
											<label>Specification</label>
											<input type="text" class="form-control tiles_specification" id="tiles_specification" name="tiles_specification" placeholder="Specification">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
											<label for="exampleInputEmail1">Brand</label>
											<input type="text" class="form-control brand" id="brand" name="brand" placeholder="Brand">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Fine Aggregate
			$set_type_sample .='<div class="row material_class" id="FA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Fine Aggregate</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Fine Aggregate Source</label>
										  <input type="text" class="form-control fine_agg_source" id="fine_agg_source" name="fine_agg_source" placeholder="Fine Aggregate Source">
										</div>
								     </div>
								</div>
								<div class="col-md-4">
										<div class="box-body">
										 <div class="form-group">
										   <label for="exampleInputEmail1">Fine Aggregate Type</label>
										   <input type="text" class="form-control fine_agg_type" id="fine_agg_type" name="fine_agg_type" placeholder="Fine Aggregate Type">
										 </div>
									</div>
								</div>
								<div class="col-md-4">
										<div class="box-body">
										 <div class="form-group">
										   <label for="exampleInputEmail1">Zone</label>
										   <select class="form-control grd_zone" id="grd_zone" name="grd_zone">											
											<option value="Zone II">Zone II</option>
											<option value="Zone I">Zone I</option>
											<option value="Zone III">Zone III</option>
											<option value="Zone IV">Zone IV</option>
											
										</select>
										 </div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Quarry Spall
			$set_type_sample .='<div class="row material_class" id="QU">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Quarry Spall</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-12">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quarry Spall Source</label>
										  <input type="text" class="form-control qa_spall_source" id="qa_spall_source" name="qa_spall_source" placeholder="Quarry Spall Source">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Field Test
			$set_type_sample .='<div class="row material_class" id="FT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Field Test</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Chainage No.</label>
										  <input type="text" class="form-control chainage_no" id="chainage_no" name="chainage_no" placeholder="Enter Chainage No.">
										</div>
									</div>
							    </div>
								<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Sample Description.</label>
										  <input type="text" class="form-control fdd_desc_sample" id="fdd_desc_sample" name="fdd_desc_sample" placeholder="Enter Sample Description." Value="GSB">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control class_qty" id="cc_qty" name="cc_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Bitumin Mix
			$set_type_sample .='<div class="row material_class" id="BM">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin Mix</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-12">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Bitumin Specification</label>
										   <select class="form-control bitumin_mix" id="bitumin_mix" name="bitumin_mix">
												<option value="BC-I">BC-I</option>
												<option value="BC-II">BC-II</option>
												<option value="DBM-I">DBM-I</option>
												<option value="DBM-II">DBM-II</option>
												<option value="SDBC-I">SDBC-I</option>
												<option value="SDBC-II">SDBC-II</option>
											</select>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for concrete Core
			$set_type_sample .='<div class="row material_class" id="ON">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Concrete Core</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control core_qty" id="core_qty" name="core_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for bitumin Core
			$set_type_sample .='<div class="row material_class" id="ME">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin Core</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control bitu_qty" id="bitu_qty" name="bitu_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for AAC BLOCK
			$set_type_sample .='<div class="row material_class" id="AC">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>AAC BLOCK</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Length</label>
										  <input type="text" class="form-control in_l" id="in_l" name="in_l" placeholder="Enter Length">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Width</label>
										  <input type="text" class="form-control in_w" id="in_w" name="in_w" placeholder="Enter Width">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Height</label>
										  <input type="text" class="form-control in_h" id="in_h" name="in_h" placeholder="Enter Height">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Density</label>
										   <select class="form-control in_den" id="in_den" name="in_den">
												<option value="451 to 550">451 to 550</option>
												<option value="551 to 650">551 to 650</option>
												<option value="651 to 750">651 to 750</option>
												<option value="751 to 850">751 to 850</option>
												<option value="851 to 1000">851 to 1000</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Grade</label>
										   <select class="form-control in_grade" id="in_grade" name="in_grade">
												<option value="grade 1">grade 1</option>
												<option value="grade 2">grade 2</option>
												
											</select>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for CLC BLOCK
			$set_type_sample .='<div class="row material_class" id="LC">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>CLC BLOCK</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Length</label>
										  <input type="text" class="form-control inl" id="inl" name="inl" placeholder="Enter Length">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Width</label>
										  <input type="text" class="form-control inw" id="inw" name="inw" placeholder="Enter Width">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Height</label>
										  <input type="text" class="form-control inh" id="inh" name="inh" placeholder="Enter Height">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Grade</label>
										   <select class="form-control ingrade"  name="ingrade" id="ingrade_'.$i.'">
										       <option value="">--SELECT--</option>
												<option value="G-2.5">G-2.5</option>
												<option value="G-3.5">G-3.5</option>
												<option value="G-6.5">G-6.5</option>
												<option value="G-12">G-12</option>
												<option value="G-17.5">G-17.5</option>
												<option value="G-25">G-25</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Density</label>
										    <input type="text" class="form-control inden" id="inden_'.$i.'" name="inden" readonly>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for ultra pulse
			$set_type_sample .='<div class="row material_class" id="UP">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Ultra Sonic Pulse Velocity</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control ultra_qty" id="ultra_qty" name="ultra_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Rebound Hammer
			$set_type_sample .='<div class="row material_class" id="RH">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Rebound Hammer</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control rebound_qty" id="rebound_qty" name="rebound_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Carbonation
			$set_type_sample .='<div class="row material_class" id="CN">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Carbonation</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control carbo_qty" id="carbo_qty" name="carbo_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Coating Thickness
			$set_type_sample .='<div class="row material_class" id="CT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Coating Thickness</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control c_thick_qty" id="c_thick_qty" name="c_thick_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Half Cell Potential
			$set_type_sample .='<div class="row material_class" id="HP">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Half Cell Potential</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control half_cell_qty" id="half_cell_qty" name="half_cell_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Pile Integrity
			$set_type_sample .='<div class="row material_class" id="PI">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Pile Integrity</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control pile_qty" id="pile_qty" name="pile_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Pull Out Test
			$set_type_sample .='<div class="row material_class" id="OT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Pull Out Test</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control pull_qty" id="pull_qty" name="pull_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			$set_type_sample .='<div class="row material_class" id="testings">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Excel Upload</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
		for($i=1;$i<=$txt_qty;$i++)
		{
		$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Description</label>
										  <input type="text" class="form-control excel_description" id="excel_description" name="excel_description"   placeholder="Description">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Qty.</label>
										  <input type="text" class="form-control excel_qty" id="excel_qty" name="excel_qty"  placeholder="Qty">
										</div>
									</div>
								</div>';
		}
		$set_type_sample .='</div>';
	 
	 $fill = array('all_material' => $out_materials,'final_lab_id' => $final_lab_id,'out_tests' => $out_tests,'cate_prefix' => $cate_prefix,'put_chk_box' => $put_chk_box,'out_materials_engineer' => $out_materials_engineer,'set_type_sample' => $set_type_sample);	
        echo json_encode($fill);
    }
	else if($_POST['action_type'] == 'set_for_excel'){
		$txt_qty= $_POST["txt_qty"];
		
		$set_type_sample='<div class="row material_class" id="CM">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Cement</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Type Of Cement</label>
											<select class="form-control type_of_cement" id="c_type_'.$i.'"  name="type_of_cement">
												<option value="">Select-Type</option>
												<option value="OPC">OPC</option>
												<option value="PPC">PPC</option>
												<option value="PSC">PSC</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Grade</label>
											<select class="form-control cement_grade" id="c_grade_'.$i.'"  name="cement_grade">
												<option value="">Select Grade</option>
												<option value="53 OPC">53 OPC</option>
												<option value="43 OPC">43 OPC</option>
												<option value="33_grade">33_grade</option>
												<option value="flyash_type">flyash_type</option>
												<option value="calcimed_clay_type">calcimed_clay_type</option>
												<option value="OPC - 43 S">OPC - 43 S</option>
												<option value="OPC - 53 S">OPC - 53 S</option>
												<option value="PORTLAND SLAG">PORTLAND SLAG</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Brand</label>
										  <input type="text" class="form-control cement_brand" id="cement_brand" name="cement_brand"   placeholder="Brand">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Week No.</label>
										  <input type="text" class="form-control week_no" id="week_no" name="week_no"  placeholder="Week No.">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Aggregate
			$set_type_sample .='<div class="row material_class" id="CA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Aggregate</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Source</label>
										  <input type="text" class="form-control brick_source" id="brick_source" name="brick_source"  placeholder="Source">
										</div>
									</div>
								</div>
								<div class="col-md-6">
										<div class="box-body">
											<div class="form-group">
											  <label for="exampleInputEmail1">Sample Description</label>
											  <input type="text" class="form-control sample_de" id="sample_de" name="sample_de"  placeholder="Sample Description">
											</div>
										</div>
								 </div>';
				}
			$set_type_sample .='</div>';
			
			//for Brick
			$set_type_sample .='<div class="row material_class" id="BR">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Brick</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Mark</label>
										  <input type="text" class="form-control mark" id="mark"   name="mark" style="" placeholder="Mark">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
											<label>Class</label>
											<select class="form-control brick_specification" id="brick_specification" name="brick_specification">
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
								<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
											<label>Size</label>
											<select class="form-control brick_size" id="brick_size" name="brick_size">
												<option value="190 X 90 X 90">190 X 90 X 90</option>
												<option value="190 X 90 X 40">190 X 90 X 40</option>
												<option value="230 X 110 X 70">230 X 110 X 70</option>
												<option value="230 X 110 X 30">230 X 110 X 30</option>
												<option value="NS 225 X 100 X 75">NS 225 X 100 X 75</option>
												<option value="Other">Other</option>
											</select>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Bitumin
			$set_type_sample .='<div class="row material_class" id="BT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Tanker No.</label>
										  <input type="text" class="form-control tanker_no" id="tanker_no" name="tanker_no" placeholder="Tanker No">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Lot No.</label>
										  <input type="text" class="form-control lot_no" id="lot_no" name="lot_no" placeholder="Lot No.">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Grade</label>
											<select class="form-control bitumin_grade" id="bitumin_grade" name="bitumin_grade">
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
										  <input type="text" class="form-control make" id="make" name="make" placeholder="Make">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for BituminEmulsion
			$set_type_sample .='<div class="row material_class" id="BE">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin emulsion</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Source</label>
										  <input type="text" class="form-control tanker_no1" id="tanker_no1" name="tanker_no1" placeholder="sample Source">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Sample Description.</label>
										  <input type="text" class="form-control lot_no1" id="lot_no1" name="lot_no1" placeholder="sample Description">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Grade</label>
											<select class="form-control bitumin_grade1" id="bitumin_grade1" name="bitumin_grade1">
												<option value="RS-1">RS-1</option>
												<option value="RS-2">RS-2</option>
												<option value="MS">MS</option>
												<option value="SS-1">SS-1</option>
												<option value="SS-2">SS-2</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										 
										  <input type="hidden" class="form-control make" id="make1" name="make1" placeholder="Make">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for C C Cube
			$set_type_sample .='<div class="row material_class" id="CC">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>C C Cube</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-4">
									<div class="box-body col-sm-6">
											<div class="form-group">
												<label>Grade</label>
												<select class="form-control cube_grade" id="cube_grade" name="cube_grade">
													<option value="">Grade</option>
													<option value="M-5">M - 5</option>
													<option value="M-7.5">M - 7.5</option>
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
									<input type="text" class="form-control casting_date" id="casting_date" name="casting_date" placeholder="Casting Date" value="">
										</div>
									</div>
								</div>
								<div class="col-md-4">
										<div class="box-body col-sm-4">
											<div class="form-group">
												<label>Day</label>
											<select class="form-control day" id="day" name="day">
												<option value="7">7 Days</option>
												<option value="28">28 Days</option>
												<!--<option value="7_28">7 & 28 Days</option>-->
												<option value="other">Other</option>
											</select>
											</div>
										</div>
										<div class="box-body col-sm-6 only_remark">
											<div class="form-group">
											  <label for="exampleInputEmail1">Source of Sample</label>
											  <input type="text" class="form-control day_remark" id="day_remark" name="day_remark" placeholder="Remarks">
											</div>
										</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Identification Mark</label>
										  <input type="text" class="form-control cc_identification" id="cc_identification" name="cc_identification" placeholder="Identification Mark" Value="">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control cc_qty" id="cc_qty" name="cc_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>
								<input type="hidden" class="form-control set_of_cube" id="set_of_cube" name="set_of_cube"  Value="1">
								<input type="hidden" class="form-control no_of_cube" id="no_of_cube" name="no_of_cube" value="3" disabled>';
				}
			$set_type_sample .='</div>';
			
			//for Paver Block
			$set_type_sample .='<div class="row material_class" id="PB">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Paver Block</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-5">
									<div class="box-body col-sm-6">
										<div class="form-group">
										  <label for="exampleInputEmail1">Shape</label>
										  <select class="form-control shape" id="shape" name="shape">
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
										  <input type="text" class="form-control age" id="age" name="age" placeholder="Age">
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="box-body col-sm-6">
										<div class="form-group">
										  <label for="exampleInputEmail1">Color</label>
										  <input type="text" class="form-control color" id="color" name="color" placeholder="Color">
										</div>
									</div>
								
									<div class="box-body col-sm-6">
										<div class="form-group">
										  <label for="exampleInputEmail1">Thickness(mm)</label>
										  <select class="form-control thickness" id="thickness" name="thickness">
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
										  <select class="form-control paver_grade" id="paver_grade" name="paver_grade">
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
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Soil
			$set_type_sample .='<div class="row material_class" id="SO">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Soil</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Sample Type</label>
										  <input type="text" class="form-control sample_type" id="sample_type" name="sample_type" placeholder="Sample Type">
										</div>
									</div>
								</div>
								<div class="col-md-6">
										<div class="box-body">
											<div class="form-group">
											  <label for="exampleInputEmail1">Source</label>
											  <input type="text" class="form-control soil_source" id="soil_source" name="soil_source" placeholder="Soil Source">
											</div>
										</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Steel
			$set_type_sample .='<div class="row material_class" id="ST">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Steel</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">
												<div class="col-md-2">
												<label>Enrter Quantity:</label>
												<input type="text" class="form-control" id="steel_set_qty" name="steel_set_qty" placeholder="Enter Quantity" value="1" style="width:100px;">
												</div>
												<div class="col-md-2">
												<label>Select Grade:</label>
												<select class="form-control" name="steel_grade" id="steeling_id">
											<option value="-">SELECT-GRADE</option>
											<option value="-">-</option>
											<option value="FE 415">Fe 415</option>
											<option value="FE 415 D">Fe 415D</option>
											<option value="FE 415 S">Fe 415S</option>
											<option value="FE 500">Fe 500</option>
											<option value="FE 500 D">Fe 500D</option>
											<option value="FE 500 S">Fe 500S</option>
											<option value="FE 550">Fe 550</option>
											<option value="FE 550 D">Fe 550D</option>
											<option value="FE 600">Fe 600</option>
											<option value="FE 650">Fe 650</option>
											<option value="FE 750">Fe 750</option>
											<option value="FE 415 CRS">Fe 415 CRS</option>
											<option value="FE 415 D CRS">Fe 415D CRS</option>
											<option value="FE 415 S CRS">Fe 415S CRS</option>
											<option value="FE 500 CRS">Fe 500 CRS</option>
											<option value="FE 500 D CRS">Fe 500D CRS</option>
											<option value="FE 500 S CRS">Fe 500S CRS</option>
											<option value="FE 550 CRS">Fe 550 CRS</option>
											<option value="FE 550 D CRS">Fe 550D CRS</option>
											<option value="FE 600 CRS">Fe 600 CRS</option>
											<option value="FE 650 CRS">Fe 650 CRS</option>
											<option value="FE 750 CRS">Fe 750 CRS</option>
											
										</select>
												</div>
												<div class="col-md-8">
												<label>Enrter Name Of Source:</label>
												<input type="text" class="form-control" id="steel_source" name="steel_source" placeholder="Enter Name Of Source"  style="width:300px;">
												</div>';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="box-body col-md-2" >
									<div class="form-group">
										<label>Dia (mm)</label>
										<select class="form-control dia" id="dia" name="dia">
											<option value="">SELECT-DIA</option>
											<option value="4">4 mm</option>
											<option value="5">5 mm</option>
											<option value="6">6 mm</option>
											<option value="8">8 mm</option>
											<option value="10">10 mm</option>
											<option value="12">12 mm</option>
											<option value="16">16 mm</option>
											<option value="20">20 mm</option>
											<option value="25">25 mm</option>
											<option value="28">28 mm</option>
											<option value="32">32 mm</option>
											<option value="36">36 mm</option>
											<option value="40">40 mm</option>
											<option value="45">45 mm</option>
											<option value="50">50 mm</option>
											
										</select>
									</div>
								</div>
								<div class="box-body col-md-2" >
									<div class="form-group">
										<label></label>
										<select class="form-control steel_grade" name="steel_grade" style="display:none;">
										<option vlaue="">select-grade</option>
										</select>
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Brand</label>
									  <input type="text" class="form-control steel_brand" id="steel_brand" name="steel_brand" placeholder="Brand">
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Mill Heat No.</label>
									  <input type="text" class="form-control steel_heat" id="steel_heat" name="steel_heat" placeholder="Steel Heat">
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Lot Quantity</label>
									  <input type="text" class="form-control steel_sample_qty" id="steel_sample_qty" name="steel_sample_qty" placeholder="Sample Quantity">
									</div>
								</div><br>';
				}
			$set_type_sample .='</div>';
			
			//for Water
			$set_type_sample .='<div class="row material_class" id="WA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Water</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="box-body col-md-12">
									<div class="form-group">
									  <label for="exampleInputEmail1">Source</label>
									  <input type="text" class="form-control tile_source" id="tile_source" name="tile_source" placeholder="Source">
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Tiles
			$set_type_sample .='<div class="row material_class" id="TI">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Tiles</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
											<label>Specification</label>
											<input type="text" class="form-control tiles_specification" id="tiles_specification" name="tiles_specification" placeholder="Specification">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
											<label for="exampleInputEmail1">Brand</label>
											<input type="text" class="form-control brand" id="brand" name="brand" placeholder="Brand">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Fine Aggregate
			$set_type_sample .='<div class="row material_class" id="FA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Fine Aggregate</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Fine Aggregate Source</label>
										  <input type="text" class="form-control fine_agg_source" id="fine_agg_source" name="fine_agg_source" placeholder="Fine Aggregate Source">
										</div>
								     </div>
								</div>
								<div class="col-md-4">
										<div class="box-body">
										 <div class="form-group">
										   <label for="exampleInputEmail1">Fine Aggregate Type</label>
										   <input type="text" class="form-control fine_agg_type" id="fine_agg_type" name="fine_agg_type" placeholder="Fine Aggregate Type">
										 </div>
									</div>
								</div>
								<div class="col-md-4">
										<div class="box-body">
										 <div class="form-group">
										   <label for="exampleInputEmail1">Zone</label>
										   <select class="form-control grd_zone" id="grd_zone" name="grd_zone">											
											<option value="Zone II">Zone II</option>
											<option value="Zone I">Zone I</option>
											<option value="Zone III">Zone III</option>
											<option value="Zone IV">Zone IV</option>
											
										</select>
										 </div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Quarry Spall
			$set_type_sample .='<div class="row material_class" id="QU">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Quarry Spall</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-12">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quarry Spall Source</label>
										  <input type="text" class="form-control qa_spall_source" id="qa_spall_source" name="qa_spall_source" placeholder="Quarry Spall Source">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Field Test
			$set_type_sample .='<div class="row material_class" id="FT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Field Test</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Chainage No.</label>
										  <input type="text" class="form-control chainage_no" id="chainage_no" name="chainage_no" placeholder="Enter Chainage No.">
										</div>
									</div>
							    </div>
								<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Sample Description.</label>
										  <input type="text" class="form-control fdd_desc_sample" id="fdd_desc_sample" name="fdd_desc_sample" placeholder="Enter Sample Description." Value="GSB">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control class_qty" id="cc_qty" name="cc_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Bitumin Mix
			$set_type_sample .='<div class="row material_class" id="BM">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin Mix</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-12">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Bitumin Specification</label>
										   <select class="form-control bitumin_mix" id="bitumin_mix" name="bitumin_mix">
												<option value="BC-I">BC-I</option>
												<option value="BC-II">BC-II</option>
												<option value="DBM-I">DBM-I</option>
												<option value="DBM-II">DBM-II</option>
												<option value="SDBC-I">SDBC-I</option>
												<option value="SDBC-II">SDBC-II</option>
											</select>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for concrete Core
			$set_type_sample .='<div class="row material_class" id="ON">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Concrete Core</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control core_qty" id="core_qty" name="core_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for bitumin Core
			$set_type_sample .='<div class="row material_class" id="ME">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin Core</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control bitu_qty" id="bitu_qty" name="bitu_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for AAC BLOCK
			$set_type_sample .='<div class="row material_class" id="AC">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>AAC BLOCK</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Length</label>
										  <input type="text" class="form-control in_l" id="in_l" name="in_l" placeholder="Enter Length">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Width</label>
										  <input type="text" class="form-control in_w" id="in_w" name="in_w" placeholder="Enter Width">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Height</label>
										  <input type="text" class="form-control in_h" id="in_h" name="in_h" placeholder="Enter Height">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Density</label>
										   <select class="form-control in_den" id="in_den" name="in_den">
												<option value="451 to 550">451 to 550</option>
												<option value="551 to 650">551 to 650</option>
												<option value="651 to 750">651 to 750</option>
												<option value="751 to 850">751 to 850</option>
												<option value="851 to 1000">851 to 1000</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Grade</label>
										   <select class="form-control in_grade" id="in_grade" name="in_grade">
												<option value="grade 1">grade 1</option>
												<option value="grade 2">grade 2</option>
												
											</select>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for CLC BLOCK
			$set_type_sample .='<div class="row material_class" id="LC">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>CLC BLOCK</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Length</label>
										  <input type="text" class="form-control inl" id="inl" name="inl" placeholder="Enter Length">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Width</label>
										  <input type="text" class="form-control inw" id="inw" name="inw" placeholder="Enter Width">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Height</label>
										  <input type="text" class="form-control inh" id="inh" name="inh" placeholder="Enter Height">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Grade</label>
										   <select class="form-control ingrade"  name="ingrade" id="ingrade_'.$i.'">
										       <option value="">--SELECT--</option>
												<option value="G-2.5">G-2.5</option>
												<option value="G-3.5">G-3.5</option>
												<option value="G-6.5">G-6.5</option>
												<option value="G-12">G-12</option>
												<option value="G-17.5">G-17.5</option>
												<option value="G-25">G-25</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Density</label>
										    <input type="text" class="form-control inden" id="inden_'.$i.'" name="inden" readonly>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for ultra pulse
			$set_type_sample .='<div class="row material_class" id="UP">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Ultra Sonic Pulse Velocity</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control ultra_qty" id="ultra_qty" name="ultra_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Rebound Hammer
			$set_type_sample .='<div class="row material_class" id="RH">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Rebound Hammer</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control rebound_qty" id="rebound_qty" name="rebound_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Carbonation
			$set_type_sample .='<div class="row material_class" id="CN">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Carbonation</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control carbo_qty" id="carbo_qty" name="carbo_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Coating Thickness
			$set_type_sample .='<div class="row material_class" id="CT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Coating Thickness</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control c_thick_qty" id="c_thick_qty" name="c_thick_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Half Cell Potential
			$set_type_sample .='<div class="row material_class" id="HP">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Half Cell Potential</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control half_cell_qty" id="half_cell_qty" name="half_cell_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Pile Integrity
			$set_type_sample .='<div class="row material_class" id="PI">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Pile Integrity</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control pile_qty" id="pile_qty" name="pile_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Pull Out Test
			$set_type_sample .='<div class="row material_class" id="OT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Pull Out Test</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control pull_qty" id="pull_qty" name="pull_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			$set_type_sample .='<div class="row material_class" id="testings">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Excel Upload</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
		for($i=1;$i<=$txt_qty;$i++)
		{
		$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Description</label>
										  <input type="text" class="form-control excel_description" id="excel_description" name="excel_description"   placeholder="Description">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Qty.</label>
										  <input type="text" class="form-control excel_qty" id="excel_qty" name="excel_qty"  placeholder="Qty">
										</div>
									</div>
								</div>';
		}
		$set_type_sample .='</div>';
	 
	 $fill = array('all_material' => $out_materials,'final_lab_id' => $final_lab_id,'out_tests' => $out_tests,'cate_prefix' => $cate_prefix,'put_chk_box' => $put_chk_box,'out_materials_engineer' => $out_materials_engineer,'set_type_sample' => $set_type_sample);	
        echo json_encode($fill);
    }
	else if($_POST['action_type'] == 'get_by_qty_change'){
		
		$txt_qty= $_POST["txt_qty"];
		
		$cate_id= $_POST["select_material_category"];
		
		// toset lab id by material category_ids
		$get_query_category = "select * from material_category WHERE material_cat_id=$cate_id AND `material_cat_isdelete`='0'"; 
		$select_cat_result = mysqli_query($conn, $get_query_category);
		$get_cate=mysqli_fetch_array($select_cat_result);
		$cate_prefix = $get_cate["cat_prefix"];
		
		//generate type of sample
			//for cement
			$set_type_sample='<div class="row material_class" id="CM">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Cement</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Type Of Cement</label>
											<select class="form-control type_of_cement" id="c_type_'.$i.'"  name="type_of_cement">
												<option value="">Select-Type</option>
												<option value="OPC">OPC</option>
												<option value="PPC">PPC</option>
												<option value="PSC">PSC</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Grade</label>
											<select class="form-control cement_grade" id="c_grade_'.$i.'"  name="cement_grade">
												<option value="">Select Grade</option>
												<option value="53 OPC">53 OPC</option>
												<option value="43 OPC">43 OPC</option>
												<option value="33_grade">33_grade</option>
												<option value="flyash_type">flyash_type</option>
												<option value="calcimed_clay_type">calcimed_clay_type</option>
												<option value="OPC - 43 S">OPC - 43 S</option>
												<option value="OPC - 53 S">OPC - 53 S</option>
												<option value="PORTLAND SLAG">PORTLAND SLAG</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Brand</label>
										  <input type="text" class="form-control cement_brand" id="cement_brand" name="cement_brand"   placeholder="Brand">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Week No.</label>
										  <input type="text" class="form-control week_no" id="week_no" name="week_no"  placeholder="Week No.">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Aggregate
			$set_type_sample .='<div class="row material_class" id="CA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Aggregate</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Source</label>
										  <input type="text" class="form-control brick_source" id="brick_source" name="brick_source"  placeholder="Source">
										</div>
									</div>
								</div>
								<div class="col-md-6">
										<div class="box-body">
											<div class="form-group">
											  <label for="exampleInputEmail1">Sample Description</label>
											  <input type="text" class="form-control sample_de" id="sample_de" name="sample_de"  placeholder="Sample Description">
											</div>
										</div>
								 </div>';
				}
			$set_type_sample .='</div>';
			
			//for Brick
			$set_type_sample .='<div class="row material_class" id="BR">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Brick</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Mark</label>
										  <input type="text" class="form-control mark" id="mark"   name="mark" style="" placeholder="Mark">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
											<label>Class</label>
											<select class="form-control brick_specification" id="brick_specification" name="brick_specification">
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
								<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
											<label>Size</label>
											<select class="form-control brick_size" id="brick_size" name="brick_size">
												<option value="190 X 90 X 90">190 X 90 X 90</option>
												<option value="190 X 90 X 40">190 X 90 X 40</option>
												<option value="230 X 110 X 70">230 X 110 X 70</option>
												<option value="230 X 110 X 30">230 X 110 X 30</option>
												<option value="NS 225 X 100 X 75">NS 225 X 100 X 75</option>
												<option value="Other">Other</option>
											</select>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Bitumin
			$set_type_sample .='<div class="row material_class" id="BT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Tanker No.</label>
										  <input type="text" class="form-control tanker_no" id="tanker_no" name="tanker_no" placeholder="Tanker No">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Lot No.</label>
										  <input type="text" class="form-control lot_no" id="lot_no" name="lot_no" placeholder="Lot No.">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Grade</label>
											<select class="form-control bitumin_grade" id="bitumin_grade" name="bitumin_grade">
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
										  <input type="text" class="form-control make" id="make" name="make" placeholder="Make">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Bitumin emulsion
			$set_type_sample .='<div class="row material_class" id="BE">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin Emulsuion</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Source</label>
										  <input type="text" class="form-control tanker_no1" id="tanker_no1" name="tanker_no1" placeholder="sample Source">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Sample Description.</label>
										  <input type="text" class="form-control lot_no1" id="lot_no1" name="lot_no1" placeholder="sample Description">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
											<label>Grade</label>
											<select class="form-control bitumin_grade1" id="bitumin_grade1" name="bitumin_grade1">
												<option value="RS-1">RS-1</option>
												<option value="RS-2">RS-2</option>
												<option value="MS">MS</option>
												<option value="SS-1">SS-1</option>
												<option value="SS-2">SS-2</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										 
										  <input type="hidden" class="form-control make" id="make1" name="make1" placeholder="Make">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for C C Cube
			$set_type_sample .='<div class="row material_class" id="CC">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>C C Cube</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-4">
									<div class="box-body col-sm-6">
											<div class="form-group">
												<label>Grade</label>
												<select class="form-control cube_grade" id="cube_grade" name="cube_grade">
													<option value="">Grade</option>
													<option value="M-5">M - 5</option>
													<option value="M-7.5">M - 7.5</option>
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
									<input type="text" class="form-control casting_date" id="casting_date" name="casting_date" placeholder="Casting Date" value="">
										</div>
									</div>
								</div>
								<div class="col-md-4">
										<div class="box-body col-sm-4">
											<div class="form-group">
												<label>Day</label>
											<select class="form-control day" id="day" name="day">
												<option value="7">7 Days</option>
												<option value="28">28 Days</option>
												<!--<option value="7_28">7 & 28 Days</option>-->
												<option value="other">Other</option>
											</select>
											</div>
										</div>
										<div class="box-body col-sm-6 only_remark">
											<div class="form-group">
											  <label for="exampleInputEmail1">Source of Sample</label>
											  <input type="text" class="form-control day_remark" id="day_remark" name="day_remark" placeholder="Remarks">
											</div>
										</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Identification Mark</label>
										  <input type="text" class="form-control cc_identification" id="cc_identification" name="cc_identification" placeholder="Identification Mark" Value="">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control cc_qty" id="cc_qty" name="cc_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>
								<input type="hidden" class="form-control set_of_cube" id="set_of_cube" name="set_of_cube"  Value="1">
								<input type="hidden" class="form-control no_of_cube" id="no_of_cube" name="no_of_cube" value="3" disabled>';
				}
			$set_type_sample .='</div>';
			
			
			//for Paver Block
			$set_type_sample .='<div class="row material_class" id="PB">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Paver Block</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-5">
									<div class="box-body col-sm-6">
										<div class="form-group">
										  <label for="exampleInputEmail1">Shape</label>
										  <select class="form-control shape" id="shape" name="shape">
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
										  <input type="text" class="form-control age" id="age" name="age" placeholder="Age">
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="box-body col-sm-6">
										<div class="form-group">
										  <label for="exampleInputEmail1">Color</label>
										  <input type="text" class="form-control color" id="color" name="color" placeholder="Color">
										</div>
									</div>
								
									<div class="box-body col-sm-6">
										<div class="form-group">
										  <label for="exampleInputEmail1">Thickness(mm)</label>
										  <select class="form-control thickness" id="thickness" name="thickness">
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
										  <select class="form-control paver_grade" id="paver_grade" name="paver_grade">
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
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Soil
			$set_type_sample .='<div class="row material_class" id="SO">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Soil</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Sample Type</label>
										  <input type="text" class="form-control sample_type" id="sample_type" name="sample_type" placeholder="Sample Type">
										</div>
									</div>
								</div>
								<div class="col-md-6">
										<div class="box-body">
											<div class="form-group">
											  <label for="exampleInputEmail1">Source</label>
											  <input type="text" class="form-control soil_source" id="soil_source" name="soil_source" placeholder="Soil Source">
											</div>
										</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Steel
			$set_type_sample .='<div class="row material_class" id="ST">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Steel</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">
												<div class="col-md-2">
												<label>Enrter Quantity:</label>
												<input type="text" class="form-control" id="steel_set_qty" name="steel_set_qty" placeholder="Enter Quantity" value="1" style="width:100px;">
												</div>
												<div class="col-md-2">
												<label>Select Grade:</label>
												<select class="form-control" name="steel_grade" id="steeling_id">
											<option value="-">SELECT-GRADE</option>
											<option value="-">-</option>
											<option value="FE 415">Fe 415</option>
											<option value="FE 415 D">Fe 415D</option>
											<option value="FE 415 S">Fe 415S</option>
											<option value="FE 500">Fe 500</option>
											<option value="FE 500 D">Fe 500D</option>
											<option value="FE 500 S">Fe 500S</option>
											<option value="FE 550">Fe 550</option>
											<option value="FE 550 D">Fe 550D</option>
											<option value="FE 600">Fe 600</option>
											<option value="FE 650">Fe 650</option>
											<option value="FE 750">Fe 750</option>
											<option value="FE 415 CRS">Fe 415 CRS</option>
											<option value="FE 415 D CRS">Fe 415D CRS</option>
											<option value="FE 415 S CRS">Fe 415S CRS</option>
											<option value="FE 500 CRS">Fe 500 CRS</option>
											<option value="FE 500 D CRS">Fe 500D CRS</option>
											<option value="FE 500 S CRS">Fe 500S CRS</option>
											<option value="FE 550 CRS">Fe 550 CRS</option>
											<option value="FE 550 D CRS">Fe 550D CRS</option>
											<option value="FE 600 CRS">Fe 600 CRS</option>
											<option value="FE 650 CRS">Fe 650 CRS</option>
											<option value="FE 750 CRS">Fe 750 CRS</option>
											
										</select>
												</div>
												<div class="col-md-8">
												<label>Enrter Name Of Source:</label>
												<input type="text" class="form-control" id="steel_source" name="steel_source" placeholder="Enter Name Of Source"  style="width:300px;">
												</div>';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="box-body col-md-2" >
									<div class="form-group">
										<label>Dia (mm)</label>
										<select class="form-control dia" id="dia" name="dia">
											<option value="">SELECT-DIA</option>
											<option value="4">4 mm</option>
											<option value="5">5 mm</option>
											<option value="6">6 mm</option>
											<option value="8">8 mm</option>
											<option value="10">10 mm</option>
											<option value="12">12 mm</option>
											<option value="16">16 mm</option>
											<option value="20">20 mm</option>
											<option value="25">25 mm</option>
											<option value="28">28 mm</option>
											<option value="32">32 mm</option>
											<option value="36">36 mm</option>
											<option value="40">40 mm</option>
											<option value="45">45 mm</option>
											<option value="50">50 mm</option>
											
										</select>
									</div>
								</div>
								<div class="box-body col-md-2" >
									<div class="form-group">
										<label></label>
										<select class="form-control steel_grade" name="steel_grade"  style="display:none;">
										<option vlaue="">select-grade</option>
										</select>
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Brand</label>
									  <input type="text" class="form-control steel_brand" id="steel_brand" name="steel_brand" placeholder="Brand">
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Steel Heat</label>
									  <input type="text" class="form-control steel_heat" id="steel_heat" name="steel_heat" placeholder="Steel Heat">
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Sample Quantity</label>
									  <input type="text" class="form-control steel_sample_qty" id="steel_sample_qty" name="steel_sample_qty" placeholder="Sample Quantity">
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Water
			$set_type_sample .='<div class="row material_class" id="WA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Water</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="box-body col-md-12">
									<div class="form-group">
									  <label for="exampleInputEmail1">Source</label>
									  <input type="text" class="form-control tile_source" id="tile_source" name="tile_source" placeholder="Source">
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Tiles
			$set_type_sample .='<div class="row material_class" id="TI">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Tiles</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
											<label>Specification</label>
											<input type="text" class="form-control tiles_specification" id="tiles_specification" name="tiles_specification" placeholder="Specification">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
											<label for="exampleInputEmail1">Brand</label>
											<input type="text" class="form-control brand" id="brand" name="brand" placeholder="Brand">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Fine Aggregate
			$set_type_sample .='<div class="row material_class" id="FA">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Fine Aggregate</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-4">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Fine Aggregate Source</label>
										  <input type="text" class="form-control fine_agg_source" id="fine_agg_source" name="fine_agg_source" placeholder="Fine Aggregate Source">
										</div>
								     </div>
								</div>
								<div class="col-md-4">
										<div class="box-body">
										 <div class="form-group">
										   <label for="exampleInputEmail1">Fine Aggregate Type</label>
										   <input type="text" class="form-control fine_agg_type" id="fine_agg_type" name="fine_agg_type" placeholder="Fine Aggregate Type">
										 </div>
									</div>
								</div>
								<div class="col-md-4">
										<div class="box-body">
										 <div class="form-group">
										   <label for="exampleInputEmail1">Zone</label>
										   <select class="form-control grd_zone" id="grd_zone" name="grd_zone">											
											<option value="Zone II">Zone II</option>
											<option value="Zone I">Zone I</option>
											<option value="Zone III">Zone III</option>
											<option value="Zone IV">Zone IV</option>
											
										</select>
										 </div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Quarry Spall
			$set_type_sample .='<div class="row material_class" id="QU">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Quarry Spall</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-12">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quarry Spall Source</label>
										  <input type="text" class="form-control qa_spall_source" id="qa_spall_source" name="qa_spall_source" placeholder="Quarry Spall Source">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Field Test
			$set_type_sample .='<div class="row material_class" id="FT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Field Test</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Chainage No.</label>
										  <input type="text" class="form-control chainage_no" id="chainage_no" name="chainage_no" placeholder="Enter Chainage No.">
										</div>
									</div>
							    </div>
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Sample Description.</label>
										  <input type="text" class="form-control fdd_desc_sample" id="fdd_desc_sample" name="fdd_desc_sample" placeholder="Enter Sample Description." Value="GSB">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Bitumin Mix
			$set_type_sample .='<div class="row material_class" id="BM">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin Mix</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-12">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Bitumin Specification</label>
										   <select class="form-control bitumin_mix" id="bitumin_mix" name="bitumin_mix">
												<option value="BC-I">BC-I</option>
												<option value="BC-II">BC-II</option>
												<option value="DBM-I">DBM-I</option>
												<option value="DBM-II">DBM-II</option>
												<option value="SDBC-I">SDBC-I</option>
												<option value="SDBC-II">SDBC-II</option>
											</select>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Core
			$set_type_sample .='<div class="row material_class" id="ON">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Concrete Core</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control core_qty" id="core_qty" name="core_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for bitumin Core
			$set_type_sample .='<div class="row material_class" id="ME">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Bitumin Core</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control bitu_qty" id="bitu_qty" name="bitu_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for CLC BLOCK
			$set_type_sample .='<div class="row material_class" id="LC">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>CLC BLOCK</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Length</label>
										  <input type="text" class="form-control inl" id="inl" name="inl" placeholder="Enter Length">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Width</label>
										  <input type="text" class="form-control inw" id="inw" name="inw" placeholder="Enter Width">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Height</label>
										  <input type="text" class="form-control inh" id="inh" name="inh" placeholder="Enter Height">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Grade</label>
										   <select class="form-control ingrade"  name="ingrade" id="ingrade_'.$i.'">
										      <option value="">--SELECT--</option>
												<option value="G-2.5">G-2.5</option>
												<option value="G-3.5">G-3.5</option>
												<option value="G-6.5">G-6.5</option>
												<option value="G-12">G-12</option>
												<option value="G-17.5">G-17.5</option>
												<option value="G-25">G-25</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Density</label>
										    <input type="text" class="form-control inden" id="inden_'.$i.'" name="inden" readonly>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for AAC BLOCK
			$set_type_sample .='<div class="row material_class" id="AC">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>AAC BLOCK</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Length</label>
										  <input type="text" class="form-control in_l" id="in_l" name="in_l" placeholder="Enter Length">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Width</label>
										  <input type="text" class="form-control in_w" id="in_w" name="in_w" placeholder="Enter Width">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Height</label>
										  <input type="text" class="form-control in_h" id="in_h" name="in_h" placeholder="Enter Height">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Density</label>
										   <select class="form-control in_den" id="in_den" name="in_den">
												<option value="451 to 550">451 to 550</option>
												<option value="551 to 650">551 to 650</option>
												<option value="651 to 750">651 to 750</option>
												<option value="751 to 850">751 to 850</option>
												<option value="851 to 1000">851 to 1000</option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Grade</label>
										   <select class="form-control in_grade" id="in_grade" name="in_grade">
												<option value="grade 1">grade 1</option>
												<option value="grade 2">grade 2</option>
												
											</select>
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for ultra pulse
			$set_type_sample .='<div class="row material_class" id="UP">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Ultra Sonic Pulse Velocity</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control ultra_qty" id="ultra_qty" name="ultra_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Rebound Hammer
			$set_type_sample .='<div class="row material_class" id="RH">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Rebound Hammer</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control rebound_qty" id="rebound_qty" name="rebound_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Carbonation
			$set_type_sample .='<div class="row material_class" id="CN">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Carbonation</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control carbo_qty" id="carbo_qty" name="carbo_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Coating Thickness
			$set_type_sample .='<div class="row material_class" id="CT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Coating Thickness</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control c_thick_qty" id="c_thick_qty" name="c_thick_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Half Cell Potential
			$set_type_sample .='<div class="row material_class" id="HP">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Half Cell Potential</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control half_cell_qty" id="half_cell_qty" name="half_cell_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Pile Integrity
			$set_type_sample .='<div class="row material_class" id="PI">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Pile Integrity</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control pile_qty" id="pile_qty" name="pile_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			//for Pull Out Test
			$set_type_sample .='<div class="row material_class" id="OT">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Pull Out Test</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="col-md-2">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Quantity / Report</label>
										  <input type="text" class="form-control pull_qty" id="pull_qty" name="pull_qty" placeholder="Enter Quantity" Value="1">
										</div>
									</div>
								</div>';
				}
			$set_type_sample .='</div>';
			
			
		$set_type_sample .='<div class="row material_class" id="testings">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Excel Upload</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">';
		for($i=1;$i<=$txt_qty;$i++)
		{
		$set_type_sample .='<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Description</label>
										  <input type="text" class="form-control excel_description" id="excel_description" name="excel_description"   placeholder="Description">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="box-body">
										<div class="form-group">
										  <label for="exampleInputEmail1">Qty.</label>
										  <input type="text" class="form-control excel_qty" id="excel_qty" name="excel_qty"  placeholder="Qty">
										</div>
									</div>
								</div>';
		}
		$set_type_sample .='</div>';
		
		$fill = array('set_type_sample' => $set_type_sample,'cate_prefix' => $cate_prefix);
		echo json_encode($fill);
		
	}
	else if($_POST['action_type'] == 'get_steel_qty_by_change'){
		
		$txt_qty= $_POST["steel_set_qty"];
		
		$cate_id= $_POST["select_material_category"];
		
		// toset lab id by material category_ids
		$get_query_category = "select * from material_category WHERE material_cat_id=$cate_id AND `material_cat_isdelete`='0'"; 
		$select_cat_result = mysqli_query($conn, $get_query_category);
		$get_cate=mysqli_fetch_array($select_cat_result);
		$cate_prefix = $get_cate["cat_prefix"];
		
		//generate type of sample
		
			
			//for Steel
			$set_type_sample ='<div class="row material_class" id="ST">
												<div class="col-md-12">
													<h4 style="text-align:center;"><b>Steel</b></h4>
												</div>
												<hr style="border: 1px solid #ddd;">
												<div class="col-md-2">
												<label>Enrter Quantity:</label>
												<input type="text" class="form-control" id="steel_set_qty" name="steel_set_qty" placeholder="Enter Quantity" value="'.$txt_qty.'" style="width:100px;">
												</div>
												<div class="col-md-2">
												<label>Select Grade:</label>
												<select class="form-control" name="steel_grade" id="steeling_id">
											<option value="-">SELECT-GRADE</option>
											<option value="-">-</option>
											<option value="FE 415">Fe 415</option>
											<option value="FE 415 D">Fe 415D</option>
											<option value="FE 415 S">Fe 415S</option>
											<option value="FE 500">Fe 500</option>
											<option value="FE 500 D">Fe 500D</option>
											<option value="FE 500 S">Fe 500S</option>
											<option value="FE 550">Fe 550</option>
											<option value="FE 550 D">Fe 550D</option>
											<option value="FE 600">Fe 600</option>
											<option value="FE 650">Fe 650</option>
											<option value="FE 750">Fe 750</option>
											<option value="FE 415 CRS">Fe 415 CRS</option>
											<option value="FE 415 D CRS">Fe 415D CRS</option>
											<option value="FE 415 S CRS">Fe 415S CRS</option>
											<option value="FE 500 CRS">Fe 500 CRS</option>
											<option value="FE 500 D CRS">Fe 500D CRS</option>
											<option value="FE 500 S CRS">Fe 500S CRS</option>
											<option value="FE 550 CRS">Fe 550 CRS</option>
											<option value="FE 550 D CRS">Fe 550D CRS</option>
											<option value="FE 600 CRS">Fe 600 CRS</option>
											<option value="FE 650 CRS">Fe 650 CRS</option>
											<option value="FE 750 CRS">Fe 750 CRS</option>
										</select>
												</div>
												<div class="col-md-8">
												<label>Enrter Name Of Source:</label>
												<input type="text" class="form-control" id="steel_source" name="steel_source" placeholder="Enter Name Of Source"  style="width:300px;">
												</div>';
			
			for($i=1;$i<=$txt_qty;$i++)
				{
			$set_type_sample .='<div class="box-body col-md-2" >
									<div class="form-group">
										<label>Dia (mm)</label>
										<select class="form-control dia" id="dia" name="dia">
											<option value="">SELECT-DIA</option>
											<option value="4">4 mm</option>
											<option value="5">5 mm</option>
											<option value="6">6 mm</option>
											<option value="8">8 mm</option>
											<option value="10">10 mm</option>
											<option value="12">12 mm</option>
											<option value="16">16 mm</option>
											<option value="20">20 mm</option>
											<option value="25">25 mm</option>
											<option value="28">28 mm</option>
											<option value="32">32 mm</option>
											<option value="36">36 mm</option>
											<option value="40">40 mm</option>
											<option value="45">45 mm</option>
											<option value="50">50 mm</option>
											
										</select>
									</div>
								</div>
								<div class="box-body col-md-4" >
									<div class="form-group">
										<label></label>
										<select class="form-control steel_grade" name="steel_grade"  style="display:none;">
										<option vlaue="">select-grade</option>
										</select>
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Brand</label>
									  <input type="text" class="form-control steel_brand" id="steel_brand" name="steel_brand" placeholder="Brand">
									</div>
								</div>
								<!--<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Steel Make</label>
									  <input type="text" class="form-control steel_make" id="steel_make" name="steel_make" placeholder="Steel Make">
									</div>
								</div>-->
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Mill Heat No.</label>
									  <input type="text" class="form-control steel_heat" id="steel_heat" name="steel_heat" placeholder="Steel Heat">
									</div>
								</div>
								<div class="box-body col-md-2">
									<div class="form-group">
									  <label for="exampleInputEmail1">Lot Quantity</label>
									  <input type="text" class="form-control steel_sample_qty" id="steel_sample_qty" name="steel_sample_qty" placeholder="Sample Quantity">
									</div>
								</div><br>';
				}
			$set_type_sample .='</div>';
	 $fill = array('cate_prefix' => $cate_prefix,'set_type_sample' => $set_type_sample);	
        echo json_encode($fill);
    }
	elseif($_POST['action_type'] == 'get_material_by_category_more'){
		
		$cate_id= $_POST["select_material_category"];
		$get_more_count= $_POST["get_more_count"];
		$get_query = "select id,mt_name from material WHERE mat_category_id=$cate_id AND `mt_isdeleted`='0' LIMIT $get_more_count,20"; 
		$select_result = mysqli_query($conn, $get_query);
		$out_materials='';
		$get_rows_counts=mysqli_num_rows($select_result);
		
		if (mysqli_num_rows($select_result) > 0) {
			while($row = mysqli_fetch_assoc($select_result)) {
				
			$out_materials .='<option value="'.$row['id'].'" >'.$row['mt_name'].'</option>';
			}}
			
		$sel_mate_cat="select * from material_category where `material_cat_id`=".$cate_id;
		$query_catgory = mysqli_query($conn, $sel_mate_cat);
		$result_category=mysqli_fetch_assoc($query_catgory);
		$category_names="";
		$category_names .=$result_category["material_cat_name"];
	 
	 $fill = array('all_material' => $out_materials,'get_rows_counts' => $get_rows_counts,'category_names' => $category_names);	
        echo json_encode($fill);
    }
	elseif($_POST['action_type'] == 'get_lab_by_material'){
     
		$txt_job_no= $_POST["txt_job_no"];
		$nabl_types= $_POST["nabl_types"];
		$txt_report_no= $_POST["txt_report_no"];
		$report_explode= explode("/",$txt_report_no);
		
		
		$select_material_category= $_POST["select_material_category"];
		$material_id= $_POST["select_material"];
		
		// get material by id
		$get_query = "select * from material WHERE id=$material_id AND `mt_isdeleted`='0'"; 
		$select_result = mysqli_query($conn, $get_query);
		$get_material=mysqli_fetch_array($select_result);
		$material_prefix = $get_material["mt_prefix"];
		$material_per_day_limit = $get_material["per_day_limit"];
		$filename = $get_material["filename"];
		
		// get test by cate id and material id		
		$get_query_test = "select * from particular_test WHERE `mate_cat_id`=$select_material_category AND `mate_id`=$material_id  AND `is_deleted`=0";
		$select_result_test = mysqli_query($conn, $get_query_test);
		
		//$out_tests='<option value="" >Select Test</option>';
		$out_tests='';
			   if (mysqli_num_rows($select_result_test) > 0) 
			{
				$result_test_array=mysqli_fetch_array($select_result_test);
				$get_test_array=$result_test_array["test_ids"];
				$get_chk=$result_test_array["test_chk"];
				$exploded_test_array= explode(",",$get_test_array);
				$exploded_chk= explode(",",$get_chk);
				
				foreach($exploded_test_array as $keying => $one_test) 
				{
				    $get_query_test_names = "select test_name,in_nabl from test_master WHERE `test_isdeleted`='0' AND `test_id`=".$one_test; 
					$select_result_test_name = mysqli_query($conn, $get_query_test_names);
					$get_test_name = mysqli_fetch_array($select_result_test_name);
					
						if (in_array($one_test, $exploded_chk)){ $sets='selected="selected"';}else{ $sets='';}
						$out_tests .='<option value="'.$one_test.'"'.$sets.' >'.$get_test_name['test_name'].'</option>';
				}	
			}   	
				
		
		
		$fill = array('material_per_day_limit' => $material_per_day_limit,'out_tests' => $out_tests,'filename' => $filename);	
		
       
        echo json_encode($fill);
    }
	elseif($_POST['action_type'] == 'add_material_assinging'){
       
				
				
				
				$txt_trf_no= $_POST['txt_trf_no'];
				$select_material_category= $_POST['select_material_category'];
				$select_material= $_POST['select_material'];
				$type_of_cement= $_POST['type_of_cement'];
				$cement_grade= $_POST['cement_grade'];
				$cement_brand= $_POST['cement_brand'];
				$week_no= $_POST['week_no'];
				$brick_source= $_POST['brick_source'];
				$sample_de= $_POST['sample_de'];
				$mark= $_POST['mark'];
				$brick_specification= $_POST['brick_specification'];
				$tanker_no= $_POST['tanker_no'];
				$lot_no= $_POST['lot_no'];
				$bitumin_grade= $_POST['bitumin_grade'];
				$make= $_POST['make'];
				
				$tanker_no1= $_POST['tanker_no1'];
				$lot_no1= $_POST['lot_no1'];
				$bitumin_grade1= $_POST['bitumin_grade1'];
				$make1= $_POST['make1'];
				
				$cube_grade= $_POST['cube_grade'];
				$day_remark= $_POST['day_remark'];
				$casting_date_submission= $_POST['casting_date'];
				$date_ex1_date_submission = str_replace('/', '-', $casting_date_submission);
				$casting_date =  date('Y-m-d', strtotime($date_ex1_date_submission));
				$day= $_POST['day'];
				$set_of_cube= $_POST['set_of_cube'];
				$no_of_cube= $_POST['no_of_cube'];
				$cc_identification= $_POST['cc_identification'];
				$chainage_no= $_POST['chainage_no'];
				$fdd_desc_sample= $_POST['fdd_desc_sample'];
				$shape= $_POST['shape'];
				$age= $_POST['age'];
				$color= $_POST['color'];
				$thickness= $_POST['thickness'];
				$paver_grade= $_POST['paver_grade'];
				$sample_type= $_POST['sample_type'];
				$soil_source= $_POST['soil_source'];
				$dia= $_POST['dia'];
				$steel_grade= $_POST['steel_grade'];
				$steel_brand= $_POST['steel_brand'];
				$tile_source= $_POST['tile_source'];
				$tiles_specification= $_POST['tiles_specification'];
				$fine_agg_source= $_POST['fine_agg_source'];
				$fine_agg_type= $_POST['fine_agg_type'];
				$qa_spall_source= $_POST['qa_spall_source'];
				$brand= $_POST['brand'];
				$select_samp_condition= $_POST['select_samp_condition'];
				$select_location= $_POST['select_location'];
				$sample_note= $_POST['sample_note'];
				$bitumin_mix= $_POST['bitumin_mix'];
				$txt_is_sample= $_POST['txt_is_sample'];
				$current_date= date('Y-m-d');
				$ultra_qty= $_POST['ultra_qty'];
				$rebound_qty= $_POST['rebound_qty'];
				$tested_by= $_POST['tested_by'];
				$reported_by= $_POST['reported_by'];
				$var_ex_date_submission = $_POST['ex_date_submission'];
				$date_ex_date_submission = str_replace('/', '-', $var_ex_date_submission);
				$ex_date_submission =  date('Y-m-d', strtotime($date_ex_date_submission));
				
				$chkmorr= "r";
				$exel_radio= $_POST['exel_radio'];
				
				$insert="insert into final_material_assign_master (`temporary_trf_no`,`material_category`,`material_id`,`expected_date`,`is_status`,`created_by`,`created_by_id`,`created_date`,`modified_by`,`modified_date`,`is_deleted`,`job_date`,`is_sample`) 
				values(
				'$txt_trf_no',
				'$select_material_category',
				'$select_material',
				'$ex_date_submission',
				'1',
				'$_SESSION[name]',
				'$_SESSION[u_id]',
				'$current_date',
				'',
				'$current_date',
				'0',
				'$current_date',
				'$txt_is_sample')";
				//$result_of_insert=mysqli_query($conn,$insert);
				if (mysqli_query($conn, $insert)) 
				{
					$last_final_material_id = mysqli_insert_id($conn);
				}else
				{
					$last_final_material_id;
					
				}
				
				$select_test1= $_POST['select_test'];				
				$mul_data = explode(',', $select_test1); 
				foreach($mul_data as $select_test) //loop over values
				{
					//echo $value . PHP_EOL; //print value
				
				//select date of job for insert it in final_material_assign_master table
				$sel_job="select * from job where `temporary_trf_no`='$txt_trf_no'";
				$result_job_date=mysqli_query($conn,$sel_job);
				$get_job_result=mysqli_fetch_array($result_job_date);
				$job_inserted_date=$get_job_result["date"];
				
				
				
					// get test from test master
					$sel_test="select * from test_master where `test_id`=".$select_test;
					$result_test=mysqli_query($conn,$sel_test);
					$get_test=mysqli_fetch_array($result_test);
					$test_rate=$get_test["test_rate"];
					
					$insert_test_wise="insert into test_wise_material_rate (`temporary_trf_no`,`material_cat_id`,`material_id`,`final_material_id`,`test_id`,`qty`,`rate`,`amt`,`created_by`,`created_date`,`modified_by`,`modified_date`,`is_deleted`) 
						values(
						'$txt_trf_no',
						'$select_material_category',
						'$select_material',
						'$last_final_material_id',
						'$select_test',
						'1',
						'$test_rate',
						'$test_rate',
						'$_SESSION[name]',
						'0000-00-00',
						'',
						'0000-00-00',
						'0')";
						$result_insert_test_wise=mysqli_query($conn,$insert_test_wise);
					
				 	$insert="insert into span_material_assign (`material_category`,`material_id`,`final_material_id`,`material_location`,`sample_note`,`material_condition`,`test`,`expected_date`,`morr`,`excel_upload`,`tested_by`,`reported_by`,`type_of_cement`,`cement_grade`,`cement_brand`,`week_number`,`agg_source`,`sample_de`,`brick_mark`,`brick_specification`,`tanker_no`,`lot_no`,`bitumin_grade`,`bitumin_make`,`cc_grade`,`day_remark`,`casting_date`,`cc_day`,`cc_set_of_cube`,`cc_no_of_cube`,`paver_shape`,`paver_age`,`paver_color`,`paver_thickness`,`paver_grade`,`soil_location`,`soil_source`,`steel_dia`,`steel_grade`,`steel_brand`,`water_source`,`water_specification`,`water_brand`,`fine_aggregate_source`,`quarry_spall_source`,`bit_mix`,`is_save`,`createdby`,`createddate`,`modifiedby`,`modifieddate`,`isdeleted`,`temporary_trf_no`,`created_by_id`,`cc_identification_mark`,`chainage_no`,`fine_agg_type`,`fdd_desc_sample`,`ultra_qty`,`rebound_qty`,`tanker_no1`,`lot_no1`,`bitumin_grade1`,`bitumin_make1`) 
				values(
				'$select_material_category',
				'$select_material',
				'$last_final_material_id',
				'$select_location',
				'$sample_note',
				'$select_samp_condition',
				'$select_test',
				'$ex_date_submission',
				'$chkmorr',
				'$exel_radio',
				'$tested_by',
				'$reported_by',
				'$type_of_cement',
				'$cement_grade',
				'$cement_brand',
				'$week_no',
				'$brick_source',
				'$sample_de',
				'$mark',
				'$brick_specification',
				'$tanker_no',
				'$lot_no',
				'$bitumin_grade',
				'$make',
				'$cube_grade',
				'$day_remark',
				'$casting_date',
				'$day',
				'$set_of_cube',
				'$no_of_cube',
				'$shape',
				'$age',
				'$color',
				'$thickness',
				'$paver_grade',
				'$sample_type',
				'$soil_source',
				'$dia',
				'$steel_grade',
				'$steel_brand',
				'$tile_source',
				'$tiles_specification',
				'$brand',
				'$fine_agg_source',
				'$qa_spall_source',
				'$bitumin_mix',
				'0',
				'$_SESSION[name]',
				'$current_date',
				'',
				'$current_date',
				'0',
				'$txt_trf_no',
				'$_SESSION[u_id]',
				'$cc_identification',
				'$chainage_no',
				'$fine_agg_type',
				'$fdd_desc_sample',
				'$ultra_qty',
				'$rebound_qty',
				'$tanker_no1',
				'$lot_no1',
				'$bitumin_grade1',
				'$make1'
				)";
				$result_of_insert=mysqli_query($conn,$insert);
				
				}
				
			
				
	}
	elseif($_POST['action_type'] == 'add_material_in_edit'){
       
				
				
				
				$reportno= $_POST['reportno'];
				$labno= $_POST['labno'];
				$ulrno= $_POST['ulrno'];
				$finalmatno= $_POST['finalmatno'];
				
				$txt_trf_no= $_POST['txt_trf_no'];
				$select_material_category= $_POST['select_material_category'];
				$select_material= $_POST['select_material'];
				$type_of_cement= $_POST['type_of_cement'];
				$cement_grade= $_POST['cement_grade'];
				$cement_brand= $_POST['cement_brand'];
				$week_no= $_POST['week_no'];
				$brick_source= $_POST['brick_source'];
				$sample_de= $_POST['sample_de'];
				$mark= $_POST['mark'];
				$brick_specification= $_POST['brick_specification'];
				$tanker_no= $_POST['tanker_no'];
				$lot_no= $_POST['lot_no'];
				$bitumin_grade= $_POST['bitumin_grade'];
				$make= $_POST['make'];
				
				$tanker_no1= $_POST['tanker_no1'];
				$lot_no1= $_POST['lot_no1'];
				$bitumin_grade1= $_POST['bitumin_grade1'];
				$make1= $_POST['make1'];
				
				$cube_grade= $_POST['cube_grade'];
				$day_remark= $_POST['day_remark'];
				$casting_date_submission= $_POST['casting_date'];
				$date_ex1_date_submission = str_replace('/', '-', $casting_date_submission);
				$casting_date =  date('Y-m-d', strtotime($date_ex1_date_submission));
				$day= $_POST['day'];
				$set_of_cube= $_POST['set_of_cube'];
				$no_of_cube= $_POST['no_of_cube'];
				$cc_identification= $_POST['cc_identification'];
				$chainage_nochainage_no= $_POST['chainage_no'];
				$fdd_desc_sample= $_POST['fdd_desc_sample'];
				$shape= $_POST['shape'];
				$age= $_POST['age'];
				$color= $_POST['color'];
				$thickness= $_POST['thickness'];
				$paver_grade= $_POST['paver_grade'];
				$sample_type= $_POST['sample_type'];
				$soil_source= $_POST['soil_source'];
				$dia= $_POST['dia'];
				$steel_grade= $_POST['steel_grade'];
				$steel_brand= $_POST['steel_brand'];
				$tile_source= $_POST['tile_source'];
				$tiles_specification= $_POST['tiles_specification'];
				$fine_agg_source= $_POST['fine_agg_source'];
				$fine_agg_type= $_POST['fine_agg_type'];
				$qa_spall_source= $_POST['qa_spall_source'];
				$brand= $_POST['brand'];
				$select_samp_condition= $_POST['select_samp_condition'];
				$select_location= $_POST['select_location'];
				$sample_note= $_POST['sample_note'];
				$bitumin_mix= $_POST['bitumin_mix'];
				$txt_is_sample= $_POST['txt_is_sample'];
				$current_date= date('Y-m-d');
				$ultra_qty= $_POST['ultra_qty'];
				$rebound_qty= $_POST['rebound_qty'];
				$tested_by= $_POST['tested_by'];
				$reported_by= $_POST['reported_by'];
				$var_ex_date_submission = $_POST['ex_date_submission'];
				$date_ex_date_submission = str_replace('/', '-', $var_ex_date_submission);
				$ex_date_submission =  date('Y-m-d', strtotime($date_ex_date_submission));
				
				$chkmorr= "d";
				$exel_radio= $_POST['exel_radio'];
				
				$updates="update final_material_assign_master set `material_category`='$select_material_category',`material_id`='$select_material',`expected_date`='$ex_date_submission' where `final_material_id`=".$finalmatno;
				$result_of_up=mysqli_query($conn,$updates);
				
				$updates_job_of_eng="update job_for_engineer set `material_id`='$select_material' where `lab_no`='$labno'";
				$result_of_up_job_eng=mysqli_query($conn,$updates_job_of_eng);
				
				
				$select_test1= $_POST['select_test'];				
				$mul_data = explode(',', $select_test1); 
				foreach($mul_data as $select_test) //loop over values
				{
					//echo $value . PHP_EOL; //print value
				
				//select date of job for insert it in final_material_assign_master table
				$sel_job="select * from job where `trf_no`='$txt_trf_no'";
				$result_job_date=mysqli_query($conn,$sel_job);
				$get_job_result=mysqli_fetch_array($result_job_date);
				$job_inserted_date=$get_job_result["date"];
				$temporary_trf_no=$get_job_result["temporary_trf_no"];
				
				
				
					// get test from test master
					$sel_test="select * from test_master where `test_id`=".$select_test;
					$result_test=mysqli_query($conn,$sel_test);
					$get_test=mysqli_fetch_array($result_test);
					$test_rate=$get_test["test_rate"];
					
					$insert_test_wise="insert into test_wise_material_rate (`temporary_trf_no`,`trf_no`,`job_no`,`material_cat_id`,`material_id`,`final_material_id`,`test_id`,`qty`,`rate`,`amt`,`created_by`,`created_date`,`modified_by`,`modified_date`,`is_deleted`) 
						values(
						'$temporary_trf_no',
						'$txt_trf_no',
						'$txt_trf_no',
						'$select_material_category',
						'$select_material',
						'$finalmatno',
						'$select_test',
						'1',
						'$test_rate',
						'$test_rate',
						'$_SESSION[name]',
						'0000-00-00',
						'',
						'0000-00-00',
						'0')";
						$result_insert_test_wise=mysqli_query($conn,$insert_test_wise);
					
					$insert="insert into span_material_assign (`material_category`,`material_id`,`final_material_id`,`material_location`,`sample_note`,`material_condition`,`test`,`expected_date`,`morr`,`excel_upload`,`tested_by`,`reported_by`,`type_of_cement`,`cement_grade`,`cement_brand`,`week_number`,`agg_source`,`sample_de`,`brick_mark`,`brick_specification`,`tanker_no`,`lot_no`,`bitumin_grade`,`bitumin_make`,`cc_grade`,`day_remark`,`casting_date`,`cc_day`,`cc_set_of_cube`,`cc_no_of_cube`,`paver_shape`,`paver_age`,`paver_color`,`paver_thickness`,`paver_grade`,`soil_location`,`soil_source`,`steel_dia`,`steel_grade`,`steel_brand`,`water_source`,`water_specification`,`water_brand`,`fine_aggregate_source`,`quarry_spall_source`,`bit_mix`,`is_save`,`createdby`,`createddate`,`modifiedby`,`modifieddate`,`isdeleted`,`temporary_trf_no`,`created_by_id`,`cc_identification_mark`,`chainage_no`,`fine_agg_type`,`fdd_desc_sample`,`trf_no`,`job_number`,`lab_no`,`ultra_qty`,`rebound_qty`,`tanker_no1`,`lot_no1`,`bitumin_grade1`,`bitumin_make1`) 
				values(
				'$select_material_category',
				'$select_material',
				'$finalmatno',
				'$select_location',
				'$sample_note',
				'$select_samp_condition',
				'$select_test',
				'$ex_date_submission',
				'$chkmorr',
				'$exel_radio',
				'$tested_by',
				'$reported_by',
				'$type_of_cement',
				'$cement_grade',
				'$cement_brand',
				'$week_no',
				'$brick_source',
				'$sample_de',
				'$mark',
				'$brick_specification',
				'$tanker_no',
				'$lot_no',
				'$bitumin_grade',
				'$make',
				'$cube_grade',
				'$day_remark',
				'$casting_date',
				'$day',
				'$set_of_cube',
				'$no_of_cube',
				'$shape',
				'$age',
				'$color',
				'$thickness',
				'$paver_grade',
				'$sample_type',
				'$soil_source',
				'$dia',
				'$steel_grade',
				'$steel_brand',
				'$tile_source',
				'$tiles_specification',
				'$brand',
				'$fine_agg_source',
				'$qa_spall_source',
				'$bitumin_mix',
				'0',
				'$_SESSION[name]',
				'$current_date',
				'',
				'$current_date',
				'0',
				'$temporary_trf_no',
				'$_SESSION[u_id]',
				'$cc_identification',
				'$chainage_no',
				'$fine_agg_type',
				'$fdd_desc_sample',
				'$txt_trf_no',
				'$txt_trf_no',
				'$labno',
				'$ultra_qty',
				'$rebound_qty',
				'$tanker_no1',
				'$lot_no1',
				'$bitumin_grade1',
				'$make1'
				)";
				$result_of_insert=mysqli_query($conn,$insert);
				
				}
				
			
				
	}
	elseif($_POST['action_type'] == 'add_material_assinging_for_test'){
       
				
				
				
				$labno= $_POST['labno'];
				$finalmatno= $_POST['finalmatno'];
				
				$txt_trf_no= $_POST['txt_trf_no'];
				$select_material_category= $_POST['select_material_category'];
				$select_material= $_POST['select_material'];
				$type_of_cement= $_POST['type_of_cement'];
				$cement_grade= $_POST['cement_grade'];
				$cement_brand= $_POST['cement_brand'];
				$week_no= $_POST['week_no'];
				$brick_source= $_POST['brick_source'];
				$sample_de= $_POST['sample_de'];
				$brick_specification= $_POST['brick_specification'];
				$mark= $_POST['mark'];
				$tanker_no= $_POST['tanker_no'];
				$lot_no= $_POST['lot_no'];
				$bitumin_grade= $_POST['bitumin_grade'];
				$make= $_POST['make'];
				
				$tanker_no1= $_POST['tanker_no1'];
				$lot_no1= $_POST['lot_no1'];
				$bitumin_grade1= $_POST['bitumin_grade1'];
				$make1= $_POST['make1'];
				
				$cube_grade= $_POST['cube_grade'];
				$day_remark= $_POST['day_remark'];
				$casting_date_submission= $_POST['casting_date'];
				$date_ex1_date_submission = str_replace('/', '-', $casting_date_submission);
				$casting_date =  date('Y-m-d', strtotime($date_ex1_date_submission));
				$day= $_POST['day'];
				$set_of_cube= $_POST['set_of_cube'];
				$no_of_cube= $_POST['no_of_cube'];
				$cc_identification= $_POST['cc_identification'];
				$chainage_nochainage_no= $_POST['chainage_no'];
				$fdd_desc_sample= $_POST['fdd_desc_sample'];
				$shape= $_POST['shape'];
				$age= $_POST['age'];
				$color= $_POST['color'];
				$thickness= $_POST['thickness'];
				$paver_grade= $_POST['paver_grade'];
				$sample_type= $_POST['sample_type'];
				$soil_source= $_POST['soil_source'];
				$dia= $_POST['dia'];
				$steel_grade= $_POST['steel_grade'];
				$steel_brand= $_POST['steel_brand'];
				$tile_source= $_POST['tile_source'];
				$tiles_specification= $_POST['tiles_specification'];
				$fine_agg_source= $_POST['fine_agg_source'];
				$fine_agg_type= $_POST['fine_agg_type'];
				$qa_spall_source= $_POST['qa_spall_source'];
				$brand= $_POST['brand'];
				$select_samp_condition= $_POST['select_samp_condition'];
				$select_location= $_POST['select_location'];
				$sample_note= $_POST['sample_note'];
				$bitumin_mix= $_POST['bitumin_mix'];
				$txt_is_sample= $_POST['txt_is_sample'];
				$current_date= date('Y-m-d');
				$ultra_qty= $_POST['ultra_qty'];
				$rebound_qty= $_POST['rebound_qty'];
				$tested_by= $_POST['tested_by'];
				$reported_by= $_POST['reported_by'];
				$var_ex_date_submission = $_POST['ex_date_submission'];
				$date_ex_date_submission = str_replace('/', '-', $var_ex_date_submission);
				$ex_date_submission =  date('Y-m-d', strtotime($date_ex_date_submission));
				
				$chkmorr= "d";
				$exel_radio= $_POST['exel_radio'];
				
				$select_test1= $_POST['select_test'];				
				$mul_data = explode(',', $select_test1); 
				foreach($mul_data as $select_test) //loop over values
				{
					//echo $value . PHP_EOL; //print value
				
				//select date of job for insert it in final_material_assign_master table
				$sel_job="select * from job where `trf_no`='$txt_trf_no'";
				$result_job_date=mysqli_query($conn,$sel_job);
				$get_job_result=mysqli_fetch_array($result_job_date);
				$job_inserted_date=$get_job_result["date"];
				$temporary_trf_no=$get_job_result["temporary_trf_no"];
				
				
				
					// get test from test master
					$sel_test="select * from test_master where `test_id`=".$select_test;
					$result_test=mysqli_query($conn,$sel_test);
					$get_test=mysqli_fetch_array($result_test);
					$test_rate=$get_test["test_rate"];
					
					$insert_test_wise="insert into test_wise_material_rate (`temporary_trf_no`,`trf_no`,`job_no`,`material_cat_id`,`material_id`,`final_material_id`,`test_id`,`qty`,`rate`,`amt`,`created_by`,`created_date`,`modified_by`,`modified_date`,`is_deleted`) 
						values(
						'$temporary_trf_no',
						'$txt_trf_no',
						'$txt_trf_no',
						'$select_material_category',
						'$select_material',
						'$finalmatno',
						'$select_test',
						'1',
						'$test_rate',
						'$test_rate',
						'$_SESSION[name]',
						'0000-00-00',
						'',
						'0000-00-00',
						'0')";
						$result_insert_test_wise=mysqli_query($conn,$insert_test_wise);
					
					$insert="insert into span_material_assign (`material_category`,`material_id`,`final_material_id`,`material_location`,`sample_note`,`material_condition`,`test`,`expected_date`,`morr`,`excel_upload`,`tested_by`,`reported_by`,`type_of_cement`,`cement_grade`,`cement_brand`,`week_number`,`agg_source`,`sample_de`,`brick_mark`,`brick_specification`,`tanker_no`,`lot_no`,`bitumin_grade`,`bitumin_make`,`cc_grade`,`day_remark`,`casting_date`,`cc_day`,`cc_set_of_cube`,`cc_no_of_cube`,`paver_shape`,`paver_age`,`paver_color`,`paver_thickness`,`paver_grade`,`soil_location`,`soil_source`,`steel_dia`,`steel_grade`,`steel_brand`,`water_source`,`water_specification`,`water_brand`,`fine_aggregate_source`,`quarry_spall_source`,`bit_mix`,`is_save`,`createdby`,`createddate`,`modifiedby`,`modifieddate`,`isdeleted`,`temporary_trf_no`,`created_by_id`,`cc_identification_mark`,`chainage_no`,`fine_agg_type`,`fdd_desc_sample`,`trf_no`,`job_number`,`lab_no`,`ultra_qty`,`rebound_qty`,`tanker_no1`,`lot_no1`,`bitumin_grade1`,`bitumin_make1`) 
				values(
				'$select_material_category',
				'$select_material',
				'$finalmatno',
				'$select_location',
				'$sample_note',
				'$select_samp_condition',
				'$select_test',
				'$ex_date_submission',
				'$chkmorr',
				'$exel_radio',
				'$tested_by',
				'$reported_by',
				'$type_of_cement',
				'$cement_grade',
				'$cement_brand',
				'$week_no',
				'$brick_source',
				'$sample_de',
				'$mark',
				'$brick_specification',
				'$tanker_no',
				'$lot_no',
				'$bitumin_grade',
				'$make',
				'$cube_grade',
				'$day_remark',
				'$casting_date',
				'$day',
				'$set_of_cube',
				'$no_of_cube',
				'$shape',
				'$age',
				'$color',
				'$thickness',
				'$paver_grade',
				'$sample_type',
				'$soil_source',
				'$dia',
				'$steel_grade',
				'$steel_brand',
				'$tile_source',
				'$tiles_specification',
				'$brand',
				'$fine_agg_source',
				'$qa_spall_source',
				'$bitumin_mix',
				'0',
				'$_SESSION[name]',
				'$current_date',
				'',
				'$current_date',
				'0',
				'$temporary_trf_no',
				'$_SESSION[u_id]',
				'$cc_identification',
				'$chainage_no',
				'$fine_agg_type',
				'$fdd_desc_sample',
				'$txt_trf_no',
				'$txt_trf_no',
				'$labno',
				'$ultra_qty',
				'$rebound_qty',
				'$tanker_no1',
				'$lot_no1',
				'$bitumin_grade1',
				'$make1')";
				$result_of_insert=mysqli_query($conn,$insert);
				
				}
				
			
				
	}
	elseif($_POST['action_type'] == 'add_material_assinging_save'){
		
				
				$y = $_POST['qty'];	
				
				$txt_trf_no= $_POST['txt_trf_no'];
				$txt_job_no= "";
				$select_material_category= $_POST['select_material_category'];
				$select_material= $_POST['select_material'];
				$txt_is_sample= $_POST['txt_is_sample'];
				
				
				$type_of_cement= explode(",",$_POST['type_of_cement']);
				$cement_grade= explode(",",$_POST['cement_grade']);
				$cement_brand= explode(",",$_POST['cement_brand']);
				$week_no= explode(",",$_POST['week_no']);
				$brick_source= explode(",",$_POST['brick_source']);
				$sample_de= explode(",",$_POST['sample_de']);
				$mark= explode(",",$_POST['mark']);
				$brick_specification= explode(",",$_POST['brick_specification']);
				$brick_size= explode(",",$_POST['brick_size']);
				
				$tanker_no= explode(",",$_POST['tanker_no']);
				$lot_no= explode(",",$_POST['lot_no']);
				$bitumin_grade= explode(",",$_POST['bitumin_grade']);
				$make= explode(",",$_POST['make']);
				
				$tanker_no1= explode(",",$_POST['tanker_no1']);
				$lot_no1= explode(",",$_POST['lot_no1']);
				$bitumin_grade1= explode(",",$_POST['bitumin_grade1']);
				$make1= explode(",",$_POST['make1']);
				
				
				$cube_grade= explode(",",$_POST['cube_grade']);
				$day_remark= explode(",",$_POST['day_remark']);
				$casting_date_submission= explode(",",$_POST['casting_date']);
						
				$day= explode(",",$_POST['day']);
				$set_of_cube= explode(",",$_POST['set_of_cube']);
				$no_of_cube= explode(",",$_POST['no_of_cube']);
				$cc_identification= explode(",",$_POST['cc_identification']);
				$chainage_no= explode(",",$_POST['chainage_no']);
				$fdd_desc_sample= explode(",",$_POST['fdd_desc_sample']);
				$fdd_qty= explode(",",$_POST['fdd_qty']);
				$shape= explode(",",$_POST['shape']);
				$age= explode(",",$_POST['age']);
				$color= explode(",",$_POST['color']);
				$thickness= explode(",",$_POST['thickness']);
				$paver_grade= explode(",",$_POST['paver_grade']);
				$sample_type= explode(",",$_POST['sample_type']);
				$soil_source= explode(",",$_POST['soil_source']);
				$dia= explode(",",$_POST['dia']);
				$steel_grade= explode(",",$_POST['steel_grade']);
				$steel_brand= explode(",",$_POST['steel_brand']);
				$steel_make= explode(",",$_POST['steel_make']);
				$steel_heat= explode(",",$_POST['steel_heat']);
				$steel_sample_qty= explode(",",$_POST['steel_sample_qty']);
				$tile_source= explode(",",$_POST['tile_source']);
				$tiles_specification= explode(",",$_POST['tiles_specification']);
				$fine_agg_source= explode(",",$_POST['fine_agg_source']);
				$fine_agg_type= explode(",",$_POST['fine_agg_type']);
				$qa_spall_source= explode(",",$_POST['qa_spall_source']);
				$brand= explode(",",$_POST['brand']);
				$bitumin_mix= explode(",",$_POST['bitumin_mix']);
				
				$core_qty= explode(",",$_POST['core_qty']);
				$bitu_qty= explode(",",$_POST['bitu_qty']);
				$ultra_qty= explode(",",$_POST['ultra_qty']);
				$rebound_qty= explode(",",$_POST['rebound_qty']);
				$carbo_qty= explode(",",$_POST['carbo_qty']);
				$c_thick_qty= explode(",",$_POST['c_thick_qty']);
				$half_cell_qty= explode(",",$_POST['half_cell_qty']);
				$pile_qty= explode(",",$_POST['pile_qty']);
				$pull_qty= explode(",",$_POST['pull_qty']);
				$cc_qty= explode(",",$_POST['cc_qty']);
				$steel_set_qty= $_POST['steel_set_qty'];
				$steel_source_name= $_POST['steel_source_name'];
				
				
				$grd_zone= explode(",",$_POST['grd_zone']);
				$in_l= explode(",",$_POST['in_l']);
				$in_w= explode(",",$_POST['in_w']);
				$in_h= explode(",",$_POST['in_h']);
				$in_den= explode(",",$_POST['in_den']);
				$in_grade= explode(",",$_POST['in_grade']);
				$inl= explode(",",$_POST['inl']);
				$inw= explode(",",$_POST['inw']);
				$inh= explode(",",$_POST['inh']);
				$inden= explode(",",$_POST['inden']);
				$ingrade= explode(",",$_POST['ingrade']);
				$excel_description= explode(",",$_POST['excel_description']);
				$excel_qty= explode(",",$_POST['excel_qty']);
				
				
				//qty condition only for steel material
				
				if($select_material_category=="10" && ($select_material=="135" || $select_material=="212" || $select_material=="216" || $select_material=="240" || $select_material=="241" || $select_material=="242" || $select_material=="243" || $select_material=="244" || $select_material=="246"))
				{
					$dia=array($_POST['dia']);
					$steel_grade=array($_POST['steel_grade']);
					$steel_brand=array($_POST['steel_brand']);
					$steel_heat=array($_POST['steel_heat']);
					$steel_sample_qty=array($_POST['steel_sample_qty']);
				}
				//qty condition only for fdd material
				
				if($select_material_category=="20" && $select_material=="172")
				{
					$chainage_no=array($_POST['chainage_no']);
					$fdd_desc_sample=array($_POST['fdd_desc_sample']);
					$fdd_qty=array($_POST['fdd_qty']);
				}
				
				
				for ($x = 0; $x < $y; $x++) {
					
				$var_expected_date = $_POST['ex_date_submission'];
				$date_expected_date = str_replace('/', '-', $var_expected_date);
				$expected_date =  date('Y-m-d', strtotime($date_expected_date));
				$current_date =  date('Y-m-d');
				
				 //select date of job for insert it in final_material_assign_master table
				 $sel_job="select * from job where `temporary_trf_no`='$txt_trf_no'";
				 $result_job_date=mysqli_query($conn,$sel_job);
				 $get_job_result=mysqli_fetch_array($result_job_date);
				 $job_inserted_date=$get_job_result["date"];
				 $rec_sam_date=$get_job_result["sample_rec_date"];
				 $nabl_type=$get_job_result["nabl_type"];
				
				$insertas="insert into final_material_assign_master (`material_category`,`material_id`,`expected_date`,`temporary_trf_no`,`is_status`,`created_by`,`created_by_id`,`created_date`,`modified_by`,`modified_date`,`is_deleted`,`job_date`,`is_sample`,`steel_set_qty`,`rec_sam_date`,`steel_source_name`,`nabl_type`) 
				values(
				'$select_material_category',
				'$select_material',
				'$expected_date',
				'$txt_trf_no',
				'1',
				'$_SESSION[name]',
				'$_SESSION[u_id]',
				'$current_date',
				'',
				'$current_date',
				'0',
				'$current_date',
				'$txt_is_sample',
				'$steel_set_qty',
				'$rec_sam_date',
				'$steel_source_name',
				'$nabl_type')";
				//$result_of_insert=mysqli_query($conn,$insertas);
					if (mysqli_query($conn, $insertas)) 
					{
						$get_final_mate_id = mysqli_insert_id($conn);
					}else
					{
						$get_final_mate_id;
						
					}
				//}
				
					
				
				$select_test1= $_POST['select_test'];				
				$mul_data = explode(',', $select_test1); 
				foreach($mul_data as $keyes => $select_test) //loop over values
				{
					
					// get from test wise master
				    $tt_op = "select * from span_material_assign where `final_material_id`='$get_final_mate_id' AND test='$select_test'";
					$dtas = mysqli_query($conn,$tt_op);
					
					if (mysqli_num_rows($dtas) != 0) 
					{
							
					}
					else
					{
						
						$date_ex1_date_submission = str_replace('/', '-', $casting_date_submission[$x]);
						$casting_date =  date('Y-m-d', strtotime($date_ex1_date_submission));
						
						
						$tested_by= $_POST['tested_by'];
						$reported_by= $_POST['reported_by'];
						$select_samp_condition= $_POST['select_samp_condition'];
						$select_location= $_POST['select_location'];
						$sample_note= $_POST['sample_note'];
						
						$r_type_of_cement= str_replace ("|", ",", $type_of_cement[$x]);
						$r_cement_grade= str_replace ("|", ",", $cement_grade[$x]);
						$r_cement_brand= str_replace ("|", ",", $cement_brand[$x]);
						$r_week_no= str_replace ("|", ",", $week_no[$x]);
						$r_brick_source= str_replace ("|", ",", $brick_source[$x]);
						$r_sample_de= str_replace ("|", ",", $sample_de[$x]);
						$r_mark= str_replace ("|", ",", $mark[$x]);
						$r_brick_specification= str_replace ("|", ",", $brick_specification[$x]);
						
						$r_tanker_no= str_replace ("|", ",", $tanker_no[$x]);
						$r_lot_no= str_replace ("|", ",", $lot_no[$x]);
						$r_bitumin_grade= str_replace ("|", ",", $bitumin_grade[$x]);
						$r_make= str_replace ("|", ",", $make[$x]);
						
						$r_tanker_no1= str_replace ("|", ",", $tanker_no1[$x]);
						$r_lot_no1= str_replace ("|", ",", $lot_no1[$x]);
						$r_bitumin_grade1= str_replace ("|", ",", $bitumin_grade1[$x]);
						$r_make1= str_replace ("|", ",", $make1[$x]);
						
						
						$r_cube_grade= str_replace ("|", ",", $cube_grade[$x]);
						$r_day_remark= str_replace ("|", ",", $day_remark[$x]);
						$r_day= str_replace ("|", ",", $day[$x]);
						$r_set_of_cube= str_replace ("|", ",", $set_of_cube[$x]);
						$r_no_of_cube= str_replace ("|", ",", $no_of_cube[$x]);
						$r_shape= str_replace ("|", ",", $shape[$x]);
						$r_age= str_replace ("|", ",", $age[$x]);
						$r_color= str_replace ("|", ",", $color[$x]);
						$r_thickness= str_replace ("|", ",", $thickness[$x]);
						$r_paver_grade= str_replace ("|", ",", $paver_grade[$x]);
						$r_sample_type= str_replace ("|", ",", $sample_type[$x]);
						$r_soil_source= str_replace ("|", ",", $soil_source[$x]);
						$r_dia= str_replace ("|", ",", $dia[$x]);
						$r_steel_grade= str_replace ("|", ",", $steel_grade[$x]);
						$r_steel_brand= str_replace ("|", ",", $steel_brand[$x]);
						$r_steel_heat= str_replace ("|", ",", $steel_heat[$x]);
						$r_steel_sample_qty= str_replace ("|", ",", $steel_sample_qty[$x]);
						$r_tile_source= str_replace ("|", ",", $tile_source[$x]);
						$r_tiles_specification= str_replace ("|", ",", $tiles_specification[$x]);
						$r_brand= str_replace ("|", ",", $brand[$x]);
						$r_fine_agg_source= str_replace ("|", ",", $fine_agg_source[$x]);
						$r_qa_spall_source= str_replace ("|", ",", $qa_spall_source[$x]);
						$r_bitumin_mix= str_replace ("|", ",", $bitumin_mix[$x]);
						$r_core_qty= str_replace ("|", ",", $core_qty[$x]);
						$r_bitu_qty= str_replace ("|", ",", $bitu_qty[$x]);
						$r_ultra_qty= str_replace ("|", ",", $ultra_qty[$x]);
						$r_rebound_qty= str_replace ("|", ",", $rebound_qty[$x]);
						$r_carbo_qty= str_replace ("|", ",", $carbo_qty[$x]);
						$r_c_thick_qty= str_replace ("|", ",", $c_thick_qty[$x]);
						$r_half_cell_qty= str_replace ("|", ",", $half_cell_qty[$x]);
						$r_pile_qty= str_replace ("|", ",", $pile_qty[$x]);
						$r_pull_qty= str_replace ("|", ",", $pull_qty[$x]);
						$r_cc_identification= str_replace ("|", ",", $cc_identification[$x]);
						$r_chainage_no= str_replace ("|", ",", $chainage_no[$x]);
						$r_fine_agg_type= str_replace ("|", ",", $fine_agg_type[$x]);
						$r_fdd_desc_sample= str_replace ("|", ",", $fdd_desc_sample[$x]);
						$r_fdd_qty= str_replace ("|", ",", $fdd_qty[$x]);
						$r_cc_qty= str_replace ("|", ",", $cc_qty[$x]);
						$r_grd_zone= str_replace ("|", ",", $grd_zone[$x]);
						$r_in_l= str_replace ("|", ",", $in_l[$x]);
						$r_in_w= str_replace ("|", ",", $in_w[$x]);
						$r_in_h= str_replace ("|", ",", $in_h[$x]);
						$r_in_den= str_replace ("|", ",", $in_den[$x]);
						$r_in_grade= str_replace ("|", ",", $in_grade[$x]);
						$r_inl= str_replace ("|", ",", $inl[$x]);
						$r_inw= str_replace ("|", ",", $inw[$x]);
						$r_inh= str_replace ("|", ",", $inh[$x]);
						$r_inden= str_replace ("|", ",", $inden[$x]);
						$r_ingrade= str_replace ("|", ",", $ingrade[$x]);
						$r_brick_size= str_replace ("|", ",", $brick_size[$x]);
						$r_excel_description= str_replace ("|", ",", $excel_description[$x]);
						$r_excel_qty= str_replace ("|", ",", $excel_qty[$x]);
						
					$insert_uu="insert into span_material_assign (`material_category`,`material_id`,`final_material_id`,`material_location`,`sample_note`,`material_condition`,`test`,`expected_date`,`morr`,`excel_upload`,`tested_by`,`reported_by`,`type_of_cement`,`cement_grade`,`cement_brand`,`week_number`,`agg_source`,`sample_de`,`brick_mark`,`brick_specification`,`tanker_no`,`lot_no`,`bitumin_grade`,`bitumin_make`,`cc_grade`,`day_remark`,`cc_day`,`cc_set_of_cube`,`cc_no_of_cube`,`paver_shape`,`paver_age`,`paver_color`,`paver_thickness`,`paver_grade`,`soil_location`,`soil_source`,`steel_dia`,`steel_grade`,`steel_brand`,`steel_heat`,`steel_sample_qty`,`water_source`,`water_specification`,`water_brand`,`fine_aggregate_source`,`quarry_spall_source`,`bit_mix`,`core_qty`,`bitu_qty`,`ultra_qty`,`rebound_qty`,`carbo_qty`,`c_thick_qty`,`half_cell_qty`,`pile_qty`,`pull_qty`,`is_save`,`createdby`,`createddate`,`modifiedby`,`modifieddate`,`isdeleted`,`temporary_trf_no`,`created_by_id`,`cc_identification_mark`,`chainage_no`,`fine_agg_type`,`fdd_desc_sample`,`fdd_qty`,`cc_qty`,`casting_date`,`grd_zone`,`in_l`,`in_w`,`in_h`,`in_den`,`in_grade`,`inl`,`inw`,`inh`,`inden`,`ingrade`,`steel_source_name`,`brick_size`,`excel_description`,`excel_qty`,`bitumin_make1`,`bitumin_grade1`,`lot_no1`,`tanker_no1`) 
						values(
						'$select_material_category',
						'$select_material',
						'$get_final_mate_id',
						'$select_location',
						'$sample_note',
						'$select_samp_condition',
						'$select_test',
						'$expected_date',
						'r',
						'$exel_radio',
						'$tested_by',
						'$reported_by',
						'$r_type_of_cement',
						'$r_cement_grade',
						'$r_cement_brand',
						'$r_week_no',
						'$r_brick_source',
						'$r_sample_de',
						'$r_mark',
						'$r_brick_specification',
						'$r_tanker_no',
						'$r_lot_no',
						'$r_bitumin_grade',
						'$r_make',
						'$r_cube_grade',
						'$r_day_remark',
						'$r_day',
						'$r_set_of_cube',
						'$r_no_of_cube',
						'$r_shape',
						'$r_age',
						'$r_color',
						'$r_thickness',
						'$r_paver_grade',
						'$r_sample_type',
						'$r_soil_source',
						'$r_dia',
						'$r_steel_grade',
						'$r_steel_brand',
						'$r_steel_heat',
						'$r_steel_sample_qty',
						'$r_tile_source',
						'$r_tiles_specification',
						'$r_brand',
						'$r_fine_agg_source',
						'$r_qa_spall_source',
						'$r_bitumin_mix',
						'$r_core_qty',
						'$r_bitu_qty',
						'$r_ultra_qty',
						'$r_rebound_qty',
						'$r_carbo_qty',
						'$r_c_thick_qty',
						'$r_half_cell_qty',
						'$r_pile_qty',
						'$r_pull_qty',
						'1',
						'$_SESSION[name]',
						'$current_date',
						'',
						'$current_date',
						'0',
						'$txt_trf_no',
						'$_SESSION[u_id]',
						'$r_cc_identification',
						'$r_chainage_no',
						'$r_fine_agg_type',
						'$r_fdd_desc_sample',
						'$r_fdd_qty',
						'$r_cc_qty',
						'$casting_date',
						'$r_grd_zone',
						'$r_in_l',
						'$r_in_w',
						'$r_in_h',
						'$r_in_den',
						'$r_in_grade',
						'$r_inl',
						'$r_inw',
						'$r_inh',
						'$r_inden',
						'$r_ingrade',
						'$steel_source_name',
						'$r_brick_size',
						'$r_excel_description',
						'$r_excel_qty',
						'$r_make1',
						'$r_bitumin_grade1',
						'$r_lot_no1',
						'$r_tanker_no1'						
						)";
						$result_of_insert_datass=mysqli_query($conn,$insert_uu);
						
					}
				
				
				
				
				
				
				
				$current_date= date('Y-m-d');
				
				$tested_by= $_POST['tested_by'];
				$reported_by= $_POST['reported_by'];
				$var_ex_date_submission = $_POST['ex_date_submission'];
				$date_ex_date_submission = str_replace('/', '-', $var_ex_date_submission);
				$ex_date_submission =  date('Y-m-d', strtotime($date_ex_date_submission));
				
				$chkmorr= $_POST['chkmorr'];
				$exel_radio= $_POST['exel_radio'];
				
					// get test from test master
					$sel_test="select * from test_master where `test_id`=".$select_test;
					$result_test=mysqli_query($conn,$sel_test);
					$get_test=mysqli_fetch_array($result_test);
					$test_rate=$get_test["test_rate"];
					
					
					$insert_test_wise="insert into test_wise_material_rate (`temporary_trf_no`,`material_cat_id`,`material_id`,`final_material_id`,`test_id`,`qty`,`rate`,`amt`,`created_by`,`created_date`,`modified_by`,`modified_date`,`is_deleted`) 
						values(
						'$txt_trf_no',
						'$select_material_category',
						'$select_material',
						'$get_final_mate_id',
						'$select_test',
						'1',
						'$test_rate',
						'$test_rate',
						'$_SESSION[name]',
						'0000-00-00',
						'',
						'0000-00-00',
						'0')";
						$result_test_wise=mysqli_query($conn,$insert_test_wise);
				
				}
				
			}
				
		
	   
    }
	elseif($_POST['action_type'] == 'delete_particular_material'){
       
				$select_final=explode("|",$_POST['id']);
				$get_lab_no=$select_final[0];
				$get_jobs_no=$select_final[1];
				$get_reports_no=$select_final[2];
				$final_material_id=$select_final[3];
				// get data from span_material_assign table
				$sel_span="select * from span_material_assign where `report_no`='$get_reports_no' AND `job_number`='$get_jobs_no' AND `lab_no`='$get_lab_no'";
				$result_of_span=mysqli_query($conn,$sel_span);
				
				if( mysqli_num_rows($result_of_span) >0){
						
					while($rows=mysqli_fetch_array($result_of_span))
					{
						$get_tests=$rows["test"];
						//get data test_wise_material_rate by span table test id
						$sel_test_wise="select * from test_wise_material_rate where `test_id`='$get_tests'";
						$result_test_wise=mysqli_query($conn,$sel_test_wise);
						
						if (mysqli_num_rows($result_test_wise) > 0) 
						{
							$get_test_wise=mysqli_fetch_array($result_test_wise);
							
							$get_qty= $get_test_wise["qty"];
							$set_qty= $get_qty - 1;
							
							$test_rate=$get_test_wise["rate"];
							
							$get_amt= $get_test_wise["amt"];
							$set_amt= $get_amt - $test_rate;
							
							$update_test_wise="update test_wise_material_rate set `qty`='$set_qty',`amt`='$set_amt' where `test_id`='$get_tests'";
							$result_update_test_wise=mysqli_query($conn,$update_test_wise);
						}
						
						
						//delete row from span table
						$span_material_assign_id=$rows["material_assign_id"];
						$delete_span_row="delete from span_material_assign where `material_assign_id`=".$span_material_assign_id;
						$result_span_delete=mysqli_query($conn,$delete_span_row);
						
						
					}	
					
				}
				
						//delete particular material with all tests
						
						$delete_final_table_row="delete from final_material_assign_master where `final_material_id`=".$final_material_id;
						$result_final_delete=mysqli_query($conn,$delete_final_table_row);
				
				
		
	   
    }
	elseif($_POST['action_type'] == 'delete_material'){
       
				$select_test=explode("|",$_POST['id']);
				
				// get test from test master
					$sel_test="select * from test_master where `test_id`=".$select_test[1];
					$result_test=mysqli_query($conn,$sel_test);
					$get_test=mysqli_fetch_array($result_test);
					$test_rate=$get_test["test_rate"];
					
					
					// get from test wise master
					$sel_test_wise="select * from test_wise_material_rate where `test_id`='$select_test[1]'";
					$result_test_wise=mysqli_query($conn,$sel_test_wise);
					
					
					if (mysqli_num_rows($result_test_wise) > 0) 
					{
						$get_test_wise=mysqli_fetch_array($result_test_wise);
						
						$get_qty= $get_test_wise["qty"];
						$set_qty= $get_qty - 1;
						
						$get_amt= $get_test_wise["amt"];
						$set_amt= $get_amt - $test_rate;
						
						$update_test_wise="update test_wise_material_rate set `qty`='$set_qty',`amt`='$set_amt' where `test_id`='$select_test[1]'";
						$result_update_test_wise=mysqli_query($conn,$update_test_wise);
					}
				
				
				
				
				
				$id= $select_test[0];
				$delete_assign_mate="delete from span_material_assign  WHERE material_assign_id=".$id;
				$result_of_delete=mysqli_query($conn,$delete_assign_mate);
				
				
				
		
	   
    }else if($_POST['action_type'] == 'get_span_assign'){
		
	?>
		<table class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										<th style="text-align:center;">Material Category</th>
										<th style="text-align:center;">Material</th>
										<th style="text-align:center;">Test</th>
										<!--<th style="text-align:center;">Action</th>-->
									</tr>
										
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from span_material_assign WHERE `is_save`=0 AND `isdeleted`=0 AND `temporary_trf_no`='$_POST[temporary_trf_no]' AND `created_by_id`='$_SESSION[u_id]' ORDER BY material_assign_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											
										$sel_test="select * from test_master where `test_id`=".$row['test'];
										$result_test=mysqli_query($conn,$sel_test);
										$row_test=mysqli_fetch_array($result_test);
										
										$sel_cate="select * from material_category where `material_cat_id`=".$row['material_category'];
										$result_cat=mysqli_query($conn,$sel_cate);
										$row_cat=mysqli_fetch_array($result_cat);
										
										$sel_mat="select * from material where `id`=".$row['material_id'];
										$result_mat=mysqli_query($conn,$sel_mat);
										$row_mat=mysqli_fetch_array($result_mat);
										
										
									?>
										<tr>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_cat['material_cat_name'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_mat['mt_name'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_test['test_name'];?></td>
											
										</tr>
									<?php
										}	
									?>
								</tbody>
								
							  </table>
		
	<?php 	
	}else if($_POST['action_type'] == 'get_span_assign_in_edit'){
		$get_lab_no=$_POST["txt_lab_no"];
		$get_jobs_nos=substr($_POST["txt_job_no"],7);
	?>
		<input type="hidden" name="hidden_lab_no" id="hidden_lab_no" value="<?php echo $_POST['txt_hidden_lab_id'];?>">
		<table class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										<th style="text-align:center;">Test Name</th>
										<th style="text-align:center;">Lab No</th>
										<th style="text-align:center;">Action</th>
									</tr>
										
								</thead>
								<tbody>
									<?php
										$count=0;
										 $query="select * from span_material_assign WHERE `isdeleted`=0 AND `job_number`='$get_jobs_nos' AND `lab_no`='$_POST[txt_hidden_lab_id]' ORDER BY material_assign_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											
										$sel_test="select * from test_master where `test_id`=".$row['test'];
										$result_test=mysqli_query($conn,$sel_test);
										$row_test=mysqli_fetch_array($result_test);
										
										
									?>
										<tr>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_test['test_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['lab_no'];?></td>
											<td style="text-align:center;">
											<?php $to_pass=$row['material_assign_id']."|".$row['test'];?>
												<button type="button" class="btn btn-info"  onclick="addData('delete_material','<?php echo $to_pass?>')" name="btn_add_data" style="width:100px;font-size:20px;" >Delete</button>
											</td>
										</tr>
									<?php
										}	
									?>
								</tbody>
								
							  </table>
		
	<?php 	
	}else if($_POST['action_type'] == 'get_span_assign_after_save'){
		
	?>
		<table class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Material Category</th>
										<th style="text-align:center;">Material</th>
										<th style="text-align:center;">Action</th>
										<!--<th style="text-align:center;">Action</th>-->
									</tr>
										
								</thead>
								<tbody>
									<?php
									
									    $update_span_material="update span_material_assign set `is_save`='1' where `temporary_trf_no`='$_POST[temporary_trf_no]' AND `created_by_id`='$_SESSION[u_id]'";
										$result_span_material=mysqli_query($conn,$update_span_material);
										
										
										
										$count=1;
										$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `temporary_trf_no`='$_POST[temporary_trf_no]' AND `created_by_id`='$_SESSION[u_id]' ORDER BY final_material_id DESC";
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
										<tr id="tr_<?php echo $row['final_material_id'];?>">
										<td style="white-space:nowrap;text-align:center;"><?php echo $count;?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_cat['material_cat_name'];?></td>
										<td style="white-space:nowrap;text-align:center;">
										<!--<a href="test_list.php?codes=<?php //echo base64_encode($row['final_material_id']."|".$row['temporary_trf_no']."|".$row_mat['mt_name']);?>" target="_blank">
										</a>-->
										<?php echo $row_mat['mt_name'];?>
										</td>
										<td style="text-align:center;">
											<button type="button" class="btn btn-danger delete_final_entry"  id="<?php echo $row['final_material_id']."|".$row['temporary_trf_no'];?>" name="btn_add_data" style="width:100px;font-size:16px;" >Delete</button>
										</td>
										</tr>
									<?php
									     $count++;
										}	
									?>
								</tbody>
								
							  </table>
		
	<?php 	
	}
	else if($_POST['action_type'] == 'get_span_set_sam_rec_date'){
		
		$temporary_trf_no=$_POST["temporary_trf_no"];
		$first=$_POST["first"];
		$second=$_POST["second"];
		$sel_sam_rec_date="select `sample_rec_date` from job where `temporary_trf_no`='$temporary_trf_no'";
		$result=mysqli_query($conn,$sel_sam_rec_date);
		if(mysqli_num_rows($result)>0)
		{
			if($second =="onload")
			{
				$row_records=mysqli_fetch_array($result);
				echo $get_rec_sam_date= date('d/m/Y',strtotime($row_records["sample_rec_date"]));
			}
			if($second =="changes")
			{
				$row_records=mysqli_fetch_array($result);
				 $startdate=date('Y-m-d',strtotime($row_records["sample_rec_date"]));
				 $set_date=date('Y-m-d', strtotime($startdate. ' + '.$first.' days'));
				echo $get_rec_sam_date= date('d/m/Y',strtotime($set_date));
			}
			
		}
		
		
	}else if($_POST['action_type'] == 'apply_ulr_no'){
		
		$counts_of_final_material=$_POST["counts_of_final_material"];
		$sel_ulr_no="select * from ulr_sequence where `ulr_from_type_id_fix`!='3' ORDER BY ulr_sequence_id DESC";
		$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
		if(mysqli_num_rows($query_ulr_no)>0)
		{
			$result_ulr_no=mysqli_fetch_array($query_ulr_no);
			$ulr_sequence_plused= intval($result_ulr_no["ulr_sequence"]) + 1;
		}
		else
		{
			$ulr_sequence_plused=1;
		}
		
		$set_ulr_array=array();
		for($i=1;$i<=$counts_of_final_material;$i++)
		{
			array_push($set_ulr_array,$ulr_sequence_plused);
			$ulr_sequence_plused++;
		}
		$fill=array("set_ulr_array"=>$set_ulr_array);	
		echo json_encode($fill);
		
	}else if($_POST['action_type'] == 'check_by_own_ulr'){
		
		$counts_of_final_material=$_POST["counts_of_final_material"];
		$txt_url=$_POST["txt_url"];
		$limit_of_material= intval($txt_url)+intval($counts_of_final_material);
		$errors=0;
		for($i=$txt_url;$i<=$limit_of_material;$i++)
		{
			$sel_ulr_no="select * from ulr_sequence where `ulr_sequence`='$i' ORDER BY ulr_sequence_id DESC";
				$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
				if(mysqli_num_rows($query_ulr_no)==0)
				{
					$errors= $errors+ 0;
				}else{
					$errors= $errors+ 1;
				}
		}
			$ulr_counts=0;
			$sel_last_of_ulr="select * from ulr_sequence ORDER BY ulr_sequence_id DESC";
			$query_last_of_ulr=mysqli_query($conn,$sel_last_of_ulr);
			if(mysqli_num_rows($query_last_of_ulr) > 0)
			{
				$result_last_of_ulr=mysqli_fetch_assoc($query_last_of_ulr);
				$get_last_ulr_no= intval($result_last_of_ulr["ulr_sequence"]);
				$ulr_counts= intval($get_last_ulr_no)+1;
			}				
				$fill=array("set_status"=>$errors,"ulr_counts"=> $ulr_counts);
				echo json_encode($fill);
		
	}else if($_POST['action_type'] == 'chk_and_save'){
		
		$txt_sam_rec_date=$_POST["txt_sam_rec_date"];
		$final_mate_id_array=$_POST["final_mate_id_array"];
		$url_array=$_POST["url_array"];
		$is_own=$_POST["is_own"];
		$current_date= date('Y-m-d');
		
		$explode_ulr_array=explode(",",$url_array);
		$explode_mate_id_array=explode(",",$final_mate_id_array);
		
		
		$error_status=0;
		// own ulr no so check it
		if($is_own=="yes")
		{
			$error_status=0;
			// check if ulr is usable from start to ahead..? 
			foreach($explode_ulr_array as $keyed => $one_ulr_no)
			{
				$sel_ulr_no="select * from ulr_sequence where `ulr_sequence`='$one_ulr_no' ORDER BY ulr_sequence_id DESC";
				$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
				if(mysqli_num_rows($query_ulr_no)==0)
				{
					$error_status= $error_status+ 0;
				}else{
					$error_status= $error_status+ 1;
				}
			}
			
			// check if ulr is usable from start to last entry of ulr_sequence table..?
			$sel_last_of_ulr="select * from ulr_sequence ORDER BY ulr_sequence_id DESC";
			$query_last_of_ulr=mysqli_query($conn,$sel_last_of_ulr);
			if(mysqli_num_rows($query_last_of_ulr) > 0)
			{
				$result_last_of_ulr=mysqli_fetch_assoc($query_last_of_ulr);
				$get_last_ulr_no= intval($result_last_of_ulr["ulr_sequence"]);
				$first_of_ulr_no= $explode_ulr_array[0];
				$plus_one= intval($get_last_ulr_no)+ 1;
				
				for($i=$plus_one;$i<$first_of_ulr_no;$i++)
				{
					$sel_ulr_no="select * from ulr_sequence where `ulr_sequence`='$i' ORDER BY ulr_sequence_id DESC";
					$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
					if(mysqli_num_rows($query_ulr_no)==0)
					{
						$error_status= $error_status+ 0;
					}else{
						$error_status= $error_status+ 1;
					}
				}
			}else{
				$error_status= $error_status+ 0;
			}
			if($error_status==0)
			{
				
				//if no any error so insert reserve data in sequence table
				$sel_last_of_ulr="select * from ulr_sequence ORDER BY ulr_sequence_id DESC";
				$query_last_of_ulr=mysqli_query($conn,$sel_last_of_ulr);
				if(mysqli_num_rows($query_last_of_ulr) > 0)
				{
					$result_last_of_ulr=mysqli_fetch_assoc($query_last_of_ulr);
					$get_last_ulr_no= intval($result_last_of_ulr["ulr_sequence"]);
					$first_of_ulr_no= $explode_ulr_array[0];
					$plus_one= intval($get_last_ulr_no)+ 1;
					
					for($i=$plus_one;$i<$first_of_ulr_no;$i++)
					{
						$insert_ulr="insert into ulr_sequence (`ulr_sequence`,`ulr_sequence_date`,`table_primary_key_id`,`ulr_from_type_id_fix`,`created_date`,`created_by`,`modified_date`,`modified_by`,`company_year_id`,`company_id`) 
						values(
						'0',
						'$txt_sam_rec_date',
						'0',
						'3',
						'$current_date',
						'$_SESSION[u_id]',
						'$current_date',
						'$_SESSION[u_id]',
						'1',
						'1')";
						mysqli_query($conn,$insert_ulr);
					}
				}
				
				
				foreach($explode_ulr_array as $keyed => $one_ulr_no)
				{
					$insert_ulr="insert into ulr_sequence (`ulr_sequence`,`ulr_sequence_date`,`table_primary_key_id`,`ulr_from_type_id_fix`,`created_date`,`created_by`,`modified_date`,`modified_by`,`company_year_id`,`company_id`) 
					values(
					'$one_ulr_no',
					'$txt_sam_rec_date',
					'$explode_mate_id_array[$keyed]',
					'2',
					'$current_date',
					'$_SESSION[u_id]',
					'$current_date',
					'$_SESSION[u_id]',
					'1',
					'1')";
					mysqli_query($conn,$insert_ulr);
					
					$update_final_table="update final_material_assign_master set `ulr_no`='$one_ulr_no' where `final_material_id`=".$explode_mate_id_array[$keyed];
					mysqli_query($conn,$update_final_table);
				}
					$fill=array("set_status"=>"1","msg"=>"Successfully Saved");
			}
			else
			{
					$fill=array("set_status"=>"0","msg"=>"Something went wrong");
			}
		}
		if($is_own=="no")
		{
			$error_status=0;
			foreach($explode_ulr_array as $keyed => $one_ulr_no)
			{
				$sel_ulr_no="select * from ulr_sequence where `ulr_sequence`='$one_ulr_no' ORDER BY ulr_sequence_id DESC";
				$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
				if(mysqli_num_rows($query_ulr_no)==0)
				{
					$error_status= $error_status+ 0;
				}else{
					$error_status= $error_status+ 1;
			}
			}
		
			if($error_status==0)
			{
				foreach($explode_ulr_array as $keyed => $one_ulr_no)
				{
					$insert_ulr="insert into ulr_sequence (`ulr_sequence`,`ulr_sequence_date`,`table_primary_key_id`,`ulr_from_type_id_fix`,`created_date`,`created_by`,`modified_date`,`modified_by`,`company_year_id`,`company_id`) 
				values(
				'$one_ulr_no',
				'$txt_sam_rec_date',
				'$explode_mate_id_array[$keyed]',
				'2',
				'$current_date',
				'$_SESSION[u_id]',
				'$current_date',
				'$_SESSION[u_id]',
				'1',
				'1')";
					mysqli_query($conn,$insert_ulr);
				
					$update_final_table="update final_material_assign_master set `ulr_no`='$one_ulr_no' where `final_material_id`=".$explode_mate_id_array[$keyed];
					mysqli_query($conn,$update_final_table);
				}
					$fill=array("set_status"=>"1","msg"=>"Successfully Saved");
			}
			else
			{
			        $fill=array("set_status"=>"0","msg"=>"Something went wrong");
			}
		}
		
		if($is_own=="reserve")
		{
			$error_status=0;
			foreach($explode_ulr_array as $keyed => $one_ulr_no)
			{
				$sel_ulr_no="select * from ulr_sequence where `ulr_sequence`='$one_ulr_no' AND `ulr_from_type_id_fix`='3' ORDER BY ulr_sequence_id DESC";
				$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
				if(mysqli_num_rows($query_ulr_no)> 0)
				{
					$result_ulrs=mysqli_fetch_assoc($query_ulr_no);
					if($result_ulrs["ulr_from_type_id_fix"]=="3")
					{
					  $error_status= $error_status+ 0;
					}
					else
					{
						$error_status= $error_status+ 1;
					}
				}else{
					$error_status= $error_status+ 0;
			    }
			}
		
			if($error_status==0)
			{
				foreach($explode_ulr_array as $keyed => $one_ulr_no)
				{
					//if reserve so update otherwise insert
					$sel_ulr_no="select * from ulr_sequence where `ulr_sequence`='$one_ulr_no' AND `ulr_from_type_id_fix`='3' ORDER BY ulr_sequence_id DESC";
					$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
					if(mysqli_num_rows($query_ulr_no) > 0)
					{
						$update_ulrs="update ulr_sequence set `ulr_from_type_id_fix`='2',`created_date`='$current_date' where `ulr_sequence`='$one_ulr_no'";
						mysqli_query($conn,$update_ulrs);
					}else
					{
						$insert_ulr="insert into ulr_sequence (`ulr_sequence`,`ulr_sequence_date`,`table_primary_key_id`,`ulr_from_type_id_fix`,`created_date`,`created_by`,`modified_date`,`modified_by`,`company_year_id`,`company_id`) 
						values(
						'$one_ulr_no',
						'$txt_sam_rec_date',
						'$explode_mate_id_array[$keyed]',
						'2',
						'$current_date',
						'$_SESSION[u_id]',
						'$current_date',
						'$_SESSION[u_id]',
						'1',
						'1')";
					mysqli_query($conn,$insert_ulr);
					}
					
					$update_final_table="update final_material_assign_master set `ulr_no`='$one_ulr_no' where `final_material_id`=".$explode_mate_id_array[$keyed];
					mysqli_query($conn,$update_final_table);
				}
					$fill=array("set_status"=>"1","msg"=>"Successfully Saved");
			}
			else
			{
			        $fill=array("set_status"=>"0","msg"=>"Something went wrong");
			}
		}
		
		
				echo json_encode($fill);
		
	}
	else if($_POST['action_type'] == 'get_span_set_sam_rec_date_for_edit'){
		
		$temporary_trf_no=$_POST["temporary_trf_no"];
		$first=$_POST["first"];
		$second=$_POST["second"];
		$sel_sam_rec_date="select `sample_rec_date` from job where `trf_no`='$temporary_trf_no'";
		$result=mysqli_query($conn,$sel_sam_rec_date);
		if(mysqli_num_rows($result)>0)
		{
			if($second =="onload")
			{
				$row_records=mysqli_fetch_array($result);
				echo $get_rec_sam_date= date('d/m/Y',strtotime($row_records["sample_rec_date"]));
			}
			if($second =="changes")
			{
				$row_records=mysqli_fetch_array($result);
				 $startdate=date('Y-m-d',strtotime($row_records["sample_rec_date"]));
				 $set_date=date('Y-m-d', strtotime($startdate. ' + '.$first.' days'));
				echo $get_rec_sam_date= date('d/m/Y',strtotime($set_date));
			}
			
		}
		
		
	}
	else if($_POST['action_type'] == 'get_span_assign_after_save_edit'){
		
		
	?>
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
										$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$_POST[txt_job_no]' ORDER BY final_material_id DESC";
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
		
	<?php 	
	}else if($_POST['action_type'] == 'edit_material'){
		$id=explode("|",$_POST["id"]);
		$get_report=$id[2];
		$get_job_no=$id[1];
		$get_lab_no=$id[0];
		
	?>
		<table class="table table-bordered table-striped" width="100%"> 
									<thead>
									<input type="hidden" name="hidden_lab_no" id="hidden_lab_no" value="<?php echo $get_lab_no;?>">
									<tr>
										<th style="text-align:center;">Test Name</th>
										<th style="text-align:center;">Lab No</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from span_material_assign WHERE `isdeleted`=0 AND `lab_no`='$get_lab_no' AND `report_no`='$get_report' AND `job_number`='$get_job_no' ORDER BY material_assign_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											
										$sel_test="select * from test_master where `test_id`=".$row['test'];
										$result_test=mysqli_query($conn,$sel_test);
										$row_test=mysqli_fetch_array($result_test);
										
										
									?>
										<tr>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_test['test_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['lab_no'];?></td>
											<td style="text-align:center;">
											<?php $to_pass=$row['material_assign_id']."|".$row['test'];?>
												<button type="button" class="btn btn-info"  onclick="addData('delete_material','<?php echo $to_pass?>')" name="btn_add_data" style="width:100px;font-size:20px;" >Delete</button>
											</td>
										</tr>
									<?php
										}	
									?>
								</tbody>
								
							  </table>
		
	<?php 	
	}else if($_POST['action_type'] == 'set_cate_mate_function'){
	
		$category_ids= $_POST["category_ids"];
		$material_ids= $_POST["material_ids"];
		$report_no= $_POST["report_no"];
		
		$query="select * from material WHERE `mat_category_id`=$category_ids AND `mt_isdeleted`=0 ORDER BY id DESC";
		$result=mysqli_query($conn,$query);
		
		$mate_to_append='<option value="">Select Material</option>';
		while($gets= mysqli_fetch_array($result))
		{
			$mate_to_append .='<option value="'.$gets["id"].'"';
			if($gets["id"]==$material_ids){
				$mate_to_append .=" selected ";
				
				}
			
			$mate_to_append .='>'.$gets["mt_name"].'</option>';
		}
		
		
		$query_test="select * from test_master WHERE `mat_category_id`='$category_ids' AND `test_isdeleted`=0 ORDER BY test_id DESC";
		$result_test=mysqli_query($conn,$query_test);
		
		//$test_to_append='<option value="">Select Test</option>';
		$test_to_append='';
		while($test= mysqli_fetch_array($result_test))
		{
			$test_to_append .='<option value="'.$test["test_id"].'">'.$test["test_name"].'</option>';
		}
		
		//select 
		$report_query_test="select * from span_material_assign WHERE `report_no`='$report_no' AND `isdeleted`=0 ORDER BY material_assign_id DESC";
		$report_result_test=mysqli_query($conn,$report_query_test);
		$reports= mysqli_fetch_assoc($report_result_test);
		
		$admin_supply=$reports["morr"];
		$excel_upload=$reports["excel_upload"];
		$tested_by=$reports["tested_by"];
		$reported_by=$reports["reported_by"];
		
		
	$fill = array('cates' => $category_ids,'mates' => $mate_to_append,'tests' => $test_to_append,'admin_supply' => $admin_supply,'excel_upload' => $excel_upload,'tested_by' => $tested_by,'reported_by' => $reported_by);	
		
       
        echo json_encode($fill);
	 	
	}else if($_POST['action_type'] == 'send_to_perfoma'){
		$clicked_id=$_POST['clicked_id'];
		//$exploding=explode("|",$clicked_id);
		$current_date=date('Y-m-d');
		
		$save_material_update="update save_material_assign SET `isstatus`=2,`modified_date`='$current_date' WHERE `sm_id`=".$clicked_id;
		$result_of_material_update=mysqli_query($conn,$save_material_update);
		
		//$job_update="update job SET `admin_special_light`=2 WHERE `report_no`='$exploding[1]'";
		//$result_of_total_update=mysqli_query($conn,$job_update);
	
}else if($_POST['action_type'] == 'job_delete_before_slection'){
		$clicked_id=$_POST['clicked_id'];
		$del_job="delete from job where `temporary_trf_no`='$clicked_id'";
		mysqli_query($conn,$del_job);
	
}else if($_POST['action_type'] == 'reward_to_edit'){
		$clicked_id=$_POST['clicked_id'];
		//$exploding=explode("|",$clicked_id);
		$current_date=date('Y-m-d');
		
		$save_material_update="update save_material_assign SET `isstatus`=1,`modified_date`='$current_date' WHERE `sm_id`=".$clicked_id;
		$result_of_material_update=mysqli_query($conn,$save_material_update);
		
		//$job_update="update job SET `admin_special_light`=2 WHERE `report_no`='$exploding[1]'";
		//$result_of_total_update=mysqli_query($conn,$job_update);
	
}else if($_POST['action_type'] == 'reward_save_material'){
		$clicked_id=explode("|",$_POST['clicked_id']);
		//$clicked_id=$_POST['clicked_id'];
		$current_date=date('Y-m-d');
		$save_material_update="update save_material_assign SET `isstatus`=1,`is_estimate`=0,`modified_date`='$current_date' WHERE `sm_id`=".$clicked_id[0];
		$result_of_material_update=mysqli_query($conn,$save_material_update);
		
		$reward_to_update="update job SET `morr`='',`job_lab_assign`='0',`job_lab_progress`='0',`report_job_printing`='0',`job_number`='',`tested_by`='',`reported_by`='',`admin_special_light`=2 where `trf_no`='$clicked_id[1]'";
		$result_reward_to_update=mysqli_query($conn,$reward_to_update);
	
		$dele_estiamte_by_trf="delete from estimate_total_span where `trf_no`='$clicked_id[1]'";
		$result_del_estimate=mysqli_query($conn,$dele_estiamte_by_trf);
}
//Code for after submit estimate
else if($_POST['action_type'] == 'send_estimate_to_lab'){
	
		$clicked_id=explode("|",$_POST['clicked_id']);
		
		$sm_id=$clicked_id[0];
		$get_trf_no=$clicked_id[1];
		$get_job_no=$clicked_id[2];
		$temporary_trf_no=$clicked_id[3];
		
		// get morr by report no andjob no
		$sel_span_mate="select `expected_date`,`reported_by`,`tested_by` from span_material_assign where `trf_no`='$get_trf_no' AND `job_number`='$get_job_no' AND `temporary_trf_no`='$temporary_trf_no'";
		$query_span_mate=mysqli_query($conn,$sel_span_mate);
		$get_span_mate= mysqli_fetch_assoc($query_span_mate);
		
		$expected_date=$get_span_mate["expected_date"];
		$reported_by=$get_span_mate["reported_by"];
		$tested_by=$get_span_mate["tested_by"];
		
		
		// code to get sample receve date from job table
		$sel_jobs="select `sample_rec_date` from job where `trf_no`='$get_trf_no' AND `temporary_trf_no`='$temporary_trf_no'";
		$query_jobs=mysqli_query($conn,$sel_jobs);
		$result_jobs=mysqli_fetch_array($query_jobs);
		$get_sample_rec_date= $result_jobs["sample_rec_date"];
		
		
		
			$j_n_progress=1;
			$report_printing=1;
			$set_expected_date=$expected_date;
			$set_re_sample_date=$get_sample_rec_date;
		
		
		 
			$update_jobs="update job set `job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$get_job_no',`job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`reported_by`='$reported_by',`report_received`=1,`job_for_rec_and_biller`=1,`light_indication`='2',`rec_to_tm`='1',`morr`='r',`flow_status`=3,`live_status`=1 where `trf_no`='$get_trf_no' AND `temporary_trf_no`='$temporary_trf_no'";
			
			$result_update_jobs=mysqli_query($conn,$update_jobs);
		
			//update isstatus 3 in save_material_assign to send in lab
			$save_material_update="update save_material_assign SET `is_estimate`=1,`isstatus`=3 WHERE `sm_id`=".$sm_id;
			$result_of_material_update=mysqli_query($conn,$save_material_update);
		
		
	
}
else if($_POST['action_type'] == 'delete_the_job'){
		
		$clicked_id=explode("|",$_POST['clicked_id']);
		$sm_id=$clicked_id[0];
		$get_trf_no=$clicked_id[1];
		$get_job_no=$clicked_id[2];
		
		 $update_jobs="update save_material_assign set `is_deleted`=1 where `trf_no`='$get_trf_no' AND `job_no`='$get_job_no' AND `sm_id`=".$sm_id;
		$result_update_jobs=mysqli_query($conn,$update_jobs);
}
else if($_POST['action_type'] == 'use_the_job'){
		
		$clicked_id=explode("|",$_POST['clicked_id']);
		$sm_id=$clicked_id[0];
		$get_trf_no=$clicked_id[1];
		$get_job_no=$clicked_id[2];
		
		 $update_jobs="update save_material_assign set `is_deleted`=0 where `trf_no`='$get_trf_no' AND `job_no`='$get_job_no' AND `sm_id`=".$sm_id;
		$result_update_jobs=mysqli_query($conn,$update_jobs);
}
else if($_POST['action_type'] == 'dispatch_jobs_by_reception'){
		
		$clicked_id=$_POST['clicked_id'];
		$update_jobs="update job set `dispatch_by_reception`='1', `light_indication`='5' where `trf_no`='$clicked_id'";
		$result_update_jobs=mysqli_query($conn,$update_jobs);
}
else if($_POST['action_type'] == 'set_estimate_as_bill'){
		$clicked_id=$_POST['clicked_id'];
		
		$click_explode=explode("|",$clicked_id);
		
		$est_ids=$click_explode[0];
		$trf_nos=$click_explode[1];
		
		$update_estimate="update estimate_total_span SET `is_billing`=1 WHERE `est_id`=".$est_ids;
		$result_of_estimate=mysqli_query($conn,$update_estimate);
		
		$update_jobs="update job SET `job_owner_eng_and_qm`=2 WHERE `trf_no`='$trf_nos'";
		$result_of_jobs=mysqli_query($conn,$update_jobs);
}

else if($_POST['action_type'] == 'update_ulr_no_by_ids'){
		
		$first_ulr=$_POST['first_ulr'];
		$txt_ulr_no=$_POST['txt_ulr_no'];
		$third_ulr=$_POST['third_ulr'];
		$txt_ulr_no_ids=$_POST['txt_ulr_no_ids'];
		$concat_ulr_no=$first_ulr.$txt_ulr_no.$third_ulr;
		
		$update_final_spans="update final_material_assign_master SET `ulr_no`='$concat_ulr_no' WHERE `final_material_id`=".$txt_ulr_no_ids;
		$result_of_spans=mysqli_query($conn,$update_final_spans);
}
else if($_POST['action_type'] == 'get_jobing_after_send_perfoma'){
	
		// for update part
		$for_update_part='<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>';
									
			$count=0;
			$query="select * from save_material_assign WHERE `is_deleted`=0 AND `isstatus`=1  ORDER BY sm_id DESC";
			$result=mysqli_query($conn,$query);
			if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_array($result))
			{
				$count++;
											
		$for_update_part .='<tr>';
		$for_update_part .='<td style="text-align:center;">'.$count.'</td>';
		$for_update_part .='<td style="white-space:nowrap;text-align:center;">'.$row['trf_no'].'</td>';
		$for_update_part .='<td style="text-align:center;">';
		
		$sel_jobs="select * from job where `trf_no`='$row[trf_no]'";
		$result_jobs=mysqli_query($conn,$sel_jobs);
		$get_jobs=mysqli_fetch_array($result_jobs);
											
		$for_update_part .='<a href="span_material_assigning.php?trf_no='.$row['trf_no'].'" class="btn btn-primary btn-lg btn3d" title="Edit"><span class="glyphicon glyphicon-question-list"></span> Edit</a>
			&nbsp;<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d send_to_perfoma" data-id="'.$row['sm_id'].'"title="Send to Perfoma Invoice"><span class="glyphicon glyphicon-question-ok"></span> Submit</a>';
		
		
		$for_update_part .='</td>';
		
		$for_update_part .='</tr>';
									
			}		
            }
		$for_update_part .='</tbody></table>';
	
			
		// for_perfoma_part
		
		
		$for_perfoma_part='<table id="example3" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">S.R.F. No</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>';
									
			$count=0;
			$perfoma_query="select * from save_material_assign WHERE `is_deleted`=0 AND `isstatus`=2  ORDER BY sm_id DESC";
			$result_perfoma=mysqli_query($conn,$perfoma_query);
			if(mysqli_num_rows($result_perfoma) > 0){
			while($row=mysqli_fetch_array($result_perfoma))
			{
				$count++;
											
		$for_perfoma_part .='<tr>';
		$for_perfoma_part .='<td style="text-align:center;">'.$count.'</td>';
		$for_perfoma_part .='<td style="white-space:nowrap;text-align:center;">'.$row['trf_no'].'</td>';
		if($row['is_estimate']==1){ 
		
		$for_perfoma_part .='<td style="text-align:center;">';
			
			$sel_jobs="select * from job where `trf_no`='$row[trf_no]'";
		$result_jobs=mysqli_query($conn,$sel_jobs);
		$get_jobs=mysqli_fetch_array($result_jobs);
											
		
			$for_perfoma_part .='<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d reward_save_material" data-id="'.$row['sm_id']."|".$row['trf_no'].'" title="Reward"><span class="glyphicon glyphicon-question-ok"></span> Reward</a>
			
			<a href="span_set_rate.php?trf_no='.$row["trf_no"].'&&job_no='.$row['job_no'].'" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Perfoma</a>
			
			&nbsp;<a href="span_set_rate_only_by_test.php?trf_no='.$row["trf_no"].'&&job_no='.$row['job_no'].'" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Invoice By Test</a>
			
			&nbsp;<a href="span_set_rate_only_by_material.php?trf_no='.$row["trf_no"].'&&job_no='.$row['job_no'].'" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Invoice By Material</a>
			
			&nbsp;<a href="span_set_rate_only_for_estimate.php?trf_no='.$row["trf_no"].'&&job_no='.$row['job_no'].'" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Estimate</a>
			
			&nbsp;<a href="print_trf.php?trf_no='.$row["trf_no"].'&&job_no='.$row['job_no'].'" class="btn btn-success btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Trf</a>';
												
			//$sel_estimate="select * from save_material_assign where `trf_no`='$row[trf_no]' AND `is_estimate`=1";	
			//$query_estimate=mysqli_query($conn,$sel_estimate);
			//if(mysqli_num_rows($query_estimate) > 0)
			//{
												
				$for_perfoma_part .='&nbsp;<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d send_to_lab" data-id="'.$row['sm_id'].'"|"'.$row['trf_no'].'"|"'.$row['job_no'].'" title=""><span class="glyphicon glyphicon-question-ok"></span> Submit</a>';
									
			//}
												
			$for_perfoma_part .='&nbsp;<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d 3" data-id="'.$row['trf_no'].'" title="" ><span class="glyphicon glyphicon-question-ok"></span> Delete</a>';
		
		
		
		
		$for_perfoma_part .='</td>';
		}
		else
		{
				$for_perfoma_part .='<td style="text-align:center;">
				
				
											
											<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d reward_save_material" data-id="'.$row['sm_id']."|".$row['trf_no'].'" title="Reward"><span class="glyphicon glyphicon-question-ok"></span> Reward</a>
											
											
											
											&nbsp;<a href="print_trf.php?trf_no='.$row["trf_no"].'&&job_no='.$row['job_no'].'" class="btn btn-success btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Trf</a>';
											
											//$sel_estimate="select * from save_material_assign where `trf_no`='$row[trf_no]' AND `is_estimate`=1";	
											//$query_estimate=mysqli_query($conn,$sel_estimate);
											//if(mysqli_num_rows($query_estimate) > 0)
											//{	
													$for_perfoma_part .='&nbsp;<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d send_to_lab" data-id="'.$row['sm_id'].'"|"'.$row['trf_no'].'"|"'.$row['job_no'].'" title=""><span class="glyphicon glyphicon-question-ok"></span> Submit</a>';
											//}
											
											$for_perfoma_part .='&nbsp;<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d 3" data-id="'.$row['trf_no'].'" title="" ><span class="glyphicon glyphicon-question-ok"></span> Delete</a>
															</td>';
		}
		$for_perfoma_part .='</tr>';
								
			}		
            }
		$for_perfoma_part .='</tbody></table>';
		
		
			
		$fill=array("for_update_part"=>$for_update_part,"for_perfoma_part"=>$for_perfoma_part);	
		echo json_encode($fill); 
}
else if($_POST['action_type'] == 'delete_the_jobs'){
		
		$clicked_id=$_POST['clicked_id'];
		$explode_click=explode("|",$clicked_id);
		
		$sm_id=$explode_click[0];
		$trf_no=$explode_click[1];
		$job_no=$explode_click[2];
		$temporary_trf_no=$explode_click[3];
		
		$sel_final_table="select * from final_material_assign_master where `temporary_trf_no`='$temporary_trf_no'";
		$get_final_data=mysqli_query($conn,$sel_final_table);
		while($data_final=mysqli_fetch_array($get_final_data))
		{
			
			$sel_ulr_seq="Select * from ulr_sequence where `table_primary_key_id`='$data_final[final_material_id]'";
			$get_ulr_seq=mysqli_query($conn,$sel_ulr_seq);
			if(mysqli_num_rows($get_ulr_seq) > 0)
			{
				//$del_ulr_seq="DELETE from ulr_sequence where `table_primary_key_id`='$data_final[final_material_id]'";
				$del_ulr_seq="update ulr_sequence set `table_primary_key_id`='' AND `ulr_status`='3' where `table_primary_key_id`='$data_final[final_material_id]'";
				mysqli_query($conn,$del_ulr_seq);
			}
		}
		//delete job from save_material_assign table
		$delete_material_assign="delete from save_material_assign where `temporary_trf_no`='$temporary_trf_no'";
		$result_material_assign=mysqli_query($conn,$delete_material_assign);
		
		//delete job from final_material_assign_master table
		$delete_final_material="delete from final_material_assign_master where `temporary_trf_no`='$temporary_trf_no'";
		$result_final_material=mysqli_query($conn,$delete_final_material);
		
		//delete job from span_material_assign table
		$delete_span_material="delete from span_material_assign where `temporary_trf_no`='$temporary_trf_no'";
		$result_span_material=mysqli_query($conn,$delete_span_material);
		
		//delete job from test_wise_material_rate table
		$delete_test_wise="delete from test_wise_material_rate where `temporary_trf_no`='$temporary_trf_no'";
		$result_test_wise=mysqli_query($conn,$delete_test_wise);
		
		//delete job from job table
		$delete_jobs="delete from job where `temporary_trf_no`='$temporary_trf_no'";
		$result_jobs=mysqli_query($conn,$delete_jobs);
		
		
}else if($_POST['action_type'] == 'delete_all_job_by_rec'){
		
		$trf_no=$_POST['clicked_id'];
		$liked="%".$trf_no."%";
		
		//check if invoice or estimate made this job not deleted;
		$sel_estimates="select * from estimate_total_span where `trf_no` LIKE '$liked'";
		$get_estimates=mysqli_query($conn,$sel_estimates);
		if(mysqli_num_rows($get_estimates) > 0){
			$data_estimates=mysqli_fetch_array($get_estimates);
			$which_made=$data_estimates["which_made"];
			if($which_made=="0"){
				$msg="First Delete Perfoma of ".$data_estimates["perfoma_no"];
			}else if($which_made=="1"){
				$msg="First Delete Estimate of ".$data_estimates["estimate_numbers"];
			}else{
				$msg="First Delete Invoice of ".$data_estimates["invoice_no"];	
			}
			$fills=array("status" => "1", "msg" => $msg);
			echo json_encode($fills);
			exit;
		}
		
		$sel_final_table="select * from final_material_assign_master where `trf_no`='$trf_no'";
		$get_final_data=mysqli_query($conn,$sel_final_table);
		while($data_final=mysqli_fetch_array($get_final_data))
		{
			$sel_mate_tables="select * from material where `id`=".$data_final["material_id"];
			$get_mate_table=mysqli_query($conn,$sel_mate_tables);
			$data_mate=mysqli_fetch_array($get_mate_table);
			$tables_names= $data_mate["table_name"];
			
			$delete_from_tables="delete from $tables_names where `job_no`='$trf_no'";
			mysqli_query($conn,$delete_from_tables);
			
			
			
		}
		//delete job from save_material_assign table
		$delete_material_assign="delete from save_material_assign where `trf_no`='$trf_no'";
		$result_material_assign=mysqli_query($conn,$delete_material_assign);
		
		//delete job from final_material_assign_master table
		$delete_final_material="delete from final_material_assign_master where `trf_no`='$trf_no'";
		$result_final_material=mysqli_query($conn,$delete_final_material);
		
		//delete job from span_material_assign table
		$delete_span_material="delete from span_material_assign where `trf_no`='$trf_no'";
		$result_span_material=mysqli_query($conn,$delete_span_material);
		
		//delete job from test_wise_material_rate table
		$delete_test_wise="delete from test_wise_material_rate where `trf_no`='$trf_no'";
		$result_test_wise=mysqli_query($conn,$delete_test_wise);
		
		//delete job from job for engineer table
		$delete_jobs_eng="delete from job_for_engineer where `trf_no`='$trf_no'";
		$result_jobs_eng=mysqli_query($conn,$delete_jobs_eng);
		
		//delete job from job table
		$delete_jobs="delete from job where `trf_no`='$trf_no'";
		$result_jobs=mysqli_query($conn,$delete_jobs);
		
		$fills=array("status" => "0", "msg" => "Deleted Successfully All Data Of This Job..");
			echo json_encode($fills);
			exit;
		
}else if($_POST['action_type'] == 'delete_only_reports'){
		
		$clicked_id=explode("|",$_POST['clicked_id']);
		$trf_no=$clicked_id[0];
		$temporary_trf_no=$clicked_id[1];
		$liked="%".$clicked_id[0]."%";
		
		//check if invoice or estimate made this job not deleted;
		$sel_estimates="select * from estimate_total_span where `trf_no` LIKE '$liked'";
		$get_estimates=mysqli_query($conn,$sel_estimates);
		if(mysqli_num_rows($get_estimates) > 0){
			$data_estimates=mysqli_fetch_array($get_estimates);
			$which_made=$data_estimates["which_made"];
			if($which_made=="0"){
				$msg="First Delete Perfoma of ".$data_estimates["perfoma_no"];
			}else if($which_made=="1"){
				$msg="First Delete Estimate of ".$data_estimates["estimate_numbers"];
			}else{
				$msg="First Delete Invoice of ".$data_estimates["invoice_no"];	
			}
			$fills=array("status" => "1", "msg" => $msg);
			echo json_encode($fills);
			exit;
		}
		
		$sel_final_table="select * from final_material_assign_master where `trf_no`='$trf_no' AND `temporary_trf_no`='$temporary_trf_no'";
		$get_final_data=mysqli_query($conn,$sel_final_table);
		while($data_final=mysqli_fetch_array($get_final_data))
		{
			$sel_mate_tables="select * from material where `id`=".$data_final["material_id"];
			$get_mate_table=mysqli_query($conn,$sel_mate_tables);
			$data_mate=mysqli_fetch_array($get_mate_table);
			$tables_names= $data_mate["table_name"];
			
			$delete_from_tables="delete from $tables_names where `job_no`='$trf_no'";
			mysqli_query($conn,$delete_from_tables);
			
			
			
		}
		
			$save_eng_update="update job_for_engineer SET `report_sent_to_qm`=1,`biller_light_status`=1, `appoved_by_qm_to_print`=0,`accepted_by_qm`=0 WHERE `trf_no`='$trf_no'";
			$result_eng_update=mysqli_query($conn,$save_eng_update);
		
			// ALSO SET ENG LIGHT STATUS in final_material_assign_master
			$update_eng_light="update final_material_assign_master SET `eng_light_status`=1,`report_done_by_qm`='0' WHERE `trf_no`='$trf_no'  AND `temporary_trf_no`='$temporary_trf_no'";
			$result_eng_light=mysqli_query($conn,$update_eng_light);
		
		$sel_job_by_trf_no="select `tested_by`,`tested_by_status` from job where `trf_no`='$trf_no' AND `job_number`='$trf_no'  AND `temporary_trf_no`='$temporary_trf_no'";
		$result_job_by_trf_no=mysqli_query($conn,$sel_job_by_trf_no);
		if(mysqli_num_rows($result_job_by_trf_no)>0)
		{
			$get_jobs_by_trf_no= mysqli_fetch_array($result_job_by_trf_no);
			
			$explode_tested_by=explode(",",$get_jobs_by_trf_no["tested_by"]);
			$explode_tested_by_status=explode(",",$get_jobs_by_trf_no["tested_by_status"]);
			
			$value_position=array_search($tested_bys,$explode_tested_by,true);
			
			$explode_tested_by_status[$value_position]="0";
			
			$implode_tested_by_status=implode(",",$explode_tested_by_status);
			
			$update_job="update job set `tested_by_status`='$implode_tested_by_status',`job_owner_qm_and_biller`='0',`any_report_done_by_any_qm`='0' where `trf_no`='$trf_no' AND `job_number`='$trf_no'  AND `temporary_trf_no`='$temporary_trf_no'";
			$result_update_job=mysqli_query($conn,$update_job);
			
			
		}
		
		
		
		$fills=array("status" => "0", "msg" => "All Reports Deleted Successfully  Of This Job..");
			echo json_encode($fills);
			exit;
		
}else if($_POST['action_type'] == 'delete_one_report'){
		
		$explodes=explode("|",$_POST['clicked_id']);
		$trf_no=$explodes[1];
		$labs_no=$explodes[0];
		$liked="%".$trf_no."%";
		
		/* //check if invoice or estimate made this job not deleted;
		$sel_estimates="select * from estimate_total_span where `trf_no` LIKE '$liked'";
		$get_estimates=mysqli_query($conn,$sel_estimates);
		if(mysqli_num_rows($get_estimates) > 0){
			$data_estimates=mysqli_fetch_array($get_estimates);
			$which_made=$data_estimates["which_made"];
			if($which_made=="0"){
				$msg="First Delete Perfoma of ".$data_estimates["perfoma_no"];
			}else if($which_made=="1"){
				$msg="First Delete Estimate of ".$data_estimates["estimate_numbers"];
			}else{
				$msg="First Delete Invoice of ".$data_estimates["invoice_no"];	
			}
			$fills=array("status" => "1", "msg" => $msg);
			echo json_encode($fills);
			exit;
		} */
		
		$sel_final_table="select * from final_material_assign_master where `lab_no`='$labs_no'";
		$get_final_data=mysqli_query($conn,$sel_final_table);
		$data_final=mysqli_fetch_array($get_final_data);
		
			$sel_mate_tables="select * from material where `id`=".$data_final["material_id"];
			$get_mate_table=mysqli_query($conn,$sel_mate_tables);
			$data_mate=mysqli_fetch_array($get_mate_table);
			$tables_names= $data_mate["table_name"];
			
			$delete_from_tables="delete from $tables_names where `lab_no`='$labs_no'";
			mysqli_query($conn,$delete_from_tables);
		
		$fills=array("status" => "0", "msg" => "Reports Deleted Successfully  Of This Job..");
			echo json_encode($fills);
			exit;
		
}
else if($_POST['action_type'] == 'delete_data_of_jobs'){
	//delete only jobs data from other table but not delete jobs	
		$clicked_id=$_POST['clicked_id'];
	
		//delete job from estiamte_total_span table
		$delete_estimate="delete from estimate_total_span where `report_no`='$clicked_id'";
		$result_estimate=mysqli_query($conn,$delete_estimate);
		
		//delete job from save_material_assign table
		$delete_material_assign="delete from save_material_assign where `report_no`='$clicked_id'";
		$result_material_assign=mysqli_query($conn,$delete_material_assign);
		
		//delete job from final_material_assign_master table
		$delete_final_material="delete from final_material_assign_master where `report_no`='$clicked_id'";
		$result_final_material=mysqli_query($conn,$delete_final_material);
		
		//delete job from span_material_assign table
		$delete_span_material="delete from span_material_assign where `report_no`='$clicked_id'";
		$result_span_material=mysqli_query($conn,$delete_span_material);
		
		//delete job from test_wise_material_rate table
		$delete_test_wise="delete from test_wise_material_rate where `report_no`='$clicked_id'";
		$result_test_wise=mysqli_query($conn,$delete_test_wise);
		
		//update job from job table
		$upd_jobs="update job set `material_assign`=0 where `report_no`='$clicked_id'";
		$result_jobs=mysqli_query($conn,$upd_jobs);
		
		
}else if($_POST['action_type'] == 'delete_final_entry'){
		
		
		$clicked_id=explode("|",$_POST['id']);
		$final_mat_id=$clicked_id[0];
		$tempo_trf_no=$clicked_id[1];
		
		 $sel_ulr_from_final="select * from final_material_assign_master where `temporary_trf_no`='$tempo_trf_no' AND `final_material_id`='$final_mat_id'";
		$result_from_final=mysqli_query($conn,$sel_ulr_from_final);
		$get_from_final=mysqli_fetch_array($result_from_final);
		$get_ulr_nos=$get_from_final["ulr_no"];
		
		$sel_jobs="select `nabl_type` from job where `temporary_trf_no`='$tempo_trf_no'";
		$result_jobs=mysqli_query($conn,$sel_jobs);
		if(mysqli_num_rows($result_jobs) > 0)
		{
			$get_jobses=mysqli_fetch_array($result_jobs);
			if($get_jobses["nabl_type"]=="nabl")
			{
				$del_ulr="DELETE FROM ulr_sequence WHERE ulr_sequence='$get_ulr_nos'";
				mysqli_query($conn,$del_ulr);
			}
		}
		
		
		// delete from test_wise_material_rate table by test id and S.R.F. No
		$delete_test="delete from test_wise_material_rate where `final_material_id`='$final_mat_id' AND `temporary_trf_no`='$tempo_trf_no'";
		$result_delete_test=mysqli_query($conn,$delete_test);
		
		
		
		 // delete from span_material_assign table by test id and S.R.F. No
		$del_span_material_assign="delete from span_material_assign where `temporary_trf_no`='$tempo_trf_no' AND `final_material_id`='$final_mat_id'";
		$del_result_span_material_assign=mysqli_query($conn,$del_span_material_assign);
		
		
		// delete from final_material_assign_master table by test id and S.R.F. No
		 $del_final_material_assign="delete from final_material_assign_master where `temporary_trf_no`='$tempo_trf_no' AND `final_material_id`='$final_mat_id'";
		$del_result_final_material_assign=mysqli_query($conn,$del_final_material_assign);

}else if($_POST['action_type'] == 'get_dispatch_report')
{
	$abc=$_POST["abc"];
	$sel_dispatches="select * from report_dispatch where `dispatch_id`=$abc AND `is_deleted`=0";
	$query_dispatches=mysqli_query($conn,$sel_dispatches);
	$result_dispatched=mysqli_fetch_array($query_dispatches);
	
?>
		<table class="table" style="color: black;width:400px;text-align: center;margin-left:46px;margin-top:20px;" border="1">
		  <thead></thead>
		  <tbody>
		  <tr>
		   <th>Dispatch Type:</th><td><?php if($result_dispatched["dispatch_type"]=="0"){ echo "HAND TO HAND"; }else{ echo "COURIER"; }?></td>
		  </tr>
		  
		  <?php if($result_dispatched["dispatch_type"]=="1"){ ?>
		  <tr>
		   <th>Courier Company:</th><td><?php echo $result_dispatched["courier_company"];?></td>
		  </tr>
		  <tr>
		   <th>Courier Date:</th><td><?php echo $result_dispatched["courier_date"];?></td>
		  </tr>
		  <tr>
		   <th>Courier Docate No:</th><td><?php echo $result_dispatched["courier_docate_no"];?></td>
		  </tr>
		  <tr>
		   <th>Contact Person:</th><td><?php echo $result_dispatched["courier_contact_person"];?></td>
		  </tr>
		  <tr>
		   <th>Contact Mobile No:</th><td><?php echo $result_dispatched["courier_contact_person_mobile"];?></td>
		  </tr>
		  <tr>
		   <th>Courier Address:</th><td><?php echo $result_dispatched["courier_contact_address"];?></td>
		  </tr>
          <?php } ?>
		  
		  <?php if($result_dispatched["dispatch_type"]=="0"){ ?>
		  <tr>
		   <th>Receiver Name:</th><td><?php echo $result_dispatched["receiver_name"];?></td>
		  </tr>
		  <tr>
		   <th>Receiver Mobile No:</th><td><?php echo $result_dispatched["receiver_mo_no"];?></td>
		  </tr>
          <?php } ?>
		  <tr>
		   <th>S.R.F. No:</th><td><?php echo $result_dispatched["trf_no"];?></td>
		  </tr>
		  <tr>
		   <th>Report No:</th><td><?php echo $result_dispatched["report_no"];?></td>
		  </tr>
		  <tr>
		   <th>Lab No:</th><td><?php echo $result_dispatched["lab_no"];?></td>
		  </tr>
		  <tr>
		   <th>Ulr No:</th><td><?php echo $result_dispatched["ulr_no"];?></td>
		  </tr>
		  </tbody>
		  </table>
		  <?php if($result_dispatched["dispatch_type"]=="1"){ ?>
		  <a href="print_for_courier_dispatch.php?dispatch_id=<?php echo $result_dispatched["dispatch_id"];?>" class="btn btn-primary" target="_blank" style="width:12%;text-align:center;">PRINT</a>
		  <?php } ?>
		
<?php
}else if($_POST['action_type'] == 'get_for_update')
{
	$all_chk_ids=$_POST["chk_array"];
	$chk_array=explode(",",$_POST["chk_array"]);
	$one_array=$chk_array[0];
	$sel_dispatches="select * from report_dispatch where `dispatch_id`=$one_array AND `is_deleted`=0";
	$query_dispatches=mysqli_query($conn,$sel_dispatches);
	$result_dispatched=mysqli_fetch_array($query_dispatches);
	
?>
		<table class="table" style="color: black;width:400px;text-align: center;margin-left:46px;margin-top:20px;" border="1">
		  <thead></thead>
		  <tbody>
		  <tr>
		   <th>Dispatch Type:</th><td>COURIER</td>
		  </tr>
		  <tr>
		   <th>Courier Date:</th><td><input type="text" name="courier_date" class="form-control" id="courier_date" value="<?php echo date('d/m/Y',strtotime($result_dispatched["courier_date"]))?>"></td>
		  </tr>
		  <tr>
		   <th>Courier Docate No:</th><td><input type="text" name="courier_docate_no" class="form-control" id="courier_docate_no" value="<?php echo $result_dispatched["courier_docate_no"];?>"></td>
		  </tr>
		  <tr>
		   <th>Contact Person:</th><td><input type="text" name="courier_contact_person" class="form-control" id="courier_contact_person" value="<?php echo $result_dispatched["courier_contact_person"];?>"></td>
		  </tr>
		  <tr>
		   <th>Contact Mobile No:</th><td><input type="text" name="courier_contact_person_mobile" class="form-control" id="courier_contact_person_mobile" value="<?php echo $result_dispatched["courier_contact_person_mobile"];?>"></td>
		  </tr>
		  <tr>
		   <th>Courier Address:</th><td><textarea name="courier_contact_address" id="courier_contact_address"><?php echo $result_dispatched["courier_contact_address"];?></textarea></td>
		  </tr>
         <input type="hidden" name="hidden_all_idsall_ids" id="hidden_all_ids" value="<?php echo $all_chk_ids;?>">
		  
		  </tbody>
		  </table>
		  <a href="javascript:void(0);" class="btn btn-primary btn-lg btn3d update_dispatch_reports"  title="Merge"><span class="glyphicon glyphicon-question-ok"></span>Update</a>
		  
	<script>	
	$('#courier_date').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
	</script>	
<?php
}
else if($_POST['action_type'] == 'update_dispatch_reports'){
	    
		$replaced_date=str_replace('/', '-', $_POST["courier_date"]);
	    $explode_date=explode('-', $replaced_date);
		$courier_date= $explode_date[2]."-".$explode_date[1]."-".$explode_date[0];
		
		$courier_docate_no=$_POST["courier_docate_no"];
		$courier_contact_person=$_POST["courier_contact_person"];
		$courier_contact_person_mobile=$_POST["courier_contact_person_mobile"];
		$courier_contact_address=$_POST["courier_contact_address"];
		$hidden_all_ids_array=explode(",",$_POST["hidden_all_ids"]);
		
		foreach($hidden_all_ids_array as $keys => $hidden_one_ids)
		{
			$upd_reports="update report_dispatch set `courier_date`='$courier_date',`courier_docate_no`='$courier_docate_no',`courier_contact_person`='$courier_contact_person',`courier_contact_person_mobile`='$courier_contact_person_mobile',`courier_contact_address`='$courier_contact_address' where `dispatch_id`=$hidden_one_ids";
		    $result_upd_reports=mysqli_query($conn,$upd_reports);
		}
		
		
		
		
}
else if($_POST['action_type'] == 'delete_only_test'){
		
		
		$clicked_id=explode("|",$_POST['clicked_id']);
		$test_id=$clicked_id[0];
		$mate_id=$clicked_id[1];
		$mate_cat_id=$clicked_id[2];
		$final_mat_id=$clicked_id[3];
		$span_main_id=$clicked_id[4];
		$trf_no=$clicked_id[5];
		
		// delete from test_wise_material_rate table by test id and S.R.F. No
		$delete_test="delete from test_wise_material_rate where `test_id`='$test_id' AND `material_id`='$mate_id' AND `material_cat_id`='$mate_cat_id' AND `final_material_id`='$final_mat_id' AND `trf_no`='$trf_no'";
		$result_delete_test=mysqli_query($conn,$delete_test);
		
		
		
		 // delete from span_material_assign table by test id and S.R.F. No
		$del_span_material_assign="delete from span_material_assign where `test`='$test_id' AND `material_id`='$mate_id' AND `material_category`='$mate_cat_id' AND `final_material_id`='$final_mat_id' AND `trf_no`='$trf_no'";
		$del_result_span_material_assign=mysqli_query($conn,$del_span_material_assign);
		
		$fill=array("msg"=>"Test Delete Successfully","span_main_id"=>$span_main_id);	
		echo json_encode($fill);
		

}
else if($_POST['action_type'] == 'delete_one_materials'){
		
		
		$final_mat_id=$_POST['clicked_id'];
		
		
		// delete from test_wise_material_rate table by test id and S.R.F. No
		$delete_test="delete from test_wise_material_rate where `final_material_id`='$final_mat_id'";
		$result_delete_test=mysqli_query($conn,$delete_test);
		
		
		
		 // delete from span_material_assign table by test id and S.R.F. No
		$del_span_material_assign="delete from span_material_assign where `final_material_id`='$final_mat_id'";
		$del_result_span_material_assign=mysqli_query($conn,$del_span_material_assign);
		
		$upd_final="update final_material_assign_master set `material_category`='',`material_id`='',`expected_date`='0000-00-00' where `final_material_id`=".$final_mat_id;
		    $result_upd_final=mysqli_query($conn,$upd_final);
		
		$fill=array("msg"=>"Material Delete Successfully");	
		echo json_encode($fill);
		

}
else if($_POST['action_type'] == 'delete_one_materials_and_report_also'){
		
		
		$exploded_ids= explode("|",$_POST['clicked_id']);
		
		$final_mat_id= $exploded_ids[0];
		$tables_name= $exploded_ids[1];
		$reports_no= $exploded_ids[2];
		
		
		// delete from test_wise_material_rate table by test id and S.R.F. No
		$delete_test="delete from test_wise_material_rate where `final_material_id`='$final_mat_id'";
		$result_delete_test=mysqli_query($conn,$delete_test);
		
		
		
		 // delete from span_material_assign table by test id and S.R.F. No
		$del_span_material_assign="delete from span_material_assign where `final_material_id`='$final_mat_id'";
		$del_result_span_material_assign=mysqli_query($conn,$del_span_material_assign);
		
		$upd_final="update final_material_assign_master set `material_category`='',`material_id`='',`expected_date`='0000-00-00' where `final_material_id`=".$final_mat_id;
		$result_upd_final=mysqli_query($conn,$upd_final);
		
		// delete report also from tables by materials
		
		$delete_report="delete from ".$tables_name." where `report_no`='$reports_no'";
		$result_delete_report=mysqli_query($conn,$delete_report);
		
		$fill=array("msg"=>"Material Delete Successfully");	
		echo json_encode($fill);
		

}
else if($_POST['action_type'] == 'send_to_rec1'){
		$clicked_id1=$_POST['clicked_id'];
		
		 $update_estimate22="update job SET `send_to_second_reception`=0,`assign_status`=0 WHERE `temporary_trf_no`='$clicked_id1'";
		$result_of_estimate32=mysqli_query($conn,$update_estimate22);
		
		
	
}

}
    exit;

?>