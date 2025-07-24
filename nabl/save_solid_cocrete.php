<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from solid_block WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'chk_com' => $result['chk_com'],
							'i1' => $result['i1'],
							'i2' => $result['i2'],
							'i3' => $result['i3'],
							'i4' => $result['i4'],
							'i5' => $result['i5'],
							'i6' => $result['i6'],
							'i7' => $result['i7'],
							'i8' => $result['i8'],
							'length1' => $result['length1'],
							'length2' => $result['length2'],
							'length3' => $result['length3'],
							'length4' => $result['length4'],
							'length5' => $result['length5'],
							'length6' => $result['length6'],
							'length7' => $result['length7'],
							'length8' => $result['length8'],
							'width1' => $result['width1'],
							'width2' => $result['width2'],
							'width3' => $result['width3'],
							'width4' => $result['width4'],
							'width5' => $result['width5'],
							'width6' => $result['width6'],
							'width7' => $result['width7'],
							'width8' => $result['width8'],
							'area1' => $result['area1'],
							'area2' => $result['area2'],
							'area3' => $result['area3'],
							'area4' => $result['area4'],
							'area5' => $result['area5'],
							'area6' => $result['area6'],
							'area7' => $result['area7'],
							'area8' => $result['area8'],
							'load1' => $result['load1'],
							'load2' => $result['load2'],
							'load3' => $result['load3'],
							'load4' => $result['load4'],
							'load5' => $result['load5'],
							'load6' => $result['load6'],
							'load7' => $result['load7'],
							'load8' => $result['load8'],
							'str1' => $result['str1'],
							'str2' => $result['str2'],
							'str3' => $result['str3'],
							'str4' => $result['str4'],
							'str5' => $result['str5'],
							'str6' => $result['str6'],
							'str7' => $result['str7'],
							'str8' => $result['str8'],
							'avg_str' => $result['avg_str'],
							'chk_shr' => $result['chk_shr'],
							'r1_date' => $result['r1_date'],
							'r2_date' => $result['r2_date'],
							'r3_date' => $result['r3_date'],
							'r4_date' => $result['r4_date'],
							'r5_date' => $result['r5_date'],
							'r6_date' => $result['r6_date'],
							'r7_date' => $result['r7_date'],
							'r1_1' => $result['r1_1'],
							'r1_2' => $result['r1_2'],
							'r1_3' => $result['r1_3'],
							'r1_4' => $result['r1_4'],
							'r1_5' => $result['r1_5'],
							'r1_6' => $result['r1_6'],
							'r2_1' => $result['r2_1'],
							'r2_2' => $result['r2_2'],
							'r2_3' => $result['r2_3'],
							'r2_4' => $result['r2_4'],
							'r2_5' => $result['r2_5'],
							'r2_6' => $result['r2_6'],
							'r3_1' => $result['r3_1'],
							'r3_2' => $result['r3_2'],
							'r3_3' => $result['r3_3'],
							'r3_4' => $result['r3_4'],
							'r3_5' => $result['r3_5'],
							'r3_6' => $result['r3_6'],
							'r4_1' => $result['r4_1'],
							'r4_2' => $result['r4_2'],
							'r4_3' => $result['r4_3'],
							'r4_4' => $result['r4_4'],
							'r4_5' => $result['r4_5'],
							'r4_6' => $result['r4_6'],
							'r5_1' => $result['r5_1'],
							'r5_2' => $result['r5_2'],
							'r5_3' => $result['r5_3'],
							'r5_4' => $result['r5_4'],
							'r5_5' => $result['r5_5'],
							'r5_6' => $result['r5_6'],
							'r6_1' => $result['r6_1'],
							'r6_2' => $result['r6_2'],
							'r6_3' => $result['r6_3'],
							'r6_4' => $result['r6_4'],
							'r6_5' => $result['r6_5'],
							'r6_6' => $result['r6_6'],
							'r7_1' => $result['r7_1'],
							'r7_2' => $result['r7_2'],
							'r7_3' => $result['r7_3'],
							'r7_4' => $result['r7_4'],
							'r7_5' => $result['r7_5'],
							'r7_6' => $result['r7_6'],
							'dry1' => $result['dry1'],
							'dry2' => $result['dry2'],
							'dry3' => $result['dry3'],
							'dry4' => $result['dry4'],
							'dry5' => $result['dry5'],
							'dry6' => $result['dry6'],
							'avg_dry' => $result['avg_dry'],
							'age1_1' => $result['age1_1'],
							'age1_2' => $result['age1_2'],
							'age1_3' => $result['age1_3'],
							'age2_1' => $result['age2_1'],
							'age2_2' => $result['age2_2'],
							'age2_3' => $result['age2_3'],
							'avg_mo' => $result['avg_mo'],
							'chk_dim' => $result['chk_dim'],
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
							'l13' => $result['l13'],
							'l14' => $result['l14'],
							'l15' => $result['l15'],
							'l16' => $result['l16'],
							'l17' => $result['l17'],
							'l18' => $result['l18'],
							'l19' => $result['l19'],
							'l20' => $result['l20'],
							'w1' => $result['w1'],
							'w2' => $result['w2'],
							'w3' => $result['w3'],
							'w4' => $result['w4'],
							'w5' => $result['w5'],
							'w6' => $result['w6'],
							'w7' => $result['w7'],
							'w8' => $result['w8'],
							'w9' => $result['w9'],
							'w10' => $result['w10'],
							'w11' => $result['w11'],
							'w12' => $result['w12'],
							'w13' => $result['w13'],
							'w14' => $result['w14'],
							'w15' => $result['w15'],
							'w16' => $result['w16'],
							'w17' => $result['w17'],
							'w18' => $result['w18'],
							'w19' => $result['w19'],
							'w20' => $result['w20'],
							'h1' => $result['h1'],
							'h2' => $result['h2'],
							'h3' => $result['h3'],
							'h4' => $result['h4'],
							'h5' => $result['h5'],
							'h6' => $result['h6'],
							'h7' => $result['h7'],
							'h8' => $result['h8'],
							'h9' => $result['h9'],
							'h10' => $result['h10'],
							'h11' => $result['h11'],
							'h12' => $result['h12'],
							'h13' => $result['h13'],
							'h14' => $result['h14'],
							'h15' => $result['h15'],
							'h16' => $result['h16'],
							'h17' => $result['h17'],
							'h18' => $result['h18'],
							'h19' => $result['h19'],
							'h20' => $result['h20'],
							'avg_length' => $result['avg_length'],
							'avg_width' => $result['avg_width'],
							'avg_height' => $result['avg_height'],
							'chk_wtr' => $result['chk_wtr'],
							'wa_1_1' => $result['wa_1_1'],
							'wa_1_2' => $result['wa_1_2'],
							'wa_1_3' => $result['wa_1_3'],
							'wa_2_1' => $result['wa_2_1'],
							'wa_2_2' => $result['wa_2_2'],
							'wa_2_3' => $result['wa_2_3'],
							'wtr1' => $result['wtr1'],
							'wtr2' => $result['wtr2'],
							'wtr3' => $result['wtr3'],
							'avg_wtr' => $result['avg_wtr'],
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
							'avg_den' => $result['avg_den']
						);	  
			echo json_encode($fill);
		}
		
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];			
			$ulr =  $_POST['ulr'];	
			$amend_date =  $_POST['amend_date'];
					
			$chk_com = $_POST['chk_com'];
			$i1 = $_POST['i1'];
			$i2 = $_POST['i2'];
			$i3 = $_POST['i3'];
			$i4 = $_POST['i4'];
			$i5 = $_POST['i5'];
			$i6 = $_POST['i6'];
			$i7 = $_POST['i7'];
			$i8 = $_POST['i8'];
			$length1 = $_POST['length1'];
			$length2 = $_POST['length2'];
			$length3 = $_POST['length3'];
			$length4 = $_POST['length4'];
			$length5 = $_POST['length5'];
			$length6 = $_POST['length6'];
			$length7 = $_POST['length7'];
			$length8 = $_POST['length8'];
			$width1 = $_POST['width1'];
			$width2 = $_POST['width2'];
			$width3 = $_POST['width3'];
			$width4 = $_POST['width4'];
			$width5 = $_POST['width5'];
			$width6 = $_POST['width6'];
			$width7 = $_POST['width7'];
			$width8 = $_POST['width8'];
			$area1 = $_POST['area1'];
			$area2 = $_POST['area2'];
			$area3 = $_POST['area3'];
			$area4 = $_POST['area4'];
			$area5 = $_POST['area5'];
			$area6 = $_POST['area6'];
			$area7 = $_POST['area7'];
			$area8 = $_POST['area8'];
			$load1 = $_POST['load1'];
			$load2 = $_POST['load2'];
			$load3 = $_POST['load3'];
			$load4 = $_POST['load4'];
			$load5 = $_POST['load5'];
			$load6 = $_POST['load6'];
			$load7 = $_POST['load7'];
			$load8 = $_POST['load8'];
			$str1 = $_POST['str1'];
			$str2 = $_POST['str2'];
			$str3 = $_POST['str3'];
			$str4 = $_POST['str4'];
			$str5 = $_POST['str5'];
			$str6 = $_POST['str6'];
			$str7 = $_POST['str7'];
			$str8 = $_POST['str8'];
			$avg_str = $_POST['avg_str'];
			$chk_shr = $_POST['chk_shr'];
			$r1_date = $_POST['r1_date'];
			$r2_date = $_POST['r2_date'];
			$r3_date = $_POST['r3_date'];
			$r4_date = $_POST['r4_date'];
			$r5_date = $_POST['r5_date'];
			$r6_date = $_POST['r6_date'];
			$r7_date = $_POST['r7_date'];
			$r1_1 = $_POST['r1_1'];
			$r1_2 = $_POST['r1_2'];
			$r1_3 = $_POST['r1_3'];
			$r1_4 = $_POST['r1_4'];
			$r1_5 = $_POST['r1_5'];
			$r1_6 = $_POST['r1_6'];
			$r2_1 = $_POST['r2_1'];
			$r2_2 = $_POST['r2_2'];
			$r2_3 = $_POST['r2_3'];
			$r2_4 = $_POST['r2_4'];
			$r2_5 = $_POST['r2_5'];
			$r2_6 = $_POST['r2_6'];
			$r3_1 = $_POST['r3_1'];
			$r3_2 = $_POST['r3_2'];
			$r3_3 = $_POST['r3_3'];
			$r3_4 = $_POST['r3_4'];
			$r3_5 = $_POST['r3_5'];
			$r3_6 = $_POST['r3_6'];
			$r4_1 = $_POST['r4_1'];
			$r4_2 = $_POST['r4_2'];
			$r4_3 = $_POST['r4_3'];
			$r4_4 = $_POST['r4_4'];
			$r4_5 = $_POST['r4_5'];
			$r4_6 = $_POST['r4_6'];
			$r5_1 = $_POST['r5_1'];
			$r5_2 = $_POST['r5_2'];
			$r5_3 = $_POST['r5_3'];
			$r5_4 = $_POST['r5_4'];
			$r5_5 = $_POST['r5_5'];
			$r5_6 = $_POST['r5_6'];
			$r6_1 = $_POST['r6_1'];
			$r6_2 = $_POST['r6_2'];
			$r6_3 = $_POST['r6_3'];
			$r6_4 = $_POST['r6_4'];
			$r6_5 = $_POST['r6_5'];
			$r6_6 = $_POST['r6_6'];
			$r7_1 = $_POST['r7_1'];
			$r7_2 = $_POST['r7_2'];
			$r7_3 = $_POST['r7_3'];
			$r7_4 = $_POST['r7_4'];
			$r7_5 = $_POST['r7_5'];
			$r7_6 = $_POST['r7_6'];
			$dry1 = $_POST['dry1'];
			$dry2 = $_POST['dry2'];
			$dry3 = $_POST['dry3'];
			$dry4 = $_POST['dry4'];
			$dry5 = $_POST['dry5'];
			$dry6 = $_POST['dry6'];
			$avg_dry = $_POST['avg_dry'];
			$age1_1 = $_POST['age1_1'];
			$age1_2 = $_POST['age1_2'];
			$age1_3 = $_POST['age1_3'];
			$age2_1 = $_POST['age2_1'];
			$age2_2 = $_POST['age2_2'];
			$age2_3 = $_POST['age2_3'];
			$avg_mo = $_POST['avg_mo'];
			$chk_dim = $_POST['chk_dim'];
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
			$l13 = $_POST['l13'];
			$l14 = $_POST['l14'];
			$l15 = $_POST['l15'];
			$l16 = $_POST['l16'];
			$l17 = $_POST['l17'];
			$l18 = $_POST['l18'];
			$l19 = $_POST['l19'];
			$l20 = $_POST['l20'];
			$w1 = $_POST['w1'];
			$w2 = $_POST['w2'];
			$w3 = $_POST['w3'];
			$w4 = $_POST['w4'];
			$w5 = $_POST['w5'];
			$w6 = $_POST['w6'];
			$w7 = $_POST['w7'];
			$w8 = $_POST['w8'];
			$w9 = $_POST['w9'];
			$w10 = $_POST['w10'];
			$w11 = $_POST['w11'];
			$w12 = $_POST['w12'];
			$w13 = $_POST['w13'];
			$w14 = $_POST['w14'];
			$w15 = $_POST['w15'];
			$w16 = $_POST['w16'];
			$w17 = $_POST['w17'];
			$w18 = $_POST['w18'];
			$w19 = $_POST['w19'];
			$w20 = $_POST['w20'];
			$h1 = $_POST['h1'];
			$h2 = $_POST['h2'];
			$h3 = $_POST['h3'];
			$h4 = $_POST['h4'];
			$h5 = $_POST['h5'];
			$h6 = $_POST['h6'];
			$h7 = $_POST['h7'];
			$h8 = $_POST['h8'];
			$h9 = $_POST['h9'];
			$h10 = $_POST['h10'];
			$h11 = $_POST['h11'];
			$h12 = $_POST['h12'];
			$h13 = $_POST['h13'];
			$h14 = $_POST['h14'];
			$h15 = $_POST['h15'];
			$h16 = $_POST['h16'];
			$h17 = $_POST['h17'];
			$h18 = $_POST['h18'];
			$h19 = $_POST['h19'];
			$h20 = $_POST['h20'];
			$avg_length = $_POST['avg_length'];
			$avg_width = $_POST['avg_width'];
			$avg_height = $_POST['avg_height'];
			$chk_wtr = $_POST['chk_wtr'];
			$wa_1_1 = $_POST['wa_1_1'];
			$wa_1_2 = $_POST['wa_1_2'];
			$wa_1_3 = $_POST['wa_1_3'];
			$wa_2_1 = $_POST['wa_2_1'];
			$wa_2_2 = $_POST['wa_2_2'];
			$wa_2_3 = $_POST['wa_2_3'];
			$wtr1 = $_POST['wtr1'];
			$wtr2 = $_POST['wtr2'];
			$wtr3 = $_POST['wtr3'];
			$avg_wtr = $_POST['avg_wtr'];
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
			
			$curr_date=date("Y-m-d");
			
			
			$insert="insert into solid_block (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_com`, `i1`, `i2`, `i3`, `i4`, `i5`, `i6`, `i7`, `i8`, `length1`, `length2`, `length3`, `length4`, `length5`, `length6`, `length7`, `length8`, `width1`, `width2`, `width3`, `width4`, `width5`, `width6`, `width7`, `width8`, `area1`, `area2`, `area3`, `area4`, `area5`, `area6`, `area7`, `area8`, `load1`, `load2`, `load3`, `load4`, `load5`, `load6`, `load7`, `load8`, `str1`, `str2`, `str3`, `str4`, `str5`, `str6`, `str7`, `str8`, `avg_str`, `chk_shr`, `r1_date`, `r2_date`, `r3_date`, `r4_date`, `r5_date`, `r6_date`, `r7_date`, `r1_1`, `r1_2`, `r1_3`, `r1_4`, `r1_5`, `r1_6`, `r2_1`, `r2_2`, `r2_3`, `r2_4`, `r2_5`, `r2_6`, `r3_1`, `r3_2`, `r3_3`, `r3_4`, `r3_5`, `r3_6`, `r4_1`, `r4_2`, `r4_3`, `r4_4`, `r4_5`, `r4_6`, `r5_1`, `r5_2`, `r5_3`, `r5_4`, `r5_5`, `r5_6`, `r6_1`, `r6_2`, `r6_3`, `r6_4`, `r6_5`, `r6_6`, `r7_1`, `r7_2`, `r7_3`, `r7_4`, `r7_5`, `r7_6`, `dry1`, `dry2`, `dry3`, `dry4`, `dry5`, `dry6`, `avg_dry`, `age1_1`, `age1_2`, `age1_3`, `age2_1`, `age2_2`, `age2_3`, `avg_mo`, `chk_dim`, `l1`, `l2`, `l3`, `l4`, `l5`, `l6`, `l7`, `l8`, `l9`, `l10`, `l11`, `l12`, `l13`, `l14`, `l15`, `l16`, `l17`, `l18`, `l19`, `l20`, `w1`, `w2`, `w3`, `w4`, `w5`, `w6`, `w7`, `w8`, `w9`, `w10`, `w11`, `w12`, `w13`, `w14`, `w15`, `w16`, `w17`, `w18`, `w19`, `w20`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `h7`, `h8`, `h9`, `h10`, `h11`, `h12`, `h13`, `h14`, `h15`, `h16`, `h17`, `h18`, `h19`, `h20`, `avg_length`, `avg_width`, `avg_height`, `chk_wtr`, `wa_1_1`, `wa_1_2`, `wa_1_3`, `wa_2_1`, `wa_2_2`, `wa_2_3`, `wtr1`, `wtr2`, `wtr3`, `avg_wtr`, `chk_den`, `den1`, `den2`, `den3`, `iwet1`, `iwet2`, `iwet3`, `fwet1`, `fwet2`, `fwet3`, `vol1`, `vol2`, `vol3`, `dl1`, `dl2`, `dl3`, `dw1`, `dw2`, `dw3`, `dh1`, `dh2`, `dh3`, `avg_den`, `amend_date`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_com', '$i1', '$i2', '$i3', '$i4', '$i5', '$i6', '$i7', '$i8', '$length1', '$length2', '$length3', '$length4', '$length5', '$length6', '$length7', '$length8', '$width1', '$width2', '$width3', '$width4', '$width5', '$width6', '$width7', '$width8', '$area1', '$area2', '$area3', '$area4', '$area5', '$area6', '$area7', '$area8', '$load1', '$load2', '$load3', '$load4', '$load5', '$load6', '$load7', '$load8', '$str1', '$str2', '$str3', '$str4', '$str5', '$str6', '$str7', '$str8', '$avg_str', '$chk_shr', '$r1_date', '$r2_date', '$r3_date', '$r4_date', '$r5_date', '$r6_date', '$r7_date', '$r1_1', '$r1_2', '$r1_3', '$r1_4', '$r1_5', '$r1_6', '$r2_1', '$r2_2', '$r2_3', '$r2_4', '$r2_5', '$r2_6', '$r3_1', '$r3_2', '$r3_3', '$r3_4', '$r3_5', '$r3_6', '$r4_1', '$r4_2', '$r4_3', '$r4_4', '$r4_5', '$r4_6', '$r5_1', '$r5_2', '$r5_3', '$r5_4', '$r5_5', '$r5_6', '$r6_1', '$r6_2', '$r6_3', '$r6_4', '$r6_5', '$r6_6', '$r7_1', '$r7_2', '$r7_3', '$r7_4', '$r7_5', '$r7_6', '$dry1', '$dry2', '$dry3', '$dry4', '$dry5', '$dry6', '$avg_dry', '$age1_1', '$age1_2', '$age1_3', '$age2_1', '$age2_2', '$age2_3', '$avg_mo', '$chk_dim', '$l1', '$l2', '$l3', '$l4', '$l5', '$l6', '$l7', '$l8', '$l9', '$l10', '$l11', '$l12', '$l13', '$l14', '$l15', '$l16', '$l17', '$l18', '$l19', '$l20', '$w1', '$w2', '$w3', '$w4', '$w5', '$w6', '$w7', '$w8', '$w9', '$w10', '$w11', '$w12', '$w13', '$w14', '$w15', '$w16', '$w17', '$w18', '$w19', '$w20', '$h1', '$h2', '$h3', '$h4', '$h5', '$h6', '$h7', '$h8', '$h9', '$h10', '$h11', '$h12', '$h13', '$h14', '$h15', '$h16', '$h17', '$h18', '$h19', '$h20', '$avg_length', '$avg_width', '$avg_height', '$chk_wtr', '$wa_1_1', '$wa_1_2', '$wa_1_3', '$wa_2_1', '$wa_2_2', '$wa_2_3', '$wtr1', '$wtr2', '$wtr3', '$avg_wtr', '$chk_den', '$den1', '$den2', '$den3', '$iwet1', '$iwet2', '$iwet3', '$fwet1', '$fwet2', '$fwet3', '$vol1', '$vol2', '$vol3', '$dl1', '$dl2', '$dl3', '$dw1', '$dw2', '$dw3', '$dh1', '$dh2', '$dh3', '$avg_den', '$amend_date')";
				
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
													 $query = "select * from solid_block WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
		
		$update="update solid_block SET 
		`job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',
		`chk_com` = '$_POST[chk_com]',
		`i1` = '$_POST[i1]',
		`i2` = '$_POST[i2]',
		`i3` = '$_POST[i3]',
		`i4` = '$_POST[i4]',
		`i5` = '$_POST[i5]',
		`i6` = '$_POST[i6]',
		`i7` = '$_POST[i7]',
		`i8` = '$_POST[i8]',
		`length1` = '$_POST[length1]',
		`length2` = '$_POST[length2]',
		`length3` = '$_POST[length3]',
		`length4` = '$_POST[length4]',
		`length5` = '$_POST[length5]',
		`length6` = '$_POST[length6]',
		`length7` = '$_POST[length7]',
		`length8` = '$_POST[length8]',
		`width1` = '$_POST[width1]',
		`width2` = '$_POST[width2]',
		`width3` = '$_POST[width3]',
		`width4` = '$_POST[width4]',
		`width5` = '$_POST[width5]',
		`width6` = '$_POST[width6]',
		`width7` = '$_POST[width7]',
		`width8` = '$_POST[width8]',
		`area1` = '$_POST[area1]',
		`area2` = '$_POST[area2]',
		`area3` = '$_POST[area3]',
		`area4` = '$_POST[area4]',
		`area5` = '$_POST[area5]',
		`area6` = '$_POST[area6]',
		`area7` = '$_POST[area7]',
		`area8` = '$_POST[area8]',
		`load1` = '$_POST[load1]',
		`load2` = '$_POST[load2]',
		`load3` = '$_POST[load3]',
		`load4` = '$_POST[load4]',
		`load5` = '$_POST[load5]',
		`load6` = '$_POST[load6]',
		`load7` = '$_POST[load7]',
		`load8` = '$_POST[load8]',
		`str1` = '$_POST[str1]',
		`str2` = '$_POST[str2]',
		`str3` = '$_POST[str3]',
		`str4` = '$_POST[str4]',
		`str5` = '$_POST[str5]',
		`str6` = '$_POST[str6]',
		`str7` = '$_POST[str7]',
		`str8` = '$_POST[str8]',
		`avg_str` = '$_POST[avg_str]',
		`chk_shr` = '$_POST[chk_shr]',
		`r1_date` = '$_POST[r1_date]',
		`r2_date` = '$_POST[r2_date]',
		`r3_date` = '$_POST[r3_date]',
		`r4_date` = '$_POST[r4_date]',
		`r5_date` = '$_POST[r5_date]',
		`r6_date` = '$_POST[r6_date]',
		`r7_date` = '$_POST[r7_date]',
		`r1_1` = '$_POST[r1_1]',
		`r1_2` = '$_POST[r1_2]',
		`r1_3` = '$_POST[r1_3]',
		`r1_4` = '$_POST[r1_4]',
		`r1_5` = '$_POST[r1_5]',
		`r1_6` = '$_POST[r1_6]',
		`r2_1` = '$_POST[r2_1]',
		`r2_2` = '$_POST[r2_2]',
		`r2_3` = '$_POST[r2_3]',
		`r2_4` = '$_POST[r2_4]',
		`r2_5` = '$_POST[r2_5]',
		`r2_6` = '$_POST[r2_6]',
		`r3_1` = '$_POST[r3_1]',
		`r3_2` = '$_POST[r3_2]',
		`r3_3` = '$_POST[r3_3]',
		`r3_4` = '$_POST[r3_4]',
		`r3_5` = '$_POST[r3_5]',
		`r3_6` = '$_POST[r3_6]',
		`r4_1` = '$_POST[r4_1]',
		`r4_2` = '$_POST[r4_2]',
		`r4_3` = '$_POST[r4_3]',
		`r4_4` = '$_POST[r4_4]',
		`r4_5` = '$_POST[r4_5]',
		`r4_6` = '$_POST[r4_6]',
		`r5_1` = '$_POST[r5_1]',
		`r5_2` = '$_POST[r5_2]',
		`r5_3` = '$_POST[r5_3]',
		`r5_4` = '$_POST[r5_4]',
		`r5_5` = '$_POST[r5_5]',
		`r5_6` = '$_POST[r5_6]',
		`r6_1` = '$_POST[r6_1]',
		`r6_2` = '$_POST[r6_2]',
		`r6_3` = '$_POST[r6_3]',
		`r6_4` = '$_POST[r6_4]',
		`r6_5` = '$_POST[r6_5]',
		`r6_6` = '$_POST[r6_6]',
		`r7_1` = '$_POST[r7_1]',
		`r7_2` = '$_POST[r7_2]',
		`r7_3` = '$_POST[r7_3]',
		`r7_4` = '$_POST[r7_4]',
		`r7_5` = '$_POST[r7_5]',
		`r7_6` = '$_POST[r7_6]',
		`dry1` = '$_POST[dry1]',
		`dry2` = '$_POST[dry2]',
		`dry3` = '$_POST[dry3]',
		`dry4` = '$_POST[dry4]',
		`dry5` = '$_POST[dry5]',
		`dry6` = '$_POST[dry6]',
		`avg_dry` = '$_POST[avg_dry]',
		`age1_1` = '$_POST[age1_1]',
		`age1_2` = '$_POST[age1_2]',
		`age1_3` = '$_POST[age1_3]',
		`age2_1` = '$_POST[age2_1]',
		`age2_2` = '$_POST[age2_2]',
		`age2_3` = '$_POST[age2_3]',
		`avg_mo` = '$_POST[avg_mo]',
		`chk_dim` = '$_POST[chk_dim]',
		`l1` = '$_POST[l1]',
		`l2` = '$_POST[l2]',
		`l3` = '$_POST[l3]',
		`l4` = '$_POST[l4]',
		`l5` = '$_POST[l5]',
		`l6` = '$_POST[l6]',
		`l7` = '$_POST[l7]',
		`l8` = '$_POST[l8]',
		`l9` = '$_POST[l9]',
		`l10` = '$_POST[l10]',
		`l11` = '$_POST[l11]',
		`l12` = '$_POST[l12]',
		`l13` = '$_POST[l13]',
		`l14` = '$_POST[l14]',
		`l15` = '$_POST[l15]',
		`l16` = '$_POST[l16]',
		`l17` = '$_POST[l17]',
		`l18` = '$_POST[l18]',
		`l19` = '$_POST[l19]',
		`l20` = '$_POST[l20]',
		`w1` = '$_POST[w1]',
		`w2` = '$_POST[w2]',
		`w3` = '$_POST[w3]',
		`w4` = '$_POST[w4]',
		`w5` = '$_POST[w5]',
		`w6` = '$_POST[w6]',
		`w7` = '$_POST[w7]',
		`w8` = '$_POST[w8]',
		`w9` = '$_POST[w9]',
		`w10` = '$_POST[w10]',
		`w11` = '$_POST[w11]',
		`w12` = '$_POST[w12]',
		`w13` = '$_POST[w13]',
		`w14` = '$_POST[w14]',
		`w15` = '$_POST[w15]',
		`w16` = '$_POST[w16]',
		`w17` = '$_POST[w17]',
		`w18` = '$_POST[w18]',
		`w19` = '$_POST[w19]',
		`w20` = '$_POST[w20]',
		`h1` = '$_POST[h1]',
		`h2` = '$_POST[h2]',
		`h3` = '$_POST[h3]',
		`h4` = '$_POST[h4]',
		`h5` = '$_POST[h5]',
		`h6` = '$_POST[h6]',
		`h7` = '$_POST[h7]',
		`h8` = '$_POST[h8]',
		`h9` = '$_POST[h9]',
		`h10` = '$_POST[h10]',
		`h11` = '$_POST[h11]',
		`h12` = '$_POST[h12]',
		`h13` = '$_POST[h13]',
		`h14` = '$_POST[h14]',
		`h15` = '$_POST[h15]',
		`h16` = '$_POST[h16]',
		`h17` = '$_POST[h17]',
		`h18` = '$_POST[h18]',
		`h19` = '$_POST[h19]',
		`h20` = '$_POST[h20]',
		`avg_length` = '$_POST[avg_length]',
		`avg_width` = '$_POST[avg_width]',
		`avg_height` = '$_POST[avg_height]',
		`chk_wtr` = '$_POST[chk_wtr]',
		`wa_1_1` = '$_POST[wa_1_1]',
		`wa_1_2` = '$_POST[wa_1_2]',
		`wa_1_3` = '$_POST[wa_1_3]',
		`wa_2_1` = '$_POST[wa_2_1]',
		`wa_2_2` = '$_POST[wa_2_2]',
		`wa_2_3` = '$_POST[wa_2_3]',
		`wtr1` = '$_POST[wtr1]',
		`wtr2` = '$_POST[wtr2]',
		`wtr3` = '$_POST[wtr3]',
		`avg_wtr` = '$_POST[avg_wtr]',
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
		`amend_date` = '$_POST[amend_date]',
		`checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update solid_block SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM solid_block WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update solid_block SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update solid_block SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
    exit;
	
}
?>