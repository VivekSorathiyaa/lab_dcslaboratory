<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from gsb_26_5_4_75_mm WHERE id='$_POST[id]' AND `is_deleted`='0'";
		$select_result = mysqli_query($conn, $get_query);
		$result = mysqli_fetch_array($select_result);
		$id = $result['id'];
		$report_no = $result['report_no'];
		$job_no = $result['job_no'];
		$lab_no = $result['lab_no'];
		$fill = array(
			'id' => $id,
			'report_no' => $report_no,
			'job_no' => $job_no,
			'lab_no' => $lab_no,
			'sample_taken' => $result['sample_taken'],
			'blank_extra' => $result['blank_extra'],
			'sieve_1' => $result['sieve_1'],
			'sieve_2' => $result['sieve_2'],
			'sieve_3' => $result['sieve_3'],
			'sieve_4' => $result['sieve_4'],
			'sieve_5' => $result['sieve_5'],
			'sieve_6' => $result['sieve_6'],
			'cum_wt_gm_1' => $result['cum_wt_gm_1'],
			'cum_wt_gm_2' => $result['cum_wt_gm_2'],
			'cum_wt_gm_3' => $result['cum_wt_gm_3'],
			'cum_wt_gm_4' => $result['cum_wt_gm_4'],
			'cum_wt_gm_5' => $result['cum_wt_gm_5'],
			'cum_wt_gm_6' => $result['cum_wt_gm_6'],
			'ret_wt_gm_1' => $result['ret_wt_gm_1'],
			'ret_wt_gm_2' => $result['ret_wt_gm_2'],
			'ret_wt_gm_3' => $result['ret_wt_gm_3'],
			'ret_wt_gm_4' => $result['ret_wt_gm_4'],
			'ret_wt_gm_5' => $result['ret_wt_gm_5'],
			'ret_wt_gm_6' => $result['ret_wt_gm_6'],
			'cum_ret_1' => $result['cum_ret_1'],
			'cum_ret_2' => $result['cum_ret_2'],
			'cum_ret_3' => $result['cum_ret_3'],
			'cum_ret_4' => $result['cum_ret_4'],
			'cum_ret_5' => $result['cum_ret_5'],
			'cum_ret_6' => $result['cum_ret_6'],
			'pass_sample_1' => $result['pass_sample_1'],
			'pass_sample_2' => $result['pass_sample_2'],
			'pass_sample_3' => $result['pass_sample_3'],
			'pass_sample_4' => $result['pass_sample_4'],
			'pass_sample_5' => $result['pass_sample_5'],
			'pass_sample_6' => $result['pass_sample_6'],
			'chk_grd' => $result['chk_grd'],
			'chk_flk' => $result['chk_flk'],
			'chk_f1' => $result['chk_f1'],
			'chk_f2' => $result['chk_f2'],
			'chk_f3' => $result['chk_f3'],
			'chk_f4' => $result['chk_f4'],
			'chk_f5' => $result['chk_f5'],
			'chk_f6' => $result['chk_f6'],
			'chk_f7' => $result['chk_f7'],
			'chk_f8' => $result['chk_f8'],
			'chk_f9' => $result['chk_f9'],
			'p1' => $result['p1'],
			'p2' => $result['p2'],
			'p3' => $result['p3'],
			'p4' => $result['p4'],
			'p5' => $result['p5'],
			'p6' => $result['p6'],
			'p7' => $result['p7'],
			'p8' => $result['p8'],
			'p9' => $result['p9'],
			's11' => $result['s11'],
			's12' => $result['s12'],
			's13' => $result['s13'],
			's14' => $result['s14'],
			's15' => $result['s15'],
			's16' => $result['s16'],
			's17' => $result['s17'],
			's18' => $result['s18'],
			's19' => $result['s19'],
			'a1' => $result['a1'],
			'a2' => $result['a2'],
			'a3' => $result['a3'],
			'a4' => $result['a4'],
			'a5' => $result['a5'],
			'a6' => $result['a6'],
			'a7' => $result['a7'],
			'a8' => $result['a8'],
			'a9' => $result['a9'],
			'suma' => $result['suma'],
			'b1' => $result['b1'],
			'b2' => $result['b2'],
			'b3' => $result['b3'],
			'b4' => $result['b4'],
			'b5' => $result['b5'],
			'b6' => $result['b6'],
			'b7' => $result['b7'],
			'b8' => $result['b8'],
			'b9' => $result['b9'],
			'c1' => $result['c1'],
			'c2' => $result['c2'],
			'c3' => $result['c3'],
			'c4' => $result['c4'],
			'c5' => $result['c5'],
			'c6' => $result['c6'],
			'c7' => $result['c7'],
			'c8' => $result['c8'],
			'c9' => $result['c9'],
			'd1' => $result['d1'],
			'd2' => $result['d2'],
			'd3' => $result['d3'],
			'd4' => $result['d4'],
			'd5' => $result['d5'],
			'd6' => $result['d6'],
			'd7' => $result['d7'],
			'd8' => $result['d8'],
			'd9' => $result['d9'],
			'e1' => $result['e1'],
			'e2' => $result['e2'],
			'e3' => $result['e3'],
			'e4' => $result['e4'],
			'e5' => $result['e5'],
			'e6' => $result['e6'],
			'e7' => $result['e7'],
			'e8' => $result['e8'],
			'e9' => $result['e9'],
			'aa1' => $result['aa1'],
			'aa2' => $result['aa2'],
			'aa3' => $result['aa3'],
			'aa4' => $result['aa4'],
			'aa5' => $result['aa5'],
			'aa6' => $result['aa6'],
			'aa7' => $result['aa7'],
			'aa8' => $result['aa8'],
			'aa9' => $result['aa9'],
			'bb1' => $result['bb1'],
			'bb2' => $result['bb2'],
			'bb3' => $result['bb3'],
			'bb4' => $result['bb4'],
			'bb5' => $result['bb5'],
			'bb6' => $result['bb6'],
			'bb7' => $result['bb7'],
			'bb8' => $result['bb8'],
			'bb9' => $result['bb9'],
			'dd1' => $result['dd1'],
			'dd2' => $result['dd2'],
			'dd3' => $result['dd3'],
			'dd4' => $result['dd4'],
			'dd5' => $result['dd5'],
			'dd6' => $result['dd6'],
			'dd7' => $result['dd7'],
			'dd8' => $result['dd8'],
			'dd9' => $result['dd9'],
			'fi_index' => $result['fi_index'],
			'ei_index' => $result['ei_index'],
			'combined_index' => $result['combined_index'],
			'chk_sp' => $result['chk_sp'],
			'sp_temp' => $result['sp_temp'],
			'sp_sample_ca' => $result['sp_sample_ca'],
			'sp_specific_gravity' => $result['sp_specific_gravity'],
			'sp_specific_gravity_1' => $result['sp_specific_gravity_1'],
			'sp_specific_gravity_2' => $result['sp_specific_gravity_2'],
			'sp_water_abr_1' => $result['sp_water_abr_1'],
			'sp_water_abr_2' => $result['sp_water_abr_2'],
			'sp_water_abr' => $result['sp_water_abr'],
			'sp_w_b_a1_1' => $result['sp_w_b_a1_1'],
			'sp_w_b_a1_2' => $result['sp_w_b_a1_2'],
			'sp_w_b_a2_1' => $result['sp_w_b_a2_1'],
			'sp_w_b_a2_2' => $result['sp_w_b_a2_2'],
			'sp_w_sur_1' => $result['sp_w_sur_1'],
			'sp_w_sur_2' => $result['sp_w_sur_2'],
			'sp_wt_st_1' => $result['sp_wt_st_1'],
			'sp_wt_st_2' => $result['sp_wt_st_2'],
			'sp_w_s_1' => $result['sp_w_s_1'],
			'sp_w_s_2' => $result['sp_w_s_2'],
			'chk_impact' => $result['chk_impact'],
			'imp_w_m_a_1' => $result['imp_w_m_a_1'],
			'imp_w_m_a_2' => $result['imp_w_m_a_2'],
			'imp_w_m_b_1' => $result['imp_w_m_b_1'],
			'imp_w_m_b_2' => $result['imp_w_m_b_2'],
			'imp_w_m_c_1' => $result['imp_w_m_c_1'],
			'imp_w_m_c_2' => $result['imp_w_m_c_2'],
			'imp_w_m_d_1' => $result['imp_w_m_c_1'],
			'imp_w_m_d_2' => $result['imp_w_m_c_2'],
			'imp_value' => $result['imp_value'],
			'imp_value_1' => $result['imp_value_1'],
			'imp_value_2' => $result['imp_value_2'],
			'chk_alkali' => $result['chk_alkali'],
			'alkali_value' => $result['alkali_value'],
			'chk_strip' => $result['chk_strip'],
			'stripping_value' => $result['stripping_value'],
			'chk_fines' => $result['chk_fines'],
			'fines_value' => $result['fines_value'],
			'f_a_1' => $result['f_a_1'],
			'f_a_2' => $result['f_a_2'],
			'f_b_1' => $result['f_b_1'],
			'f_b_2' => $result['f_b_2'],
			'f_c_1' => $result['f_c_1'],
			'f_c_2' => $result['f_c_2'],
			'f_d_1' => $result['f_d_1'],
			'f_d_2' => $result['f_d_2'],
			'f_e_1' => $result['f_e_1'],
			'f_e_2' => $result['f_e_2'],
			'chk_abr' => $result['chk_abr'],
			'abr_index' => $result['abr_index'],
			'abr_sample_abr' => $result['abr_sample_abr'],
			'abr_wt_t_b_1' => $result['abr_wt_t_b_1'],
			'abr_wt_t_c_1' => $result['abr_wt_t_c_1'],
			'abr_wt_t_a_1' => $result['abr_wt_t_a_1'],
			'abr_wt_t_a_2' => $result['abr_wt_t_a_2'],
			'abr_wt_t_b_2' => $result['abr_wt_t_b_2'],
			'abr_wt_t_c_2' => $result['abr_wt_t_c_2'],
			'abr_grading' => $result['abr_grading'],
			'abr_weight_charge' => $result['abr_weight_charge'],
			'abr_num_revo' => $result['abr_num_revo'],
			'abr_sphere' => $result['abr_sphere'],
			'chk_sou' => $result['chk_sou'],
			'soundness' => $result['soundness'],
			'sample_id' => $result['sample_id'],
			'sound_sample' => $result['sound_sample'],
			'chk_wp' => $result['chk_wp'],
			'chk_a' => $result['chk_a'],
			'chk_b' => $result['chk_b'],
			'chk_c' => $result['chk_c'],
			'chk_d' => $result['chk_d'],
			'chk_e' => $result['chk_e'],
			'w1' => $result['w1'],
			'w2' => $result['w2'],
			'wsum' => $result['wsum'],
			'ga1' => $result['ga1'],
			'ga2' => $result['ga2'],
			'gasum' => $result['gasum'],
			'gb1' => $result['gb1'],
			'gb2' => $result['gb2'],
			'gbsum' => $result['gbsum'],
			'gc1' => $result['gc1'],
			'gc2' => $result['gc2'],
			'gcsum' => $result['gcsum'],
			'gd1' => $result['gd1'],
			'gd2' => $result['gd2'],
			'gdsum' => $result['gdsum'],
			'ge1' => $result['ge1'],
			'ge2' => $result['ge2'],
			's1' => $result['s1'],
			's2' => $result['s2'],
			'chk_crushing' => $result['chk_crushing'],
			'cr_a_1' => $result['cr_a_1'],
			'cr_a_2' => $result['cr_a_2'],
			'cr_b_1' => $result['cr_b_1'],
			'cr_b_2' => $result['cr_b_2'],
			'cr_c_1' => $result['cr_c_1'],
			'cr_c_2' => $result['cr_c_2'],
			'cru_value_1' => $result['cru_value_1'],
			'cru_value_2' => $result['cru_value_2'],
			'cru_value' => $result['cru_value'],
			'cr_sample_crush' => $result['cr_sample_crush'],
			'chk_ll' => $result['chk_ll'],
			'dep_1' => $result['dep_1'],
			'dep_2' => $result['dep_2'],
			'dep_3' => $result['dep_3'],
			'dep_4' => $result['dep_4'],
			'lab_no_1' => $result['lab_no_1'],
			'lab_no_2' => $result['lab_no_2'],
			'lab_no_3' => $result['lab_no_3'],
			'lab_no_4' => $result['lab_no_4'],
			'bo_1' => $result['bo_1'],
			'bo_2' => $result['bo_2'],
			'bo_3' => $result['bo_3'],
			'bo_4' => $result['bo_4'],
			'weight_sample_1' => $result['weight_sample_1'],
			'blow1' => $result['blow1'],
			'mc1' => $result['mc1'],
			'con1' => $result['con1'],
			'con2' => $result['con2'],
			'con3' => $result['con3'],
			'con4' => $result['con4'],
			'wws1' => $result['wws1'],
			'wws2' => $result['wws2'],
			'wws3' => $result['wws3'],
			'wws4' => $result['wws4'],
			'wds1' => $result['wds1'],
			'wds2' => $result['wds2'],
			'wds3' => $result['wds3'],
			'wds4' => $result['wds4'],
			'pl1' => $result['pl1'],
			'pl2' => $result['pl2'],
			'pl3' => $result['pl3'],
			'liquide_limit' => $result['liquide_limit'],
			'plastic_limit' => $result['plastic_limit'],
			'pi_value' => $result['pi_value'],
			'chk_mdd' => $result['chk_mdd'],
			'wos1' => $result['wos1'],
			'wos2' => $result['wos2'],
			'wos3' => $result['wos3'],
			'wos4' => $result['wos4'],
			'wos5' => $result['wos5'],
			'wos6' => $result['wos6'],
			'wad1' => $result['wad1'],
			'wad2' => $result['wad2'],
			'wad3' => $result['wad3'],
			'wad4' => $result['wad4'],
			'wad5' => $result['wad5'],
			'wad6' => $result['wad6'],
			'wra1' => $result['wra1'],
			'wra2' => $result['wra2'],
			'wra3' => $result['wra3'],
			'wra4' => $result['wra4'],
			'wra5' => $result['wra5'],
			'wra6' => $result['wra6'],
			'wmc1' => $result['wmc1'],
			'wmc2' => $result['wmc2'],
			'wmc3' => $result['wmc3'],
			'wmc4' => $result['wmc4'],
			'wmc5' => $result['wmc5'],
			'wmc6' => $result['wmc6'],
			'bd1' => $result['bd1'],
			'bd2' => $result['bd2'],
			'bd3' => $result['bd3'],
			'bd4' => $result['bd4'],
			'bd5' => $result['bd5'],
			'bd6' => $result['bd6'],
			'cnm1' => $result['cnm1'],
			'cnm2' => $result['cnm2'],
			'cnm3' => $result['cnm3'],
			'cnm4' => $result['cnm4'],
			'cnm5' => $result['cnm5'],
			'cnm6' => $result['cnm6'],
			'ww31' => $result['ww31'],
			'ww32' => $result['ww32'],
			'ww33' => $result['ww33'],
			'ww34' => $result['ww34'],
			'ww35' => $result['ww35'],
			'ww36' => $result['ww36'],
			'wd41' => $result['wd41'],
			'wd42' => $result['wd42'],
			'wd43' => $result['wd43'],
			'wd44' => $result['wd44'],
			'wd45' => $result['wd45'],
			'wd46' => $result['wd46'],
			'omc1' => $result['omc1'],
			'omc2' => $result['omc2'],
			'omc3' => $result['omc3'],
			'omc4' => $result['omc4'],
			'omc5' => $result['omc5'],
			'omc6' => $result['omc6'],
			'mdd1' => $result['mdd1'],
			'mdd2' => $result['mdd2'],
			'mdd3' => $result['mdd3'],
			'mdd4' => $result['mdd4'],
			'mdd5' => $result['mdd5'],
			'mdd6' => $result['mdd6'],
			'mdd' => $result['mdd'],
			'omc' => $result['omc'],
			'cbr' => $result['cbr'],
			'type_compaction' => $result['type_compaction'],
			'empty_mould' => $result['empty_mould'],
			'weight_of_sample' => $result['weight_of_sample'],
			'volume' => $result['volume'],
			'chk_den' => $result['chk_den'],
			'den_volume' => $result['den_volume'],
			'den_lab_1' => $result['den_lab_1'],
			'den_lab_2' => $result['den_lab_2'],
			'ov_1' => $result['ov_1'],
			'ov_2' => $result['ov_2'],
			'v1' => $result['v1'],
			'v2' => $result['v2'],
			'wt1' => $result['wt1'],
			'wt2' => $result['wt2'],
			'wm1' => $result['wm1'],
			'wm2' => $result['wm2'],
			'ws1' => $result['ws1'],
			'ws2' => $result['ws2'],
			'bdl1' => $result['bdl1'],
			'bdl2' => $result['bdl2'],
			'bdc1' => $result['bdc1'],
			'bdc2' => $result['bdc2'],
			'bdl' => $result['bdl'],
			'bdc' => $result['bdc'],
			'sou_size1' => $result['sou_size1'],
			'sou_size2' => $result['sou_size2'],
			'wms1' => $result['wms1'],
			'wms2' => $result['wms2'],
			'wms3' => $result['wms3'],
			'wms4' => $result['wms4'],
			'wms5' => $result['wms5'],
			'wms6' => $result['wms6']
		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];

		$sample_taken =  $_POST['sample_taken'];
		$sieve_1 = $_POST['sieve_1'];
		$sieve_2 = $_POST['sieve_2'];
		$sieve_3 = $_POST['sieve_3'];
		$sieve_4 = $_POST['sieve_4'];
		$sieve_5 = $_POST['sieve_5'];
		$sieve_6 = $_POST['sieve_6'];
		$cum_wt_gm_1 = $_POST['cum_wt_gm_1'];
		$cum_wt_gm_2 = $_POST['cum_wt_gm_2'];
		$cum_wt_gm_3 = $_POST['cum_wt_gm_3'];
		$cum_wt_gm_4 = $_POST['cum_wt_gm_4'];
		$cum_wt_gm_5 = $_POST['cum_wt_gm_5'];
		$cum_wt_gm_6 = $_POST['cum_wt_gm_6'];
		$ret_wt_gm_1 = $_POST['ret_wt_gm_1'];
		$ret_wt_gm_2 = $_POST['ret_wt_gm_2'];
		$ret_wt_gm_3 = $_POST['ret_wt_gm_3'];
		$ret_wt_gm_4 = $_POST['ret_wt_gm_4'];
		$ret_wt_gm_5 = $_POST['ret_wt_gm_5'];
		$ret_wt_gm_6 = $_POST['ret_wt_gm_6'];
		$cum_ret_1 = $_POST['cum_ret_1'];
		$cum_ret_2 = $_POST['cum_ret_2'];
		$cum_ret_3 = $_POST['cum_ret_3'];
		$cum_ret_4 = $_POST['cum_ret_4'];
		$cum_ret_5 = $_POST['cum_ret_5'];
		$cum_ret_6 = $_POST['cum_ret_6'];
		$pass_sample_1 = $_POST['pass_sample_1'];
		$pass_sample_2 = $_POST['pass_sample_2'];
		$pass_sample_3 = $_POST['pass_sample_3'];
		$pass_sample_4 = $_POST['pass_sample_4'];
		$pass_sample_5 = $_POST['pass_sample_5'];
		$pass_sample_6 = $_POST['pass_sample_6'];
		$blank_extra = $_POST['blank_extra'];


		//UPADVU AHITHI 
		$chk_grd =  $_POST['chk_grd'];
		$chk_sp =  $_POST['chk_sp'];
		$sp_sample_ca = $_POST['sp_sample_ca'];
		$sp_w_b_a1_1 = $_POST['sp_w_b_a1_1'];
		$sp_w_b_a1_2 = $_POST['sp_w_b_a1_2'];
		$sp_w_b_a2_2 = $_POST['sp_w_b_a2_2'];
		$sp_wt_st_1 = $_POST['sp_wt_st_1'];
		$sp_wt_st_2 = $_POST['sp_wt_st_2'];
		$sp_w_sur_2 = $_POST['sp_w_sur_2'];
		$sp_w_s_2 = $_POST['sp_w_s_2'];
		$sp_specific_gravity_1 = $_POST['sp_specific_gravity_1'];
		$sp_specific_gravity_2 = $_POST['sp_specific_gravity_2'];
		$sp_water_abr_1 = $_POST['sp_water_abr_1'];
		$sp_water_abr_2 = $_POST['sp_water_abr_2'];
		$sp_water_abr = $_POST['sp_water_abr'];
		$sp_w_b_a2_1 = $_POST['sp_w_b_a2_1'];
		$sp_w_sur_1 = $_POST['sp_w_sur_1'];
		$sp_w_s_1 = $_POST['sp_w_s_1'];
		$sp_specific_gravity = $_POST['sp_specific_gravity'];
		$sp_temp = $_POST['sp_temp'];



		$chk_flk =  $_POST['chk_flk'];
		$chk_f1 =  $_POST['chk_f1'];
		$chk_f2 =  $_POST['chk_f2'];
		$chk_f3 =  $_POST['chk_f3'];
		$chk_f4 =  $_POST['chk_f4'];
		$chk_f5 =  $_POST['chk_f5'];
		$chk_f6 =  $_POST['chk_f6'];
		$chk_f7 =  $_POST['chk_f7'];
		$chk_f8 =  $_POST['chk_f8'];
		$chk_f9 =  $_POST['chk_f9'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$a6 = $_POST['a6'];
		$a7 = $_POST['a7'];
		$a8 = $_POST['a8'];
		$a9 = $_POST['a9'];
		$suma = $_POST['suma'];
		$b1 = $_POST['b1'];
		$b2 = $_POST['b2'];
		$b3 = $_POST['b3'];
		$b4 = $_POST['b4'];
		$b5 = $_POST['b5'];
		$b6 = $_POST['b6'];
		$b7 = $_POST['b7'];
		$b8 = $_POST['b8'];
		$b9 = $_POST['b9'];
		$c1 = $_POST['c1'];
		$c2 = $_POST['c2'];
		$c3 = $_POST['c3'];
		$c4 = $_POST['c4'];
		$c5 = $_POST['c5'];
		$c6 = $_POST['c6'];
		$c7 = $_POST['c7'];
		$c8 = $_POST['c8'];
		$c9 = $_POST['c9'];
		$d1 = $_POST['d1'];
		$d2 = $_POST['d2'];
		$d3 = $_POST['d3'];
		$d4 = $_POST['d4'];
		$d5 = $_POST['d5'];
		$d6 = $_POST['d6'];
		$d7 = $_POST['d7'];
		$d8 = $_POST['d8'];
		$d9 = $_POST['d9'];
		$e1 = $_POST['e1'];
		$e2 = $_POST['e2'];
		$e3 = $_POST['e3'];
		$e4 = $_POST['e4'];
		$e5 = $_POST['e5'];
		$e6 = $_POST['e6'];
		$e7 = $_POST['e7'];
		$e8 = $_POST['e8'];
		$e9 = $_POST['e9'];
		$p1 = $_POST['p1'];
		$p2 = $_POST['p2'];
		$p3 = $_POST['p3'];
		$p4 = $_POST['p4'];
		$p5 = $_POST['p5'];
		$p6 = $_POST['p6'];
		$p7 = $_POST['p7'];
		$p8 = $_POST['p8'];
		$p9 = $_POST['p9'];
		$aa1 =  $_POST['aa1'];
		$aa2 =  $_POST['aa2'];
		$aa3 =  $_POST['aa3'];
		$aa4 =  $_POST['aa4'];
		$aa5 =  $_POST['aa5'];
		$aa6 =  $_POST['aa6'];
		$aa7 =  $_POST['aa7'];
		$aa8 =  $_POST['aa8'];
		$aa9 =  $_POST['aa9'];
		$bb1 =  $_POST['bb1'];
		$bb2 =  $_POST['bb2'];
		$bb3 =  $_POST['bb3'];
		$bb4 =  $_POST['bb4'];
		$bb5 =  $_POST['bb5'];
		$bb6 =  $_POST['bb6'];
		$bb7 =  $_POST['bb7'];
		$bb8 =  $_POST['bb8'];
		$bb9 =  $_POST['bb9'];
		$dd1 =  $_POST['dd1'];
		$dd2 =  $_POST['dd2'];
		$dd3 =  $_POST['dd3'];
		$dd4 =  $_POST['dd4'];
		$dd5 =  $_POST['dd5'];
		$dd6 =  $_POST['dd6'];
		$dd7 =  $_POST['dd7'];
		$dd8 =  $_POST['dd8'];
		$dd9 =  $_POST['dd9'];
		$fi_index = $_POST['fi_index'];
		$ei_index = $_POST['ei_index'];
		$combined_index = $_POST['combined_index'];
		$s11 =  $_POST['s11'];
		$s12 =  $_POST['s12'];
		$s13 =  $_POST['s13'];
		$s14 =  $_POST['s14'];
		$s15 =  $_POST['s15'];
		$s16 =  $_POST['s16'];
		$s17 =  $_POST['s17'];
		$s18 =  $_POST['s18'];
		$s19 =  $_POST['s19'];


		$chk_impact = $_POST['chk_impact'];
		$imp_w_m_a_1 = $_POST['imp_w_m_a_1'];
		$imp_w_m_a_2 = $_POST['imp_w_m_a_2'];
		$imp_w_m_b_1 = $_POST['imp_w_m_b_1'];
		$imp_w_m_b_2 = $_POST['imp_w_m_b_2'];
		$imp_w_m_c_1 = $_POST['imp_w_m_c_1'];
		$imp_w_m_c_2 = $_POST['imp_w_m_c_2'];
		$imp_w_m_d_1 = $_POST['imp_w_m_d_1'];
		$imp_w_m_d_2 = $_POST['imp_w_m_d_2'];
		$imp_value_1 = $_POST['imp_value_1'];
		$imp_value_2 = $_POST['imp_value_2'];
		$imp_value = $_POST['imp_value'];

		$chk_ll =  $_POST['chk_ll'];
		$dep_1 =  $_POST['dep_1'];
		$dep_2 =  $_POST['dep_2'];
		$dep_3 =  $_POST['dep_3'];
		$dep_4 =  $_POST['dep_4'];
		$lab_no_1 =  $_POST['lab_no_1'];
		$lab_no_2 =  $_POST['lab_no_2'];
		$lab_no_3 =  $_POST['lab_no_3'];
		$lab_no_4 =  $_POST['lab_no_4'];
		$bo_1 =  $_POST['bo_1'];
		$bo_2 =  $_POST['bo_2'];
		$bo_3 =  $_POST['bo_3'];
		$bo_4 =  $_POST['bo_4'];
		$weight_sample_1 =  $_POST['weight_sample_1'];
		$blow1 =  $_POST['blow1'];
		$mc1 =  $_POST['mc1'];
		$con1 =  $_POST['con1'];
		$con2 =  $_POST['con2'];
		$con3 =  $_POST['con3'];
		$con4 =  $_POST['con4'];
		$wws1 =  $_POST['wws1'];
		$wws2 =  $_POST['wws2'];
		$wws3 =  $_POST['wws3'];
		$wws4 =  $_POST['wws4'];
		$wds1 =  $_POST['wds1'];
		$wds2 =  $_POST['wds2'];
		$wds3 =  $_POST['wds3'];
		$wds4 =  $_POST['wds4'];
		$pl1 =  $_POST['pl1'];
		$pl2 =  $_POST['pl2'];
		$pl3 =  $_POST['pl3'];
		$liquide_limit =  $_POST['liquide_limit'];
		$plastic_limit =  $_POST['plastic_limit'];
		$pi_value =  $_POST['pi_value'];


		//mdd omc
		$chk_mdd =  $_POST['chk_mdd'];
		$wos1 =  $_POST['wos1'];
		$wos2 =  $_POST['wos2'];
		$wos3 =  $_POST['wos3'];
		$wos4 =  $_POST['wos4'];
		$wos5 =  $_POST['wos5'];
		$wos6 =  $_POST['wos6'];
		$wad1 =  $_POST['wad1'];
		$wad2 =  $_POST['wad2'];
		$wad3 =  $_POST['wad3'];
		$wad4 =  $_POST['wad4'];
		$wad5 =  $_POST['wad5'];
		$wad6 =  $_POST['wad6'];
		$wra1 =  $_POST['wra1'];
		$wra2 =  $_POST['wra2'];
		$wra3 =  $_POST['wra3'];
		$wra4 =  $_POST['wra4'];
		$wra5 =  $_POST['wra5'];
		$wra6 =  $_POST['wra6'];
		$wmc1 =  $_POST['wmc1'];
		$wmc2 =  $_POST['wmc2'];
		$wmc3 =  $_POST['wmc3'];
		$wmc4 =  $_POST['wmc4'];
		$wmc5 =  $_POST['wmc5'];
		$wmc6 =  $_POST['wmc6'];
		$bd1 =  $_POST['bd1'];
		$bd2 =  $_POST['bd2'];
		$bd3 =  $_POST['bd3'];
		$bd4 =  $_POST['bd4'];
		$bd5 =  $_POST['bd5'];
		$bd6 =  $_POST['bd6'];
		$cnm1 =  $_POST['cnm1'];
		$cnm2 =  $_POST['cnm2'];
		$cnm3 =  $_POST['cnm3'];
		$cnm4 =  $_POST['cnm4'];
		$cnm5 =  $_POST['cnm5'];
		$cnm6 =  $_POST['cnm6'];
		$ww31 =  $_POST['ww31'];
		$ww32 =  $_POST['ww32'];
		$ww33 =  $_POST['ww33'];
		$ww34 =  $_POST['ww34'];
		$ww35 =  $_POST['ww35'];
		$ww36 =  $_POST['ww36'];
		$wd41 =  $_POST['wd41'];
		$wd42 =  $_POST['wd42'];
		$wd43 =  $_POST['wd43'];
		$wd44 =  $_POST['wd44'];
		$wd45 =  $_POST['wd45'];
		$wd46 =  $_POST['wd46'];
		$omc1 =  $_POST['omc1'];
		$omc2 =  $_POST['omc2'];
		$omc3 =  $_POST['omc3'];
		$omc4 =  $_POST['omc4'];
		$omc5 =  $_POST['omc5'];
		$omc6 =  $_POST['omc6'];
		$mdd1 =  $_POST['mdd1'];
		$mdd2 =  $_POST['mdd2'];
		$mdd3 =  $_POST['mdd3'];
		$mdd4 =  $_POST['mdd4'];
		$mdd5 =  $_POST['mdd5'];
		$mdd6 =  $_POST['mdd6'];

		$mdd =  $_POST['mdd'];
		$omc =  $_POST['omc'];
		$cbr =  $_POST['cbr'];
		$type_compaction =  $_POST['type_compaction'];
		$empty_mould =  $_POST['empty_mould'];
		$weight_of_sample =  $_POST['weight_of_sample'];
		$volume =  $_POST['volume'];

		$chk_abr =  $_POST['chk_abr'];
		$abr_sample_abr = $_POST['abr_sample_abr'];
		$abr_wt_t_a_1 = $_POST['abr_wt_t_a_1'];
		$abr_wt_t_b_1 = $_POST['abr_wt_t_b_1'];
		$abr_wt_t_c_1 = $_POST['abr_wt_t_c_1'];
		$abr_index = $_POST['abr_index'];
		$abr_wt_t_a_2 = $_POST['abr_wt_t_a_2'];
		$abr_wt_t_b_2 = $_POST['abr_wt_t_b_2'];
		$abr_wt_t_c_2 = $_POST['abr_wt_t_c_2'];
		$abr_grading = $_POST['abr_grading'];
		$abr_sphere = $_POST['abr_sphere'];
		$abr_weight_charge = $_POST['abr_weight_charge'];
		$abr_num_revo = $_POST['abr_num_revo'];

		//soundness 
		$chk_sou = $_POST['chk_sou'];
		$chk_wp = $_POST['chk_wp'];
		$chk_a = $_POST['chk_a'];
		$chk_b = $_POST['chk_b'];
		$chk_c = $_POST['chk_c'];
		$chk_d = $_POST['chk_d'];
		$chk_e = $_POST['chk_e'];
		$sound_sample = $_POST['sound_sample'];
		$sample_id = $_POST['sample_id'];
		$w1 = $_POST['w1'];
		$w2 = $_POST['w2'];
		$ga1 = $_POST['ga1'];
		$ga2 = $_POST['ga2'];
		$gb1 = $_POST['gb1'];
		$gb2 = $_POST['gb2'];
		$gc1 = $_POST['gc1'];
		$gc2 = $_POST['gc2'];
		$gd1 = $_POST['gd1'];
		$gd2 = $_POST['gd2'];
		$ge1 = $_POST['ge1'];
		$ge2 = $_POST['ge2'];
		$s1 = $_POST['s1'];
		$s2 = $_POST['s2'];
		$wsum = $_POST['wsum'];
		$gasum = $_POST['gasum'];
		$gbsum = $_POST['gbsum'];
		$gcsum = $_POST['gcsum'];
		$gdsum = $_POST['gdsum'];
		$soundness = $_POST['soundness'];

		$chk_strip =  $_POST['chk_strip'];
		$stripping_value =  $_POST['stripping_value'];
		$chk_alkali =  $_POST['chk_alkali'];
		$alkali_value =  $_POST['alkali_value'];

		$chk_fines =  $_POST['chk_fines'];
		$fines_value =  $_POST['fines_value'];
		$f_a_1 =  $_POST['f_a_1'];
		$f_a_2 =  $_POST['f_a_2'];
		$f_b_1 =  $_POST['f_b_1'];
		$f_b_2 =  $_POST['f_b_2'];
		$f_c_1 =  $_POST['f_c_1'];
		$f_c_2 =  $_POST['f_c_2'];
		$f_d_1 =  $_POST['f_d_1'];
		$f_d_2 =  $_POST['f_d_2'];
		$f_e_1 =  $_POST['f_e_1'];
		$f_e_2 =  $_POST['f_e_2'];

		//crushing value
		$chk_crushing =  $_POST['chk_crushing'];
		$cr_a_1 =  $_POST['cr_a_1'];
		$cr_a_2 =  $_POST['cr_a_2'];
		$cr_b_1 =  $_POST['cr_b_1'];
		$cr_b_2 =  $_POST['cr_b_2'];
		$cr_c_1 =  $_POST['cr_c_1'];
		$cr_c_2 =  $_POST['cr_c_2'];
		$cru_value =  $_POST['cru_value'];
		$cru_value_1 =  $_POST['cru_value_1'];
		$cru_value_2 =  $_POST['cru_value_2'];

		//bluk density
		$chk_den =  $_POST['chk_den'];
		$den_volume =  $_POST['den_volume'];
		$den_lab_1 =  $_POST['den_lab_1'];
		$den_lab_2 =  $_POST['den_lab_2'];
		$ov_1 =  $_POST['ov_1'];
		$ov_2 =  $_POST['ov_2'];
		$v1 =  $_POST['v1'];
		$v2 =  $_POST['v2'];
		$wt1 =  $_POST['wt1'];
		$wt2 =  $_POST['wt2'];
		$wm1 =  $_POST['wm1'];
		$wm2 =  $_POST['wm2'];
		$ws1 =  $_POST['ws1'];
		$ws2 =  $_POST['ws2'];
		$bdl1 =  $_POST['bdl1'];
		$bdl2 =  $_POST['bdl2'];
		$bdc1 =  $_POST['bdc1'];
		$bdc2 =  $_POST['bdc2'];
		$bdl =  $_POST['bdl'];
		$bdc =  $_POST['bdc'];
		$wms1 =  $_POST['wms1'];
		$wms2 =  $_POST['wms2'];
		$wms3 =  $_POST['wms3'];
		$wms4 =  $_POST['wms4'];
		$wms5 =  $_POST['wms5'];
		$wms6 =  $_POST['wms6'];
		$sou_size1 = $_POST['sou_size1'];
		$sou_size2 = $_POST['sou_size2'];
		$curr_date = date("Y-m-d");


		$insert = "INSERT INTO `gsb_26_5_4_75_mm`(`report_no`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`,  `chk_grd`, `sieve_1`, `sieve_2`, `sieve_3`, `sieve_4`, `sieve_5`, `sieve_6`, `cum_wt_gm_1`, `cum_wt_gm_2`, `cum_wt_gm_3`, `cum_wt_gm_4`, `cum_wt_gm_5`, `cum_wt_gm_6`, `ret_wt_gm_1`, `ret_wt_gm_2`, `ret_wt_gm_3`, `ret_wt_gm_4`, `ret_wt_gm_5`, `ret_wt_gm_6`, `cum_ret_1`, `cum_ret_2`, `cum_ret_3`, `cum_ret_4`, `cum_ret_5`, `cum_ret_6`,`pass_sample_1`, `pass_sample_2`, `pass_sample_3`, `pass_sample_4`, `pass_sample_5`, `pass_sample_6`, `blank_extra`, `sample_taken`,`chk_sp`, `sp_sample_ca`, `sp_w_b_a1_1`, `sp_w_b_a1_2`, `sp_w_b_a2_1`, `sp_w_b_a2_2`, `sp_wt_st_1`, `sp_wt_st_2`, `sp_w_sur_1`, `sp_w_sur_2`, `sp_w_s_1`, `sp_w_s_2`, `sp_specific_gravity_1`, `sp_specific_gravity_2`, `sp_specific_gravity`, `sp_water_abr_1`, `sp_water_abr_2`, `sp_water_abr`, `sp_temp`,`chk_flk`, `chk_f1`, `chk_f2`, `chk_f3`, `chk_f4`, `chk_f5`, `chk_f6`, `chk_f7`, `chk_f8`, `chk_f9`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `suma`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `c7`, `c8`, `c9`, `d1`, `d2`, `d3`, `d4`, `d5`, `d6`, `d7`, `d8`, `d9`, `e1`, `e2`, `e3`, `e4`, `e5`, `e6`, `e7`, `e8`, `e9`, `fi_index`, `aa1`, `aa2`, `aa3`, `aa4`, `aa5`, `aa6`, `aa7`, `aa8`, `aa9`, `bb1`, `bb2`, `bb3`, `bb4`, `bb5`, `bb6`, `bb7`, `bb8`, `bb9`, `dd1`, `dd2`, `dd3`, `dd4`, `dd5`, `dd6`, `dd7`, `dd8`, `dd9`, `ei_index`, `combined_index`, `s11`, `s12`, `s13`, `s14`, `s15`, `s16`, `s17`, `s18`, `s19`,`p1`, `p2`, `p3`, `p4`, `p5`, `p6`, `p7`, `p8`, `p9`,`chk_impact`, `imp_w_m_a_1`, `imp_w_m_a_2`, `imp_w_m_b_1`, `imp_w_m_b_2`, `imp_w_m_c_1`, `imp_w_m_c_2`,`imp_w_m_d_1`, `imp_w_m_d_2`, `imp_value_1`, `imp_value_2`, `imp_value`, `chk_sou`, `chk_wp`, `chk_a`, `chk_b`, `chk_c`, `chk_d`, `chk_e`, `sample_id`, `sound_sample`, `w1`, `w2`, `wsum`, `ga1`, `ga2`, `gasum`, `gb1`, `gb2`, `gbsum`,`gc1`, `gc2`, `gcsum`, `gd1`, `gd2`, `gdsum`, `ge1`, `ge2`, `s1`, `s2`, `soundness`,`chk_strip`, `stripping_value`,`chk_alkali`, `alkali_value`,`chk_fines`, `fines_value`,`f_a_1`, `f_a_2`, `f_b_1`, `f_b_2`, `f_c_1`, `f_c_2`, `f_d_1`, `f_d_2`, `f_e_1`, `f_e_2`,`chk_crushing`,`cru_value`,`cr_sample_crush`,`cr_a_1`,`cr_a_2`,`cr_b_1`,`cr_b_2`,`cr_c_1`,`cr_c_2`,`cru_value_1`,`cru_value_2`,`chk_abr`, `abr_sample_abr`, `abr_wt_t_a_1`, `abr_wt_t_b_1`,  `abr_wt_t_c_1`, `abr_wt_t_a_2`, `abr_wt_t_b_2`, `abr_wt_t_c_2`, `abr_index`, `abr_grading`, `abr_weight_charge`, `abr_num_revo`, `abr_sphere`,`chk_ll`,`dep_1`, `dep_2`, `dep_3`, `dep_4`, `lab_no_1`, `lab_no_2`, `lab_no_3`, `lab_no_4`, `bo_1`, `bo_2`, `bo_3`, `bo_4`, `weight_sample_1`, `blow1`, `mc1`, `con1`, `con2`, `con3`, `con4`, `wws1`, `wws2`, `wws3`, `wws4`, `wds1`, `wds2`, `wds3`, `wds4`, `pl1`, `pl2`, `pl3`, `liquide_limit`, `plastic_limit`, `pi_value`,`chk_mdd`, `mdd`, `omc`,`cbr`, `type_compaction`,`empty_mould`,`weight_of_sample`,`volume`, `wos1`, `wos2`, `wos3`, `wos4`, `wos5`, `wos6`, `wad1`, `wad2`, `wad3`, `wad4`, `wad5`, `wad6`, `wra1`, `wra2`, `wra3`, `wra4`, `wra5`, `wra6`, `wmc1`, `wmc2`, `wmc3`, `wmc4`, `wmc5`, `wmc6`, `bd1`, `bd2`, `bd3`, `bd4`, `bd5`, `bd6`, `cnm1`, `cnm2`, `cnm3`, `cnm4`, `cnm5`, `cnm6`, `ww31`, `ww32`, `ww33`, `ww34`, `ww35`, `ww36`, `wd41`, `wd42`, `wd43`, `wd44`, `wd45`, `wd46`, `omc1`, `omc2`, `omc3`, `omc4`, `omc5`, `omc6`, `mdd1`, `mdd2`, `mdd3`, `mdd4`, `mdd5`, `mdd6`, `chk_den`,`den_volume`,`den_lab_1`,`den_lab_2`,`ov_1`,`ov_2`,`v1`,`v2`,`wt1`,`wt2`,`wm1`,`wm2`,`ws1`,`ws2`,`bdl1`,`bdl2`,`bdc1`,`bdc2`,`bdl`,`bdc`,`sou_size1`,`sou_size2`,`wms1`,`wms2`,`wms3`,`wms4`,`wms5`,`wms6`) VALUES ('$report_no','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$chk_grd','$sieve_1','$sieve_2','$sieve_3','$sieve_4','$sieve_5','$sieve_6','$cum_wt_gm_1','$cum_wt_gm_2','$cum_wt_gm_3','$cum_wt_gm_4','$cum_wt_gm_5','$cum_wt_gm_6','$ret_wt_gm_1','$ret_wt_gm_2','$ret_wt_gm_3','$ret_wt_gm_4','$ret_wt_gm_5','$ret_wt_gm_6','$cum_ret_1','$cum_ret_2','$cum_ret_3','$cum_ret_4','$cum_ret_5','$cum_ret_6','$pass_sample_1','$pass_sample_2','$pass_sample_3','$pass_sample_4','$pass_sample_5','$pass_sample_6','$blank_extra','$sample_taken','$chk_sp','$sp_sample_ca','$sp_w_b_a1_1','$sp_w_b_a1_2','$sp_w_b_a2_1','$sp_w_b_a2_2','$sp_wt_st_1','$sp_wt_st_2','$sp_w_sur_1','$sp_w_sur_2','$sp_w_s_1','$sp_w_s_2','$sp_specific_gravity_1','$sp_specific_gravity_2','$sp_specific_gravity','$sp_water_abr_1','$sp_water_abr_2','$sp_water_abr','$sp_temp',
				'$chk_flk','$chk_f1','$chk_f2','$chk_f3','$chk_f4','$chk_f5','$chk_f6','$chk_f7','$chk_f8','$chk_f9','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$suma','$b1','$b2','$b3','$b4','$b5','$b6','$b7','$b8','$b9','$c1','$c2','$c3','$c4','$c5','$c6','$c7','$c8','$c9','$d1','$d2','$d3','$d4','$d5','$d6','$d7','$d8','$d9','$e1','$e2','$e3','$e4','$e5','$e6','$e7','$e8','$e9','$fi_index','$aa1','$aa2','$aa3','$aa4','$aa5','$aa6','$aa7','$aa8','$aa9','$bb1','$bb2','$bb3','$bb4','$bb5','$bb6','$bb7','$bb8','$bb9','$dd1','$dd2','$dd3','$dd4','$dd5','$dd6','$dd7','$dd8','$dd9','$ei_index','$combined_index','$s11','$s12','$s13','$s14','$s15','$s16','$s17','$s18','$s19','$p1','$p2','$p3','$p4','$p5','$p6','$p7','$p8','$p9',
				'$chk_impact','$imp_w_m_a_1','$imp_w_m_a_2','$imp_w_m_b_1','$imp_w_m_b_2','$imp_w_m_c_1','$imp_w_m_c_2','$imp_w_m_d_1','$imp_w_m_d_2','$imp_value_1','$imp_value_2','$imp_value',
				'$chk_sou','$chk_wp','$chk_a','$chk_b','$chk_c','$chk_d','$chk_e','$sample_id','$sound_sample','$w1','$w2','$wsum','$ga1','$ga2','$gasum','$gb1','$gb2','$gbsum','$gc1','$gc2','$gcsum','$gd1','$gd2','$gdsum','$ge1','$ge2','$s1','$s2','$soundness',
				'$chk_strip','$stripping_value',
				'$chk_alkali','$alkali_value',
				'$chk_fines','$fines_value',				
				 '$f_a_1','$f_a_2','$f_b_1','$f_b_2', '$f_c_1','$f_c_2', '$f_d_1','$f_d_2', '$f_e_1','$f_e_2',
				'$chk_crushing','$cru_value','$cr_sample_crush','$cr_a_1','$cr_a_2','$cr_b_1','$cr_b_2','$cr_c_1','$cr_c_2','$cru_value_1','$cru_value_2',				
				'$chk_abr','$abr_sample_abr','$abr_wt_t_a_1','$abr_wt_t_b_1','$abr_wt_t_c_1','$abr_wt_t_a_2','$abr_wt_t_b_2','$abr_wt_t_c_2','$abr_index','$abr_grading','$abr_weight_charge','$abr_num_revo','$abr_sphere',				
				'$chk_ll','$dep_1','$dep_2','$dep_3','$dep_4','$lab_no_1','$lab_no_2','$lab_no_3','$lab_no_4','$bo_1','$bo_2','$bo_3','$bo_4','$weight_sample_1','$blow1','$mc1','$con1','$con2','$con3','$con4','$wws1','$wws2','$wws3','$wws4','$wds1','$wds2','$wds3','$wds4','$pl1','$pl2','$pl3','$liquide_limit','$plastic_limit','$pi_value',
				'$chk_mdd','$mdd','$omc','$cbr','$type_compaction','$empty_mould','$weight_of_sample','$volume','$wos1','$wos2','$wos3','$wos4','$wos5','$wos6','$wad1','$wad2','$wad3','$wad4','$wad5','$wad6','$wra1','$wra2','$wra3','$wra4','$wra5','$wra6','$wmc1','$wmc2','$wmc3','$wmc4','$wmc5','$wmc6','$bd1','$bd2','$bd3','$bd4','$bd5','$bd6','$cnm1','$cnm2','$cnm3','$cnm4','$cnm5','$cnm6','$ww31','$ww32','$ww33','$ww34','$ww35','$ww36','$wd41','$wd42','$wd43','$wd44','$wd45','$wd46','$omc1','$omc2','$omc3','$omc4','$omc5','$omc6','$mdd1','$mdd2','$mdd3','$mdd4','$mdd5','$mdd6',
				'$chk_den','$den_volume','$den_lab_1','$den_lab_2','$ov_1','$ov_2','$v1','$v2','$wt1','$wt2','$wm1','$wm2','$ws1','$ws2','$bdl1','$bdl2','$bdc1','$bdc2','$bdl','$bdc','$sou_size1','$sou_size2','$wms1','$wms2','$wms3','$wms4','$wms5','$wms6')";


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
							<th style="text-align:center;"><label>Report No.</label></th>
							<th style="text-align:center;"><label>Job No.</label></th>
							<th style="text-align:center;"><label>Lab No.</label></th>



						</tr>
						<?php
						$query = "select * from gsb_26_5_4_75_mm WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
											//}
											?>
										</td>
										<td style="text-align:center;"><?php echo $r['report_no']; ?></td>
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


		$update = "update gsb_26_5_4_75_mm SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',
					 `checked_by`=NULL,
					`chk_grd`='$_POST[chk_grd]',
					`sp_temp`='$_POST[sp_temp]',
				 `sieve_1`='$_POST[sieve_1]',
				 `sieve_2`='$_POST[sieve_2]',
				 `sieve_3`='$_POST[sieve_3]',
				 `sieve_4`='$_POST[sieve_4]',
				 `sieve_5`='$_POST[sieve_5]',
				 `sieve_6`='$_POST[sieve_6]',
				 `cum_wt_gm_1`='$_POST[cum_wt_gm_1]',
				 `cum_wt_gm_2`='$_POST[cum_wt_gm_2]',
				 `cum_wt_gm_3`='$_POST[cum_wt_gm_3]',
				 `cum_wt_gm_4`='$_POST[cum_wt_gm_4]',
				 `cum_wt_gm_5`='$_POST[cum_wt_gm_5]',
				 `cum_wt_gm_6`='$_POST[cum_wt_gm_6]',
				 `ret_wt_gm_1`='$_POST[ret_wt_gm_1]',
				 `ret_wt_gm_2`='$_POST[ret_wt_gm_2]',
				 `ret_wt_gm_3`='$_POST[ret_wt_gm_3]',
				 `ret_wt_gm_4`='$_POST[ret_wt_gm_4]',
				 `ret_wt_gm_5`='$_POST[ret_wt_gm_5]',
				 `ret_wt_gm_6`='$_POST[ret_wt_gm_6]',
				 `cum_ret_1`='$_POST[cum_ret_1]',
				 `cum_ret_2`='$_POST[cum_ret_2]',
				 `cum_ret_3`='$_POST[cum_ret_3]',
				 `cum_ret_4`='$_POST[cum_ret_4]',
				 `cum_ret_5`='$_POST[cum_ret_5]',
				 `cum_ret_6`='$_POST[cum_ret_6]',
				 `pass_sample_1`='$_POST[pass_sample_1]',
				 `pass_sample_2`='$_POST[pass_sample_2]',
				 `pass_sample_3`='$_POST[pass_sample_3]',
				 `pass_sample_4`='$_POST[pass_sample_4]',
				 `pass_sample_5`='$_POST[pass_sample_5]',
				 `pass_sample_6`='$_POST[pass_sample_6]',
				`blank_extra`='$_POST[blank_extra]',
				 `sample_taken`='$_POST[sample_taken]',
				 `chk_abr`='$_POST[chk_abr]',`abr_sample_abr`='$_POST[abr_sample_abr]',`abr_wt_t_a_1`='$_POST[abr_wt_t_a_1]',`abr_wt_t_b_1`='$_POST[abr_wt_t_b_1]',`abr_wt_t_c_1`='$_POST[abr_wt_t_c_1]',`abr_index`='$_POST[abr_index]',`chk_flk`='$_POST[chk_flk]',
				 `chk_f1`='$_POST[chk_f1]',
				 `chk_f2`='$_POST[chk_f2]',
				 `chk_f3`='$_POST[chk_f3]',
				 `chk_f4`='$_POST[chk_f4]',
				 `chk_f5`='$_POST[chk_f5]',
				 `chk_f6`='$_POST[chk_f6]',
				 `chk_f7`='$_POST[chk_f7]',
				 `chk_f8`='$_POST[chk_f8]',
				 `chk_f9`='$_POST[chk_f9]',
				 `p1`='$_POST[p1]',
				 `p2`='$_POST[p2]',
				 `p3`='$_POST[p3]',
				 `p4`='$_POST[p4]',
				 `p5`='$_POST[p5]',
				 `p6`='$_POST[p6]',
				 `p7`='$_POST[p7]',
				 `p8`='$_POST[p8]',
				 `p9`='$_POST[p9]',
				 `a1`='$_POST[a1]',
				 `a2`='$_POST[a2]',
				 `a3`='$_POST[a3]',
				 `a4`='$_POST[a4]',
				 `a5`='$_POST[a5]',
				 `a6`='$_POST[a6]',
				 `a7`='$_POST[a7]',
				 `a8`='$_POST[a8]',
				 `a9`='$_POST[a9]',
				 `suma`='$_POST[suma]',
				 `b1`='$_POST[b1]',
				 `b2`='$_POST[b2]',
				 `b3`='$_POST[b3]',
				 `b4`='$_POST[b4]',
				 `b5`='$_POST[b5]',				 
				 `b6`='$_POST[b6]',				 
				 `b7`='$_POST[b7]',				 
				 `b8`='$_POST[b8]',				 
				 `b9`='$_POST[b9]',				 
				 `c1`='$_POST[c1]',
				 `c2`='$_POST[c2]',
				 `c3`='$_POST[c3]',
				 `c4`='$_POST[c4]',
				 `c5`='$_POST[c5]',
				 `c6`='$_POST[c6]',
				 `c7`='$_POST[c7]',
				 `c8`='$_POST[c8]',
				 `c9`='$_POST[c9]',
				 `d1`='$_POST[d1]',
				 `d2`='$_POST[d2]',
				 `d3`='$_POST[d3]',
				 `d4`='$_POST[d4]',
				 `d5`='$_POST[d5]',
				 `d6`='$_POST[d6]',
				 `d7`='$_POST[d7]',
				 `d8`='$_POST[d8]',
				 `d9`='$_POST[d9]',
				 `e1`='$_POST[e1]',
				 `e2`='$_POST[e2]',
				 `e3`='$_POST[e3]',
				 `e4`='$_POST[e4]',
				 `e5`='$_POST[e5]',
				 `e6`='$_POST[e6]',
				 `e7`='$_POST[e7]',
				 `e8`='$_POST[e8]',
				 `e9`='$_POST[e9]',
				 `fi_index`='$_POST[fi_index]',				 
				 `aa1`='$_POST[aa1]',
				 `aa2`='$_POST[aa2]',
				 `aa3`='$_POST[aa3]',
				 `aa4`='$_POST[aa4]',
				 `aa5`='$_POST[aa5]',				 
				 `aa6`='$_POST[aa6]',				 
				 `aa7`='$_POST[aa7]',				 
				 `aa8`='$_POST[aa8]',				 
				 `aa9`='$_POST[aa9]',				 
				 `bb1`='$_POST[bb1]',
				 `bb2`='$_POST[bb2]',
				 `bb3`='$_POST[bb3]',
				 `bb4`='$_POST[bb4]',
				 `bb5`='$_POST[bb5]',				 
				 `bb6`='$_POST[bb6]',				 
				 `bb7`='$_POST[bb7]',				 
				 `bb8`='$_POST[bb8]',				 
				 `bb9`='$_POST[bb9]',				 
				 `dd1`='$_POST[dd1]',
				 `dd2`='$_POST[dd2]',
				 `dd3`='$_POST[dd3]',
				 `dd4`='$_POST[dd4]',
				 `dd5`='$_POST[dd5]',
				 `dd6`='$_POST[dd6]',
				 `dd7`='$_POST[dd7]',
				 `dd8`='$_POST[dd8]',
				 `dd9`='$_POST[dd9]',				 
				 `ei_index`='$_POST[ei_index]',
				 `combined_index`='$_POST[combined_index]',
				 `s11`='$_POST[s11]',
				 `s12`='$_POST[s12]',
				 `s13`='$_POST[s13]',
				 `s14`='$_POST[s14]',
				 `s15`='$_POST[s15]',
				 `s16`='$_POST[s16]',
				 `s17`='$_POST[s17]',
				 `s18`='$_POST[s18]',
				 `s19`='$_POST[s19]',`chk_sp`='$_POST[chk_sp]',`sp_sample_ca`='$_POST[sp_sample_ca]',`sp_w_b_a1_1`='$_POST[sp_w_b_a1_1]',`sp_w_b_a1_2`='$_POST[sp_w_b_a1_2]',`sp_w_b_a2_1`='$_POST[sp_w_b_a2_1]',`sp_w_b_a2_2`='$_POST[sp_w_b_a2_2]',`sp_wt_st_1`='$_POST[sp_wt_st_1]',`sp_wt_st_2`='$_POST[sp_wt_st_2]',`sp_w_sur_1`='$_POST[sp_w_sur_1]',`sp_w_sur_2`='$_POST[sp_w_sur_2]',`sp_w_s_1`='$_POST[sp_w_s_1]',`sp_w_s_2`='$_POST[sp_w_s_2]',`sp_specific_gravity_1`='$_POST[sp_specific_gravity_1]',`sp_specific_gravity_2`='$_POST[sp_specific_gravity_2]',`sp_specific_gravity`='$_POST[sp_specific_gravity]',`sp_water_abr_1`='$_POST[sp_water_abr_1]',`sp_water_abr_2`='$_POST[sp_water_abr_2]',`sp_water_abr`='$_POST[sp_water_abr]',`chk_impact`='$_POST[chk_impact]',`imp_w_m_a_1`='$_POST[imp_w_m_a_1]',`imp_w_m_a_2`='$_POST[imp_w_m_a_2]',`imp_w_m_b_1`='$_POST[imp_w_m_b_1]',`imp_w_m_b_2`='$_POST[imp_w_m_b_2]',`imp_w_m_c_1`='$_POST[imp_w_m_c_1]',`imp_w_m_c_2`='$_POST[imp_w_m_c_2]',`imp_value_1`='$_POST[imp_value_1]',`imp_value_2`='$_POST[imp_value_2]',`imp_value`='$_POST[imp_value]',`chk_sou`='$_POST[chk_sou]',
				 `chk_a`='$_POST[chk_a]',
				 `chk_b`='$_POST[chk_b]',
				 `chk_c`='$_POST[chk_c]',
				 `chk_d`='$_POST[chk_d]',
				 `chk_e`='$_POST[chk_e]',
				 `sound_sample`='$_POST[sound_sample]',
				 `sample_id`='$_POST[sample_id]',
				 `w1`='$_POST[w1]',
				 `w2`='$_POST[w2]',
				 `ga1`='$_POST[ga1]',
				 `ga2`='$_POST[ga2]',
				 `gb1`='$_POST[gb1]',
				 `gb2`='$_POST[gb2]',
				 `gc1`='$_POST[gc1]',
				 `gc2`='$_POST[gc2]',
				 `gd1`='$_POST[gd1]',
				 `gd2`='$_POST[gd2]',
				 `ge1`='$_POST[ge1]',
				 `ge2`='$_POST[ge2]',
				 `s1`='$_POST[s1]',
				 `s2`='$_POST[s2]',
				 `wsum`='$_POST[wsum]',
				 `gasum`='$_POST[gasum]',
				 `gbsum`='$_POST[gbsum]',
				 `gcsum`='$_POST[gcsum]',
				 `gdsum`='$_POST[gdsum]',
				 `chk_crushing`='$_POST[chk_crushing]',
				 `cru_value`='$_POST[cru_value]',
				 `cr_sample_crush`='$_POST[cr_sample_crush]',
				 `cr_a_1`='$_POST[cr_a_1]',
				 `cr_a_2`='$_POST[cr_a_2]',
				 `cr_b_1`='$_POST[cr_b_1]',
				 `cr_b_2`='$_POST[cr_b_2]',
				 `cr_c_1`='$_POST[cr_c_1]',
				 `cr_c_2`='$_POST[cr_c_2]',
				 `cru_value_1`='$_POST[cru_value_1]',
				 `cru_value_2`='$_POST[cru_value_2]',
				 `soundness`='$_POST[soundness]',
				 `chk_mdd`='$_POST[chk_mdd]',`mdd`='$_POST[mdd]',`omc`='$_POST[omc]',`cbr`='$_POST[cbr]',`type_compaction`='$_POST[type_compaction]',`empty_mould`='$_POST[empty_mould]',`weight_of_sample`='$_POST[weight_of_sample]',`volume`='$_POST[volume]',`wos1`='$_POST[wos1]',`wos2`='$_POST[wos2]',`wos3`='$_POST[wos3]',`wos4`='$_POST[wos4]',`wos5`='$_POST[wos5]',`wos6`='$_POST[wos6]',`wad1`='$_POST[wad1]',`wad2`='$_POST[wad2]',`wad3`='$_POST[wad3]',`wad4`='$_POST[wad4]',`wad5`='$_POST[wad5]',`wad6`='$_POST[wad6]',`wra1`='$_POST[wra1]',`wra2`='$_POST[wra2]',`wra3`='$_POST[wra3]',`wra4`='$_POST[wra4]',`wra5`='$_POST[wra5]',`wra6`='$_POST[wra6]',`wmc1`='$_POST[wmc1]',`wmc2`='$_POST[wmc2]',`wmc3`='$_POST[wmc3]',`wmc4`='$_POST[wmc4]',`wmc5`='$_POST[wmc5]',`wmc6`='$_POST[wmc6]',`bd1`='$_POST[bd1]',`bd2`='$_POST[bd2]',`bd3`='$_POST[bd3]',`bd4`='$_POST[bd4]',`bd5`='$_POST[bd5]',`bd6`='$_POST[bd6]',`cnm1`='$_POST[cnm1]',`cnm2`='$_POST[cnm2]',`cnm3`='$_POST[cnm3]',`cnm4`='$_POST[cnm4]',`cnm5`='$_POST[cnm5]',`cnm6`='$_POST[cnm6]',`ww31`='$_POST[ww31]',`ww32`='$_POST[ww32]',`ww33`='$_POST[ww33]',`ww34`='$_POST[ww34]',`ww35`='$_POST[ww35]',`ww36`='$_POST[ww36]',`wd41`='$_POST[wd41]',`wd42`='$_POST[wd42]',`wd43`='$_POST[wd43]',`wd44`='$_POST[wd44]',`wd45`='$_POST[wd45]',`wd46`='$_POST[wd46]',`omc1`='$_POST[omc1]',`omc2`='$_POST[omc2]',`omc3`='$_POST[omc3]',`omc4`='$_POST[omc4]',`omc5`='$_POST[omc5]',`omc6`='$_POST[omc6]',`mdd1`='$_POST[mdd1]',`mdd2`='$_POST[mdd2]',`mdd3`='$_POST[mdd3]',`mdd4`='$_POST[mdd4]',`mdd5`='$_POST[mdd5]',`mdd6`='$_POST[mdd6]',`chk_fines`='$_POST[chk_fines]',`fines_value`='$_POST[fines_value]',`chk_strip`='$_POST[chk_strip]',`stripping_value`='$_POST[stripping_value]',
				  `f_a_1`='$_POST[f_a_1]',
				 `f_a_2`='$_POST[f_a_2]',
				 `f_b_1`='$_POST[f_b_1]',
				 `f_b_2`='$_POST[f_b_2]',
				 `f_c_1`='$_POST[f_c_1]',
				 `f_c_2`='$_POST[f_c_2]',
				 `f_d_1`='$_POST[f_d_1]',
				 `f_d_2`='$_POST[f_d_2]',
				 `f_e_1`='$_POST[f_e_1]',
				 `f_e_2`='$_POST[f_e_2]',
				 `chk_alkali`='$_POST[chk_alkali]',`alkali_value`='$_POST[alkali_value]',`modified_by`='$_SESSION[name]',`modified_date`='$curr_date',
				`imp_w_m_d_1`='$_POST[imp_w_m_d_1]',
				`imp_w_m_d_2`='$_POST[imp_w_m_d_2]',
				`abr_grading`='$_POST[abr_grading]',
				`abr_num_revo`='$_POST[abr_num_revo]',
				`abr_weight_charge`='$_POST[abr_weight_charge]',
				`abr_wt_t_a_2`='$_POST[abr_wt_t_a_2]',
				`abr_wt_t_b_2`='$_POST[abr_wt_t_b_2]',
				`abr_wt_t_c_2`='$_POST[abr_wt_t_c_2]',
				`abr_sphere`='$_POST[abr_sphere]',
				`chk_ll`='$_POST[chk_ll]',
				`dep_1`='$_POST[dep_1]',
				`dep_2`='$_POST[dep_2]',
				`dep_3`='$_POST[dep_3]',
				`dep_4`='$_POST[dep_4]',
				`lab_no_1`='$_POST[lab_no_1]',
				`lab_no_2`='$_POST[lab_no_2]',
				`lab_no_3`='$_POST[lab_no_3]',
				`lab_no_4`='$_POST[lab_no_4]',
				`bo_1`='$_POST[bo_1]',
				`bo_2`='$_POST[bo_2]',
				`bo_3`='$_POST[bo_3]',
				`bo_4`='$_POST[bo_4]',
				`weight_sample_1`='$_POST[weight_sample_1]',
				`blow1`='$_POST[blow1]',
				`mc1`='$_POST[mc1]',
				`con1`='$_POST[con1]',
				`con2`='$_POST[con2]',
				`con3`='$_POST[con3]',
				`con4`='$_POST[con4]',
				`wws1`='$_POST[wws1]',
				`wws2`='$_POST[wws2]',
				`wws3`='$_POST[wws3]',
				`wws4`='$_POST[wws4]',
				`wds1`='$_POST[wds1]',
				`wds2`='$_POST[wds2]',
				`wds3`='$_POST[wds3]',
				`wds4`='$_POST[wds4]',
				`pl1`='$_POST[pl1]',
				`pl2`='$_POST[pl2]',
				`pl3`='$_POST[pl3]',
				`plastic_limit`='$_POST[plastic_limit]',
				`liquide_limit`='$_POST[liquide_limit]',
				`pi_value`='$_POST[pi_value]',
				`chk_den`='$_POST[chk_den]',
				`den_volume`='$_POST[den_volume]',
				`den_lab_1`='$_POST[den_lab_1]',
				`den_lab_2`='$_POST[den_lab_2]',
				`ov_1`='$_POST[ov_1]',
				`ov_2`='$_POST[ov_2]',
				`v1`='$_POST[v1]',
				`v2`='$_POST[v2]',
				`wt1`='$_POST[wt1]',
				`wt2`='$_POST[wt2]',
				`wm1`='$_POST[wm1]',
				`wm2`='$_POST[wm2]',
				`ws1`='$_POST[ws1]',
				`ws2`='$_POST[ws2]',
				`bdl1`='$_POST[bdl1]',
				`bdl2`='$_POST[bdl2]',
				`bdc1`='$_POST[bdc1]',
				`bdc2`='$_POST[bdc2]',
				`bdl`='$_POST[bdl]',
				`bdc`='$_POST[bdc]',`sou_size1`='$_POST[sou_size1]',`sou_size2`='$_POST[sou_size2]',`wms1`='$_POST[wms1]',`wms2`='$_POST[wms2]',`wms3`='$_POST[wms3]',`wms4`='$_POST[wms4]',`wms5`='$_POST[wms5]',`wms6`='$_POST[wms6]',`checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update gsb_26_5_4_75_mm SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM gsb_26_5_4_75_mm WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update gsb_26_5_4_75_mm SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update gsb_26_5_4_75_mm SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>