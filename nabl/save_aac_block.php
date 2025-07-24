<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from aac_block WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'amend_date' => $result['amend_date'],
			'in_l' => $result['in_l'],
			'in_w' => $result['in_w'],
			'in_h' => $result['in_h'],
			'in_grade' => $result['in_grade'],
			'in_den' => $result['in_den'],
			'chk_com' => $result['chk_com'],
			'avg_com' => $result['avg_com'],
			'sample_1' => $result['sample_1'],
			'sample_2' => $result['sample_2'],
			'sample_3' => $result['sample_3'],
			'sample_4' => $result['sample_4'],
			'sample_5' => $result['sample_5'],
			'sample_6' => $result['sample_6'],
			'sample_7' => $result['sample_7'],
			'sample_8' => $result['sample_8'],
			'sample_9' => $result['sample_9'],
			'sample_10' => $result['sample_10'],
			'sample_11' => $result['sample_11'],
			'sample_12' => $result['sample_12'],
			'l_1' => $result['l_1'],
			'l_2' => $result['l_2'],
			'l_3' => $result['l_3'],
			'l_4' => $result['l_4'],
			'l_5' => $result['l_5'],
			'l_6' => $result['l_6'],
			'l_7' => $result['l_7'],
			'l_8' => $result['l_8'],
			'l_9' => $result['l_9'],
			'l_10' => $result['l_10'],
			'l_11' => $result['l_11'],
			'l_12' => $result['l_12'],
			'w_1' => $result['w_1'],
			'w_2' => $result['w_2'],
			'w_3' => $result['w_3'],
			'w_4' => $result['w_4'],
			'w_5' => $result['w_5'],
			'w_6' => $result['w_6'],
			'w_7' => $result['w_7'],
			'w_8' => $result['w_8'],
			'w_9' => $result['w_9'],
			'w_10' => $result['w_10'],
			'w_11' => $result['w_11'],
			'w_12' => $result['w_12'],
			'h_1' => $result['h_1'],
			'h_2' => $result['h_2'],
			'h_3' => $result['h_3'],
			'h_4' => $result['h_4'],
			'h_5' => $result['h_5'],
			'h_6' => $result['h_6'],
			'h_7' => $result['h_7'],
			'h_8' => $result['h_8'],
			'h_9' => $result['h_9'],
			'h_10' => $result['h_10'],
			'h_11' => $result['h_11'],
			'h_12' => $result['h_12'],
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
			'mc_1' => $result['mc_1'],
			'mc_2' => $result['mc_2'],
			'mc_3' => $result['mc_3'],
			'mc_4' => $result['mc_4'],
			'mc_5' => $result['mc_5'],
			'mc_6' => $result['mc_6'],
			'mc_7' => $result['mc_7'],
			'mc_8' => $result['mc_8'],
			'mc_9' => $result['mc_9'],
			'mc_10' => $result['mc_10'],
			'mc_11' => $result['mc_11'],
			'mc_12' => $result['mc_12'],
			'w1_1' => $result['w1_1'],
			'w1_2' => $result['w1_2'],
			'w1_3' => $result['w1_3'],
			'w1_4' => $result['w1_4'],
			'w1_5' => $result['w1_5'],
			'w1_6' => $result['w1_6'],
			'w1_7' => $result['w1_7'],
			'w1_8' => $result['w1_8'],
			'w1_9' => $result['w1_9'],
			'w1_10' => $result['w1_10'],
			'w1_11' => $result['w1_11'],
			'w1_12' => $result['w1_12'],
			'chk_dim' => $result['chk_dim'],
			'dim_length' => $result['dim_length'],
			'dim_width' => $result['dim_width'],
			'dim_height' => $result['dim_height'],
			'dim_l1' => $result['dim_l1'],
			'dim_l2' => $result['dim_l2'],
			'dim_l3' => $result['dim_l3'],
			'dim_l4' => $result['dim_l4'],
			'dim_l5' => $result['dim_l5'],
			'dim_l6' => $result['dim_l6'],
			'dim_l7' => $result['dim_l7'],
			'dim_l8' => $result['dim_l8'],
			'dim_l9' => $result['dim_l9'],
			'dim_l10' => $result['dim_l10'],
			'dim_l11' => $result['dim_l11'],
			'dim_l12' => $result['dim_l12'],
			'dim_l13' => $result['dim_l13'],
			'dim_l14' => $result['dim_l14'],
			'dim_l15' => $result['dim_l15'],
			'dim_l16' => $result['dim_l16'],
			'dim_l17' => $result['dim_l17'],
			'dim_l18' => $result['dim_l18'],
			'dim_l19' => $result['dim_l19'],
			'dim_l20' => $result['dim_l20'],
			'dim_l21' => $result['dim_l21'],
			'dim_l22' => $result['dim_l22'],
			'dim_l23' => $result['dim_l23'],
			'dim_l24' => $result['dim_l24'],
			'dim_h1' => $result['dim_h1'],
			'dim_h2' => $result['dim_h2'],
			'dim_h3' => $result['dim_h3'],
			'dim_h4' => $result['dim_h4'],
			'dim_h5' => $result['dim_h5'],
			'dim_h6' => $result['dim_h6'],
			'dim_h7' => $result['dim_h7'],
			'dim_h8' => $result['dim_h8'],
			'dim_h9' => $result['dim_h9'],
			'dim_h10' => $result['dim_h10'],
			'dim_h11' => $result['dim_h11'],
			'dim_h12' => $result['dim_h12'],
			'dim_h13' => $result['dim_h13'],
			'dim_h14' => $result['dim_h14'],
			'dim_h15' => $result['dim_h15'],
			'dim_h16' => $result['dim_h16'],
			'dim_h17' => $result['dim_h17'],
			'dim_h18' => $result['dim_h18'],
			'dim_h19' => $result['dim_h19'],
			'dim_h20' => $result['dim_h20'],
			'dim_h21' => $result['dim_h21'],
			'dim_h22' => $result['dim_h22'],
			'dim_h23' => $result['dim_h23'],
			'dim_h24' => $result['dim_h24'],
			'dim_w1' => $result['dim_w1'],
			'dim_w2' => $result['dim_w2'],
			'dim_w3' => $result['dim_w3'],
			'dim_w4' => $result['dim_w4'],
			'dim_w5' => $result['dim_w5'],
			'dim_w6' => $result['dim_w6'],
			'dim_w7' => $result['dim_w7'],
			'dim_w8' => $result['dim_w8'],
			'dim_w9' => $result['dim_w9'],
			'dim_w10' => $result['dim_w10'],
			'dim_w11' => $result['dim_w11'],
			'dim_w12' => $result['dim_w12'],
			'dim_w13' => $result['dim_w13'],
			'dim_w14' => $result['dim_w14'],
			'dim_w15' => $result['dim_w15'],
			'dim_w16' => $result['dim_w16'],
			'dim_w17' => $result['dim_w17'],
			'dim_w18' => $result['dim_w18'],
			'dim_w19' => $result['dim_w19'],
			'dim_w20' => $result['dim_w20'],
			'dim_w21' => $result['dim_w21'],
			'dim_w22' => $result['dim_w22'],
			'dim_w23' => $result['dim_w23'],
			'dim_w24' => $result['dim_w24'],
			'dim_block1' => $result['dim_block1'],
			'dim_block2' => $result['dim_block2'],
			'dim_block3' => $result['dim_block3'],
			'dim_block4' => $result['dim_block4'],
			'dim_block5' => $result['dim_block5'],
			'dim_block6' => $result['dim_block6'],
			'dim_block7' => $result['dim_block7'],
			'dim_block8' => $result['dim_block8'],
			'dim_block9' => $result['dim_block9'],
			'dim_block10' => $result['dim_block10'],
			'dim_block11' => $result['dim_block11'],
			'dim_block12' => $result['dim_block12'],
			'dim_block13' => $result['dim_block13'],
			'dim_block14' => $result['dim_block14'],
			'dim_block15' => $result['dim_block15'],
			'dim_block16' => $result['dim_block16'],
			'dim_block17' => $result['dim_block17'],
			'dim_block18' => $result['dim_block18'],
			'dim_block19' => $result['dim_block19'],
			'dim_block20' => $result['dim_block20'],
			'dim_block21' => $result['dim_block21'],
			'dim_block22' => $result['dim_block22'],
			'dim_block23' => $result['dim_block23'],
			'dim_block24' => $result['dim_block24'],
			'chk_den' => $result['chk_den'],
			'dl_1' => $result['dl_1'],
			'dl_2' => $result['dl_2'],
			'dl_3' => $result['dl_3'],
			'dw_1' => $result['dw_1'],
			'dw_2' => $result['dw_2'],
			'dw_3' => $result['dw_3'],
			'dh_1' => $result['dh_1'],
			'dh_2' => $result['dh_2'],
			'dh_3' => $result['dh_3'],
			'vol_1' => $result['vol_1'],
			'vol_2' => $result['vol_2'],
			'vol_3' => $result['vol_3'],
			'weight_1' => $result['weight_1'],
			'weight_2' => $result['weight_2'],
			'weight_3' => $result['weight_3'],
			'den_1' => $result['den_1'],
			'den_2' => $result['den_2'],
			'den_3' => $result['den_3'],
			'wa_1' => $result['wa_1'],
			'wa_2' => $result['wa_2'],
			'wa_3' => $result['wa_3'],
			'w1' => $result['w1'],
			'w2' => $result['w2'],
			'w3' => $result['w3'],
			'mc' => $result['mc'],
			'bdl' => $result['bdl'],
			'bdl_kg' => $result['bdl_kg'],
			'chk_shr' => $result['chk_shr'],
			'con_1' => $result['con_1'],
			'con_2' => $result['con_2'],
			'con_3' => $result['con_3'],
			'fr_1' => $result['fr_1'],
			'fr_2' => $result['fr_2'],
			'fr_3' => $result['fr_3'],
			'fi_1' => $result['fi_1'],
			'fi_2' => $result['fi_2'],
			'fi_3' => $result['fi_3'],
			'ds_1' => $result['ds_1'],
			'ds_2' => $result['ds_2'],
			'ds_3' => $result['ds_3'],
			'con_wid_1' => $result['con_wid_1'],
			'con_wid_2' => $result['con_wid_2'],
			'con_wid_3' => $result['con_wid_3'],
			'con_thi_1' => $result['con_thi_1'],
			'con_thi_2' => $result['con_thi_2'],
			'con_thi_3' => $result['con_thi_3'],
			'avg_shrink' => $result['avg_shrink'],
			'chk_thr' => $result['chk_thr'],
			'tl_1' => $result['tl_1'],							
			'tl_2' => $result['tl_2'],							
			'tl_3' => $result['tl_3'],
			'tw_1' => $result['tw_1'],							
			'tw_2' => $result['tw_2'],							
			'tw_3' => $result['tw_3'],
			'th_1' => $result['th_1'],							
			'th_2' => $result['th_2'],							
			'th_3' => $result['th_3'],
			'tarea_1' => $result['tarea_1'],							
			'tarea_2' => $result['tarea_2'],							
			'tarea_3' => $result['tarea_3'],
			'tvolt_1' => $result['tvolt_1'],							
			'tvolt_2' => $result['tvolt_2'],							
			'tvolt_3' => $result['tvolt_3'],
			'tf_1_1' => $result['tf_1_1'],							
			'tf_1_2' => $result['tf_1_2'],							
			'tf_1_3' => $result['tf_1_3'],
			'tf_2_1' => $result['tf_2_1'],							
			'tf_2_2' => $result['tf_2_2'],							
			'tf_2_3' => $result['tf_2_3'],
			'tf_3_1' => $result['tf_3_1'],							
			'tf_3_2' => $result['tf_3_2'],							
			'tf_3_3' => $result['tf_3_3'],
			'tf_avg_1' => $result['tf_avg_1'],							
			'tf_avg_2' => $result['tf_avg_2'],							
			'tf_avg_3' => $result['tf_avg_3'],
			'tc_1_1' => $result['tc_1_1'],							
			'tc_1_2' => $result['tc_1_2'],							
			'tc_1_3' => $result['tc_1_3'],
			'tc_2_1' => $result['tc_2_1'],							
			'tc_2_2' => $result['tc_2_2'],							
			'tc_2_3' => $result['tc_2_3'],
			'tc_3_1' => $result['tc_3_1'],							
			'tc_3_2' => $result['tc_3_2'],							
			'tc_3_3' => $result['tc_3_3'],
			'tc_avg_1' => $result['tc_avg_1'],							
			'tc_avg_2' => $result['tc_avg_2'],							
			'tc_avg_3' => $result['tc_avg_3'],
			'thr_1' => $result['thr_1'],							
			'thr_2' => $result['thr_2'],							
			'thr_3' => $result['thr_3'],
			'avg_thr' => $result['avg_thr'],
			'the_s_d' => date('d/m/Y', strtotime($result['the_s_d'])),	
			'the_e_d' => date('d/m/Y', strtotime($result['the_e_d']))


		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr = $_POST['ulr'];
		$amend_date = $_POST['amend_date'];

		$in_l = $_POST['in_l'];
		$in_w = $_POST['in_w'];
		$in_h = $_POST['in_h'];
		$in_grade = $_POST['in_grade'];
		$in_den = $_POST['in_den'];
		$chk_com = $_POST['chk_com'];
		$avg_com = $_POST['avg_com'];
		$sample_1 = $_POST['sample_1'];
		$sample_2 = $_POST['sample_2'];
		$sample_3 = $_POST['sample_3'];
		$sample_4 = $_POST['sample_4'];
		$sample_5 = $_POST['sample_5'];
		$sample_6 = $_POST['sample_6'];
		$sample_7 = $_POST['sample_7'];
		$sample_8 = $_POST['sample_8'];
		$sample_9 = $_POST['sample_9'];
		$sample_10 = $_POST['sample_10'];
		$sample_11 = $_POST['sample_11'];
		$sample_12 = $_POST['sample_12'];

		$l_1 = $_POST['l_1'];
		$l_2 = $_POST['l_2'];
		$l_3 = $_POST['l_3'];
		$l_4 = $_POST['l_4'];
		$l_5 = $_POST['l_5'];
		$l_6 = $_POST['l_6'];
		$l_7 = $_POST['l_7'];
		$l_8 = $_POST['l_8'];
		$l_9 = $_POST['l_9'];
		$l_10 = $_POST['l_10'];
		$l_11 = $_POST['l_11'];
		$l_12 = $_POST['l_12'];

		$w_1 = $_POST['w_1'];
		$w_2 = $_POST['w_2'];
		$w_3 = $_POST['w_3'];
		$w_4 = $_POST['w_4'];
		$w_5 = $_POST['w_5'];
		$w_6 = $_POST['w_6'];
		$w_7 = $_POST['w_7'];
		$w_8 = $_POST['w_8'];
		$w_9 = $_POST['w_9'];
		$w_10 = $_POST['w_10'];
		$w_11 = $_POST['w_11'];
		$w_12 = $_POST['w_12'];

		$h_1 = $_POST['h_1'];
		$h_2 = $_POST['h_2'];
		$h_3 = $_POST['h_3'];
		$h_4 = $_POST['h_4'];
		$h_5 = $_POST['h_5'];
		$h_6 = $_POST['h_6'];
		$h_7 = $_POST['h_7'];
		$h_8 = $_POST['h_8'];
		$h_9 = $_POST['h_9'];
		$h_10 = $_POST['h_10'];
		$h_11 = $_POST['h_11'];
		$h_12 = $_POST['h_12'];

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

		$mc_1 = $_POST['mc_1'];
		$mc_2 = $_POST['mc_2'];
		$mc_3 = $_POST['mc_3'];
		$mc_4 = $_POST['mc_4'];
		$mc_5 = $_POST['mc_5'];
		$mc_6 = $_POST['mc_6'];
		$mc_7 = $_POST['mc_7'];
		$mc_8 = $_POST['mc_8'];
		$mc_9 = $_POST['mc_9'];
		$mc_10 = $_POST['mc_10'];
		$mc_11 = $_POST['mc_11'];
		$mc_12 = $_POST['mc_12'];
		
		$w1_1 = $_POST['w1_1'];
		$w1_2 = $_POST['w1_2'];
		$w1_3 = $_POST['w1_3'];
		$w1_4 = $_POST['w1_4'];
		$w1_5 = $_POST['w1_5'];
		$w1_6 = $_POST['w1_6'];
		$w1_7 = $_POST['w1_7'];
		$w1_8 = $_POST['w1_8'];
		$w1_9 = $_POST['w1_9'];
		$w1_10 = $_POST['w1_10'];
		$w1_11 = $_POST['w1_11'];
		$w1_12 = $_POST['w1_12'];
		
		

		$chk_dim = $_POST['chk_dim'];
		$dim_length = $_POST['dim_length'];
		$dim_width = $_POST['dim_width'];
		$dim_height = $_POST['dim_height'];
		$dim_l1 = $_POST['dim_l1'];
		$dim_l2 = $_POST['dim_l2'];
		$dim_l3 = $_POST['dim_l3'];
		$dim_l4 = $_POST['dim_l4'];
		$dim_l5 = $_POST['dim_l5'];
		$dim_l6 = $_POST['dim_l6'];
		$dim_l7 = $_POST['dim_l7'];
		$dim_l8 = $_POST['dim_l8'];
		$dim_l9 = $_POST['dim_l9'];
		$dim_l10 = $_POST['dim_l10'];
		$dim_l11 = $_POST['dim_l11'];
		$dim_l12 = $_POST['dim_l12'];
		$dim_l13 = $_POST['dim_l13'];
		$dim_l14 = $_POST['dim_l14'];
		$dim_l15 = $_POST['dim_l15'];
		$dim_l16 = $_POST['dim_l16'];
		$dim_l17 = $_POST['dim_l17'];
		$dim_l18 = $_POST['dim_l18'];
		$dim_l19 = $_POST['dim_l19'];
		$dim_l20 = $_POST['dim_l20'];
		$dim_l21 = $_POST['dim_l21'];
		$dim_l22 = $_POST['dim_l22'];
		$dim_l23 = $_POST['dim_l23'];
		$dim_l24 = $_POST['dim_l24'];
		$dim_h1 = $_POST['dim_h1'];
		$dim_h2 = $_POST['dim_h2'];
		$dim_h3 = $_POST['dim_h3'];
		$dim_h4 = $_POST['dim_h4'];
		$dim_h5 = $_POST['dim_h5'];
		$dim_h6 = $_POST['dim_h6'];
		$dim_h7 = $_POST['dim_h7'];
		$dim_h8 = $_POST['dim_h8'];
		$dim_h9 = $_POST['dim_h9'];
		$dim_h10 = $_POST['dim_h10'];
		$dim_h11 = $_POST['dim_h11'];
		$dim_h12 = $_POST['dim_h12'];
		$dim_h13 = $_POST['dim_h13'];
		$dim_h14 = $_POST['dim_h14'];
		$dim_h15 = $_POST['dim_h15'];
		$dim_h16 = $_POST['dim_h16'];
		$dim_h17 = $_POST['dim_h17'];
		$dim_h18 = $_POST['dim_h18'];
		$dim_h19 = $_POST['dim_h19'];
		$dim_h20 = $_POST['dim_h20'];
		$dim_h21 = $_POST['dim_h21'];
		$dim_h22 = $_POST['dim_h22'];
		$dim_h23 = $_POST['dim_h23'];
		$dim_h24 = $_POST['dim_h24'];
		$dim_w1 = $_POST['dim_w1'];
		$dim_w2 = $_POST['dim_w2'];
		$dim_w3 = $_POST['dim_w3'];
		$dim_w4 = $_POST['dim_w4'];
		$dim_w5 = $_POST['dim_w5'];
		$dim_w6 = $_POST['dim_w6'];
		$dim_w7 = $_POST['dim_w7'];
		$dim_w8 = $_POST['dim_w8'];
		$dim_w9 = $_POST['dim_w9'];
		$dim_w10 = $_POST['dim_w10'];
		$dim_w11 = $_POST['dim_w11'];
		$dim_w12 = $_POST['dim_w12'];
		$dim_w13 = $_POST['dim_w13'];
		$dim_w14 = $_POST['dim_w14'];
		$dim_w15 = $_POST['dim_w15'];
		$dim_w16 = $_POST['dim_w16'];
		$dim_w17 = $_POST['dim_w17'];
		$dim_w18 = $_POST['dim_w18'];
		$dim_w19 = $_POST['dim_w19'];
		$dim_w20 = $_POST['dim_w20'];
		$dim_w21 = $_POST['dim_w21'];
		$dim_w22 = $_POST['dim_w22'];
		$dim_w23 = $_POST['dim_w23'];
		$dim_w24 = $_POST['dim_w24'];

		$dim_block1 = $_POST['dim_block1'];
		$dim_block2 = $_POST['dim_block2'];
		$dim_block3 = $_POST['dim_block3'];
		$dim_block4 = $_POST['dim_block4'];
		$dim_block5 = $_POST['dim_block5'];
		$dim_block6 = $_POST['dim_block6'];
		$dim_block7 = $_POST['dim_block7'];
		$dim_block8 = $_POST['dim_block8'];
		$dim_block9 = $_POST['dim_block9'];
		$dim_block10 = $_POST['dim_block10'];
		$dim_block11 = $_POST['dim_block11'];
		$dim_block12 = $_POST['dim_block12'];
		$dim_block13 = $_POST['dim_block13'];
		$dim_block14 = $_POST['dim_block14'];
		$dim_block15 = $_POST['dim_block15'];
		$dim_block16 = $_POST['dim_block16'];
		$dim_block17 = $_POST['dim_block17'];
		$dim_block18 = $_POST['dim_block18'];
		$dim_block19 = $_POST['dim_block19'];
		$dim_block20 = $_POST['dim_block20'];
		$dim_block21 = $_POST['dim_block21'];
		$dim_block22 = $_POST['dim_block22'];
		$dim_block23 = $_POST['dim_block23'];
		$dim_block24 = $_POST['dim_block24'];

		$chk_den = $_POST['chk_den'];
		$dl_1 = $_POST['dl_1'];
		$dl_2 = $_POST['dl_2'];
		$dl_3 = $_POST['dl_3'];
		$dw_1 = $_POST['dw_1'];
		$dw_2 = $_POST['dw_2'];
		$dw_3 = $_POST['dw_3'];
		$dh_1 = $_POST['dh_1'];
		$dh_2 = $_POST['dh_2'];
		$dh_3 = $_POST['dh_3'];
		$vol_1 = $_POST['vol_1'];
		$vol_2 = $_POST['vol_2'];
		$vol_3 = $_POST['vol_3'];
		$weight_1 = $_POST['weight_1'];
		$weight_2 = $_POST['weight_2'];
		$weight_3 = $_POST['weight_3'];
		$den_1 = $_POST['den_1'];
		$den_2 = $_POST['den_2'];
		$den_3 = $_POST['den_3'];
		$wa_1 = $_POST['wa_1'];
		$wa_2 = $_POST['wa_2'];
		$wa_3 = $_POST['wa_3'];
		$w1 = $_POST['w1'];
		$w2 = $_POST['w2'];
		$w3 = $_POST['w3'];
		$mc = $_POST['mc'];
		$bdl = $_POST['bdl'];
		$bdl_kg = $_POST['bdl_kg'];
		$chk_shr = $_POST['chk_shr'];
		$con_1 = $_POST['con_1'];
		$con_2 = $_POST['con_2'];
		$con_3 = $_POST['con_3'];
		$fr_1 = $_POST['fr_1'];
		$fr_2 = $_POST['fr_2'];
		$fr_3 = $_POST['fr_3'];
		$fi_1 = $_POST['fi_1'];
		$fi_2 = $_POST['fi_2'];
		$fi_3 = $_POST['fi_3'];
		$ds_1 = $_POST['ds_1'];
		$ds_2 = $_POST['ds_2'];
		$ds_3 = $_POST['ds_3'];

		$con_wid_1 = $_POST['con_wid_1'];
		$con_wid_2 = $_POST['con_wid_2'];
		$con_wid_3 = $_POST['con_wid_3'];
		$con_thi_1 = $_POST['con_thi_1'];
		$con_thi_2 = $_POST['con_thi_2'];
		$con_thi_3 = $_POST['con_thi_3'];
		$avg_shrink = $_POST['avg_shrink'];

		$chk_thr = $_POST['chk_thr'];
			$tl_1 = $_POST['tl_1'];							
			$tl_2 = $_POST['tl_2'];							
			$tl_3 = $_POST['tl_3'];
			$tw_1 = $_POST['tw_1'];							
			$tw_2 = $_POST['tw_2'];							
			$tw_3 = $_POST['tw_3'];
			$th_1 = $_POST['th_1'];							
			$th_2 = $_POST['th_2'];							
			$th_3 = $_POST['th_3'];
			$tarea_1 = $_POST['tarea_1'];							
			$tarea_2 = $_POST['tarea_2'];							
			$tarea_3 = $_POST['tarea_3'];
			$tvolt_1 = $_POST['tvolt_1'];							
			$tvolt_2 = $_POST['tvolt_2'];							
			$tvolt_3 = $_POST['tvolt_3'];
			$tf_1_1 = $_POST['tf_1_1'];							
			$tf_1_2 = $_POST['tf_1_2'];							
			$tf_1_3 = $_POST['tf_1_3'];
			$tf_2_1 = $_POST['tf_2_1'];							
			$tf_2_2 = $_POST['tf_2_2'];							
			$tf_2_3 = $_POST['tf_2_3'];
			$tf_3_1 = $_POST['tf_3_1'];							
			$tf_3_2 = $_POST['tf_3_2'];							
			$tf_3_3 = $_POST['tf_3_3'];
			$tf_avg_1 = $_POST['tf_avg_1'];							
			$tf_avg_2 = $_POST['tf_avg_2'];							
			$tf_avg_3 = $_POST['tf_avg_3'];
			$tc_1_1 = $_POST['tc_1_1'];							
			$tc_1_2 = $_POST['tc_1_2'];							
			$tc_1_3 = $_POST['tc_1_3'];
			$tc_2_1 = $_POST['tc_2_1'];							
			$tc_2_2 = $_POST['tc_2_2'];							
			$tc_2_3 = $_POST['tc_2_3'];
			$tc_3_1 = $_POST['tc_3_1'];							
			$tc_3_2 = $_POST['tc_3_2'];							
			$tc_3_3 = $_POST['tc_3_3'];
			$tc_avg_1 = $_POST['tc_avg_1'];							
			$tc_avg_2 = $_POST['tc_avg_2'];							
			$tc_avg_3 = $_POST['tc_avg_3'];
			$thr_1 = $_POST['thr_1'];							
			$thr_2 = $_POST['thr_2'];							
			$thr_3 = $_POST['thr_3'];
			$avg_thr = $_POST['avg_thr'];
			
			if($_POST['the_s_d'] == ""){$the_s_d ="0000-00-00";}
			else{$the_s_d = substr($_POST['the_s_d'],6,4)."-".substr($_POST['the_s_d'],3,2)."-".substr($_POST['the_s_d'],0,2);}

			if($_POST['the_e_d'] == ""){$the_e_d ="0000-00-00";}
			else{$the_e_d = substr($_POST['the_e_d'],6,4)."-".substr($_POST['the_e_d'],3,2)."-".substr($_POST['the_e_d'],0,2);}

		$curr_date = date("Y-m-d");



		$insert = "INSERT INTO `aac_block`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `in_l`, `in_w`, `in_h`, `in_den`, `in_grade`, `chk_dim`, `dim_length`, `dim_width`, `dim_height`, `dim_l1`, `dim_l2`, `dim_l3`, `dim_l4`, `dim_l5`, `dim_l6`, `dim_l7`, `dim_l8`, `dim_l9`, `dim_l10`, `dim_l11`, `dim_l12`, `dim_l13`, `dim_l14`, `dim_l15`, `dim_l16`, `dim_l17`, `dim_l18`, `dim_l19`, `dim_l20`, `dim_l21`, `dim_l22`, `dim_l23`, `dim_l24`, `dim_w1`, `dim_w2`, `dim_w3`, `dim_w4`, `dim_w5`, `dim_w6`, `dim_w7`, `dim_w8`, `dim_w9`, `dim_w10`, `dim_w11`, `dim_w12`, `dim_w13`, `dim_w14`, `dim_w15`, `dim_w16`, `dim_w17`, `dim_w18`, `dim_w19`, `dim_w20`, `dim_w21`, `dim_w22`, `dim_w23`, `dim_w24`, `dim_h1`, `dim_h2`, `dim_h3`, `dim_h4`, `dim_h5`, `dim_h6`, `dim_h7`, `dim_h8`, `dim_h9`, `dim_h10`, `dim_h11`, `dim_h12`, `dim_h13`, `dim_h14`, `dim_h15`, `dim_h16`, `dim_h17`, `dim_h18`, `dim_h19`, `dim_h20`, `dim_h21`, `dim_h22`, `dim_h23`, `dim_h24`, `dim_block1`, `dim_block2`, `dim_block3`, `dim_block4`, `dim_block5`, `dim_block6`, `dim_block7`, `dim_block8`, `dim_block9`, `dim_block10`, `dim_block11`, `dim_block12`, `dim_block13`, `dim_block14`, `dim_block15`, `dim_block16`, `dim_block17`, `dim_block18`, `dim_block19`, `dim_block20`, `dim_block21`, `dim_block22`, `dim_block23`, `dim_block24`, `chk_com`, `sample_1`, `sample_2`, `sample_3`, `sample_4`, `sample_5`, `sample_6`, `sample_7`, `sample_8`, `sample_9`, `sample_10`, `sample_11`, `sample_12`, `l_1`, `l_2`, `l_3`, `l_4`, `l_5`, `l_6`, `l_7`, `l_8`, `l_9`, `l_10`, `l_11`, `l_12`, `w_1`, `w_2`, `w_3`, `w_4`, `w_5`, `w_6`, `w_7`, `w_8`, `w_9`, `w_10`, `w_11`, `w_12`, `h_1`, `h_2`, `h_3`, `h_4`, `h_5`, `h_6`, `h_7`, `h_8`, `h_9`, `h_10`, `h_11`, `h_12`, `load_1`, `load_2`, `load_3`, `load_4`, `load_5`, `load_6`, `load_7`, `load_8`, `load_9`, `load_10`, `load_11`, `load_12`, `area_1`, `area_2`, `area_3`, `area_4`, `area_5`, `area_6`, `area_7`, `area_8`, `area_9`, `area_10`, `area_11`, `area_12`, `com_1`, `com_2`, `com_3`, `com_4`, `com_5`, `com_6`, `com_7`, `com_8`, `com_9`, `com_10`, `com_11`, `com_12`, `mc_1`, `mc_2`, `mc_3`, `mc_4`, `mc_5`, `mc_6`, `mc_7`, `mc_8`, `mc_9`, `mc_10`, `mc_11`, `mc_12`, `w1_1`, `w1_2`, `w1_3`, `w1_4`, `w1_5`, `w1_6`, `w1_7`, `w1_8`, `w1_9`, `w1_10`, `w1_11`, `w1_12`, `avg_com`, `chk_den`, `dl_1`, `dl_2`, `dl_3`, `dw_1`, `dw_2`, `dw_3`, `dh_1`, `dh_2`, `dh_3`, `vol_1`, `vol_2`, `vol_3`, `weight_1`, `weight_2`, `weight_3`, `den_1`, `den_2`, `den_3`, `bdl`, `bdl_kg`, `w1`, `w2`, `w3`, `wa_1`, `wa_2`, `wa_3`, `mc`, `chk_shr`, `con_1`, `con_2`, `con_3`, `fr_1`, `fr_2`, `fr_3`, `fi_1`, `fi_2`, `fi_3`, `ds_1`, `ds_2`, `ds_3`, `avg_shrink`, `con_wid_1`, `con_wid_2`, `con_wid_3`, `con_thi_1`, `con_thi_2`, `con_thi_3`,  `chk_thr`, `tl_1`, `tl_2`, `tl_3`, `tw_1`, `tw_2`, `tw_3`, `th_1`, `th_2`, `th_3`, `tarea_1`, `tarea_2`, `tarea_3`, `tvolt_1`, `tvolt_2`, `tvolt_3`, `tf_1_1`, `tf_1_2`, `tf_1_3`, `tf_2_1`, `tf_2_2`, `tf_2_3`, `tf_3_1`, `tf_3_2`, `tf_3_3`, `tf_avg_1`, `tf_avg_2`, `tf_avg_3`, `tc_1_1`, `tc_1_2`, `tc_1_3`, `tc_2_1`, `tc_2_2`, `tc_2_3`, `tc_3_1`, `tc_3_2`, `tc_3_3`, `tc_avg_1`, `tc_avg_2`, `tc_avg_3`, `thr_1`, `thr_2`, `thr_3`, `avg_thr`, `the_s_d`, `the_e_d`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$in_l', '$in_w', '$in_h', '$in_den', '$in_grade', '$chk_dim', '$dim_length', '$dim_width', '$dim_height', '$dim_l1', '$dim_l2', '$dim_l3', '$dim_l4', '$dim_l5', '$dim_l6', '$dim_l7', '$dim_l8', '$dim_l9', '$dim_l10', '$dim_l11', '$dim_l12', '$dim_l13', '$dim_l14', '$dim_l15', '$dim_l16', '$dim_l17', '$dim_l18', '$dim_l19', '$dim_l20', '$dim_l21', '$dim_l22', '$dim_l23', '$dim_l24', '$dim_w1', '$dim_w2', '$dim_w3', '$dim_w4', '$dim_w5', '$dim_w6', '$dim_w7', '$dim_w8', '$dim_w9', '$dim_w10', '$dim_w11', '$dim_w12', '$dim_w13', '$dim_w14', '$dim_w15', '$dim_w16', '$dim_w17', '$dim_w18', '$dim_w19', '$dim_w20', '$dim_w21', '$dim_w22', '$dim_w23', '$dim_w24', '$dim_h1', '$dim_h2', '$dim_h3', '$dim_h4', '$dim_h5', '$dim_h6', '$dim_h7', '$dim_h8', '$dim_h9', '$dim_h10', '$dim_h11', '$dim_h12', '$dim_h13', '$dim_h14', '$dim_h15', '$dim_h16', '$dim_h17', '$dim_h18', '$dim_h19', '$dim_h20', '$dim_h21', '$dim_h22', '$dim_h23', '$dim_h24', '$dim_block1', '$dim_block2', '$dim_block3', '$dim_block4', '$dim_block5', '$dim_block6', '$dim_block7', '$dim_block8', '$dim_block9', '$dim_block10', '$dim_block11', '$dim_block12', '$dim_block13', '$dim_block14', '$dim_block15', '$dim_block16', '$dim_block17', '$dim_block18', '$dim_block19', '$dim_block20', '$dim_block21', '$dim_block22', '$dim_block23', '$dim_block24', '$chk_com', '$sample_1', '$sample_2', '$sample_3', '$sample_4', '$sample_5', '$sample_6', '$sample_7', '$sample_8', '$sample_9', '$sample_10', '$sample_11', '$sample_12', '$l_1', '$l_2', '$l_3', '$l_4', '$l_5', '$l_6', '$l_7', '$l_8', '$l_9', '$l_10', '$l_11', '$l_12', '$w_1', '$w_2', '$w_3', '$w_4', '$w_5', '$w_6', '$w_7', '$w_8', '$w_9', '$w_10', '$w_11', '$w_12', '$h_1', '$h_2', '$h_3', '$h_4', '$h_5', '$h_6', '$h_7', '$h_8', '$h_9', '$h_10', '$h_11', '$h_12', '$load_1', '$load_2', '$load_3', '$load_4', '$load_5', '$load_6', '$load_7', '$load_8', '$load_9', '$load_10', '$load_11', '$load_12', '$area_1', '$area_2', '$area_3', '$area_4', '$area_5', '$area_6', '$area_7', '$area_8', '$area_9', '$area_10', '$area_11', '$area_12', '$com_1', '$com_2', '$com_3', '$com_4', '$com_5', '$com_6', '$com_7', '$com_8', '$com_9', '$com_10', '$com_11', '$com_12', '$mc_1', '$mc_2', '$mc_3', '$mc_4', '$mc_5', '$mc_6', '$mc_7', '$mc_8', '$mc_9', '$mc_10', '$mc_11', '$mc_12', '$w1_1', '$w1_2', '$w1_3', '$w1_4', '$w1_5', '$w1_6', '$w1_7', '$w1_8', '$w1_9', '$w1_10', '$w1_11', '$w1_12', '$avg_com', '$chk_den', '$dl_1', '$dl_2', '$dl_3', '$dw_1', '$dw_2', '$dw_3', '$dh_1', '$dh_2', '$dh_3', '$vol_1', '$vol_2', '$vol_3', '$weight_1', '$weight_2', '$weight_3', '$den_1', '$den_2', '$den_3', '$bdl', '$bdl_kg', '$w1', '$w2', '$w3', '$wa_1', '$wa_2', '$wa_3', '$mc', '$chk_shr', '$con_1', '$con_2', '$con_3', '$fr_1', '$fr_2', '$fr_3', '$fi_1', '$fi_2', '$fi_3', '$ds_1', '$ds_2', '$ds_3', '$avg_shrink', '$con_wid_1', '$con_wid_2', '$con_wid_3', '$con_thi_1', '$con_thi_2', '$con_thi_3','$chk_thr','$tl_1','$tl_2','$tl_3','$tw_1','$tw_2','$tw_3','$th_1','$th_2','$th_3','$tarea_1','$tarea_2','$tarea_3','$tvolt_1','$tvolt_2','$tvolt_3','$tf_1_1','$tf_1_2','$tf_1_3','$tf_2_1','$tf_2_2','$tf_2_3','$tf_3_1','$tf_3_2','$tf_3_3','$tf_avg_1','$tf_avg_2','$tf_avg_3','$tc_1_1','$tc_1_2','$tc_1_3','$tc_2_1','$tc_2_2','$tc_2_3','$tc_3_1','$tc_3_2','$tc_3_3','$tc_avg_1','$tc_avg_2','$tc_avg_3','$thr_1','$thr_2','$thr_3','$avg_thr', '$the_s_d', '$the_e_d', '$amend_date')";

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
						$query = "select * from `aac_block` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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

		
		if($_POST['the_s_d'] == ""){$the_s_d ="0000-00-00";}
		else{$the_s_d = substr($_POST['the_s_d'],6,4)."-".substr($_POST['the_s_d'],3,2)."-".substr($_POST['the_s_d'],0,2);}

		if($_POST['the_e_d'] == ""){$the_e_d ="0000-00-00";}
		else{$the_e_d = substr($_POST['the_e_d'],6,4)."-".substr($_POST['the_e_d'],3,2)."-".substr($_POST['the_e_d'],0,2);}
		
		$curr_date = date("Y-m-d");



		$update = "update aac_block SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,	
					`in_l`= '$_POST[in_l]',
					`in_w`= '$_POST[in_w]',
					`in_h`= '$_POST[in_h]',
					`in_grade`= '$_POST[in_grade]',
					`in_den`= '$_POST[in_den]',
					`chk_com`= '$_POST[chk_com]',
					`avg_com`= '$_POST[avg_com]',												
					`sample_1` = '$_POST[sample_1]',							
					`sample_2` = '$_POST[sample_2]',							
					`sample_3` = '$_POST[sample_3]',
					`sample_4` = '$_POST[sample_4]',
					`sample_5` = '$_POST[sample_5]',
					`sample_6` = '$_POST[sample_6]',
					`sample_7` = '$_POST[sample_7]',
					`sample_8` = '$_POST[sample_8]',
					`sample_9` = '$_POST[sample_9]',
					`sample_10` = '$_POST[sample_10]',
					`sample_11` = '$_POST[sample_11]',
					`sample_12` = '$_POST[sample_12]',
					`l_1` = '$_POST[l_1]',							
					`l_2` = '$_POST[l_2]',							
					`l_3` = '$_POST[l_3]',
					`l_4` = '$_POST[l_4]',
					`l_5` = '$_POST[l_5]',
					`l_6` = '$_POST[l_6]',
					`l_7` = '$_POST[l_7]',
					`l_8` = '$_POST[l_8]',
					`l_9` = '$_POST[l_9]',
					`l_10` = '$_POST[l_10]',
					`l_11` = '$_POST[l_11]',
					`l_12` = '$_POST[l_12]',
					`w_1` = '$_POST[w_1]',							
					`w_2` = '$_POST[w_2]',							
					`w_3` = '$_POST[w_3]',
					`w_4` = '$_POST[w_4]',							
					`w_5` = '$_POST[w_5]',							
					`w_6` = '$_POST[w_6]',
					`w_7` = '$_POST[w_7]',							
					`w_8` = '$_POST[w_8]',							
					`w_9` = '$_POST[w_9]',
					`w_10` = '$_POST[w_10]',							
					`w_11` = '$_POST[w_11]',							
					`w_12` = '$_POST[w_12]',
					`h_1` = '$_POST[h_1]',							
					`h_2` = '$_POST[h_2]',							
					`h_3` = '$_POST[h_3]',
					`h_4` = '$_POST[h_4]',							
					`h_5` = '$_POST[h_5]',							
					`h_6` = '$_POST[h_6]',
					`h_7` = '$_POST[h_7]',							
					`h_8` = '$_POST[h_8]',							
					`h_9` = '$_POST[h_9]',
					`h_10` = '$_POST[h_10]',							
					`h_11` = '$_POST[h_11]',							
					`h_12` = '$_POST[h_12]',
					`load_1` = '$_POST[load_1]',							
					`load_2` = '$_POST[load_2]',							
					`load_3` = '$_POST[load_3]',
					`load_4` = '$_POST[load_4]',							
					`load_5` = '$_POST[load_5]',							
					`load_6` = '$_POST[load_6]',
					`load_7` = '$_POST[load_7]',							
					`load_8` = '$_POST[load_8]',							
					`load_9` = '$_POST[load_9]',
					`load_10` = '$_POST[load_10]',							
					`load_11` = '$_POST[load_11]',							
					`load_12` = '$_POST[load_12]',
					`area_1` = '$_POST[area_1]',							
					`area_2` = '$_POST[area_2]',							
					`area_3` = '$_POST[area_3]',
					`area_4` = '$_POST[area_4]',							
					`area_5` = '$_POST[area_5]',							
					`area_6` = '$_POST[area_6]',
					`area_7` = '$_POST[area_7]',							
					`area_8` = '$_POST[area_8]',							
					`area_9` = '$_POST[area_9]',
					`area_10` = '$_POST[area_10]',							
					`area_11` = '$_POST[area_11]',							
					`area_12` = '$_POST[area_12]',
					`com_1` = '$_POST[com_1]',							
					`com_2` = '$_POST[com_2]',							
					`com_3` = '$_POST[com_3]',
					`com_4` = '$_POST[com_4]',							
					`com_5` = '$_POST[com_5]',							
					`com_6` = '$_POST[com_6]',
					`com_7` = '$_POST[com_7]',							
					`com_8` = '$_POST[com_8]',							
					`com_9` = '$_POST[com_9]',
					`com_10` = '$_POST[com_10]',							
					`com_11` = '$_POST[com_11]',							
					`com_12` = '$_POST[com_12]',
					`mc_1` = '$_POST[mc_1]',							
					`mc_2` = '$_POST[mc_2]',							
					`mc_3` = '$_POST[mc_3]',
					`mc_4` = '$_POST[mc_4]',							
					`mc_5` = '$_POST[mc_5]',							
					`mc_6` = '$_POST[mc_6]',
					`mc_7` = '$_POST[mc_7]',							
					`mc_8` = '$_POST[mc_8]',							
					`mc_9` = '$_POST[mc_9]',
					`mc_10` = '$_POST[mc_10]',							
					`mc_11` = '$_POST[mc_11]',							
					`mc_12` = '$_POST[mc_12]',
					`w1_1` = '$_POST[w1_1]',							
					`w1_2` = '$_POST[w1_2]',							
					`w1_3` = '$_POST[w1_3]',
					`w1_4` = '$_POST[w1_4]',							
					`w1_5` = '$_POST[w1_5]',							
					`w1_6` = '$_POST[w1_6]',
					`w1_7` = '$_POST[w1_7]',							
					`w1_8` = '$_POST[w1_8]',							
					`w1_9` = '$_POST[w1_9]',
					`w1_10` = '$_POST[w1_10]',							
					`w1_11` = '$_POST[w1_11]',							
					`w1_12` = '$_POST[w1_12]',
					`chk_dim`= '$_POST[chk_dim]',
					`dim_length`= '$_POST[dim_length]',
					`dim_width`= '$_POST[dim_width]',
					`dim_height`= '$_POST[dim_height]',							
					`dim_l1`= '$_POST[dim_l1]',							
					`dim_l2`= '$_POST[dim_l2]',							
					`dim_l3`= '$_POST[dim_l3]',
					`dim_l4`= '$_POST[dim_l4]',
					`dim_l5`= '$_POST[dim_l5]',
					`dim_l6`= '$_POST[dim_l6]',
					`dim_l7`= '$_POST[dim_l7]',
					`dim_l8`= '$_POST[dim_l8]',
					`dim_l9`= '$_POST[dim_l9]',
					`dim_l10`= '$_POST[dim_l10]',
					`dim_l11`= '$_POST[dim_l11]',
					`dim_l12`= '$_POST[dim_l12]',
					`dim_l13`= '$_POST[dim_l13]',
					`dim_l14`= '$_POST[dim_l14]',
					`dim_l15`= '$_POST[dim_l15]',
					`dim_l16`= '$_POST[dim_l16]',
					`dim_l17`= '$_POST[dim_l17]',
					`dim_l18`= '$_POST[dim_l18]',
					`dim_l19`= '$_POST[dim_l19]',
					`dim_l20`= '$_POST[dim_l20]',
					`dim_l21`= '$_POST[dim_l21]',
					`dim_l22`= '$_POST[dim_l22]',
					`dim_l23`= '$_POST[dim_l23]',
					`dim_l24`= '$_POST[dim_l24]',
					`dim_h1`= '$_POST[dim_h1]',							
					`dim_h2`= '$_POST[dim_h2]',							
					`dim_h3`= '$_POST[dim_h3]',
					`dim_h4`= '$_POST[dim_h4]',							
					`dim_h5`= '$_POST[dim_h5]',							
					`dim_h6`= '$_POST[dim_h6]',							
					`dim_h7`= '$_POST[dim_h7]',
					`dim_h8`= '$_POST[dim_h8]',
					`dim_h9`= '$_POST[dim_h9]',
					`dim_h10`= '$_POST[dim_h10]',
					`dim_h11`= '$_POST[dim_h11]',
					`dim_h12`= '$_POST[dim_h12]',
					`dim_h13`= '$_POST[dim_h13]',
					`dim_h14`= '$_POST[dim_h14]',
					`dim_h15`= '$_POST[dim_h15]',
					`dim_h16`= '$_POST[dim_h16]',
					`dim_h17`= '$_POST[dim_h17]',
					`dim_h18`= '$_POST[dim_h18]',
					`dim_h19`= '$_POST[dim_h19]',
					`dim_h20`= '$_POST[dim_h20]',
					`dim_h21`= '$_POST[dim_h21]',
					`dim_h22`= '$_POST[dim_h22]',
					`dim_h23`= '$_POST[dim_h23]',
					`dim_h24`= '$_POST[dim_h24]',
					`dim_w1`= '$_POST[dim_w1]',							
					`dim_w2`= '$_POST[dim_w2]',							
					`dim_w3`= '$_POST[dim_w3]',
					`dim_w4`= '$_POST[dim_w4]',							
					`dim_w5`= '$_POST[dim_w5]',							
					`dim_w6`= '$_POST[dim_w6]',							
					`dim_w7`= '$_POST[dim_w7]',
					`dim_w8`= '$_POST[dim_w8]',
					`dim_w9`= '$_POST[dim_w9]',
					`dim_w10`= '$_POST[dim_w10]',
					`dim_w11`= '$_POST[dim_w11]',
					`dim_w12`= '$_POST[dim_w12]',
					`dim_w13`= '$_POST[dim_w13]',
					`dim_w14`= '$_POST[dim_w14]',
					`dim_w15`= '$_POST[dim_w15]',
					`dim_w16`= '$_POST[dim_w16]',
					`dim_w17`= '$_POST[dim_w17]',
					`dim_w18`= '$_POST[dim_w18]',
					`dim_w19`= '$_POST[dim_w19]',
					`dim_w20`= '$_POST[dim_w20]',
					`dim_w21`= '$_POST[dim_w21]',
					`dim_w22`= '$_POST[dim_w22]',
					`dim_w23`= '$_POST[dim_w23]',
					`dim_w24`= '$_POST[dim_w24]',
					`dim_block1`= '$_POST[dim_block1]',
					`dim_block2`= '$_POST[dim_block2]',
					`dim_block3`= '$_POST[dim_block3]',
					`dim_block4`= '$_POST[dim_block4]',
					`dim_block5`= '$_POST[dim_block5]',
					`dim_block6`= '$_POST[dim_block6]',
					`dim_block7`= '$_POST[dim_block7]',
					`dim_block8`= '$_POST[dim_block8]',
					`dim_block9`= '$_POST[dim_block9]',
					`dim_block10`= '$_POST[dim_block10]',
					`dim_block11`= '$_POST[dim_block11]',
					`dim_block12`= '$_POST[dim_block12]',
					`dim_block13`= '$_POST[dim_block13]',
					`dim_block14`= '$_POST[dim_block14]',
					`dim_block15`= '$_POST[dim_block15]',
					`dim_block16`= '$_POST[dim_block16]',
					`dim_block17`= '$_POST[dim_block17]',
					`dim_block18`= '$_POST[dim_block18]',
					`dim_block19`= '$_POST[dim_block19]',
					`dim_block20`= '$_POST[dim_block20]',
					`dim_block21`= '$_POST[dim_block21]',
					`dim_block22`= '$_POST[dim_block22]',
					`dim_block23`= '$_POST[dim_block23]',
					`dim_block24`= '$_POST[dim_block24]',
					`chk_den`= '$_POST[chk_den]',							
					`dl_1`= '$_POST[dl_1]',							
					`dl_2`= '$_POST[dl_2]',							
					`dl_3`= '$_POST[dl_3]',
					`dw_1`= '$_POST[dw_1]',							
					`dw_2`= '$_POST[dw_2]',							
					`dw_3`= '$_POST[dw_3]',
					`dh_1`= '$_POST[dh_1]',							
					`dh_2`= '$_POST[dh_2]',							
					`dh_3`= '$_POST[dh_3]',
					`vol_1`= '$_POST[vol_1]',							
					`vol_2`= '$_POST[vol_2]',							
					`vol_3`= '$_POST[vol_3]',
					`weight_1`= '$_POST[weight_1]',							
					`weight_2`= '$_POST[weight_2]',							
					`weight_3`= '$_POST[weight_3]',
					`den_1`= '$_POST[den_1]',							
					`den_2`= '$_POST[den_2]',							
					`den_3`= '$_POST[den_3]',
					`wa_1`= '$_POST[wa_1]',							
					`wa_2`= '$_POST[wa_2]',							
					`wa_3`= '$_POST[wa_3]',
					`w1`= '$_POST[w1]',							
					`w2`= '$_POST[w2]',							
					`w3`= '$_POST[w3]',
					`mc`= '$_POST[mc]',
					`bdl`= '$_POST[bdl]',
					`bdl_kg`= '$_POST[bdl_kg]',												
					`chk_shr`= '$_POST[chk_shr]',
					`con_1`= '$_POST[con_1]',							
					`con_2`= '$_POST[con_2]',							
					`con_3`= '$_POST[con_3]',
					`fr_1`= '$_POST[fr_1]',							
					`fr_2`= '$_POST[fr_2]',							
					`fr_3`= '$_POST[fr_3]',
					`fi_1`= '$_POST[fi_1]',							
					`fi_2`= '$_POST[fi_2]',							
					`fi_3`= '$_POST[fi_3]',
					`ds_1`= '$_POST[ds_1]',							
					`ds_2`= '$_POST[ds_2]',							
					`ds_3`= '$_POST[ds_3]',
					`con_wid_1`= '$_POST[con_wid_1]',							
					`con_wid_2`= '$_POST[con_wid_2]',							
					`con_wid_3`= '$_POST[con_wid_3]',
					`con_thi_1`= '$_POST[con_thi_1]',							
					`con_thi_2`= '$_POST[con_thi_2]',							
					`con_thi_3`= '$_POST[con_thi_3]',
					`avg_shrink`= '$_POST[avg_shrink]',
					`chk_thr` = '$_POST[chk_thr]',
					`tl_1` = '$_POST[tl_1]',							
					`tl_2` = '$_POST[tl_2]',							
					`tl_3` = '$_POST[tl_3]',
					`tw_1` = '$_POST[tw_1]',							
					`tw_2` = '$_POST[tw_2]',							
					`tw_3` = '$_POST[tw_3]',
					`th_1` = '$_POST[th_1]',							
					`th_2` = '$_POST[th_2]',							
					`th_3` = '$_POST[th_3]',
					`tarea_1` = '$_POST[tarea_1]',							
					`tarea_2` = '$_POST[tarea_2]',							
					`tarea_3` = '$_POST[tarea_3]',
					`tvolt_1` = '$_POST[tvolt_1]',							
					`tvolt_2` = '$_POST[tvolt_2]',							
					`tvolt_3` = '$_POST[tvolt_3]',
					`tf_1_1` = '$_POST[tf_1_1]',							
					`tf_1_2` = '$_POST[tf_1_2]',							
					`tf_1_3` = '$_POST[tf_1_3]',
					`tf_2_1` = '$_POST[tf_2_1]',							
					`tf_2_2` = '$_POST[tf_2_2]',							
					`tf_2_3` = '$_POST[tf_2_3]',
					`tf_3_1` = '$_POST[tf_3_1]',							
					`tf_3_2` = '$_POST[tf_3_2]',							
					`tf_3_3` = '$_POST[tf_3_3]',
					`tf_avg_1` = '$_POST[tf_avg_1]',							
					`tf_avg_2` = '$_POST[tf_avg_2]',							
					`tf_avg_3` = '$_POST[tf_avg_3]',
					`tc_1_1` = '$_POST[tc_1_1]',							
					`tc_1_2` = '$_POST[tc_1_2]',							
					`tc_1_3` = '$_POST[tc_1_3]',
					`tc_2_1` = '$_POST[tc_2_1]',							
					`tc_2_2` = '$_POST[tc_2_2]',							
					`tc_2_3` = '$_POST[tc_2_3]',
					`tc_3_1` = '$_POST[tc_3_1]',							
					`tc_3_2` = '$_POST[tc_3_2]',							
					`tc_3_3` = '$_POST[tc_3_3]',
					`tc_avg_1` = '$_POST[tc_avg_1]',							
					`tc_avg_2` = '$_POST[tc_avg_2]',							
					`tc_avg_3` = '$_POST[tc_avg_3]',
					`thr_1` = '$_POST[thr_1]',							
					`thr_2` = '$_POST[thr_2]',							
					`thr_3` = '$_POST[thr_3]',
					`dim_s_d`='$dim_s_d',
					`dim_e_d`='$dim_e_d',
					`the_s_d`='$the_s_d',
					`the_e_d`='$the_e_d',
					`dry_s_d`='$dry_s_d',
					`dry_e_d`='$dry_e_d',
					`den_s_d`='$den_s_d',
					`den_e_d`='$den_e_d',
					`com_s_d`='$com_s_d',
					`com_e_d`='$com_e_d',
					`avg_thr` = '$_POST[avg_thr]',
					`amend_date` = '$_POST[amend_date]'
				 
				  WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update aac_block SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM aac_block WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update aac_block SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update aac_block SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>