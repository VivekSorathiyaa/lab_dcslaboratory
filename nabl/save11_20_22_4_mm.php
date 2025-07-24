<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from wmm_11_20_22_4_mm WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'ulr' => $result['ulr'],
			'sample_taken' => $result['sample_taken'],
			'blank_extra' => $result['blank_extra'],
			'sieve_1' => $result['sieve_1'],
			'sieve_2' => $result['sieve_2'],
			'sieve_3' => $result['sieve_3'],
			'sieve_4' => $result['sieve_4'],
			'sieve_5' => $result['sieve_5'],
			'cum_wt_gm_1' => $result['cum_wt_gm_1'],
			'cum_wt_gm_2' => $result['cum_wt_gm_2'],
			'cum_wt_gm_3' => $result['cum_wt_gm_3'],
			'cum_wt_gm_4' => $result['cum_wt_gm_4'],
			'cum_wt_gm_5' => $result['cum_wt_gm_5'],
			'ret_wt_gm_1' => $result['ret_wt_gm_1'],
			'ret_wt_gm_2' => $result['ret_wt_gm_2'],
			'ret_wt_gm_3' => $result['ret_wt_gm_3'],
			'ret_wt_gm_4' => $result['ret_wt_gm_4'],
			'ret_wt_gm_5' => $result['ret_wt_gm_5'],
			'cum_ret_1' => $result['cum_ret_1'],
			'cum_ret_2' => $result['cum_ret_2'],
			'cum_ret_3' => $result['cum_ret_3'],
			'cum_ret_4' => $result['cum_ret_4'],
			'cum_ret_5' => $result['cum_ret_5'],
			'pass_sample_1' => $result['pass_sample_1'],
			'pass_sample_2' => $result['pass_sample_2'],
			'pass_sample_3' => $result['pass_sample_3'],
			'pass_sample_4' => $result['pass_sample_4'],
			'pass_sample_5' => $result['pass_sample_5'],
			'chk_grd' => $result['chk_grd'],
			'chk_sou' => $result['chk_sou'],
			'soundness' => $result['soundness'],
			's6total' => $result['s6total'],
			's31' => $result['s31'],
			's32' => $result['s32'],
			's33' => $result['s33'],
			's34' => $result['s34'],
			's35' => $result['s35'],
			's36' => $result['s36'],
			's37' => $result['s37'],
			's38' => $result['s38'],
			's39' => $result['s39'],
			's30' => $result['s30'],
			's41' => $result['s41'],
			's42' => $result['s42'],
			's43' => $result['s43'],
			's44' => $result['s44'],
			's45' => $result['s45'],
			's46' => $result['s46'],
			's47' => $result['s47'],
			's48' => $result['s48'],
			's49' => $result['s49'],
			's40' => $result['s40'],
			's51' => $result['s51'],
			's52' => $result['s52'],
			's53' => $result['s53'],
			's54' => $result['s54'],
			's55' => $result['s55'],
			's56' => $result['s56'],
			's57' => $result['s57'],
			's58' => $result['s58'],
			's59' => $result['s59'],
			's50' => $result['s50'],
			's61' => $result['s61'],
			's62' => $result['s62'],
			's63' => $result['s63'],
			's64' => $result['s64'],
			's65' => $result['s65'],
			's66' => $result['s66'],
			's67' => $result['s67'],
			's68' => $result['s68'],
			's69' => $result['s69'],
			's60' => $result['s60'],
			'chk_sp' => $result['chk_sp'],
			'sp_specific_gravity' => $result['sp_specific_gravity'],
			'sp_specific_gravity_1' => $result['sp_specific_gravity_1'],
			'sp_specific_gravity_2' => $result['sp_specific_gravity_2'],
			'sp_water_abr_1' => $result['sp_water_abr_1'],
			'sp_water_abr_2' => $result['sp_water_abr_2'],
			'sp_water_abr' => $result['sp_water_abr'],
			'sp_w_sur_1' => $result['sp_w_sur_1'],
			'sp_w_sur_2' => $result['sp_w_sur_2'],
			'sp_wt_st_1' => $result['sp_wt_st_1'],
			'sp_wt_st_2' => $result['sp_wt_st_2'],
			'sp_w_s_1' => $result['sp_w_s_1'],
			'sp_w_s_2' => $result['sp_w_s_2'],
			'chk_abr' => $result['chk_abr'],
			'abr_index' => $result['abr_index'],
			'abr_wt_t_b_1' => $result['abr_wt_t_b_1'],
			'abr_wt_t_c_1' => $result['abr_wt_t_c_1'],
			'abr_wt_t_a_1' => $result['abr_wt_t_a_1'],
			'abr_wt_t_a_2' => $result['abr_wt_t_a_2'],
			'abr_wt_t_b_2' => $result['abr_wt_t_b_2'],
			'abr_wt_t_c_2' => $result['abr_wt_t_c_2'],
			'abr_1' => $result['abr_1'],
			'abr_2' => $result['abr_2'],
			'abr_grading' => $result['abr_grading'],
			'abr_weight_charge' => $result['abr_weight_charge'],
			'abr_num_revo' => $result['abr_num_revo'],
			'abr_sphere' => $result['abr_sphere'],
			'chk_alkali' => $result['chk_alkali'],
			'alkali_value' => $result['alkali_value'],
			'alk_1' => $result['alk_1'],
			'alk_2' => $result['alk_2'],
			'alk_3' => $result['alk_3'],
			'alk_4' => $result['alk_4'],
			'alk_5' => $result['alk_5'],
			'alk_6' => $result['alk_6'],
			'alk_7' => $result['alk_7'],
			'alk_8' => $result['alk_8'],
			'alk_9' => $result['alk_9'],
			'alk_10' => $result['alk_10'],
			'alk_11' => $result['alk_11'],
			'chk_den' => $result['chk_den'],
			'm11' => $result['m11'],
			'm12' => $result['m12'],
			'm13' => $result['m13'],
			'm21' => $result['m21'],
			'm22' => $result['m22'],
			'm23' => $result['m23'],
			'm31' => $result['m31'],
			'm32' => $result['m32'],
			'm33' => $result['m33'],
			'avg_wom' => $result['avg_wom'],
			'vol' => $result['vol'],
			'bdl' => $result['bdl'],
			'chk_crushing' => $result['chk_crushing'],
			'cr_a_1' => $result['cr_a_1'],
			'cr_a_2' => $result['cr_a_2'],
			'cr_b_1' => $result['cr_b_1'],
			'cr_b_2' => $result['cr_b_2'],
			'cru_value_1' => $result['cru_value_1'],
			'cru_value_2' => $result['cru_value_2'],
			'cru_value' => $result['cru_value'],
			'cr_sample_crush' => $result['cr_sample_crush'],
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
			'avg_f_c' => $result['avg_f_c'],
			'avg_f_d' => $result['avg_f_d'],
			'chk_flk' => $result['chk_flk'],
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
			'sumb' => $result['sumb'],
			'aa1' => $result['aa1'],
			'aa2' => $result['aa2'],
			'aa3' => $result['aa3'],
			'aa4' => $result['aa4'],
			'aa5' => $result['aa5'],
			'aa6' => $result['aa6'],
			'aa7' => $result['aa7'],
			'aa8' => $result['aa8'],
			'aa9' => $result['aa9'],
			'sumaa' => $result['sumaa'],
			'dd1' => $result['dd1'],
			'dd2' => $result['dd2'],
			'dd3' => $result['dd3'],
			'dd4' => $result['dd4'],
			'dd5' => $result['dd5'],
			'dd6' => $result['dd6'],
			'dd7' => $result['dd7'],
			'dd8' => $result['dd8'],
			'dd9' => $result['dd9'],
			'sumdd' => $result['sumdd'],
			'fi_index' => $result['fi_index'],
			'ei_index' => $result['ei_index'],
			'combined_index' => $result['combined_index'],
			'chk_ll' => $result['chk_ll'],
			'pen1' => $result['pen1'],
			'pen2' => $result['pen2'],
			'pen3' => $result['pen3'],
			'pen4' => $result['pen4'],
			'cont1' => $result['cont1'],
			'cont2' => $result['cont2'],
			'cont3' => $result['cont3'],
			'cont4' => $result['cont4'],
			'wc1' => $result['wc1'],
			'wc2' => $result['wc2'],
			'wc3' => $result['wc3'],
			'wc4' => $result['wc4'],
			'od1' => $result['od1'],
			'od2' => $result['od2'],
			'od3' => $result['od3'],
			'od4' => $result['od4'],
			'ww1' => $result['ww1'],
			'ww2' => $result['ww2'],
			'ww3' => $result['ww3'],
			'ww4' => $result['ww4'],
			'wf1' => $result['wf1'],
			'wf2' => $result['wf2'],
			'wf3' => $result['wf3'],
			'wf4' => $result['wf4'],
			'ds1' => $result['ds1'],
			'ds2' => $result['ds2'],
			'ds3' => $result['ds3'],
			'ds4' => $result['ds4'],
			'mo1' => $result['mo1'],
			'mo2' => $result['mo2'],
			'mo3' => $result['mo3'],
			'mo4' => $result['mo4'],
			'ln1' => $result['ln1'],
			'ln2' => $result['ln2'],
			'ln3' => $result['ln3'],
			'ln4' => $result['ln4'],
			'avg_ll' => $result['avg_ll'],
			'avg_pl' => $result['avg_pl'],
			'liquide_limit' => $result['liquide_limit'],
			'plastic_limit' => $result['plastic_limit'],
			'pi_value' => $result['pi_value'],
			'chk_impact' => $result['chk_impact'],
			'imp_w_m_a_1' => $result['imp_w_m_a_1'],
			'imp_w_m_a_2' => $result['imp_w_m_a_2'],
			'imp_w_m_b_1' => $result['imp_w_m_b_1'],
			'imp_w_m_b_2' => $result['imp_w_m_b_2'],
			'imp_w_m_c_1' => $result['imp_w_m_c_1'],
			'imp_w_m_c_2' => $result['imp_w_m_c_2'],
			'imp_value' => $result['imp_value'],
			'imp_value_1' => $result['imp_value_1'],
			'imp_value_2' => $result['imp_value_2'],
			'amend_date' => $result['amend_date']

		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr = $_POST['ulr'];

		$chk_grd =  $_POST['chk_grd'];
		$sample_taken =  $_POST['sample_taken'];
		$sieve_1 = $_POST['sieve_1'];
		$sieve_2 = $_POST['sieve_2'];
		$sieve_3 = $_POST['sieve_3'];
		$sieve_4 = $_POST['sieve_4'];
		$sieve_5 = $_POST['sieve_5'];
		$cum_wt_gm_1 = $_POST['cum_wt_gm_1'];
		$cum_wt_gm_2 = $_POST['cum_wt_gm_2'];
		$cum_wt_gm_3 = $_POST['cum_wt_gm_3'];
		$cum_wt_gm_4 = $_POST['cum_wt_gm_4'];
		$cum_wt_gm_5 = $_POST['cum_wt_gm_5'];
		$ret_wt_gm_1 = $_POST['ret_wt_gm_1'];
		$ret_wt_gm_2 = $_POST['ret_wt_gm_2'];
		$ret_wt_gm_3 = $_POST['ret_wt_gm_3'];
		$ret_wt_gm_4 = $_POST['ret_wt_gm_4'];
		$ret_wt_gm_5 = $_POST['ret_wt_gm_5'];
		$cum_ret_1 = $_POST['cum_ret_1'];
		$cum_ret_2 = $_POST['cum_ret_2'];
		$cum_ret_3 = $_POST['cum_ret_3'];
		$cum_ret_4 = $_POST['cum_ret_4'];
		$cum_ret_5 = $_POST['cum_ret_5'];
		$pass_sample_1 = $_POST['pass_sample_1'];
		$pass_sample_2 = $_POST['pass_sample_2'];
		$pass_sample_3 = $_POST['pass_sample_3'];
		$pass_sample_4 = $_POST['pass_sample_4'];
		$pass_sample_5 = $_POST['pass_sample_5'];
		$blank_extra = $_POST['blank_extra'];

		//soundness 
		$chk_sou = $_POST['chk_sou'];
		$s6total = $_POST['s6total'];
		$soundness = $_POST['soundness'];
		$s31 = $_POST['s31'];
		$s32 = $_POST['s32'];
		$s33 = $_POST['s33'];
		$s34 = $_POST['s34'];
		$s35 = $_POST['s35'];
		$s36 = $_POST['s36'];
		$s37 = $_POST['s37'];
		$s38 = $_POST['s38'];
		$s39 = $_POST['s39'];
		$s30 = $_POST['s30'];
		$s41 = $_POST['s41'];
		$s42 = $_POST['s42'];
		$s43 = $_POST['s43'];
		$s44 = $_POST['s44'];
		$s45 = $_POST['s45'];
		$s46 = $_POST['s46'];
		$s47 = $_POST['s47'];
		$s48 = $_POST['s48'];
		$s49 = $_POST['s49'];
		$s40 = $_POST['s40'];
		$s51 = $_POST['s51'];
		$s52 = $_POST['s52'];
		$s53 = $_POST['s53'];
		$s54 = $_POST['s54'];
		$s55 = $_POST['s55'];
		$s56 = $_POST['s56'];
		$s57 = $_POST['s57'];
		$s58 = $_POST['s58'];
		$s59 = $_POST['s59'];
		$s50 = $_POST['s50'];
		$s61 = $_POST['s61'];
		$s62 = $_POST['s62'];
		$s63 = $_POST['s63'];
		$s64 = $_POST['s64'];
		$s65 = $_POST['s65'];
		$s66 = $_POST['s66'];
		$s67 = $_POST['s67'];
		$s68 = $_POST['s68'];
		$s69 = $_POST['s69'];
		$s60 = $_POST['s60'];

		$chk_sp =  $_POST['chk_sp'];
		$sp_wt_st_1 = $_POST['sp_wt_st_1'];
		$sp_wt_st_2 = $_POST['sp_wt_st_2'];
		$sp_w_sur_2 = $_POST['sp_w_sur_2'];
		$sp_w_s_2 = $_POST['sp_w_s_2'];
		$sp_specific_gravity_1 = $_POST['sp_specific_gravity_1'];
		$sp_specific_gravity_2 = $_POST['sp_specific_gravity_2'];
		$sp_water_abr_1 = $_POST['sp_water_abr_1'];
		$sp_water_abr_2 = $_POST['sp_water_abr_2'];
		$sp_water_abr = $_POST['sp_water_abr'];
		$sp_w_sur_1 = $_POST['sp_w_sur_1'];
		$sp_w_s_1 = $_POST['sp_w_s_1'];
		$sp_specific_gravity = $_POST['sp_specific_gravity'];

		$chk_abr =  $_POST['chk_abr'];
		$abr_wt_t_a_1 = $_POST['abr_wt_t_a_1'];
		$abr_wt_t_b_1 = $_POST['abr_wt_t_b_1'];
		$abr_wt_t_c_1 = $_POST['abr_wt_t_c_1'];
		$abr_wt_t_a_2 = $_POST['abr_wt_t_a_2'];
		$abr_wt_t_b_2 = $_POST['abr_wt_t_b_2'];
		$abr_wt_t_c_2 = $_POST['abr_wt_t_c_2'];
		$abr_1 = $_POST['abr_1'];
		$abr_2 = $_POST['abr_2'];
		$abr_index = $_POST['abr_index'];
		$abr_grading = $_POST['abr_grading'];
		$abr_sphere = $_POST['abr_sphere'];
		$abr_weight_charge = $_POST['abr_weight_charge'];
		$abr_num_revo = $_POST['abr_num_revo'];

		$chk_alkali =  $_POST['chk_alkali'];
		$alk_1 =  $_POST['alk_1'];
		$alk_2 =  $_POST['alk_2'];
		$alk_3 =  $_POST['alk_3'];
		$alk_4 =  $_POST['alk_4'];
		$alk_5 =  $_POST['alk_5'];
		$alk_6 =  $_POST['alk_6'];
		$alk_7 =  $_POST['alk_7'];
		$alk_8 =  $_POST['alk_8'];
		$alk_9 =  $_POST['alk_9'];
		$alk_10 =  $_POST['alk_10'];
		$alk_11 =  $_POST['alk_11'];

		//bluk density
		$chk_den =  $_POST['chk_den'];
		$m11 =  $_POST['m11'];
		$m12 =  $_POST['m12'];
		$m13 =  $_POST['m13'];
		$m21 =  $_POST['m21'];
		$m22 =  $_POST['m22'];
		$m23 =  $_POST['m23'];
		$m31 =  $_POST['m31'];
		$m32 =  $_POST['m32'];
		$m33 =  $_POST['m33'];
		$avg_wom =  $_POST['avg_wom'];
		$vol =  $_POST['vol'];
		$bdl =  $_POST['bdl'];

		//crushing value
		$chk_crushing =  $_POST['chk_crushing'];
		$cr_a_1 =  $_POST['cr_a_1'];
		$cr_a_2 =  $_POST['cr_a_2'];
		$cr_b_1 =  $_POST['cr_b_1'];
		$cr_b_2 =  $_POST['cr_b_2'];
		$cru_value =  $_POST['cru_value'];
		$cru_value_1 =  $_POST['cru_value_1'];
		$cru_value_2 =  $_POST['cru_value_2'];

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
		$avg_f_c =  $_POST['avg_f_c'];
		$avg_f_d =  $_POST['avg_f_d'];

		$chk_flk =  $_POST['chk_flk'];
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
		$sumb = $_POST['sumb'];
		$aa1 =  $_POST['aa1'];
		$aa2 =  $_POST['aa2'];
		$aa3 =  $_POST['aa3'];
		$aa4 =  $_POST['aa4'];
		$aa5 =  $_POST['aa5'];
		$aa6 =  $_POST['aa6'];
		$aa7 =  $_POST['aa7'];
		$aa8 =  $_POST['aa8'];
		$aa9 =  $_POST['aa9'];
		$sumaa =  $_POST['sumaa'];

		$dd1 =  $_POST['dd1'];
		$dd2 =  $_POST['dd2'];
		$dd3 =  $_POST['dd3'];
		$dd4 =  $_POST['dd4'];
		$dd5 =  $_POST['dd5'];
		$dd6 =  $_POST['dd6'];
		$dd7 =  $_POST['dd7'];
		$dd8 =  $_POST['dd8'];
		$dd9 =  $_POST['dd9'];
		$sumdd =  $_POST['sumdd'];
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
		$imp_value_1 = $_POST['imp_value_1'];
		$imp_value_2 = $_POST['imp_value_2'];
		$imp_value = $_POST['imp_value'];

		$chk_ll =  $_POST['chk_ll'];
		$avg_ll =  $_POST['avg_ll'];
		$avg_pl =  $_POST['avg_pl'];
		$pen1 =  $_POST['pen1'];
		$pen2 =  $_POST['pen2'];
		$pen3 =  $_POST['pen3'];
		$pen4 =  $_POST['pen4'];
		$cont1 =  $_POST['cont1'];
		$cont2 =  $_POST['cont2'];
		$cont3 =  $_POST['cont3'];
		$cont4 =  $_POST['cont4'];
		$wc1 =  $_POST['wc1'];
		$wc2 =  $_POST['wc2'];
		$wc3 =  $_POST['wc3'];
		$wc4 =  $_POST['wc4'];
		$od1 =  $_POST['od1'];
		$od2 =  $_POST['od2'];
		$od3 =  $_POST['od3'];
		$od4 =  $_POST['od4'];
		$ww1 =  $_POST['ww1'];
		$ww2 =  $_POST['ww2'];
		$ww3 =  $_POST['ww3'];
		$ww4 =  $_POST['ww4'];
		$wf1 =  $_POST['wf1'];
		$wf2 =  $_POST['wf2'];
		$wf3 =  $_POST['wf3'];
		$wf4 =  $_POST['wf4'];
		$ds1 =  $_POST['ds1'];
		$ds2 =  $_POST['ds2'];
		$ds3 =  $_POST['ds3'];
		$ds4 =  $_POST['ds4'];
		$mo1 =  $_POST['mo1'];
		$mo2 =  $_POST['mo2'];
		$mo3 =  $_POST['mo3'];
		$mo4 =  $_POST['ln4'];
		$ln1 =  $_POST['ln1'];
		$ln2 =  $_POST['ln2'];
		$ln3 =  $_POST['ln3'];
		$ln4 =  $_POST['ln4'];
		$liquide_limit =  $_POST['liquide_limit'];
		$plastic_limit =  $_POST['plastic_limit'];
		$pi_value =  $_POST['pi_value'];
		$amend_date =  $_POST['amend_date'];

		$curr_date = date("Y-m-d");

		$insert = "INSERT INTO `wmm_11_20_22_4_mm`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_grd`, `sieve_1`, `sieve_2`, `sieve_3`, `sieve_4`, `sieve_5`, `cum_wt_gm_1`, `cum_wt_gm_2`, `cum_wt_gm_3`, `cum_wt_gm_4`, `cum_wt_gm_5`, `ret_wt_gm_1`, `ret_wt_gm_2`, `ret_wt_gm_3`, `ret_wt_gm_4`, `ret_wt_gm_5`, `cum_ret_1`, `cum_ret_2`, `cum_ret_3`, `cum_ret_4`, `cum_ret_5`, `pass_sample_1`, `pass_sample_2`, `pass_sample_3`, `pass_sample_4`, `pass_sample_5`, `blank_extra`, `sample_taken`, `chk_sp`, `sp_wt_st_1`, `sp_wt_st_2`, `sp_w_sur_1`, `sp_w_sur_2`, `sp_w_s_1`, `sp_w_s_2`, `sp_specific_gravity_1`, `sp_specific_gravity_2`, `sp_specific_gravity`, `sp_water_abr_1`, `sp_water_abr_2`, `sp_water_abr`, `chk_den`, `m11`, `m12`, `m13`, `m21`, `m22`, `m23`, `m31`, `m32`, `m33`, `avg_wom`, `vol`, `bdl`, `chk_impact`, `imp_w_m_a_1`, `imp_w_m_a_2`, `imp_w_m_b_1`, `imp_w_m_b_2`, `imp_w_m_c_1`, `imp_w_m_c_2`, `imp_value_1`, `imp_value_2`, `imp_value`, `chk_abr`, `abr_wt_t_a_1`, `abr_wt_t_a_2`, `abr_wt_t_b_1`, `abr_wt_t_b_2`, `abr_wt_t_c_1`, `abr_wt_t_c_2`, `abr_1`, `abr_2`, `abr_index`, `abr_grading`, `abr_weight_charge`, `abr_num_revo`, `abr_sphere`, `chk_crushing`, `cr_a_1`, `cr_a_2`, `cr_b_1`, `cr_b_2`, `cru_value_1`, `cru_value_2`, `cru_value`, `chk_flk`, `s11`, `s12`, `s13`, `s14`, `s15`, `s16`, `s17`, `s18`, `s19`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `suma`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `sumb`, `aa1`, `aa2`, `aa3`, `aa4`, `aa5`, `aa6`, `aa7`, `aa8`, `aa9`, `sumaa`, `dd1`, `dd2`, `dd3`, `dd4`, `dd5`, `dd6`, `dd7`, `dd8`, `dd9`, `sumdd`, `fi_index`, `ei_index`, `combined_index`, `chk_sou`, `s31`, `s32`, `s33`, `s34`, `s35`, `s36`, `s37`, `s38`, `s39`, `s30`, `s41`, `s42`, `s43`, `s44`, `s45`, `s46`, `s47`, `s48`, `s49`, `s40`, `s51`, `s52`, `s53`, `s54`, `s55`, `s56`, `s57`, `s58`, `s59`, `s50`, `s61`, `s62`, `s63`, `s64`, `s65`, `s66`, `s67`, `s68`, `s69`, `s60`, `s6total`, `soundness`, `chk_fines`, `f_a_1`, `f_a_2`, `f_c_1`, `f_c_2`, `f_d_1`, `f_d_2`, `f_b_1`, `f_b_2`, `avg_f_d`, `avg_f_c`, `fines_value`, `chk_alkali`, `alk_1`, `alk_2`, `alk_3`, `alk_4`, `alk_5`, `alk_6`, `alk_7`, `alk_8`, `alk_9`, `alk_10`, `alk_11`, `chk_ll`, `pen1`, `pen2`, `pen3`, `pen4`, `cont1`, `cont2`, `cont3`, `cont4`, `wc1`, `wc2`, `wc3`, `wc4`, `od1`, `od2`, `od3`, `od4`, `ww1`, `ww2`, `ww3`, `ww4`, `wf1`, `wf2`, `wf3`, `wf4`, `ds1`, `ds2`, `ds3`, `ds4`, `mo1`, `mo2`, `mo3`, `mo4`, `ln1`, `ln2`, `ln3`, `ln4`, `avg_ll`, `avg_pl`, `liquide_limit`, `plastic_limit`, `pi_value`,`amend_date`) VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$chk_grd','$sieve_1','$sieve_2','$sieve_3','$sieve_4','$sieve_5','$cum_wt_gm_1','$cum_wt_gm_2','$cum_wt_gm_3','$cum_wt_gm_4','$cum_wt_gm_5','$ret_wt_gm_1','$ret_wt_gm_2','$ret_wt_gm_3','$ret_wt_gm_4','$ret_wt_gm_5','$cum_ret_1','$cum_ret_2','$cum_ret_3','$cum_ret_4','$cum_ret_5','$pass_sample_1','$pass_sample_2','$pass_sample_3','$pass_sample_4','$pass_sample_5','$blank_extra','$sample_taken','$chk_sp','$sp_wt_st_1','$sp_wt_st_2','$sp_w_sur_1','$sp_w_sur_2','$sp_w_s_1','$sp_w_s_2','$sp_specific_gravity_1','$sp_specific_gravity_2','$sp_specific_gravity','$sp_water_abr_1','$sp_water_abr_2','$sp_water_abr','$chk_den','$m11','$m12','$m13','$m21','$m22','$m23','$m31','$m32','$m33','$avg_wom','$vol','$bdl','$chk_impact','$imp_w_m_a_1','$imp_w_m_a_2','$imp_w_m_b_1','$imp_w_m_b_2','$imp_w_m_c_1','$imp_w_m_c_2','$imp_value_1','$imp_value_2','$imp_value','$chk_abr','$abr_wt_t_a_1','$abr_wt_t_a_2','$abr_wt_t_b_1','$abr_wt_t_b_2','$abr_wt_t_c_1','$abr_wt_t_c_2','$abr_1','$abr_2','$abr_index','$abr_grading','$abr_weight_charge','$abr_num_revo','$abr_sphere','$chk_crushing','$cr_a_1','$cr_a_2','$cr_b_1','$cr_b_2','$cru_value_1','$cru_value_2','$cru_value','$chk_flk','$s11','$s12','$s13','$s14','$s15','$s16','$s17','$s18','$s19','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$suma','$b1','$b2','$b3','$b4','$b5','$b6','$b7','$b8','$b9','$sumb','$aa1','$aa2','$aa3','$aa4','$aa5','$aa6','$aa7','$aa8','$aa9','$sumaa','$dd1','$dd2','$dd3','$dd4','$dd5','$dd6','$dd7','$dd8','$dd9','$sumdd','$fi_index','$ei_index','$combined_index','$chk_sou','$s31','$s32','$s33','$s34','$s35','$s36','$s37','$s38','$s39','$s30','$s41','$s42','$s43','$s44','$s45','$s46','$s47','$s48','$s49','$s40','$s51','$s52','$s53','$s54','$s55','$s56','$s57','$s58','$s59','$s50','$s61','$s62','$s63','$s64','$s65','$s66','$s67','$s68','$s69','$s60','$s6total','$soundness','$chk_fines','$f_a_1','$f_a_2','$f_c_1','$f_c_2','$f_d_1','$f_d_2','$f_b_1','$f_b_2','$avg_f_d','$avg_f_c','$fines_value','$chk_alkali','$alk_1','$alk_2','$alk_3','$alk_4','$alk_5','$alk_6','$alk_7','$alk_8','$alk_9','$alk_10','$alk_11','$chk_ll','$pen1','$pen2','$pen3','$pen4','$cont1','$cont2','$cont3','$cont4','$wc1','$wc2','$wc3','$wc4','$od1','$od2','$od3','$od4','$ww1','$ww2','$ww3','$ww4','$wf1','$wf2','$wf3','$wf4','$ds1','$ds2','$ds3','$ds4','$mo1','$mo2','$mo3','$mo4','$ln1','$ln2','$ln3','$ln4','$avg_ll','$avg_pl','$liquide_limit','$plastic_limit','$pi_value','$amend_date')";




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
						$query = "select * from wmm_11_20_22_4_mm WHERE lab_no='$lab_no' and `is_deleted`='0'";

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


		$update = "update `wmm_11_20_22_4_mm` SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
		`ulr`='$_POST[ulr]',
		`chk_grd`='$_POST[chk_grd]',
      `sieve_1`='$_POST[sieve_1]',
      `sieve_2`='$_POST[sieve_2]',
      `sieve_3`='$_POST[sieve_3]',
      `sieve_4`='$_POST[sieve_4]',
      `sieve_5`='$_POST[sieve_5]',
      `cum_wt_gm_1`='$_POST[cum_wt_gm_1]',
      `cum_wt_gm_2`='$_POST[cum_wt_gm_2]',
      `cum_wt_gm_3`='$_POST[cum_wt_gm_3]',
      `cum_wt_gm_4`='$_POST[cum_wt_gm_4]',
      `cum_wt_gm_5`='$_POST[cum_wt_gm_5]',
      `ret_wt_gm_1`='$_POST[ret_wt_gm_1]',
      `ret_wt_gm_2`='$_POST[ret_wt_gm_2]',
      `ret_wt_gm_3`='$_POST[ret_wt_gm_3]',
      `ret_wt_gm_4`='$_POST[ret_wt_gm_4]',
      `ret_wt_gm_5`='$_POST[ret_wt_gm_5]',
      `cum_ret_1`='$_POST[cum_ret_1]',
      `cum_ret_2`='$_POST[cum_ret_2]',
      `cum_ret_3`='$_POST[cum_ret_3]',
      `cum_ret_4`='$_POST[cum_ret_4]',
      `cum_ret_5`='$_POST[cum_ret_5]',
      `pass_sample_1`='$_POST[pass_sample_1]',
      `pass_sample_2`='$_POST[pass_sample_2]',
      `pass_sample_3`='$_POST[pass_sample_3]',
      `pass_sample_4`='$_POST[pass_sample_4]',
      `pass_sample_5`='$_POST[pass_sample_5]',
      `blank_extra`='$_POST[blank_extra]',
      `sample_taken`='$_POST[sample_taken]',
      `blank_extra`='$_POST[blank_extra]',`sample_taken`='$_POST[sample_taken]',`chk_sp`='$_POST[chk_sp]',`sp_wt_st_1`='$_POST[sp_wt_st_1]',`sp_wt_st_2`='$_POST[sp_wt_st_2]',`sp_w_sur_1`='$_POST[sp_w_sur_1]',`sp_w_sur_2`='$_POST[sp_w_sur_2]',`sp_w_s_1`='$_POST[sp_w_s_1]',`sp_w_s_2`='$_POST[sp_w_s_2]',`sp_specific_gravity_1`='$_POST[sp_specific_gravity_1]',`sp_specific_gravity_2`='$_POST[sp_specific_gravity_2]',`sp_specific_gravity`='$_POST[sp_specific_gravity]',`sp_water_abr_1`='$_POST[sp_water_abr_1]',`sp_water_abr_2`='$_POST[sp_water_abr_2]',`sp_water_abr`='$_POST[sp_water_abr]',`chk_den`='$_POST[chk_den]',`m11`='$_POST[m11]',`m12`='$_POST[m12]',`m13`='$_POST[m13]',`m21`='$_POST[m21]',`m22`='$_POST[m22]',`m23`='$_POST[m23]',`m31`='$_POST[m31]',`m32`='$_POST[m32]',`m33`='$_POST[m33]',`avg_wom`='$_POST[avg_wom]',`vol`='$_POST[vol]',`bdl`='$_POST[bdl]',`chk_impact`='$_POST[chk_impact]',`imp_w_m_a_1`='$_POST[imp_w_m_a_1]',`imp_w_m_a_2`='$_POST[imp_w_m_a_2]',`imp_w_m_b_1`='$_POST[imp_w_m_b_1]',`imp_w_m_b_2`='$_POST[imp_w_m_b_2]',`imp_w_m_c_1`='$_POST[imp_w_m_c_1]',`imp_w_m_c_2`='$_POST[imp_w_m_c_2]',`imp_value_1`='$_POST[imp_value_1]',`imp_value_2`='$_POST[imp_value_2]',`imp_value`='$_POST[imp_value]',`chk_abr`='$_POST[chk_abr]',`abr_wt_t_a_1`='$_POST[abr_wt_t_a_1]',`abr_wt_t_b_1`='$_POST[abr_wt_t_b_1]',`abr_wt_t_c_1`='$_POST[abr_wt_t_c_1]',`abr_wt_t_a_2`='$_POST[abr_wt_t_a_2]',`abr_wt_t_b_2`='$_POST[abr_wt_t_b_2]',`abr_wt_t_c_2`='$_POST[abr_wt_t_c_2]',`abr_1`='$_POST[abr_1]',`abr_2`='$_POST[abr_2]',`abr_index`='$_POST[abr_index]',`abr_grading`='$_POST[abr_grading]',`abr_weight_charge`='$_POST[abr_weight_charge]',`abr_sphere`='$_POST[abr_sphere]',`abr_num_revo`='$_POST[abr_num_revo]',`chk_crushing`='$_POST[chk_crushing]',`cru_value`='$_POST[cru_value]',`cr_a_1`='$_POST[cr_a_1]',`cr_a_2`='$_POST[cr_a_2]',`cr_b_1`='$_POST[cr_b_1]',`cr_b_2`='$_POST[cr_b_2]',`cru_value_1`='$_POST[cru_value_1]',`cru_value_2`='$_POST[cru_value_2]',`chk_flk`='$_POST[chk_flk]',`a1`='$_POST[a1]',`a2`='$_POST[a2]',`a3`='$_POST[a3]',`a4`='$_POST[a4]',`a5`='$_POST[a5]',`a6`='$_POST[a6]',`a7`='$_POST[a7]',`a8`='$_POST[a8]',`a9`='$_POST[a9]',`suma`='$_POST[suma]',`b1`='$_POST[b1]',`b2`='$_POST[b2]',`b3`='$_POST[b3]',`b4`='$_POST[b4]',`b5`='$_POST[b5]',`b6`='$_POST[b6]',`b7`='$_POST[b7]',`b8`='$_POST[b8]',`b9`='$_POST[b9]',`sumb`='$_POST[sumb]',`fi_index`='$_POST[fi_index]',`aa1`='$_POST[aa1]',`aa2`='$_POST[aa2]',`aa3`='$_POST[aa3]',`aa4`='$_POST[aa4]',`aa5`='$_POST[aa5]',`aa6`='$_POST[aa6]',`aa7`='$_POST[aa7]',`aa8`='$_POST[aa8]',`aa9`='$_POST[aa9]',`sumaa`='$_POST[sumaa]',`dd1`='$_POST[dd1]',`dd2`='$_POST[dd2]',`dd3`='$_POST[dd3]',`dd4`='$_POST[dd4]',`dd5`='$_POST[dd5]',`dd6`='$_POST[dd6]',`dd7`='$_POST[dd7]',`dd8`='$_POST[dd8]',`dd9`='$_POST[dd9]',`sumdd`='$_POST[sumdd]',`ei_index`='$_POST[ei_index]',`combined_index`='$_POST[combined_index]',`s11`='$_POST[s11]',`s12`='$_POST[s12]',`s13`='$_POST[s13]',`s14`='$_POST[s14]',`s15`='$_POST[s15]',`s16`='$_POST[s16]',`s17`='$_POST[s17]',`s18`='$_POST[s18]',`s19`='$_POST[s19]',`chk_sou`='$_POST[chk_sou]',`soundness`='$_POST[soundness]',`s6total`='$_POST[s6total]',`s31`='$_POST[s31]',`s32`='$_POST[s32]',`s33`='$_POST[s33]',`s34`='$_POST[s34]',`s35`='$_POST[s35]',`s36`='$_POST[s36]',`s37`='$_POST[s37]',`s38`='$_POST[s38]',`s39`='$_POST[s39]',`s30`='$_POST[s30]',`s41`='$_POST[s41]',`s42`='$_POST[s42]',`s43`='$_POST[s43]',`s44`='$_POST[s44]',`s45`='$_POST[s45]',`s46`='$_POST[s46]',`s47`='$_POST[s47]',`s48`='$_POST[s48]',`s49`='$_POST[s49]',`s40`='$_POST[s40]',`s51`='$_POST[s51]',`s52`='$_POST[s52]',`s53`='$_POST[s53]',`s54`='$_POST[s54]',`s55`='$_POST[s55]',`s56`='$_POST[s56]',`s57`='$_POST[s57]',`s58`='$_POST[s58]',`s59`='$_POST[s59]',`s50`='$_POST[s50]',`s61`='$_POST[s61]',`s62`='$_POST[s62]',`s63`='$_POST[s63]',`s64`='$_POST[s64]',`s65`='$_POST[s65]',`s66`='$_POST[s66]',`s67`='$_POST[s67]',`s68`='$_POST[s68]',`s69`='$_POST[s69]',`s60`='$_POST[s60]',`chk_fines`='$_POST[chk_fines]',`fines_value`='$_POST[fines_value]',`f_a_1`='$_POST[f_a_1]',`f_a_2`='$_POST[f_a_2]',`f_b_1`='$_POST[f_b_1]',`f_b_2`='$_POST[f_b_2]',`f_c_1`='$_POST[f_c_1]',`f_c_2`='$_POST[f_c_2]',`f_d_1`='$_POST[f_d_1]',`f_d_1`='$_POST[f_d_1]',`avg_f_c`='$_POST[avg_f_c]',`avg_f_d`='$_POST[avg_f_d]',`chk_alkali`='$_POST[chk_alkali]',`alk_1`='$_POST[alk_1]',`alk_2`='$_POST[alk_2]',`alk_3`='$_POST[alk_3]',`alk_4`='$_POST[alk_4]',`alk_5`='$_POST[alk_5]',`alk_6`='$_POST[alk_6]',`alk_7`='$_POST[alk_7]',`alk_8`='$_POST[alk_8]',`alk_9`='$_POST[alk_9]',`alk_10`='$_POST[alk_10]',`alk_11`='$_POST[alk_11]',`chk_ll`='$_POST[chk_ll]',`pen1`='$_POST[pen1]',`pen2`='$_POST[pen2]',`pen3`='$_POST[pen3]',`pen4`='$_POST[pen4]',`cont1`='$_POST[cont1]',`cont2`='$_POST[cont2]',`cont3`='$_POST[cont3]',`cont4`='$_POST[cont4]',`wc1`='$_POST[wc1]',`wc2`='$_POST[wc2]',`wc3`='$_POST[wc3]',`wc4`='$_POST[wc4]',`od1`='$_POST[od1]',`od2`='$_POST[od2]',`od3`='$_POST[od3]',`od4`='$_POST[od4]',`ww1`='$_POST[ww1]',`ww2`='$_POST[ww2]',`ww3`='$_POST[ww3]',`ww4`='$_POST[ww4]',`ds1`='$_POST[ds1]',`ds2`='$_POST[ds2]',`ds3`='$_POST[ds3]',`ds4`='$_POST[ds4]',`mo1`='$_POST[mo1]',`mo2`='$_POST[mo2]',`mo3`='$_POST[mo3]',`mo4`='$_POST[mo4]',`ln1`='$_POST[ln1]',`ln2`='$_POST[ln2]',`ln3`='$_POST[ln3]',`ln4`='$_POST[ln4]',`avg_ll`='$_POST[avg_ll]',`avg_pl`='$_POST[avg_pl]',`plastic_limit`='$_POST[plastic_limit]',`liquide_limit`='$_POST[liquide_limit]',
	  `pi_value`='$_POST[pi_value]',
	  `amend_date`='$_POST[amend_date]',
	  `checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);
		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update wmm_11_20_22_4_mm SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM wmm_11_20_22_4_mm WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update wmm_11_20_22_4_mm SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $cc);
			} else {
				$cc = "update wmm_11_20_22_4_mm SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>