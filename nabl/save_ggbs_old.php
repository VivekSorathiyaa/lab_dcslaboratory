<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from ggbs WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
			$select_result = mysqli_query($conn, $get_query);
			$result=mysqli_fetch_array($select_result);
			$id=$result['id'];
			$report_no=$result['report_no'];
			$job_no=$result['job_no'];
			$lab_no=$result['lab_no'];
			$ulr=$result['ulr'];
			
			if($result['con_date_test'] == "0000-00-00")
			{
				$con_date_test="";
			}
			else
			{
				$con_date_test = date('d/m/Y', strtotime($result['con_date_test']));							
			}
			if($result['den_date_test'] == "0000-00-00")
			{
				$den_date_test="";
			}
			else
			{
				$den_date_test = date('d/m/Y', strtotime($result['den_date_test']));						
			}
			$fill = array(
							'id' => $id,
							'report_no' => $report_no,
							'ulr' => $result['ulr'],
							'job_no' => $job_no,
							'lab_no' => $lab_no,	
							'chk_con' => $result['chk_con'],
							'con_date_test' => $result['con_date_test'],							
							'con_temp' => $result['con_temp'],							
							'con_humidity' => $result['con_humidity'],							
							'con_weight' => $result['con_weight'],							
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
							'chk_fines' => $result['chk_fines'],
							'den_date_test' => $result['den_date_test'],
							'den_cement' => $result['den_cement'],
							'fine_temp' => $result['fine_temp'],
							'fine_humidity' => $result['fine_humidity'],
							'den_intial' => $result['den_intial'],
							'den_final' => $result['den_final'],
							'density' => $result['density'],
							'mass' => $result['mass'],
							'x' => $result['x'],							
							'v' => $result['v'],							
							'p' => $result['p'],							
							'constant_k' => $result['constant_k'],
							'fines_t_1' => $result['fines_t_1'],
							'fines_t_2' => $result['fines_t_2'],
							'fines_t_3' => $result['fines_t_3'],
							'fines_t_4' => $result['fines_t_4'],
							'avg_fines_time' => $result['avg_fines_time'],
							'ss_area' => $result['ss_area'],
							'chk_com' => $result['chk_com'],
							'com_date_test' => $result['com_date_test'],
							'weight_of_cement' => $result['weight_of_cement'],
							'weight_of_sand' => $result['weight_of_sand'],
							'weight_of_water' => $result['weight_of_water'],
							'com_temp' => $result['com_temp'],
							'com_temp1' => $result['com_temp1'],
							'com_temp2' => $result['com_temp2'],
							'com_temp3' => $result['com_temp3'],
							'com_humidity' => $result['com_humidity'],
							'com_humidity1' => $result['com_humidity1'],
							'com_humidity2' => $result['com_humidity2'],
							'com_humidity3' => $result['com_humidity3'],
							'sp_1' => $result['sp_1'],
							'sp_2' => $result['sp_2'],
							'sp_3' => $result['sp_3'],
							'sp_4' => $result['sp_4'],
							'caste_date1' => $result['caste_date1'],
							'caste_date2' => $result['caste_date2'],
							'caste_date3' => $result['caste_date3'],
							'caste_date4' => $result['caste_date4'],
							'test_date1' => $result['test_date1'],
							'test_date2' => $result['test_date2'],
							'test_date3' => $result['test_date3'],
							'test_date4' => $result['test_date4'],
							'day_1' => $result['day_1'],
							'day_2' => $result['day_2'],
							'day_3' => $result['day_3'],
							'day_4' => $result['day_4'],
							'area_1' => $result['area_1'],
							'area_2' => $result['area_2'],
							'area_3' => $result['area_3'],
							'area_4' => $result['area_4'],
							'area_5' => $result['area_5'],
							'area_6' => $result['area_6'],
							'area_7' => $result['area_7'],
							'area_8' => $result['area_8'],
							'area_9' => $result['area_9'],
							'area_10' => $result['area_10'],
							'area_11' => $result['area_11'],
							'area_12' => $result['area_12'],
							'load_1' => $result['load_1'],
							'load_2' => $result['load_2'],
							'load_3' => $result['load_3'],
							'load_4' => $result['load_4'],
							'load_5' => $result['load_5'],
							'load_6' => $result['load_6'],
							'load_7' => $result['load_7'],
							'load_8' => $result['load_8'],
							'load_9' => $result['load_9'],
							'load_10' => $result['load_10'],
							'load_11' => $result['load_11'],
							'load_12' => $result['load_12'],
							'com_1' => $result['com_1'],
							'com_2' => $result['com_2'],
							'com_3' => $result['com_3'],
							'com_4' => $result['com_4'],
							'com_5' => $result['com_5'],
							'com_6' => $result['com_6'],
							'com_7' => $result['com_7'],
							'com_8' => $result['com_8'],
							'com_9' => $result['com_9'],
							'com_10' => $result['com_10'],
							'com_11' => $result['com_11'],
							'com_12' => $result['com_12'],
							'avg_com_1' => $result['avg_com_1'],
							'avg_com_2' => $result['avg_com_2'],
							'avg_com_3' => $result['avg_com_3'],
							'avg_com_4' => $result['avg_com_4'],
							'l1' => $result['l1'],
							'l2' => $result['l2'],
							'l3' => $result['l3'],
							'l4' => $result['l4'],
							'l5' => $result['l5'],
							'l6' => $result['l6'],
							'l7' => $result['l7'],
							'l8' => $result['l8'],
							'l9' => $result['l9'],
							'l10' => $result['l10'],
							'l11' => $result['l11'],
							'l12' => $result['l12'],
							'b1' => $result['b1'],
							'b2' => $result['b2'],
							'b3' => $result['b3'],
							'b4' => $result['b4'],
							'b5' => $result['b5'],
							'b6' => $result['b6'],
							'b7' => $result['b7'],
							'b8' => $result['b8'],
							'b9' => $result['b9'],
							'b10' => $result['b10'],
							'b11' => $result['b11'],
							'b12' => $result['b12'],
							'report_date' => $result['report_date'],
							'chk_mou' => $result['chk_mou'],
							'in_w1' => $result['in_w1'],
							'in_w2' => $result['in_w2'],
							'fn_w1' => $result['fn_w1'],
							'fn_w2' => $result['fn_w2'],
							'mo1' => $result['mo1'],
							'mo2' => $result['mo2'],
							'avg_mo' => $result['avg_mo'],
							'chk_set' => $result['chk_set'],
							'it_1' => $result['it_1'],
							'it_2' => $result['it_2'],
							'ft_1' => $result['ft_1'],
							'ft_2' => $result['ft_2'],
							'it_ft_1' => $result['it_ft_1'],
							'it_ft_2' => $result['it_ft_2'],
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
							'soundness' => $result['soundness']			
												
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
					
					
			$chk_con = $_POST['chk_con'];
			$top_c_date = $_POST['con_date_test'];
			$tt=str_replace('/','-',$top_c_date);
			$con_date_test=date('Y-m-d',strtotime($tt));
			
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
			
			$chk_fines = $_POST['chk_fines'];			
			
			$top_c_date3 = $_POST['den_date_test'];
			$tt3=str_replace('/','-',$top_c_date3);
			$den_date_test=date('Y-m-d',strtotime($tt3));
			
			$den_cement = $_POST['den_cement'];	
			$fine_temp = $_POST['fine_temp'];	
			$fine_humidity = $_POST['fine_humidity'];		
			$den_intial = $_POST['den_intial'];	
			$den_final = $_POST['den_final'];
			
			$density = $_POST['density'];
			$mass = $_POST['mass'];
			$x = $_POST['x'];
			$v = $_POST['v'];
			$p = $_POST['p'];
			$constant_k = $_POST['constant_k'];
			$fines_t_1 = $_POST['fines_t_1'];			
			$fines_t_2 = $_POST['fines_t_2'];			
			$fines_t_3 = $_POST['fines_t_3'];
			$fines_t_4 = $_POST['fines_t_4'];
			$avg_fines_time = $_POST['avg_fines_time'];
			$ss_area = $_POST['ss_area'];
			$chk_com = $_POST['chk_com'];
			
			
			$top_c_date4 = $_POST['com_date_test'];
			$tt4=str_replace('/','-',$top_c_date4);
			$com_date_test=date('Y-m-d',strtotime($tt4));
			
			$weight_of_cement = $_POST['weight_of_cement'];			
			$weight_of_sand = $_POST['weight_of_sand'];
			$weight_of_water = $_POST['weight_of_water'];
			$com_temp = $_POST['com_temp'];	
			$com_temp1 = $_POST['com_temp1'];	
			$com_temp2 = $_POST['com_temp2'];	
			$com_temp3 = $_POST['com_temp3'];	
			$com_humidity = $_POST['com_humidity'];			
			$com_humidity1 = $_POST['com_humidity1'];			
			$com_humidity2 = $_POST['com_humidity2'];			
			$com_humidity3 = $_POST['com_humidity3'];			
			
			$sp_1 = $_POST['sp_1'];			
			$sp_2 = $_POST['sp_2'];			
			$sp_3 = $_POST['sp_3'];
			$sp_4 = $_POST['sp_4'];
			
			$chk_set = $_POST['chk_set'];
			$it_1 = $_POST['it_1'];
			$it_2 = $_POST['it_2'];
			$ft_1 = $_POST['ft_1'];
			$ft_2 = $_POST['ft_2'];
			$it_ft_1 = $_POST['it_ft_1'];
			$it_ft_2 = $_POST['it_ft_2'];
			
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
			
			
			$top_c_date5 = $_POST['caste_date1'];
			$tt5=str_replace('/','-',$top_c_date5);
			$caste_date1=date('Y-m-d',strtotime($tt5));
			
			
			$top_c_date6 = $_POST['caste_date2'];
			$tt6=str_replace('/','-',$top_c_date6);
			$caste_date2=date('Y-m-d',strtotime($tt6));
			
			
			$top_c_date7 = $_POST['caste_date3'];
			$tt7=str_replace('/','-',$top_c_date7);
			$caste_date3=date('Y-m-d',strtotime($tt7));
			
			$top_c_date8 = $_POST['caste_date4'];
			$tt8=str_replace('/','-',$top_c_date8);
			$caste_date4=date('Y-m-d',strtotime($tt8));
			
			
			$top_c_date9 = $_POST['test_date1'];
			$tt9=str_replace('/','-',$top_c_date9);
			$test_date1=date('Y-m-d',strtotime($tt9));
			
			$top_c_date10 = $_POST['test_date2'];
			$tt10=str_replace('/','-',$top_c_date10);
			$test_date2=date('Y-m-d',strtotime($tt10));
			
			
			
			
			
			$top_c_date11 = $_POST['test_date3'];
			$tt11=str_replace('/','-',$top_c_date11);
			$test_date3=date('Y-m-d',strtotime($tt11));
			
			
			$top_c_date12 = $_POST['test_date4'];
			$tt12=str_replace('/','-',$top_c_date12);
			$test_date4=date('Y-m-d',strtotime($tt12));
			
			$day_1 = $_POST['day_1'];
			$day_2 = $_POST['day_2'];
			$day_3 = $_POST['day_3'];
			$day_4 = $_POST['day_4'];
			
			
			$area_1 = $_POST['area_1'];			
			$area_2 = $_POST['area_2'];			
			$area_3 = $_POST['area_3'];			
			$area_4 = $_POST['area_4'];			
			$area_5 = $_POST['area_5'];			
			$area_6 = $_POST['area_6'];			
			$area_7 = $_POST['area_7'];			
			$area_8 = $_POST['area_8'];			
			$area_9 = $_POST['area_9'];
			$area_10 = $_POST['area_10'];
			$area_11 = $_POST['area_11'];
			$area_12 = $_POST['area_12'];
			
			$load_1 = $_POST['load_1'];			
			$load_2 = $_POST['load_2'];			
			$load_3 = $_POST['load_3'];			
			$load_4 = $_POST['load_4'];			
			$load_5 = $_POST['load_5'];			
			$load_6 = $_POST['load_6'];			
			$load_7 = $_POST['load_7'];			
			$load_8 = $_POST['load_8'];			
			$load_9 = $_POST['load_9'];
			$load_10 = $_POST['load_10'];
			$load_11 = $_POST['load_11'];
			$load_12 = $_POST['load_12'];
			
			$com_1 = $_POST['com_1'];			
			$com_2 = $_POST['com_2'];			
			$com_3 = $_POST['com_3'];			
			$com_4 = $_POST['com_4'];			
			$com_5 = $_POST['com_5'];			
			$com_6 = $_POST['com_6'];			
			$com_7 = $_POST['com_7'];			
			$com_8 = $_POST['com_8'];			
			$com_9 = $_POST['com_9'];
			$com_10 = $_POST['com_10'];
			$com_11 = $_POST['com_11'];
			$com_12 = $_POST['com_12'];
			
			$avg_com_1 = $_POST['avg_com_1'];			
			$avg_com_2 = $_POST['avg_com_2'];			
			$avg_com_3 = $_POST['avg_com_3'];
			$avg_com_4 = $_POST['avg_com_4'];
			
			$l1 = $_POST['l1'];			
			$l2 = $_POST['l2'];			
			$l3 = $_POST['l3'];			
			$l4 = $_POST['l4'];			
			$l5 = $_POST['l5'];			
			$l6 = $_POST['l6'];			
			$l7 = $_POST['l7'];			
			$l8 = $_POST['l8'];			
			$l9 = $_POST['l9'];
			$l10 = $_POST['l10'];
			$l11 = $_POST['l11'];
			$l12 = $_POST['l12'];
			
			$b1 = $_POST['b1'];			
			$b2 = $_POST['b2'];			
			$b3 = $_POST['b3'];			
			$b4 = $_POST['b4'];			
			$b5 = $_POST['b5'];			
			$b6 = $_POST['b6'];			
			$b7 = $_POST['b7'];			
			$b8 = $_POST['b8'];			
			$b9 = $_POST['b9'];
			$b10 = $_POST['b10'];
			$b11 = $_POST['b11'];
			$b12 = $_POST['b12'];
			
			$chk_mou = $_POST['chk_mou'];
			$in_w1 = $_POST['in_w1'];
			$in_w2 = $_POST['in_w2'];
			$fn_w1 = $_POST['fn_w1'];
			$fn_w2 = $_POST['fn_w2'];
			$mo1 = $_POST['mo1'];
			$mo2 = $_POST['mo2'];
			$avg_mo = $_POST['avg_mo'];
			
			
			
			
			$top_c_date13 = $_POST['report_date'];
			$tt13=str_replace('/','-',$top_c_date13);
			$report_date=date('Y-m-d',strtotime($tt13));
			
			
		
			
			$curr_date=date("Y-m-d");
	
			
			
			
		   $insert="INSERT INTO `ggbs`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_con`, `con_date_test`, `con_temp`, `con_humidity`, `con_weight`, `vol_1`, `vol_2`, `vol_3`, `vol_4`, `vol_5`, `vol_6`, `vol_7`, `wtr_1`, `wtr_2`, `wtr_3`, `wtr_4`, `wtr_5`, `wtr_6`, `wtr_7`, `reading_1`, `reading_2`, `reading_3`, `reading_4`, `reading_5`, `reading_6`, `reading_7`, `remark_1`, `remark_2`, `remark_3`, `remark_4`, `remark_5`, `remark_6`, `remark_7`, `final_consistency`, `chk_fines`, `den_date_test`, `den_cement`, `fine_temp`, `fine_humidity`, `den_intial`, `den_final`, `density`, `mass`, `x`, `v`, `p`, `constant_k`, `fines_t_1`, `fines_t_2`, `fines_t_3`, `fines_t_4`, `avg_fines_time`, `ss_area`, `chk_com`, `com_date_test`, `weight_of_cement`, `weight_of_sand`, `weight_of_water`, `com_temp`, `com_temp1`, `com_temp2`, `com_temp3`, `com_humidity`, `com_humidity1`, `com_humidity2`, `com_humidity3`, `sp_1`, `sp_2`, `sp_3`, `sp_4`, `caste_date1`, `caste_date2`, `caste_date3`, `caste_date4`, `test_date1`, `test_date2`, `test_date3`, `test_date4`, `day_1`, `day_2`, `day_3`, `day_4`, `area_1`, `area_2`, `area_3`, `area_4`, `area_5`, `area_6`, `area_7`, `area_8`, `area_9`, `area_10`, `area_11`, `area_12`, `load_1`, `load_2`, `load_3`, `load_4`, `load_5`, `load_6`, `load_7`, `load_8`, `load_9`, `load_10`, `load_11`, `load_12`, `com_1`, `com_2`, `com_3`, `com_4`, `com_5`, `com_6`, `com_7`, `com_8`, `com_9`, `com_10`, `com_11`, `com_12`, `avg_com_1`, `avg_com_2`, `avg_com_3`, `avg_com_4`, `l1`, `l2`, `l3`, `l4`, `l5`, `l6`, `l7`, `l8`, `l9`, `l10`, `l11`, `l12`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `b10`, `b11`, `b12`, `report_date`, `chk_mou`, `in_w1`, `in_w2`, `fn_w1`, `fn_w2`, `mo1`, `mo2`, `avg_mo`, `chk_set`, `it_1`, `it_2`, `ft_1`, `ft_2`, `it_ft_1`, `it_ft_2`, `chk_sou`, `sou_date_test`, `sou_temp`, `sou_humidity`, `sou_weight`, `sou_water`, `dis_1_1`, `dis_1_2`, `dis_2_1`, `dis_2_2`, `diff_1`, `diff_2`, `soundness`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_con', '$con_date_test', '$con_temp', '$con_humidity', '$con_weight', '$vol_1', '$vol_2', '$vol_3', '$vol_4', '$vol_5', '$vol_6', '$vol_7', '$wtr_1', '$wtr_2', '$wtr_3', '$wtr_4', '$wtr_5', '$wtr_6', '$wtr_7', '$reading_1', '$reading_2', '$reading_3', '$reading_4', '$reading_5', '$reading_6', '$reading_7', '$remark_1', '$remark_2', '$remark_3', '$remark_4', '$remark_5', '$remark_6', '$remark_7', '$final_consistency', '$chk_fines', '$den_date_test', '$den_cement', '$fine_temp', '$fine_humidity', '$den_intial', '$den_final', '$density', '$mass', '$x', '$v', '$p', '$constant_k', '$fines_t_1', '$fines_t_2', '$fines_t_3', '$fines_t_4', '$avg_fines_time', '$ss_area', '$chk_com', '$com_date_test', '$weight_of_cement', '$weight_of_sand', '$weight_of_water', '$com_temp', '$com_temp1', '$com_temp2', '$com_temp3', '$com_humidity', '$com_humidity1', '$com_humidity2', '$com_humidity3', '$sp_1', '$sp_2', '$sp_3', '$sp_4', '$caste_date1', '$caste_date2', '$caste_date3', '$caste_date4', '$test_date1', '$test_date2', '$test_date3', '$test_date4', '$day_1', '$day_2', '$day_3', '$day_4', '$area_1', '$area_2', '$area_3', '$area_4', '$area_5', '$area_6', '$area_7', '$area_8', '$area_9', '$area_10', '$area_11', '$area_12', '$load_1', '$load_2', '$load_3', '$load_4', '$load_5', '$load_6', '$load_7', '$load_8', '$load_9', '$load_10', '$load_11', '$load_12', '$com_1', '$com_2', '$com_3', '$com_4', '$com_5', '$com_6', '$com_7', '$com_8', '$com_9', '$com_10', '$com_11', '$com_12', '$avg_com_1', '$avg_com_2', '$avg_com_3', '$avg_com_4', '$l1', '$l2', '$l3', '$l4', '$l5', '$l6', '$l7', '$l8', '$l9', '$l10', '$l11', '$l12', '$b1', '$b2', '$b3', '$b4', '$b5', '$b6', '$b7', '$b8', '$b9', '$b10', '$b11', '$b12', '$report_date','$chk_mou', '$in_w1', '$in_w2', '$fn_w1', '$fn_w2', '$mo1', '$mo2', '$avg_mo', '$chk_set', '$it_1', '$it_2', '$ft_1', '$ft_2', '$it_ft_1', '$it_ft_2','$chk_sou','$sou_date_test','$sou_temp','$sou_humidity','$sou_weight','$sou_water','$dis_1_1','$dis_1_2','$dis_2_1','$dis_2_2','$diff_1','$diff_2','$soundness')";  
			
			$result_of_insert=mysqli_query($conn,$insert);	
			
			$fill = array('lab_no' => $_POST['lab_no']); 
			echo json_encode($fill);			
		}
		else if($_POST['action_type'] == 'view')
		{
			$lab_no =$_POST['lab_no']; 
	
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
													while($r = mysqli_fetch_array($result)){
											
																if($r['is_deleted'] == 0){
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
								</div>
							<br>

		<?php
		
    }
	else if($_POST['action_type'] == 'edit'){
		
			$curr_date = date("Y-m-d");
			
			$top_c_date5 = $_POST['caste_date1'];
			$tt5=str_replace('/','-',$top_c_date5);
			$caste_date1=date('Y-m-d',strtotime($tt5));
			
			
			$top_c_date6 = $_POST['caste_date2'];
			$tt6=str_replace('/','-',$top_c_date6);
			$caste_date2=date('Y-m-d',strtotime($tt6));
			
			
			$top_c_date7 = $_POST['caste_date3'];
			$tt7=str_replace('/','-',$top_c_date7);
			$caste_date3=date('Y-m-d',strtotime($tt7));
			
			$top_c_date8 = $_POST['caste_date4'];
			$tt8=str_replace('/','-',$top_c_date8);
			$caste_date4=date('Y-m-d',strtotime($tt8));
			
			
			$top_c_date9 = $_POST['test_date1'];
			$tt9=str_replace('/','-',$top_c_date9);
			$test_date1=date('Y-m-d',strtotime($tt9));
			
			
			
			$top_c_date10 = $_POST['test_date2'];
			$tt10=str_replace('/','-',$top_c_date10);
			$test_date2=date('Y-m-d',strtotime($tt10));
			
			
			
			$top_c_date11 = $_POST['test_date3'];
			$tt11=str_replace('/','-',$top_c_date11);
			$test_date3=date('Y-m-d',strtotime($tt11));
			
			
			$top_c_date12 = $_POST['test_date4'];
			$tt12=str_replace('/','-',$top_c_date12);
			$test_date4=date('Y-m-d',strtotime($tt12));
			
			$top_c_date13 = $_POST['report_date'];
			$tt13=str_replace('/','-',$top_c_date13);
			$report_date=date('Y-m-d',strtotime($tt13));
			
			
			
			
			
			
			$top_c_date16 = $_POST['con_date_test'];
			$tt16=str_replace('/','-',$top_c_date16);
			$con_date_test=date('Y-m-d',strtotime($tt16));
			
			
			
			
			$top_c_date3 = $_POST['den_date_test'];
			$tt3=str_replace('/','-',$top_c_date3);
			$den_date_test=date('Y-m-d',strtotime($tt3));
			
			$top_c_date4 = $_POST['com_date_test'];
			$tt4=str_replace('/','-',$top_c_date4);
			$com_date_test=date('Y-m-d',strtotime($tt4));
			
			
			
			
			
			
			
		$update="update ggbs SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					`modified_by`='$_SESSION[name]',
					`modified_date`='$curr_date',					
					`checked_by`=NULL,					 
					`ulr`='$_POST[ulr]',
					`chk_con`= '$_POST[chk_con]',
					`con_date_test`= '$con_date_test',
					`con_temp`= '$_POST[con_temp]',
					`con_humidity`= '$_POST[con_humidity]',
					`con_weight`= '$_POST[con_weight]',
					`vol_1`= '$_POST[vol_1]',
					`vol_2`= '$_POST[vol_2]',
					`vol_3`= '$_POST[vol_3]',
					`vol_4`= '$_POST[vol_4]',
					`vol_5`= '$_POST[vol_5]',
					`vol_6`= '$_POST[vol_6]',
					`vol_7`= '$_POST[vol_7]',
					`wtr_1`= '$_POST[wtr_1]',
					`wtr_2`= '$_POST[wtr_2]',
					`wtr_3`= '$_POST[wtr_3]',
					`wtr_4`= '$_POST[wtr_4]',
					`wtr_5`= '$_POST[wtr_5]',
					`wtr_6`= '$_POST[wtr_6]',
					`wtr_7`= '$_POST[wtr_7]',
					`reading_1`= '$_POST[reading_1]',
					`reading_2`= '$_POST[reading_2]',
					`reading_3`= '$_POST[reading_3]',
					`reading_4`= '$_POST[reading_4]',
					`reading_5`= '$_POST[reading_5]',
					`reading_6`= '$_POST[reading_6]',
					`reading_7`= '$_POST[reading_7]',
					`remark_1`= '$_POST[remark_1]',
					`remark_2`= '$_POST[remark_2]',
					`remark_3`= '$_POST[remark_3]',
					`remark_4`= '$_POST[remark_4]',
					`remark_5`= '$_POST[remark_5]',
					`remark_6`= '$_POST[remark_6]',
					`remark_7`= '$_POST[remark_7]',
					`final_consistency`= '$_POST[final_consistency]',
					`chk_fines`= '$_POST[chk_fines]',
					`den_date_test`= '$den_date_test',
					`den_cement`= '$_POST[den_cement]',
					`fine_temp`= '$_POST[fine_temp]',
					`fine_humidity`= '$_POST[fine_humidity]',
					`den_intial`= '$_POST[den_intial]',
					`den_final`= '$_POST[den_final]',
					`density`= '$_POST[density]',
					`mass`= '$_POST[mass]',
					`v`= '$_POST[v]',
					`p`= '$_POST[p]',
					`x`= '$_POST[x]',
					`constant_k`= '$_POST[constant_k]',
					`fines_t_1`= '$_POST[fines_t_1]',
					`fines_t_2`= '$_POST[fines_t_2]',
					`fines_t_3`= '$_POST[fines_t_3]',
					`fines_t_4`= '$_POST[fines_t_4]',
					`avg_fines_time`= '$_POST[avg_fines_time]',
					`ss_area`= '$_POST[ss_area]',
					`chk_com`= '$_POST[chk_com]',
					`com_date_test`= '$com_date_test',
					`weight_of_cement`= '$_POST[weight_of_cement]',
					`weight_of_sand`= '$_POST[weight_of_sand]',
					`weight_of_water`= '$_POST[weight_of_water]',
					`com_temp`= '$_POST[com_temp]',
					`com_temp1`= '$_POST[com_temp1]',
					`com_temp2`= '$_POST[com_temp2]',
					`com_temp3`= '$_POST[com_temp3]',
					`com_humidity`= '$_POST[com_humidity]',
					`com_humidity1`= '$_POST[com_humidity1]',
					`com_humidity2`= '$_POST[com_humidity2]',
					`com_humidity3`= '$_POST[com_humidity3]',
					`sp_1`= '$_POST[sp_1]',
					`sp_2`= '$_POST[sp_2]',
					`sp_3`= '$_POST[sp_3]',
					`sp_4`= '$_POST[sp_4]',
					`caste_date1`= '$caste_date1',
					`caste_date2`= '$caste_date2',
					`caste_date3`= '$caste_date3',
					`caste_date4`= '$caste_date4',
					`test_date1`= '$test_date1',
					`test_date2`= '$test_date2',
					`test_date3`= '$test_date3',
					`test_date4`= '$test_date4',
					`day_1`= '$_POST[day_1]',
					`day_2`= '$_POST[day_2]',
					`day_3`= '$_POST[day_3]',
					`day_4`= '$_POST[day_4]',
					`area_1`= '$_POST[area_1]',
					`area_2`= '$_POST[area_2]',
					`area_3`= '$_POST[area_3]',
					`area_4`= '$_POST[area_4]',
					`area_5`= '$_POST[area_5]',
					`area_6`= '$_POST[area_6]',
					`area_7`= '$_POST[area_7]',
					`area_8`= '$_POST[area_8]',
					`area_9`= '$_POST[area_9]',
					`area_10`= '$_POST[area_10]',
					`area_11`= '$_POST[area_11]',
					`area_12`= '$_POST[area_12]',
					`load_1`= '$_POST[load_1]',
					`load_2`= '$_POST[load_2]',
					`load_3`= '$_POST[load_3]',
					`load_4`= '$_POST[load_4]',
					`load_5`= '$_POST[load_5]',
					`load_6`= '$_POST[load_6]',
					`load_7`= '$_POST[load_7]',
					`load_8`= '$_POST[load_8]',
					`load_9`= '$_POST[load_9]',
					`load_10`= '$_POST[load_10]',
					`load_11`= '$_POST[load_11]',
					`load_12`= '$_POST[load_12]',
					`com_1`= '$_POST[com_1]',
					`com_2`= '$_POST[com_2]',
					`com_3`= '$_POST[com_3]',
					`com_4`= '$_POST[com_4]',
					`com_5`= '$_POST[com_5]',
					`com_6`= '$_POST[com_6]',
					`com_7`= '$_POST[com_7]',
					`com_8`= '$_POST[com_8]',
					`com_9`= '$_POST[com_9]',
					`com_10`= '$_POST[com_10]',
					`com_11`= '$_POST[com_11]',
					`com_12`= '$_POST[com_12]',
					`avg_com_1`= '$_POST[avg_com_1]',
					`avg_com_2`= '$_POST[avg_com_2]',
					`avg_com_3`= '$_POST[avg_com_3]',
					`avg_com_4`= '$_POST[avg_com_4]',
					`l1`= '$_POST[l1]',
					`l2`= '$_POST[l2]',
					`l3`= '$_POST[l3]',
					`l4`= '$_POST[l4]',
					`l5`= '$_POST[l5]',
					`l6`= '$_POST[l6]',
					`l7`= '$_POST[l7]',
					`l8`= '$_POST[l8]',
					`l9`= '$_POST[l9]',
					`l10`= '$_POST[l10]',
					`l11`= '$_POST[l11]',
					`l12`= '$_POST[l12]',
					`b1`= '$_POST[b1]',
					`b2`= '$_POST[b2]',
					`b3`= '$_POST[b3]',
					`b4`= '$_POST[b4]',
					`b5`= '$_POST[b5]',
					`b6`= '$_POST[b6]',
					`b7`= '$_POST[b7]',
					`b8`= '$_POST[b8]',
					`b9`= '$_POST[b9]',
					`b10`= '$_POST[b10]',
					`b11`= '$_POST[b11]',
					`b12`= '$_POST[b12]',
					`report_date`= '$report_date',
					`chk_mou` = '$_POST[chk_mou]',
					`in_w1` = '$_POST[in_w1]',
					`in_w2` = '$_POST[in_w2]',
					`fn_w1` = '$_POST[fn_w1]',
					`fn_w2` = '$_POST[fn_w2]',
					`mo1` = '$_POST[mo1]',
					`mo2` = '$_POST[mo2]',
					`chk_set` = '$_POST[chk_set]',
					`it_1` = '$_POST[it_1]',
					`it_2` = '$_POST[it_2]',
					`ft_1` = '$_POST[ft_1]',
					`ft_2` = '$_POST[ft_2]',
					`it_ft_1` = '$_POST[it_ft_1]',
					`it_ft_2` = '$_POST[it_ft_2]',
					`chk_sou`='$_POST[chk_sou]',
					`sou_temp`='$_POST[sou_temp]',
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
					`avg_mo` = '$_POST[avg_mo]' WHERE `id`='$_POST[idEdit]'";

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update ggbs SET `is_deleted`='1',`deleted_by`='$_SESSION[name]'WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM ggbs WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update ggbs SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update ggbs SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>