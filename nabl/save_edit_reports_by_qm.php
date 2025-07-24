<?php
session_start();
include("connection.php");
error_reporting(1);

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    
	if($_POST['action_type'] == 'update_reports'){
       
				
				
				
				$txt_trf_no= $_POST['txt_trf_no'];
				$txt_report_no= $_POST['txt_report_no'];
				$txt_lab_no= $_POST['txt_lab_no'];
				$type_of_cement= $_POST['type_of_cement'];
				$cement_grade= $_POST['cement_grade'];
				$cement_brand= $_POST['cement_brand'];
				$week_no= $_POST['week_no'];
				$brick_source= $_POST['brick_source'];
				$sample_de= $_POST['sample_de'];
				$mark= $_POST['mark'];
				$brick_specification= $_POST['brick_specification'];
				$tanker_no= $_POST['tanker_no'];
				$lot_no= $_POST['lot_no'];
				$bitumin_grade= $_POST['bitumin_grade'];
				$make= $_POST['make'];
				$cube_grade= $_POST['cube_grade'];
				$day_remark= $_POST['day_remark'];
				$casting_date_submission= $_POST['casting_date'];
				$date_ex1_date_submission = str_replace('/', '-', $casting_date_submission);
				$casting_date =  date('Y-m-d', strtotime($date_ex1_date_submission));
				if($casting_date=="1970-01-01")
				{
					$casting_date="0000-00-00";
				}
				$day= $_POST['day'];
				$set_of_cube= $_POST['set_of_cube'];
				$no_of_cube= $_POST['no_of_cube'];
				$cc_identification= $_POST['cc_identification'];
				$chainage_no= $_POST['chainage_no'];
				$fdd_desc_sample= $_POST['fdd_desc_sample'];
				$shape= $_POST['shape'];
				$age= $_POST['age'];
				$color= $_POST['color'];
				$thickness= $_POST['thickness'];
				$paver_grade= $_POST['paver_grade'];
				$sample_type= $_POST['sample_type'];
				$soil_source= $_POST['soil_source'];
				$dia= $_POST['dia'];
				$exp_dia = explode(",",$dia);
				$cnt_report = count($exp_dia);
				for($i=0;$i<$cnt_report;$i++)
				{
					$steel_grade .= $_POST['steel_grade'].",";
				}
				
				$steel_brand= $_POST['steel_brand'];
				$steel_source_name= $_POST['steel_source_name'];
				$steel_heat= $_POST['steel_heat'];
				$steel_sample_qty= $_POST['steel_sample_qty'];
				$tile_source= $_POST['tile_source'];
				$tiles_specification= $_POST['tiles_specification'];
				$fine_agg_source= $_POST['fine_agg_source'];
				$fine_agg_type= $_POST['fine_agg_type'];
				$grd_zone= $_POST['grd_zone'];
				$qa_spall_source= $_POST['qa_spall_source'];
				$brand= $_POST['brand'];
				$bitumin_mix= $_POST['bitumin_mix'];
				$select_samp_condition= $_POST['select_samp_condition'];
				$select_location= $_POST['select_location'];
				$sample_note= $_POST['sample_note'];
				$inl= $_POST['inl'];
				$inw= $_POST['inw'];
				$inh= $_POST['inh'];
				$inden= $_POST['inden'];
				$ingrade= $_POST['ingrade'];
				$in_l= $_POST['in_l'];
				$in_h= $_POST['in_h'];
				$in_w= $_POST['in_w'];
				$in_grade= $_POST['in_grade'];
				$in_den= $_POST['in_den'];
				$excel_description= $_POST['excel_description'];
				$excel_qty= $_POST['excel_qty'];
				
				
				
				$mt_prefix= $_POST['mt_prefix'];
				$table_names= $_POST['table_names'];
				
				
				// span table updates
				
				$update_span_table="update span_material_assign set `material_location`='$select_location',`sample_note`='$sample_note',`material_condition`='$select_samp_condition',`type_of_cement`='$type_of_cement',`cement_grade`='$cement_grade',`cement_brand`='$cement_brand',`week_number`='$week_no',`agg_source`='$brick_source',`sample_de`='$sample_de',`brick_mark`='$mark',`brick_specification`='$brick_specification',`tanker_no`='$tanker_no',`lot_no`='$lot_no',`bitumin_grade`='$bitumin_grade',`bitumin_make`='$make',`cc_grade`='$cube_grade',`day_remark`='$day_remark',`casting_date`='$casting_date',`cc_day`='$day',`cc_set_of_cube`='$set_of_cube',`cc_no_of_cube`='$no_of_cube',`paver_shape`='$shape',`paver_age`='$age',`paver_color`='$color',`paver_thickness`='$thickness',`paver_grade`='$paver_grade',`soil_location`='$sample_type',`soil_source`='$soil_source',`steel_dia`='$dia',`steel_grade`='$steel_grade',`steel_brand`='$steel_brand',`water_source`='$tile_source',`water_specification`='$tiles_specification',`water_brand`='$brand',`fine_aggregate_source`='$fine_agg_source',`quarry_spall_source`='$qa_spall_source',`bit_mix`='$bitumin_mix',`cc_identification_mark`='$cc_identification',`chainage_no`='$chainage_no',`fine_agg_type`='$fine_agg_type',`grd_zone`='$grd_zone',`fdd_desc_sample`='$fdd_desc_sample',`steel_source_name`='$steel_source_name',`steel_heat`='$steel_heat',`inl`='$inl',`inw`='$inw',`inh`='$inh',`inden`='$inden',`ingrade`='$ingrade',`in_l`='$in_l',`in_w`='$in_w',`in_h`='$in_h',`in_den`='$in_den',`in_grade`='$in_grade',`steel_sample_qty`='$steel_sample_qty', `excel_description`='$excel_description',
				`excel_qty`='$excel_qty'
				where `lab_no`='$txt_lab_no'";
				
				$result_of_insert=mysqli_query($conn,$update_span_table);
				
				if($mt_prefix=="CM")
				{
					$update_table="update ".$table_names." set `type_of_cement`='$type_of_cement',`cement_grade`='$cement_grade',`cement_brand`='$cement_brand',`week_number`='$week_no' where `lab_no`='$txt_lab_no'";
				}
				
				
				if($mt_prefix=="BT")
				{
					$update_table="update ".$table_names." set `tank_no`='$tanker_no',`lot_no`='$lot_no',`bitumin_grade`='$bitumin_grade',`bitumin_make`='$make' where `lab_no`='$txt_lab_no'";
				}
				
				if($mt_prefix=="CC")
				{
					echo $update_table="update ".$table_names." set `cc_grade`='$cube_grade',`grade1`='$cube_grade',`casting_date`='$casting_date',`cc_day`='$day',`day_remark`='$day_remark',`cc_identification_mark`='$cc_identification' where `lab_no`='$txt_lab_no'";
				}
				
				if($mt_prefix=="PB")
				{
					$update_table="update ".$table_names." set `paver_shape`='$shape',`paver_color`='$color',`paver_thickness`='$thickness',`paver_grade`='$paver_grade' where `lab_no`='$txt_lab_no'";
				}
				
				
				
			/*	if($mt_prefix=="ST")
				{
					$update_table="update ".$table_names." set `grade`='$steel_grade',`dia`='$dia',`brand`='$steel_brand',`heat_no`='$steel_heat' where `lab_no`='$txt_lab_no'";
				}
				*/
				//nthi WATER
				//if($mt_prefix=="WA")
				//{
					
				//}
				
				//nathi TILES
				//if($mt_prefix=="TI")
				//{
					
				//}
				
				//nathi FINE AGGREGATE
				//if($mt_prefix=="FA")
				//{
					
				//}
				
				//nathi QAURRY SPOIL
				//if($mt_prefix=="QU")
				//{
					
				//}
				
				//nathi FIELD TEST
				//if($mt_prefix=="FT")
				//{
					
				//}
				
				// nthi BRICK
				//if($mt_prefix=="BR")
				//{
					
				//}
				
				
				// nthi BITUMIN MIX
				//if($mt_prefix=="BM")
				//{
					
				//}
				
				//nthi SOIL
				//if($mt_prefix=="SO")
				//{
					
				//}
				
			$result_of_table=mysqli_query($conn,$update_table);
				
	}

}
    exit;

?>