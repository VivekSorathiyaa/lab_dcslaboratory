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
		$report_explode= explode("/",$txt_report_no);
		
     
		$cate_id= $_POST["select_material_category"];
		$get_query = "select id,mt_name from material WHERE mat_category_id=$cate_id AND `mt_isdeleted`='0'"; 
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
			
		
	 
	 $fill = array('all_material' => $out_materials,'final_lab_id' => $final_lab_id,'out_tests' => $out_tests,'cate_prefix' => $cate_prefix,'put_chk_box' => $put_chk_box,'out_materials_engineer' => $out_materials_engineer);	
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
		
		// get test by cate id and material id		
		$get_query_test = "select * from particular_test WHERE `mate_cat_id`=$select_material_category AND `mate_id`=$material_id  AND `is_deleted`=0";
		$select_result_test = mysqli_query($conn, $get_query_test);
		
		//$out_tests='<option value="" >Select Test</option>';
		$out_tests='';
			   if (mysqli_num_rows($select_result_test) > 0) 
			{
				$result_test_array=mysqli_fetch_array($select_result_test);
				$get_test_array=$result_test_array["test_ids"];
				$exploded_test_array= explode(",",$get_test_array);
				
				foreach($exploded_test_array as $one_test) 
				{
				    $get_query_test_names = "select test_name from test_master WHERE `test_isdeleted`='0' AND `test_id`=".$one_test; 
					$select_result_test_name = mysqli_query($conn, $get_query_test_names);
					$get_test_name = mysqli_fetch_array($select_result_test_name);
					
					$out_tests .='<option value="'.$one_test.'" selected="selected">'.$get_test_name['test_name'].'</option>';
				}	
			}   	
				
		
		
		$fill = array('material_per_day_limit' => $material_per_day_limit,'out_tests' => $out_tests);	
		
       
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
				$bitumin_mix= $_POST['bitumin_mix'];
				$txt_is_sample= $_POST['txt_is_sample'];
				$current_date= date('Y-m-d');
				
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
					
				 	$insert="insert into span_material_assign (`material_category`,`material_id`,`final_material_id`,`material_location`,`material_condition`,`test`,`expected_date`,`morr`,`excel_upload`,`tested_by`,`reported_by`,`type_of_cement`,`cement_grade`,`cement_brand`,`week_number`,`agg_source`,`sample_de`,`brick_mark`,`brick_specification`,`tanker_no`,`lot_no`,`bitumin_grade`,`bitumin_make`,`cc_grade`,`day_remark`,`casting_date`,`cc_day`,`cc_set_of_cube`,`cc_no_of_cube`,`paver_shape`,`paver_age`,`paver_color`,`paver_thickness`,`paver_grade`,`soil_location`,`soil_source`,`steel_dia`,`steel_grade`,`steel_brand`,`water_source`,`water_specification`,`water_brand`,`fine_aggregate_source`,`quarry_spall_source`,`bit_mix`,`is_save`,`createdby`,`createddate`,`modifiedby`,`modifieddate`,`isdeleted`,`temporary_trf_no`,`created_by_id`,`cc_identification_mark`,`chainage_no`,`fine_agg_type`,`fdd_desc_sample`) 
				values(
				'$select_material_category',
				'$select_material',
				'$last_final_material_id',
				'$select_location',
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
				'$fdd_desc_sample')";
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
				$bitumin_mix= $_POST['bitumin_mix'];
				$txt_is_sample= $_POST['txt_is_sample'];
				$current_date= date('Y-m-d');
				
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
					
					$insert="insert into span_material_assign (`material_category`,`material_id`,`final_material_id`,`material_location`,`material_condition`,`test`,`expected_date`,`morr`,`excel_upload`,`tested_by`,`reported_by`,`type_of_cement`,`cement_grade`,`cement_brand`,`week_number`,`agg_source`,`sample_de`,`brick_mark`,`brick_specification`,`tanker_no`,`lot_no`,`bitumin_grade`,`bitumin_make`,`cc_grade`,`day_remark`,`casting_date`,`cc_day`,`cc_set_of_cube`,`cc_no_of_cube`,`paver_shape`,`paver_age`,`paver_color`,`paver_thickness`,`paver_grade`,`soil_location`,`soil_source`,`steel_dia`,`steel_grade`,`steel_brand`,`water_source`,`water_specification`,`water_brand`,`fine_aggregate_source`,`quarry_spall_source`,`bit_mix`,`is_save`,`createdby`,`createddate`,`modifiedby`,`modifieddate`,`isdeleted`,`temporary_trf_no`,`created_by_id`,`cc_identification_mark`,`chainage_no`,`fine_agg_type`,`fdd_desc_sample`,`trf_no`,`job_number`,`lab_no`) 
				values(
				'$select_material_category',
				'$select_material',
				'$finalmatno',
				'$select_location',
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
				'$labno')";
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
				$mark= $_POST['mark'];
				$brick_specification= $_POST['brick_specification'];
				$tanker_no= $_POST['tanker_no'];
				$lot_no= $_POST['lot_no'];
				$bitumin_grade= $_POST['bitumin_grade'];
				$make= $_POST['make'];
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
				$bitumin_mix= $_POST['bitumin_mix'];
				$txt_is_sample= $_POST['txt_is_sample'];
				$current_date= date('Y-m-d');
				
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
					
					$insert="insert into span_material_assign (`material_category`,`material_id`,`final_material_id`,`material_location`,`material_condition`,`test`,`expected_date`,`morr`,`excel_upload`,`tested_by`,`reported_by`,`type_of_cement`,`cement_grade`,`cement_brand`,`week_number`,`agg_source`,`sample_de`,`brick_mark`,`brick_specification`,`tanker_no`,`lot_no`,`bitumin_grade`,`bitumin_make`,`cc_grade`,`day_remark`,`casting_date`,`cc_day`,`cc_set_of_cube`,`cc_no_of_cube`,`paver_shape`,`paver_age`,`paver_color`,`paver_thickness`,`paver_grade`,`soil_location`,`soil_source`,`steel_dia`,`steel_grade`,`steel_brand`,`water_source`,`water_specification`,`water_brand`,`fine_aggregate_source`,`quarry_spall_source`,`bit_mix`,`is_save`,`createdby`,`createddate`,`modifiedby`,`modifieddate`,`isdeleted`,`temporary_trf_no`,`created_by_id`,`cc_identification_mark`,`chainage_no`,`fine_agg_type`,`fdd_desc_sample`,`trf_no`,`job_number`,`lab_no`) 
				values(
				'$select_material_category',
				'$select_material',
				'$finalmatno',
				'$select_location',
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
				'$labno')";
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
				
				
				
				
				for ($x = 1; $x < $y; $x++) {
					
				$var_expected_date = $_POST['ex_date_submission'];
				$date_expected_date = str_replace('/', '-', $var_expected_date);
				$expected_date =  date('Y-m-d', strtotime($date_expected_date));
				$current_date =  date('Y-m-d');
				
				 //select date of job for insert it in final_material_assign_master table
				 $sel_job="select * from job where `temporary_trf_no`='$txt_trf_no'";
				 $result_job_date=mysqli_query($conn,$sel_job);
				 $get_job_result=mysqli_fetch_array($result_job_date);
				 $job_inserted_date=$get_job_result["date"];
				
					
				$insertas="insert into final_material_assign_master (`material_category`,`material_id`,`expected_date`,`temporary_trf_no`,`is_status`,`created_by`,`created_by_id`,`created_date`,`modified_by`,`modified_date`,`is_deleted`,`job_date`,`is_sample`) 
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
				'$txt_is_sample')";
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
				foreach($mul_data as $select_test) //loop over values
				{
					
					// get from test wise master
				    $tt_op = "select * from span_material_assign where `final_material_id`='$get_final_mate_id' AND test='$select_test'";
					$dtas = mysqli_query($conn,$tt_op);
					
					if (mysqli_num_rows($dtas) != 0) 
					{
							
					}
					else
					{
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
						$tested_by= $_POST['tested_by'];
						$reported_by= $_POST['reported_by'];
						$select_samp_condition= $_POST['select_samp_condition'];
						$select_location= $_POST['select_location'];
						$bitumin_mix= $_POST['bitumin_mix'];
						
						$insert_uu="insert into span_material_assign (`material_category`,`material_id`,`final_material_id`,`material_location`,`material_condition`,`test`,`expected_date`,`morr`,`excel_upload`,`tested_by`,`reported_by`,`type_of_cement`,`cement_grade`,`cement_brand`,`week_number`,`agg_source`,`sample_de`,`brick_mark`,`brick_specification`,`tanker_no`,`lot_no`,`bitumin_grade`,`bitumin_make`,`cc_grade`,`day_remark`,`casting_date`,`cc_day`,`cc_set_of_cube`,`cc_no_of_cube`,`paver_shape`,`paver_age`,`paver_color`,`paver_thickness`,`paver_grade`,`soil_location`,`soil_source`,`steel_dia`,`steel_grade`,`steel_brand`,`water_source`,`water_specification`,`water_brand`,`fine_aggregate_source`,`quarry_spall_source`,`bit_mix`,`is_save`,`createdby`,`createddate`,`modifiedby`,`modifieddate`,`isdeleted`,`temporary_trf_no`,`created_by_id`,`cc_identification_mark`,`chainage_no`,`fine_agg_type`,`fdd_desc_sample`) 
						values(
						'$select_material_category',
						'$select_material',
						'$get_final_mate_id',
						'$select_location',
						'$select_samp_condition',
						'$select_test',
						'$ex_date_dubmission',
						'd',
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
						'1',
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
						'$fdd_desc_sample')";
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
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_mat['mt_name'];?></td>
										
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
		
		// get morr by report no andjob no
		$sel_span_mate="select `expected_date`,`reported_by`,`tested_by` from span_material_assign where `trf_no`='$get_trf_no' AND `job_number`='$get_job_no'";
		$query_span_mate=mysqli_query($conn,$sel_span_mate);
		$get_span_mate= mysqli_fetch_assoc($query_span_mate);
		
		$expected_date=$get_span_mate["expected_date"];
		$reported_by=$get_span_mate["reported_by"];
		$tested_by=$get_span_mate["tested_by"];
		
		
		// code to get sample receve date from job table
		$sel_jobs="select `sample_rec_date` from job where `trf_no`='$get_trf_no'";
		$query_jobs=mysqli_query($conn,$sel_jobs);
		$result_jobs=mysqli_fetch_array($query_jobs);
		$get_sample_rec_date= $result_jobs["sample_rec_date"];
		
		
		
			$j_n_progress=1;
			$report_printing=1;
			$set_expected_date=$expected_date;
			$set_re_sample_date=$get_sample_rec_date;
		
		
		 
			$update_jobs="update job set `job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$get_job_no',`job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`reported_by`='$reported_by',`report_received`=1,`job_for_rec_and_biller`=1,`light_indication`='2',`morr`='r' where `trf_no`='$get_trf_no'";
			
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
										<th style="text-align:center;">Trf No</th>
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
		
		//delete job from job table
		$delete_jobs="delete from job where `report_no`='$clicked_id'";
		$result_jobs=mysqli_query($conn,$delete_jobs);
		
		
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
		
		// delete from test_wise_material_rate table by test id and trf no
		$delete_test="delete from test_wise_material_rate where `final_material_id`='$final_mat_id' AND `temporary_trf_no`='$tempo_trf_no'";
		$result_delete_test=mysqli_query($conn,$delete_test);
		
		
		
		 // delete from span_material_assign table by test id and trf no
		$del_span_material_assign="delete from span_material_assign where `temporary_trf_no`='$tempo_trf_no' AND `final_material_id`='$final_mat_id'";
		$del_result_span_material_assign=mysqli_query($conn,$del_span_material_assign);
		
		
		// delete from final_material_assign_master table by test id and trf no
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
		   <th>Trf No:</th><td><?php echo $result_dispatched["trf_no"];?></td>
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
		
		// delete from test_wise_material_rate table by test id and trf no
		$delete_test="delete from test_wise_material_rate where `test_id`='$test_id' AND `material_id`='$mate_id' AND `material_cat_id`='$mate_cat_id' AND `final_material_id`='$final_mat_id' AND `trf_no`='$trf_no'";
		$result_delete_test=mysqli_query($conn,$delete_test);
		
		
		
		 // delete from span_material_assign table by test id and trf no
		$del_span_material_assign="delete from span_material_assign where `test`='$test_id' AND `material_id`='$mate_id' AND `material_category`='$mate_cat_id' AND `final_material_id`='$final_mat_id' AND `trf_no`='$trf_no'";
		$del_result_span_material_assign=mysqli_query($conn,$del_span_material_assign);
		
		$fill=array("msg"=>"Test Delete Successfully","span_main_id"=>$span_main_id);	
		echo json_encode($fill);
		

}
else if($_POST['action_type'] == 'delete_one_materials'){
		
		
		$final_mat_id=$_POST['clicked_id'];
		
		
		// delete from test_wise_material_rate table by test id and trf no
		$delete_test="delete from test_wise_material_rate where `final_material_id`='$final_mat_id'";
		$result_delete_test=mysqli_query($conn,$delete_test);
		
		
		
		 // delete from span_material_assign table by test id and trf no
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
		
		
		// delete from test_wise_material_rate table by test id and trf no
		$delete_test="delete from test_wise_material_rate where `final_material_id`='$final_mat_id'";
		$result_delete_test=mysqli_query($conn,$delete_test);
		
		
		
		 // delete from span_material_assign table by test id and trf no
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