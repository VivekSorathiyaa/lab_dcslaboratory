<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from fly_ash WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
			$select_result = mysqli_query($conn, $get_query);
			$result=mysqli_fetch_array($select_result);
			$id=$result['id'];
			$report_no=$result['report_no'];
			$job_no=$result['job_no'];
			$lab_no=$result['lab_no'];
			$ulr=$result['ulr'];
			
			$fill = array(
							'id' => $id,
							'report_no' => $report_no,
							'ulr' => $result['ulr'],
							'amend_date' => $result['amend_date'],
							'job_no' => $job_no,
							'lab_no' => $lab_no,	
							'chk_set' => $result['chk_set'],
							'it_1' => $result['it_1'],
							'it_2' => $result['it_2'],
							'ft_1' => $result['ft_1'],
							'ft_2' => $result['ft_2'],
							'it_ft_1' => $result['it_ft_1'],
							'it_ft_2' => $result['it_ft_2'],
							'chk_dry' => $result['chk_dry'],
							'dry_wt_1' => $result['dry_wt_1'],
							'dry_wt_2' => $result['dry_wt_2'],
							'dry_wt_3' => $result['dry_wt_3'],
							'dry_wt_avg' => $result['dry_wt_avg'],
							'dry_res_1' => $result['dry_res_1'],
							'dry_res_2' => $result['dry_res_2'],
							'dry_res_3' => $result['dry_res_3'],
							'dry_res_avg' => $result['dry_res_avg'],
							'dry_sieve_1' => $result['dry_sieve_1'],
							'dry_sieve_2' => $result['dry_sieve_2'],
							'dry_sieve_3' => $result['dry_sieve_3'],
							'dry_sieve_avg' => $result['dry_sieve_avg'],
							'chk_per' => $result['chk_per'],
							'per_m2_1' => $result['per_m2_1'],
							'per_m2_2' => $result['per_m2_2'],
							'per_m2_3' => $result['per_m2_3'],
							'per_m3_1' => $result['per_m3_1'],
							'per_m3_2' => $result['per_m3_2'],
							'per_m3_3' => $result['per_m3_3'],
							'per_d_1' => $result['per_d_1'],
							'per_d_2' => $result['per_d_2'],
							'per_d_3' => $result['per_d_3'],
							'per_v_1' => $result['per_v_1'],
							'per_v_2' => $result['per_v_2'],
							'per_v_3' => $result['per_v_3'],
							'per_m1_1' => $result['per_m1_1'],
							'per_m1_2' => $result['per_m1_2'],
							'per_m1_3' => $result['per_m1_3'],
							'per_mea_1' => $result['per_mea_1'],
							'per_mea_2' => $result['per_mea_2'],
							'per_mea_3' => $result['per_mea_3'],
							'per_mean_1' => $result['per_mean_1'],
							'per_mean_2' => $result['per_mean_2'],
							'per_mean_3' => $result['per_mean_3'],
							'per_temp_1' => $result['per_temp_1'],
							'per_temp_2' => $result['per_temp_2'],
							'per_temp_3' => $result['per_temp_3'],
							'per_mean_temp_1' => $result['per_mean_temp_1'],
							'per_mean_temp_2' => $result['per_mean_temp_2'],
							'per_mean_temp_3' => $result['per_mean_temp_3'],
							'per_sur_1' => $result['per_sur_1'],
							'per_sur_2' => $result['per_sur_2'],
							'per_sur_3' => $result['per_sur_3'],
							'chk_sou' => $result['chk_sou'],
							'sou_1_1' => $result['sou_1_1'],
							'sou_1_2' => $result['sou_1_2'],
							'sou_1_3' => $result['sou_1_3'],
							'sou_2_1' => $result['sou_2_1'],
							'sou_2_2' => $result['sou_2_2'],
							'sou_2_3' => $result['sou_2_3'],
							'sou_avg1' => $result['sou_avg1'],
							'sou_avg2' => $result['sou_avg2'],
							'sou_avg3' => $result['sou_avg3'],
							'chk_com' => $result['chk_com'],
							'day1' => $result['day1'],
							'day2' => $result['day2'],
							'day3' => $result['day3'],
							'day4' => $result['day4'],
							'day5' => $result['day5'],
							'day6' => $result['day6'],
							'day7' => $result['day7'],
							'day8' => $result['day8'],
							'day9' => $result['day9'],
							'l1' => $result['l1'],
							'l2' => $result['l2'],
							'l3' => $result['l3'],
							'l4' => $result['l4'],
							'l5' => $result['l5'],
							'l6' => $result['l6'],
							'l7' => $result['l7'],
							'l8' => $result['l8'],
							'l9' => $result['l9'],
							'wi1' => $result['wi1'],
							'wi2' => $result['wi2'],
							'wi3' => $result['wi3'],
							'wi4' => $result['wi4'],
							'wi5' => $result['wi5'],
							'wi6' => $result['wi6'],
							'wi7' => $result['wi7'],
							'wi8' => $result['wi8'],
							'wi9' => $result['wi9'],
							'h1' => $result['h1'],
							'h2' => $result['h2'],
							'h3' => $result['h3'],
							'h4' => $result['h4'],
							'h5' => $result['h5'],
							'h6' => $result['h6'],
							'h7' => $result['h7'],
							'h8' => $result['h8'],
							'h9' => $result['h9'],
							'a1' => $result['a1'],
							'a2' => $result['a2'],
							'a3' => $result['a3'],
							'a4' => $result['a4'],
							'a5' => $result['a5'],
							'a6' => $result['a6'],
							'a7' => $result['a7'],
							'a8' => $result['a8'],
							'a9' => $result['a9'],
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
							'avg_com1' => $result['avg_com1'],
							'avg_com2' => $result['avg_com2'],
							'avg_com3' => $result['avg_com3'],
							'chk_lim' => $result['chk_lim'],
							'lim_wtr_1' => $result['lim_wtr_1'],
							'lim_wtr_2' => $result['lim_wtr_2'],
							'lim_wtr_3' => $result['lim_wtr_3'],
							'lim_wtr_4' => $result['lim_wtr_4'],
							'lim_wtr_5' => $result['lim_wtr_5'],
							'lim_mea_1' => $result['lim_mea_1'],
							'lim_mea_2' => $result['lim_mea_2'],
							'lim_mea_3' => $result['lim_mea_3'],
							'lim_mea_4' => $result['lim_mea_4'],
							'lim_mea_5' => $result['lim_mea_5'],
							'lim_flow_1' => $result['lim_flow_1'],
							'lim_flow_2' => $result['lim_flow_2'],
							'lim_flow_3' => $result['lim_flow_3'],
							'lim_flow_4' => $result['lim_flow_4'],
							'lim_flow_5' => $result['lim_flow_5'],
							'lim_day_1' => $result['lim_day_1'],
							'lim_day_2' => $result['lim_day_2'],
							'lim_day_3' => $result['lim_day_3'],
							'lim_day_4' => $result['lim_day_4'],
							'lim_day_5' => $result['lim_day_5'],
							'lim_wt_1' => $result['lim_wt_1'],
							'lim_wt_2' => $result['lim_wt_2'],
							'lim_wt_3' => $result['lim_wt_3'],
							'lim_wt_4' => $result['lim_wt_4'],
							'lim_wt_5' => $result['lim_wt_5'],
							'lim_len_1' => $result['lim_len_1'],
							'lim_len_2' => $result['lim_len_2'],
							'lim_len_3' => $result['lim_len_3'],
							'lim_len_4' => $result['lim_len_4'],
							'lim_len_5' => $result['lim_len_5'],
							'lim_w_1' => $result['lim_w_1'],
							'lim_w_2' => $result['lim_w_2'],
							'lim_w_3' => $result['lim_w_3'],
							'lim_w_4' => $result['lim_w_4'],
							'lim_w_5' => $result['lim_w_5'],
							'lim_h_1' => $result['lim_h_1'],
							'lim_h_2' => $result['lim_h_2'],
							'lim_h_3' => $result['lim_h_3'],
							'lim_h_4' => $result['lim_h_4'],
							'lim_h_5' => $result['lim_h_5'],
							'lim_area_1' => $result['lim_area_1'],
							'lim_area_2' => $result['lim_area_2'],
							'lim_area_3' => $result['lim_area_3'],
							'lim_area_4' => $result['lim_area_4'],
							'lim_area_5' => $result['lim_area_5'],
							'lim_load_1' => $result['lim_load_1'],
							'lim_load_2' => $result['lim_load_2'],
							'lim_load_3' => $result['lim_load_3'],
							'lim_load_4' => $result['lim_load_4'],
							'lim_load_5' => $result['lim_load_5'],
							'lim_com_1' => $result['lim_com_1'],
							'lim_com_2' => $result['lim_com_2'],
							'lim_com_3' => $result['lim_com_3'],
							'lim_com_4' => $result['lim_com_4'],
							'lim_com_5' => $result['lim_com_5'],
							'chk_spg' => $result['chk_spg'],
							'spg_a_1' => $result['spg_a_1'],
							'spg_a_2' => $result['spg_a_2'],
							'spg_a_3' => $result['spg_a_3'],
							'spg_b_1' => $result['spg_b_1'],
							'spg_b_2' => $result['spg_b_2'],
							'spg_b_3' => $result['spg_b_3'],
							'spg_ab_1' => $result['spg_ab_1'],
							'spg_ab_2' => $result['spg_ab_2'],
							'spg_ab_3' => $result['spg_ab_3'],
							'spg_v_1' => $result['spg_v_1'],
							'spg_v_2' => $result['spg_v_2'],
							'spg_v_3' => $result['spg_v_3'],
							'spg_fly_1' => $result['spg_fly_1'],
							'spg_fly_2' => $result['spg_fly_2'],
							'spg_fly_3' => $result['spg_fly_3'],
							'spg_sur_1' => $result['spg_sur_1'],
							'spg_sur_2' => $result['spg_sur_2'],
							'spg_sur_3' => $result['spg_sur_3'],
							'spg_std_1' => $result['spg_std_1'],
							'spg_std_2' => $result['spg_std_2'],
							'spg_std_3' => $result['spg_std_3'],
							'spg_por_std_1' => $result['spg_por_std_1'],
							'spg_por_std_2' => $result['spg_por_std_2'],
							'spg_por_std_3' => $result['spg_por_std_3'],
							'spg_por_test_1' => $result['spg_por_test_1'],
							'spg_por_test_2' => $result['spg_por_test_2'],
							'spg_por_test_3' => $result['spg_por_test_3'],
							'spg_mea_1' => $result['spg_mea_1'],
							'spg_mea_2' => $result['spg_mea_2'],
							'spg_mea_3' => $result['spg_mea_3'],
							'spg_mean_1' => $result['spg_mean_1'],
							'spg_mean_2' => $result['spg_mean_2'],
							'spg_mean_3' => $result['spg_mean_3'],
							'spg_mea_std_1' => $result['spg_mea_std_1'],
							'spg_mea_std_2' => $result['spg_mea_std_2'],
							'spg_mea_std_3' => $result['spg_mea_std_3'],
							'spg_mea_temp_1' => $result['spg_mea_temp_1'],
							'spg_mea_temp_2' => $result['spg_mea_temp_2'],
							'spg_mea_temp_3' => $result['spg_mea_temp_3'],
							'spg_mean_temp_1' => $result['spg_mean_temp_1'],
							'spg_mean_temp_2' => $result['spg_mean_temp_2'],
							'spg_mean_temp_3' => $result['spg_mean_temp_3'],
							'spg_ss_1' => $result['spg_ss_1'],
							'spg_ss_2' => $result['spg_ss_2'],
							'spg_ss_3' => $result['spg_ss_3']						
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
			$amend_date=$_POST['amend_date'];	
					
			$chk_set = $_POST['chk_set'];
			$it_1 = $_POST['it_1'];
			$it_2 = $_POST['it_2'];
			$ft_1 = $_POST['ft_1'];
			$ft_2 = $_POST['ft_2'];
			$it_ft_1 = $_POST['it_ft_1'];
			$it_ft_2 = $_POST['it_ft_2'];
			$chk_dry = $_POST['chk_dry'];
			$dry_wt_1 = $_POST['dry_wt_1'];
			$dry_wt_2 = $_POST['dry_wt_2'];
			$dry_wt_3 = $_POST['dry_wt_3'];
			$dry_wt_avg = $_POST['dry_wt_avg'];
			$dry_res_1 = $_POST['dry_res_1'];
			$dry_res_2 = $_POST['dry_res_2'];
			$dry_res_3 = $_POST['dry_res_3'];
			$dry_res_avg = $_POST['dry_res_avg'];
			$dry_sieve_1 = $_POST['dry_sieve_1'];
			$dry_sieve_2 = $_POST['dry_sieve_2'];
			$dry_sieve_3 = $_POST['dry_sieve_3'];
			$dry_sieve_avg = $_POST['dry_sieve_avg'];
			$chk_per = $_POST['chk_per'];
			$per_m2_1 = $_POST['per_m2_1'];
			$per_m2_2 = $_POST['per_m2_2'];
			$per_m2_3 = $_POST['per_m2_3'];
			$per_m3_1 = $_POST['per_m3_1'];
			$per_m3_2 = $_POST['per_m3_2'];
			$per_m3_3 = $_POST['per_m3_3'];
			$per_d_1 = $_POST['per_d_1'];
			$per_d_2 = $_POST['per_d_2'];
			$per_d_3 = $_POST['per_d_3'];
			$per_v_1 = $_POST['per_v_1'];
			$per_v_2 = $_POST['per_v_2'];
			$per_v_3 = $_POST['per_v_3'];
			$per_m1_1 = $_POST['per_m1_1'];
			$per_m1_2 = $_POST['per_m1_2'];
			$per_m1_3 = $_POST['per_m1_3'];
			$per_mea_1 = $_POST['per_mea_1'];
			$per_mea_2 = $_POST['per_mea_2'];
			$per_mea_3 = $_POST['per_mea_3'];
			$per_mean_1 = $_POST['per_mean_1'];
			$per_mean_2 = $_POST['per_mean_2'];
			$per_mean_3 = $_POST['per_mean_3'];
			$per_temp_1 = $_POST['per_temp_1'];
			$per_temp_2 = $_POST['per_temp_2'];
			$per_temp_3 = $_POST['per_temp_3'];
			$per_mean_temp_1 = $_POST['per_mean_temp_1'];
			$per_mean_temp_2 = $_POST['per_mean_temp_2'];
			$per_mean_temp_3 = $_POST['per_mean_temp_3'];
			$per_sur_1 = $_POST['per_sur_1'];
			$per_sur_2 = $_POST['per_sur_2'];
			$per_sur_3 = $_POST['per_sur_3'];
			$chk_sou = $_POST['chk_sou'];
			$sou_1_1 = $_POST['sou_1_1'];
			$sou_1_2 = $_POST['sou_1_2'];
			$sou_1_3 = $_POST['sou_1_3'];
			$sou_2_1 = $_POST['sou_2_1'];
			$sou_2_2 = $_POST['sou_2_2'];
			$sou_2_3 = $_POST['sou_2_3'];
			$sou_avg1 = $_POST['sou_avg1'];
			$sou_avg2 = $_POST['sou_avg2'];
			$sou_avg3 = $_POST['sou_avg3'];
			$chk_com = $_POST['chk_com'];
			$day1 = $_POST['day1'];
			$day2 = $_POST['day2'];
			$day3 = $_POST['day3'];
			$day4 = $_POST['day4'];
			$day5 = $_POST['day5'];
			$day6 = $_POST['day6'];
			$day7 = $_POST['day7'];
			$day8 = $_POST['day8'];
			$day9 = $_POST['day9'];
			$l1 = $_POST['l1'];
			$l2 = $_POST['l2'];
			$l3 = $_POST['l3'];
			$l4 = $_POST['l4'];
			$l5 = $_POST['l5'];
			$l6 = $_POST['l6'];
			$l7 = $_POST['l7'];
			$l8 = $_POST['l8'];
			$l9 = $_POST['l9'];
			$wi1 = $_POST['wi1'];
			$wi2 = $_POST['wi2'];
			$wi3 = $_POST['wi3'];
			$wi4 = $_POST['wi4'];
			$wi5 = $_POST['wi5'];
			$wi6 = $_POST['wi6'];
			$wi7 = $_POST['wi7'];
			$wi8 = $_POST['wi8'];
			$wi9 = $_POST['wi9'];
			$h1 = $_POST['h1'];
			$h2 = $_POST['h2'];
			$h3 = $_POST['h3'];
			$h4 = $_POST['h4'];
			$h5 = $_POST['h5'];
			$h6 = $_POST['h6'];
			$h7 = $_POST['h7'];
			$h8 = $_POST['h8'];
			$h9 = $_POST['h9'];
			$a1 = $_POST['a1'];
			$a2 = $_POST['a2'];
			$a3 = $_POST['a3'];
			$a4 = $_POST['a4'];
			$a5 = $_POST['a5'];
			$a6 = $_POST['a6'];
			$a7 = $_POST['a7'];
			$a8 = $_POST['a8'];
			$a9 = $_POST['a9'];
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
			$avg_com1 = $_POST['avg_com1'];
			$avg_com2 = $_POST['avg_com2'];
			$avg_com3 = $_POST['avg_com3'];
			$chk_lim = $_POST['chk_lim'];
			$lim_wtr_1 = $_POST['lim_wtr_1'];
			$lim_wtr_2 = $_POST['lim_wtr_2'];
			$lim_wtr_3 = $_POST['lim_wtr_3'];
			$lim_wtr_4 = $_POST['lim_wtr_4'];
			$lim_wtr_5 = $_POST['lim_wtr_5'];
			$lim_mea_1 = $_POST['lim_mea_1'];
			$lim_mea_2 = $_POST['lim_mea_2'];
			$lim_mea_3 = $_POST['lim_mea_3'];
			$lim_mea_4 = $_POST['lim_mea_4'];
			$lim_mea_5 = $_POST['lim_mea_5'];
			$lim_flow_1 = $_POST['lim_flow_1'];
			$lim_flow_2 = $_POST['lim_flow_2'];
			$lim_flow_3 = $_POST['lim_flow_3'];
			$lim_flow_4 = $_POST['lim_flow_4'];
			$lim_flow_5 = $_POST['lim_flow_5'];
			$lim_day_1 = $_POST['lim_day_1'];
			$lim_day_2 = $_POST['lim_day_2'];
			$lim_day_3 = $_POST['lim_day_3'];
			$lim_day_4 = $_POST['lim_day_4'];
			$lim_day_5 = $_POST['lim_day_5'];
			$lim_wt_1 = $_POST['lim_wt_1'];
			$lim_wt_2 = $_POST['lim_wt_2'];
			$lim_wt_3 = $_POST['lim_wt_3'];
			$lim_wt_4 = $_POST['lim_wt_4'];
			$lim_wt_5 = $_POST['lim_wt_5'];
			$lim_len_1 = $_POST['lim_len_1'];
			$lim_len_2 = $_POST['lim_len_2'];
			$lim_len_3 = $_POST['lim_len_3'];
			$lim_len_4 = $_POST['lim_len_4'];
			$lim_len_5 = $_POST['lim_len_5'];
			$lim_w_1 = $_POST['lim_w_1'];
			$lim_w_2 = $_POST['lim_w_2'];
			$lim_w_3 = $_POST['lim_w_3'];
			$lim_w_4 = $_POST['lim_w_4'];
			$lim_w_5 = $_POST['lim_w_5'];
			$lim_h_1 = $_POST['lim_h_1'];
			$lim_h_2 = $_POST['lim_h_2'];
			$lim_h_3 = $_POST['lim_h_3'];
			$lim_h_4 = $_POST['lim_h_4'];
			$lim_h_5 = $_POST['lim_h_5'];
			$lim_area_1 = $_POST['lim_area_1'];
			$lim_area_2 = $_POST['lim_area_2'];
			$lim_area_3 = $_POST['lim_area_3'];
			$lim_area_4 = $_POST['lim_area_4'];
			$lim_area_5 = $_POST['lim_area_5'];
			$lim_load_1 = $_POST['lim_load_1'];
			$lim_load_2 = $_POST['lim_load_2'];
			$lim_load_3 = $_POST['lim_load_3'];
			$lim_load_4 = $_POST['lim_load_4'];
			$lim_load_5 = $_POST['lim_load_5'];
			$lim_com_1 = $_POST['lim_com_1'];
			$lim_com_2 = $_POST['lim_com_2'];
			$lim_com_3 = $_POST['lim_com_3'];
			$lim_com_4 = $_POST['lim_com_4'];
			$lim_com_5 = $_POST['lim_com_5'];
			$chk_spg = $_POST['chk_spg'];
			$spg_a_1 = $_POST['spg_a_1'];
			$spg_a_2 = $_POST['spg_a_2'];
			$spg_a_3 = $_POST['spg_a_3'];
			$spg_b_1 = $_POST['spg_b_1'];
			$spg_b_2 = $_POST['spg_b_2'];
			$spg_b_3 = $_POST['spg_b_3'];
			$spg_ab_1 = $_POST['spg_ab_1'];
			$spg_ab_2 = $_POST['spg_ab_2'];
			$spg_ab_3 = $_POST['spg_ab_3'];
			$spg_v_1 = $_POST['spg_v_1'];
			$spg_v_2 = $_POST['spg_v_2'];
			$spg_v_3 = $_POST['spg_v_3'];
			$spg_fly_1 = $_POST['spg_fly_1'];
			$spg_fly_2 = $_POST['spg_fly_2'];
			$spg_fly_3 = $_POST['spg_fly_3'];
			$spg_sur_1 = $_POST['spg_sur_1'];
			$spg_sur_2 = $_POST['spg_sur_2'];
			$spg_sur_3 = $_POST['spg_sur_3'];
			$spg_std_1 = $_POST['spg_std_1'];
			$spg_std_2 = $_POST['spg_std_2'];
			$spg_std_3 = $_POST['spg_std_3'];
			$spg_por_std_1 = $_POST['spg_por_std_1'];
			$spg_por_std_2 = $_POST['spg_por_std_2'];
			$spg_por_std_3 = $_POST['spg_por_std_3'];
			$spg_por_test_1 = $_POST['spg_por_test_1'];
			$spg_por_test_2 = $_POST['spg_por_test_2'];
			$spg_por_test_3 = $_POST['spg_por_test_3'];
			$spg_mea_1 = $_POST['spg_mea_1'];
			$spg_mea_2 = $_POST['spg_mea_2'];
			$spg_mea_3 = $_POST['spg_mea_3'];
			$spg_mean_1 = $_POST['spg_mean_1'];
			$spg_mean_2 = $_POST['spg_mean_2'];
			$spg_mean_3 = $_POST['spg_mean_3'];
			$spg_mea_std_1 = $_POST['spg_mea_std_1'];
			$spg_mea_std_2 = $_POST['spg_mea_std_2'];
			$spg_mea_std_3 = $_POST['spg_mea_std_3'];
			$spg_mea_temp_1 = $_POST['spg_mea_temp_1'];
			$spg_mea_temp_2 = $_POST['spg_mea_temp_2'];
			$spg_mea_temp_3 = $_POST['spg_mea_temp_3'];
			$spg_mean_temp_1 = $_POST['spg_mean_temp_1'];
			$spg_mean_temp_2 = $_POST['spg_mean_temp_2'];
			$spg_mean_temp_3 = $_POST['spg_mean_temp_3'];
			$spg_ss_1 = $_POST['spg_ss_1'];
			$spg_ss_2 = $_POST['spg_ss_2'];
			$spg_ss_3 = $_POST['spg_ss_3'];
			
			
			
			
			

			
			
		   $insert="INSERT INTO `fly_ash`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_set`, `it_1`, `it_2`, `ft_1`, `ft_2`, `it_ft_1`, `it_ft_2`, `chk_dry`, `dry_wt_1`, `dry_wt_2`, `dry_wt_3`, `dry_wt_avg`, `dry_res_1`, `dry_res_2`, `dry_res_3`, `dry_res_avg`, `dry_sieve_1`, `dry_sieve_2`, `dry_sieve_3`, `dry_sieve_avg`, `chk_per`, `per_m2_1`, `per_m2_2`, `per_m2_3`, `per_m3_1`, `per_m3_2`, `per_m3_3`, `per_d_1`, `per_d_2`, `per_d_3`, `per_v_1`, `per_v_2`, `per_v_3`, `per_m1_1`, `per_m1_2`, `per_m1_3`, `per_mea_1`, `per_mea_2`, `per_mea_3`, `per_mean_1`, `per_mean_2`, `per_mean_3`, `per_temp_1`, `per_temp_2`, `per_temp_3`, `per_mean_temp_1`, `per_mean_temp_2`, `per_mean_temp_3`, `per_sur_1`, `per_sur_2`, `per_sur_3`, `chk_sou`, `sou_1_1`, `sou_1_2`, `sou_1_3`, `sou_2_1`, `sou_2_2`, `sou_2_3`, `sou_avg1`, `sou_avg2`, `sou_avg3`, `chk_com`, `day1`, `day2`, `day3`, `day4`, `day5`, `day6`, `day7`, `day8`, `day9`, `l1`, `l2`, `l3`, `l4`, `l5`, `l6`, `l7`, `l8`, `l9`, `wi1`, `wi2`, `wi3`, `wi4`, `wi5`, `wi6`, `wi7`, `wi8`, `wi9`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `load_1`, `load_2`, `load_3`, `load_4`, `load_5`, `load_6`, `load_7`, `load_8`, `load_9`, `com_1`, `com_2`, `com_3`, `com_4`, `com_5`, `com_6`, `com_7`, `com_8`, `com_9`, `avg_com1`, `avg_com2`, `avg_com3`, `chk_lim`, `lim_wtr_1`, `lim_wtr_2`, `lim_wtr_3`, `lim_wtr_4`, `lim_wtr_5`, `lim_mea_1`, `lim_mea_2`, `lim_mea_3`, `lim_mea_4`, `lim_mea_5`, `lim_flow_1`, `lim_flow_2`, `lim_flow_3`, `lim_flow_4`, `lim_flow_5`, `lim_day_1`, `lim_day_2`, `lim_day_3`, `lim_day_4`, `lim_day_5`, `lim_wt_1`, `lim_wt_2`, `lim_wt_3`, `lim_wt_4`, `lim_wt_5`, `lim_len_1`, `lim_len_2`, `lim_len_3`, `lim_len_4`, `lim_len_5`, `lim_w_1`, `lim_w_2`, `lim_w_3`, `lim_w_4`, `lim_w_5`, `lim_h_1`, `lim_h_2`, `lim_h_3`, `lim_h_4`, `lim_h_5`, `lim_area_1`, `lim_area_2`, `lim_area_3`, `lim_area_4`, `lim_area_5`, `lim_load_1`, `lim_load_2`, `lim_load_3`, `lim_load_4`, `lim_load_5`, `lim_com_1`, `lim_com_2`, `lim_com_3`, `lim_com_4`, `lim_com_5`, `chk_spg`, `spg_a_1`, `spg_a_2`, `spg_a_3`, `spg_b_1`, `spg_b_2`, `spg_b_3`, `spg_ab_1`, `spg_ab_2`, `spg_ab_3`, `spg_v_1`, `spg_v_2`, `spg_v_3`, `spg_fly_1`, `spg_fly_2`, `spg_fly_3`, `spg_sur_1`, `spg_sur_2`, `spg_sur_3`, `spg_std_1`, `spg_std_2`, `spg_std_3`, `spg_por_std_1`, `spg_por_std_2`, `spg_por_std_3`, `spg_por_test_1`, `spg_por_test_2`, `spg_por_test_3`, `spg_mea_1`, `spg_mea_2`, `spg_mea_3`, `spg_mean_1`, `spg_mean_2`, `spg_mean_3`, `spg_mea_std_1`, `spg_mea_std_2`, `spg_mea_std_3`, `spg_mea_temp_1`, `spg_mea_temp_2`, `spg_mea_temp_3`, `spg_mean_temp_1`, `spg_mean_temp_2`, `spg_mean_temp_3`, `spg_ss_1`, `spg_ss_2`, `spg_ss_3`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_set', '$it_1', '$it_2', '$ft_1', '$ft_2', '$it_ft_1', '$it_ft_2', '$chk_dry', '$dry_wt_1', '$dry_wt_2', '$dry_wt_3', '$dry_wt_avg', '$dry_res_1', '$dry_res_2', '$dry_res_3', '$dry_res_avg', '$dry_sieve_1', '$dry_sieve_2', '$dry_sieve_3', '$dry_sieve_avg', '$chk_per', '$per_m2_1', '$per_m2_2', '$per_m2_3', '$per_m3_1', '$per_m3_2', '$per_m3_3', '$per_d_1', '$per_d_2', '$per_d_3', '$per_v_1', '$per_v_2', '$per_v_3', '$per_m1_1', '$per_m1_2', '$per_m1_3', '$per_mea_1', '$per_mea_2', '$per_mea_3', '$per_mean_1', '$per_mean_2', '$per_mean_3', '$per_temp_1', '$per_temp_2', '$per_temp_3', '$per_mean_temp_1', '$per_mean_temp_2', '$per_mean_temp_3', '$per_sur_1', '$per_sur_2', '$per_sur_3', '$chk_sou', '$sou_1_1', '$sou_1_2', '$sou_1_3', '$sou_2_1', '$sou_2_2', '$sou_2_3', '$sou_avg1', '$sou_avg2', '$sou_avg3', '$chk_com', '$day1', '$day2', '$day3', '$day4', '$day5', '$day6', '$day7', '$day8', '$day9', '$l1', '$l2', '$l3', '$l4', '$l5', '$l6', '$l7', '$l8', '$l9', '$wi1', '$wi2', '$wi3', '$wi4', '$wi5', '$wi6', '$wi7', '$wi8', '$wi9', '$h1', '$h2', '$h3', '$h4', '$h5', '$h6', '$h7', '$h8', '$h9', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$load_1', '$load_2', '$load_3', '$load_4', '$load_5', '$load_6', '$load_7', '$load_8', '$load_9', '$com_1', '$com_2', '$com_3', '$com_4', '$com_5', '$com_6', '$com_7', '$com_8', '$com_9', '$avg_com1', '$avg_com2', '$avg_com3', '$chk_lim', '$lim_wtr_1', '$lim_wtr_2', '$lim_wtr_3', '$lim_wtr_4', '$lim_wtr_5', '$lim_mea_1', '$lim_mea_2', '$lim_mea_3', '$lim_mea_4', '$lim_mea_5', '$lim_flow_1', '$lim_flow_2', '$lim_flow_3', '$lim_flow_4', '$lim_flow_5', '$lim_day_1', '$lim_day_2', '$lim_day_3', '$lim_day_4', '$lim_day_5', '$lim_wt_1', '$lim_wt_2', '$lim_wt_3', '$lim_wt_4', '$lim_wt_5', '$lim_len_1', '$lim_len_2', '$lim_len_3', '$lim_len_4', '$lim_len_5', '$lim_w_1', '$lim_w_2', '$lim_w_3', '$lim_w_4', '$lim_w_5', '$lim_h_1', '$lim_h_2', '$lim_h_3', '$lim_h_4', '$lim_h_5', '$lim_area_1', '$lim_area_2', '$lim_area_3', '$lim_area_4', '$lim_area_5', '$lim_load_1', '$lim_load_2', '$lim_load_3', '$lim_load_4', '$lim_load_5', '$lim_com_1', '$lim_com_2', '$lim_com_3', '$lim_com_4', '$lim_com_5', '$chk_spg', '$spg_a_1', '$spg_a_2', '$spg_a_3', '$spg_b_1', '$spg_b_2', '$spg_b_3', '$spg_ab_1', '$spg_ab_2', '$spg_ab_3', '$spg_v_1', '$spg_v_2', '$spg_v_3', '$spg_fly_1', '$spg_fly_2', '$spg_fly_3', '$spg_sur_1', '$spg_sur_2', '$spg_sur_3', '$spg_std_1', '$spg_std_2', '$spg_std_3', '$spg_por_std_1', '$spg_por_std_2', '$spg_por_std_3', '$spg_por_test_1', '$spg_por_test_2', '$spg_por_test_3', '$spg_mea_1', '$spg_mea_2', '$spg_mea_3', '$spg_mean_1', '$spg_mean_2', '$spg_mean_3', '$spg_mea_std_1', '$spg_mea_std_2', '$spg_mea_std_3', '$spg_mea_temp_1', '$spg_mea_temp_2', '$spg_mea_temp_3', '$spg_mean_temp_1', '$spg_mean_temp_2', '$spg_mean_temp_3', '$spg_ss_1', '$spg_ss_2', '$spg_ss_3', '$amend_date')"; 
			
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
													 $query = "select * from `fly_ash` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
		
			$update="update fly_ash SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					`modified_by`='$_SESSION[name]',
					`modified_date`='$curr_date',					
					`checked_by`=NULL,					 
					`ulr`='$_POST[ulr]',
					`chk_set` = '$_POST[chk_set]',
					`it_1` = '$_POST[it_1]',
					`it_2` = '$_POST[it_2]',
					`ft_1` = '$_POST[ft_1]',
					`ft_2` = '$_POST[ft_2]',
					`it_ft_1` = '$_POST[it_ft_1]',
					`it_ft_2` = '$_POST[it_ft_2]',
					`chk_dry` = '$_POST[chk_dry]',
					`dry_wt_1` = '$_POST[dry_wt_1]',
					`dry_wt_2` = '$_POST[dry_wt_2]',
					`dry_wt_3` = '$_POST[dry_wt_3]',
					`dry_wt_avg` = '$_POST[dry_wt_avg]',
					`dry_res_1` = '$_POST[dry_res_1]',
					`dry_res_2` = '$_POST[dry_res_2]',
					`dry_res_3` = '$_POST[dry_res_3]',
					`dry_res_avg` = '$_POST[dry_res_avg]',
					`dry_sieve_1` = '$_POST[dry_sieve_1]',
					`dry_sieve_2` = '$_POST[dry_sieve_2]',
					`dry_sieve_3` = '$_POST[dry_sieve_3]',
					`dry_sieve_avg` = '$_POST[dry_sieve_avg]',
					`chk_per` = '$_POST[chk_per]',
					`per_m2_1` = '$_POST[per_m2_1]',
					`per_m2_2` = '$_POST[per_m2_2]',
					`per_m2_3` = '$_POST[per_m2_3]',
					`per_m3_1` = '$_POST[per_m3_1]',
					`per_m3_2` = '$_POST[per_m3_2]',
					`per_m3_3` = '$_POST[per_m3_3]',
					`per_d_1` = '$_POST[per_d_1]',
					`per_d_2` = '$_POST[per_d_2]',
					`per_d_3` = '$_POST[per_d_3]',
					`per_v_1` = '$_POST[per_v_1]',
					`per_v_2` = '$_POST[per_v_2]',
					`per_v_3` = '$_POST[per_v_3]',
					`per_m1_1` = '$_POST[per_m1_1]',
					`per_m1_2` = '$_POST[per_m1_2]',
					`per_m1_3` = '$_POST[per_m1_3]',
					`per_mea_1` = '$_POST[per_mea_1]',
					`per_mea_2` = '$_POST[per_mea_2]',
					`per_mea_3` = '$_POST[per_mea_3]',
					`per_mean_1` = '$_POST[per_mean_1]',
					`per_mean_2` = '$_POST[per_mean_2]',
					`per_mean_3` = '$_POST[per_mean_3]',
					`per_temp_1` = '$_POST[per_temp_1]',
					`per_temp_2` = '$_POST[per_temp_2]',
					`per_temp_3` = '$_POST[per_temp_3]',
					`per_mean_temp_1` = '$_POST[per_mean_temp_1]',
					`per_mean_temp_2` = '$_POST[per_mean_temp_2]',
					`per_mean_temp_3` = '$_POST[per_mean_temp_3]',
					`per_sur_1` = '$_POST[per_sur_1]',
					`per_sur_2` = '$_POST[per_sur_2]',
					`per_sur_3` = '$_POST[per_sur_3]',
					`chk_sou` = '$_POST[chk_sou]',
					`sou_1_1` = '$_POST[sou_1_1]',
					`sou_1_2` = '$_POST[sou_1_2]',
					`sou_1_3` = '$_POST[sou_1_3]',
					`sou_2_1` = '$_POST[sou_2_1]',
					`sou_2_2` = '$_POST[sou_2_2]',
					`sou_2_3` = '$_POST[sou_2_3]',
					`sou_avg1` = '$_POST[sou_avg1]',
					`sou_avg2` = '$_POST[sou_avg2]',
					`sou_avg3` = '$_POST[sou_avg3]',
					`chk_com` = '$_POST[chk_com]',
					`day1` = '$_POST[day1]',
					`day2` = '$_POST[day2]',
					`day3` = '$_POST[day3]',
					`day4` = '$_POST[day4]',
					`day5` = '$_POST[day5]',
					`day6` = '$_POST[day6]',
					`day7` = '$_POST[day7]',
					`day8` = '$_POST[day8]',
					`day9` = '$_POST[day9]',
					`l1` = '$_POST[l1]',
					`l2` = '$_POST[l2]',
					`l3` = '$_POST[l3]',
					`l4` = '$_POST[l4]',
					`l5` = '$_POST[l5]',
					`l6` = '$_POST[l6]',
					`l7` = '$_POST[l7]',
					`l8` = '$_POST[l8]',
					`l9` = '$_POST[l9]',
					`wi1` = '$_POST[wi1]',
					`wi2` = '$_POST[wi2]',
					`wi3` = '$_POST[wi3]',
					`wi4` = '$_POST[wi4]',
					`wi5` = '$_POST[wi5]',
					`wi6` = '$_POST[wi6]',
					`wi7` = '$_POST[wi7]',
					`wi8` = '$_POST[wi8]',
					`wi9` = '$_POST[wi9]',
					`h1` = '$_POST[h1]',
					`h2` = '$_POST[h2]',
					`h3` = '$_POST[h3]',
					`h4` = '$_POST[h4]',
					`h5` = '$_POST[h5]',
					`h6` = '$_POST[h6]',
					`h7` = '$_POST[h7]',
					`h8` = '$_POST[h8]',
					`h9` = '$_POST[h9]',
					`a1` = '$_POST[a1]',
					`a2` = '$_POST[a2]',
					`a3` = '$_POST[a3]',
					`a4` = '$_POST[a4]',
					`a5` = '$_POST[a5]',
					`a6` = '$_POST[a6]',
					`a7` = '$_POST[a7]',
					`a8` = '$_POST[a8]',
					`a9` = '$_POST[a9]',
					`load_1` = '$_POST[load_1]',
					`load_2` = '$_POST[load_2]',
					`load_3` = '$_POST[load_3]',
					`load_4` = '$_POST[load_4]',
					`load_5` = '$_POST[load_5]',
					`load_6` = '$_POST[load_6]',
					`load_7` = '$_POST[load_7]',
					`load_8` = '$_POST[load_8]',
					`load_9` = '$_POST[load_9]',
					`com_1` = '$_POST[com_1]',
					`com_2` = '$_POST[com_2]',
					`com_3` = '$_POST[com_3]',
					`com_4` = '$_POST[com_4]',
					`com_5` = '$_POST[com_5]',
					`com_6` = '$_POST[com_6]',
					`com_7` = '$_POST[com_7]',
					`com_8` = '$_POST[com_8]',
					`com_9` = '$_POST[com_9]',
					`avg_com1` = '$_POST[avg_com1]',
					`avg_com2` = '$_POST[avg_com2]',
					`avg_com3` = '$_POST[avg_com3]',
					`chk_lim` = '$_POST[chk_lim]',
					`lim_wtr_1` = '$_POST[lim_wtr_1]',
					`lim_wtr_2` = '$_POST[lim_wtr_2]',
					`lim_wtr_3` = '$_POST[lim_wtr_3]',
					`lim_wtr_4` = '$_POST[lim_wtr_4]',
					`lim_wtr_5` = '$_POST[lim_wtr_5]',
					`lim_mea_1` = '$_POST[lim_mea_1]',
					`lim_mea_2` = '$_POST[lim_mea_2]',
					`lim_mea_3` = '$_POST[lim_mea_3]',
					`lim_mea_4` = '$_POST[lim_mea_4]',
					`lim_mea_5` = '$_POST[lim_mea_5]',
					`lim_flow_1` = '$_POST[lim_flow_1]',
					`lim_flow_2` = '$_POST[lim_flow_2]',
					`lim_flow_3` = '$_POST[lim_flow_3]',
					`lim_flow_4` = '$_POST[lim_flow_4]',
					`lim_flow_5` = '$_POST[lim_flow_5]',
					`lim_day_1` = '$_POST[lim_day_1]',
					`lim_day_2` = '$_POST[lim_day_2]',
					`lim_day_3` = '$_POST[lim_day_3]',
					`lim_day_4` = '$_POST[lim_day_4]',
					`lim_day_5` = '$_POST[lim_day_5]',
					`lim_wt_1` = '$_POST[lim_wt_1]',
					`lim_wt_2` = '$_POST[lim_wt_2]',
					`lim_wt_3` = '$_POST[lim_wt_3]',
					`lim_wt_4` = '$_POST[lim_wt_4]',
					`lim_wt_5` = '$_POST[lim_wt_5]',
					`lim_len_1` = '$_POST[lim_len_1]',
					`lim_len_2` = '$_POST[lim_len_2]',
					`lim_len_3` = '$_POST[lim_len_3]',
					`lim_len_4` = '$_POST[lim_len_4]',
					`lim_len_5` = '$_POST[lim_len_5]',
					`lim_w_1` = '$_POST[lim_w_1]',
					`lim_w_2` = '$_POST[lim_w_2]',
					`lim_w_3` = '$_POST[lim_w_3]',
					`lim_w_4` = '$_POST[lim_w_4]',
					`lim_w_5` = '$_POST[lim_w_5]',
					`lim_h_1` = '$_POST[lim_h_1]',
					`lim_h_2` = '$_POST[lim_h_2]',
					`lim_h_3` = '$_POST[lim_h_3]',
					`lim_h_4` = '$_POST[lim_h_4]',
					`lim_h_5` = '$_POST[lim_h_5]',
					`lim_area_1` = '$_POST[lim_area_1]',
					`lim_area_2` = '$_POST[lim_area_2]',
					`lim_area_3` = '$_POST[lim_area_3]',
					`lim_area_4` = '$_POST[lim_area_4]',
					`lim_area_5` = '$_POST[lim_area_5]',
					`lim_load_1` = '$_POST[lim_load_1]',
					`lim_load_2` = '$_POST[lim_load_2]',
					`lim_load_3` = '$_POST[lim_load_3]',
					`lim_load_4` = '$_POST[lim_load_4]',
					`lim_load_5` = '$_POST[lim_load_5]',
					`lim_com_1` = '$_POST[lim_com_1]',
					`lim_com_2` = '$_POST[lim_com_2]',
					`lim_com_3` = '$_POST[lim_com_3]',
					`lim_com_4` = '$_POST[lim_com_4]',
					`lim_com_5` = '$_POST[lim_com_5]',
					`chk_spg` = '$_POST[chk_spg]',
					`spg_a_1` = '$_POST[spg_a_1]',
					`spg_a_2` = '$_POST[spg_a_2]',
					`spg_a_3` = '$_POST[spg_a_3]',
					`spg_b_1` = '$_POST[spg_b_1]',
					`spg_b_2` = '$_POST[spg_b_2]',
					`spg_b_3` = '$_POST[spg_b_3]',
					`spg_ab_1` = '$_POST[spg_ab_1]',
					`spg_ab_2` = '$_POST[spg_ab_2]',
					`spg_ab_3` = '$_POST[spg_ab_3]',
					`spg_v_1` = '$_POST[spg_v_1]',
					`spg_v_2` = '$_POST[spg_v_2]',
					`spg_v_3` = '$_POST[spg_v_3]',
					`spg_fly_1` = '$_POST[spg_fly_1]',
					`spg_fly_2` = '$_POST[spg_fly_2]',
					`spg_fly_3` = '$_POST[spg_fly_3]',
					`spg_sur_1` = '$_POST[spg_sur_1]',
					`spg_sur_2` = '$_POST[spg_sur_2]',
					`spg_sur_3` = '$_POST[spg_sur_3]',
					`spg_std_1` = '$_POST[spg_std_1]',
					`spg_std_2` = '$_POST[spg_std_2]',
					`spg_std_3` = '$_POST[spg_std_3]',
					`spg_por_std_1` = '$_POST[spg_por_std_1]',
					`spg_por_std_2` = '$_POST[spg_por_std_2]',
					`spg_por_std_3` = '$_POST[spg_por_std_3]',
					`spg_por_test_1` = '$_POST[spg_por_test_1]',
					`spg_por_test_2` = '$_POST[spg_por_test_2]',
					`spg_por_test_3` = '$_POST[spg_por_test_3]',
					`spg_mea_1` = '$_POST[spg_mea_1]',
					`spg_mea_2` = '$_POST[spg_mea_2]',
					`spg_mea_3` = '$_POST[spg_mea_3]',
					`spg_mean_1` = '$_POST[spg_mean_1]',
					`spg_mean_2` = '$_POST[spg_mean_2]',
					`spg_mean_3` = '$_POST[spg_mean_3]',
					`spg_mea_std_1` = '$_POST[spg_mea_std_1]',
					`spg_mea_std_2` = '$_POST[spg_mea_std_2]',
					`spg_mea_std_3` = '$_POST[spg_mea_std_3]',
					`spg_mea_temp_1` = '$_POST[spg_mea_temp_1]',
					`spg_mea_temp_2` = '$_POST[spg_mea_temp_2]',
					`spg_mea_temp_3` = '$_POST[spg_mea_temp_3]',
					`spg_mean_temp_1` = '$_POST[spg_mean_temp_1]',
					`spg_mean_temp_2` = '$_POST[spg_mean_temp_2]',
					`spg_mean_temp_3` = '$_POST[spg_mean_temp_3]',
					`spg_ss_1` = '$_POST[spg_ss_1]',
					`spg_ss_2` = '$_POST[spg_ss_2]',
					`amend_date` = '$_POST[amend_date]',
					`spg_ss_3` = '$_POST[spg_ss_3]' WHERE `id`='$_POST[idEdit]'";
		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update fly_ash SET `is_deleted`='1',`deleted_by`='$_SESSION[name]'WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM fly_ash WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update fly_ash SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update fly_ash SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>