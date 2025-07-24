<?php 
session_start();
include("connection.php");
?>
<?php 
//if($_SESSION['name']=="")
//{
	?>
	<script >
		//window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
//}
?>
<style>
@page { margin: 0; }


@media print{@page }

.tdclass{
    border: 1px solid black;
    font-size:11px;
	 font-family: Book Antiqua;
}
.test {
    border-collapse: collapse;
}
	.tdclass1{
    
    font-size:11px;
	 font-family: Book Antiqua;
}
.pagebreak { page-break-after: always; }

</style>
<html>
	<body>
<?php
		// get estimate by report no and job no
		$get_report_no=$_GET["trf_no"];
		$get_job_no=$_GET["job_no"];
		$temporary_trf_no=$_GET["temporary_trf_no"];
		$sel_estiamte="select * from job where `trf_no`='$get_report_no' AND `temporary_trf_no`='$temporary_trf_no'";
		$result_estiamte =mysqli_query($conn,$sel_estiamte);
		$row_estiamte =mysqli_fetch_array($result_estiamte);
		$branch_id=$row_estiamte["branch_id"];
		
		$sel_branch = "select * from branches where `branch_id`=".$branch_id;
		$query_branch = mysqli_query($conn, $sel_branch);
		$row_branch = mysqli_fetch_array($query_branch);
		$company_name=$row_branch["company_name"];
		$company_logo=$row_branch["company_logo"];
		$company_address=$row_branch["company_address"];
		
		
		$setting_date=date_create($row_estiamte["jobcreateddate"]);
		$jobcreateddate= date_format($setting_date,"d.m.Y");
		
		$setting_date_rec_date=date_create($row_estiamte["sample_rec_date"]);
		$put_sample_rec_date= date_format($setting_date_rec_date,"d.m.Y");
		
		
		// get name of agency by report no and job no from agency table
		$sel_agency_id=$row_estiamte["agency"];
		
		$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$sel_agency_id;
		$result_agency =mysqli_query($conn,$sel_agency);
		$row_agency =mysqli_fetch_array($result_agency);
		$agency_name=$row_agency["agency_name"];
		$agency_address=$row_agency["agency_address"];
		$agency_gst=$row_agency["agency_gstno"];
		$agency_email=$row_agency["agency_email"];
		
		
		$name_of_work= strip_tags(html_entity_decode($row_estiamte["nameofwork"]),"<strong><em>");
			
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
		
		<?php
		
		$matreials_id_array=array();
		$matreials_name_array=array();
		$matreials_desc_array=array();
		$matreials_qty_array=array();
		$matreials_test_array=array();
		$matreials__method_array=array();
		$matreials_ulr_array=array();
		// static ulr no logic
		$sel_static_ulr_no="select * from ulr_no where `ulr_status`=0 AND `ulr_is_deleted`=0";
		$query_static_ulr_no=mysqli_query($conn,$sel_static_ulr_no);
		$row_static_ulr_no =mysqli_fetch_array($query_static_ulr_no);
		$static_ulr_nos= $row_static_ulr_no["ulr_no"];
		
		// final material assign table data
		$get_final_material="select * from final_material_assign_master where `trf_no`='$get_report_no' AND `job_no`='$get_job_no' AND `temporary_trf_no`='$temporary_trf_no' AND `is_deleted`='0' ORDER BY `final_material_id` ASC";
		$result_final_materials =mysqli_query($conn,$get_final_material);
		$counts=1;
		if(mysqli_num_rows($result_final_materials)>0)
		{
			while($one_final_materials=mysqli_fetch_array($result_final_materials))
			{
				// material name get code
				$materials_ids= $one_final_materials["material_id"];
				$sel_materials_names="select * from material where `id`=$materials_ids AND `mt_isdeleted`=0";
				$result_material_name =mysqli_query($conn,$sel_materials_names);
				$row_material_name =mysqli_fetch_array($result_material_name);
				

				
				//data by trf_no/job_no/labno/m_cate_material
				$sel_material_assign="select * from span_material_assign where `material_category`='$one_final_materials[material_category]' AND `material_id`='$one_final_materials[material_id]' AND `trf_no`='$one_final_materials[trf_no]' AND `job_number`='$one_final_materials[job_no]' AND `lab_no`='$one_final_materials[lab_no]'";
				$result_material_assign =mysqli_query($conn,$sel_material_assign);
				
				$joint_test="";
				$joint_test_methods="";
				$counts_of_tr= mysqli_num_rows($result_material_assign);
				$counts_materials=1;
				
				while($one_material_assign=mysqli_fetch_array($result_material_assign))
				{
					// test name by test id
					$sel_test_names="select * from test_master where `test_id`=$one_material_assign[test] AND `test_isdeleted`=0";
					$result_test_names =mysqli_query($conn,$sel_test_names);
					$row_test_names =mysqli_fetch_array($result_test_names);
					
					//$joint_test .=$row_test_names["test_name"]."<br>";
					//$joint_test_methods .=$row_test_names["test_method"]."<br>";
					if($counts_materials !=$counts_of_tr)
					{
						$class_setting="padding-left: 0px;font-size: 11px;border-bottom: 1px solid;";
					}else{
						
						$class_setting="padding-left: 0px;font-size: 11px;border-bottom: 0px solid;";
					}
					
					$joint_test .='<tr><td style="'.$class_setting.'">';
					$joint_test .=$row_test_names["test_name"];
					$joint_test .='</td></tr>';
					
					$joint_test_methods .='<tr><td style="'.$class_setting.'">';
					$joint_test_methods .=$row_test_names["test_method"];
					$joint_test_methods .='</td></tr>';
					
					$counts_materials++;
				}
				
				//data by trf_no/job_no/labno/m_cate_material for description
				$sel_material_assign_descri="select * from span_material_assign where `material_category`='$one_final_materials[material_category]' AND `material_id`='$one_final_materials[material_id]' AND `trf_no`='$one_final_materials[trf_no]' AND `job_number`='$one_final_materials[job_no]' AND `lab_no`='$one_final_materials[lab_no]'";
				$result_material_assign_descri =mysqli_query($conn,$sel_material_assign_descri);
				$one_material_assign_descri=mysqli_fetch_assoc($result_material_assign_descri);
				
				// condition of material prefix
				$joint_desciptions="";
				
				if($row_material_name["mt_prefix"]=="CM")
				{
				    if($one_material_assign_descri["type_of_cement"] !=""){
						//$joint_desciptions .= "Type: ".$one_material_assign_descri["type_of_cement"]."<br>";
					}
					if($one_material_assign_descri["cement_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["cement_grade"]."<br>";
					}
					if($one_material_assign_descri["cement_brand"] !=""){
						//$joint_desciptions .= " Brand: ".$one_material_assign_descri["cement_brand"]."<br>";
					}
					if($one_material_assign_descri["week_number"] !=""){
						//$joint_desciptions .= " Week No.: ".$one_material_assign_descri["week_number"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="CA")
				{
				    if($one_material_assign_descri["agg_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["agg_source"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="BR")
				{
				    if($one_material_assign_descri["brick_mark"] !=""){
						$joint_desciptions .= " Mark: ".$one_material_assign_descri["brick_mark"]."<br>";
					}
					if($one_material_assign_descri["brick_specification"] !=""){
						$joint_desciptions .= " Specification: ".$one_material_assign_descri["brick_specification"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="FB")
				{
				    if($one_material_assign_descri["brick_mark"] !=""){
						$joint_desciptions .= " Mark: ".$one_material_assign_descri["brick_mark"]."<br>";
					}
					if($one_material_assign_descri["brick_specification"] !=""){
						$joint_desciptions .= " Specification: ".$one_material_assign_descri["brick_specification"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="BT")
				{
				  
					if($one_material_assign_descri["bitumin_grade"] !=""){
						$joint_desciptions .= " Type of Sample: ".$one_material_assign_descri["bitumin_grade"]."<br>";
					}
				
				}
				
				if($row_material_name["mt_prefix"]=="CC")
				{
				    
					if($one_material_assign_descri["casting_date"] !=""){
					
                    $testing_days=$one_material_assign_descri["cc_day"];					
					$testing_dates=date('Y-m-d', strtotime($one_material_assign_descri["casting_date"]. ' + '.$testing_days.' days'));
					
					$joint_desciptions .= " Casting Date: ". date(("d-m-Y"),strtotime($one_material_assign_descri["casting_date"]))."<br>"." Testing Date:".date(("d-m-Y"),strtotime($testing_dates))."<br>";
					}
					if($one_material_assign_descri["cc_day"] !=""){
						$joint_desciptions .= " Days: ".$one_material_assign_descri["cc_day"]."<br>";
					}
					
					
					
					
				}
				
				if($row_material_name["mt_prefix"]=="FX")
				{
				    if($one_material_assign_descri["casting_date"] !=""){
					
                    $testing_days=$one_material_assign_descri["cc_day"];					
					$testing_dates=date('Y-m-d', strtotime($one_material_assign_descri["casting_date"]. ' + '.$testing_days.' days'));
					
					$joint_desciptions .= " Casting Date: ". date(("d-m-Y"),strtotime($one_material_assign_descri["casting_date"]))."<br>"." Testing Date:".date(("d-m-Y"),strtotime($testing_dates))."<br>";
					}
					if($one_material_assign_descri["cc_day"] !=""){
						$joint_desciptions .= " Days: ".$one_material_assign_descri["cc_day"]."<br>";
					}
					
				}
				
				if($row_material_name["mt_prefix"]=="PB")
				{
				    if($one_material_assign_descri["paver_shape"] !=""){
						$joint_desciptions .= " Shape: ".$one_material_assign_descri["paver_shape"]."<br>";
					}
					if($one_material_assign_descri["paver_age"] !=""){
						$joint_desciptions .= " Age: ".$one_material_assign_descri["paver_age"]."<br>";
					}
					if($one_material_assign_descri["paver_color"] !=""){
						$joint_desciptions .= " Color: ".$one_material_assign_descri["paver_color"]."<br>";
					}
					if($one_material_assign_descri["paver_thickness"] !=""){
						$joint_desciptions .= " Thickness: ".$one_material_assign_descri["paver_thickness"]."<br>";
					}
					if($one_material_assign_descri["paver_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["paver_grade"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="SO")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
				}
				
				if($row_material_name["mt_prefix"]=="MU")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
				}
				
				if($row_material_name["mt_prefix"]=="SC")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
				}
				
				if($row_material_name["mt_prefix"]=="DC")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
				}
				
				if($row_material_name["mt_prefix"]=="DD")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
				}
				
				if($row_material_name["mt_prefix"]=="ST")
				{
				    if($one_material_assign_descri["steel_dia"] !=""){
						$joint_desciptions .= " Dia: ".$one_material_assign_descri["steel_dia"]." mm<br>";
					}
					 if($one_material_assign_descri["steel_grade"] !=""){
						$joint_desciptions .= " Grade: ".$one_material_assign_descri["steel_grade"]."<br>";
					}
					/*if($one_material_assign_descri["steel_brand"] !=""){
						$joint_desciptions .= " Brand: ".$one_material_assign_descri["steel_brand"]."<br>";
					} */
				}
				
				if($row_material_name["mt_prefix"]=="WA")
				{
				    if($one_material_assign_descri["water_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["water_source"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="TI")
				{
				    if($one_material_assign_descri["water_specification"] !=""){
						$joint_desciptions .= " Specification: ".$one_material_assign_descri["water_specification"]."<br>";
					}
					if($one_material_assign_descri["water_brand"] !=""){
						$joint_desciptions .= " Brand: ".$one_material_assign_descri["water_brand"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="FI")
				{
				    if($one_material_assign_descri["fine_aggregate_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["fine_aggregate_source"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="QU")
				{
				    if($one_material_assign_descri["quarry_spall_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["quarry_spall_source"]."<br>";
					}
				}
				
				if($row_material_name["mt_prefix"]=="BM")
				{
				    if($one_material_assign_descri["bit_mix"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["bit_mix"]."<br>";
					}
				}
				
				 /*  if (!in_array($materials_ids, $matreials_id_array))
				  {
						array_push($matreials_id_array,$materials_ids);
						array_push($matreials_name_array,$row_material_name["mt_name"]);
						array_push($matreials_desc_array,$joint_desciptions);
						array_push($matreials_qty_array,1);
						array_push($matreials_test_array,$joint_test);
						array_push($matreials__method_array,$joint_test_methods);
						array_push($matreials_ulr_array,$one_final_materials["ulr_no"]);
				  }
				else
				  {
				       $key = array_search ($materials_ids, $matreials_id_array);
					   $matreials_qty_array[$key]= intval($matreials_qty_array[$key])+1;
					   
					   
					   if($materials_ids==129){
					   $matreials_desc_array[$key]=$matreials_desc_array[$key]."<br>".$joint_desciptions;
					   $matreials_ulr_array[$key]= $matreials_ulr_array[$key].",".$one_final_materials["ulr_no"];
					   }
					   if($materials_ids==131){
					   $matreials_desc_array[$key]=$matreials_desc_array[$key]."<br>".$joint_desciptions;
					   $matreials_ulr_array[$key]= $matreials_ulr_array[$key].",".$one_final_materials["ulr_no"];
					   }
				  } */
				  
				        array_push($matreials_id_array,$materials_ids);
						if(strpos($row_material_name["mt_name"],"WMM (MIX MATERIAL)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - I MIX (M4-1)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - II MIX (M4-2)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - III MIX (M4-1)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - IV MIX (M5)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - V MIX (M5)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - VI MIX (M5)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - I MIX (M5)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - III MIX (M5)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - II MIX (M5)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - I MIX (M4-2)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - II MIX (M4-1)") !== false || 
							strpos($row_material_name["mt_name"],"GSB - III MIX (M4-2)") !== false || 
							strpos($row_material_name["mt_name"],"MSS - A (MIX MATERIAL)") !== false || 
							strpos($row_material_name["mt_name"],"MSS - B (MIX MATERIAL)") !== false || 
							strpos($row_material_name["mt_name"],"BUSG - CA (MIX MATERIAL)") !== false || 
							strpos($row_material_name["mt_name"],"BUSG - KA (MIX MATERIAL)") !== false || 
							strpos($row_material_name["mt_name"],"BM - 2 (MIX MATERIAL)") !== false|| 
							strpos($row_material_name["mt_name"],"BM - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_material_name["mt_name"],"BC - 2 (MIX MATERIAL)") !== false|| 
							strpos($row_material_name["mt_name"],"BC - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_material_name["mt_name"],"DBM - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_material_name["mt_name"],"DBM - 2 (MIX MATERIAL)") !== false|| 
							strpos($row_material_name["mt_name"],"SDBC - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_material_name["mt_name"],"SDBC - 2 (MIX MATERIAL)") !== false)
							{
								
								
								$ansss = $row_material_name["mt_name"];								
							}
							else
							{
									if(strpos($row_material_name["mt_name"],"WMM") !== false || 
									strpos($row_material_name["mt_name"],"WBM") !== false || 
									strpos($row_material_name["mt_name"],"RCC") !== false || 
									strpos($row_material_name["mt_name"],"GSB") !== false || 
									strpos($row_material_name["mt_name"],"BM") !== false || 
									strpos($row_material_name["mt_name"],"BC") !== false || 
									strpos($row_material_name["mt_name"],"SDBC") !== false || 
									strpos($row_material_name["mt_name"],"MSS") !== false || 
									strpos($row_material_name["mt_name"],"DBM") !== false || 
									strpos($row_material_name["mt_name"],"BUSG") !== false)
									{
										$ans = substr($row_material_name["mt_name"],strpos($row_material_name["mt_name"],"(") + 1);
										$explodeing = explode(")",$ans);
										$second = $explodeing[0];								
										$ansss = $second;
									}
									else
									{
										if(strpos($row_material_name["mt_name"],"C.C.Cube") !== false || strpos($row_material_name["mt_name"],"Flexural Strength of Concrete Beam") !== false)
										{
											$ansss = "Concrete";
										}
										else
										{
											
												$ansss =$row_material_name["mt_name"];
											
										}
										
									}
								
							}
						
						
						array_push($matreials_name_array,$ansss);
						
						array_push($matreials_desc_array,$joint_desciptions);
						array_push($matreials_qty_array,1);
						array_push($matreials_test_array,$joint_test);
						array_push($matreials__method_array,$joint_test_methods);
						array_push($matreials_ulr_array,$one_final_materials["lab_no"]);
				  
			}
			}
			$material_counts=count($matreials_name_array);
			foreach($matreials_name_array as $keying => $matreials_name_one )
			{  $counts= $keying+1;
			?>

					<page size="A4">
					<div class="<?php if($counts !=$material_counts){ echo "pagebreak";}?>">
					<br>
		            <br>
					<table align="center" width="95%" class="test" border="1px" style="font-family: Book Antiqua;height: 120px;">
					<tr>
							<td rowspan="6" width="5%">
							<center>
							<img src="images/branch_logo/<?php echo $company_logo;?>" style="width:150px;">
							</center>
							</td>
							<td rowspan="6" colspan="5" width="40%" style="text-align:center;">
							<b style="font-size: 30px;"><?php echo $company_name;?></b><br>
							<b style="font-size: 20px;">(Formerly known as DC Consultant)</b>
							<p style="margin-top: 0px;margin-bottom: 0px;"><?php echo $set_mo_and_email;?></p>
							<b style="font-size: 20px;"><?php echo $set_reg_office;?></b><br>
							<b style="font-size: 20px;">Job Card</b>
							</td>
					</tr>
					</table>
					<br>
					<table align="center" width="95%" class="test" border="1px" style="border: 1px solid black; font-family: Book Antiqua;font-size:11px;">
					<tr>
					<td style="padding-left: 5px;width:20%;">
					<b>Test Request No.:</b>
					
					</td>
					<td style="padding-left: 5px;width:40%;"><span style="font-size:10px;"><?php echo $row_estiamte["trf_no"];?></span></td>
					<td style="padding-left: 5px;40%"><b>Date:</b>&nbsp;<span style="font-size:10px;"><?php echo $put_sample_rec_date; ?></span></td>
					</tr>
					
					<tr>
					<td style="padding-left: 5px;width:230px;"><b>Job Card No.:</b></td>
					<td colspan="2" style="padding-left: 5px;font-size:10px;">
					<?php 
					    $explode_url_for_counts=explode(",",$matreials_ulr_array[$keying]);
						if(count($explode_url_for_counts)>1)
						{ 
					      echo $first = ltrim(reset($explode_url_for_counts),"0")."-";
						  echo $last = ltrim(end($explode_url_for_counts),"0");
						}else{ 
						echo ltrim($explode_url_for_counts[0],"0");
						};
						?>
					</td>
					</tr>
					</table>
					<br>
					<table align="center" width="95%" class="test" border="1px" style="font-family: Book Antiqua;">
					<tr>
						<td colspan="7"><b>TEST TO BE PERFORM</b></td>
					</tr>
					<tr>
						<td width="10%;"><b style="font-size:12px;">Sr No.</b></td>
						<td width="15%;"><b style="font-size:12px;">Material</b></td>
						<td width="23%;"><b style="font-size:12px;">Test</b></td>
						<?php if($matreials_id_array[$keying]=="129" || $matreials_id_array[$keying]=="131" || $matreials_id_array[$keying]=="143" || $matreials_id_array[$keying]=="134" || $matreials_id_array[$keying]=="135"){ ?>
						<td width="22%;"><b style="font-size:12px;">Test Description</b></td>
						<?php } ?>
						<td width="12%;"><b style="font-size:12px;">Test Method</b></td>
						<td width="15%;"><b style="font-size:12px;">Remark</b></td>
					</tr>
						<tr style="text-align:center;">
						<td class="tdclass" style="padding:5px;"><?php echo "1";?></td>
						<td class="tdclass" style="padding:5px;"><?php echo $matreials_name_one;?></td>
						<td class="tdclass" style="padding:0px;white-space:nowrap;text-align:center;">
						
							<table align="center" width="100%" class="test"  style="font-family: Book Antiqua;text-align:center;">
								<?php echo $matreials_test_array[$keying];?>
							</table>
						
						<?php //echo $joint_test;?>
						</td>
						<?php if($matreials_id_array[$keying]=="129" || $matreials_id_array[$keying]=="131" || $matreials_id_array[$keying]=="143" || $matreials_id_array[$keying]=="134" || $matreials_id_array[$keying]=="135"){ ?>
						<td class="tdclass" style="padding:0px">
						
							<table align="center" width="100%" class="test"  style="font-family: Book Antiqua;">
								<?php echo $matreials_desc_array[$keying];?>
							</table>
						
						<?php //echo $joint_test;?>
						</td>
						<?php }?>
						<td class="tdclass" style="padding:0px;">
						
							<table align="center" width="100%" class="test"  style="font-family: Book Antiqua;">
								<?php echo $matreials__method_array[$keying];?>
							</table>
						
						</td>
						<td class="tdclass" style="padding:5px;">&nbsp;</td>
					</tr>
					
					</table>
					<br>
					<br>
					<table align="center" width="95%" class="test" border="1px" style="font-family: Book Antiqua;font-size:12px;">
					<tr style="background-color:#A9A9A9">
							<td colspan="2" style="padding: 5px;">
							<b>Prepared & Issued by:&nbsp;&nbsp;QM</b>
							</td>
							<td colspan="2" style="padding: 5px;">
							<b>Reviewed & Approved by:&nbsp;&nbsp;CEO</b>
							</td>
					</tr>
					</table>
					<br>
					 </div>
					</page>
			<?php
			
			}	
		
		
		?>
		
	<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">
	</body>
</html>
	<script src="bower_components/ckeditor/ckeditor.js"></script>
	<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('txt_auth_address')
    //bootstrap WYSIHTML5 - text editor
   // $('.textarea').wysihtml5()
  })
</script>
<script type="text/javascript">
window.onload = function(){ 
	setTimeout(function()
		{
			
			//window.print();
		}, 
		1000);

}

$("#print_button").on("click",function(){
	$('#print_button').hide();
	window.print();
});

</script>