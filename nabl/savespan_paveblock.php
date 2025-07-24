<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from span_paver_block WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
			$select_result = mysqli_query($conn, $get_query);
			$result=mysqli_fetch_array($select_result);
			$id=$result['id'];
			$report_no=$result['report_no'];
			$job_no=$result['job_no'];
			$lab_no=$result['lab_no'];	
			$fill = array(
							'id' => $id,
							'report_no' => $report_no,
							'job_no' => $job_no,
							'lab_no' => $lab_no,
							'ulr' => $result['ulr'],
							'chk_com' => $result['chk_com'],
							'chk_wtr' => $result['chk_wtr'],
							'avg_wtr' => $result['avg_wtr'],
							'avg_corr' => $result['avg_corr'],		
							'avg_den' => $result['avg_den'],
							'paver_shape' => $result['paver_shape'],
							'paver_age' => $result['paver_age'],
							'paver_color' => $result['paver_color'],
							'paver_thickness' => $result['paver_thickness'],							
							'paver_grade' => $result['paver_grade'],							
							'lab_1' => $result['lab_1'],							
							'lab_2' => $result['lab_2'],							
							'lab_3' => $result['lab_3'],
							'lab_4' => $result['lab_4'],							
							'lab_5' => $result['lab_5'],							
							'lab_6' => $result['lab_6'],							
							'lab_7' => $result['lab_7'],							
							'lab_8' => $result['lab_8'],
							'm1' => $result['m1'],							
							'm2' => $result['m2'],							
							'm3' => $result['m3'],
							'm4' => $result['m4'],							
							'm5' => $result['m5'],							
							'm6' => $result['m6'],							
							'm7' => $result['m7'],							
							'm8' => $result['m8'],
							'grade' => $result['grade'],							
							'thick' => $result['thick'],							
							'factor' => $result['factor'],
							'wtr_w1_1' => $result['wtr_w1_1'],							
							'wtr_w1_2' => $result['wtr_w1_2'],							
							'wtr_w1_3' => $result['wtr_w1_3'],
							'wtr_w2_1' => $result['wtr_w2_1'],							
							'wtr_w2_2' => $result['wtr_w2_2'],							
							'wtr_w2_3' => $result['wtr_w2_3'],
						    'wtr_1' => $result['wtr_1'],							
							'wtr_2' => $result['wtr_2'],							
							'wtr_3' => $result['wtr_3'],
							'area_1' => $result['area_1'],							
							'area_2' => $result['area_2'],							
							'area_3' => $result['area_3'],
							'area_4' => $result['area_4'],							
							'area_5' => $result['area_5'],							
							'area_6' => $result['area_6'],							
							'area_7' => $result['area_7'],							
							'area_8' => $result['area_8'],
							'load_1' => $result['load_1'],							
							'load_2' => $result['load_2'],							
							'load_3' => $result['load_3'],
							'load_4' => $result['load_4'],							
							'load_5' => $result['load_5'],							
							'load_6' => $result['load_6'],							
							'load_7' => $result['load_7'],							
							'load_8' => $result['load_8'],
							'com_1' => $result['com_1'],							
							'com_2' => $result['com_2'],							
							'com_3' => $result['com_3'],
							'com_4' => $result['com_4'],							
							'com_5' => $result['com_5'],							
							'com_6' => $result['com_6'],							
							'com_7' => $result['com_7'],							
							'com_8' => $result['com_8'],
							'corr_1' => $result['corr_1'],							
							'corr_2' => $result['corr_2'],							
							'corr_3' => $result['corr_3'],
							'corr_4' => $result['corr_4'],							
							'corr_5' => $result['corr_5'],							
							'corr_6' => $result['corr_6'],							
							'corr_7' => $result['corr_7'],							
							'corr_8' => $result['corr_8'],
							'den_1' => $result['den_1'],							
							'den_2' => $result['den_2'],							
							'den_3' => $result['den_3'],
							'den_4' => $result['den_4'],							
							'den_5' => $result['den_5'],							
							'den_6' => $result['den_6'],							
							'den_7' => $result['den_7'],							
							'den_8' => $result['den_8'],
							'sm1' => $result['sm1'],
							'sm2' => $result['sm2'],
							'sm3' => $result['sm3'],
							'sm4' => $result['sm4'],
							'sm5' => $result['sm5'],
							'sm6' => $result['sm6'],
							'sm7' => $result['sm7'],
							'sm8' => $result['sm8'],
							'sm9' => $result['sm9'],
							'sm10' => $result['sm10'],
							'sm11' => $result['sm11'],
							'sm12' => $result['sm12'],
							'sm13' => $result['sm13'],
							'sm14' => $result['sm14'],
							'sm15' => $result['sm15'],							
							'sm16' => $result['sm16'],
							'sm17' => $result['sm17'],
							'sm18' => $result['sm18'],
							'sm19' => $result['sm19'],
							'sm20' => $result['sm20'],
							'sm21' => $result['sm21'],
							'sm22' => $result['sm22'],
							'sm23' => $result['sm23'],
							'sm24' => $result['sm24'],
							'sm25' => $result['sm25'],
							'sm26' => $result['sm26'],
							'sm27' => $result['sm27'],
							'sm28' => $result['sm28'],
							'sm29' => $result['sm29'],
							'sm30' => $result['sm30'],																												
							
							'chk_ten' => $result['chk_ten'],
							't11' => $result['t11'],
							't12' => $result['t12'],
							't13' => $result['t13'],
							't14' => $result['t14'],
							't15' => $result['t15'],
							't16' => $result['t16'],
							't17' => $result['t17'],
							't18' => $result['t18'],
							't21' => $result['t21'],
							't22' => $result['t22'],
							't23' => $result['t23'],
							't24' => $result['t24'],
							't25' => $result['t25'],
							't26' => $result['t26'],
							't27' => $result['t27'],
							't28' => $result['t28'],
							't31' => $result['t31'],
							't32' => $result['t32'],
							't33' => $result['t33'],
							't34' => $result['t34'],
							't35' => $result['t35'],
							't36' => $result['t36'],
							't37' => $result['t37'],
							't38' => $result['t38'],
							'avgt1' => $result['avgt1'],
							'avgt2' => $result['avgt2'],
							'avgt3' => $result['avgt3'],
							'avgt4' => $result['avgt4'],
							'avgt5' => $result['avgt5'],
							'avgt6' => $result['avgt6'],
							'avgt7' => $result['avgt7'],
							'avgt8' => $result['avgt8'],
							'f11' => $result['f11'],
							'f12' => $result['f12'],
							'f13' => $result['f13'],
							'f14' => $result['f14'],
							'f15' => $result['f15'],
							'f16' => $result['f16'],
							'f17' => $result['f17'],
							'f18' => $result['f18'],
							'f21' => $result['f21'],
							'f22' => $result['f22'],
							'f23' => $result['f23'],
							'f24' => $result['f24'],
							'f25' => $result['f25'],
							'f26' => $result['f26'],
							'f27' => $result['f27'],
							'f28' => $result['f28'],
							'avgf1' => $result['avgf1'],
							'avgf2' => $result['avgf2'],
							'avgf3' => $result['avgf3'],
							'avgf4' => $result['avgf4'],
							'avgf5' => $result['avgf5'],
							'avgf6' => $result['avgf6'],
							'avgf7' => $result['avgf7'],
							'avgf8' => $result['avgf8'],
							'farea1' => $result['farea1'],
							'farea2' => $result['farea2'],
							'farea3' => $result['farea3'],
							'farea4' => $result['farea4'],
							'farea5' => $result['farea5'],
							'farea6' => $result['farea6'],
							'farea7' => $result['farea7'],
							'farea8' => $result['farea8'],
							'spload1' => $result['spload1'],
							'spload2' => $result['spload2'],
							'spload3' => $result['spload3'],
							'spload4' => $result['spload4'],
							'spload5' => $result['spload5'],
							'spload6' => $result['spload6'],
							'spload7' => $result['spload7'],
							'spload8' => $result['spload8'],
							'sten1' => $result['sten1'],
							'sten2' => $result['sten2'],
							'sten3' => $result['sten3'],
							'sten4' => $result['sten4'],
							'sten5' => $result['sten5'],
							'sten6' => $result['sten6'],
							'sten7' => $result['sten7'],
							'sten8' => $result['sten8'],
							'fload1' => $result['fload1'],
							'fload2' => $result['fload2'],
							'fload3' => $result['fload3'],
							'fload4' => $result['fload4'],
							'fload5' => $result['fload5'],
							'fload6' => $result['fload6'],
							'fload7' => $result['fload7'],
							'fload8' => $result['fload8'],
							'avg_tensile' => $result['avg_tensile'],
							'avg_load' => $result['avg_load'],
							'chk_fle' => $result['chk_fle'],
							'flen1' => $result['flen1'],
							'flen2' => $result['flen2'],
							'flen3' => $result['flen3'],
							'flen4' => $result['flen4'],
							'flen5' => $result['flen5'],
							'flen6' => $result['flen6'],
							'flen7' => $result['flen7'],
							'flen8' => $result['flen8'],
							'fwid1' => $result['fwid1'],
							'fwid2' => $result['fwid2'],
							'fwid3' => $result['fwid3'],
							'fwid4' => $result['fwid4'],
							'fwid5' => $result['fwid5'],
							'fwid6' => $result['fwid6'],
							'fwid7' => $result['fwid7'],
							'fwid8' => $result['fwid8'],
							'fthk1' => $result['fthk1'],
							'fthk2' => $result['fthk2'],
							'fthk3' => $result['fthk3'],
							'fthk4' => $result['fthk4'],
							'fthk5' => $result['fthk5'],
							'fthk6' => $result['fthk6'],
							'fthk7' => $result['fthk7'],
							'fthk8' => $result['fthk8'],
							'fdis1' => $result['fdis1'],
							'fdis2' => $result['fdis2'],
							'fdis3' => $result['fdis3'],
							'fdis4' => $result['fdis4'],
							'fdis5' => $result['fdis5'],
							'fdis6' => $result['fdis6'],
							'fdis7' => $result['fdis7'],
							'fdis8' => $result['fdis8'],
							'floa1' => $result['floa1'],
							'floa2' => $result['floa2'],
							'floa3' => $result['floa3'],
							'floa4' => $result['floa4'],
							'floa5' => $result['floa5'],
							'floa6' => $result['floa6'],
							'floa7' => $result['floa7'],
							'floa8' => $result['floa8'],
							'fle1' => $result['fle1'],
							'fle2' => $result['fle2'],
							'fle3' => $result['fle3'],
							'fle4' => $result['fle4'],
							'fle5' => $result['fle5'],
							'fle6' => $result['fle6'],
							'fle7' => $result['fle7'],
							'fle8' => $result['fle8'],
							's_des' => $result['s_des'],
							'r_sam' => $result['r_sam'],
							's_ret' => $result['s_ret'],
							'qty_1' => $result['qty_1'],
							'chk_dim' => $result['chk_dim'],
							'h1_1' => $result['h1_1'],
							'h2_1' => $result['h2_1'],
							'h3_1' => $result['h3_1'],
							'h4_1' => $result['h4_1'],
							'h5_1' => $result['h5_1'],
							'h6_1' => $result['h6_1'],
							'h7_1' => $result['h7_1'],
							'h8_1' => $result['h8_1'],
							'l1_1' => $result['l1_1'],
							'l2_1' => $result['l2_1'],
							'l3_1' => $result['l3_1'],
							'l4_1' => $result['l4_1'],
							'l5_1' => $result['l5_1'],
							'l6_1' => $result['l6_1'],
							'l7_1' => $result['l7_1'],
							'l8_1' => $result['l8_1'],
							'w1_1' => $result['w1_1'],
							'w2_1' => $result['w2_1'],
							'w3_1' => $result['w3_1'],
							'w4_1' => $result['w4_1'],
							'w5_1' => $result['w5_1'],
							'w6_1' => $result['w6_1'],
							'w7_1' => $result['w7_1'],
							'w8_1' => $result['w8_1'],
							'height_avg' => $result['height_avg'],
							'length_avg' => $result['length_avg'],
							'width_avg' => $result['width_avg'],


							'avg_fle' => $result['avg_fle']
							
							
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
					
			$chk_com =  $_POST['chk_com'];	
			$chk_wtr =  $_POST['chk_wtr'];	
			$avg_corr = $_POST['avg_corr'];
			$avg_wtr = $_POST['avg_wtr'];
			$avg_den = $_POST['avg_den'];
			
			$chk_ten = $_POST['chk_ten'];
			$chk_fle = $_POST['chk_fle'];
			
			
			$paver_shape = $_POST['paver_shape'];
			$paver_age = $_POST['paver_age'];
			$paver_color = $_POST['paver_color'];
			$paver_thickness = $_POST['paver_thickness'];
			$paver_grade = $_POST['paver_grade'];
		
			$wtr_w1_1 = $_POST['wtr_w1_1'];			
			$wtr_w1_2 = $_POST['wtr_w1_2'];			
			$wtr_w1_3 = $_POST['wtr_w1_3'];			
			
			$wtr_w2_1 = $_POST['wtr_w2_1'];			
			$wtr_w2_2 = $_POST['wtr_w2_2'];			
			$wtr_w2_3 = $_POST['wtr_w2_3'];			
			
			$wtr_1 = $_POST['wtr_1'];			
			$wtr_2 = $_POST['wtr_2'];			
			$wtr_3 = $_POST['wtr_3'];			
			
			$lab_1 = $_POST['lab_1'];			
			$lab_2 = $_POST['lab_2'];			
			$lab_3 = $_POST['lab_3'];			
			$lab_4 = $_POST['lab_4'];
			$lab_5 = $_POST['lab_5'];
			$lab_6 = $_POST['lab_6'];
			$lab_7 = $_POST['lab_7'];
			$lab_8 = $_POST['lab_8'];

			$m1 = $_POST['m1'];			
			$m2 = $_POST['m2'];			
			$m3 = $_POST['m3'];			
			$m4 = $_POST['m4'];
			$m5 = $_POST['m5'];
			$m6 = $_POST['m6'];
			$m7 = $_POST['m7'];
			$m8 = $_POST['m8'];
			
			
			
			
			$grade = $_POST['grade'];
			$factor = $_POST['factor'];
			$thick = $_POST['thick'];

			$area_1 = $_POST['area_1'];			
			$area_2 = $_POST['area_2'];			
			$area_3 = $_POST['area_3'];			
			$area_4 = $_POST['area_4'];
			$area_5 = $_POST['area_5'];
			$area_6 = $_POST['area_6'];
			$area_7 = $_POST['area_7'];
			$area_8 = $_POST['area_8'];

			$load_1 = $_POST['load_1'];			
			$load_2 = $_POST['load_2'];			
			$load_3 = $_POST['load_3'];			
			$load_4 = $_POST['load_4'];
			$load_5 = $_POST['load_5'];
			$load_6 = $_POST['load_6'];
			$load_7 = $_POST['load_7'];
			$load_8 = $_POST['load_8'];

			$com_1 = $_POST['com_1'];			
			$com_2 = $_POST['com_2'];			
			$com_3 = $_POST['com_3'];			
			$com_4 = $_POST['com_4'];
			$com_5 = $_POST['com_5'];
			$com_6 = $_POST['com_6'];
			$com_7 = $_POST['com_7'];
			$com_8 = $_POST['com_8'];

			$corr_1 = $_POST['corr_1'];			
			$corr_2 = $_POST['corr_2'];			
			$corr_3 = $_POST['corr_3'];			
			$corr_4 = $_POST['corr_4'];
			$corr_5 = $_POST['corr_5'];
			$corr_6 = $_POST['corr_6'];
			$corr_7 = $_POST['corr_7'];
			$corr_8 = $_POST['corr_8'];

			$den_1 = $_POST['den_1'];			
			$den_2 = $_POST['den_2'];			
			$den_3 = $_POST['den_3'];			
			$den_4 = $_POST['den_4'];
			$den_5 = $_POST['den_5'];
			$den_6 = $_POST['den_6'];
			$den_7 = $_POST['den_7'];
			$den_8 = $_POST['den_8'];
			
			
			$sm1 = $_POST['sm1'];
			$sm2 = $_POST['sm2'];
			$sm3 = $_POST['sm3'];
			$sm4 = $_POST['sm4'];
			$sm5 = $_POST['sm5'];
			$sm6 = $_POST['sm6'];
			$sm7 = $_POST['sm7'];
			$sm8 = $_POST['sm8'];
			$sm9 = $_POST['sm9'];
			$sm10 = $_POST['sm10'];
			$sm11 = $_POST['sm11'];
			$sm12 = $_POST['sm12'];
			$sm13 = $_POST['sm13'];
			$sm14 = $_POST['sm14'];
			$sm15 = $_POST['sm15'];							
			$sm16 = $_POST['sm16'];
			$sm17 = $_POST['sm17'];
			$sm18 = $_POST['sm18'];
			$sm19 = $_POST['sm19'];
			$sm20 = $_POST['sm20'];
			$sm21 = $_POST['sm21'];
			$sm22 = $_POST['sm22'];
			$sm23 = $_POST['sm23'];
			$sm24 = $_POST['sm24'];
			$sm25 = $_POST['sm25'];
			$sm26 = $_POST['sm26'];
			$sm27 = $_POST['sm27'];
			$sm28 = $_POST['sm28'];
			$sm29 = $_POST['sm29'];
			$sm30 = $_POST['sm30'];										
					
			$t11 = $_POST['t11'];
			$t12 = $_POST['t12'];
			$t13 = $_POST['t13'];
			$t14 = $_POST['t14'];
			$t15 = $_POST['t15'];
			$t16 = $_POST['t16'];
			$t17 = $_POST['t17'];
			$t18 = $_POST['t18'];
			$t21 = $_POST['t21'];
			$t22 = $_POST['t22'];
			$t23 = $_POST['t23'];
			$t24 = $_POST['t24'];
			$t25 = $_POST['t25'];
			$t26 = $_POST['t26'];
			$t27 = $_POST['t27'];
			$t28 = $_POST['t28'];
			$t31 = $_POST['t31'];
			$t32 = $_POST['t32'];
			$t33 = $_POST['t33'];
			$t34 = $_POST['t34'];
			$t35 = $_POST['t35'];
			$t36 = $_POST['t36'];
			$t37 = $_POST['t37'];
			$t38 = $_POST['t38'];
			$avgt1 = $_POST['avgt1'];
			$avgt2 = $_POST['avgt2'];
			$avgt3 = $_POST['avgt3'];
			$avgt4 = $_POST['avgt4'];
			$avgt5 = $_POST['avgt5'];
			$avgt6 = $_POST['avgt6'];
			$avgt7 = $_POST['avgt7'];
			$avgt8 = $_POST['avgt8'];
			$f11 = $_POST['f11'];
			$f12 = $_POST['f12'];
			$f13 = $_POST['f13'];
			$f14 = $_POST['f14'];
			$f15 = $_POST['f15'];
			$f16 = $_POST['f16'];
			$f17 = $_POST['f17'];
			$f18 = $_POST['f18'];
			$f21 = $_POST['f21'];
			$f22 = $_POST['f22'];
			$f23 = $_POST['f23'];
			$f24 = $_POST['f24'];
			$f25 = $_POST['f25'];
			$f26 = $_POST['f26'];
			$f27 = $_POST['f27'];
			$f28 = $_POST['f28'];
			$avgf1 = $_POST['avgf1'];
			$avgf2 = $_POST['avgf2'];
			$avgf3 = $_POST['avgf3'];
			$avgf4 = $_POST['avgf4'];
			$avgf5 = $_POST['avgf5'];
			$avgf6 = $_POST['avgf6'];
			$avgf7 = $_POST['avgf7'];
			$avgf8 = $_POST['avgf8'];
			$farea1 = $_POST['farea1'];
			$farea2 = $_POST['farea2'];
			$farea3 = $_POST['farea3'];
			$farea4 = $_POST['farea4'];
			$farea5 = $_POST['farea5'];
			$farea6 = $_POST['farea6'];
			$farea7 = $_POST['farea7'];
			$farea8 = $_POST['farea8'];
			$spload1 = $_POST['spload1'];
			$spload2 = $_POST['spload2'];
			$spload3 = $_POST['spload3'];
			$spload4 = $_POST['spload4'];
			$spload5 = $_POST['spload5'];
			$spload6 = $_POST['spload6'];
			$spload7 = $_POST['spload7'];
			$spload8 = $_POST['spload8'];
			$sten1 = $_POST['sten1'];
			$sten2 = $_POST['sten2'];
			$sten3 = $_POST['sten3'];
			$sten4 = $_POST['sten4'];
			$sten5 = $_POST['sten5'];
			$sten6 = $_POST['sten6'];
			$sten7 = $_POST['sten7'];
			$sten8 = $_POST['sten8'];
			$fload1 = $_POST['fload1'];
			$fload2 = $_POST['fload2'];
			$fload3 = $_POST['fload3'];
			$fload4 = $_POST['fload4'];
			$fload5 = $_POST['fload5'];
			$fload6 = $_POST['fload6'];
			$fload7 = $_POST['fload7'];
			$fload8 = $_POST['fload8'];
			$avg_tensile = $_POST['avg_tensile'];
			$avg_load = $_POST['avg_load'];			
			$flen1 = $_POST['flen1'];
			$flen2 = $_POST['flen2'];
			$flen3 = $_POST['flen3'];
			$flen4 = $_POST['flen4'];
			$flen5 = $_POST['flen5'];
			$flen6 = $_POST['flen6'];
			$flen7 = $_POST['flen7'];
			$flen8 = $_POST['flen8'];
			$fwid1 = $_POST['fwid1'];
			$fwid2 = $_POST['fwid2'];
			$fwid3 = $_POST['fwid3'];
			$fwid4 = $_POST['fwid4'];
			$fwid5 = $_POST['fwid5'];
			$fwid6 = $_POST['fwid6'];
			$fwid7 = $_POST['fwid7'];
			$fwid8 = $_POST['fwid8'];
			$fthk1 = $_POST['fthk1'];
			$fthk2 = $_POST['fthk2'];
			$fthk3 = $_POST['fthk3'];
			$fthk4 = $_POST['fthk4'];
			$fthk5 = $_POST['fthk5'];
			$fthk6 = $_POST['fthk6'];
			$fthk7 = $_POST['fthk7'];
			$fthk8 = $_POST['fthk8'];
			$fdis1 = $_POST['fdis1'];
			$fdis2 = $_POST['fdis2'];
			$fdis3 = $_POST['fdis3'];
			$fdis4 = $_POST['fdis4'];
			$fdis5 = $_POST['fdis5'];
			$fdis6 = $_POST['fdis6'];
			$fdis7 = $_POST['fdis7'];
			$fdis8 = $_POST['fdis8'];
			$floa1 = $_POST['floa1'];
			$floa2 = $_POST['floa2'];
			$floa3 = $_POST['floa3'];
			$floa4 = $_POST['floa4'];
			$floa5 = $_POST['floa5'];
			$floa6 = $_POST['floa6'];
			$floa7 = $_POST['floa7'];
			$floa8 = $_POST['floa8'];
			$fle1 = $_POST['fle1'];
			$fle2 = $_POST['fle2'];
			$fle3 = $_POST['fle3'];
			$fle4 = $_POST['fle4'];
			$fle5 = $_POST['fle5'];
			$fle6 = $_POST['fle6'];
			$fle7 = $_POST['fle7'];
			$fle8 = $_POST['fle8'];
			$s_des = $_POST['s_des'];
            $r_sam = $_POST['r_sam'];
            $s_ret = $_POST['s_ret'];
            $qty_1 = $_POST['qty_1'];
			$chk_dim = $_POST['chk_dim'];
			$h1_1 = $_POST['h1_1'];
			$h2_1 = $_POST['h2_1'];
			$h3_1 = $_POST['h3_1'];
			$h4_1 = $_POST['h4_1'];
			$h5_1 = $_POST['h5_1'];
			$h6_1 = $_POST['h6_1'];
			$h7_1 = $_POST['h7_1'];
			$h8_1 = $_POST['h8_1'];
			$l1_1 = $_POST['l1_1'];
			$l2_1 = $_POST['l2_1'];
			$l3_1 = $_POST['l3_1'];
			$l4_1 = $_POST['l4_1'];
			$l5_1 = $_POST['l5_1'];
			$l6_1 = $_POST['l6_1'];
			$l7_1 = $_POST['l7_1'];
			$l8_1 = $_POST['l8_1'];
			$w1_1 = $_POST['w1_1'];
			$w2_1 = $_POST['w2_1'];
			$w3_1 = $_POST['w3_1'];
			$w4_1 = $_POST['w4_1'];
			$w5_1 = $_POST['w5_1'];
			$w6_1 = $_POST['w6_1'];
			$w7_1 = $_POST['w7_1'];
			$w8_1 = $_POST['w8_1'];
			$height_avg = $_POST['height_avg'];
			$length_avg = $_POST['length_avg'];
			$width_avg = $_POST['width_avg'];



			$avg_fle = $_POST['avg_fle'];
			
			
			$curr_date=date("Y-m-d");
			
			
			
		      $insert="INSERT INTO `span_paver_block`(`report_no`,`ulr`, `job_no`, `lab_no`, `paver_shape`, `paver_age`, `paver_color`, `paver_thickness`, `paver_grade`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_com`, `lab_1`, `lab_2`, `lab_3`, `lab_4`, `lab_5`, `lab_6`, `lab_7`, `lab_8`, `m1`, `m2`, `m3`, `m4`, `m5`, `m6`, `m7`, `m8`, `grade`, `thick`, `area_1`, `area_2`, `area_3`, `area_4`, `area_5`, `area_6`, `area_7`, `area_8`, `load_1`, `load_2`, `load_3`, `load_4`, `load_5`, `load_6`, `load_7`, `load_8`, `com_1`, `com_2`, `com_3`, `com_4`, `com_5`, `com_6`, `com_7`, `com_8`, `factor`, `corr_1`, `corr_2`, `corr_3`, `corr_4`, `corr_5`, `corr_6`, `corr_7`, `corr_8`, `avg_corr`, `den_1`, `den_2`, `den_3`, `den_4`, `den_5`, `den_6`, `den_7`, `den_8`, `avg_den`, `chk_wtr`, `wtr_w1_1`, `wtr_w1_2`, `wtr_w1_3`, `wtr_w2_1`, `wtr_w2_2`, `wtr_w2_3`, `wtr_1`, `wtr_2`, `wtr_3`, `avg_wtr`, `sm1`, `sm2`, `sm3`, `sm4`, `sm5`, `sm6`, `sm7`, `sm8`, `sm9`, `sm10`, `sm11`, `sm12`, `sm13`, `sm14`, `sm15`, `sm16`, `sm17`, `sm18`, `sm19`, `sm20`, `sm21`, `sm22`, `sm23`, `sm24`, `sm25`, `sm26`, `sm27`, `sm28`, `sm29`, `sm30`, `chk_ten`, `t11`, `t12`, `t13`, `t14`, `t15`, `t16`, `t17`, `t18`, `t21`, `t22`, `t23`, `t24`, `t25`, `t26`, `t27`, `t28`, `t31`, `t32`, `t33`, `t34`, `t35`, `t36`, `t37`, `t38`, `avgt1`, `avgt2`, `avgt3`, `avgt4`, `avgt5`, `avgt6`, `avgt7`, `avgt8`, `f11`, `f12`, `f13`, `f14`, `f15`, `f16`, `f17`, `f18`, `f21`, `f22`, `f23`, `f24`, `f25`, `f26`, `f27`, `f28`, `avgf1`, `avgf2`, `avgf3`, `avgf4`, `avgf5`, `avgf6`, `avgf7`, `avgf8`, `farea1`, `farea2`, `farea3`, `farea4`, `farea5`, `farea6`, `farea7`, `farea8`, `spload1`, `spload2`, `spload3`, `spload4`, `spload5`, `spload6`, `spload7`, `spload8`, `sten1`, `sten2`, `sten3`, `sten4`, `sten5`, `sten6`, `sten7`, `sten8`, `fload1`, `fload2`, `fload3`, `fload4`, `fload5`, `fload6`, `fload7`, `fload8`, `avg_tensile`, `avg_load`, `chk_fle`, `flen1`, `flen2`, `flen3`, `flen4`, `flen5`, `flen6`, `flen7`, `flen8`, `fwid1`, `fwid2`, `fwid3`, `fwid4`, `fwid5`, `fwid6`, `fwid7`, `fwid8`, `fthk1`, `fthk2`, `fthk3`, `fthk4`, `fthk5`, `fthk6`, `fthk7`, `fthk8`, `fdis1`, `fdis2`, `fdis3`, `fdis4`, `fdis5`, `fdis6`, `fdis7`, `fdis8`, `floa1`, `floa2`, `floa3`, `floa4`, `floa5`, `floa6`, `floa7`, `floa8`, `fle1`, `fle2`, `fle3`, `fle4`, `fle5`, `fle6`, `fle7`, `fle8`, `avg_fle`,`s_des`,`r_sam`,`s_ret`,`qty_1`,`chk_dim`,`h1_1`,`h2_1`,`h3_1`,`h4_1`,`h5_1`,`h6_1`,`h7_1`,`h8_1`,`l1_1`,`l2_1`,`l3_1`,`l4_1`,`l5_1`,`l6_1`,`l7_1`,`l8_1`,`w1_1`,`w2_1`,`w3_1`,`w4_1`,`w5_1`,`w6_1`,`w7_1`,`w8_1`,`height_avg`,`length_avg`,`width_avg`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','$paver_shape','$paver_age','$paver_color','$paver_thickness','$paver_grade','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$chk_com','$lab_1','$lab_2','$lab_3','$lab_4','$lab_5','$lab_6','$lab_7','$lab_8','$m1','$m2','$m3','$m4','$m5','$m6','$m7','$m8','$grade','$thick','$area_1','$area_2','$area_3','$area_4','$area_5','$area_6','$area_7','$area_8','$load_1','$load_2','$load_3','$load_4','$load_5','$load_6','$load_7','$load_8','$com_1','$com_2','$com_3','$com_4','$com_5','$com_6','$com_7','$com_8','$factor','$corr_1','$corr_2','$corr_3','$corr_4','$corr_5','$corr_6','$corr_7','$corr_8','$avg_corr','$den_1','$den_2','$den_3','$den_4','$den_5','$den_6','$den_7','$den_8','$avg_den','$chk_wtr','$wtr_w1_1','$wtr_w1_2','$wtr_w1_3','$wtr_w2_1','$wtr_w2_2','$wtr_w2_3','$wtr_1','$wtr_2','$wtr_3','$avg_wtr','$sm1','$sm2','$sm3','$sm4','$sm5','$sm6','$sm7','$sm8','$sm9','$sm10','$sm11','$sm12','$sm13','$sm14','$sm15','$sm16','$sm17','$sm18','$sm19','$sm20','$sm21','$sm22','$sm23','$sm24','$sm25','$sm26','$sm27','$sm28','$sm29','$sm30','$chk_ten','$t11','$t12','$t13','$t14','$t15','$t16','$t17','$t18','$t21','$t22','$t23','$t24','$t25','$t26','$t27','$t28','$t31','$t32','$t33','$t34','$t35','$t36','$t37','$t38','$avgt1','$avgt2','$avgt3','$avgt4','$avgt5','$avgt6','$avgt7','$avgt8','$f11','$f12','$f13','$f14','$f15','$f16','$f17','$f18','$f21','$f22','$f23','$f24','$f25','$f26','$f27','$f28','$avgf1','$avgf2','$avgf3','$avgf4','$avgf5','$avgf6','$avgf7','$avgf8','$farea1','$farea2','$farea3','$farea4','$farea5','$farea6','$farea7','$farea8','$spload1','$spload2','$spload3','$spload4','$spload5','$spload6','$spload7','$spload8','$sten1','$sten2','$sten3','$sten4','$sten5','$sten6','$sten7','$sten8','$fload1','$fload2','$fload3','$fload4','$fload5','$fload6','$fload7','$fload8','$avg_tensile','$avg_load','$chk_fle','$flen1','$flen2','$flen3','$flen4','$flen5','$flen6','$flen7','$flen8','$fwid1','$fwid2','$fwid3','$fwid4','$fwid5','$fwid6','$fwid7','$fwid8','$fthk1','$fthk2','$fthk3','$fthk4','$fthk5','$fthk6','$fthk7','$fthk8','$fdis1','$fdis2','$fdis3','$fdis4','$fdis5','$fdis6','$fdis7','$fdis8','$floa1','$floa2','$floa3','$floa4','$floa5','$floa6','$floa7','$floa8','$fle1','$fle2','$fle3','$fle4','$fle5','$fle6','$fle7','$fle8','$avg_fle','$s_des','$r_sam','$s_ret','$qty_1','$chk_dim','$h1_1','$h2_1','$h3_1','$h4_1','$h5_1','$h6_1','$h7_1','$h8_1','$l1_1','$l2_1','$l3_1','$l4_1','$l5_1','$l6_1','$l7_1','$l8_1','$w1_1','$w2_1','$w3_1','$w4_1','$w5_1','$w6_1','$w7_1','$w8_1','$height_avg','$length_avg','$width_avg')"; 

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
														<th style="text-align:center;"><label>Report No.</label></th>	
														<th style="text-align:center;"><label>Job No.</label></th>	
														<th style="text-align:center;"><label>Lab No.</label></th>	
														
																								

													</tr>
														<?php
													 $query = "select * from `span_paver_block` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
																	//}
																?>	
																</td>
																<td style="text-align:center;"><?php echo $r['report_no'];?></td>
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
		
				
		
	  $update="update span_paver_block SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 
				 `chk_com`='$_POST[chk_com]',
				 `chk_wtr`='$_POST[chk_wtr]',
				 `paver_shape`='$_POST[paver_shape]',
				 `paver_age`='$_POST[paver_age]',
				 `paver_color`='$_POST[paver_color]',				 
				 `paver_thickness`='$_POST[paver_thickness]',
				 `paver_grade`='$_POST[paver_grade]',
				 `avg_corr`='$_POST[avg_corr]',
				 `avg_wtr`='$_POST[avg_wtr]',
				 `avg_den`='$_POST[avg_den]',
				 `chk_abr`='$_POST[chk_abr]',
				 `chk_ten`='$_POST[chk_ten]',
				 `chk_fle`='$_POST[chk_fle]',
				 `den_1`='$_POST[den_1]',
				 `den_2`='$_POST[den_2]',
				 `den_3`='$_POST[den_3]',
				 `den_4`='$_POST[den_4]',
				 `den_5`='$_POST[den_5]',
				 `den_6`='$_POST[den_6]',
				 `den_7`='$_POST[den_7]',
				 `den_8`='$_POST[den_8]', 				 
				 `wtr_w1_1`='$_POST[wtr_w1_1]',
				 `wtr_w1_2`='$_POST[wtr_w1_2]',
				 `wtr_w1_3`='$_POST[wtr_w1_3]',				
				 `wtr_w2_1`='$_POST[wtr_w2_1]',
				 `wtr_w2_2`='$_POST[wtr_w2_2]',
				 `wtr_w2_3`='$_POST[wtr_w2_3]',				
				 `wtr_1`='$_POST[wtr_1]',
				 `wtr_2`='$_POST[wtr_2]',
				 `wtr_3`='$_POST[wtr_3]',					 
				 `thick`='$_POST[thick]',					 
				 `factor`='$_POST[factor]',					 
				 `grade`='$_POST[grade]',
				 `lab_1`='$_POST[lab_1]',
				 `lab_2`='$_POST[lab_2]',
				 `lab_3`='$_POST[lab_3]',
				 `lab_4`='$_POST[lab_4]',
				 `lab_5`='$_POST[lab_5]',
				 `lab_6`='$_POST[lab_6]',
				 `lab_7`='$_POST[lab_7]',
				 `lab_8`='$_POST[lab_8]',
				  `m1`='$_POST[m1]',
				 `m2`='$_POST[m2]',
				 `m3`='$_POST[m3]',
				 `m4`='$_POST[m4]',
				 `m5`='$_POST[m5]',
				 `m6`='$_POST[m6]',
				 `m7`='$_POST[m7]',
				 `m8`='$_POST[m8]',
			     `area_1`='$_POST[area_1]',
				 `area_2`='$_POST[area_2]',
				 `area_3`='$_POST[area_3]',
				 `area_4`='$_POST[area_4]',
				 `area_5`='$_POST[area_5]',
				 `area_6`='$_POST[area_6]',
				 `area_7`='$_POST[area_7]',
				 `area_8`='$_POST[area_8]',
				 `load_1`='$_POST[load_1]',
				 `load_2`='$_POST[load_2]',
				 `load_3`='$_POST[load_3]',
				 `load_4`='$_POST[load_4]',
				 `load_5`='$_POST[load_5]',
				 `load_6`='$_POST[load_6]',
				 `load_7`='$_POST[load_7]',
				 `load_8`='$_POST[load_8]',
				`com_1`='$_POST[com_1]',
				 `com_2`='$_POST[com_2]',
				 `com_3`='$_POST[com_3]',
				 `com_4`='$_POST[com_4]',
				 `com_5`='$_POST[com_5]',
				 `com_6`='$_POST[com_6]',
				 `com_7`='$_POST[com_7]',
				 `com_8`='$_POST[com_8]',
				 `corr_1`='$_POST[corr_1]',
				 `corr_2`='$_POST[corr_2]',
				 `corr_3`='$_POST[corr_3]',
				 `corr_4`='$_POST[corr_4]',
				 `corr_5`='$_POST[corr_5]',
				 `corr_6`='$_POST[corr_6]',
				 `corr_7`='$_POST[corr_7]',
				 `corr_8`='$_POST[corr_8]',
				`sm1`='$_POST[sm1]',
				`sm2`='$_POST[sm2]',
				`sm3`='$_POST[sm3]',
				`sm4`='$_POST[sm4]',
				`sm5`='$_POST[sm5]',
				`sm6`='$_POST[sm6]',
				`sm7`='$_POST[sm7]',
				`sm8`='$_POST[sm8]',
				`sm9`='$_POST[sm9]',
				`sm10`='$_POST[sm10]',
				`sm11`='$_POST[sm11]',
				`sm12`='$_POST[sm12]',
				`sm13`='$_POST[sm13]',
				`sm14`='$_POST[sm14]',
				`sm15`='$_POST[sm15]',							
				`sm16`='$_POST[sm16]',
				`sm17`='$_POST[sm17]',
				`sm18`='$_POST[sm18]',
				`sm19`='$_POST[sm19]',
				`sm20`='$_POST[sm20]',
				`sm21`='$_POST[sm21]',
				`sm22`='$_POST[sm22]',
				`sm23`='$_POST[sm23]',
				`sm24`='$_POST[sm24]',
				`sm25`='$_POST[sm25]',
				`sm26`='$_POST[sm26]',
				`sm27`='$_POST[sm27]',
				`sm28`='$_POST[sm28]',
				`sm29`='$_POST[sm29]',
				`sm30`='$_POST[sm30]',										
							
				`t11`='$_POST[t11]',
				`t12`='$_POST[t12]',
				`t13`='$_POST[t13]',
				`t14`='$_POST[t14]',
				`t15`='$_POST[t15]',
				`t16`='$_POST[t16]',
				`t17`='$_POST[t17]',
				`t18`='$_POST[t18]',
				`t21`='$_POST[t21]',
				`t22`='$_POST[t22]',
				`t23`='$_POST[t23]',
				`t24`='$_POST[t24]',
				`t25`='$_POST[t25]',
				`t26`='$_POST[t26]',
				`t27`='$_POST[t27]',
				`t28`='$_POST[t28]',
				`t31`='$_POST[t31]',
				`t32`='$_POST[t32]',
				`t33`='$_POST[t33]',
				`t34`='$_POST[t34]',
				`t35`='$_POST[t35]',
				`t36`='$_POST[t36]',
				`t37`='$_POST[t37]',
				`t38`='$_POST[t38]',
				`avgt1`='$_POST[avgt1]',
				`avgt2`='$_POST[avgt2]',
				`avgt3`='$_POST[avgt3]',
				`avgt4`='$_POST[avgt4]',
				`avgt5`='$_POST[avgt5]',
				`avgt6`='$_POST[avgt6]',
				`avgt7`='$_POST[avgt7]',
				`avgt8`='$_POST[avgt8]',
				`f11`='$_POST[f11]',
				`f12`='$_POST[f12]',
				`f13`='$_POST[f13]',
				`f14`='$_POST[f14]',
				`f15`='$_POST[f15]',
				`f16`='$_POST[f16]',
				`f17`='$_POST[f17]',
				`f18`='$_POST[f18]',
				`f21`='$_POST[f21]',
				`f22`='$_POST[f22]',
				`f23`='$_POST[f23]',
				`f24`='$_POST[f24]',
				`f25`='$_POST[f25]',
				`f26`='$_POST[f26]',
				`f27`='$_POST[f27]',
				`f28`='$_POST[f28]',
				`avgf1`='$_POST[avgf1]',
				`avgf2`='$_POST[avgf2]',
				`avgf3`='$_POST[avgf3]',
				`avgf4`='$_POST[avgf4]',
				`avgf5`='$_POST[avgf5]',
				`avgf6`='$_POST[avgf6]',
				`avgf7`='$_POST[avgf7]',
				`avgf8`='$_POST[avgf8]',
				`farea1`='$_POST[farea1]',
				`farea2`='$_POST[farea2]',
				`farea3`='$_POST[farea3]',
				`farea4`='$_POST[farea4]',
				`farea5`='$_POST[farea5]',
				`farea6`='$_POST[farea6]',
				`farea7`='$_POST[farea7]',
				`farea8`='$_POST[farea8]',
				`spload1`='$_POST[spload1]',
				`spload2`='$_POST[spload2]',
				`spload3`='$_POST[spload3]',
				`spload4`='$_POST[spload4]',
				`spload5`='$_POST[spload5]',
				`spload6`='$_POST[spload6]',
				`spload7`='$_POST[spload7]',
				`spload8`='$_POST[spload8]',
				`sten1`='$_POST[sten1]',
				`sten2`='$_POST[sten2]',
				`sten3`='$_POST[sten3]',
				`sten4`='$_POST[sten4]',
				`sten5`='$_POST[sten5]',
				`sten6`='$_POST[sten6]',
				`sten7`='$_POST[sten7]',
				`sten8`='$_POST[sten8]',
				`fload1`='$_POST[fload1]',
				`fload2`='$_POST[fload2]',
				`fload3`='$_POST[fload3]',
				`fload4`='$_POST[fload4]',
				`fload5`='$_POST[fload5]',
				`fload6`='$_POST[fload6]',
				`fload7`='$_POST[fload7]',
				`fload8`='$_POST[fload8]',
				`avg_tensile`='$_POST[avg_tensile]',
				`avg_load`='$_POST[avg_load]',			
				`flen1`='$_POST[flen1]',
				`flen2`='$_POST[flen2]',
				`flen3`='$_POST[flen3]',
				`flen4`='$_POST[flen4]',
				`flen5`='$_POST[flen5]',
				`flen6`='$_POST[flen6]',
				`flen7`='$_POST[flen7]',
				`flen8`='$_POST[flen8]',
				`fwid1`='$_POST[fwid1]',
				`fwid2`='$_POST[fwid2]',
				`fwid3`='$_POST[fwid3]',
				`fwid4`='$_POST[fwid4]',
				`fwid5`='$_POST[fwid5]',
				`fwid6`='$_POST[fwid6]',
				`fwid7`='$_POST[fwid7]',
				`fwid8`='$_POST[fwid8]',
				`fthk1`='$_POST[fthk1]',
				`fthk2`='$_POST[fthk2]',
				`fthk3`='$_POST[fthk3]',
				`fthk4`='$_POST[fthk4]',
				`fthk5`='$_POST[fthk5]',
				`fthk6`='$_POST[fthk6]',
				`fthk7`='$_POST[fthk7]',
				`fthk8`='$_POST[fthk8]',
				`fdis1`='$_POST[fdis1]',
				`fdis2`='$_POST[fdis2]',
				`fdis3`='$_POST[fdis3]',
				`fdis4`='$_POST[fdis4]',
				`fdis5`='$_POST[fdis5]',
				`fdis6`='$_POST[fdis6]',
				`fdis7`='$_POST[fdis7]',
				`fdis8`='$_POST[fdis8]',
				`floa1`='$_POST[floa1]',
				`floa2`='$_POST[floa2]',
				`floa3`='$_POST[floa3]',
				`floa4`='$_POST[floa4]',
				`floa5`='$_POST[floa5]',
				`floa6`='$_POST[floa6]',
				`floa7`='$_POST[floa7]',
				`floa8`='$_POST[floa8]',
				`fle1`='$_POST[fle1]',
				`fle2`='$_POST[fle2]',
				`fle3`='$_POST[fle3]',
				`fle4`='$_POST[fle4]',
				`fle5`='$_POST[fle5]',
				`fle6`='$_POST[fle6]',
				`fle7`='$_POST[fle7]',
				`fle8`='$_POST[fle8]',
				`s_des`='$_POST[s_des]',
                `r_sam`='$_POST[r_sam]',
                `s_ret`='$_POST[s_ret]',
                `qty_1`='$_POST[qty_1]',
				`chk_dim`='$_POST[chk_dim]',
				`h1_1`='$_POST[h1_1]',
				`h2_1`='$_POST[h2_1]',
				`h3_1`='$_POST[h3_1]',
				`h4_1`='$_POST[h4_1]',
				`h5_1`='$_POST[h5_1]',
				`h6_1`='$_POST[h6_1]',
				`h7_1`='$_POST[h7_1]',
				`h8_1`='$_POST[h8_1]',
				`l1_1`='$_POST[l1_1]',
				`l2_1`='$_POST[l2_1]',
				`l3_1`='$_POST[l3_1]',
				`l4_1`='$_POST[l4_1]',
				`l5_1`='$_POST[l5_1]',
				`l6_1`='$_POST[l6_1]',
				`l7_1`='$_POST[l7_1]',
				`l8_1`='$_POST[l8_1]',
				`w1_1`='$_POST[w1_1]',
				`w2_1`='$_POST[w2_1]',
				`w3_1`='$_POST[w3_1]',
				`w4_1`='$_POST[w4_1]',
				`w5_1`='$_POST[w5_1]',
				`w6_1`='$_POST[w6_1]',
				`w7_1`='$_POST[w7_1]',
				`w8_1`='$_POST[w8_1]',
				`height_avg`='$_POST[height_avg]',
				`length_avg`='$_POST[length_avg]',
				`width_avg`='$_POST[width_avg]',

				`avg_fle`='$_POST[avg_fle]'
				WHERE `id`='$_POST[idEdit]'";

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update span_paver_block SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM span_paver_block WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update span_paver_block SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update span_paver_block SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>