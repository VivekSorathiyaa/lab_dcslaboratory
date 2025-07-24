<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from water_ground WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'chk_phv' => $result['chk_phv'],
							'p1' => $result['p1'],							
							'p2' => $result['p2'],							
							'p3' => $result['p3'],							
							'pa1' => $result['pa1'],							
							'pa2' => $result['pa2'],							
							'pa3' => $result['pa3'],							
							'ph1' => $result['ph1'],							
							'ph2' => $result['ph2'],							
							'ph3' => $result['ph3'],							
							'avgp' => $result['avgp'],							
							'chk_tur' => $result['chk_tur'],
							  't1' => $result['t1'],
							  't2' => $result['t2'],
							  't3' => $result['t3'],
							  'nt1' => $result['nt1'],
							  'nt2' => $result['nt2'],
							  'nt3' => $result['nt3'],
							  'avgtur' => $result['avgtur'],							  
							  'chk_pla' => $result['chk_pla'],
							  'pla1' => $result['pla1'],
							  'pla2' => $result['pla2'],
							  'pla3' => $result['pla3'],
							  'plb1' => $result['plb1'],
							  'plb2' => $result['plb2'],
							  'plb3' => $result['plb3'],
							  'plc1' => $result['plc1'],
							  'plc2' => $result['plc2'],
							  'plc3' => $result['plc3'],
							  'pld1' => $result['pld1'],
							  'pld2' => $result['pld2'],
							  'pld3' => $result['pld3'],
							  'pl1' => $result['pl1'],
							  'pl2' => $result['pl2'],
							  'pl3' => $result['pl3'],
							  'avgpla' => $result['avgpla'],
							  'chl_tla' => $result['chl_tla'],
							  'tla1' => $result['tla1'],
							  'tla2' => $result['tla2'],
							  'tla3' => $result['tla3'],
							  'tlb1' => $result['tlb1'],
							  'tlb2' => $result['tlb2'],
							  'tlb3' => $result['tlb3'],
							  'tlc1' => $result['tlc1'],
							  'tlc2' => $result['tlc2'],
							  'tlc3' => $result['tlc3'],
							  'tld1' => $result['tld1'],
							  'tld2' => $result['tld2'],
							  'tld3' => $result['tld3'],
							  'tl1' => $result['tl1'],
							  'tl2' => $result['tl2'],
							  'tl3' => $result['tl3'],
							  'avgtla' => $result['avgtla'],
							  'chk_car' => $result['chk_car'],
							  'chk_bic' => $result['chk_bic'],
							  'avgsample' => $result['avgsample'],
							  'avghyd' => $result['avghyd'],
							  'avgcar' => $result['avgcar'],
							  'avgbic' => $result['avgbic'],
							  'chk_hrd' => $result['chk_hrd'],
							  'hra1' => $result['hra1'],
							  'hra2' => $result['hra2'],
							  'hra3' => $result['hra3'],
							  'hrb1' => $result['hrb1'],
							  'hrb2' => $result['hrb2'],
							  'hrb3' => $result['hrb3'],
							  'hrc1' => $result['hrc1'],
							  'hrc2' => $result['hrc2'],
							  'hrc3' => $result['hrc3'],
							  'hrd1' => $result['hrd1'],
							  'hrd2' => $result['hrd2'],
							  'hrd3' => $result['hrd3'],
							  'hr1' => $result['hr1'],
							  'hr2' => $result['hr2'],
							  'hr3' => $result['hr3'],
							  'avghr' => $result['avghr'],
							  'hrcf' => $result['hrcf'],
							  'chk_cal' => $result['chk_cal'],
							  'caa1' => $result['caa1'],
							  'caa2' => $result['caa2'],
							  'caa3' => $result['caa3'],
							  'cab1' => $result['cab1'],
							  'cab2' => $result['cab2'],
							  'cab3' => $result['cab3'],
							  'cac1' => $result['cac1'],
							  'cac2' => $result['cac2'],
							  'cac3' => $result['cac3'],
							  'cad1' => $result['cad1'],
							  'cad2' => $result['cad2'],
							  'cad3' => $result['cad3'],
							  'ca1' => $result['ca1'],
							  'ca2' => $result['ca2'],
							  'ca3' => $result['ca3'],
							  'avgca' => $result['avgca'],
							  'chk_mag' => $result['chk_mag'],
							  'avgmag' => $result['avgmag'],
							  'chk_chl' => $result['chk_chl'],
							  'cha1' => $result['cha1'],
							  'cha2' => $result['cha2'],
							  'cha3' => $result['cha3'],
							  'chb1' => $result['chb1'],
							  'chb2' => $result['chb2'],
							  'chb3' => $result['chb3'],
							  'chc1' => $result['chc1'],
							  'chc2' => $result['chc2'],
							  'chc3' => $result['chc3'],
							  'chd1' => $result['chd1'],
							  'chd2' => $result['chd2'],
							  'chd3' => $result['chd3'],
							  'ch1' => $result['ch1'],
							  'ch2' => $result['ch2'],
							  'ch3' => $result['ch3'],
							  'avgch' => $result['avgch'],
							  'chk_sul' => $result['chk_sul'],
							  'sua1' => $result['sua1'],
							  'sua2' => $result['sua2'],
							  'sua3' => $result['sua3'],
							  'sub1' => $result['sub1'],
							  'sub2' => $result['sub2'],
							  'sub3' => $result['sub3'],
							  'suc1' => $result['suc1'],
							  'suc2' => $result['suc2'],
							  'suc3' => $result['suc3'],
							  'sud1' => $result['sud1'],
							  'sud2' => $result['sud2'],
							  'sud3' => $result['sud3'],
							  'su1' => $result['su1'],
							  'su2' => $result['su2'],
							  'su3' => $result['su3'],
							  'avgsu' => $result['avgsu'],
							  'chk_tds' => $result['chk_tds'],
							  'tda1' => $result['tda1'],
							  'tda2' => $result['tda2'],
							  'tda3' => $result['tda3'],
							  'tdb1' => $result['tdb1'],
							  'tdb2' => $result['tdb2'],
							  'tdb3' => $result['tdb3'],
							  'tdc1' => $result['tdc1'],
							  'tdc2' => $result['tdc2'],
							  'tdc3' => $result['tdc3'],
							  'tdd1' => $result['tdd1'],
							  'tdd2' => $result['tdd2'],
							  'tdd3' => $result['tdd3'],
							  'td1' => $result['td1'],
							  'td2' => $result['td2'],
							  'td3' => $result['td3'],
							  'avgtd' => $result['avgtd'],
							  'chk_con' => $result['chk_con'],
							  'con1' => $result['con1'],
							  'con2' => $result['con2'],
							  'con3' => $result['con3'],
							  'cos1' => $result['cos1'],
							  'cos2' => $result['cos2'],
							  'cos3' => $result['cos3'],
							  'avgcon' => $result['avgcon'],
							  'chk_col' => $result['chk_col'],
							  'avgcol' => $result['avgcol'],
							  'chk_tas' => $result['chk_tas'],
							  'avgtas' => $result['avgtas'],
							  'chk_odo' => $result['chk_odo'],
							  'avgodo' => $result['avgodo'],
							  'chk_ins' => $result['chk_ins'],
							  'avgins' => $result['avgins'],
							  'chk_spg' => $result['chk_spg'],
							  'avgspg' => $result['avgspg'],
							  'chk_alu' => $result['chk_alu'],
							  'avgalu' => $result['avgalu'],
							  'chk_amm' => $result['chk_amm'],
							  'avgamm' => $result['avgamm'],
							  'chk_ani' => $result['chk_ani'],
							  'avgani' => $result['avgani'],
							  'chk_bar' => $result['chk_bar'],
							  'avgbar' => $result['avgbar'],
							  'chk_bor' => $result['chk_bor'],
							  'avgbor' => $result['avgbor'],
							  'chk_cra' => $result['chk_cra'],
							  'avgcra' => $result['avgcra'],
							  'chk_flu' => $result['chk_flu'],
							  'avgflu' => $result['avgflu'],
							  'chk_frc' => $result['chk_frc'],
							  'avgfrc' => $result['avgfrc'],
							  'chk_iro' => $result['chk_iro'],
							  'avgiro' => $result['avgiro'],
							  'chk_man' => $result['chk_man'],
							  'avgman' => $result['avgman'],
							  'chk_min' => $result['chk_min'],
							  'avgmin' => $result['avgmin'],
							  'chk_nit' => $result['chk_nit'],
							  'avgnit' => $result['avgnit'],
							  'chk_phe' => $result['chk_phe'],
							  'avgphe' => $result['avgphe'],
							  'chk_sel' => $result['chk_sel'],
							  'avgsel' => $result['avgsel'],
							  'chk_sil' => $result['chk_sil'],
							  'avgsil' => $result['avgsil'],
							  'chk_spd' => $result['chk_spd'],
							  'avgspd' => $result['avgspd'],
							  'chk_zin' => $result['chk_zin'],
							  'avgzin' => $result['avgzin'],
							  'chk_cop' => $result['chk_cop'],
							  'avgcop' => $result['avgcop'],
							  'chk_lea' => $result['chk_lea'],
							  'avglea' => $result['avglea'],
							  'chk_cyn' => $result['chk_cyn'],
							  'avgcyn' => $result['avgcyn'],
							  'chk_tot' => $result['chk_tot'],
							  'avgtot' => $result['avgtot'],
							  'chk_cad' => $result['chk_cad'],
							  'avgcad' => $result['avgcad'],
							  'chk_bec' => $result['chk_bec'],
							  'avgbec' => $result['avgbec'],
							  'chk_eco' => $result['chk_eco'],
							  'avgeco' => $result['avgeco']
														
														
						);	  
			echo json_encode($fill);
		}
		
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];			
			$ulr =  $_POST['ulr'];	
					
						  $chk_phv =  $_POST['chk_phv'];
						  $p1 =  $_POST['p1'];							
						  $p2 =  $_POST['p2'];							
						  $p3 =  $_POST['p3'];							
						  $pa1 =  $_POST['pa1'];							
						  $pa2 =  $_POST['pa2'];							
						  $pa3 =  $_POST['pa3'];							
						  $ph1 =  $_POST['ph1'];							
						  $ph2 =  $_POST['ph2'];							
						  $ph3 =  $_POST['ph3'];							
						  $avgp =  $_POST['avgp'];							
						  $chk_tur =  $_POST['chk_tur'];
						  $t1 =  $_POST['t1'];
						  $t2 =  $_POST['t2'];
						  $t3 =  $_POST['t3'];
						  $nt1 =  $_POST['nt1'];
						  $nt2 =  $_POST['nt2'];
						  $nt3 =  $_POST['nt3'];
						  $avgtur =  $_POST['avgtur'];							  
						  $chk_pla =  $_POST['chk_pla'];
						  $pla1 =  $_POST['pla1'];
						  $pla2 =  $_POST['pla2'];
						  $pla3 =  $_POST['pla3'];
						  $plb1 =  $_POST['plb1'];
						  $plb2 =  $_POST['plb2'];
						  $plb3 =  $_POST['plb3'];
						  $plc1 =  $_POST['plc1'];
						  $plc2 =  $_POST['plc2'];
						  $plc3 =  $_POST['plc3'];
						  $pld1 =  $_POST['pld1'];
						  $pld2 =  $_POST['pld2'];
						  $pld3 =  $_POST['pld3'];
						  $pl1 =  $_POST['pl1'];
						  $pl2 =  $_POST['pl2'];
						  $pl3 =  $_POST['pl3'];
						  $avgpla =  $_POST['avgpla'];
						  $chl_tla =  $_POST['chl_tla'];
						  $tla1 =  $_POST['tla1'];
						  $tla2 =  $_POST['tla2'];
						  $tla3 =  $_POST['tla3'];
						  $tlb1 =  $_POST['tlb1'];
						  $tlb2 =  $_POST['tlb2'];
						  $tlb3 =  $_POST['tlb3'];
						  $tlc1 =  $_POST['tlc1'];
						  $tlc2 =  $_POST['tlc2'];
						  $tlc3 =  $_POST['tlc3'];
						  $tld1 =  $_POST['tld1'];
						  $tld2 =  $_POST['tld2'];
						  $tld3 =  $_POST['tld3'];
						  $tl1 =  $_POST['tl1'];
						  $tl2 =  $_POST['tl2'];
						  $tl3 =  $_POST['tl3'];
						  $avgtla =  $_POST['avgtla'];
						  $chk_car =  $_POST['chk_car'];
						  $chk_bic =  $_POST['chk_bic'];
						  $avgsample =  $_POST['avgsample'];
						  $avghyd =  $_POST['avghyd'];
						  $avgcar =  $_POST['avgcar'];
						  $avgbic =  $_POST['avgbic'];
						  $chk_hrd =  $_POST['chk_hrd'];
						  $hra1 =  $_POST['hra1'];
						  $hra2 =  $_POST['hra2'];
						  $hra3 =  $_POST['hra3'];
						  $hrb1 =  $_POST['hrb1'];
						  $hrb2 =  $_POST['hrb2'];
						  $hrb3 =  $_POST['hrb3'];
						  $hrc1 =  $_POST['hrc1'];
						  $hrc2 =  $_POST['hrc2'];
						  $hrc3 =  $_POST['hrc3'];
						  $hrd1 =  $_POST['hrd1'];
						  $hrd2 =  $_POST['hrd2'];
						  $hrd3 =  $_POST['hrd3'];
						  $hr1 =  $_POST['hr1'];
						  $hr2 =  $_POST['hr2'];
						  $hr3 =  $_POST['hr3'];
						  $avghr =  $_POST['avghr'];
						  $hrcf =  $_POST['hrcf'];
						  $chk_cal =  $_POST['chk_cal'];
						  $caa1 =  $_POST['caa1'];
						  $caa2 =  $_POST['caa2'];
						  $caa3 =  $_POST['caa3'];
						  $cab1 =  $_POST['cab1'];
						  $cab2 =  $_POST['cab2'];
						  $cab3 =  $_POST['cab3'];
						  $cac1 =  $_POST['cac1'];
						  $cac2 =  $_POST['cac2'];
						  $cac3 =  $_POST['cac3'];
						  $cad1 =  $_POST['cad1'];
						  $cad2 =  $_POST['cad2'];
						  $cad3 =  $_POST['cad3'];
						  $ca1 =  $_POST['ca1'];
						  $ca2 =  $_POST['ca2'];
						  $ca3 =  $_POST['ca3'];
						  $avgca =  $_POST['avgca'];
						  $chk_mag =  $_POST['chk_mag'];
						  $avgmag =  $_POST['avgmag'];
						  $chk_chl =  $_POST['chk_chl'];
						  $cha1 =  $_POST['cha1'];
						  $cha2 =  $_POST['cha2'];
						  $cha3 =  $_POST['cha3'];
						  $chb1 =  $_POST['chb1'];
						  $chb2 =  $_POST['chb2'];
						  $chb3 =  $_POST['chb3'];
						  $chc1 =  $_POST['chc1'];
						  $chc2 =  $_POST['chc2'];
						  $chc3 =  $_POST['chc3'];
						  $chd1 =  $_POST['chd1'];
						  $chd2 =  $_POST['chd2'];
						  $chd3 =  $_POST['chd3'];
						  $ch1 =  $_POST['ch1'];
						  $ch2 =  $_POST['ch2'];
						  $ch3 =  $_POST['ch3'];
						  $avgch =  $_POST['avgch'];
						  $chk_sul =  $_POST['chk_sul'];
						  $sua1 =  $_POST['sua1'];
						  $sua2 =  $_POST['sua2'];
						  $sua3 =  $_POST['sua3'];
						  $sub1 =  $_POST['sub1'];
						  $sub2 =  $_POST['sub2'];
						  $sub3 =  $_POST['sub3'];
						  $suc1 =  $_POST['suc1'];
						  $suc2 =  $_POST['suc2'];
						  $suc3 =  $_POST['suc3'];
						  $sud1 =  $_POST['sud1'];
						  $sud2 =  $_POST['sud2'];
						  $sud3 =  $_POST['sud3'];
						  $su1 =  $_POST['su1'];
						  $su2 =  $_POST['su2'];
						  $su3 =  $_POST['su3'];
						  $avgsu =  $_POST['avgsu'];
						  $chk_tds =  $_POST['chk_tds'];
						  $tda1 =  $_POST['tda1'];
						  $tda2 =  $_POST['tda2'];
						  $tda3 =  $_POST['tda3'];
						  $tdb1 =  $_POST['tdb1'];
						  $tdb2 =  $_POST['tdb2'];
						  $tdb3 =  $_POST['tdb3'];
						  $tdc1 =  $_POST['tdc1'];
						  $tdc2 =  $_POST['tdc2'];
						  $tdc3 =  $_POST['tdc3'];
						  $tdd1 =  $_POST['tdd1'];
						  $tdd2 =  $_POST['tdd2'];
						  $tdd3 =  $_POST['tdd3'];
						  $td1 =  $_POST['td1'];
						  $td2 =  $_POST['td2'];
						  $td3 =  $_POST['td3'];
						  $avgtd =  $_POST['avgtd'];
						  $chk_con =  $_POST['chk_con'];
						  $con1 =  $_POST['con1'];
						  $con2 =  $_POST['con2'];
						  $con3 =  $_POST['con3'];
						  $cos1 =  $_POST['cos1'];
						  $cos2 =  $_POST['cos2'];
						  $cos3 =  $_POST['cos3'];
						  $avgcon =  $_POST['avgcon'];
						  $chk_col =  $_POST['chk_col'];
						  $avgcol =  $_POST['avgcol'];
						  $chk_tas =  $_POST['chk_tas'];
						  $avgtas =  $_POST['avgtas'];
						  $chk_odo =  $_POST['chk_odo'];
						  $avgodo =  $_POST['avgodo'];
						  $chk_ins =  $_POST['chk_ins'];
						  $avgins =  $_POST['avgins'];
						  $chk_spg =  $_POST['chk_spg'];
						  $avgspg =  $_POST['avgspg'];
						  $chk_alu =  $_POST['chk_alu'];
						  $avgalu =  $_POST['avgalu'];
						  $chk_amm =  $_POST['chk_amm'];
						  $avgamm =  $_POST['avgamm'];
						  $chk_ani =  $_POST['chk_ani'];
						  $avgani =  $_POST['avgani'];
						  $chk_bar =  $_POST['chk_bar'];
						  $avgbar =  $_POST['avgbar'];
						  $chk_bor =  $_POST['chk_bor'];
						  $avgbor =  $_POST['avgbor'];
						  $chk_cra =  $_POST['chk_cra'];
						  $avgcra =  $_POST['avgcra'];
						  $chk_flu =  $_POST['chk_flu'];
						  $avgflu =  $_POST['avgflu'];
						  $chk_frc =  $_POST['chk_frc'];
						  $avgfrc =  $_POST['avgfrc'];
						  $chk_iro =  $_POST['chk_iro'];
						  $avgiro =  $_POST['avgiro'];
						  $chk_man =  $_POST['chk_man'];
						  $avgman =  $_POST['avgman'];
						  $chk_min =  $_POST['chk_min'];
						  $avgmin =  $_POST['avgmin'];
						  $chk_nit =  $_POST['chk_nit'];
						  $avgnit =  $_POST['avgnit'];
						  $chk_phe =  $_POST['chk_phe'];
						  $avgphe =  $_POST['avgphe'];
						  $chk_sel =  $_POST['chk_sel'];
						  $avgsel =  $_POST['avgsel'];
						  $chk_sil =  $_POST['chk_sil'];
						  $avgsil =  $_POST['avgsil'];
						  $chk_spd =  $_POST['chk_spd'];
						  $avgspd =  $_POST['avgspd'];
						  $chk_zin =  $_POST['chk_zin'];
						  $avgzin =  $_POST['avgzin'];
						  $chk_cop =  $_POST['chk_cop'];
						  $avgcop =  $_POST['avgcop'];
						  $chk_lea =  $_POST['chk_lea'];
						  $avglea =  $_POST['avglea'];
						  $chk_cyn =  $_POST['chk_cyn'];
						  $avgcyn =  $_POST['avgcyn'];
						  $chk_tot =  $_POST['chk_tot'];
						  $avgtot =  $_POST['avgtot'];
						  $chk_cad =  $_POST['chk_cad'];
						  $avgcad =  $_POST['avgcad'];
						  $chk_bec =  $_POST['chk_bec'];
						  $avgbec =  $_POST['avgbec'];
						  $chk_eco =  $_POST['chk_eco'];
						  $avgeco =  $_POST['avgeco'];
			
			$curr_date=date("Y-m-d");
		
			 $insert="insert into water_ground (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_phv`, `p1`, `p2`, `p3`, `pa1`, `pa2`, `pa3`, `ph1`, `ph2`, `ph3`, `avgp`, `chk_tur`, `t1`, `t2`, `t3`, `nt1`, `nt2`, `nt3`, `avgtur`, `chk_pla`, `pla1`, `pla2`, `pla3`, `plb1`, `plb2`, `plb3`, `plc1`, `plc2`, `plc3`, `pld1`, `pld2`, `pld3`, `pl1`, `pl2`, `pl3`, `avgpla`, `chl_tla`, `tla1`, `tla2`, `tla3`, `tlb1`, `tlb2`, `tlb3`, `tlc1`, `tlc2`, `tlc3`, `tld1`, `tld2`, `tld3`, `tl1`, `tl2`, `tl3`, `avgtla`, `chk_car`, `chk_bic`, `avgsample`, `avghyd`, `avgcar`, `avgbic`, `chk_hrd`, `hra1`, `hra2`, `hra3`, `hrb1`, `hrb2`, `hrb3`, `hrc1`, `hrc2`, `hrc3`, `hrd1`, `hrd2`, `hrd3`, `hr1`, `hr2`, `hr3`, `avghr`, `hrcf`, `chk_cal`, `caa1`, `caa2`, `caa3`, `cab1`, `cab2`, `cab3`, `cac1`, `cac2`, `cac3`, `cad1`, `cad2`, `cad3`, `ca1`, `ca2`, `ca3`, `avgca`, `chk_mag`, `avgmag`, `chk_chl`, `cha1`, `cha2`, `cha3`, `chb1`, `chb2`, `chb3`, `chc1`, `chc2`, `chc3`, `chd1`, `chd2`, `chd3`, `ch1`, `ch2`, `ch3`, `avgch`, `chk_sul`, `sua1`, `sua2`, `sua3`, `sub1`, `sub2`, `sub3`, `suc1`, `suc2`, `suc3`, `sud1`, `sud2`, `sud3`, `su1`, `su2`, `su3`, `avgsu`, `chk_tds`, `tda1`, `tda2`, `tda3`, `tdb1`, `tdb2`, `tdb3`, `tdc1`, `tdc2`, `tdc3`, `tdd1`, `tdd2`, `tdd3`, `td1`, `td2`, `td3`, `avgtd`, `chk_con`, `con1`, `con2`, `con3`, `cos1`, `cos2`, `cos3`, `avgcon`, `chk_col`, `avgcol`, `chk_tas`, `avgtas`, `chk_odo`, `avgodo`, `chk_ins`, `avgins`, `chk_spg`, `avgspg`, `chk_alu`, `avgalu`, `chk_amm`, `avgamm`, `chk_ani`, `avgani`, `chk_bar`, `avgbar`, `chk_bor`, `avgbor`, `chk_cra`, `avgcra`, `chk_flu`, `avgflu`, `chk_frc`, `avgfrc`, `chk_iro`, `avgiro`, `chk_man`, `avgman`, `chk_min`, `avgmin`, `chk_nit`, `avgnit`, `chk_phe`, `avgphe`, `chk_sel`, `avgsel`, `chk_sil`, `avgsil`, `chk_spd`, `avgspd`, `chk_zin`, `avgzin`, `chk_cop`, `avgcop`, `chk_lea`, `avglea`, `chk_cyn`, `avgcyn`, `chk_tot`, `avgtot`, `chk_cad`, `avgcad`, `chk_bec`, `avgbec`, `chk_eco`, `avgeco`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$chk_phv','$p1','$p2','$p3','$pa1','$pa2','$pa3','$ph1','$ph2','$ph3','$avgp','$chk_tur','$t1','$t2','$t3','$nt1','$nt2','$nt3','$avgtur','$chk_pla','$pla1','$pla2','$pla3','$plb1','$plb2','$plb3','$plc1','$plc2','$plc3','$pld1','$pld2','$pld3','$pl1','$pl2','$pl3','$avgpla','$chl_tla','$tla1','$tla2','$tla3','$tlb1','$tlb2','$tlb3','$tlc1','$tlc2','$tlc3','$tld1','$tld2','$tld3','$tl1','$tl2','$tl3','$avgtla','$chk_car','$chk_bic','$avgsample','$avghyd','$avgcar','$avgbic','$chk_hrd','$hra1','$hra2','$hra3','$hrb1','$hrb2','$hrb3','$hrc1','$hrc2','$hrc3','$hrd1','$hrd2','$hrd3','$hr1','$hr2','$hr3','$avghr','$hrcf','$chk_cal','$caa1','$caa2','$caa3','$cab1','$cab2','$cab3','$cac1','$cac2','$cac3','$cad1','$cad2','$cad3','$ca1','$ca2','$ca3','$avgca','$chk_mag','$avgmag','$chk_chl','$cha1','$cha2','$cha3','$chb1','$chb2','$chb3','$chc1','$chc2','$chc3','$chd1','$chd2','$chd3','$ch1','$ch2','$ch3','$avgch','$chk_sul','$sua1','$sua2','$sua3','$sub1','$sub2','$sub3','$suc1','$suc2','$suc3','$sud1','$sud2','$sud3','$su1','$su2','$su3','$avgsu','$chk_tds','$tda1','$tda2','$tda3','$tdb1','$tdb2','$tdb3','$tdc1','$tdc2','$tdc3','$tdd1','$tdd2','$tdd3','$td1','$td2','$td3','$avgtd','$chk_con','$con1','$con2','$con3','$cos1','$cos2','$cos3','$avgcon','$chk_col','$avgcol','$chk_tas','$avgtas','$chk_odo','$avgodo','$chk_ins','$avgins','$chk_spg','$avgspg','$chk_alu','$avgalu','$chk_amm','$avgamm','$chk_ani','$avgani','$chk_bar','$avgbar','$chk_bor','$avgbor','$chk_cra','$avgcra','$chk_flu','$avgflu','$chk_frc','$avgfrc','$chk_iro','$avgiro','$chk_man','$avgman','$chk_min','$avgmin','$chk_nit','$avgnit','$chk_phe','$avgphe','$chk_sel','$avgsel','$chk_sil','$avgsil','$chk_spd','$avgspd','$chk_zin','$avgzin','$chk_cop','$avgcop','$chk_lea','$avglea','$chk_cyn','$avgcyn','$chk_tot','$avgtot','$chk_cad','$avgcad','$chk_bec','$avgbec','$chk_eco','$avgeco')"; 
				
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
													 $query = "select * from water_ground WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
		
		 $update="update water_ground SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',
		 `chk_phv`='$_POST[chk_phv]',
		  `chk_phv`='$_POST[chk_phv]',
		  `p1`='$_POST[p1]',							
		  `p2`='$_POST[p2]',							
		  `p3`='$_POST[p3]',							
		  `pa1`='$_POST[pa1]',							
		  `pa2`='$_POST[pa2]',							
		  `pa3`='$_POST[pa3]',							
		  `ph1`='$_POST[ph1]',							
		  `ph2`='$_POST[ph2]',							
		  `ph3`='$_POST[ph3]',							
		  `avgp`='$_POST[avgp]',							
		  `chk_tur`='$_POST[chk_tur]',
		  `t1`='$_POST[t1]',
		  `t2`='$_POST[t2]',
		  `t3`='$_POST[t3]',
		  `nt1`='$_POST[nt1]',
		  `nt2`='$_POST[nt2]',
		  `nt3`='$_POST[nt3]',
		  `avgtur`='$_POST[avgtur]',							  
		  `chk_pla`='$_POST[chk_pla]',
		  `pla1`='$_POST[pla1]',
		  `pla2`='$_POST[pla2]',
		  `pla3`='$_POST[pla3]',
		  `plb1`='$_POST[plb1]',
		  `plb2`='$_POST[plb2]',
		  `plb3`='$_POST[plb3]',
		  `plc1`='$_POST[plc1]',
		  `plc2`='$_POST[plc2]',
		  `plc3`='$_POST[plc3]',
		  `pld1`='$_POST[pld1]',
		  `pld2`='$_POST[pld2]',
		  `pld3`='$_POST[pld3]',
		  `pl1`='$_POST[pl1]',
		  `pl2`='$_POST[pl2]',
		  `pl3`='$_POST[pl3]',
		  `avgpla`='$_POST[avgpla]',
		  `chl_tla`='$_POST[chl_tla]',
		  `tla1`='$_POST[tla1]',
		  `tla2`='$_POST[tla2]',
		  `tla3`='$_POST[tla3]',
		  `tlb1`='$_POST[tlb1]',
		  `tlb2`='$_POST[tlb2]',
		  `tlb3`='$_POST[tlb3]',
		  `tlc1`='$_POST[tlc1]',
		  `tlc2`='$_POST[tlc2]',
		  `tlc3`='$_POST[tlc3]',
		  `tld1`='$_POST[tld1]',
		  `tld2`='$_POST[tld2]',
		  `tld3`='$_POST[tld3]',
		  `tl1`='$_POST[tl1]',
		  `tl2`='$_POST[tl2]',
		  `tl3`='$_POST[tl3]',
		  `avgtla`='$_POST[avgtla]',
		  `chk_car`='$_POST[chk_car]',
		  `chk_bic`='$_POST[chk_bic]',
		  `avgsample`='$_POST[avgsample]',
		  `avghyd`='$_POST[avghyd]',
		  `avgcar`='$_POST[avgcar]',
		  `avgbic`='$_POST[avgbic]',
		  `chk_hrd`='$_POST[chk_hrd]',
		  `hra1`='$_POST[hra1]',
		  `hra2`='$_POST[hra2]',
		  `hra3`='$_POST[hra3]',
		  `hrb1`='$_POST[hrb1]',
		  `hrb2`='$_POST[hrb2]',
		  `hrb3`='$_POST[hrb3]',
		  `hrc1`='$_POST[hrc1]',
		  `hrc2`='$_POST[hrc2]',
		  `hrc3`='$_POST[hrc3]',
		  `hrd1`='$_POST[hrd1]',
		  `hrd2`='$_POST[hrd2]',
		  `hrd3`='$_POST[hrd3]',
		  `hr1`='$_POST[hr1]',
		  `hr2`='$_POST[hr2]',
		  `hr3`='$_POST[hr3]',
		  `avghr`='$_POST[avghr]',
		  `hrcf`='$_POST[hrcf]',
		  `chk_cal`='$_POST[chk_cal]',
		  `caa1`='$_POST[caa1]',
		  `caa2`='$_POST[caa2]',
		  `caa3`='$_POST[caa3]',
		  `cab1`='$_POST[cab1]',
		  `cab2`='$_POST[cab2]',
		  `cab3`='$_POST[cab3]',
		  `cac1`='$_POST[cac1]',
		  `cac2`='$_POST[cac2]',
		  `cac3`='$_POST[cac3]',
		  `cad1`='$_POST[cad1]',
		  `cad2`='$_POST[cad2]',
		  `cad3`='$_POST[cad3]',
		  `ca1`='$_POST[ca1]',
		  `ca2`='$_POST[ca2]',
		  `ca3`='$_POST[ca3]',
		  `avgca`='$_POST[avgca]',
		  `chk_mag`='$_POST[chk_mag]',
		  `avgmag`='$_POST[avgmag]',
		  `chk_chl`='$_POST[chk_chl]',
		  `cha1`='$_POST[cha1]',
		  `cha2`='$_POST[cha2]',
		  `cha3`='$_POST[cha3]',
		  `chb1`='$_POST[chb1]',
		  `chb2`='$_POST[chb2]',
		  `chb3`='$_POST[chb3]',
		  `chc1`='$_POST[chc1]',
		  `chc2`='$_POST[chc2]',
		  `chc3`='$_POST[chc3]',
		  `chd1`='$_POST[chd1]',
		  `chd2`='$_POST[chd2]',
		  `chd3`='$_POST[chd3]',
		  `ch1`='$_POST[ch1]',
		  `ch2`='$_POST[ch2]',
		  `ch3`='$_POST[ch3]',
		  `avgch`='$_POST[avgch]',
		  `chk_sul`='$_POST[chk_sul]',
		  `sua1`='$_POST[sua1]',
		  `sua2`='$_POST[sua2]',
		  `sua3`='$_POST[sua3]',
		  `sub1`='$_POST[sub1]',
		  `sub2`='$_POST[sub2]',
		  `sub3`='$_POST[sub3]',
		  `suc1`='$_POST[suc1]',
		  `suc2`='$_POST[suc2]',
		  `suc3`='$_POST[suc3]',
		  `sud1`='$_POST[sud1]',
		  `sud2`='$_POST[sud2]',
		  `sud3`='$_POST[sud3]',
		  `su1`='$_POST[su1]',
		  `su2`='$_POST[su2]',
		  `su3`='$_POST[su3]',
		  `avgsu`='$_POST[avgsu]',
		  `chk_tds`='$_POST[chk_tds]',
		  `tda1`='$_POST[tda1]',
		  `tda2`='$_POST[tda2]',
		  `tda3`='$_POST[tda3]',
		  `tdb1`='$_POST[tdb1]',
		  `tdb2`='$_POST[tdb2]',
		  `tdb3`='$_POST[tdb3]',
		  `tdc1`='$_POST[tdc1]',
		  `tdc2`='$_POST[tdc2]',
		  `tdc3`='$_POST[tdc3]',
		  `tdd1`='$_POST[tdd1]',
		  `tdd2`='$_POST[tdd2]',
		  `tdd3`='$_POST[tdd3]',
		  `td1`='$_POST[td1]',
		  `td2`='$_POST[td2]',
		  `td3`='$_POST[td3]',
		  `avgtd`='$_POST[avgtd]',
		  `chk_con`='$_POST[chk_con]',
		  `con1`='$_POST[con1]',
		  `con2`='$_POST[con2]',
		  `con3`='$_POST[con3]',
		  `cos1`='$_POST[cos1]',
		  `cos2`='$_POST[cos2]',
		  `cos3`='$_POST[cos3]',
		  `avgcon`='$_POST[avgcon]',
		  `chk_col`='$_POST[chk_col]',
		  `avgcol`='$_POST[avgcol]',
		  `chk_tas`='$_POST[chk_tas]',
		  `avgtas`='$_POST[avgtas]',
		  `chk_odo`='$_POST[chk_odo]',
		  `avgodo`='$_POST[avgodo]',
		  `chk_ins`='$_POST[chk_ins]',
		  `avgins`='$_POST[avgins]',
		  `chk_spg`='$_POST[chk_spg]',
		  `avgspg`='$_POST[avgspg]',
		  `chk_alu`='$_POST[chk_alu]',
		  `avgalu`='$_POST[avgalu]',
		  `chk_amm`='$_POST[chk_amm]',
		  `avgamm`='$_POST[avgamm]',
		  `chk_ani`='$_POST[chk_ani]',
		  `avgani`='$_POST[avgani]',
		  `chk_bar`='$_POST[chk_bar]',
		  `avgbar`='$_POST[avgbar]',
		  `chk_bor`='$_POST[chk_bor]',
		  `avgbor`='$_POST[avgbor]',
		  `chk_cra`='$_POST[chk_cra]',
		  `avgcra`='$_POST[avgcra]',
		  `chk_flu`='$_POST[chk_flu]',
		  `avgflu`='$_POST[avgflu]',
		  `chk_frc`='$_POST[chk_frc]',
		  `avgfrc`='$_POST[avgfrc]',
		  `chk_iro`='$_POST[chk_iro]',
		  `avgiro`='$_POST[avgiro]',
		  `chk_man`='$_POST[chk_man]',
		  `avgman`='$_POST[avgman]',
		  `chk_min`='$_POST[chk_min]',
		  `avgmin`='$_POST[avgmin]',
		  `chk_nit`='$_POST[chk_nit]',
		  `avgnit`='$_POST[avgnit]',
		  `chk_phe`='$_POST[chk_phe]',
		  `avgphe`='$_POST[avgphe]',
		  `chk_sel`='$_POST[chk_sel]',
		  `avgsel`='$_POST[avgsel]',
		  `chk_sil`='$_POST[chk_sil]',
		  `avgsil`='$_POST[avgsil]',
		  `chk_spd`='$_POST[chk_spd]',
		  `avgspd`='$_POST[avgspd]',
		  `chk_zin`='$_POST[chk_zin]',
		  `avgzin`='$_POST[avgzin]',
		  `chk_cop`='$_POST[chk_cop]',
		  `avgcop`='$_POST[avgcop]',
		  `chk_lea`='$_POST[chk_lea]',
		  `avglea`='$_POST[avglea]',
		  `chk_cyn`='$_POST[chk_cyn]',
		  `avgcyn`='$_POST[avgcyn]',
		  `chk_tot`='$_POST[chk_tot]',
		  `avgtot`='$_POST[avgtot]',
		  `chk_cad`='$_POST[chk_cad]',
		  `avgcad`='$_POST[avgcad]',
		  `chk_bec`='$_POST[chk_bec]',
		  `avgbec`='$_POST[avgbec]',
		  `chk_eco`='$_POST[chk_eco]',
		  `avgeco`='$_POST[avgeco]',
		 `checked_by`=NULL WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update water_ground SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM water_ground WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update water_ground SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update water_ground SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
    exit;
	
}
?>