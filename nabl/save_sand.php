<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from sand WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'job_no' => $job_no,
							'lab_no' => $lab_no,	
							'ulr' => $ulr,	
							'sample_taken' => $result['sample_taken'],
							'sieve_1' => $result['sieve_1'],
							'sieve_2' => $result['sieve_2'],
							'sieve_3' => $result['sieve_3'],
							'sieve_4' => $result['sieve_4'],
							'sieve_5' => $result['sieve_5'],							
							'sieve_6' => $result['sieve_6'],							
							'sieve_7' => $result['sieve_7'],							
							'sieve_8' => $result['sieve_8'],							
							'cum_wt_gm_1' => $result['cum_wt_gm_1'],
							'cum_wt_gm_2' => $result['cum_wt_gm_2'],
							'cum_wt_gm_3' => $result['cum_wt_gm_3'],
							'cum_wt_gm_4' => $result['cum_wt_gm_4'],
							'cum_wt_gm_5' => $result['cum_wt_gm_5'],							
							'cum_wt_gm_6' => $result['cum_wt_gm_6'],							
							'cum_wt_gm_7' => $result['cum_wt_gm_7'],							
							'cum_wt_gm_8' => $result['cum_wt_gm_8'],							
							'ret_wt_gm_1' => $result['ret_wt_gm_1'],
							'ret_wt_gm_2' => $result['ret_wt_gm_2'],
							'ret_wt_gm_3' => $result['ret_wt_gm_3'],
							'ret_wt_gm_4' => $result['ret_wt_gm_4'],
							'ret_wt_gm_5' => $result['ret_wt_gm_5'],							
							'ret_wt_gm_6' => $result['ret_wt_gm_6'],							
							'ret_wt_gm_7' => $result['ret_wt_gm_7'],							
							'ret_wt_gm_8' => $result['ret_wt_gm_8'],							
							'cum_ret_1' => $result['cum_ret_1'],
							'cum_ret_2' => $result['cum_ret_2'],
							'cum_ret_3' => $result['cum_ret_3'],
							'cum_ret_4' => $result['cum_ret_4'],
							'cum_ret_5' => $result['cum_ret_5'],							
							'cum_ret_6' => $result['cum_ret_6'],							
							'cum_ret_7' => $result['cum_ret_7'],							
							'cum_ret_8' => $result['cum_ret_8'],							
							'pass_sample_1' => $result['pass_sample_1'],
							'pass_sample_2' => $result['pass_sample_2'],
							'pass_sample_3' => $result['pass_sample_3'],
							'pass_sample_4' => $result['pass_sample_4'],
							'pass_sample_5' => $result['pass_sample_5'],
							'pass_sample_6' => $result['pass_sample_6'],
							'pass_sample_7' => $result['pass_sample_7'],
							'pass_sample_8' => $result['pass_sample_8'],
							'blank_extra' => $result['blank_extra'],							
							'chk_grd' => $result['chk_grd'],							
							'grd_zone' => $result['grd_zone'],
							'chk_fm' => $result['chk_fm'],
							'grd_fm' => $result['grd_fm'],
							'chk_silt' => $result['chk_silt'],
							'silt_content' => $result['silt_content'],													
							'chk_sp' => $result['chk_sp'],
							'sp_temp' => $result['sp_temp'],							
							'sp_sample_ca' => $result['sp_sample_ca'],
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
							'sp_bask_water' => $result['sp_bask_water'],
							'sp_wt_bas1' => $result['sp_wt_bas1'],
							'sp_wt_bas2' => $result['sp_wt_bas2'],
							'sp_apr1' => $result['sp_apr1'],
							'sp_apr2' => $result['sp_apr2'],
							'sp_avg_apr' => $result['sp_avg_apr'],
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
							'wom1' => $result['wom1'],							
							'wom2' => $result['wom2'],							
							'wom3' => $result['wom3'],
							'avg_wom' => $result['avg_wom'],
							'vol' => $result['vol'],
							'bdl' => $result['bdl'],
							'chk_finer' => $result['chk_finer'],
							'finer_a' => $result['finer_a'],
							'finer_b' => $result['finer_b'],
							'avg_finer' => $result['avg_finer'],
							'chk_sou' => $result['chk_sou'],
							'soundness' => $result['soundness'],
							'go1' => $result['go1'],							
							'go2' => $result['go2'],							
							'go3' => $result['go3'],							
							'go4' => $result['go4'],							
							'go5' => $result['go5'],							
							'go6' => $result['go6'],							
							'go7' => $result['go7'],							
							'wt1' => $result['wt1'],							
							'wt2' => $result['wt2'],							
							'wt3' => $result['wt3'],							
							'wt4' => $result['wt4'],							
							'wt5' => $result['wt5'],							
							'wt6' => $result['wt6'],							
							'wt7' => $result['wt7'],							
							'pp1' => $result['pp1'],							
							'pp2' => $result['pp2'],							
							'pp3' => $result['pp3'],							
							'pp4' => $result['pp4'],							
							'pp5' => $result['pp5'],							
							'pp6' => $result['pp6'],							
							'pp7' => $result['pp7'],							
							'wa1' => $result['wa1'],							
							'wa2' => $result['wa2'],							
							'wa3' => $result['wa3'],							
							'wa4' => $result['wa4'],							
							'wa5' => $result['wa5'],							
							'wa6' => $result['wa6'],							
							'wa7' => $result['wa7'],
							'chk_pha' => $result['chk_pha'],
							'ph_s1_1' => $result['ph_s1_1'],
							'ph_s1_2' => $result['ph_s1_2'],
							'ph_s2_1' => $result['ph_s2_1'],
							'ph_s2_2' => $result['ph_s2_2'],
							'avg_ph' => $result['avg_ph'],
							'chk_clr' => $result['chk_clr'],
							'clr_s1_1' => $result['clr_s1_1'],
							'clr_s1_2' => $result['clr_s1_2'],
							'clr_s1_3' => $result['clr_s1_3'],
							'clr_s1_4' => $result['clr_s1_4'],
							'clr_s1_5' => $result['clr_s1_5'],
							'clr_s1_6' => $result['clr_s1_6'],
							'clr_s1_7' => $result['clr_s1_7'],
							'clr_s2_1' => $result['clr_s2_1'],
							'clr_s2_2' => $result['clr_s2_2'],
							'clr_s2_3' => $result['clr_s2_3'],
							'clr_s2_4' => $result['clr_s2_4'],
							'clr_s2_5' => $result['clr_s2_5'],
							'clr_s2_6' => $result['clr_s2_6'],
							'clr_s2_7' => $result['clr_s2_7'],
							'avg_clr' => $result['avg_clr'],
							'chk_slp' => $result['chk_slp'],
							'slp_s1_1' => $result['slp_s1_1'],
							'slp_s1_2' => $result['slp_s1_2'],
							'slp_s1_3' => $result['slp_s1_3'],
							'slp_s1_4' => $result['slp_s1_4'],
							'slp_s1_5' => $result['slp_s1_5'],
							'slp_s2_1' => $result['slp_s2_1'],
							'slp_s2_2' => $result['slp_s2_2'],
							'slp_s2_3' => $result['slp_s2_3'],
							'slp_s2_4' => $result['slp_s2_4'],
							'slp_s2_5' => $result['slp_s2_5'],
							'avg_sul' => $result['avg_sul'],
							'chk_alk' => $result['chk_alk'],
							'alk_a1' => $result['alk_a1'],
							'alk_a2' => $result['alk_a2'],
							'alk_a3' => $result['alk_a3'],
							'alk_a4' => $result['alk_a4'],
							'alk_a5' => $result['alk_a5'],
							'alk_b1' => $result['alk_b1'],
							'alk_b2' => $result['alk_b2'],
							'alk_b3' => $result['alk_b3'],
							'alk_b4' => $result['alk_b4'],
							'alk_b5' => $result['alk_b5'],
							'chk_dtm' => $result['chk_dtm'],
							'dele_1_1' => $result['dele_1_1'],
							'dele_1_2' => $result['dele_1_2'],
							'dele_1_3' => $result['dele_1_3'],
							'dele_1_4' => $result['dele_1_4'],
							'dele_2_1' => $result['dele_2_1'],
							'dele_2_2' => $result['dele_2_2'],
							'dele_2_3' => $result['dele_2_3'],
							'dele_3_1' => $result['dele_3_1'],
							'dele_3_2' => $result['dele_3_2'],
							'dele_3_3' => $result['dele_3_3'],
							'dele_3_4' => $result['dele_3_4'],
							'dele_4_1' => $result['dele_4_1'],
							'dele_4_2' => $result['dele_4_2'],
							'dele_4_3' => $result['dele_4_3'],
							'chk_aoi' => $result['chk_aoi'],
							'aoi_1' => $result['aoi_1'],
							'aoi_2' => $result['aoi_2'],
							'aoi_3' => $result['aoi_3'],
							'aoi_4' => $result['aoi_4'],
							'grd_s_d' => date('d/m/Y', strtotime($result['grd_s_d'])),	
							'grd_e_d' => date('d/m/Y', strtotime($result['grd_e_d'])),	
							'wtr_s_d' => date('d/m/Y', strtotime($result['wtr_s_d'])),	
							'wtr_e_d' => date('d/m/Y', strtotime($result['wtr_e_d'])),	
							'slt_s_d' => date('d/m/Y', strtotime($result['slt_s_d'])),	
							'slt_e_d' => date('d/m/Y', strtotime($result['slt_e_d'])),	
							'alk_s_d' => date('d/m/Y', strtotime($result['alk_s_d'])),	
							'alk_e_d' => date('d/m/Y', strtotime($result['alk_e_d'])),	
							'den_s_d' => date('d/m/Y', strtotime($result['den_s_d'])),	
							'den_e_d' => date('d/m/Y', strtotime($result['den_e_d'])),	
							'org_s_d' => date('d/m/Y', strtotime($result['org_s_d'])),	
							'org_e_d' => date('d/m/Y', strtotime($result['org_e_d'])),
							'del_s_d' => date('d/m/Y', strtotime($result['del_s_d'])),	
							'del_e_d' => date('d/m/Y', strtotime($result['del_e_d'])),
							'sou_s_d' => date('d/m/Y', strtotime($result['sou_s_d'])),	
							'sou_e_d' => date('d/m/Y', strtotime($result['sou_e_d'])),
							'chk_lbd' => $result['chk_lbd'],
							'lbd_1' => $result['lbd_1'],
							'ans_lbd' => $result['ans_lbd'],
							'chk_fmc' => $result['chk_fmc'],
							'fmc_sp' => $result['fmc_sp'],
							'fmc_1' => $result['fmc_1'],
							'fmc_2' => $result['fmc_2'],
							'fmc_3' => $result['fmc_3'],
							'fmc_4' => $result['fmc_4'],
							'fmc_5' => $result['fmc_5'],
							'fmc_6' => $result['fmc_6'],
							's_des' => $result['s_des'],
                            'r_sam' => $result['r_sam'],
                            's_ret' => $result['s_ret'],
							'chk_sil' => $result['chk_sil'],
                            'chk_cal' => $result['chk_cal'],
                            'silt_11' => $result['silt_11'],
                            'silt_21' => $result['silt_21'],
                            'silt_3' => $result['silt_3'],
                            'silt_31' => $result['silt_31'],
                            'silt_avg' => $result['silt_avg'],
							'sp_specific_gravity_11' => $result['sp_specific_gravity_11'],
							'sp_specific_gravity_22' => $result['sp_specific_gravity_22'],
							'sp_specific_gravity1' => $result['sp_specific_gravity1'],
							'avg_wom1' => $result['avg_wom1'],
							'den_voids1' => $result['den_voids1'],
							'weight_1' => $result['weight_1'],
							'weight_2' => $result['weight_2'],
							'asd_1' => $result['asd_1'],
							'asd_2' => $result['asd_2'],
							'finer_a1' => $result['finer_a1'],
							'finer_b1' => $result['finer_b1'],
							'avg_finer1' => $result['avg_finer1'],
							'avg_fin_1' => $result['avg_fin_1'],
							'avg_fin_2' => $result['avg_fin_2'],
							'den_voids_1' => $result['den_voids_1'],
							'den_voids' => $result['den_voids'],
							'den_mo_vol1' => $result['den_mo_vol1'],
							'den_mo_vol2' => $result['den_mo_vol2'],
							'den_kg_lit' => $result['den_kg_lit'],
							'den_liter' => $result['den_liter'],



							'fmc_7' => $result['fmc_7']
								
						);	  
			echo json_encode($fill);
		}
		
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];			
			$ulr=$_POST['ulr'];			
			$sample_taken =  $_POST['sample_taken'];	
					
			$sieve_1 = $_POST['sieve_1'];
			$sieve_2 = $_POST['sieve_2'];
			$sieve_3 = $_POST['sieve_3'];
			$sieve_4 = $_POST['sieve_4'];
			$sieve_5 = $_POST['sieve_5'];			
			$sieve_6 = $_POST['sieve_6'];			
			$sieve_7 = $_POST['sieve_7'];			
			$sieve_8 = $_POST['sieve_8'];			
			$cum_wt_gm_1 = $_POST['cum_wt_gm_1'];
			$cum_wt_gm_2 = $_POST['cum_wt_gm_2'];
			$cum_wt_gm_3 = $_POST['cum_wt_gm_3'];
			$cum_wt_gm_4 = $_POST['cum_wt_gm_4'];
			$cum_wt_gm_5 = $_POST['cum_wt_gm_5'];		
			$cum_wt_gm_6 = $_POST['cum_wt_gm_6'];		
			$cum_wt_gm_7 = $_POST['cum_wt_gm_7'];		
			$cum_wt_gm_8 = $_POST['cum_wt_gm_8'];		
			$ret_wt_gm_1 = $_POST['ret_wt_gm_1'];
			$ret_wt_gm_2 = $_POST['ret_wt_gm_2'];
			$ret_wt_gm_3 = $_POST['ret_wt_gm_3'];
			$ret_wt_gm_4 = $_POST['ret_wt_gm_4'];
			$ret_wt_gm_5 = $_POST['ret_wt_gm_5'];
			$ret_wt_gm_6 = $_POST['ret_wt_gm_6'];
			$ret_wt_gm_7 = $_POST['ret_wt_gm_7'];
			$ret_wt_gm_8 = $_POST['ret_wt_gm_8'];
			$cum_ret_1 = $_POST['cum_ret_1'];
			$cum_ret_2 = $_POST['cum_ret_2'];
			$cum_ret_3 = $_POST['cum_ret_3'];
			$cum_ret_4 = $_POST['cum_ret_4'];
			$cum_ret_5 = $_POST['cum_ret_5'];		
			$cum_ret_6 = $_POST['cum_ret_6'];		
			$cum_ret_7 = $_POST['cum_ret_7'];		
			$cum_ret_8 = $_POST['cum_ret_8'];		
			$pass_sample_1 = $_POST['pass_sample_1'];
			$pass_sample_2 = $_POST['pass_sample_2'];
			$pass_sample_3 = $_POST['pass_sample_3'];
			$pass_sample_4 = $_POST['pass_sample_4'];
			$pass_sample_5 = $_POST['pass_sample_5'];		
			$pass_sample_6 = $_POST['pass_sample_6'];						
			$pass_sample_7 = $_POST['pass_sample_7'];						
			$pass_sample_8 = $_POST['pass_sample_8'];						
			$blank_extra = $_POST['blank_extra'];			
			$chk_grd =  $_POST['chk_grd'];	
			$grd_zone =  $_POST['grd_zone'];	
			$grd_fm =  $_POST['grd_fm'];	
			$chk_fm =  $_POST['chk_fm'];	
			$chk_silt =  $_POST['chk_silt'];	
			$silt_content =  $_POST['silt_content'];	
			$silt_1 =  $_POST['silt_1'];	
			$silt_2 =  $_POST['silt_2'];	
			$chk_sp =  $_POST['chk_sp'];
			$sp_sample_ca = $_POST['sp_sample_ca'];
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
			$sp_temp = $_POST['sp_temp'];
			
			$sp_bask_water= $_POST['sp_bask_water'];
			$sp_wt_bas1= $_POST['sp_wt_bas1'];
			$sp_wt_bas2= $_POST['sp_wt_bas2'];
			$sp_apr1= $_POST['sp_apr1'];
			$sp_apr2= $_POST['sp_apr2'];
			$sp_avg_apr= $_POST['sp_avg_apr'];
			
			
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
			$wom1 =  $_POST['wom1'];			
			$wom2 =  $_POST['wom2'];			
			$wom3 =  $_POST['wom3'];
			$avg_wom =  $_POST['avg_wom'];
			$vol =  $_POST['vol'];
			$bdl =  $_POST['bdl'];
			$chk_finer =  $_POST['chk_finer'];
			$finer_a =  $_POST['finer_a'];
			$finer_b =  $_POST['finer_b'];
			$avg_finer =  $_POST['avg_finer'];						
			$chk_sou =  $_POST['chk_sou'];			
			$go1 =  $_POST['go1'];			
			$go2 =  $_POST['go2'];			
			$go3 =  $_POST['go3'];			
			$go4 =  $_POST['go4'];			
			$go5 =  $_POST['go5'];			
			$go6 =  $_POST['go6'];			
			$go7 =  $_POST['go7'];						
			$wt1 =  $_POST['wt1'];			
			$wt2 =  $_POST['wt2'];			
			$wt3 =  $_POST['wt3'];			
			$wt4 =  $_POST['wt4'];			
			$wt5 =  $_POST['wt5'];			
			$wt6 =  $_POST['wt6'];			
			$wt7 =  $_POST['wt7'];						
			$pp1 =  $_POST['pp1'];			
			$pp2 =  $_POST['pp2'];			
			$pp3 =  $_POST['pp3'];			
			$pp4 =  $_POST['pp4'];			
			$pp5 =  $_POST['pp5'];			
			$pp6 =  $_POST['pp6'];			
			$pp7 =  $_POST['pp7'];						
			$wa1 =  $_POST['wa1'];			
			$wa2 =  $_POST['wa2'];			
			$wa3 =  $_POST['wa3'];			
			$wa4 =  $_POST['wa4'];			
			$wa5 =  $_POST['wa5'];			
			$wa6 =  $_POST['wa6'];			
			$wa7 =  $_POST['wa7'];			
			$soundness =  $_POST['soundness'];	

			$chk_aoi = $_POST['chk_aoi'];
			$aoi_1 = $_POST['aoi_1'];
			$aoi_2 = $_POST['aoi_2'];
			$aoi_3 = $_POST['aoi_3'];
			$aoi_4 = $_POST['aoi_4'];
			$chk_pha = $_POST['chk_pha'];
			$ph_s1_1 = $_POST['ph_s1_1'];
			$ph_s1_2 = $_POST['ph_s1_2'];
			$ph_s2_1 = $_POST['ph_s2_1'];
			$ph_s2_2 = $_POST['ph_s2_2'];
			$avg_ph = $_POST['avg_ph'];
			$chk_clr = $_POST['chk_clr'];
			$clr_s1_1 = $_POST['clr_s1_1'];
			$clr_s1_2 = $_POST['clr_s1_2'];
			$clr_s1_3 = $_POST['clr_s1_3'];
			$clr_s1_4 = $_POST['clr_s1_4'];
			$clr_s1_5 = $_POST['clr_s1_5'];
			$clr_s1_6 = $_POST['clr_s1_6'];
			$clr_s1_7 = $_POST['clr_s1_7'];
			$clr_s2_1 = $_POST['clr_s2_1'];
			$clr_s2_2 = $_POST['clr_s2_2'];
			$clr_s2_3 = $_POST['clr_s2_3'];
			$clr_s2_4 = $_POST['clr_s2_4'];
			$clr_s2_5 = $_POST['clr_s2_5'];
			$clr_s2_6 = $_POST['clr_s2_6'];
			$clr_s2_7 = $_POST['clr_s2_7'];
			$avg_clr = $_POST['avg_clr'];
			$chk_slp = $_POST['chk_slp'];
			$slp_s1_1 = $_POST['slp_s1_1'];
			$slp_s1_2 = $_POST['slp_s1_2'];
			$slp_s1_3 = $_POST['slp_s1_3'];
			$slp_s1_4 = $_POST['slp_s1_4'];
			$slp_s1_5 = $_POST['slp_s1_5'];
			$slp_s2_1 = $_POST['slp_s2_1'];
			$slp_s2_2 = $_POST['slp_s2_2'];
			$slp_s2_3 = $_POST['slp_s2_3'];
			$slp_s2_4 = $_POST['slp_s2_4'];
			$slp_s2_5 = $_POST['slp_s2_5'];
			$avg_sul = $_POST['avg_sul'];
			
			$chk_dtm = $_POST['chk_dtm'];
			$dele_1_1 = $_POST['dele_1_1'];
			$dele_1_2 = $_POST['dele_1_2'];
			$dele_1_3 = $_POST['dele_1_3'];
			$dele_1_4 = $_POST['dele_1_4'];
			$dele_2_1 = $_POST['dele_2_1'];
			$dele_2_2 = $_POST['dele_2_2'];
			$dele_2_3 = $_POST['dele_2_3'];
			$dele_3_1 = $_POST['dele_3_1'];
			$dele_3_2 = $_POST['dele_3_2'];
			$dele_3_3 = $_POST['dele_3_3'];
			$dele_3_4 = $_POST['dele_3_4'];
			$dele_4_1 = $_POST['dele_4_1'];
			$dele_4_2 = $_POST['dele_4_2'];
			$dele_4_3 = $_POST['dele_4_3'];
			
			$chk_alk = $_POST['chk_alk'];
			$alk_a1 = $_POST['alk_a1'];
			$alk_a2 = $_POST['alk_a2'];
			$alk_a3 = $_POST['alk_a3'];
			$alk_a4 = $_POST['alk_a4'];
			$alk_a5 = $_POST['alk_a5'];
			$alk_b1 = $_POST['alk_b1'];
			$alk_b2 = $_POST['alk_b2'];
			$alk_b3 = $_POST['alk_b3'];
			$alk_b4 = $_POST['alk_b4'];
			$alk_b5 = $_POST['alk_b5'];
			
			
			$chk_lbd = $_POST['chk_lbd'];
			$lbd_1 = $_POST['lbd_1'];
			$ans_lbd = $_POST['ans_lbd'];
			$chk_fmc = $_POST['chk_fmc'];
			$fmc_sp = $_POST['fmc_sp'];
			$fmc_1 = $_POST['fmc_1'];
			$fmc_2 = $_POST['fmc_2'];
			$fmc_3 = $_POST['fmc_3'];
			$fmc_4 = $_POST['fmc_4'];
			$fmc_5 = $_POST['fmc_5'];
			$fmc_6 = $_POST['fmc_6'];
			$fmc_7 = $_POST['fmc_7'];
			$s_des = $_POST['s_des'];
            $r_sam = $_POST['r_sam'];
			$chk_sil = $_POST['chk_sil'];
			$chk_cal = $_POST['chk_cal'];
			$silt_11 = $_POST['silt_11'];
			$silt_21 = $_POST['silt_21'];
			$silt_3 = $_POST['silt_3'];
			$silt_31 = $_POST['silt_31'];
			$silt_avg = $_POST['silt_avg'];
			$sp_specific_gravity_11 = $_POST['sp_specific_gravity_11'];
			$sp_specific_gravity_22 = $_POST['sp_specific_gravity_22'];
			$sp_specific_gravity1 = $_POST['sp_specific_gravity1'];
			$avg_wom1 = $_POST['avg_wom1'];
			$den_voids1 = $_POST['den_voids1'];
			$weight_1 = $_POST['weight_1'];
			$weight_2 = $_POST['weight_2'];
			$asd_1 = $_POST['asd_1'];
			$asd_2 = $_POST['asd_2'];
			$finer_a1 = $_POST['finer_a1'];
			$finer_b1 = $_POST['finer_b1'];
			$avg_finer1 = $_POST['avg_finer1'];
			$avg_fin_1 = $_POST['avg_fin_1'];
			$avg_fin_2 = $_POST['avg_fin_2'];
			$den_voids_1 = $_POST['den_voids_1'];
			$den_voids = $_POST['den_voids'];
			$den_mo_vol1 = $_POST['den_mo_vol1'];
			$den_mo_vol2 = $_POST['den_mo_vol2'];
			$den_kg_lit = $_POST['den_kg_lit'];
			$den_liter = $_POST['den_liter'];

			
            $s_ret = $_POST['s_ret'];


			
			if($_POST['wtr_s_d'] == ""){$wtr_s_d ="0000-00-00";}
			else{$wtr_s_d = substr($_POST['wtr_s_d'],6,4)."-".substr($_POST['wtr_s_d'],3,2)."-".substr($_POST['wtr_s_d'],0,2);}

			if($_POST['wtr_e_d'] == ""){$wtr_e_d ="0000-00-00";}
			else{$wtr_e_d = substr($_POST['wtr_e_d'],6,4)."-".substr($_POST['wtr_e_d'],3,2)."-".substr($_POST['wtr_e_d'],0,2);}
			
			if($_POST['grd_s_d'] == ""){$grd_s_d ="0000-00-00";}
			else{$grd_s_d = substr($_POST['grd_s_d'],6,4)."-".substr($_POST['grd_s_d'],3,2)."-".substr($_POST['grd_s_d'],0,2);}

			if($_POST['grd_e_d'] == ""){$grd_e_d ="0000-00-00";}
			else{$grd_e_d = substr($_POST['grd_e_d'],6,4)."-".substr($_POST['grd_e_d'],3,2)."-".substr($_POST['grd_e_d'],0,2);}
			
			if($_POST['slt_s_d'] == ""){$slt_s_d ="0000-00-00";}
			else{$slt_s_d = substr($_POST['slt_s_d'],6,4)."-".substr($_POST['slt_s_d'],3,2)."-".substr($_POST['slt_s_d'],0,2);}

			if($_POST['slt_e_d'] == ""){$slt_e_d ="0000-00-00";}
			else{$slt_e_d = substr($_POST['slt_e_d'],6,4)."-".substr($_POST['slt_e_d'],3,2)."-".substr($_POST['slt_e_d'],0,2);}
			
			if($_POST['alk_s_d'] == ""){$alk_s_d ="0000-00-00";}
			else{$alk_s_d = substr($_POST['alk_s_d'],6,4)."-".substr($_POST['alk_s_d'],3,2)."-".substr($_POST['alk_s_d'],0,2);}

			if($_POST['alk_e_d'] == ""){$alk_e_d ="0000-00-00";}
			else{$alk_e_d = substr($_POST['alk_e_d'],6,4)."-".substr($_POST['alk_e_d'],3,2)."-".substr($_POST['alk_e_d'],0,2);}
			
			if($_POST['den_s_d'] == ""){$den_s_d ="0000-00-00";}
			else{$den_s_d = substr($_POST['den_s_d'],6,4)."-".substr($_POST['den_s_d'],3,2)."-".substr($_POST['den_s_d'],0,2);}

			if($_POST['den_e_d'] == ""){$den_e_d ="0000-00-00";}
			else{$den_e_d = substr($_POST['den_e_d'],6,4)."-".substr($_POST['den_e_d'],3,2)."-".substr($_POST['den_e_d'],0,2);}
			
			if($_POST['org_s_d'] == ""){$org_s_d ="0000-00-00";}
			else{$org_s_d = substr($_POST['org_s_d'],6,4)."-".substr($_POST['org_s_d'],3,2)."-".substr($_POST['org_s_d'],0,2);}

			if($_POST['org_e_d'] == ""){$org_e_d ="0000-00-00";}
			else{$org_e_d = substr($_POST['org_e_d'],6,4)."-".substr($_POST['org_e_d'],3,2)."-".substr($_POST['org_e_d'],0,2);}
			
			if($_POST['del_s_d'] == ""){$del_s_d ="0000-00-00";}
			else{$del_s_d = substr($_POST['del_s_d'],6,4)."-".substr($_POST['del_s_d'],3,2)."-".substr($_POST['del_s_d'],0,2);}

			if($_POST['del_e_d'] == ""){$del_e_d ="0000-00-00";}
			else{$del_e_d = substr($_POST['del_e_d'],6,4)."-".substr($_POST['del_e_d'],3,2)."-".substr($_POST['del_e_d'],0,2);}
			
			if($_POST['sou_s_d'] == ""){$sou_s_d ="0000-00-00";}
			else{$sou_s_d = substr($_POST['sou_s_d'],6,4)."-".substr($_POST['sou_s_d'],3,2)."-".substr($_POST['sou_s_d'],0,2);}

			if($_POST['sou_e_d'] == ""){$sou_e_d ="0000-00-00";}
			else{$sou_e_d = substr($_POST['sou_e_d'],6,4)."-".substr($_POST['sou_e_d'],3,2)."-".substr($_POST['sou_e_d'],0,2);}
			
			
			
			$curr_date=date("Y-m-d");
			
		
			
			 $insert="insert into sand (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_grd`, `sieve_1`, `sieve_2`, `sieve_3`, `sieve_4`, `sieve_5`, `sieve_6`, `sieve_7`,`sieve_8`, `cum_wt_gm_1`, `cum_wt_gm_2`, `cum_wt_gm_3`, `cum_wt_gm_4`, `cum_wt_gm_5`, `cum_wt_gm_6`, `cum_wt_gm_7`, `cum_wt_gm_8`, `ret_wt_gm_1`, `ret_wt_gm_2`, `ret_wt_gm_3`, `ret_wt_gm_4`, `ret_wt_gm_5`, `ret_wt_gm_6`, `ret_wt_gm_7`, `ret_wt_gm_8`, `cum_ret_1`, `cum_ret_2`, `cum_ret_3`, `cum_ret_4`, `cum_ret_5`, `cum_ret_6`, `cum_ret_7`, `cum_ret_8`, `pass_sample_1`, `pass_sample_2`, `pass_sample_3`, `pass_sample_4`, `pass_sample_5`, `pass_sample_6`, `pass_sample_7`, `pass_sample_8`, `blank_extra`, `grd_zone`, `chk_fm`, `grd_fm`, `sample_taken`, `chk_sp`, `sp_temp`, `sp_sample_ca`, `sp_wt_st_1`, `sp_wt_st_2`, `sp_w_sur_1`, `sp_w_sur_2`, `sp_w_s_1`, `sp_w_s_2`, `sp_specific_gravity_1`, `sp_specific_gravity_2`, `sp_specific_gravity`, `sp_water_abr_1`, `sp_water_abr_2`, `sp_water_abr`, `chk_den`, `m11`, `m12`, `m13`, `m21`, `m22`, `m23`,`m31`, `m32`, `m33`, `wom1`, `wom2`, `wom3`, `avg_wom`, `vol`, `bdl`, `chk_silt`, `silt_content`, `silt_1`, `silt_2`, `chk_finer`, `finer_a`, `finer_b`, `avg_finer`, `chk_sou`, `go1`, `go2`, `go3`, `go4`, `go5`, `go6`, `go7`, `wt1`, `wt2`, `wt3`, `wt4`, `wt5`, `wt6`, `wt7`, `pp1`, `pp2`, `pp3`, `pp4`, `pp5`, `pp6`, `pp7`, `wa1`, `wa2`, `wa3`, `wa4`, `wa5`, `wa6`, `wa7`, `soundness`, `chk_pha`, `ph_s1_1`, `ph_s1_2`, `ph_s2_1`, `ph_s2_2`, `avg_ph`, `chk_clr`, `clr_s1_1`, `clr_s1_2`, `clr_s1_3`, `clr_s1_4`, `clr_s1_5`, `clr_s1_6`, `clr_s1_7`, `clr_s2_1`, `clr_s2_2`, `clr_s2_3`, `clr_s2_4`, `clr_s2_5`, `clr_s2_6`, `clr_s2_7`, `avg_clr`, `chk_slp`, `slp_s1_1`, `slp_s1_2`, `slp_s1_3`, `slp_s1_4`, `slp_s1_5`, `slp_s2_1`, `slp_s2_2`, `slp_s2_3`, `slp_s2_4`, `slp_s2_5`, `avg_sul`, `chk_dtm`, `dele_1_1`, `dele_1_2`, `dele_1_3`, `dele_1_4`, `dele_2_1`, `dele_2_2`, `dele_2_3`, `dele_3_1`, `dele_3_2`, `dele_3_3`, `dele_3_4`, `dele_4_1`, `dele_4_2`, `dele_4_3`, `chk_aoi`, `aoi_1`, `aoi_2`, `aoi_3`, `aoi_4`,`sp_bask_water`,`sp_wt_bas1`,`sp_wt_bas2`,`sp_apr1`,`sp_apr2`, `sp_avg_apr`, `chk_alk`, `alk_a1`, `alk_a2`, `alk_a3`, `alk_a4`, `alk_a5`, `alk_b1`, `alk_b2`, `alk_b3`, `alk_b4`, `alk_b5`, `wtr_s_d`, `wtr_e_d`, `grd_s_d`, `grd_e_d`, `slt_s_d`, `slt_e_d`, `alk_s_d`, `alk_e_d`, `den_s_d`, `den_e_d`, `org_s_d`, `org_e_d`, `del_s_d`, `del_e_d`, `sou_s_d`, `sou_e_d`, `chk_lbd`, `lbd_1`, `ans_lbd`, `chk_fmc`, `fmc_sp`, `fmc_1`, `fmc_2`, `fmc_3`, `fmc_4`, `fmc_5`, `fmc_6`, `fmc_7`,`s_des`,`r_sam`,`s_ret`,`chk_sil`,`chk_cal`,`silt_11`,`silt_21`,`silt_3`,`silt_31`,`silt_avg`,`sp_specific_gravity_11`,`sp_specific_gravity_22`,`sp_specific_gravity1`,`avg_wom1`,`den_voids1`,`weight_1`,`weight_2`,`asd_1`,`asd_2`,`finer_a1`,`finer_b1`,`avg_finer1`,`avg_fin_1`,`avg_fin_2`,`den_voids_1`,`den_voids`,`den_mo_vol1`,`den_mo_vol2`,`den_kg_lit`,`den_liter`) values('$report_no', '$ulr', '$job_no', '$lab_no', '0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_grd', '$sieve_1', '$sieve_2', '$sieve_3', '$sieve_4', '$sieve_5', '$sieve_6', '$sieve_7', '$sieve_8', '$cum_wt_gm_1', '$cum_wt_gm_2', '$cum_wt_gm_3', '$cum_wt_gm_4', '$cum_wt_gm_5', '$cum_wt_gm_6', '$cum_wt_gm_7', '$cum_wt_gm_8', '$ret_wt_gm_1', '$ret_wt_gm_2', '$ret_wt_gm_3', '$ret_wt_gm_4', '$ret_wt_gm_5', '$ret_wt_gm_6', '$ret_wt_gm_7', '$ret_wt_gm_8', '$cum_ret_1', '$cum_ret_2', '$cum_ret_3', '$cum_ret_4', '$cum_ret_5', '$cum_ret_6', '$cum_ret_7', '$cum_ret_8', '$pass_sample_1', '$pass_sample_2', '$pass_sample_3', '$pass_sample_4', '$pass_sample_5', '$pass_sample_6', '$pass_sample_7', '$pass_sample_8', '$blank_extra', '$grd_zone', '$chk_fm', '$grd_fm', '$sample_taken', '$chk_sp', '$sp_temp', '$sp_sample_ca', '$sp_wt_st_1', '$sp_wt_st_2', '$sp_w_sur_1', '$sp_w_sur_2', '$sp_w_s_1', '$sp_w_s_2', '$sp_specific_gravity_1', '$sp_specific_gravity_2', '$sp_specific_gravity', '$sp_water_abr_1', '$sp_water_abr_2', '$sp_water_abr', '$chk_den', '$m11', '$m12', '$m13', '$m21', '$m22', '$m23', '$m31', '$m32', '$m33', '$wom1', '$wom2', '$wom3', '$avg_wom', '$vol', '$bdl', '$chk_silt', '$silt_content', '$silt_1', '$silt_2', '$chk_finer', '$finer_a', '$finer_b', '$avg_finer', '$chk_sou', '$go1', '$go2', '$go3', '$go4', '$go5', '$go6', '$go7', '$wt1', '$wt2', '$wt3', '$wt4', '$wt5', '$wt6', '$wt7', '$pp1', '$pp2', '$pp3', '$pp4', '$pp5', '$pp6', '$pp7', '$wa1', '$wa2', '$wa3', '$wa4', '$wa5', '$wa6', '$wa7', '$soundness', '$chk_pha', '$ph_s1_1', '$ph_s1_2', '$ph_s2_1', '$ph_s2_2', '$avg_ph', '$chk_clr', '$clr_s1_1', '$clr_s1_2', '$clr_s1_3', '$clr_s1_4', '$clr_s1_5', '$clr_s1_6', '$clr_s1_7', '$clr_s2_1', '$clr_s2_2', '$clr_s2_3', '$clr_s2_4', '$clr_s2_5', '$clr_s2_6', '$clr_s2_7', '$avg_clr', '$chk_slp', '$slp_s1_1', '$slp_s1_2', '$slp_s1_3', '$slp_s1_4', '$slp_s1_5', '$slp_s2_1', '$slp_s2_2', '$slp_s2_3', '$slp_s2_4', '$slp_s2_5', '$avg_sul', '$chk_dtm', '$dele_1_1', '$dele_1_2', '$dele_1_3', '$dele_1_4', '$dele_2_1', '$dele_2_2', '$dele_2_3', '$dele_3_1', '$dele_3_2', '$dele_3_3', '$dele_3_4', '$dele_4_1', '$dele_4_2', '$dele_4_3', '$chk_aoi', '$aoi_1', '$aoi_2', '$aoi_3', '$aoi_4','$sp_bask_water', '$sp_wt_bas1', '$sp_wt_bas2', '$sp_apr1', '$sp_apr2', '$sp_avg_apr', '$chk_alk', '$alk_a1', '$alk_a2', '$alk_a3', '$alk_a4', '$alk_a5', '$alk_b1', '$alk_b2', '$alk_b3', '$alk_b4', '$alk_b5', '$wtr_s_d', '$wtr_e_d', '$grd_s_d', '$grd_e_d', '$slt_s_d', '$slt_e_d', '$alk_s_d', '$alk_e_d', '$den_s_d', '$den_e_d', '$org_s_d', '$org_e_d', '$del_s_d', '$del_e_d', '$sou_s_d', '$sou_e_d', '$chk_lbd', '$lbd_1', '$ans_lbd', '$chk_fmc', '$fmc_sp', '$fmc_1', '$fmc_2', '$fmc_3', '$fmc_4', '$fmc_5', '$fmc_6', '$fmc_7','$s_des','$r_sam','$s_ret','$chk_sil','$chk_cal','$silt_11','$silt_21','$silt_3','$silt_31','$silt_avg','$sp_specific_gravity_11','$sp_specific_gravity_22','$sp_specific_gravity1','$avg_wom1','$den_voids1','$weight_1','$weight_2','$asd_1','$asd_2','$finer_a1','$finer_b1','$avg_finer1','$avg_fin_1','$avg_fin_2','$den_voids_1','$den_voids','$den_mo_vol1','$den_mo_vol2','$den_kg_lit','$den_liter')";
				
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
													 $query = "select * from sand WHERE lab_no='$lab_no' and `is_deleted`='0'";

														$result = mysqli_query($conn, $query);
									

														if (mysqli_num_rows($result) > 0) {
													while($r = mysqli_fetch_array($result)){
																if($r['is_deleted'] == 0){
																?>
																<tr>
																<td style="text-align:center;" width="10%">		
																<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
																<?php
																//	$val =  $_SESSION['isadmin'];
																//	if($val == 0 || $val == 5){
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
		
		
		$curr_date=date("Y-m-d");
		if($_POST['wtr_s_d'] == ""){$wtr_s_d ="0000-00-00";}
			else{$wtr_s_d = substr($_POST['wtr_s_d'],6,4)."-".substr($_POST['wtr_s_d'],3,2)."-".substr($_POST['wtr_s_d'],0,2);}

			if($_POST['wtr_e_d'] == ""){$wtr_e_d ="0000-00-00";}
			else{$wtr_e_d = substr($_POST['wtr_e_d'],6,4)."-".substr($_POST['wtr_e_d'],3,2)."-".substr($_POST['wtr_e_d'],0,2);}
			
			if($_POST['grd_s_d'] == ""){$grd_s_d ="0000-00-00";}
			else{$grd_s_d = substr($_POST['grd_s_d'],6,4)."-".substr($_POST['grd_s_d'],3,2)."-".substr($_POST['grd_s_d'],0,2);}

			if($_POST['grd_e_d'] == ""){$grd_e_d ="0000-00-00";}
			else{$grd_e_d = substr($_POST['grd_e_d'],6,4)."-".substr($_POST['grd_e_d'],3,2)."-".substr($_POST['grd_e_d'],0,2);}
			
			if($_POST['slt_s_d'] == ""){$slt_s_d ="0000-00-00";}
			else{$slt_s_d = substr($_POST['slt_s_d'],6,4)."-".substr($_POST['slt_s_d'],3,2)."-".substr($_POST['slt_s_d'],0,2);}

			if($_POST['slt_e_d'] == ""){$slt_e_d ="0000-00-00";}
			else{$slt_e_d = substr($_POST['slt_e_d'],6,4)."-".substr($_POST['slt_e_d'],3,2)."-".substr($_POST['slt_e_d'],0,2);}
			
			if($_POST['alk_s_d'] == ""){$alk_s_d ="0000-00-00";}
			else{$alk_s_d = substr($_POST['alk_s_d'],6,4)."-".substr($_POST['alk_s_d'],3,2)."-".substr($_POST['alk_s_d'],0,2);}

			if($_POST['alk_e_d'] == ""){$alk_e_d ="0000-00-00";}
			else{$alk_e_d = substr($_POST['alk_e_d'],6,4)."-".substr($_POST['alk_e_d'],3,2)."-".substr($_POST['alk_e_d'],0,2);}
			
			if($_POST['den_s_d'] == ""){$den_s_d ="0000-00-00";}
			else{$den_s_d = substr($_POST['den_s_d'],6,4)."-".substr($_POST['den_s_d'],3,2)."-".substr($_POST['den_s_d'],0,2);}

			if($_POST['den_e_d'] == ""){$den_e_d ="0000-00-00";}
			else{$den_e_d = substr($_POST['den_e_d'],6,4)."-".substr($_POST['den_e_d'],3,2)."-".substr($_POST['den_e_d'],0,2);}
			
			if($_POST['org_s_d'] == ""){$org_s_d ="0000-00-00";}
			else{$org_s_d = substr($_POST['org_s_d'],6,4)."-".substr($_POST['org_s_d'],3,2)."-".substr($_POST['org_s_d'],0,2);}

			if($_POST['org_e_d'] == ""){$org_e_d ="0000-00-00";}
			else{$org_e_d = substr($_POST['org_e_d'],6,4)."-".substr($_POST['org_e_d'],3,2)."-".substr($_POST['org_e_d'],0,2);}
			
			if($_POST['del_s_d'] == ""){$del_s_d ="0000-00-00";}
			else{$del_s_d = substr($_POST['del_s_d'],6,4)."-".substr($_POST['del_s_d'],3,2)."-".substr($_POST['del_s_d'],0,2);}

			if($_POST['del_e_d'] == ""){$del_e_d ="0000-00-00";}
			else{$del_e_d = substr($_POST['del_e_d'],6,4)."-".substr($_POST['del_e_d'],3,2)."-".substr($_POST['del_e_d'],0,2);}
			
			if($_POST['sou_s_d'] == ""){$sou_s_d ="0000-00-00";}
			else{$sou_s_d = substr($_POST['sou_s_d'],6,4)."-".substr($_POST['sou_s_d'],3,2)."-".substr($_POST['sou_s_d'],0,2);}

			if($_POST['sou_e_d'] == ""){$sou_e_d ="0000-00-00";}
			else{$sou_e_d = substr($_POST['sou_e_d'],6,4)."-".substr($_POST['sou_e_d'],3,2)."-".substr($_POST['sou_e_d'],0,2);}
			
		$update="update sand SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',`chk_grd`='$_POST[chk_grd]',`sieve_1`='$_POST[sieve_1]',`sieve_2`='$_POST[sieve_2]',`sieve_3`='$_POST[sieve_3]',`sieve_4`='$_POST[sieve_4]',`sieve_5`='$_POST[sieve_5]',`sieve_6`='$_POST[sieve_6]',`sieve_7`='$_POST[sieve_7]',`sieve_8`='$_POST[sieve_8]',`cum_wt_gm_1`='$_POST[cum_wt_gm_1]',`cum_wt_gm_2`='$_POST[cum_wt_gm_2]',`cum_wt_gm_3`='$_POST[cum_wt_gm_3]',`cum_wt_gm_4`='$_POST[cum_wt_gm_4]',`cum_wt_gm_5`='$_POST[cum_wt_gm_5]',`cum_wt_gm_6`='$_POST[cum_wt_gm_6]',`cum_wt_gm_7`='$_POST[cum_wt_gm_7]',`cum_wt_gm_8`='$_POST[cum_wt_gm_8]',`ret_wt_gm_1`='$_POST[ret_wt_gm_1]',`ret_wt_gm_2`='$_POST[ret_wt_gm_2]',`ret_wt_gm_3`='$_POST[ret_wt_gm_3]',`ret_wt_gm_4`='$_POST[ret_wt_gm_4]',`ret_wt_gm_5`='$_POST[ret_wt_gm_5]',`ret_wt_gm_6`='$_POST[ret_wt_gm_6]',`ret_wt_gm_7`='$_POST[ret_wt_gm_7]',`ret_wt_gm_8`='$_POST[ret_wt_gm_8]',`cum_ret_1`='$_POST[cum_ret_1]',`cum_ret_2`='$_POST[cum_ret_2]',`cum_ret_3`='$_POST[cum_ret_3]',`cum_ret_4`='$_POST[cum_ret_4]',`cum_ret_5`='$_POST[cum_ret_5]',`cum_ret_6`='$_POST[cum_ret_6]',`cum_ret_7`='$_POST[cum_ret_7]',`cum_ret_8`='$_POST[cum_ret_8]',`pass_sample_1`='$_POST[pass_sample_1]',`pass_sample_2`='$_POST[pass_sample_2]',`pass_sample_3`='$_POST[pass_sample_3]',`pass_sample_4`='$_POST[pass_sample_4]',`pass_sample_5`='$_POST[pass_sample_5]',`pass_sample_6`='$_POST[pass_sample_6]',`pass_sample_7`='$_POST[pass_sample_7]',`pass_sample_8`='$_POST[pass_sample_8]',`blank_extra`='$_POST[blank_extra]',`sample_taken`='$_POST[sample_taken]',`grd_zone`='$_POST[grd_zone]',`chk_fm`='$_POST[chk_fm]',`grd_fm`='$_POST[grd_fm]',`chk_silt`='$_POST[chk_silt]',`silt_content`='$_POST[silt_content]',`chk_sp`='$_POST[chk_sp]',`sp_sample_ca`='$_POST[sp_sample_ca]',`sp_temp`='$_POST[sp_temp]',`sp_wt_st_1`='$_POST[sp_wt_st_1]',`sp_wt_st_2`='$_POST[sp_wt_st_2]',`sp_w_sur_1`='$_POST[sp_w_sur_1]',`sp_w_sur_2`='$_POST[sp_w_sur_2]',`sp_w_s_1`='$_POST[sp_w_s_1]',`sp_w_s_2`='$_POST[sp_w_s_2]',`sp_specific_gravity_1`='$_POST[sp_specific_gravity_1]',`sp_specific_gravity_2`='$_POST[sp_specific_gravity_2]',`sp_specific_gravity`='$_POST[sp_specific_gravity]',`sp_water_abr_1`='$_POST[sp_water_abr_1]',`sp_water_abr_2`='$_POST[sp_water_abr_2]',`sp_water_abr`='$_POST[sp_water_abr]',`modified_by`='$_SESSION[name]',`modified_date`='$curr_date',`silt_1`='$_POST[silt_1]',`silt_2`='$_POST[silt_2]',`chk_den`='$_POST[chk_den]',`m11`='$_POST[m11]',`m12`='$_POST[m12]',`m13`='$_POST[m13]',`m21`='$_POST[m21]',`m22`='$_POST[m22]',`m23`='$_POST[m23]',`m31`='$_POST[m31]',`m32`='$_POST[m32]',`m33`='$_POST[m33]',`wom1`='$_POST[wom1]',`wom2`='$_POST[wom2]',`wom3`='$_POST[wom3]',`avg_wom`='$_POST[avg_wom]',`vol`='$_POST[vol]',`bdl`='$_POST[bdl]',`chk_finer`='$_POST[chk_finer]',`finer_a`='$_POST[finer_a]',`finer_b`='$_POST[finer_b]',`avg_finer`='$_POST[avg_finer]',`chk_sou`='$_POST[chk_sou]',`soundness`='$_POST[soundness]',`go1`='$_POST[go1]',`go2`='$_POST[go2]',`go3`='$_POST[go3]',`go4`='$_POST[go4]',`go5`='$_POST[go5]',`go6`='$_POST[go6]',`go7`='$_POST[go7]',`wt1`='$_POST[wt1]',`wt2`='$_POST[wt2]',`wt3`='$_POST[wt3]',`wt4`='$_POST[wt4]',`wt5`='$_POST[wt5]',`wt6`='$_POST[wt6]',`wt7`='$_POST[wt7]',`pp1`='$_POST[pp1]',`pp2`='$_POST[pp2]',`pp3`='$_POST[pp3]',`pp4`='$_POST[pp4]',`pp5`='$_POST[pp5]',`pp6`='$_POST[pp6]',`pp7`='$_POST[pp7]',`wa1`='$_POST[wa1]',`wa2`='$_POST[wa2]',`wa3`='$_POST[wa3]',`wa4`='$_POST[wa4]',`wa5`='$_POST[wa5]',`wa6`='$_POST[wa6]',
		 `wa7`='$_POST[wa7]',
		 `chk_pha` = '$_POST[chk_pha]',
	  `chk_aoi` = '$_POST[chk_aoi]',
	  `aoi_1` = '$_POST[aoi_1]',
	  `aoi_2` = '$_POST[aoi_2]',
	  `aoi_3` = '$_POST[aoi_3]',
	  `aoi_4` = '$_POST[aoi_4]',
	  `ph_s1_1` = '$_POST[ph_s1_1]',
	  `ph_s1_2` = '$_POST[ph_s1_2]',
	  `ph_s2_1` = '$_POST[ph_s2_1]',
	  `ph_s2_2` = '$_POST[ph_s2_2]',
	  `avg_ph` = '$_POST[avg_ph]',
	  `chk_clr` = '$_POST[chk_clr]',
	  `clr_s1_1` = '$_POST[clr_s1_1]',
	  `clr_s1_2` = '$_POST[clr_s1_2]',
	  `clr_s1_3` = '$_POST[clr_s1_3]',
	  `clr_s1_4` = '$_POST[clr_s1_4]',
	  `clr_s1_5` = '$_POST[clr_s1_5]',
	  `clr_s1_6` = '$_POST[clr_s1_6]',
	  `clr_s1_7` = '$_POST[clr_s1_7]',
	  `clr_s2_1` = '$_POST[clr_s2_1]',
	  `clr_s2_2` = '$_POST[clr_s2_2]',
	  `clr_s2_3` = '$_POST[clr_s2_3]',
	  `clr_s2_4` = '$_POST[clr_s2_4]',
	  `clr_s2_5` = '$_POST[clr_s2_5]',
	  `clr_s2_6` = '$_POST[clr_s2_6]',
	  `clr_s2_7` = '$_POST[clr_s2_7]',
	  `avg_clr` = '$_POST[avg_clr]',
	  `chk_slp` = '$_POST[chk_slp]',
	  `slp_s1_1` = '$_POST[slp_s1_1]',
	  `slp_s1_2` = '$_POST[slp_s1_2]',
	  `slp_s1_3` = '$_POST[slp_s1_3]',
	  `slp_s1_4` = '$_POST[slp_s1_4]',
	  `slp_s1_5` = '$_POST[slp_s1_5]',
	  `slp_s2_1` = '$_POST[slp_s2_1]',
	  `slp_s2_2` = '$_POST[slp_s2_2]',
	  `slp_s2_3` = '$_POST[slp_s2_3]',
	  `slp_s2_4` = '$_POST[slp_s2_4]',
	  `slp_s2_5` = '$_POST[slp_s2_5]',
	  `avg_sul` = '$_POST[avg_sul]',
	  `chk_alk` = '$_POST[chk_alk]',
	  `alk_a1` = '$_POST[alk_a1]',
	  `alk_a2` = '$_POST[alk_a2]',
	  `alk_a3` = '$_POST[alk_a3]',
	  `alk_a4` = '$_POST[alk_a4]',
	  `alk_a5` = '$_POST[alk_a5]',
	  `alk_b1` = '$_POST[alk_b1]',
	  `alk_b2` = '$_POST[alk_b2]',
	  `alk_b3` = '$_POST[alk_b3]',
	  `alk_b4` = '$_POST[alk_b4]',
	  `alk_b5` = '$_POST[alk_b5]',
	  `chk_dtm` = '$_POST[chk_dtm]',
	  `dele_1_1` = '$_POST[dele_1_1]',
	  `dele_1_2` = '$_POST[dele_1_2]',
	  `dele_1_3` = '$_POST[dele_1_3]',
	  `dele_1_4` = '$_POST[dele_1_4]',
	  `dele_2_1` = '$_POST[dele_2_1]',
	  `dele_2_2` = '$_POST[dele_2_2]',
	  `dele_2_3` = '$_POST[dele_2_3]',
	  `dele_3_1` = '$_POST[dele_3_1]',
	  `dele_3_2` = '$_POST[dele_3_2]',
	  `dele_3_3` = '$_POST[dele_3_3]',
	  `dele_3_4` = '$_POST[dele_3_4]',
	  `dele_4_1` = '$_POST[dele_4_1]',
	  `dele_4_2` = '$_POST[dele_4_2]',
	  `dele_4_3` = '$_POST[dele_4_3]',
	  `sp_bask_water` = '$_POST[sp_bask_water]',
	  `sp_wt_bas1` = '$_POST[sp_wt_bas1]',
	  `sp_wt_bas2` = '$_POST[sp_wt_bas2]',
	  `sp_apr1` = '$_POST[sp_apr1]',
	  `sp_apr2` = '$_POST[sp_apr2]',
	  `sp_avg_apr` = '$_POST[sp_avg_apr]',
	    `grd_s_d`='$grd_s_d',
		`grd_e_d`='$grd_e_d',
		`wtr_s_d`='$wtr_s_d',
		`wtr_e_d`='$wtr_e_d',
		`slt_s_d`='$slt_s_d',
		`slt_e_d`='$slt_e_d',
		`alk_s_d`='$alk_s_d',
		`alk_e_d`='$alk_e_d',
		`den_s_d`='$den_s_d',
		`den_e_d`='$den_e_d',
		`org_s_d`='$org_s_d',
		`org_e_d`='$org_e_d',
		`del_s_d`='$del_s_d',
		`del_e_d`='$del_e_d',
		`sou_s_d`='$sou_s_d',
		`sou_e_d`='$sou_e_d',
		`chk_lbd` = '$_POST[chk_lbd]',
		`lbd_1` = '$_POST[lbd_1]',
		`ans_lbd` = '$_POST[ans_lbd]',
		`chk_fmc` = '$_POST[chk_fmc]',
		`fmc_sp` = '$_POST[fmc_sp]',
		`fmc_1` = '$_POST[fmc_1]',
		`fmc_2` = '$_POST[fmc_2]',
		`fmc_3` = '$_POST[fmc_3]',
		`fmc_4` = '$_POST[fmc_4]',
		`fmc_5` = '$_POST[fmc_5]',
		`fmc_6` = '$_POST[fmc_6]',
		`fmc_7` = '$_POST[fmc_7]',
		`s_des`='$_POST[s_des]',
        `r_sam`='$_POST[r_sam]',
		`chk_sil`='$_POST[chk_sil]',
		`chk_cal`='$_POST[chk_cal]',
		`silt_11`='$_POST[silt_11]',
		`silt_21`='$_POST[silt_21]',
		`silt_3`='$_POST[silt_3]',
		`silt_31`='$_POST[silt_31]',
		`silt_avg`='$_POST[silt_avg]',
		`sp_specific_gravity_11`='$_POST[sp_specific_gravity_11]',
		`sp_specific_gravity_22`='$_POST[sp_specific_gravity_22]',
		`sp_specific_gravity1`='$_POST[sp_specific_gravity1]',
		`avg_wom1`='$_POST[avg_wom1]',
		`den_voids1`='$_POST[den_voids1]',
		`weight_1`='$_POST[weight_1]',
		`weight_2`='$_POST[weight_2]',
		`asd_1`='$_POST[asd_1]',
		`asd_2`='$_POST[asd_2]',
		`finer_a1`='$_POST[finer_a1]',
		`finer_b1`='$_POST[finer_b1]',
		`avg_finer1`='$_POST[avg_finer1]',
		`avg_fin_1`='$_POST[avg_fin_1]',
		`avg_fin_2`='$_POST[avg_fin_2]',
		`den_voids_1`='$_POST[den_voids_1]',
		`den_voids`='$_POST[den_voids]',
		`den_mo_vol1`='$_POST[den_mo_vol1]',
		`den_mo_vol2`='$_POST[den_mo_vol2]',
		`den_kg_lit`='$_POST[den_kg_lit]',
		`den_liter`='$_POST[den_liter]',
		
        `s_ret`='$_POST[s_ret]',

	   `checked_by`=NULL WHERE `id`='$_POST[idEdit]'"; 
		 
		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update sand SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM sand WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update sand SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update sand SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
    exit;
	
}
?>