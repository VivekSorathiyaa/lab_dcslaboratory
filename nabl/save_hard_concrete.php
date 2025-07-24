<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from hard_concrete WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'amend_date' => $result['amend_date'],
							'chk_fle' => $result['chk_fle'],
							'age1' => $result['age1'],
							'age2' => $result['age2'],
							'age3' => $result['age3'],
							'l1' => $result['l1'],
							'l2' => $result['l2'],
							'l3' => $result['l3'],
							'b1' => $result['b1'],
							'b2' => $result['b2'],
							'b3' => $result['b3'],
							'd1' => $result['d1'],
							'd2' => $result['d2'],
							'd3' => $result['d3'],
							'len1' => $result['len1'],
							'len2' => $result['len2'],
							'len3' => $result['len3'],
							'max1' => $result['max1'],
							'max2' => $result['max2'],
							'max3' => $result['max3'],
							'pos1' => $result['pos1'],
							'pos2' => $result['pos2'],
							'pos3' => $result['pos3'],
							'mod1' => $result['mod1'],
							'mod2' => $result['mod2'],
							'mod3' => $result['mod3'],
							'avg1' => $result['avg1'],
							'avg2' => $result['avg2'],
							'avg3' => $result['avg3'],
							'chk_com' => $result['chk_com'],
							'loc1' => $result['loc1'],
							'loc2' => $result['loc2'],
							'loc3' => $result['loc3'],
							'loc4' => $result['loc4'],
							'loc5' => $result['loc5'],
							'loc6' => $result['loc6'],
							'loc7' => $result['loc7'],
							'loc8' => $result['loc8'],
							'loc9' => $result['loc9'],
							'weight1' => $result['weight1'],
							'weight2' => $result['weight2'],
							'weight3' => $result['weight3'],
							'weight4' => $result['weight4'],
							'weight5' => $result['weight5'],
							'weight6' => $result['weight6'],
							'weight7' => $result['weight7'],
							'weight8' => $result['weight8'],
							'weight9' => $result['weight9'],
							'dia1' => $result['dia1'],
							'dia2' => $result['dia2'],
							'dia3' => $result['dia3'],
							'dia4' => $result['dia4'],
							'dia5' => $result['dia5'],
							'dia6' => $result['dia6'],
							'dia7' => $result['dia7'],
							'dia8' => $result['dia8'],
							'dia9' => $result['dia9'],
							'height1' => $result['height1'],
							'height2' => $result['height2'],
							'height3' => $result['height3'],
							'height4' => $result['height4'],
							'height5' => $result['height5'],
							'height6' => $result['height6'],
							'height7' => $result['height7'],
							'height8' => $result['height8'],
							'height9' => $result['height9'],
							'ratio1' => $result['ratio1'],
							'ratio2' => $result['ratio2'],
							'ratio3' => $result['ratio3'],
							'ratio4' => $result['ratio4'],
							'ratio5' => $result['ratio5'],
							'ratio6' => $result['ratio6'],
							'ratio7' => $result['ratio7'],
							'ratio8' => $result['ratio8'],
							'ratio9' => $result['ratio9'],
							'area1' => $result['area1'],
							'area2' => $result['area2'],
							'area3' => $result['area3'],
							'area4' => $result['area4'],
							'area5' => $result['area5'],
							'area6' => $result['area6'],
							'area7' => $result['area7'],
							'area8' => $result['area8'],
							'area9' => $result['area9'],
							'load1' => $result['load1'],
							'load2' => $result['load2'],
							'load3' => $result['load3'],
							'load4' => $result['load4'],
							'load5' => $result['load5'],
							'load6' => $result['load6'],
							'load7' => $result['load7'],
							'load8' => $result['load8'],
							'load9' => $result['load9'],
							'com1' => $result['com1'],
							'com2' => $result['com2'],
							'com3' => $result['com3'],
							'com4' => $result['com4'],
							'com5' => $result['com5'],
							'com6' => $result['com6'],
							'com7' => $result['com7'],
							'com8' => $result['com8'],
							'com9' => $result['com9'],
							'cor_a1' => $result['cor_a1'],
							'cor_a2' => $result['cor_a2'],
							'cor_a3' => $result['cor_a3'],
							'cor_a4' => $result['cor_a4'],
							'cor_a5' => $result['cor_a5'],
							'cor_a6' => $result['cor_a6'],
							'cor_a7' => $result['cor_a7'],
							'cor_a8' => $result['cor_a8'],
							'cor_a9' => $result['cor_a9'],
							'cor_b1' => $result['cor_b1'],
							'cor_b2' => $result['cor_b2'],
							'cor_b3' => $result['cor_b3'],
							'cor_b4' => $result['cor_b4'],
							'cor_b5' => $result['cor_b5'],
							'cor_b6' => $result['cor_b6'],
							'cor_b7' => $result['cor_b7'],
							'cor_b8' => $result['cor_b8'],
							'cor_b9' => $result['cor_b9'],
							'cor_str1' => $result['cor_str1'],
							'cor_str2' => $result['cor_str2'],
							'cor_str3' => $result['cor_str3'],
							'cor_str4' => $result['cor_str4'],
							'cor_str5' => $result['cor_str5'],
							'cor_str6' => $result['cor_str6'],
							'cor_str7' => $result['cor_str7'],
							'cor_str8' => $result['cor_str8'],
							'cor_str9' => $result['cor_str9'],
							'cube_str1' => $result['cube_str1'],
							'cube_str2' => $result['cube_str2'],
							'cube_str3' => $result['cube_str3'],
							'cube_str4' => $result['cube_str4'],
							'cube_str5' => $result['cube_str5'],
							'cube_str6' => $result['cube_str6'],
							'cube_str7' => $result['cube_str7'],
							'cube_str8' => $result['cube_str8'],
							'cube_str9' => $result['cube_str9'],
							'cube_avg1' => $result['cube_avg1'],
							'cube_avg2' => $result['cube_avg2'],
							'cube_avg3' => $result['cube_avg3'],
							'chk_spl' => $result['chk_spl'],
							'd_read1_1' => $result['d_read1_1'],
							'd_read1_2' => $result['d_read1_2'],
							'd_read1_3' => $result['d_read1_3'],
							'd_read2_1' => $result['d_read2_1'],
							'd_read2_2' => $result['d_read2_2'],
							'd_read2_3' => $result['d_read2_3'],
							'd_read3_1' => $result['d_read3_1'],
							'd_read3_2' => $result['d_read3_2'],
							'd_read3_3' => $result['d_read3_3'],
							'avg_dia1' => $result['avg_dia1'],
							'avg_dia2' => $result['avg_dia2'],
							'avg_dia3' => $result['avg_dia3'],
							'l_read1_1' => $result['l_read1_1'],
							'l_read1_2' => $result['l_read1_2'],
							'l_read1_3' => $result['l_read1_3'],
							'l_read2_1' => $result['l_read2_1'],
							'l_read2_2' => $result['l_read2_2'],
							'l_read2_3' => $result['l_read2_3'],
							'avg_len1' => $result['avg_len1'],
							'avg_len2' => $result['avg_len2'],
							'avg_len3' => $result['avg_len3'],
							'spl_load1' => $result['spl_load1'],
							'spl_load2' => $result['spl_load2'],
							'spl_load3' => $result['spl_load3'],
							'spl_str1' => $result['spl_str1'],
							'spl_str2' => $result['spl_str2'],
							'spl_avg1' => $result['spl_avg1'],
							'spl_avg2' => $result['spl_avg2'],
							'average' => $result['average'],
							'chk_acc' => $result['chk_acc'],
							'acc1' => $result['acc1'],
							'acc2' => $result['acc2'],
							'acc3' => $result['acc3'],
							'acc4' => $result['acc4'],
							'acc5' => $result['acc5'],
							'acc6' => $result['acc6'],
							'remark' => $result['remark'],
							'remark_1' => $result['remark_1'],
							'remark_2' => $result['remark_2'],
							'acc1_2' => $result['acc1_2'],
							'acc2_2' => $result['acc2_2'],
							'acc3_2' => $result['acc3_2'],
							'acc4_2' => $result['acc4_2'],
							'acc5_2' => $result['acc5_2'],
							'acc_id1' => $result['acc_id1'],
							'acc_id2' => $result['acc_id2'],
							'acc_id3' => $result['acc_id3'],
							'acc_w1' => $result['acc_w1'],
							'acc_w2' => $result['acc_w2'],
							'acc_w3' => $result['acc_w3'],
							'acc_l1' => $result['acc_l1'],
							'acc_l2' => $result['acc_l2'],
							'acc_l3' => $result['acc_l3'],
							'acc_width1' => $result['acc_width1'],
							'acc_width2' => $result['acc_width2'],
							'acc_width3' => $result['acc_width3'],
							'acc_height1' => $result['acc_height1'],
							'acc_height2' => $result['acc_height2'],
							'acc_height3' => $result['acc_height3'],
							'acc_area1' => $result['acc_area1'],
							'acc_area2' => $result['acc_area2'],
							'acc_area3' => $result['acc_area3'],
							'acc_load1' => $result['acc_load1'],
							'acc_load2' => $result['acc_load2'],
							'acc_load3' => $result['acc_load3'],
							'acc_com1' => $result['acc_com1'],
							'acc_com2' => $result['acc_com2'],
							'acc_com3' => $result['acc_com3'],
							'acc_avg1' => $result['acc_avg1'],
							'acc_avg2' => $result['acc_avg2'],
							'acc_avg3' => $result['acc_avg3'],
							'acc_r28' => $result['acc_r28'],
							'cast_date' => $result['cast_date'],
							'cast_time' => $result['cast_time'],
							'chk_dry' => $result['chk_dry'],
							'dry_avg_1' => $result['dry_avg_1'],
							'dry_avg_2' => $result['dry_avg_2'],
							'dry_avg_3' => $result['dry_avg_3'],
							'dry_r1_1' => $result['dry_r1_1'],
							'dry_r1_2' => $result['dry_r1_2'],
							'dry_r1_3' => $result['dry_r1_3'],
							'dry_r2_1' => $result['dry_r2_1'],
							'dry_r2_2' => $result['dry_r2_2'],
							'dry_r2_3' => $result['dry_r2_3'],
							'dry_r3_1' => $result['dry_r3_1'],
							'dry_r3_2' => $result['dry_r3_2'],
							'dry_r3_3' => $result['dry_r3_3'],
							'dry_r4_1' => $result['dry_r4_1'],
							'dry_r4_2' => $result['dry_r4_2'],
							'dry_r4_3' => $result['dry_r4_3'],
							'dry_r5_1' => $result['dry_r5_1'],
							'dry_r5_2' => $result['dry_r5_2'],
							'dry_r5_3' => $result['dry_r5_3'],
							'dry_r6_1' => $result['dry_r6_1'],
							'dry_r6_2' => $result['dry_r6_2'],
							'dry_r6_3' => $result['dry_r6_3'],
							'dry_len_1' => $result['dry_len_1'],
							'dry_len_2' => $result['dry_len_2'],
							'dry_len_3' => $result['dry_len_3'],
							'dry_shr_1' => $result['dry_shr_1'],
							'dry_shr_2' => $result['dry_shr_2'],
							'dry_shr_3' => $result['dry_shr_3'],
							'dry_wtr_1' => $result['dry_wtr_1'],
							'dry_wtr_2' => $result['dry_wtr_2'],
							'dry_wtr_3' => $result['dry_wtr_3'],
							'dry_moi_1' => $result['dry_moi_1'],
							'dry_moi_2' => $result['dry_moi_2'],
							'dry_moi_3' => $result['dry_moi_3'],
							'avg_dry_shr' => $result['avg_dry_shr'],
							'top_grade' => $result['top_grade'],
							'cc_identification_mark' => $result['cc_identification_mark'],
							'avg_moi' => $result['avg_moi'],
							'chk_den' => $result['chk_den'],
							'den1' => $result['den1'],
							'den2' => $result['den2'],
							'den3' => $result['den3'],
							'iwet1' => $result['iwet1'],
							'iwet2' => $result['iwet2'],
							'iwet3' => $result['iwet3'],
							'fwet1' => $result['fwet1'],
							'fwet2' => $result['fwet2'],
							'fwet3' => $result['fwet3'],
							'vol1' => $result['vol1'],
							'vol2' => $result['vol2'],
							'vol3' => $result['vol3'],
							'dl1' => $result['dl1'],
							'dl2' => $result['dl2'],
							'dl3' => $result['dl3'],
							'dw1' => $result['dw1'],
							'dw2' => $result['dw2'],
							'dw3' => $result['dw3'],
							'dh1' => $result['dh1'],
							'dh2' => $result['dh2'],
							'dh3' => $result['dh3'],
							'avg_den' => $result['avg_den'],
							'cube_grade' => $result['cube_grade'],
							'acc_cor_avg1' => $result['acc_cor_avg1']
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
			$cast_date=$_POST['cast_date'];		
			$cast_time=$_POST['cast_time'];		
			
			$chk_fle = $_POST['chk_fle'];
			$age1 = $_POST['age1'];
			$age2 = $_POST['age2'];
			$age3 = $_POST['age3'];
			$l1 = $_POST['l1'];
			$l2 = $_POST['l2'];
			$l3 = $_POST['l3'];
			$b1 = $_POST['b1'];
			$b2 = $_POST['b2'];
			$b3 = $_POST['b3'];
			$d1 = $_POST['d1'];
			$d2 = $_POST['d2'];
			$d3 = $_POST['d3'];
			$len1 = $_POST['len1'];
			$len2 = $_POST['len2'];
			$len3 = $_POST['len3'];
			$max1 = $_POST['max1'];
			$max2 = $_POST['max2'];
			$max3 = $_POST['max3'];
			$pos1 = $_POST['pos1'];
			$pos2 = $_POST['pos2'];
			$pos3 = $_POST['pos3'];
			$mod1 = $_POST['mod1'];
			$mod2 = $_POST['mod2'];
			$mod3 = $_POST['mod3'];
			$avg1 = $_POST['avg1'];
			$avg2 = $_POST['avg2'];
			$avg3 = $_POST['avg3'];
			$chk_com = $_POST['chk_com'];
			$loc1 = $_POST['loc1'];
			$loc2 = $_POST['loc2'];
			$loc3 = $_POST['loc3'];
			$loc4 = $_POST['loc4'];
			$loc5 = $_POST['loc5'];
			$loc6 = $_POST['loc6'];
			$loc7 = $_POST['loc7'];
			$loc8 = $_POST['loc8'];
			$loc9 = $_POST['loc9'];
			$weight1 = $_POST['weight1'];
			$weight2 = $_POST['weight2'];
			$weight3 = $_POST['weight3'];
			$weight4 = $_POST['weight4'];
			$weight5 = $_POST['weight5'];
			$weight6 = $_POST['weight6'];
			$weight7 = $_POST['weight7'];
			$weight8 = $_POST['weight8'];
			$weight9 = $_POST['weight9'];
			$dia1 = $_POST['dia1'];
			$dia2 = $_POST['dia2'];
			$dia3 = $_POST['dia3'];
			$dia4 = $_POST['dia4'];
			$dia5 = $_POST['dia5'];
			$dia6 = $_POST['dia6'];
			$dia7 = $_POST['dia7'];
			$dia8 = $_POST['dia8'];
			$dia9 = $_POST['dia9'];
			$height1 = $_POST['height1'];
			$height2 = $_POST['height2'];
			$height3 = $_POST['height3'];
			$height4 = $_POST['height4'];
			$height5 = $_POST['height5'];
			$height6 = $_POST['height6'];
			$height7 = $_POST['height7'];
			$height8 = $_POST['height8'];
			$height9 = $_POST['height9'];
			$ratio1 = $_POST['ratio1'];
			$ratio2 = $_POST['ratio2'];
			$ratio3 = $_POST['ratio3'];
			$ratio4 = $_POST['ratio4'];
			$ratio5 = $_POST['ratio5'];
			$ratio6 = $_POST['ratio6'];
			$ratio7 = $_POST['ratio7'];
			$ratio8 = $_POST['ratio8'];
			$ratio9 = $_POST['ratio9'];
			$area1 = $_POST['area1'];
			$area2 = $_POST['area2'];
			$area3 = $_POST['area3'];
			$area4 = $_POST['area4'];
			$area5 = $_POST['area5'];
			$area6 = $_POST['area6'];
			$area7 = $_POST['area7'];
			$area8 = $_POST['area8'];
			$area9 = $_POST['area9'];
			$load1 = $_POST['load1'];
			$load2 = $_POST['load2'];
			$load3 = $_POST['load3'];
			$load4 = $_POST['load4'];
			$load5 = $_POST['load5'];
			$load6 = $_POST['load6'];
			$load7 = $_POST['load7'];
			$load8 = $_POST['load8'];
			$load9 = $_POST['load9'];
			$com1 = $_POST['com1'];
			$com2 = $_POST['com2'];
			$com3 = $_POST['com3'];
			$com4 = $_POST['com4'];
			$com5 = $_POST['com5'];
			$com6 = $_POST['com6'];
			$com7 = $_POST['com7'];
			$com8 = $_POST['com8'];
			$com9 = $_POST['com9'];
			$cor_a1 = $_POST['cor_a1'];
			$cor_a2 = $_POST['cor_a2'];
			$cor_a3 = $_POST['cor_a3'];
			$cor_a4 = $_POST['cor_a4'];
			$cor_a5 = $_POST['cor_a5'];
			$cor_a6 = $_POST['cor_a6'];
			$cor_a7 = $_POST['cor_a7'];
			$cor_a8 = $_POST['cor_a8'];
			$cor_a9 = $_POST['cor_a9'];
			$cor_b1 = $_POST['cor_b1'];
			$cor_b2 = $_POST['cor_b2'];
			$cor_b3 = $_POST['cor_b3'];
			$cor_b4 = $_POST['cor_b4'];
			$cor_b5 = $_POST['cor_b5'];
			$cor_b6 = $_POST['cor_b6'];
			$cor_b7 = $_POST['cor_b7'];
			$cor_b8 = $_POST['cor_b8'];
			$cor_b9 = $_POST['cor_b9'];
			$cor_str1 = $_POST['cor_str1'];
			$cor_str2 = $_POST['cor_str2'];
			$cor_str3 = $_POST['cor_str3'];
			$cor_str4 = $_POST['cor_str4'];
			$cor_str5 = $_POST['cor_str5'];
			$cor_str6 = $_POST['cor_str6'];
			$cor_str7 = $_POST['cor_str7'];
			$cor_str8 = $_POST['cor_str8'];
			$cor_str9 = $_POST['cor_str9'];
			$cube_str1 = $_POST['cube_str1'];
			$cube_str2 = $_POST['cube_str2'];
			$cube_str3 = $_POST['cube_str3'];
			$cube_str4 = $_POST['cube_str4'];
			$cube_str5 = $_POST['cube_str5'];
			$cube_str6 = $_POST['cube_str6'];
			$cube_str7 = $_POST['cube_str7'];
			$cube_str8 = $_POST['cube_str8'];
			$cube_str9 = $_POST['cube_str9'];
			$cube_avg1 = $_POST['cube_avg1'];
			$cube_avg2 = $_POST['cube_avg2'];
			$cube_avg3 = $_POST['cube_avg3'];
			$chk_spl = $_POST['chk_spl'];
			$d_read1_1 = $_POST['d_read1_1'];
			$d_read1_2 = $_POST['d_read1_2'];
			$d_read1_3 = $_POST['d_read1_3'];
			$d_read2_1 = $_POST['d_read2_1'];
			$d_read2_2 = $_POST['d_read2_2'];
			$d_read2_3 = $_POST['d_read2_3'];
			$d_read3_1 = $_POST['d_read3_1'];
			$d_read3_2 = $_POST['d_read3_2'];
			$d_read3_3 = $_POST['d_read3_3'];
			$avg_dia1 = $_POST['avg_dia1'];
			$avg_dia2 = $_POST['avg_dia2'];
			$avg_dia3 = $_POST['avg_dia3'];
			$l_read1_1 = $_POST['l_read1_1'];
			$l_read1_2 = $_POST['l_read1_2'];
			$l_read1_3 = $_POST['l_read1_3'];
			$l_read2_1 = $_POST['l_read2_1'];
			$l_read2_2 = $_POST['l_read2_2'];
			$l_read2_3 = $_POST['l_read2_3'];
			$avg_len1 = $_POST['avg_len1'];
			$avg_len2 = $_POST['avg_len2'];
			$avg_len3 = $_POST['avg_len3'];
			$spl_load1 = $_POST['spl_load1'];
			$spl_load2 = $_POST['spl_load2'];
			$spl_load3 = $_POST['spl_load3'];
			$spl_str1 = $_POST['spl_str1'];
			$spl_str2 = $_POST['spl_str2'];
			$spl_avg1 = $_POST['spl_avg1'];
			$spl_avg2 = $_POST['spl_avg2'];
			$average = $_POST['average'];
			$chk_acc = $_POST['chk_acc'];
			$acc1 = $_POST['acc1'];
			$acc2 = $_POST['acc2'];
			$acc3 = $_POST['acc3'];
			$acc4 = $_POST['acc4'];
			$acc5 = $_POST['acc5'];
			$acc6 = $_POST['acc6'];
			$remark = $_POST['remark'];
			$remark_1 = $_POST['remark_1'];
			$remark_2 = $_POST['remark_2'];
			$acc1_2 = $_POST['acc1_2'];
			$acc2_2 = $_POST['acc2_2'];
			$acc3_2 = $_POST['acc3_2'];
			$acc4_2 = $_POST['acc4_2'];
			$acc5_2 = $_POST['acc5_2'];
			$acc_id1 = $_POST['acc_id1'];
			$acc_id2 = $_POST['acc_id2'];
			$acc_id3 = $_POST['acc_id3'];
			$acc_w1 = $_POST['acc_w1'];
			$acc_w2 = $_POST['acc_w2'];
			$acc_w3 = $_POST['acc_w3'];
			$acc_l1 = $_POST['acc_l1'];
			$acc_l2 = $_POST['acc_l2'];
			$acc_l3 = $_POST['acc_l3'];
			$acc_width1 = $_POST['acc_width1'];
			$acc_width2 = $_POST['acc_width2'];
			$acc_width3 = $_POST['acc_width3'];
			$acc_height1 = $_POST['acc_height1'];
			$acc_height2 = $_POST['acc_height2'];
			$acc_height3 = $_POST['acc_height3'];
			$acc_area1 = $_POST['acc_area1'];
			$acc_area2 = $_POST['acc_area2'];
			$acc_area3 = $_POST['acc_area3'];
			$acc_load1 = $_POST['acc_load1'];
			$acc_load2 = $_POST['acc_load2'];
			$acc_load3 = $_POST['acc_load3'];
			$acc_com1 = $_POST['acc_com1'];
			$acc_com2 = $_POST['acc_com2'];
			$acc_com3 = $_POST['acc_com3'];
			$acc_avg1 = $_POST['acc_avg1'];
			$acc_avg2 = $_POST['acc_avg2'];
			$acc_avg3 = $_POST['acc_avg3'];
			$acc_r28 = $_POST['acc_r28'];
			$chk_dry = $_POST['chk_dry'];
			$dry_avg_1 = $_POST['dry_avg_1'];
			$dry_avg_2 = $_POST['dry_avg_2'];
			$dry_avg_3 = $_POST['dry_avg_3'];
			$dry_r1_1 = $_POST['dry_r1_1'];
			$dry_r1_2 = $_POST['dry_r1_2'];
			$dry_r1_3 = $_POST['dry_r1_3'];
			$dry_r2_1 = $_POST['dry_r2_1'];
			$dry_r2_2 = $_POST['dry_r2_2'];
			$dry_r2_3 = $_POST['dry_r2_3'];
			$dry_r3_1 = $_POST['dry_r3_1'];
			$dry_r3_2 = $_POST['dry_r3_2'];
			$dry_r3_3 = $_POST['dry_r3_3'];
			$dry_r4_1 = $_POST['dry_r4_1'];
			$dry_r4_2 = $_POST['dry_r4_2'];
			$dry_r4_3 = $_POST['dry_r4_3'];
			$dry_r5_1 = $_POST['dry_r5_1'];
			$dry_r5_2 = $_POST['dry_r5_2'];
			$dry_r5_3 = $_POST['dry_r5_3'];
			$dry_r6_1 = $_POST['dry_r6_1'];
			$dry_r6_2 = $_POST['dry_r6_2'];
			$dry_r6_3 = $_POST['dry_r6_3'];
			$dry_len_1 = $_POST['dry_len_1'];
			$dry_len_2 = $_POST['dry_len_2'];
			$dry_len_3 = $_POST['dry_len_3'];
			$dry_shr_1 = $_POST['dry_shr_1'];
			$dry_shr_2 = $_POST['dry_shr_2'];
			$dry_shr_3 = $_POST['dry_shr_3'];
			$dry_wtr_1 = $_POST['dry_wtr_1'];
			$dry_wtr_2 = $_POST['dry_wtr_2'];
			$dry_wtr_3 = $_POST['dry_wtr_3'];
			$dry_moi_1 = $_POST['dry_moi_1'];
			$dry_moi_2 = $_POST['dry_moi_2'];
			$dry_moi_3 = $_POST['dry_moi_3'];
			$avg_dry_shr = $_POST['avg_dry_shr'];
			$avg_moi = $_POST['avg_moi'];
			$top_grade = $_POST['top_grade'];
			$cc_identification_mark = $_POST['cc_identification_mark'];
			
			$chk_den = $_POST['chk_den'];
			$den1 = $_POST['den1'];
			$den2 = $_POST['den2'];
			$den3 = $_POST['den3'];
			$iwet1 = $_POST['iwet1'];
			$iwet2 = $_POST['iwet2'];
			$iwet3 = $_POST['iwet3'];
			$fwet1 = $_POST['fwet1'];
			$fwet2 = $_POST['fwet2'];
			$fwet3 = $_POST['fwet3'];
			$vol1 = $_POST['vol1'];
			$vol2 = $_POST['vol2'];
			$vol3 = $_POST['vol3'];
			$dl1 = $_POST['dl1'];
			$dl2 = $_POST['dl2'];
			$dl3 = $_POST['dl3'];
			$dw1 = $_POST['dw1'];
			$dw2 = $_POST['dw2'];
			$dw3 = $_POST['dw3'];
			$dh1 = $_POST['dh1'];
			$dh2 = $_POST['dh2'];
			$dh3 = $_POST['dh3'];
			$avg_den = $_POST['avg_den'];
			$cube_grade = $_POST['cube_grade'];
			$acc_cor_avg1 = $_POST['acc_cor_avg1'];
			
			$curr_date=date("Y-m-d");
			
			
			
		    $insert="INSERT INTO `hard_concrete`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_fle`, `age1`, `age2`, `age3`, `l1`, `l2`, `l3`, `b1`, `b2`, `b3`, `d1`, `d2`, `d3`, `len1`, `len2`, `len3`, `max1`, `max2`, `max3`, `pos1`, `pos2`, `pos3`, `mod1`, `mod2`, `mod3`, `avg1`, `avg2`, `avg3`, `chk_com`, `loc1`, `loc2`, `loc3`, `loc4`, `loc5`, `loc6`, `loc7`, `loc8`, `loc9`, `weight1`, `weight2`, `weight3`, `weight4`, `weight5`, `weight6`, `weight7`, `weight8`, `weight9`, `dia1`, `dia2`, `dia3`, `dia4`, `dia5`, `dia6`, `dia7`, `dia8`, `dia9`, `height1`, `height2`, `height3`, `height4`, `height5`, `height6`, `height7`, `height8`, `height9`, `ratio1`, `ratio2`, `ratio3`, `ratio4`, `ratio5`, `ratio6`, `ratio7`, `ratio8`, `ratio9`, `area1`, `area2`, `area3`, `area4`, `area5`, `area6`, `area7`, `area8`, `area9`, `load1`, `load2`, `load3`, `load4`, `load5`, `load6`, `load7`, `load8`, `load9`, `com1`, `com2`, `com3`, `com4`, `com5`, `com6`, `com7`, `com8`, `com9`, `cor_a1`, `cor_a2`, `cor_a3`, `cor_a4`, `cor_a5`, `cor_a6`, `cor_a7`, `cor_a8`, `cor_a9`, `cor_b1`, `cor_b2`, `cor_b3`, `cor_b4`, `cor_b5`, `cor_b6`, `cor_b7`, `cor_b8`, `cor_b9`, `cor_str1`, `cor_str2`, `cor_str3`, `cor_str4`, `cor_str5`, `cor_str6`, `cor_str7`, `cor_str8`, `cor_str9`, `cube_str1`, `cube_str2`, `cube_str3`, `cube_str4`, `cube_str5`, `cube_str6`, `cube_str7`, `cube_str8`, `cube_str9`, `cube_avg1`, `cube_avg2`, `cube_avg3`, `chk_spl`, `d_read1_1`, `d_read1_2`, `d_read1_3`, `d_read2_1`, `d_read2_2`, `d_read2_3`, `d_read3_1`, `d_read3_2`, `d_read3_3`, `avg_dia1`, `avg_dia2`, `avg_dia3`, `l_read1_1`, `l_read1_2`, `l_read1_3`, `l_read2_1`, `l_read2_2`, `l_read2_3`, `avg_len1`, `avg_len2`, `avg_len3`, `spl_load1`, `spl_load2`, `spl_load3`, `spl_str1`, `spl_str2`, `spl_avg1`, `spl_avg2`, `average`, `chk_acc`, `cast_date`, `cast_time`, `acc1`, `acc2`, `acc3`, `acc4`, `acc5`, `acc6`, `remark`, `remark_1`, `remark_2`,  `acc1_2`, `acc2_2`, `acc3_2`, `acc4_2`, `acc5_2`, `acc_id1`, `acc_id2`, `acc_id3`, `acc_w1`, `acc_w2`, `acc_w3`, `acc_l1`, `acc_l2`, `acc_l3`, `acc_width1`, `acc_width2`, `acc_width3`, `acc_height1`, `acc_height2`, `acc_height3`, `acc_area1`, `acc_area2`, `acc_area3`, `acc_load1`, `acc_load2`, `acc_load3`, `acc_com1`, `acc_com2`, `acc_com3`, `acc_avg1`, `acc_avg2`, `acc_avg3`, `acc_r28`,  `chk_dry`, `dry_avg_1`, `dry_avg_2`, `dry_avg_3`, `dry_r1_1`, `dry_r1_2`, `dry_r1_3`, `dry_r2_1`, `dry_r2_2`, `dry_r2_3`, `dry_r3_1`, `dry_r3_2`, `dry_r3_3`, `dry_r4_1`, `dry_r4_2`, `dry_r4_3`, `dry_r5_1`, `dry_r5_2`, `dry_r5_3`, `dry_r6_1`, `dry_r6_2`, `dry_r6_3`, `dry_len_1`, `dry_len_2`, `dry_len_3`, `dry_shr_1`, `dry_shr_2`, `dry_shr_3`, `dry_wtr_1`, `dry_wtr_2`, `dry_wtr_3`, `dry_moi_1`, `dry_moi_2`, `dry_moi_3`, `avg_dry_shr`, `avg_moi`, `top_grade`, `cc_identification_mark`, `chk_den`, `den1`, `den2`, `den3`, `iwet1`, `iwet2`, `iwet3`, `fwet1`, `fwet2`, `fwet3`, `vol1`, `vol2`, `vol3`, `dl1`, `dl2`, `dl3`, `dw1`, `dw2`, `dw3`, `dh1`, `dh2`, `dh3`, `avg_den`, `cube_grade`,`acc_cor_avg1`,`amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_fle', '$age1', '$age2', '$age3', '$l1', '$l2', '$l3', '$b1', '$b2', '$b3', '$d1', '$d2', '$d3', '$len1', '$len2', '$len3', '$max1', '$max2', '$max3', '$pos1', '$pos2', '$pos3', '$mod1', '$mod2', '$mod3', '$avg1', '$avg2', '$avg3', '$chk_com', '$loc1', '$loc2', '$loc3', '$loc4', '$loc5', '$loc6', '$loc7', '$loc8', '$loc9', '$weight1', '$weight2', '$weight3', '$weight4', '$weight5', '$weight6', '$weight7', '$weight8', '$weight9', '$dia1', '$dia2', '$dia3', '$dia4', '$dia5', '$dia6', '$dia7', '$dia8', '$dia9', '$height1', '$height2', '$height3', '$height4', '$height5', '$height6', '$height7', '$height8', '$height9', '$ratio1', '$ratio2', '$ratio3', '$ratio4', '$ratio5', '$ratio6', '$ratio7', '$ratio8', '$ratio9', '$area1', '$area2', '$area3', '$area4', '$area5', '$area6', '$area7', '$area8', '$area9', '$load1', '$load2', '$load3', '$load4', '$load5', '$load6', '$load7', '$load8', '$load9', '$com1', '$com2', '$com3', '$com4', '$com5', '$com6', '$com7', '$com8', '$com9', '$cor_a1', '$cor_a2', '$cor_a3', '$cor_a4', '$cor_a5', '$cor_a6', '$cor_a7', '$cor_a8', '$cor_a9', '$cor_b1', '$cor_b2', '$cor_b3', '$cor_b4', '$cor_b5', '$cor_b6', '$cor_b7', '$cor_b8', '$cor_b9', '$cor_str1', '$cor_str2', '$cor_str3', '$cor_str4', '$cor_str5', '$cor_str6', '$cor_str7', '$cor_str8', '$cor_str9', '$cube_str1', '$cube_str2', '$cube_str3', '$cube_str4', '$cube_str5', '$cube_str6', '$cube_str7', '$cube_str8', '$cube_str9', '$cube_avg1', '$cube_avg2', '$cube_avg3', '$chk_spl', '$d_read1_1', '$d_read1_2', '$d_read1_3', '$d_read2_1', '$d_read2_2', '$d_read2_3', '$d_read3_1', '$d_read3_2', '$d_read3_3', '$avg_dia1', '$avg_dia2', '$avg_dia3', '$l_read1_1', '$l_read1_2', '$l_read1_3', '$l_read2_1', '$l_read2_2', '$l_read2_3', '$avg_len1', '$avg_len2', '$avg_len3', '$spl_load1', '$spl_load2', '$spl_load3', '$spl_str1', '$spl_str2', '$spl_avg1', '$spl_avg2', '$average', '$chk_acc', '$cast_date', '$cast_time', '$acc1', '$acc2', '$acc3', '$acc4', '$acc5', '$acc6', '$remark', '$remark_1', '$remark_2', '$acc1_2', '$acc2_2', '$acc3_2', '$acc4_2', '$acc5_2', '$acc_id1', '$acc_id2', '$acc_id3', '$acc_w1', '$acc_w2', '$acc_w3', '$acc_l1', '$acc_l2', '$acc_l3', '$acc_width1', '$acc_width2', '$acc_width3', '$acc_height1', '$acc_height2', '$acc_height3', '$acc_area1', '$acc_area2', '$acc_area3', '$acc_load1', '$acc_load2', '$acc_load3', '$acc_com1', '$acc_com2', '$acc_com3', '$acc_avg1', '$acc_avg2', '$acc_avg3', '$acc_r28','$chk_dry', '$dry_avg_1', '$dry_avg_2', '$dry_avg_3', '$dry_r1_1', '$dry_r1_2', '$dry_r1_3', '$dry_r2_1', '$dry_r2_2', '$dry_r2_3', '$dry_r3_1', '$dry_r3_2', '$dry_r3_3', '$dry_r4_1', '$dry_r4_2', '$dry_r4_3', '$dry_r5_1', '$dry_r5_2', '$dry_r5_3', '$dry_r6_1', '$dry_r6_2', '$dry_r6_3', '$dry_len_1', '$dry_len_2', '$dry_len_3', '$dry_shr_1', '$dry_shr_2', '$dry_shr_3', '$dry_wtr_1', '$dry_wtr_2', '$dry_wtr_3', '$dry_moi_1', '$dry_moi_2', '$dry_moi_3', '$avg_dry_shr', '$avg_moi', '$top_grade', '$cc_identification_mark', '$chk_den', '$den1', '$den2', '$den3', '$iwet1', '$iwet2', '$iwet3', '$fwet1', '$fwet2', '$fwet3', '$vol1', '$vol2', '$vol3', '$dl1', '$dl2', '$dl3', '$dw1', '$dw2', '$dw3', '$dh1', '$dh2', '$dh3', '$avg_den', '$cube_grade','$acc_cor_avg1','$amend_date')"; 

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
													 $query = "select * from `hard_concrete` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
	else if($_POST['action_type'] == 'edit')
	{
		
		
		$curr_date=date("Y-m-d");
		
				
		
	 $update="update hard_concrete SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,	
					`chk_fle` = '$_POST[chk_fle]',
					`age1` = '$_POST[age1]',
					`age2` = '$_POST[age2]',
					`age3` = '$_POST[age3]',
					`l1` = '$_POST[l1]',
					`l2` = '$_POST[l2]',
					`l3` = '$_POST[l3]',
					`b1` = '$_POST[b1]',
					`b2` = '$_POST[b2]',
					`b3` = '$_POST[b3]',
					`d1` = '$_POST[d1]',
					`d2` = '$_POST[d2]',
					`d3` = '$_POST[d3]',
					`len1` = '$_POST[len1]',
					`len2` = '$_POST[len2]',
					`len3` = '$_POST[len3]',
					`max1` = '$_POST[max1]',
					`max2` = '$_POST[max2]',
					`max3` = '$_POST[max3]',
					`pos1` = '$_POST[pos1]',
					`pos2` = '$_POST[pos2]',
					`pos3` = '$_POST[pos3]',
					`mod1` = '$_POST[mod1]',
					`mod2` = '$_POST[mod2]',
					`mod3` = '$_POST[mod3]',
					`avg1` = '$_POST[avg1]',
					`avg2` = '$_POST[avg2]',
					`avg3` = '$_POST[avg3]',
					`chk_com` = '$_POST[chk_com]',
					`loc1` = '$_POST[loc1]',
					`loc2` = '$_POST[loc2]',
					`loc3` = '$_POST[loc3]',
					`loc4` = '$_POST[loc4]',
					`loc5` = '$_POST[loc5]',
					`loc6` = '$_POST[loc6]',
					`loc7` = '$_POST[loc7]',
					`loc8` = '$_POST[loc8]',
					`loc9` = '$_POST[loc9]',
					`weight1` = '$_POST[weight1]',
					`weight2` = '$_POST[weight2]',
					`weight3` = '$_POST[weight3]',
					`weight4` = '$_POST[weight4]',
					`weight5` = '$_POST[weight5]',
					`weight6` = '$_POST[weight6]',
					`weight7` = '$_POST[weight7]',
					`weight8` = '$_POST[weight8]',
					`weight9` = '$_POST[weight9]',
					`dia1` = '$_POST[dia1]',
					`dia2` = '$_POST[dia2]',
					`dia3` = '$_POST[dia3]',
					`dia4` = '$_POST[dia4]',
					`dia5` = '$_POST[dia5]',
					`dia6` = '$_POST[dia6]',
					`dia7` = '$_POST[dia7]',
					`dia8` = '$_POST[dia8]',
					`dia9` = '$_POST[dia9]',
					`height1` = '$_POST[height1]',
					`height2` = '$_POST[height2]',
					`height3` = '$_POST[height3]',
					`height4` = '$_POST[height4]',
					`height5` = '$_POST[height5]',
					`height6` = '$_POST[height6]',
					`height7` = '$_POST[height7]',
					`height8` = '$_POST[height8]',
					`height9` = '$_POST[height9]',
					`ratio1` = '$_POST[ratio1]',
					`ratio2` = '$_POST[ratio2]',
					`ratio3` = '$_POST[ratio3]',
					`ratio4` = '$_POST[ratio4]',
					`ratio5` = '$_POST[ratio5]',
					`ratio6` = '$_POST[ratio6]',
					`ratio7` = '$_POST[ratio7]',
					`ratio8` = '$_POST[ratio8]',
					`ratio9` = '$_POST[ratio9]',
					`area1` = '$_POST[area1]',
					`area2` = '$_POST[area2]',
					`area3` = '$_POST[area3]',
					`area4` = '$_POST[area4]',
					`area5` = '$_POST[area5]',
					`area6` = '$_POST[area6]',
					`area7` = '$_POST[area7]',
					`area8` = '$_POST[area8]',
					`area9` = '$_POST[area9]',
					`load1` = '$_POST[load1]',
					`load2` = '$_POST[load2]',
					`load3` = '$_POST[load3]',
					`load4` = '$_POST[load4]',
					`load5` = '$_POST[load5]',
					`load6` = '$_POST[load6]',
					`load7` = '$_POST[load7]',
					`load8` = '$_POST[load8]',
					`load9` = '$_POST[load9]',
					`com1` = '$_POST[com1]',
					`com2` = '$_POST[com2]',
					`com3` = '$_POST[com3]',
					`com4` = '$_POST[com4]',
					`com5` = '$_POST[com5]',
					`com6` = '$_POST[com6]',
					`com7` = '$_POST[com7]',
					`com8` = '$_POST[com8]',
					`com9` = '$_POST[com9]',
					`cor_a1` = '$_POST[cor_a1]',
					`cor_a2` = '$_POST[cor_a2]',
					`cor_a3` = '$_POST[cor_a3]',
					`cor_a4` = '$_POST[cor_a4]',
					`cor_a5` = '$_POST[cor_a5]',
					`cor_a6` = '$_POST[cor_a6]',
					`cor_a7` = '$_POST[cor_a7]',
					`cor_a8` = '$_POST[cor_a8]',
					`cor_a9` = '$_POST[cor_a9]',
					`cor_b1` = '$_POST[cor_b1]',
					`cor_b2` = '$_POST[cor_b2]',
					`cor_b3` = '$_POST[cor_b3]',
					`cor_b4` = '$_POST[cor_b4]',
					`cor_b5` = '$_POST[cor_b5]',
					`cor_b6` = '$_POST[cor_b6]',
					`cor_b7` = '$_POST[cor_b7]',
					`cor_b8` = '$_POST[cor_b8]',
					`cor_b9` = '$_POST[cor_b9]',
					`cor_str1` = '$_POST[cor_str1]',
					`cor_str2` = '$_POST[cor_str2]',
					`cor_str3` = '$_POST[cor_str3]',
					`cor_str4` = '$_POST[cor_str4]',
					`cor_str5` = '$_POST[cor_str5]',
					`cor_str6` = '$_POST[cor_str6]',
					`cor_str7` = '$_POST[cor_str7]',
					`cor_str8` = '$_POST[cor_str8]',
					`cor_str9` = '$_POST[cor_str9]',
					`cube_str1` = '$_POST[cube_str1]',
					`cube_str2` = '$_POST[cube_str2]',
					`cube_str3` = '$_POST[cube_str3]',
					`cube_str4` = '$_POST[cube_str4]',
					`cube_str5` = '$_POST[cube_str5]',
					`cube_str6` = '$_POST[cube_str6]',
					`cube_str7` = '$_POST[cube_str7]',
					`cube_str8` = '$_POST[cube_str8]',
					`cube_str9` = '$_POST[cube_str9]',
					`cube_avg1` = '$_POST[cube_avg1]',
					`cube_avg2` = '$_POST[cube_avg2]',
					`cube_avg3` = '$_POST[cube_avg3]',
					`chk_spl` = '$_POST[chk_spl]',
					`d_read1_1` = '$_POST[d_read1_1]',
					`d_read1_2` = '$_POST[d_read1_2]',
					`d_read1_3` = '$_POST[d_read1_3]',
					`d_read2_1` = '$_POST[d_read2_1]',
					`d_read2_2` = '$_POST[d_read2_2]',
					`d_read2_3` = '$_POST[d_read2_3]',
					`d_read3_1` = '$_POST[d_read3_1]',
					`d_read3_2` = '$_POST[d_read3_2]',
					`d_read3_3` = '$_POST[d_read3_3]',
					`avg_dia1` = '$_POST[avg_dia1]',
					`avg_dia2` = '$_POST[avg_dia2]',
					`avg_dia3` = '$_POST[avg_dia3]',
					`l_read1_1` = '$_POST[l_read1_1]',
					`l_read1_2` = '$_POST[l_read1_2]',
					`l_read1_3` = '$_POST[l_read1_3]',
					`l_read2_1` = '$_POST[l_read2_1]',
					`l_read2_2` = '$_POST[l_read2_2]',
					`l_read2_3` = '$_POST[l_read2_3]',
					`avg_len1` = '$_POST[avg_len1]',
					`avg_len2` = '$_POST[avg_len2]',
					`avg_len3` = '$_POST[avg_len3]',
					`spl_load1` = '$_POST[spl_load1]',
					`spl_load2` = '$_POST[spl_load2]',
					`spl_load3` = '$_POST[spl_load3]',
					`spl_str1` = '$_POST[spl_str1]',
					`spl_str2` = '$_POST[spl_str2]',
					`spl_avg1` = '$_POST[spl_avg1]',
					`spl_avg2` = '$_POST[spl_avg2]',
					`chk_acc` = '$_POST[chk_acc]',
					`cast_date` = '$_POST[cast_date]',
					`cast_time` = '$_POST[cast_time]',
					`average` = '$_POST[average]',
					`acc1` = '$_POST[acc1]',
					`acc2` = '$_POST[acc2]',
					`acc3` = '$_POST[acc3]',
					`acc4` = '$_POST[acc4]',
					`acc5` = '$_POST[acc5]',
					`acc6` = '$_POST[acc6]',
					`remark` = '$_POST[remark]',
					`remark_1` = '$_POST[remark_1]',
					`remark_2` = '$_POST[remark_2]',
					`acc1_2` = '$_POST[acc1_2]',
					`acc2_2` = '$_POST[acc2_2]',
					`acc3_2` = '$_POST[acc3_2]',
					`acc4_2` = '$_POST[acc4_2]',
					`acc5_2` = '$_POST[acc5_2]',
					`acc_id1` = '$_POST[acc_id1]',
					`acc_id2` = '$_POST[acc_id2]',
					`acc_id3` = '$_POST[acc_id3]',
					`acc_w1` = '$_POST[acc_w1]',
					`acc_w2` = '$_POST[acc_w2]',
					`acc_w3` = '$_POST[acc_w3]',
					`acc_l1` = '$_POST[acc_l1]',
					`acc_l2` = '$_POST[acc_l2]',
					`acc_l3` = '$_POST[acc_l3]',
					`acc_width1` = '$_POST[acc_width1]',
					`acc_width2` = '$_POST[acc_width2]',
					`acc_width3` = '$_POST[acc_width3]',
					`acc_height1` = '$_POST[acc_height1]',
					`acc_height2` = '$_POST[acc_height2]',
					`acc_height3` = '$_POST[acc_height3]',
					`acc_area1` = '$_POST[acc_area1]',
					`acc_area2` = '$_POST[acc_area2]',
					`acc_area3` = '$_POST[acc_area3]',
					`acc_load1` = '$_POST[acc_load1]',
					`acc_load2` = '$_POST[acc_load2]',
					`acc_load3` = '$_POST[acc_load3]',
					`acc_com1` = '$_POST[acc_com1]',
					`acc_com2` = '$_POST[acc_com2]',
					`acc_com3` = '$_POST[acc_com3]',
					`acc_avg1` = '$_POST[acc_avg1]',
					`acc_avg2` = '$_POST[acc_avg2]',
					`acc_avg3` = '$_POST[acc_avg3]',
					`acc_r28` = '$_POST[acc_r28]',
					`chk_dry`= '$_POST[chk_dry]',
					`dry_avg_1`='$_POST[dry_avg_1]',
					`dry_avg_2`='$_POST[dry_avg_2]',
					`dry_avg_3`='$_POST[dry_avg_3]',
					`dry_r1_1`='$_POST[dry_r1_1]',
					`dry_r1_2`='$_POST[dry_r1_2]',
					`dry_r1_3`='$_POST[dry_r1_3]',
					`dry_r2_1`='$_POST[dry_r2_1]',
					`dry_r2_2`='$_POST[dry_r2_2]',
					`dry_r2_3`='$_POST[dry_r2_3]',
					`dry_r3_1`='$_POST[dry_r3_1]',
					`dry_r3_2`='$_POST[dry_r3_2]',
					`dry_r3_3`='$_POST[dry_r3_3]',
					`dry_r4_1`='$_POST[dry_r4_1]',
					`dry_r4_2`='$_POST[dry_r4_2]',
					`dry_r4_3`='$_POST[dry_r4_3]',
					`dry_r5_1`='$_POST[dry_r5_1]',
					`dry_r5_2`='$_POST[dry_r5_2]',
					`dry_r5_3`='$_POST[dry_r5_3]',
					`dry_r6_1`='$_POST[dry_r6_1]',
					`dry_r6_2`='$_POST[dry_r6_2]',
					`dry_r6_3`='$_POST[dry_r6_3]',
					`dry_len_1`='$_POST[dry_len_1]',
					`dry_len_2`='$_POST[dry_len_2]',
					`dry_len_3`='$_POST[dry_len_3]',
					`dry_shr_1`='$_POST[dry_shr_1]',
					`dry_shr_2`='$_POST[dry_shr_2]',
					`dry_shr_3`='$_POST[dry_shr_3]',
					`dry_wtr_1`='$_POST[dry_wtr_1]',
					`dry_wtr_2`='$_POST[dry_wtr_2]',
					`dry_wtr_3`='$_POST[dry_wtr_3]',
					`dry_moi_1`='$_POST[dry_moi_1]',
					`dry_moi_2`='$_POST[dry_moi_2]',
					`dry_moi_3`='$_POST[dry_moi_3]',
					`avg_dry_shr`='$_POST[avg_dry_shr]',
					`top_grade`='$_POST[top_grade]',
					`cc_identification_mark`='$_POST[cc_identification_mark]',
					`chk_den` = '$_POST[chk_den]',
					`den1` = '$_POST[den1]',
					`den2` = '$_POST[den2]',
					`den3` = '$_POST[den3]',
					`iwet1` = '$_POST[iwet1]',
					`iwet2` = '$_POST[iwet2]',
					`iwet3` = '$_POST[iwet3]',
					`fwet1` = '$_POST[fwet1]',
					`fwet2` = '$_POST[fwet2]',
					`fwet3` = '$_POST[fwet3]',
					`vol1` = '$_POST[vol1]',
					`vol2` = '$_POST[vol2]',
					`vol3` = '$_POST[vol3]',
					`dl1` = '$_POST[dl1]',
					`dl2` = '$_POST[dl2]',
					`dl3` = '$_POST[dl3]',
					`dw1` = '$_POST[dw1]',
					`dw2` = '$_POST[dw2]',
					`dw3` = '$_POST[dw3]',
					`dh1` = '$_POST[dh1]',
					`dh2` = '$_POST[dh2]',
					`dh3` = '$_POST[dh3]',
					`avg_den` = '$_POST[avg_den]',
					`cube_grade` = '$_POST[cube_grade]',
					`avg_moi`='$_POST[avg_moi]',
					`acc_cor_avg1` = '$_POST[acc_cor_avg1]',
					`amend_date` = '$_POST[amend_date]'
					WHERE `id`='$_POST[idEdit]'";

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete')
	{
		
		 $delete="update hard_concrete SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk')
	{
		
		$qry = "SELECT * FROM hard_concrete WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update hard_concrete SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update hard_concrete SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>