<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from ceramic_tiles WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'tiles_brand' => $result['tiles_brand'],
			'chk_str' => $result['chk_str'],
			'dima1' => $result['dima1'],
			'dima2' => $result['dima2'],
			'dima3' => $result['dima3'],
			'dima4' => $result['dima4'],
			'dima5' => $result['dima5'],
			'dima6' => $result['dima6'],
			'dima7' => $result['dima7'],
			'dimb1' => $result['dimb1'],
			'dimb2' => $result['dimb2'],
			'dimb3' => $result['dimb3'],
			'dimb4' => $result['dimb4'],
			'dimb5' => $result['dimb5'],
			'dimb6' => $result['dimb6'],
			'dimb7' => $result['dimb7'],
			'dimh1' => $result['dimh1'],
			'dimh2' => $result['dimh2'],
			'dimh3' => $result['dimh3'],
			'dimh4' => $result['dimh4'],
			'dimh5' => $result['dimh5'],
			'dimh6' => $result['dimh6'],
			'dimh7' => $result['dimh7'],
			'l1' => $result['l1'],
			'l2' => $result['l2'],
			'l3' => $result['l3'],
			'l4' => $result['l4'],
			'l5' => $result['l5'],
			'l6' => $result['l6'],
			'l7' => $result['l7'],
			'wa1' => $result['wa1'],
			'wa2' => $result['wa2'],
			'wa3' => $result['wa3'],
			'wa4' => $result['wa4'],
			'wa5' => $result['wa5'],
			'wa6' => $result['wa6'],
			'wa7' => $result['wa7'],
			'load1' => $result['load1'],
			'load2' => $result['load2'],
			'load3' => $result['load3'],
			'load4' => $result['load4'],
			'load5' => $result['load5'],
			'load6' => $result['load6'],
			'load7' => $result['load7'],
			'str1' => $result['str1'],
			'str2' => $result['str2'],
			'str3' => $result['str3'],
			'str4' => $result['str4'],
			'str5' => $result['str5'],
			'str6' => $result['str6'],
			'str7' => $result['str7'],
			'rstr1' => $result['rstr1'],
			'rstr2' => $result['rstr2'],
			'rstr3' => $result['rstr3'],
			'rstr4' => $result['rstr4'],
			'rstr5' => $result['rstr5'],
			'rstr6' => $result['rstr6'],
			'rstr7' => $result['rstr7'],
			'avg_str' => $result['avg_str'],
			'avg_rstr' => $result['avg_rstr'],
			'chk_scr' => $result['chk_scr'],
			's1' => $result['s1'],
			's2' => $result['s2'],
			's3' => $result['s3'],
			'avg_s' => $result['avg_s'],
			'chk_dim' => $result['chk_dim'],
			'length_1_1' => $result['length_1_1'],
			'length_1_2' => $result['length_1_2'],
			'length_1_3' => $result['length_1_3'],
			'length_1_4' => $result['length_1_4'],
			'length_2_1' => $result['length_2_1'],
			'length_2_2' => $result['length_2_2'],
			'length_2_3' => $result['length_2_3'],
			'length_2_4' => $result['length_2_4'],
			'length_3_1' => $result['length_3_1'],
			'length_3_2' => $result['length_3_2'],
			'length_3_3' => $result['length_3_3'],
			'length_3_4' => $result['length_3_4'],
			'length_4_1' => $result['length_4_1'],
			'length_4_2' => $result['length_4_2'],
			'length_4_3' => $result['length_4_3'],
			'length_4_4' => $result['length_4_4'],
			'length_5_1' => $result['length_5_1'],
			'length_5_2' => $result['length_5_2'],
			'length_5_3' => $result['length_5_3'],
			'length_5_4' => $result['length_5_4'],
			'length_6_1' => $result['length_6_1'],
			'length_6_2' => $result['length_6_2'],
			'length_6_3' => $result['length_6_3'],
			'length_6_4' => $result['length_6_4'],
			'length_7_1' => $result['length_7_1'],
			'length_7_2' => $result['length_7_2'],
			'length_7_3' => $result['length_7_3'],
			'length_7_4' => $result['length_7_4'],
			'length_8_1' => $result['length_8_1'],
			'length_8_2' => $result['length_8_2'],
			'length_8_3' => $result['length_8_3'],
			'length_8_4' => $result['length_8_4'],
			'length_9_1' => $result['length_9_1'],
			'length_9_2' => $result['length_9_2'],
			'length_9_3' => $result['length_9_3'],
			'length_9_4' => $result['length_9_4'],
			'length_10_1' => $result['length_10_1'],
			'length_10_2' => $result['length_10_2'],
			'length_10_3' => $result['length_10_3'],
			'length_10_4' => $result['length_10_4'],
			'width_1_1' => $result['width_1_1'],
			'width_1_2' => $result['width_1_2'],
			'width_1_3' => $result['width_1_3'],
			'width_1_4' => $result['width_1_4'],
			'width_2_1' => $result['width_2_1'],
			'width_2_2' => $result['width_2_2'],
			'width_2_3' => $result['width_2_3'],
			'width_2_4' => $result['width_2_4'],
			'width_3_1' => $result['width_3_1'],
			'width_3_2' => $result['width_3_2'],
			'width_3_3' => $result['width_3_3'],
			'width_3_4' => $result['width_3_4'],
			'width_4_1' => $result['width_4_1'],
			'width_4_2' => $result['width_4_2'],
			'width_4_3' => $result['width_4_3'],
			'width_4_4' => $result['width_4_4'],
			'width_5_1' => $result['width_5_1'],
			'width_5_2' => $result['width_5_2'],
			'width_5_3' => $result['width_5_3'],
			'width_5_4' => $result['width_5_4'],
			'width_6_1' => $result['width_6_1'],
			'width_6_2' => $result['width_6_2'],
			'width_6_3' => $result['width_6_3'],
			'width_6_4' => $result['width_6_4'],
			'width_7_1' => $result['width_7_1'],
			'width_7_2' => $result['width_7_2'],
			'width_7_3' => $result['width_7_3'],
			'width_7_4' => $result['width_7_4'],
			'width_8_1' => $result['width_8_1'],
			'width_8_2' => $result['width_8_2'],
			'width_8_3' => $result['width_8_3'],
			'width_8_4' => $result['width_8_4'],
			'width_9_1' => $result['width_9_1'],
			'width_9_2' => $result['width_9_2'],
			'width_9_3' => $result['width_9_3'],
			'width_9_4' => $result['width_9_4'],
			'width_10_1' => $result['width_10_1'],
			'width_10_2' => $result['width_10_2'],
			'width_10_3' => $result['width_10_3'],
			'width_10_4' => $result['width_10_4'],
			'thick_1_1' => $result['thick_1_1'],
			'thick_1_2' => $result['thick_1_2'],
			'thick_1_3' => $result['thick_1_3'],
			'thick_1_4' => $result['thick_1_4'],
			'thick_2_1' => $result['thick_2_1'],
			'thick_2_2' => $result['thick_2_2'],
			'thick_2_3' => $result['thick_2_3'],
			'thick_2_4' => $result['thick_2_4'],
			'thick_3_1' => $result['thick_3_1'],
			'thick_3_2' => $result['thick_3_2'],
			'thick_3_3' => $result['thick_3_3'],
			'thick_3_4' => $result['thick_3_4'],
			'thick_4_1' => $result['thick_4_1'],
			'thick_4_2' => $result['thick_4_2'],
			'thick_4_3' => $result['thick_4_3'],
			'thick_4_4' => $result['thick_4_4'],
			'thick_5_1' => $result['thick_5_1'],
			'thick_5_2' => $result['thick_5_2'],
			'thick_5_3' => $result['thick_5_3'],
			'thick_5_4' => $result['thick_5_4'],
			'thick_6_1' => $result['thick_6_1'],
			'thick_6_2' => $result['thick_6_2'],
			'thick_6_3' => $result['thick_6_3'],
			'thick_6_4' => $result['thick_6_4'],
			'thick_7_1' => $result['thick_7_1'],
			'thick_7_2' => $result['thick_7_2'],
			'thick_7_3' => $result['thick_7_3'],
			'thick_7_4' => $result['thick_7_4'],
			'thick_8_1' => $result['thick_8_1'],
			'thick_8_2' => $result['thick_8_2'],
			'thick_8_3' => $result['thick_8_3'],
			'thick_8_4' => $result['thick_8_4'],
			'thick_9_1' => $result['thick_9_1'],
			'thick_9_2' => $result['thick_9_2'],
			'thick_9_3' => $result['thick_9_3'],
			'thick_9_4' => $result['thick_9_4'],
			'thick_10_1' => $result['thick_10_1'],
			'thick_10_2' => $result['thick_10_2'],
			'thick_10_3' => $result['thick_10_3'],
			'thick_10_4' => $result['thick_10_4'],
			'avg_1_1' => $result['avg_1_1'],
			'avg_1_2' => $result['avg_1_2'],
			'avg_1_3' => $result['avg_1_3'],
			'avg_1_4' => $result['avg_1_4'],
			'avg_1_5' => $result['avg_1_5'],
			'avg_1_6' => $result['avg_1_6'],
			'avg_1_7' => $result['avg_1_7'],
			'avg_1_8' => $result['avg_1_8'],
			'avg_1_9' => $result['avg_1_9'],
			'avg_1_10' => $result['avg_1_10'],
			'avg_1_11' => $result['avg_1_11'],
			'avg_1_12' => $result['avg_1_12'],
			'avg_1' => $result['avg_1'],
			'avg_2' => $result['avg_2'],
			'avg_3' => $result['avg_3'],
			'chk_wtr' => $result['chk_wtr'],
			'a1' => $result['a1'],
			'a2' => $result['a2'],
			'a3' => $result['a3'],
			'a4' => $result['a4'],
			'a5' => $result['a5'],
			'a6' => $result['a6'],
			'a7' => $result['a7'],
			'a8' => $result['a8'],
			'a9' => $result['a9'],
			'a10' => $result['a10'],
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
			'wtr1' => $result['wtr1'],
			'wtr2' => $result['wtr2'],
			'wtr3' => $result['wtr3'],
			'wtr4' => $result['wtr4'],
			'wtr5' => $result['wtr5'],
			'wtr6' => $result['wtr6'],
			'wtr7' => $result['wtr7'],
			'wtr8' => $result['wtr8'],
			'wtr9' => $result['wtr9'],
			'wtr10' => $result['wtr10'],
			'avg_wtr' => $result['avg_wtr'],
			'chk_den' => $result['chk_den'],
			'dl1' => $result['dl1'],
			'dl2' => $result['dl2'],
			'dl3' => $result['dl3'],
			'dl4' => $result['dl4'],
			'dl5' => $result['dl5'],
			'dl6' => $result['dl6'],
			'dw1' => $result['dw1'],
			'dw2' => $result['dw2'],
			'dw3' => $result['dw3'],
			'dw4' => $result['dw4'],
			'dw5' => $result['dw5'],
			'dw6' => $result['dw6'],
			'dt1' => $result['dt1'],
			'dt2' => $result['dt2'],
			'dt3' => $result['dt3'],
			'dt4' => $result['dt4'],
			'dt5' => $result['dt5'],
			'dt6' => $result['dt6'],
			'vol1' => $result['vol1'],
			'vol2' => $result['vol2'],
			'vol3' => $result['vol3'],
			'vol4' => $result['vol4'],
			'vol5' => $result['vol5'],
			'vol6' => $result['vol6'],
			'dweight1' => $result['dweight1'],
			'dweight2' => $result['dweight2'],
			'dweight3' => $result['dweight3'],
			'dweight4' => $result['dweight4'],
			'dweight5' => $result['dweight5'],
			'dweight6' => $result['dweight6'],
			'den1' => $result['den1'],
			'den2' => $result['den2'],
			'den3' => $result['den3'],
			'den4' => $result['den4'],
			'den5' => $result['den5'],
			'den6' => $result['den6'],
			'avg_den' => $result['avg_den']

		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr = $_POST['ulr'];
		$amend_date = $_POST['amend_date'];

		$tiles_brand = $_POST['tiles_brand'];
		$chk_str = $_POST['chk_str'];
		$dima1 = $_POST['dima1'];
		$dima2 = $_POST['dima2'];
		$dima3 = $_POST['dima3'];
		$dima4 = $_POST['dima4'];
		$dima5 = $_POST['dima5'];
		$dima6 = $_POST['dima6'];
		$dima7 = $_POST['dima7'];
		$dimb1 = $_POST['dimb1'];
		$dimb2 = $_POST['dimb2'];
		$dimb3 = $_POST['dimb3'];
		$dimb4 = $_POST['dimb4'];
		$dimb5 = $_POST['dimb5'];
		$dimb6 = $_POST['dimb6'];
		$dimb7 = $_POST['dimb7'];
		$dimh1 = $_POST['dimh1'];
		$dimh2 = $_POST['dimh2'];
		$dimh3 = $_POST['dimh3'];
		$dimh4 = $_POST['dimh4'];
		$dimh5 = $_POST['dimh5'];
		$dimh6 = $_POST['dimh6'];
		$dimh7 = $_POST['dimh7'];
		$l1 = $_POST['l1'];
		$l2 = $_POST['l2'];
		$l3 = $_POST['l3'];
		$l4 = $_POST['l4'];
		$l5 = $_POST['l5'];
		$l6 = $_POST['l6'];
		$l7 = $_POST['l7'];
		$wa1 = $_POST['wa1'];
		$wa2 = $_POST['wa2'];
		$wa3 = $_POST['wa3'];
		$wa4 = $_POST['wa4'];
		$wa5 = $_POST['wa5'];
		$wa6 = $_POST['wa6'];
		$wa7 = $_POST['wa7'];
		$load1 = $_POST['load1'];
		$load2 = $_POST['load2'];
		$load3 = $_POST['load3'];
		$load4 = $_POST['load4'];
		$load5 = $_POST['load5'];
		$load6 = $_POST['load6'];
		$load7 = $_POST['load7'];
		$str1 = $_POST['str1'];
		$str2 = $_POST['str2'];
		$str3 = $_POST['str3'];
		$str4 = $_POST['str4'];
		$str5 = $_POST['str5'];
		$str6 = $_POST['str6'];
		$str7 = $_POST['str7'];
		$rstr1 = $_POST['rstr1'];
		$rstr2 = $_POST['rstr2'];
		$rstr3 = $_POST['rstr3'];
		$rstr4 = $_POST['rstr4'];
		$rstr5 = $_POST['rstr5'];
		$rstr6 = $_POST['rstr6'];
		$rstr7 = $_POST['rstr7'];
		$avg_str = $_POST['avg_str'];
		$avg_rstr = $_POST['avg_rstr'];
		$chk_scr = $_POST['chk_scr'];
		$s1 = $_POST['s1'];
		$s2 = $_POST['s2'];
		$s3 = $_POST['s3'];
		$avg_s = $_POST['avg_s'];
		$chk_dim = $_POST['chk_dim'];
		$length_1_1 = $_POST['length_1_1'];
		$length_1_2 = $_POST['length_1_2'];
		$length_1_3 = $_POST['length_1_3'];
		$length_1_4 = $_POST['length_1_4'];
		$length_2_1 = $_POST['length_2_1'];
		$length_2_2 = $_POST['length_2_2'];
		$length_2_3 = $_POST['length_2_3'];
		$length_2_4 = $_POST['length_2_4'];
		$length_3_1 = $_POST['length_3_1'];
		$length_3_2 = $_POST['length_3_2'];
		$length_3_3 = $_POST['length_3_3'];
		$length_3_4 = $_POST['length_3_4'];
		$length_4_1 = $_POST['length_4_1'];
		$length_4_2 = $_POST['length_4_2'];
		$length_4_3 = $_POST['length_4_3'];
		$length_4_4 = $_POST['length_4_4'];
		$length_5_1 = $_POST['length_5_1'];
		$length_5_2 = $_POST['length_5_2'];
		$length_5_3 = $_POST['length_5_3'];
		$length_5_4 = $_POST['length_5_4'];
		$length_6_1 = $_POST['length_6_1'];
		$length_6_2 = $_POST['length_6_2'];
		$length_6_3 = $_POST['length_6_3'];
		$length_6_4 = $_POST['length_6_4'];
		$length_7_1 = $_POST['length_7_1'];
		$length_7_2 = $_POST['length_7_2'];
		$length_7_3 = $_POST['length_7_3'];
		$length_7_4 = $_POST['length_7_4'];
		$length_8_1 = $_POST['length_8_1'];
		$length_8_2 = $_POST['length_8_2'];
		$length_8_3 = $_POST['length_8_3'];
		$length_8_4 = $_POST['length_8_4'];
		$length_9_1 = $_POST['length_9_1'];
		$length_9_2 = $_POST['length_9_2'];
		$length_9_3 = $_POST['length_9_3'];
		$length_9_4 = $_POST['length_9_4'];
		$length_10_1 = $_POST['length_10_1'];
		$length_10_2 = $_POST['length_10_2'];
		$length_10_3 = $_POST['length_10_3'];
		$length_10_4 = $_POST['length_10_4'];
		$width_1_1 = $_POST['width_1_1'];
		$width_1_2 = $_POST['width_1_2'];
		$width_1_3 = $_POST['width_1_3'];
		$width_1_4 = $_POST['width_1_4'];
		$width_2_1 = $_POST['width_2_1'];
		$width_2_2 = $_POST['width_2_2'];
		$width_2_3 = $_POST['width_2_3'];
		$width_2_4 = $_POST['width_2_4'];
		$width_3_1 = $_POST['width_3_1'];
		$width_3_2 = $_POST['width_3_2'];
		$width_3_3 = $_POST['width_3_3'];
		$width_3_4 = $_POST['width_3_4'];
		$width_4_1 = $_POST['width_4_1'];
		$width_4_2 = $_POST['width_4_2'];
		$width_4_3 = $_POST['width_4_3'];
		$width_4_4 = $_POST['width_4_4'];
		$width_5_1 = $_POST['width_5_1'];
		$width_5_2 = $_POST['width_5_2'];
		$width_5_3 = $_POST['width_5_3'];
		$width_5_4 = $_POST['width_5_4'];
		$width_6_1 = $_POST['width_6_1'];
		$width_6_2 = $_POST['width_6_2'];
		$width_6_3 = $_POST['width_6_3'];
		$width_6_4 = $_POST['width_6_4'];
		$width_7_1 = $_POST['width_7_1'];
		$width_7_2 = $_POST['width_7_2'];
		$width_7_3 = $_POST['width_7_3'];
		$width_7_4 = $_POST['width_7_4'];
		$width_8_1 = $_POST['width_8_1'];
		$width_8_2 = $_POST['width_8_2'];
		$width_8_3 = $_POST['width_8_3'];
		$width_8_4 = $_POST['width_8_4'];
		$width_9_1 = $_POST['width_9_1'];
		$width_9_2 = $_POST['width_9_2'];
		$width_9_3 = $_POST['width_9_3'];
		$width_9_4 = $_POST['width_9_4'];
		$width_10_1 = $_POST['width_10_1'];
		$width_10_2 = $_POST['width_10_2'];
		$width_10_3 = $_POST['width_10_3'];
		$width_10_4 = $_POST['width_10_4'];
		$thick_1_1 = $_POST['thick_1_1'];
		$thick_1_2 = $_POST['thick_1_2'];
		$thick_1_3 = $_POST['thick_1_3'];
		$thick_1_4 = $_POST['thick_1_4'];
		$thick_2_1 = $_POST['thick_2_1'];
		$thick_2_2 = $_POST['thick_2_2'];
		$thick_2_3 = $_POST['thick_2_3'];
		$thick_2_4 = $_POST['thick_2_4'];
		$thick_3_1 = $_POST['thick_3_1'];
		$thick_3_2 = $_POST['thick_3_2'];
		$thick_3_3 = $_POST['thick_3_3'];
		$thick_3_4 = $_POST['thick_3_4'];
		$thick_4_1 = $_POST['thick_4_1'];
		$thick_4_2 = $_POST['thick_4_2'];
		$thick_4_3 = $_POST['thick_4_3'];
		$thick_4_4 = $_POST['thick_4_4'];
		$thick_5_1 = $_POST['thick_5_1'];
		$thick_5_2 = $_POST['thick_5_2'];
		$thick_5_3 = $_POST['thick_5_3'];
		$thick_5_4 = $_POST['thick_5_4'];
		$thick_6_1 = $_POST['thick_6_1'];
		$thick_6_2 = $_POST['thick_6_2'];
		$thick_6_3 = $_POST['thick_6_3'];
		$thick_6_4 = $_POST['thick_6_4'];
		$thick_7_1 = $_POST['thick_7_1'];
		$thick_7_2 = $_POST['thick_7_2'];
		$thick_7_3 = $_POST['thick_7_3'];
		$thick_7_4 = $_POST['thick_7_4'];
		$thick_8_1 = $_POST['thick_8_1'];
		$thick_8_2 = $_POST['thick_8_2'];
		$thick_8_3 = $_POST['thick_8_3'];
		$thick_8_4 = $_POST['thick_8_4'];
		$thick_9_1 = $_POST['thick_9_1'];
		$thick_9_2 = $_POST['thick_9_2'];
		$thick_9_3 = $_POST['thick_9_3'];
		$thick_9_4 = $_POST['thick_9_4'];
		$thick_10_1 = $_POST['thick_10_1'];
		$thick_10_2 = $_POST['thick_10_2'];
		$thick_10_3 = $_POST['thick_10_3'];
		$thick_10_4 = $_POST['thick_10_4'];
		$avg_1_1 = $_POST['avg_1_1'];
		$avg_1_2 = $_POST['avg_1_2'];
		$avg_1_3 = $_POST['avg_1_3'];
		$avg_1_4 = $_POST['avg_1_4'];
		$avg_1_5 = $_POST['avg_1_5'];
		$avg_1_6 = $_POST['avg_1_6'];
		$avg_1_7 = $_POST['avg_1_7'];
		$avg_1_8 = $_POST['avg_1_8'];
		$avg_1_9 = $_POST['avg_1_9'];
		$avg_1_10 = $_POST['avg_1_10'];
		$avg_1_11 = $_POST['avg_1_11'];
		$avg_1_12 = $_POST['avg_1_12'];
		$avg_1 = $_POST['avg_1'];
		$avg_2 = $_POST['avg_2'];
		$avg_3 = $_POST['avg_3'];
		$chk_wtr = $_POST['chk_wtr'];
		$a1 = $_POST['a1'];
		$a2 = $_POST['a2'];
		$a3 = $_POST['a3'];
		$a4 = $_POST['a4'];
		$a5 = $_POST['a5'];
		$a6 = $_POST['a6'];
		$a7 = $_POST['a7'];
		$a8 = $_POST['a8'];
		$a9 = $_POST['a9'];
		$a10 = $_POST['a10'];
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
		$wtr1 = $_POST['wtr1'];
		$wtr2 = $_POST['wtr2'];
		$wtr3 = $_POST['wtr3'];
		$wtr4 = $_POST['wtr4'];
		$wtr5 = $_POST['wtr5'];
		$wtr6 = $_POST['wtr6'];
		$wtr7 = $_POST['wtr7'];
		$wtr8 = $_POST['wtr8'];
		$wtr9 = $_POST['wtr9'];
		$wtr10 = $_POST['wtr10'];
		$avg_wtr = $_POST['avg_wtr'];
		$chk_den = $_POST['chk_den'];
		$dl1 = $_POST['dl1'];
		$dl2 = $_POST['dl2'];
		$dl3 = $_POST['dl3'];
		$dl4 = $_POST['dl4'];
		$dl5 = $_POST['dl5'];
		$dl6 = $_POST['dl6'];
		$dw1 = $_POST['dw1'];
		$dw2 = $_POST['dw2'];
		$dw3 = $_POST['dw3'];
		$dw4 = $_POST['dw4'];
		$dw5 = $_POST['dw5'];
		$dw6 = $_POST['dw6'];
		$dt1 = $_POST['dt1'];
		$dt2 = $_POST['dt2'];
		$dt3 = $_POST['dt3'];
		$dt4 = $_POST['dt4'];
		$dt5 = $_POST['dt5'];
		$dt6 = $_POST['dt6'];
		$vol1 = $_POST['vol1'];
		$vol2 = $_POST['vol2'];
		$vol3 = $_POST['vol3'];
		$vol4 = $_POST['vol4'];
		$vol5 = $_POST['vol5'];
		$vol6 = $_POST['vol6'];
		$dweight1 = $_POST['dweight1'];
		$dweight2 = $_POST['dweight2'];
		$dweight3 = $_POST['dweight3'];
		$dweight4 = $_POST['dweight4'];
		$dweight5 = $_POST['dweight5'];
		$dweight6 = $_POST['dweight6'];
		$den1 = $_POST['den1'];
		$den2 = $_POST['den2'];
		$den3 = $_POST['den3'];
		$den4 = $_POST['den4'];
		$den5 = $_POST['den5'];
		$den6 = $_POST['den6'];
		$avg_den = $_POST['avg_den'];


		$curr_date = date("Y-m-d");



		$insert = "INSERT INTO `ceramic_tiles`(`report_no`,`ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `tiles_brand`, `chk_str`, `dima1`, `dima2`, `dima3`, `dima4`, `dima5`, `dima6`, `dima7`, `dimb1`, `dimb2`, `dimb3`, `dimb4`, `dimb5`, `dimb6`, `dimb7`, `dimh1`, `dimh2`, `dimh3`, `dimh4`, `dimh5`, `dimh6`, `dimh7`, `l1`, `l2`, `l3`, `l4`, `l5`, `l6`, `l7`, `load1`, `load2`, `load3`, `load4`, `load5`, `load6`, `load7`, `wa1`, `wa2`, `wa3`, `wa4`, `wa5`, `wa6`, `wa7`, `str1`, `str2`, `str3`, `str4`, `str5`, `str6`, `str7`, `rstr1`, `rstr2`, `rstr3`, `rstr4`, `rstr5`, `rstr6`, `rstr7`, `avg_str`, `avg_rstr`, `chk_scr`, `s1`, `s2`, `s3`, `avg_s`, `chk_dim`, `length_1_1`, `length_1_2`, `length_1_3`, `length_1_4`, `length_2_1`, `length_2_2`, `length_2_3`, `length_2_4`, `length_3_1`, `length_3_2`, `length_3_3`, `length_3_4`, `length_4_1`, `length_4_2`, `length_4_3`, `length_4_4`, `length_5_1`, `length_5_2`, `length_5_3`, `length_5_4`, `length_6_1`, `length_6_2`, `length_6_3`, `length_6_4`, `length_7_1`, `length_7_2`, `length_7_3`, `length_7_4`, `length_8_1`, `length_8_2`, `length_8_3`, `length_8_4`, `length_9_1`, `length_9_2`, `length_9_3`, `length_9_4`, `length_10_1`, `length_10_2`, `length_10_3`, `length_10_4`, `width_1_1`, `width_1_2`, `width_1_3`, `width_1_4`, `width_2_1`, `width_2_2`, `width_2_3`, `width_2_4`, `width_3_1`, `width_3_2`, `width_3_3`, `width_3_4`, `width_4_1`, `width_4_2`, `width_4_3`, `width_4_4`, `width_5_1`, `width_5_2`, `width_5_3`, `width_5_4`, `width_6_1`, `width_6_2`, `width_6_3`, `width_6_4`, `width_7_1`, `width_7_2`, `width_7_3`, `width_7_4`, `width_8_1`, `width_8_2`, `width_8_3`, `width_8_4`, `width_9_1`, `width_9_2`, `width_9_3`, `width_9_4`, `width_10_1`, `width_10_2`, `width_10_3`, `width_10_4`, `thick_1_1`, `thick_1_2`, `thick_1_3`, `thick_1_4`, `thick_2_1`, `thick_2_2`, `thick_2_3`, `thick_2_4`, `thick_3_1`, `thick_3_2`, `thick_3_3`, `thick_3_4`, `thick_4_1`, `thick_4_2`, `thick_4_3`, `thick_4_4`, `thick_5_1`, `thick_5_2`, `thick_5_3`, `thick_5_4`, `thick_6_1`, `thick_6_2`, `thick_6_3`, `thick_6_4`, `thick_7_1`, `thick_7_2`, `thick_7_3`, `thick_7_4`, `thick_8_1`, `thick_8_2`, `thick_8_3`, `thick_8_4`, `thick_9_1`, `thick_9_2`, `thick_9_3`, `thick_9_4`, `thick_10_1`, `thick_10_2`, `thick_10_3`, `thick_10_4`, `avg_1_1`, `avg_1_2`, `avg_1_3`, `avg_1_4`, `avg_1_5`, `avg_1_6`, `avg_1_7`, `avg_1_8`, `avg_1_9`, `avg_1_10`, `avg_1_11`, `avg_1_12`, `avg_1`, `avg_2`, `avg_3`, `chk_wtr`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `b10`, `wtr1`, `wtr2`, `wtr3`, `wtr4`, `wtr5`, `wtr6`, `wtr7`, `wtr8`, `wtr9`, `wtr10`, `avg_wtr`, `chk_den`, `dl1`, `dl2`, `dl3`, `dl4`, `dl5`, `dl6`, `dw1`, `dw2`, `dw3`, `dw4`, `dw5`, `dw6`, `dt1`, `dt2`, `dt3`, `dt4`, `dt5`, `dt6`, `vol1`, `vol2`, `vol3`, `vol4`, `vol5`, `vol6`, `dweight1`, `dweight2`, `dweight3`, `dweight4`, `dweight5`, `dweight6`, `den1`, `den2`, `den3`, `den4`, `den5`, `den6`, `avg_den`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$tiles_brand', '$chk_str', '$dima1', '$dima2', '$dima3', '$dima4', '$dima5', '$dima6', '$dima7', '$dimb1', '$dimb2', '$dimb3', '$dimb4', '$dimb5', '$dimb6', '$dimb7', '$dimh1', '$dimh2', '$dimh3', '$dimh4', '$dimh5', '$dimh6', '$dimh7', '$l1', '$l2', '$l3', '$l4', '$l5', '$l6', '$l7', '$load1', '$load2', '$load3', '$load4', '$load5', '$load6', '$load7', '$wa1', '$wa2', '$wa3', '$wa4', '$wa5', '$wa6', '$wa7', '$str1', '$str2', '$str3', '$str4', '$str5', '$str6', '$str7', '$rstr1', '$rstr2', '$rstr3', '$rstr4', '$rstr5', '$rstr6', '$rstr7', '$avg_str', '$avg_rstr', '$chk_scr', '$s1', '$s2', '$s3', '$avg_s', '$chk_dim', '$length_1_1', '$length_1_2', '$length_1_3', '$length_1_4', '$length_2_1', '$length_2_2', '$length_2_3', '$length_2_4', '$length_3_1', '$length_3_2', '$length_3_3', '$length_3_4', '$length_4_1', '$length_4_2', '$length_4_3', '$length_4_4', '$length_5_1', '$length_5_2', '$length_5_3', '$length_5_4', '$length_6_1', '$length_6_2', '$length_6_3', '$length_6_4', '$length_7_1', '$length_7_2', '$length_7_3', '$length_7_4', '$length_8_1', '$length_8_2', '$length_8_3', '$length_8_4', '$length_9_1', '$length_9_2', '$length_9_3', '$length_9_4', '$length_10_1', '$length_10_2', '$length_10_3', '$length_10_4', '$width_1_1', '$width_1_2', '$width_1_3', '$width_1_4', '$width_2_1', '$width_2_2', '$width_2_3', '$width_2_4', '$width_3_1', '$width_3_2', '$width_3_3', '$width_3_4', '$width_4_1', '$width_4_2', '$width_4_3', '$width_4_4', '$width_5_1', '$width_5_2', '$width_5_3', '$width_5_4', '$width_6_1', '$width_6_2', '$width_6_3', '$width_6_4', '$width_7_1', '$width_7_2', '$width_7_3', '$width_7_4', '$width_8_1', '$width_8_2', '$width_8_3', '$width_8_4', '$width_9_1', '$width_9_2', '$width_9_3', '$width_9_4', '$width_10_1', '$width_10_2', '$width_10_3', '$width_10_4', '$thick_1_1', '$thick_1_2', '$thick_1_3', '$thick_1_4', '$thick_2_1', '$thick_2_2', '$thick_2_3', '$thick_2_4', '$thick_3_1', '$thick_3_2', '$thick_3_3', '$thick_3_4', '$thick_4_1', '$thick_4_2', '$thick_4_3', '$thick_4_4', '$thick_5_1', '$thick_5_2', '$thick_5_3', '$thick_5_4', '$thick_6_1', '$thick_6_2', '$thick_6_3', '$thick_6_4', '$thick_7_1', '$thick_7_2', '$thick_7_3', '$thick_7_4', '$thick_8_1', '$thick_8_2', '$thick_8_3', '$thick_8_4', '$thick_9_1', '$thick_9_2', '$thick_9_3', '$thick_9_4', '$thick_10_1', '$thick_10_2', '$thick_10_3', '$thick_10_4', '$avg_1_1', '$avg_1_2', '$avg_1_3', '$avg_1_4', '$avg_1_5', '$avg_1_6', '$avg_1_7', '$avg_1_8', '$avg_1_9', '$avg_1_10', '$avg_1_11', '$avg_1_12', '$avg_1', '$avg_2', '$avg_3', '$chk_wtr', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$a10', '$b1', '$b2', '$b3', '$b4', '$b5', '$b6', '$b7', '$b8', '$b9', '$b10', '$wtr1', '$wtr2', '$wtr3', '$wtr4', '$wtr5', '$wtr6', '$wtr7', '$wtr8', '$wtr9', '$wtr10', '$avg_wtr', '$chk_den', '$dl1', '$dl2', '$dl3', '$dl4', '$dl5', '$dl6', '$dw1', '$dw2', '$dw3', '$dw4', '$dw5', '$dw6', '$dt1', '$dt2', '$dt3', '$dt4', '$dt5', '$dt6', '$vol1', '$vol2', '$vol3', '$vol4', '$vol5', '$vol6', '$dweight1', '$dweight2', '$dweight3', '$dweight4', '$dweight5', '$dweight6', '$den1', '$den2', '$den3', '$den4', '$den5', '$den6', '$avg_den', '$amend_date')";

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
						$query = "select * from `ceramic_tiles` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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



		$update = "update ceramic_tiles SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
				`modified_by`='$_SESSION[name]',
				`modified_date`='$curr_date',					
				`checked_by`=NULL,					 
				`tiles_brand` = '$_POST[tiles_brand]',
				`chk_str` = '$_POST[chk_str]',
				`dima1` = '$_POST[dima1]',
				`dima2` = '$_POST[dima2]',
				`dima3` = '$_POST[dima3]',
				`dima4` = '$_POST[dima4]',
				`dima5` = '$_POST[dima5]',
				`dima6` = '$_POST[dima6]',
				`dima7` = '$_POST[dima7]',
				`dimb1` = '$_POST[dimb1]',
				`dimb2` = '$_POST[dimb2]',
				`dimb3` = '$_POST[dimb3]',
				`dimb4` = '$_POST[dimb4]',
				`dimb5` = '$_POST[dimb5]',
				`dimb6` = '$_POST[dimb6]',
				`dimb7` = '$_POST[dimb7]',
				`dimh1` = '$_POST[dimh1]',
				`dimh2` = '$_POST[dimh2]',
				`dimh3` = '$_POST[dimh3]',
				`dimh4` = '$_POST[dimh4]',
				`dimh5` = '$_POST[dimh5]',
				`dimh6` = '$_POST[dimh6]',
				`dimh7` = '$_POST[dimh7]',
				`l1` = '$_POST[l1]',
				`l2` = '$_POST[l2]',
				`l3` = '$_POST[l3]',
				`l4` = '$_POST[l4]',
				`l5` = '$_POST[l5]',
				`l6` = '$_POST[l6]',
				`l7` = '$_POST[l7]',
				`wa1` = '$_POST[wa1]',
				`wa2` = '$_POST[wa2]',
				`wa3` = '$_POST[wa3]',
				`wa4` = '$_POST[wa4]',
				`wa5` = '$_POST[wa5]',
				`wa6` = '$_POST[wa6]',
				`wa7` = '$_POST[wa7]',
				`load1` = '$_POST[load1]',
				`load2` = '$_POST[load2]',
				`load3` = '$_POST[load3]',
				`load4` = '$_POST[load4]',
				`load5` = '$_POST[load5]',
				`load6` = '$_POST[load6]',
				`load7` = '$_POST[load7]',
				`str1` = '$_POST[str1]',
				`str2` = '$_POST[str2]',
				`str3` = '$_POST[str3]',
				`str4` = '$_POST[str4]',
				`str5` = '$_POST[str5]',
				`str6` = '$_POST[str6]',
				`str7` = '$_POST[str7]',
				`rstr1` = '$_POST[rstr1]',
				`rstr2` = '$_POST[rstr2]',
				`rstr3` = '$_POST[rstr3]',
				`rstr4` = '$_POST[rstr4]',
				`rstr5` = '$_POST[rstr5]',
				`rstr6` = '$_POST[rstr6]',
				`rstr7` = '$_POST[rstr7]',
				`avg_str` = '$_POST[avg_str]',
				`avg_rstr` = '$_POST[avg_rstr]',
				`chk_scr` = '$_POST[chk_scr]',
				`s1` = '$_POST[s1]',
				`s2` = '$_POST[s2]',
				`s3` = '$_POST[s3]',
				`avg_s` = '$_POST[avg_s]',
				`chk_dim`='$_POST[chk_dim]',
				`length_1_1`='$_POST[length_1_1]',
				`length_1_2`='$_POST[length_1_2]',
				`length_1_3`='$_POST[length_1_3]',
				`length_1_4`='$_POST[length_1_4]',
				`length_2_1`='$_POST[length_2_1]',
				`length_2_2`='$_POST[length_2_2]',
				`length_2_3`='$_POST[length_2_3]',
				`length_2_4`='$_POST[length_2_4]',
				`length_3_1`='$_POST[length_3_1]',
				`length_3_2`='$_POST[length_3_2]',
				`length_3_3`='$_POST[length_3_3]',
				`length_3_4`='$_POST[length_3_4]',
				`length_4_1`='$_POST[length_4_1]',
				`length_4_2`='$_POST[length_4_2]',
				`length_4_3`='$_POST[length_4_3]',
				`length_4_4`='$_POST[length_4_4]',
				`length_5_1`='$_POST[length_5_1]',
				`length_5_2`='$_POST[length_5_2]',
				`length_5_3`='$_POST[length_5_3]',
				`length_5_4`='$_POST[length_5_4]',
				`length_6_1`='$_POST[length_6_1]',
				`length_6_2`='$_POST[length_6_2]',
				`length_6_3`='$_POST[length_6_3]',
				`length_6_4`='$_POST[length_6_4]',
				`length_7_1`='$_POST[length_7_1]',
				`length_7_2`='$_POST[length_7_2]',
				`length_7_3`='$_POST[length_7_3]',
				`length_7_4`='$_POST[length_7_4]',
				`length_8_1`='$_POST[length_8_1]',
				`length_8_2`='$_POST[length_8_2]',
				`length_8_3`='$_POST[length_8_3]',
				`length_8_4`='$_POST[length_8_4]',
				`length_9_1`='$_POST[length_9_1]',
				`length_9_2`='$_POST[length_9_2]',
				`length_9_3`='$_POST[length_9_3]',
				`length_9_4`='$_POST[length_9_4]',
				`length_10_1`='$_POST[length_10_1]',
				`length_10_2`='$_POST[length_10_2]',
				`length_10_3`='$_POST[length_10_3]',
				`length_10_4`='$_POST[length_10_4]',
				`width_1_1`='$_POST[width_1_1]',
				`width_1_2`='$_POST[width_1_2]',
				`width_1_3`='$_POST[width_1_3]',
				`width_1_4`='$_POST[width_1_4]',
				`width_2_1`='$_POST[width_2_1]',
				`width_2_2`='$_POST[width_2_2]',
				`width_2_3`='$_POST[width_2_3]',
				`width_2_4`='$_POST[width_2_4]',
				`width_3_1`='$_POST[width_3_1]',
				`width_3_2`='$_POST[width_3_2]',
				`width_3_3`='$_POST[width_3_3]',
				`width_3_4`='$_POST[width_3_4]',
				`width_4_1`='$_POST[width_4_1]',
				`width_4_2`='$_POST[width_4_2]',
				`width_4_3`='$_POST[width_4_3]',
				`width_4_4`='$_POST[width_4_4]',
				`width_5_1`='$_POST[width_5_1]',
				`width_5_2`='$_POST[width_5_2]',
				`width_5_3`='$_POST[width_5_3]',
				`width_5_4`='$_POST[width_5_4]',
				`width_6_1`='$_POST[width_6_1]',
				`width_6_2`='$_POST[width_6_2]',
				`width_6_3`='$_POST[width_6_3]',
				`width_6_4`='$_POST[width_6_4]',
				`width_7_1`='$_POST[width_7_1]',
				`width_7_2`='$_POST[width_7_2]',
				`width_7_3`='$_POST[width_7_3]',
				`width_7_4`='$_POST[width_7_4]',
				`width_8_1`='$_POST[width_8_1]',
				`width_8_2`='$_POST[width_8_2]',
				`width_8_3`='$_POST[width_8_3]',
				`width_8_4`='$_POST[width_8_4]',
				`width_9_1`='$_POST[width_9_1]',
				`width_9_2`='$_POST[width_9_2]',
				`width_9_3`='$_POST[width_9_3]',
				`width_9_4`='$_POST[width_9_4]',
				`width_10_1`='$_POST[width_10_1]',
				`width_10_2`='$_POST[width_10_2]',
				`width_10_3`='$_POST[width_10_3]',
				`width_10_4`='$_POST[width_10_4]',
				`thick_1_1`='$_POST[thick_1_1]',
				`thick_1_2`='$_POST[thick_1_2]',
				`thick_1_3`='$_POST[thick_1_3]',
				`thick_1_4`='$_POST[thick_1_4]',
				`thick_2_1`='$_POST[thick_2_1]',
				`thick_2_2`='$_POST[thick_2_2]',
				`thick_2_3`='$_POST[thick_2_3]',
				`thick_2_4`='$_POST[thick_2_4]',
				`thick_3_1`='$_POST[thick_3_1]',
				`thick_3_2`='$_POST[thick_3_2]',
				`thick_3_3`='$_POST[thick_3_3]',
				`thick_3_4`='$_POST[thick_3_4]',
				`thick_4_1`='$_POST[thick_4_1]',
				`thick_4_2`='$_POST[thick_4_2]',
				`thick_4_3`='$_POST[thick_4_3]',
				`thick_4_4`='$_POST[thick_4_4]',
				`thick_5_1`='$_POST[thick_5_1]',
				`thick_5_2`='$_POST[thick_5_2]',
				`thick_5_3`='$_POST[thick_5_3]',
				`thick_5_4`='$_POST[thick_5_4]',
				`thick_6_1`='$_POST[thick_6_1]',
				`thick_6_2`='$_POST[thick_6_2]',
				`thick_6_3`='$_POST[thick_6_3]',
				`thick_6_4`='$_POST[thick_6_4]',
				`thick_7_1`='$_POST[thick_7_1]',
				`thick_7_2`='$_POST[thick_7_2]',
				`thick_7_3`='$_POST[thick_7_3]',
				`thick_7_4`='$_POST[thick_7_4]',
				`thick_8_1`='$_POST[thick_8_1]',
				`thick_8_2`='$_POST[thick_8_2]',
				`thick_8_3`='$_POST[thick_8_3]',
				`thick_8_4`='$_POST[thick_8_4]',
				`thick_9_1`='$_POST[thick_9_1]',
				`thick_9_2`='$_POST[thick_9_2]',
				`thick_9_3`='$_POST[thick_9_3]',
				`thick_9_4`='$_POST[thick_9_4]',
				`thick_10_1`='$_POST[thick_10_1]',
				`thick_10_2`='$_POST[thick_10_2]',
				`thick_10_3`='$_POST[thick_10_3]',
				`thick_10_4`='$_POST[thick_10_4]',
				`avg_1_1`='$_POST[avg_1_1]',
				`avg_1_2`='$_POST[avg_1_2]',
				`avg_1_3`='$_POST[avg_1_3]',
				`avg_1_4`='$_POST[avg_1_4]',
				`avg_1_5`='$_POST[avg_1_5]',
				`avg_1_6`='$_POST[avg_1_6]',
				`avg_1_7`='$_POST[avg_1_7]',
				`avg_1_8`='$_POST[avg_1_8]',
				`avg_1_9`='$_POST[avg_1_9]',
				`avg_1_10`='$_POST[avg_1_10]',
				`avg_1_11`='$_POST[avg_1_11]',
				`avg_1_12`='$_POST[avg_1_12]',
				`avg_1`='$_POST[avg_1]',
				`avg_2`='$_POST[avg_2]',
				`avg_3`='$_POST[avg_3]',
				`chk_wtr` = '$_POST[chk_wtr]',
				`a1` = '$_POST[a1]',
				`a2` = '$_POST[a2]',
				`a3` = '$_POST[a3]',
				`a4` = '$_POST[a4]',
				`a5` = '$_POST[a5]',
				`a6` = '$_POST[a6]',
				`a7` = '$_POST[a7]',
				`a8` = '$_POST[a8]',
				`a9` = '$_POST[a9]',
				`a10` = '$_POST[a10]',
				`b1` = '$_POST[b1]',
				`b2` = '$_POST[b2]',
				`b3` = '$_POST[b3]',
				`b4` = '$_POST[b4]',
				`b5` = '$_POST[b5]',
				`b6` = '$_POST[b6]',
				`b7` = '$_POST[b7]',
				`b8` = '$_POST[b8]',
				`b9` = '$_POST[b9]',
				`b10` = '$_POST[b10]',
				`wtr1` = '$_POST[wtr1]',
				`wtr2` = '$_POST[wtr2]',
				`wtr3` = '$_POST[wtr3]',
				`wtr4` = '$_POST[wtr4]',
				`wtr5` = '$_POST[wtr5]',
				`wtr6` = '$_POST[wtr6]',
				`wtr7` = '$_POST[wtr7]',
				`wtr8` = '$_POST[wtr8]',
				`wtr9` = '$_POST[wtr9]',
				`wtr10` = '$_POST[wtr10]',
				`avg_wtr` = '$_POST[avg_wtr]',
				`chk_den` = '$_POST[chk_den]',
				`dl1` = '$_POST[dl1]',
				`dl2` = '$_POST[dl2]',
				`dl3` = '$_POST[dl3]',
				`dl4` = '$_POST[dl4]',
				`dl5` = '$_POST[dl5]',
				`dl6` = '$_POST[dl6]',
				`dw1` = '$_POST[dw1]',
				`dw2` = '$_POST[dw2]',
				`dw3` = '$_POST[dw3]',
				`dw4` = '$_POST[dw4]',
				`dw5` = '$_POST[dw5]',
				`dw6` = '$_POST[dw6]',
				`dt1` = '$_POST[dt1]',
				`dt2` = '$_POST[dt2]',
				`dt3` = '$_POST[dt3]',
				`dt4` = '$_POST[dt4]',
				`dt5` = '$_POST[dt5]',
				`dt6` = '$_POST[dt6]',
				`vol1` = '$_POST[vol1]',
				`vol2` = '$_POST[vol2]',
				`vol3` = '$_POST[vol3]',
				`vol4` = '$_POST[vol4]',
				`vol5` = '$_POST[vol5]',
				`vol6` = '$_POST[vol6]',
				`dweight1` = '$_POST[dweight1]',
				`dweight2` = '$_POST[dweight2]',
				`dweight3` = '$_POST[dweight3]',
				`dweight4` = '$_POST[dweight4]',
				`dweight5` = '$_POST[dweight5]',
				`dweight6` = '$_POST[dweight6]',
				`den1` = '$_POST[den1]',
				`den2` = '$_POST[den2]',
				`den3` = '$_POST[den3]',
				`den4` = '$_POST[den4]',
				`den5` = '$_POST[den5]',
				`den6` = '$_POST[den6]',
				`amend_date` = '$_POST[amend_date]',
				`avg_den` = '$_POST[avg_den]'
				WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update ceramic_tiles SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM ceramic_tiles WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update ceramic_tiles SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update ceramic_tiles SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>