<?php
include("connection.php");
$all_array=array(
				"grit_6_10_mm",
				"bc_9_5_0_075_mm",
				"bc_19_0_075_mm",
				"bit_19_75_mic",
				"bit_37_5_75_mic",
				"bm_2_36_0_075_mm",
				"bm_4_75_2_36_mm",
				"bm_4_75_13_20_mm",
				"bm_19_13_2_mm",
				"bm_26_5_19_mm",
				"bm_mix_material_19_mm",
				"bm_mix_material_40_mm",
				"busg_6_10_mm",
				"busg_10_20_mm",
				"busg_25_40_mm",
				"coarse_aggregate",
				"coarse_sand_below_2_36_mm",
				"cr_22_40_90_mic",
				"cr_45_90_mic",
				"dbm_26_5_0_075_mm",
				"dbm_26_5_mm",
				"dbm_37_5_0_075_mm",
				"dbm_37_5_mm",
				"grit_6_mm",
				"grit_10_12_mm",
				"grit_12_5_mm",
				"gsb",
				"gsb_1",
				"gsb_2",
				"gsb_3",
				"gsb_4",
				"gsb_5",
				"gsb_6",
				"gsb_26_5_4_75_mm",
				"gsb_26_5_53_mm",
				"kapachi_4_75_2_36_mm",
				"kapachi_10_20_mm",
				"kapachi_10_mm",
				"kapachi_12_20_mm",
				"kapachi_13_2_4_75_mm",
				"kapachi_19_13_2_mm",
				"kapachi_19_26_5_mm",
				"kapachi_20_mm",
				"key_aggregate",
				"k_16_mm",
				"lbm_2_36_0_075_mm",
				"lbm_2_36_4_75_mm",
				"lbm_4_75_10_mm",
				"lbm_10_20_mm",
				"lbm_20_25_mm",
				"mss_2_80_0_090_mm",
				"mss_5_6_0_090_mm",
				"mss_5_6_2_80_mm",
				"mss_11_2_0_090_mm",
				"mss_11_2_5_6_mm",
				"m_25_40_mm",
				"m_40_63_mm",
				"m_40_mm",
				"m_45_63_mm",
				"m_45_90_mm",
				"sdbc_2_36_0_075_mm",
				"sdbc_2_36_4_75_mm",
				"sdbc_9_50_4_75_mm",
				"sdbc_9_50_13_2_mm",
				"sdbc_10_mm",
				"sdbc_13_mm",
				"sd_6_3_3_35_mm",
				"sd_9_5_6_3_mm",
				"sd_13_2_9_5_mm",
				"sd_19_13_2_mm",
				"stone_dust_below_2_36_mm",
				"wbm_11_2_mm",
				"wbm_13_2_mm",
				"wbm_45_63_mm",
				"wbm_45_90_mm",
				"wbm_53_22_4",
				"wbm_stone_dust",
				"wmm_2_36_11_20_mm",
				"wmm_11_20_22_4_mm",
				"wmm_22_4_45_mm",
				"wmm_45_75_mic",
				"wmm_stone_dust"
				);
