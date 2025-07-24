<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from ggbs WHERE id='$_POST[id]' AND `is_deleted`='0'";
		$select_result = mysqli_query($conn, $get_query);
		$result = mysqli_fetch_array($select_result);
		$id = $result['id'];
		$report_no = $result['report_no'];
		$job_no = $result['job_no'];
		$lab_no = $result['lab_no'];
		$ulr = $result['ulr'];

		if ($result['con_date_test'] == "0000-00-00") {
			$con_date_test = "";
		} else {
			$con_date_test = date('d/m/Y', strtotime($result['con_date_test']));
		}
		if ($result['den_date_test'] == "0000-00-00") {
			$den_date_test = "";
		} else {
			$den_date_test = date('d/m/Y', strtotime($result['den_date_test']));
		}
		$fill = array(
			'id' => $id,
			'report_no' => $report_no,
			'job_no' => $job_no,
			'lab_no' => $lab_no,
			'ulr' => $ulr,
			'amend_date' => $result['amend_date'],
			'type_of_cement' => $result['type_of_cement'],
			'cement_grade' => $result['cement_grade'],
			'cement_brand' => $result['cement_brand'],
			'week_number' => $result['week_number'],
			'chk_con' => $result['chk_con'],
			'con_temp' => $result['con_temp'],
			'con_humidity' => $result['con_humidity'],
			'con_weight' => $result['con_weight'],
			'con_date_test' => $con_date_test,
			'vol_1' => $result['vol_1'],
			'vol_2' => $result['vol_2'],
			'vol_3' => $result['vol_3'],
			'vol_4' => $result['vol_4'],
			'vol_5' => $result['vol_5'],
			'vol_6' => $result['vol_6'],
			'vol_7' => $result['vol_7'],
			'wtr_1' => $result['wtr_1'],
			'wtr_2' => $result['wtr_2'],
			'wtr_3' => $result['wtr_3'],
			'wtr_4' => $result['wtr_4'],
			'wtr_5' => $result['wtr_5'],
			'wtr_6' => $result['wtr_6'],
			'wtr_7' => $result['wtr_7'],
			'reading_1' => $result['reading_1'],
			'reading_2' => $result['reading_2'],
			'reading_3' => $result['reading_3'],
			'reading_4' => $result['reading_4'],
			'reading_5' => $result['reading_5'],
			'reading_6' => $result['reading_6'],
			'reading_7' => $result['reading_7'],
			'remark_1' => $result['remark_1'],
			'remark_2' => $result['remark_2'],
			'remark_3' => $result['remark_3'],
			'remark_4' => $result['remark_4'],
			'remark_5' => $result['remark_5'],
			'remark_6' => $result['remark_6'],
			'remark_7' => $result['remark_7'],
			'final_consistency' => $result['final_consistency'],
			'chk_sou' => $result['chk_sou'],
			'sou_date_test' => date('d/m/Y', strtotime($result['sou_date_test'])),
			'sou_weight' => $result['sou_weight'],
			'sou_water' => $result['sou_water'],
			'sou_temp' => $result['sou_temp'],
			'sou_humidity' => $result['sou_humidity'],
			'dis_1_1' => $result['dis_1_1'],
			'dis_1_2' => $result['dis_1_2'],
			'dis_2_1' => $result['dis_2_1'],
			'dis_2_2' => $result['dis_2_2'],
			'diff_1' => $result['diff_1'],
			'diff_2' => $result['diff_2'],
			'soundness' => $result['soundness'],
			'chk_set' => $result['chk_set'],
			'set_date_test' => date('d/m/Y', strtotime($result['set_date_test'])),
			'set_wtr' => $result['set_wtr'],
			'set_humidity' => $result['set_humidity'],
			'set_temp' => $result['set_temp'],
			'set_weight' => $result['set_weight'],
			'hr_a' => $result['hr_a'],
			'hr_b' => $result['hr_b'],
			'hr_c' => $result['hr_c'],
			'initial_time' => $result['initial_time'],
			'final_time' => $result['final_time'],
			'chk_den' => $result['chk_den'],
			'den_date_test' => $den_date_test,
			'den_temp' => $result['den_temp'],
			'den_humidity' => $result['den_humidity'],
			'den_intial' => $result['den_intial'],
			'den_intial1' => $result['den_intial1'],
			'den_final' => $result['den_final'],
			'den_final1' => $result['den_final1'],
			'den_displaced1' => $result['den_displaced1'],
			'den_displaced' => $result['den_displaced'],
			'density' => $result['density'],
			'density1' => $result['density1'],
			'avg_density' => $result['avg_density'],
			'den_m2' => $result['den_m2'],
			'den_m3' => $result['den_m3'],
			'den_d' => $result['den_d'],
			'den_volume' => $result['den_volume'],
			'den_weight' => $result['den_weight'],
			'chk_fines' => $result['chk_fines'],
			'constant_k' => $result['constant_k'],
			'constant_k_1' => $result['constant_k_1'],
			'fines_t_1' => $result['fines_t_1'],
			'fines_t_2' => $result['fines_t_2'],
			'fines_t_3' => $result['fines_t_3'],
			'avg_fines_time' => $result['avg_fines_time'],
			'ss_area' => $result['ss_area'],
			'chk_com' => $result['chk_com'],
			'com_date_test' => date('d/m/Y', strtotime($result['com_date_test'])),
			'report_date' => date('d/m/Y', strtotime($result['report_date'])),
			'com_temp' => $result['com_temp'],
			'com_humidity' => $result['com_humidity'],
			'weight_of_cement' => $result['weight_of_cement'],
			'weight_of_sand' => $result['weight_of_sand'],
			'weight_of_water' => $result['weight_of_water'],
			'sp_1' => $result['sp_1'],
			'sp_2' => $result['sp_2'],
			'sp_3' => $result['sp_3'],
			'caste_date1' => date('d/m/Y', strtotime($result['caste_date1'])),
			'caste_date2' => date('d/m/Y', strtotime($result['caste_date2'])),
			'caste_date3' => date('d/m/Y', strtotime($result['caste_date3'])),
			'test_date1' => date('d/m/Y', strtotime($result['test_date1'])),
			'test_date2' => date('d/m/Y', strtotime($result['test_date2'])),
			'test_date3' => date('d/m/Y', strtotime($result['test_date3'])),
			'day_1' => $result['day_1'],
			'day_2' => $result['day_2'],
			'day_3' => $result['day_3'],
			'l1' => $result['l1'],
			'l2' => $result['l2'],
			'l3' => $result['l3'],
			'l4' => $result['l4'],
			'l5' => $result['l5'],
			'l6' => $result['l6'],
			'l7' => $result['l7'],
			'l8' => $result['l8'],
			'l9' => $result['l9'],
			'b1' => $result['b1'],
			'b2' => $result['b2'],
			'b3' => $result['b3'],
			'b4' => $result['b4'],
			'b5' => $result['b5'],
			'b6' => $result['b6'],
			'b7' => $result['b7'],
			'b8' => $result['b8'],
			'b9' => $result['b9'],
			'h1' => $result['h1'],
			'h2' => $result['h2'],
			'h3' => $result['h3'],
			'h4' => $result['h4'],
			'h5' => $result['h5'],
			'h6' => $result['h6'],
			'h7' => $result['h7'],
			'h8' => $result['h8'],
			'h9' => $result['h9'],
			'area_1' => $result['area_1'],
			'area_2' => $result['area_2'],
			'area_3' => $result['area_3'],
			'area_4' => $result['area_4'],
			'area_5' => $result['area_5'],
			'area_6' => $result['area_6'],
			'area_7' => $result['area_7'],
			'area_8' => $result['area_8'],
			'area_9' => $result['area_9'],
			'load_1' => $result['load_1'],
			'load_2' => $result['load_2'],
			'load_3' => $result['load_3'],
			'load_4' => $result['load_4'],
			'load_5' => $result['load_5'],
			'load_6' => $result['load_6'],
			'load_7' => $result['load_7'],
			'load_8' => $result['load_8'],
			'load_9' => $result['load_9'],
			'com_1' => $result['com_1'],
			'com_2' => $result['com_2'],
			'com_3' => $result['com_3'],
			'com_4' => $result['com_4'],
			'com_5' => $result['com_5'],
			'com_6' => $result['com_6'],
			'com_7' => $result['com_7'],
			'com_8' => $result['com_8'],
			'com_9' => $result['com_9'],
			'avg_com_1' => $result['avg_com_1'],
			'avg_com_2' => $result['avg_com_2'],
			'avg_com_3' => $result['avg_com_3'],
			'chk_che' => $result['chk_che'],
			'cao1' => $result['cao1'],
			'cao2' => $result['cao2'],
			'cao3' => $result['cao3'],
			'cao4' => $result['cao4'],
			'so1' => $result['so1'],
			'so2' => $result['so2'],
			'so3' => $result['so3'],
			'so4' => $result['so4'],
			'sio1' => $result['sio1'],
			'sio2' => $result['sio2'],
			'sio3' => $result['sio3'],
			'sio4' => $result['sio4'],
			'sio5' => $result['sio5'],
			'sio6' => $result['sio6'],
			'sio7' => $result['sio7'],
			'r2o1' => $result['r2o1'],
			'r2o2' => $result['r2o2'],
			'r2o3' => $result['r2o3'],
			'r2o4' => $result['r2o4'],
			'r2o5' => $result['r2o5'],
			'r2o6' => $result['r2o6'],
			'r2o7' => $result['r2o7'],
			'feo1' => $result['feo1'],
			'feo2' => $result['feo2'],
			'feo3' => $result['feo3'],
			'alo1' => $result['alo1'],
			'per1' => $result['per1'],
			'res1' => $result['res1'],
			'res2' => $result['res2'],
			'res3' => $result['res3'],
			'res4' => $result['res4'],
			'mgo1' => $result['mgo1'],
			'mgo2' => $result['mgo2'],
			'mgo3' => $result['mgo3'],
			'mgo4' => $result['mgo4'],
			'ig1' => $result['ig1'],
			'ig2' => $result['ig2'],
			'ig3' => $result['ig3'],
			'ig4' => $result['ig4'],
			'cl1' => $result['cl1'],
			'cl2' => $result['cl2'],
			'cl3' => $result['cl3'],
			'cl4' => $result['cl4'],
			'cl5' => $result['cl5'],
			'cl6' => $result['cl6'],
			'chk_fbs' => $result['chk_fbs'],
			'fbs_temp' => $result['fbs_temp'],
			'fbs_humidity' => $result['fbs_humidity'],
			'fbs_w1' => $result['fbs_w1'],
			'fbs_w2' => $result['fbs_w2'],
			'fbs_m1' => $result['fbs_m1'],
			'fbs_m2' => $result['fbs_m2'],
			'fbs_p1' => $result['fbs_p1'],
			'fbs_p2' => $result['fbs_p2'],
			'avg_fbs' => $result['avg_fbs'],
			'fines_val2' => $result['fines_val2'],
			'fine_temp' => $result['fine_temp'],
			'fine_humidity' => $result['fine_humidity']



		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr = $_POST['ulr'];
		$amend_date = $_POST['amend_date'];

		$type_of_cement =  $_POST['type_of_cement'];
		$cement_brand =  $_POST['cement_brand'];
		$cement_grade = $_POST['cement_grade'];
		$week_number = $_POST['week_number'];

		$chk_con = $_POST['chk_con'];



		$con_temp = $_POST['con_temp'];
		$con_humidity = $_POST['con_humidity'];
		$con_weight = $_POST['con_weight'];
		$vol_1 = $_POST['vol_1'];
		$vol_2 = $_POST['vol_2'];
		$vol_3 = $_POST['vol_3'];
		$vol_4 = $_POST['vol_4'];
		$vol_5 = $_POST['vol_5'];
		$vol_6 = $_POST['vol_6'];
		$vol_7 = $_POST['vol_7'];
		$wtr_1 = $_POST['wtr_1'];
		$wtr_2 = $_POST['wtr_2'];
		$wtr_3 = $_POST['wtr_3'];
		$wtr_4 = $_POST['wtr_4'];
		$wtr_5 = $_POST['wtr_5'];
		$wtr_6 = $_POST['wtr_6'];
		$wtr_7 = $_POST['wtr_7'];
		$reading_1 = $_POST['reading_1'];
		$reading_2 = $_POST['reading_2'];
		$reading_3 = $_POST['reading_3'];
		$reading_4 = $_POST['reading_4'];
		$reading_5 = $_POST['reading_5'];
		$reading_6 = $_POST['reading_6'];
		$reading_7 = $_POST['reading_7'];
		$remark_1 = $_POST['remark_1'];
		$remark_2 = $_POST['remark_2'];
		$remark_3 = $_POST['remark_3'];
		$remark_4 = $_POST['remark_4'];
		$remark_5 = $_POST['remark_5'];
		$remark_6 = $_POST['remark_6'];
		$remark_7 = $_POST['remark_7'];
		$final_consistency = $_POST['final_consistency'];

		$chk_sou = $_POST['chk_sou'];
		$sou_weight = $_POST['sou_weight'];
		$sou_water = $_POST['sou_water'];
		$sou_temp = $_POST['sou_temp'];
		$sou_humidity = $_POST['sou_humidity'];

		$dis_1_1 = $_POST['dis_1_1'];
		$dis_1_2 = $_POST['dis_1_2'];
		$dis_2_1 = $_POST['dis_2_1'];
		$dis_2_2 = $_POST['dis_2_2'];
		$diff_1 = $_POST['diff_1'];
		$diff_2 = $_POST['diff_2'];
		$soundness = $_POST['soundness'];

		$chk_set = $_POST['chk_set'];
		$set_temp = $_POST['set_temp'];
		$set_wtr = $_POST['set_wtr'];
		$set_humidity = $_POST['set_humidity'];
		$set_weight = $_POST['set_weight'];

		$hr_a = $_POST['hr_a'];
		$hr_b = $_POST['hr_b'];
		$hr_c = $_POST['hr_c'];
		$initial_time = $_POST['initial_time'];
		$final_time = $_POST['final_time'];

		$chk_den = $_POST['chk_den'];
		$den_intial = $_POST['den_intial'];
		$den_intial1 = $_POST['den_intial1'];
		$den_final = $_POST['den_final'];
		$den_final1 = $_POST['den_final1'];
		$den_temp = $_POST['den_temp'];
		$den_humidity = $_POST['den_humidity'];
		$den_displaced = $_POST['den_displaced'];
		$den_displaced1 = $_POST['den_displaced1'];
		$density = $_POST['density'];
		$density1 = $_POST['density1'];
		$avg_density = $_POST['avg_density'];
		$den_m2 = $_POST['den_m2'];
		$den_m3 = $_POST['den_m3'];
		$den_d = $_POST['den_d'];
		$den_volume = $_POST['den_volume'];
		$den_weight = $_POST['den_weight'];


		$chk_fines = $_POST['chk_fines'];
		$fines_t_1 = $_POST['fines_t_1'];
		$fines_t_2 = $_POST['fines_t_2'];
		$fines_t_3 = $_POST['fines_t_3'];
		$constant_k = $_POST['constant_k'];
		$constant_k_1 = $_POST['constant_k_1'];
		$avg_fines_time = $_POST['avg_fines_time'];
		$ss_area = $_POST['ss_area'];
		$fines_val1 = $_POST['fines_val1'];
		$fines_val2 = $_POST['fines_val2'];
		$fine_temp = $_POST['fine_temp'];
		$fine_humidity = $_POST['fine_humidity'];

		$chk_che = $_POST['chk_che'];
		$cao1 = $_POST['cao1'];
		$cao2 = $_POST['cao2'];
		$cao3 = $_POST['cao3'];
		$cao4 = $_POST['cao4'];
		$so1 = $_POST['so1'];
		$so2 = $_POST['so2'];
		$so3 = $_POST['so3'];
		$so4 = $_POST['so4'];
		$sio1 = $_POST['sio1'];
		$sio2 = $_POST['sio2'];
		$sio3 = $_POST['sio3'];
		$sio4 = $_POST['sio4'];
		$sio5 = $_POST['sio5'];
		$sio6 = $_POST['sio6'];
		$sio7 = $_POST['sio7'];
		$r2o1 = $_POST['r2o1'];
		$r2o2 = $_POST['r2o2'];
		$r2o3 = $_POST['r2o3'];
		$r2o4 = $_POST['r2o4'];
		$r2o5 = $_POST['r2o5'];
		$r2o6 = $_POST['r2o6'];
		$r2o7 = $_POST['r2o7'];
		$feo1 = $_POST['feo1'];
		$feo2 = $_POST['feo2'];
		$feo3 = $_POST['feo3'];
		$alo1 = $_POST['alo1'];
		$per1 = $_POST['per1'];
		$res1 = $_POST['res1'];
		$res2 = $_POST['res2'];
		$res3 = $_POST['res3'];
		$res4 = $_POST['res4'];
		$mgo1 = $_POST['mgo1'];
		$mgo2 = $_POST['mgo2'];
		$mgo3 = $_POST['mgo3'];
		$mgo4 = $_POST['mgo4'];
		$ig1 = $_POST['ig1'];
		$ig2 = $_POST['ig2'];
		$ig3 = $_POST['ig3'];
		$ig4 = $_POST['ig4'];
		$cl1 = $_POST['cl1'];
		$cl2 = $_POST['cl2'];
		$cl3 = $_POST['cl3'];
		$cl4 = $_POST['cl4'];
		$cl5 = $_POST['cl5'];
		$cl6 = $_POST['cl6'];
		$chk_fbs = $_POST['chk_fbs'];
		$fbs_temp = $_POST['fbs_temp'];
		$fbs_humidity = $_POST['fbs_humidity'];
		$fbs_w1 = $_POST['fbs_w1'];
		$fbs_w2 = $_POST['fbs_w2'];
		$fbs_m1 = $_POST['fbs_m1'];
		$fbs_m2 = $_POST['fbs_m2'];
		$fbs_p1 = $_POST['fbs_p1'];
		$fbs_p2 = $_POST['fbs_p2'];
		$avg_fbs = $_POST['avg_fbs'];


		$chk_com = $_POST['chk_com'];

		$com_temp = $_POST['com_temp'];
		$com_humidity = $_POST['com_humidity'];
		$weight_of_cement = $_POST['weight_of_cement'];
		$weight_of_sand = $_POST['weight_of_sand'];
		$weight_of_water = $_POST['weight_of_water'];
		$sp_1 = $_POST['sp_1'];
		$sp_2 = $_POST['sp_2'];
		$sp_3 = $_POST['sp_3'];

		if ($_POST['caste_date1'] == "") {
			$caste_date1 = "0000-00-00";
		} else {
			$ref_dayc1 = substr($_POST['caste_date1'], 0, 2);
			$ref_monthc1 = substr($_POST['caste_date1'], 3, 2);
			$ref_yearc1 = substr($_POST['caste_date1'], 6, 4);
			$caste_date1 = $ref_yearc1 . "-" . $ref_monthc1 . "-" . $ref_dayc1;
		}
		if ($_POST['caste_date2'] == "") {
			$caste_date2 = "0000-00-00";
		} else {
			$ref_dayc2 = substr($_POST['caste_date2'], 0, 2);
			$ref_monthc2 = substr($_POST['caste_date2'], 3, 2);
			$ref_yearc2 = substr($_POST['caste_date2'], 6, 4);
			$caste_date2 = $ref_yearc2 . "-" . $ref_monthc2 . "-" . $ref_dayc2;
		}
		if ($_POST['caste_date3'] == "") {
			$caste_date3 = "0000-00-00";
		} else {
			$ref_dayc3 = substr($_POST['caste_date3'], 0, 2);
			$ref_monthc3 = substr($_POST['caste_date3'], 3, 2);
			$ref_yearc3 = substr($_POST['caste_date3'], 6, 4);
			$caste_date3 = $ref_yearc3 . "-" . $ref_monthc3 . "-" . $ref_dayc3;
		}

		if ($_POST['test_date1'] == "") {
			$test_date1 = "0000-00-00";
		} else {
			$ref_dayt1 = substr($_POST['test_date1'], 0, 2);
			$ref_montht1 = substr($_POST['test_date1'], 3, 2);
			$ref_yeart1 = substr($_POST['test_date1'], 6, 4);
			$test_date1 = $ref_yeart1 . "-" . $ref_montht1 . "-" . $ref_dayt1;
		}
		if ($_POST['test_date2'] == "") {
			$test_date2 = "0000-00-00";
		} else {
			$ref_dayt2 = substr($_POST['test_date2'], 0, 2);
			$ref_montht2 = substr($_POST['test_date2'], 3, 2);
			$ref_yeart2 = substr($_POST['test_date2'], 6, 4);
			$test_date2 = $ref_yeart2 . "-" . $ref_montht2 . "-" . $ref_dayt2;
		}

		if ($_POST['test_date3'] == "") {
			$test_date3 = "0000-00-00";
		} else {
			$ref_dayt3 = substr($_POST['test_date3'], 0, 2);
			$ref_montht3 = substr($_POST['test_date3'], 3, 2);
			$ref_yeart3 = substr($_POST['test_date3'], 6, 4);
			$test_date3 = $ref_yeart3 . "-" . $ref_montht3 . "-" . $ref_dayt3;
		}

		if ($_POST['con_date_test'] == "") {
			$con_date_test = "0000-00-00";
		} else {
			$ref_day = substr($_POST['con_date_test'], 0, 2);
			$ref_month = substr($_POST['con_date_test'], 3, 2);
			$ref_year = substr($_POST['con_date_test'], 6, 4);
			$con_date_test = $ref_year . "-" . $ref_month . "-" . $ref_day;
		}
		if ($_POST['sou_date_test'] == "") {

			$sou_date_test = "0000-00-00";
		} else {
			$ref_day1 = substr($_POST['sou_date_test'], 0, 2);
			$ref_month1 = substr($_POST['sou_date_test'], 3, 2);
			$ref_year1 = substr($_POST['sou_date_test'], 6, 4);
			$sou_date_test = $ref_year1 . "-" . $ref_month1 . "-" . $ref_day1;
		}
		if ($_POST['set_date_test'] == "") {
			$set_date_test = "0000-00-00";
		} else {
			$ref_day2 = substr($_POST['set_date_test'], 0, 2);
			$ref_month2 = substr($_POST['set_date_test'], 3, 2);
			$ref_year2 = substr($_POST['set_date_test'], 6, 4);
			$set_date_test = $ref_year2 . "-" . $ref_month2 . "-" . $ref_day2;
		}
		if ($_POST['den_date_test'] == "") {
			$den_date_test = "0000-00-00";
		} else {
			$ref_day3 = substr($_POST['den_date_test'], 0, 2);
			$ref_month3 = substr($_POST['den_date_test'], 3, 2);
			$ref_year3 = substr($_POST['den_date_test'], 6, 4);
			$den_date_test = $ref_year3 . "-" . $ref_month3 . "-" . $ref_day3;
		}
		if ($_POST['com_date_test'] == "") {
			$com_date_test = "0000-00-00";
		} else {
			$ref_day4 = substr($_POST['com_date_test'], 0, 2);
			$ref_month4 = substr($_POST['com_date_test'], 3, 2);
			$ref_year4 = substr($_POST['com_date_test'], 6, 4);
			$com_date_test = $ref_year4 . "-" . $ref_month4 . "-" . $ref_day4;
		}

		$ref_day4 = substr($_POST['report_date'], 0, 2);
		$ref_month4 = substr($_POST['report_date'], 3, 2);
		$ref_year4 = substr($_POST['report_date'], 6, 4);
		$report_date = $ref_year4 . "-" . $ref_month4 . "-" . $ref_day4;

		$day_1 = $_POST['day_1'];
		$day_2 = $_POST['day_2'];
		$day_3 = $_POST['day_3'];
		$l1 = $_POST['l1'];
		$l2 = $_POST['l2'];
		$l3 = $_POST['l3'];
		$l4 = $_POST['l4'];
		$l5 = $_POST['l5'];
		$l6 = $_POST['l6'];
		$l7 = $_POST['l7'];
		$l8 = $_POST['l8'];
		$l9 = $_POST['l9'];

		$b1 = $_POST['b1'];
		$b2 = $_POST['b2'];
		$b3 = $_POST['b3'];
		$b4 = $_POST['b4'];
		$b5 = $_POST['b5'];
		$b6 = $_POST['b6'];
		$b7 = $_POST['b7'];
		$b8 = $_POST['b8'];
		$b9 = $_POST['b9'];

		$h1 = $_POST['h1'];
		$h2 = $_POST['h2'];
		$h3 = $_POST['h3'];
		$h4 = $_POST['h4'];
		$h5 = $_POST['h5'];
		$h6 = $_POST['h6'];
		$h7 = $_POST['h7'];
		$h8 = $_POST['h8'];
		$h9 = $_POST['h9'];

		$area_1 = $_POST['area_1'];
		$area_2 = $_POST['area_2'];
		$area_3 = $_POST['area_3'];
		$area_4 = $_POST['area_4'];
		$area_5 = $_POST['area_5'];
		$area_6 = $_POST['area_6'];
		$area_7 = $_POST['area_7'];
		$area_8 = $_POST['area_8'];
		$area_9 = $_POST['area_9'];

		$load_1 = $_POST['load_1'];
		$load_2 = $_POST['load_2'];
		$load_3 = $_POST['load_3'];
		$load_4 = $_POST['load_4'];
		$load_5 = $_POST['load_5'];
		$load_6 = $_POST['load_6'];
		$load_7 = $_POST['load_7'];
		$load_8 = $_POST['load_8'];
		$load_9 = $_POST['load_9'];

		$com_1 = $_POST['com_1'];
		$com_2 = $_POST['com_2'];
		$com_3 = $_POST['com_3'];
		$com_4 = $_POST['com_4'];
		$com_5 = $_POST['com_5'];
		$com_6 = $_POST['com_6'];
		$com_7 = $_POST['com_7'];
		$com_8 = $_POST['com_8'];
		$com_9 = $_POST['com_9'];

		$avg_com_1 = $_POST['avg_com_1'];
		$avg_com_2 = $_POST['avg_com_2'];
		$avg_com_3 = $_POST['avg_com_3'];



		$curr_date = date("Y-m-d");



		$insert = "INSERT INTO `ggbs`(`report_no`, `ulr`, `job_no`, `lab_no`, `type_of_cement`, `cement_grade`, `cement_brand`, `week_number`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_con`, `con_date_test`, `con_temp`, `con_humidity`, `con_weight`, `vol_1`, `vol_2`, `vol_3`, `vol_4`, `vol_5`, `vol_6`, `vol_7`, `wtr_1`, `wtr_2`, `wtr_3`, `wtr_4`, `wtr_5`, `wtr_6`, `wtr_7`, `reading_1`, `reading_2`, `reading_3`, `reading_4`, `reading_5`, `reading_6`, `reading_7`, `remark_1`, `remark_2`, `remark_3`, `remark_4`, `remark_5`, `remark_6`, `remark_7`, `final_consistency`, `chk_sou`, `sou_date_test`, `sou_temp`, `sou_humidity`, `sou_weight`, `sou_water`, `dis_1_1`, `dis_1_2`, `dis_2_1`, `dis_2_2`, `diff_1`, `diff_2`, `soundness`, `chk_set`, `set_date_test`, `set_wtr`, `set_temp`, `set_humidity`, `hr_a`, `hr_b`, `hr_c`, `initial_time`, `final_time`, `chk_den`, `den_date_test`, `den_temp`, `den_humidity`, `den_intial`, `den_final`, `den_displaced`, `density`, `den_m2`, `den_m3`, `den_d`, `den_volume`, `den_weight`, `chk_fines`, `constant_k`, `fines_t_1`, `fines_t_2`, `fines_t_3`, `avg_fines_time`, `constant_k_1`, `avg_fines_time_1`, `ss_area`, `ss_area_1`, `chk_com`, `com_date_test`, `com_temp`, `com_humidity`, `weight_of_cement`, `weight_of_sand`, `weight_of_water`, `sp_1`, `sp_2`, `sp_3`, `caste_date1`, `caste_date2`, `caste_date3`, `test_date1`, `test_date2`, `test_date3`, `day_1`, `day_2`, `day_3`, `area_1`, `area_2`, `area_3`, `area_4`, `area_5`, `area_6`, `area_7`, `area_8`, `area_9`, `load_1`, `load_2`, `load_3`, `load_4`, `load_5`, `load_6`, `load_7`, `load_8`, `load_9`, `com_1`, `com_2`, `com_3`, `com_4`, `com_5`, `com_6`, `com_7`, `com_8`, `com_9`, `avg_com_1`, `avg_com_2`, `avg_com_3`, `l1`, `l2`, `l3`, `l4`, `l5`, `l6`, `l7`, `l8`, `l9`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `d_t_1`, `d_t_2`, `d_t_3`, `w_t_1`, `w_t_2`, `w_t_3`, `c_t_1`, `c_t_2`, `c_t_3`, `report_date`, `fines_val1`, `fines_val2`, `den_intial1`, `den_final1`, `den_displaced1`, `density1`, `avg_density`, `set_weight`, `fine_temp`, `fine_humidity`, `chk_che`, `cao1`, `cao2`, `cao3`, `cao4`, `so1`, `so2`, `so3`, `so4`, `sio1`, `sio2`, `sio3`, `sio4`, `sio5`, `sio6`, `sio7`, `r2o1`, `r2o2`, `r2o3`, `r2o4`, `r2o5`, `r2o6`, `r2o7`, `feo1`, `feo2`, `feo3`, `alo1`, `per1`, `res1`, `res2`, `res3`, `res4`, `mgo1`, `mgo2`, `mgo3`, `mgo4`, `ig1`, `ig2`, `ig3`, `ig4`, `cl1`, `cl2`, `cl3`, `cl4`, `cl5`, `cl6`, `chk_fbs`, `fbs_temp`, `fbs_humidity`, `fbs_w1`, `fbs_w2`, `fbs_m1`, `fbs_m2`, `fbs_p1`, `fbs_p2`, `avg_fbs`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','$type_of_cement','$cement_grade','$cement_brand','$week_number','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$chk_con','$con_date_test','$con_temp','$con_humidity','$con_weight','$vol_1','$vol_2','$vol_3','$vol_4','$vol_5','$vol_6','$vol_7','$wtr_1','$wtr_2','$wtr_3','$wtr_4','$wtr_5','$wtr_6','$wtr_7','$reading_1','$reading_2','$reading_3','$reading_4','$reading_5','$reading_6','$reading_7','$remark_1','$remark_2','$remark_3','$remark_4','$remark_5','$remark_6','$remark_7','$final_consistency','$chk_sou','$sou_date_test','$sou_temp','$sou_humidity','$sou_weight','$sou_water','$dis_1_1','$dis_1_2','$dis_2_1','$dis_2_2','$diff_1','$diff_2','$soundness','$chk_set','$set_date_test','$set_wtr','$set_temp','$set_humidity','$hr_a','$hr_b','$hr_c','$initial_time','$final_time','$chk_den','$den_date_test','$den_temp','$den_humidity','$den_intial','$den_final','$den_displaced','$density','$den_m2','$den_m3','$den_d','$den_volume','$den_weight','$chk_fines','$constant_k','$fines_t_1','$fines_t_2','$fines_t_3','$avg_fines_time','$constant_k_1','$avg_fines_time_1','$ss_area','$ss_area_1','$chk_com','$com_date_test','$com_temp','$com_humidity','$weight_of_cement','$weight_of_sand','$weight_of_water','$sp_1','$sp_2','$sp_3','$caste_date1','$caste_date2','$caste_date3','$test_date1','$test_date2','$test_date3','$day_1','$day_2','$day_3','$area_1','$area_2','$area_3','$area_4','$area_5','$area_6','$area_7','$area_8','$area_9','$load_1','$load_2','$load_3','$load_4','$load_5','$load_6','$load_7','$load_8','$load_9','$com_1','$com_2','$com_3','$com_4','$com_5','$com_6','$com_7','$com_8','$com_9','$avg_com_1','$avg_com_2','$avg_com_3','$l1','$l2','$l3','$l4','$l5','$l6','$l7','$l8','$l9','$b1','$b2','$b3','$b4','$b5','$b6','$b7','$b8','$b9','$h1','$h2','$h3','$h4','$h5','$h6','$h7','$h8','$h9','$d_t_1','$d_t_2','$d_t_3','$w_t_1','$w_t_2','$w_t_3','$c_t_1','$c_t_2','$c_t_3','$report_date','$fines_val1','$fines_val2','$den_intial1','$den_final1','$den_displaced1','$density1','$avg_density','$set_weight','$fine_temp','$fine_humidity','$chk_che','$cao1','$cao2','$cao3','$cao4','$so1','$so2','$so3','$so4','$sio1','$sio2','$sio3','$sio4','$sio5','$sio6','$sio7','$r2o1','$r2o2','$r2o3','$r2o4','$r2o5','$r2o6','$r2o7','$feo1','$feo2','$feo3','$alo1','$per1','$res1','$res2','$res3','$res4','$mgo1','$mgo2','$mgo3','$mgo4','$ig1','$ig2','$ig3','$ig4','$cl1','$cl2','$cl3','$cl4','$cl5','$cl6','$chk_fbs','$fbs_temp','$fbs_humidity','$fbs_w1','$fbs_w2','$fbs_m1','$fbs_m2','$fbs_p1','$fbs_p2','$avg_fbs','$amend_date')";

		$result_of_insert = mysqli_query($conn, $insert);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'view') {
		$lab_no = $_POST['lab_no'];

?>
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
						$query = "select * from `ggbs` WHERE lab_no='$lab_no' and `is_deleted`='0'";

						$result = mysqli_query($conn, $query);


						if (mysqli_num_rows($result) > 0) {
							while ($r = mysqli_fetch_array($result)) {

								if ($r['is_deleted'] == 0) {
						?>
									<tr>
										<td style="text-align:center;" width="10%">

											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
											<?php
											//$val =  $_SESSION['isadmin'];
											//if($val == 0 || $val == 5){
											?>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
											<?php
											//	}
											?>
										</td>
										<!--<td style="text-align:center;"><?php //echo $r['report_no'];
																			?></td>-->
										<td style="text-align:center;"><?php echo $r['job_no']; ?></td>
										<td style="text-align:center;"><?php echo $r['lab_no']; ?></td>
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
		</div>
		<br>

<?php

	} else if ($_POST['action_type'] == 'edit') {

		$curr_date = date("Y-m-d");

		if ($_POST['caste_date1'] == "") {
			$caste_date1 = "0000-00-00";
		} else {
			$ref_dayc1 = substr($_POST['caste_date1'], 0, 2);
			$ref_monthc1 = substr($_POST['caste_date1'], 3, 2);
			$ref_yearc1 = substr($_POST['caste_date1'], 6, 4);
			$caste_date1 = $ref_yearc1 . "-" . $ref_monthc1 . "-" . $ref_dayc1;
		}
		if ($_POST['caste_date2'] == "") {
			$caste_date2 = "0000-00-00";
		} else {
			$ref_dayc2 = substr($_POST['caste_date2'], 0, 2);
			$ref_monthc2 = substr($_POST['caste_date2'], 3, 2);
			$ref_yearc2 = substr($_POST['caste_date2'], 6, 4);
			$caste_date2 = $ref_yearc2 . "-" . $ref_monthc2 . "-" . $ref_dayc2;
		}
		if ($_POST['caste_date3'] == "") {
			$caste_date3 = "0000-00-00";
		} else {
			$ref_dayc3 = substr($_POST['caste_date3'], 0, 2);
			$ref_monthc3 = substr($_POST['caste_date3'], 3, 2);
			$ref_yearc3 = substr($_POST['caste_date3'], 6, 4);
			$caste_date3 = $ref_yearc3 . "-" . $ref_monthc3 . "-" . $ref_dayc3;
		}

		if ($_POST['test_date1'] == "") {
			$test_date1 = "0000-00-00";
		} else {
			$ref_dayt1 = substr($_POST['test_date1'], 0, 2);
			$ref_montht1 = substr($_POST['test_date1'], 3, 2);
			$ref_yeart1 = substr($_POST['test_date1'], 6, 4);
			$test_date1 = $ref_yeart1 . "-" . $ref_montht1 . "-" . $ref_dayt1;
		}
		if ($_POST['test_date2'] == "") {
			$test_date2 = "0000-00-00";
		} else {
			$ref_dayt2 = substr($_POST['test_date2'], 0, 2);
			$ref_montht2 = substr($_POST['test_date2'], 3, 2);
			$ref_yeart2 = substr($_POST['test_date2'], 6, 4);
			$test_date2 = $ref_yeart2 . "-" . $ref_montht2 . "-" . $ref_dayt2;
		}

		if ($_POST['test_date3'] == "") {
			$test_date3 = "0000-00-00";
		} else {
			$ref_dayt3 = substr($_POST['test_date3'], 0, 2);
			$ref_montht3 = substr($_POST['test_date3'], 3, 2);
			$ref_yeart3 = substr($_POST['test_date3'], 6, 4);
			$test_date3 = $ref_yeart3 . "-" . $ref_montht3 . "-" . $ref_dayt3;
		}

		if ($_POST['con_date_test'] == "") {
			$con_date_test = "0000-00-00";
		} else {
			$ref_day = substr($_POST['con_date_test'], 0, 2);
			$ref_month = substr($_POST['con_date_test'], 3, 2);
			$ref_year = substr($_POST['con_date_test'], 6, 4);
			$con_date_test = $ref_year . "-" . $ref_month . "-" . $ref_day;
		}
		if ($_POST['sou_date_test'] == "") {

			$sou_date_test = "0000-00-00";
		} else {
			$sou_date_test = "0000-00-00";
		}
		if ($_POST['set_date_test'] == "") {
			$set_date_test = "0000-00-00";
		} else {
			$set_date_test = "0000-00-00";
		}
		if ($_POST['den_date_test'] == "") {
			$den_date_test = "0000-00-00";
		} else {
			$den_date_test = "0000-00-00";
		}
		if ($_POST['com_date_test'] == "") {
			$com_date_test = "0000-00-00";
		} else {
			$ref_day4 = substr($_POST['com_date_test'], 0, 2);
			$ref_month4 = substr($_POST['com_date_test'], 3, 2);
			$ref_year4 = substr($_POST['com_date_test'], 6, 4);
			$com_date_test = $ref_year4 . "-" . $ref_month4 . "-" . $ref_day4;
		}
		$ref_day4 = substr($_POST['report_date'], 0, 2);
		$ref_month4 = substr($_POST['report_date'], 3, 2);
		$ref_year4 = substr($_POST['report_date'], 6, 4);
		$report_date = $ref_year4 . "-" . $ref_month4 . "-" . $ref_day4;






		$update = "update ggbs SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 
				 `type_of_cement`='$_POST[type_of_cement]',
				 `ulr`='$_POST[ulr]',
				 `cement_brand`='$_POST[cement_brand]',
				 `cement_grade`='$_POST[cement_grade]',
				 `week_number`='$_POST[week_number]',
				 `chk_con`='$_POST[chk_con]',				 
				 `con_date_test`='$con_date_test',
				 `con_temp`='$_POST[con_temp]',
				 `con_humidity`='$_POST[con_humidity]',
				 `con_weight`='$_POST[con_weight]',
				 `fine_humidity`='$_POST[fine_humidity]',
				 `fine_temp`='$_POST[fine_temp]',
				 `vol_1`='$_POST[vol_1]',
				 `vol_2`='$_POST[vol_2]',
				 `vol_3`='$_POST[vol_3]',
				 `vol_4`='$_POST[vol_4]',
				 `vol_5`='$_POST[vol_5]',
				 `vol_6`='$_POST[vol_6]',
				 `vol_7`='$_POST[vol_7]',
				 `wtr_1`='$_POST[wtr_1]',
				 `wtr_2`='$_POST[wtr_2]',
				 `wtr_3`='$_POST[wtr_3]',
				 `wtr_4`='$_POST[wtr_4]',
				 `wtr_5`='$_POST[wtr_5]',
				 `wtr_6`='$_POST[wtr_6]',
				 `wtr_7`='$_POST[wtr_7]',
				 `reading_1`='$_POST[reading_1]',
				 `reading_2`='$_POST[reading_2]',
				 `reading_3`='$_POST[reading_3]',
				 `reading_4`='$_POST[reading_4]',		
				 `reading_5`='$_POST[reading_5]',
				 `reading_6`='$_POST[reading_6]',
				 `reading_7`='$_POST[reading_7]',
				 `remark_1`='$_POST[remark_1]',
				 `remark_2`='$_POST[remark_2]',
				 `remark_3`='$_POST[remark_3]',
				 `remark_4`='$_POST[remark_4]',
				 `remark_5`='$_POST[remark_5]',
				 `remark_6`='$_POST[remark_6]',
				 `remark_7`='$_POST[remark_7]',
				 `final_consistency`='$_POST[final_consistency]',
				 `chk_sou`='$_POST[chk_sou]',
				 `sou_humidity`='$_POST[sou_humidity]',
				 `sou_date_test`='$sou_date_test',
				 `sou_weight`='$_POST[sou_weight]',
				 `sou_water`='$_POST[sou_water]',
				 `dis_1_1`='$_POST[dis_1_1]',
				 `dis_1_2`='$_POST[dis_1_2]',
				 `dis_2_1`='$_POST[dis_2_1]',
				 `dis_2_2`='$_POST[dis_2_2]',
				 `diff_1`='$_POST[diff_1]',
				 `diff_2`='$_POST[diff_2]',
				 `soundness`='$_POST[soundness]',				 
				 `chk_set`='$_POST[chk_set]',
				 `set_temp`='$_POST[set_temp]',
				 `set_date_test`='$set_date_test',
				 `set_wtr`='$_POST[set_wtr]',
				 `set_humidity`='$_POST[set_humidity]',
				 `set_weight`='$_POST[set_weight]',
				 `hr_a`='$_POST[hr_a]',
				 `hr_b`='$_POST[hr_b]',
				 `hr_c`='$_POST[hr_c]',
				 `initial_time`='$_POST[initial_time]',
				 `final_time`='$_POST[final_time]',
				 `chk_den`='$_POST[chk_den]',
				 `den_intial`='$_POST[den_intial]',
				 `den_intial1`='$_POST[den_intial1]',
				 `den_final`='$_POST[den_final]',
				 `den_final1`='$_POST[den_final1]',
				 `den_date_test`='$den_date_test',
				 `den_temp`='$_POST[den_temp]',
				 `den_humidity`='$_POST[den_humidity]',
				 `den_displaced1`='$_POST[den_displaced1]',
				 `den_displaced`='$_POST[den_displaced]',
				 `density`='$_POST[density]',
				 `density1`='$_POST[density1]',
				 `avg_density`='$_POST[avg_density]',
				 `den_m2`='$_POST[den_m2]',
				 `den_m3`='$_POST[den_m3]',
				 `den_d`='$_POST[den_d]',
				 `den_volume`='$_POST[den_volume]',
				 `den_weight`='$_POST[den_weight]',
				 `chk_fines`='$_POST[chk_fines]',
				 `fines_t_1`='$_POST[fines_t_1]',
				 `fines_t_2`='$_POST[fines_t_2]',
				 `fines_t_3`='$_POST[fines_t_3]',
				 `avg_fines_time`='$_POST[avg_fines_time]',
				 `constant_k`='$_POST[constant_k]',
				 `constant_k_1`='$_POST[constant_k_1]',
				 `ss_area`='$_POST[ss_area]',
				 `fines_val1`='$_POST[fines_val1]',				 
				 `fines_val2`='$_POST[fines_val2]',				 				 
				 `chk_com`='$_POST[chk_com]',
				 `com_date_test`='$com_date_test',
				 `report_date`='$report_date',
				 `com_temp`='$_POST[com_temp]',
				 `com_humidity`='$_POST[com_humidity]',
				 `weight_of_cement`='$_POST[weight_of_cement]',
				 `weight_of_sand`='$_POST[weight_of_sand]',
				 `weight_of_water`='$_POST[weight_of_water]',
				 `sp_1`='$_POST[sp_1]',
				 `sp_2`='$_POST[sp_2]',
				 `sp_3`='$_POST[sp_3]',
				 `caste_date1`='$caste_date1',
				 `caste_date2`='$caste_date2',
				 `caste_date3`='$caste_date3',
				 `test_date1`='$test_date1',
				 `test_date2`='$test_date2',
				 `test_date3`='$test_date3',
				 `day_1`='$_POST[day_1]',
				 `day_2`='$_POST[day_2]',
				 `day_3`='$_POST[day_3]',
				 `l1`='$_POST[l1]',
				 `l2`='$_POST[l2]',
				 `l3`='$_POST[l3]',
				 `l4`='$_POST[l4]',
				 `l5`='$_POST[l5]',
				 `l6`='$_POST[l6]',
				 `l7`='$_POST[l7]',
				 `l8`='$_POST[l8]',
				 `l9`='$_POST[l9]',
				 `b1`='$_POST[b1]',
				 `b2`='$_POST[b2]',
				 `b3`='$_POST[b3]',
				 `b4`='$_POST[b4]',
				 `b5`='$_POST[b5]',
				 `b6`='$_POST[b6]',
				 `b7`='$_POST[b7]',
				 `b8`='$_POST[b8]',
				 `b9`='$_POST[b9]',
				 `h1`='$_POST[h1]',
				 `h2`='$_POST[h2]',
				 `h3`='$_POST[h3]',
				 `h4`='$_POST[h4]',
				 `h5`='$_POST[h5]',
				 `h6`='$_POST[h6]',
				 `h7`='$_POST[h7]',
				 `h8`='$_POST[h8]',
				 `h9`='$_POST[h9]',
				 `area_1`='$_POST[area_1]',
				 `area_2`='$_POST[area_2]',
				 `area_3`='$_POST[area_3]',
				 `area_4`='$_POST[area_4]',
				 `area_5`='$_POST[area_5]',
				 `area_6`='$_POST[area_6]',
				 `area_7`='$_POST[area_7]',
				 `area_8`='$_POST[area_8]',
				 `area_9`='$_POST[area_9]',
				 `load_1`='$_POST[load_1]',
				 `load_2`='$_POST[load_2]',
				 `load_3`='$_POST[load_3]',
				 `load_4`='$_POST[load_4]',
				 `load_5`='$_POST[load_5]',
				 `load_6`='$_POST[load_6]',
				 `load_7`='$_POST[load_7]',
				 `load_8`='$_POST[load_8]',
				 `load_9`='$_POST[load_9]',
				 `com_1`='$_POST[com_1]',
				 `com_2`='$_POST[com_2]',
				 `com_3`='$_POST[com_3]',
				 `com_4`='$_POST[com_4]',
				 `com_5`='$_POST[com_5]',
				 `com_6`='$_POST[com_6]',
				 `com_7`='$_POST[com_7]',
				 `com_8`='$_POST[com_8]',
				 `com_9`='$_POST[com_9]',
				 `avg_com_1`='$_POST[avg_com_1]',
				 `avg_com_2`='$_POST[avg_com_2]',
				 `avg_com_3`='$_POST[avg_com_3]',
				 `chk_che`='$_POST[chk_che]',
				 `cao1`='$_POST[cao1]',
				 `cao2`='$_POST[cao2]',
				 `cao3`='$_POST[cao3]',
				 `cao4`='$_POST[cao4]',
				 `so1`='$_POST[so1]',
				 `so2`='$_POST[so2]',
				 `so3`='$_POST[so3]',
				 `so4`='$_POST[so4]',
				 `sio1`='$_POST[sio1]',
				 `sio2`='$_POST[sio2]',
				 `sio3`='$_POST[sio3]',
				 `sio4`='$_POST[sio4]',
				 `sio5`='$_POST[sio5]',
				 `sio6`='$_POST[sio6]',
				 `sio7`='$_POST[sio7]',
				 `r2o1`='$_POST[r2o1]',
				 `r2o2`='$_POST[r2o2]',
				 `r2o3`='$_POST[r2o3]',
				 `r2o4`='$_POST[r2o4]',
				 `r2o5`='$_POST[r2o5]',
				 `r2o6`='$_POST[r2o6]',
				 `r2o7`='$_POST[r2o7]',
				 `feo1`='$_POST[feo1]',
				 `feo2`='$_POST[feo2]',
				 `feo3`='$_POST[feo3]',
				 `alo1`='$_POST[alo1]',
				 `per1`='$_POST[per1]',
				 `res1`='$_POST[res1]',
				 `res2`='$_POST[res2]',
				 `res3`='$_POST[res3]',
				 `res4`='$_POST[res4]',
				 `mgo1`='$_POST[mgo1]',
				 `mgo2`='$_POST[mgo2]',
				 `mgo3`='$_POST[mgo3]',
				 `mgo4`='$_POST[mgo4]',
				 `ig1`='$_POST[ig1]',
				 `ig2`='$_POST[ig2]',
				 `ig3`='$_POST[ig3]',
				 `ig4`='$_POST[ig4]',
				 `cl1`='$_POST[cl1]',
				 `cl2`='$_POST[cl2]',
				 `cl3`='$_POST[cl3]',
				 `cl4`='$_POST[cl4]',
				 `cl5`='$_POST[cl5]',
				 `cl6`='$_POST[cl6]',
				 `chk_fbs`='$_POST[chk_fbs]',
				 `fbs_temp`='$_POST[fbs_temp]',
				 `fbs_humidity`='$_POST[fbs_humidity]',
				 `fbs_w1`='$_POST[fbs_w1]',
				 `fbs_w2`='$_POST[fbs_w2]',
				 `fbs_p1`='$_POST[fbs_p1]',
				 `fbs_p2`='$_POST[fbs_p2]',
				 `avg_fbs`='$_POST[avg_fbs]',
				 `fbs_m1`='$_POST[fbs_m1]',
				 `fbs_m2`='$_POST[fbs_m2]',
				 `amend_date`='$_POST[amend_date]'
				 WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update ggbs SET `is_deleted`='1',`deleted_by`='$_SESSION[name]'WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM ggbs WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update ggbs SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update ggbs SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>