$count=0;
$fails=0;
$fails_list="";
foreach($all_array as $key => $one_array){
	
	//$update='ALTER TABLE `'.$one_array.'` DROP `chk_ll`, DROP `bo_1`, DROP `bo_2`, DROP `bo_3`, DROP `bo_4`, DROP `con_1`, DROP `con_2`, DROP `con_3`, DROP `con_4`, DROP `wc_1`, DROP `wc_2`, DROP `wc_3`, DROP `wc_4`, DROP `dry_1`, DROP `dry_2`, DROP `dry_3`, DROP `dry_4`, DROP `ww_1`, DROP `ww_2`, DROP `ww_3`, DROP `ww_4`, DROP `wtc_1`, DROP `wtc_2`, DROP `wtc_3`, DROP `wtc_4`, DROP `ods_1`, DROP `ods_2`, DROP `ods_3`, DROP `ods_4`, DROP `mc_1`, DROP `mc_2`, DROP `mc_3`, DROP `mc_4`, DROP `avg_ll`, DROP `avg_pl`, DROP `pi_value`';
	
	
	//$update='ALTER TABLE `'.$one_array.'`  ADD `dep_1` VARCHAR(50) NULL  AFTER `bdc`,  ADD `dep_2` VARCHAR(50) NULL  AFTER `dep_1`,  ADD `dep_3` VARCHAR(50) NULL  AFTER `dep_2`,  ADD `dep_4` VARCHAR(50) NULL  AFTER `dep_3`,  ADD `lab_no_1` VARCHAR(50) NULL  AFTER `dep_4`,  ADD `lab_no_2` VARCHAR(50) NULL  AFTER `lab_no_1`,  ADD `lab_no_3` VARCHAR(50) NULL  AFTER `lab_no_2`,  ADD `lab_no_4` VARCHAR(50) NULL  AFTER `lab_no_3`,  ADD `bo_1` VARCHAR(10) NULL  AFTER `lab_no_4`,  ADD `bo_2` VARCHAR(10) NULL  AFTER `bo_1`,  ADD `bo_3` VARCHAR(10) NULL  AFTER `bo_2`,  ADD `bo_4` VARCHAR(10) NULL  AFTER `bo_3`,  ADD `con1` VARCHAR(10) NULL  AFTER `bo_4`,  ADD `con2` VARCHAR(10) NULL  AFTER `con1`,  ADD `con3` VARCHAR(10) NULL  AFTER `con2`,  ADD `con4` VARCHAR(10) NULL  AFTER `con3`,  ADD `wws1` VARCHAR(10) NULL  AFTER `con4`,  ADD `wws2` VARCHAR(10) NULL  AFTER `wws1`,  ADD `wws3` VARCHAR(10) NULL  AFTER `wws2`,  ADD `wws4` VARCHAR(10) NULL  AFTER `wws3`,  ADD `wds1` VARCHAR(10) NULL  AFTER `wws4`,  ADD `wds2` VARCHAR(10) NULL  AFTER `wds1`,  ADD `wds3` VARCHAR(10) NULL  AFTER `wds2`,  ADD `wds4` VARCHAR(10) NULL  AFTER `wds3`,  ADD `pl1` VARCHAR(10) NULL  AFTER `wds4`,  ADD `pl2` VARCHAR(10) NULL  AFTER `pl1`,  ADD `pl3` VARCHAR(10) NULL  AFTER `pl2`,  ADD `weight_sample_1` VARCHAR(10) NULL  AFTER `pl3`,  ADD `blow1` VARCHAR(10) NULL  AFTER `weight_sample_1`,  ADD `mc1` VARCHAR(10) NULL  AFTER `blow1`,  ADD `liquide_limit` VARCHAR(10) NULL  AFTER `mc1`,  ADD `plastic_limit` VARCHAR(10) NULL  AFTER `liquide_limit`,  ADD `pi_value` VARCHAR(10) NULL  AFTER `plastic_limit`';
	
	
	//$update='ALTER TABLE `'.$one_array.'` DROP `chk_mdd`, DROP `mdd`, DROP `omc`, DROP `cbr`, DROP `d11`, DROP `d12`, DROP `d13`, DROP `d14`, DROP `d15`, DROP `d16`, DROP `d21`, DROP `d22`, DROP `d23`, DROP `d24`, DROP `d25`, DROP `d26`, DROP `d31`, DROP `d32`, DROP `d33`, DROP `d34`, DROP `d35`, DROP `d36`, DROP `d41`, DROP `d42`, DROP `d43`, DROP `d44`, DROP `d45`, DROP `d46`, DROP `d51`, DROP `d52`, DROP `d53`, DROP `d54`, DROP `d55`, DROP `d56`, DROP `d61`, DROP `d62`, DROP `d63`, DROP `d64`, DROP `d65`, DROP `d66`, DROP `d71`, DROP `d72`, DROP `d73`, DROP `d74`, DROP `d75`, DROP `d76`, DROP `m11`, DROP `m12`, DROP `m13`, DROP `m14`, DROP `m15`, DROP `m16`, DROP `m21`, DROP `m22`, DROP `m23`, DROP `m24`, DROP `m25`, DROP `m26`, DROP `m31`, DROP `m32`, DROP `m33`, DROP `m34`, DROP `m35`, DROP `m36`, DROP `m41`, DROP `m42`, DROP `m43`, DROP `m44`, DROP `m45`, DROP `m46`, DROP `m51`, DROP `m52`, DROP `m53`, DROP `m54`, DROP `m55`, DROP `m56`, DROP `m61`, DROP `m62`, DROP `m63`, DROP `m64`, DROP `m65`, DROP `m66`, DROP `m71`, DROP `m72`, DROP `m73`, DROP `m74`, DROP `m75`, DROP `m76`'; 
	
	
	//$update='ALTER TABLE `'.$one_array.'`  ADD `chk_mdd` VARCHAR(10) NULL  AFTER `pi_value`,  ADD `type_compaction` VARCHAR(50) NULL  AFTER `chk_mdd`,  ADD `volume` VARCHAR(10) NULL  AFTER `type_compaction`,  ADD `empty_mould` VARCHAR(10) NULL  AFTER `volume`,  ADD `weight_of_sample` VARCHAR(10) NULL  AFTER `empty_mould`,  ADD `mdd` VARCHAR(10) NULL  AFTER `weight_of_sample`,  ADD `omc` VARCHAR(10) NULL  AFTER `mdd`,  ADD `cbr` VARCHAR(10) NULL  AFTER `omc`,  ADD `wos1` VARCHAR(10) NULL  AFTER `cbr`,  ADD `wos2` VARCHAR(10) NULL  AFTER `wos1`,  ADD `wos3` VARCHAR(10) NULL  AFTER `wos2`,  ADD `wos4` VARCHAR(10) NULL  AFTER `wos3`,  ADD `wos5` VARCHAR(10) NULL  AFTER `wos4`,  ADD `wos6` VARCHAR(10) NULL  AFTER `wos5`,  ADD `wad1` VARCHAR(10) NULL  AFTER `wos6`,  ADD `wad2` VARCHAR(10) NULL  AFTER `wad1`,  ADD `wad3` VARCHAR(10) NULL  AFTER `wad2`,  ADD `wad4` VARCHAR(10) NULL  AFTER `wad3`,  ADD `wad5` VARCHAR(10) NULL  AFTER `wad4`,  ADD `wad6` VARCHAR(10) NULL  AFTER `wad5`,  ADD `wra1` VARCHAR(10) NULL  AFTER `wad6`,  ADD `wra2` VARCHAR(10) NULL  AFTER `wra1`,  ADD `wra3` VARCHAR(10) NULL  AFTER `wra2`,  ADD `wra4` VARCHAR(10) NULL  AFTER `wra3`,  ADD `wra5` VARCHAR(10) NULL  AFTER `wra4`,  ADD `wra6` VARCHAR(10) NULL  AFTER `wra5`,  ADD `wmc1` VARCHAR(10) NULL  AFTER `wra6`,  ADD `wmc2` VARCHAR(10) NULL  AFTER `wmc1`,  ADD `wmc3` VARCHAR(10) NULL  AFTER `wmc2`,  ADD `wmc4` VARCHAR(10) NULL  AFTER `wmc3`,  ADD `wmc5` VARCHAR(10) NULL  AFTER `wmc4`,  ADD `wmc6` VARCHAR(10) NULL  AFTER `wmc5`,  ADD `bd1` VARCHAR(10) NULL  AFTER `wmc6`,  ADD `bd2` VARCHAR(10) NULL  AFTER `bd1`,  ADD `bd3` VARCHAR(10) NULL  AFTER `bd2`,  ADD `bd4` VARCHAR(10) NULL  AFTER `bd3`,  ADD `bd5` VARCHAR(10) NULL  AFTER `bd4`,  ADD `bd6` VARCHAR(10) NULL  AFTER `bd5`,  ADD `cnm1` VARCHAR(10) NULL  AFTER `bd6`,  ADD `cnm2` VARCHAR(10) NULL  AFTER `cnm1`,  ADD `cnm3` VARCHAR(10) NULL  AFTER `cnm2`,  ADD `cnm4` VARCHAR(10) NULL  AFTER `cnm3`,  ADD `cnm5` VARCHAR(10) NULL  AFTER `cnm4`,  ADD `cnm6` VARCHAR(10) NULL  AFTER `cnm5`,  ADD `ww31` VARCHAR(10) NULL  AFTER `cnm6`,  ADD `ww32` VARCHAR(10) NULL  AFTER `ww31`,  ADD `ww33` VARCHAR(10) NULL  AFTER `ww32`,  ADD `ww34` VARCHAR(10) NULL  AFTER `ww33`,  ADD `ww35` VARCHAR(10) NULL  AFTER `ww34`,  ADD `ww36` VARCHAR(10) NULL  AFTER `ww35`,  ADD `wd41` VARCHAR(10) NULL  AFTER `ww36`,  ADD `wd42` VARCHAR(10) NULL  AFTER `wd41`,  ADD `wd43` VARCHAR(10) NULL  AFTER `wd42`,  ADD `wd44` VARCHAR(10) NULL  AFTER `wd43`,  ADD `wd45` VARCHAR(10) NULL  AFTER `wd44`,  ADD `wd46` VARCHAR(10) NULL  AFTER `wd45`,  ADD `omc1` VARCHAR(10) NULL  AFTER `wd46`,  ADD `omc2` VARCHAR(10) NULL  AFTER `omc1`,  ADD `omc3` VARCHAR(10) NULL  AFTER `omc2`,  ADD `omc4` VARCHAR(10) NULL  AFTER `omc3`,  ADD `omc5` VARCHAR(10) NULL  AFTER `omc4`,  ADD `omc6` VARCHAR(10) NULL  AFTER `omc5`,  ADD `mdd1` VARCHAR(10) NULL  AFTER `omc6`,  ADD `mdd2` VARCHAR(10) NULL  AFTER `mdd1`,  ADD `mdd3` VARCHAR(10) NULL  AFTER `mdd2`,  ADD `mdd4` VARCHAR(10) NULL  AFTER `mdd3`,  ADD `mdd5` VARCHAR(10) NULL  AFTER `mdd4`,  ADD `mdd6` VARCHAR(10) NULL  AFTER `mdd5`';
	
	//$update='ALTER TABLE `'.$one_array.'`  ADD `chk_ll` VARCHAR(10) NULL  AFTER `bdc`';
	
	if(mysqli_query($conn,$update)){
		$count++;	
	}else{
		$fails++;	
		$fails_list .= $update."<br><br>";
	};
	
}
echo $count." Query Fired Successfully"."<br><br><br>";
echo $fails." Query Fired Failed"."<br><br><br>";
echo $fails_list."<br>";
?>