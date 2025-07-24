<?php 
session_start();
include("connection.php");
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
				
				$expected_date_array = array();
				$joint_test="";
				$joint_test_methods="";
				$counts_of_tr= mysqli_num_rows($result_material_assign);
				$counts_materials=1;
				
				while($one_material_assign=mysqli_fetch_array($result_material_assign))
				{
					array_push($expected_date_array, $one_material_assign["expected_date"]);
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
					
					$joint_test .='<tr style="text-align:center">';
					$joint_test .='<td style="border-top: 1px solid;border-right:1px solid;" colspan="">&nbsp;'.$counts_materials.'</td>';
					$joint_test .='<td style="border-top: 1px solid;border-right:1px solid;text-align:left;" colspan="">&nbsp;'.$row_test_names["test_name"].'</td>';
					$joint_test .='<td style="border-top: 1px solid;" colspan="">&nbsp;'.$row_test_names["test_method"].'</td>';
					//$joint_test .=$row_test_names["test_name"];
					$joint_test .='</tr>';
					
					$joint_test_methods .='<tr><td style="'.$class_setting.'">';
					$joint_test_methods .=$row_test_names["test_method"];
					$joint_test_methods .='</td></tr>';
					
					$counts_materials++;
				}
				$desire_date=max($expected_date_array);
				$set_desire_date=date("d/m/y",strtotime($desire_date));
				
				//data by trf_no/job_no/labno/m_cate_material for description
				$sel_material_assign_descri="select * from span_material_assign where `material_category`='$one_final_materials[material_category]' AND `material_id`='$one_final_materials[material_id]' AND `trf_no`='$one_final_materials[trf_no]' AND `job_number`='$one_final_materials[job_no]' AND `lab_no`='$one_final_materials[lab_no]'";
				$result_material_assign_descri =mysqli_query($conn,$sel_material_assign_descri);
				$one_material_assign_descri=mysqli_fetch_assoc($result_material_assign_descri);
				
				// condition of material prefix
				$joint_desciptions="";
				$qty_parm = 1;
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
					$qty_parm = "1 Bag.";
				}
				
				if($row_material_name["mt_prefix"]=="CA")
				{
				    if($one_material_assign_descri["agg_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["agg_source"]."<br>";
					}
					$qty_parm = "1 Bag.";
				}
				
				if($row_material_name["mt_prefix"]=="BR")
				{
				    if($one_material_assign_descri["brick_mark"] !=""){
						$joint_desciptions .= " Mark: ".$one_material_assign_descri["brick_mark"]."<br>";
					}
					if($one_material_assign_descri["brick_specification"] !=""){
						$joint_desciptions .= " Specification: ".$one_material_assign_descri["brick_specification"]."<br>";
					}
					$qty_parm = "20 Nos.";
				}
				
				if($row_material_name["mt_prefix"]=="FB")
				{
				    if($one_material_assign_descri["brick_mark"] !=""){
						$joint_desciptions .= " Mark: ".$one_material_assign_descri["brick_mark"]."<br>";
					}
					if($one_material_assign_descri["brick_specification"] !=""){
						$joint_desciptions .= " Specification: ".$one_material_assign_descri["brick_specification"]."<br>";
					}
					$qty_parm = "20 Nos.";
				}
				
				if($row_material_name["mt_prefix"]=="BT")
				{
				  
					if($one_material_assign_descri["bitumin_grade"] !=""){
						$joint_desciptions .= " Type of Sample: ".$one_material_assign_descri["bitumin_grade"]."<br>";
					}
					$qty_parm = "1 Con.";
				
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
					$qty_parm = "3 Nos.";
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
					$qty_parm = "3 Nos.";
					
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
					$qty_parm = "11 Nos.";
				}
				
				if($row_material_name["mt_prefix"]=="SO")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
					$qty_parm = "1 Bag.";
				}
				
				if($row_material_name["mt_prefix"]=="MU")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
					$qty_parm = "1 Bag.";
				}
				
				if($row_material_name["mt_prefix"]=="SC")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
					$qty_parm = "1 Nos.";
				}
				
				if($row_material_name["mt_prefix"]=="DC")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
					$qty_parm = "1 Nos.";
				}
				
				if($row_material_name["mt_prefix"]=="DD")
				{
				    if($one_material_assign_descri["soil_location"] !=""){
						$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
					}
					if($one_material_assign_descri["chainage_no"] !=""){
						$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
					}
					$qty_parm = "1 Nos.";
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
					$qty_parm = "3 Nos.";
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
					$qty_parm = "1 Bag.";
				}
				
				if($row_material_name["mt_prefix"]=="QU")
				{
				    if($one_material_assign_descri["quarry_spall_source"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["quarry_spall_source"]."<br>";
					}
					$qty_parm = "1 Bag.";
				}
				
				if($row_material_name["mt_prefix"]=="BM")
				{
				    if($one_material_assign_descri["bit_mix"] !=""){
						$joint_desciptions .= " Source: ".$one_material_assign_descri["bit_mix"]."<br>";
					}
					$qty_parm = "3 Mould.";
				}
				
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
							else if(strpos($row_material_name["mt_name"],"Cement Physical") !== false || 
									strpos($row_material_name["mt_name"],"Cement Chemical") !== false)
									{
										$ansss = "Cement";
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
											//$ansss = "Concrete";
											$ansss =$row_material_name["mt_name"];
										}
										else
										{
											
												$ansss =$row_material_name["mt_name"];
											
										}
										
									}
								
							}
						
						
						array_push($matreials_name_array,$ansss);
						
						array_push($matreials_desc_array,$joint_desciptions);
						array_push($matreials_qty_array,$qty_parm);
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
					<table align="center" style="width: 95%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
        <tr>
            <td>
                
            
    <table align="center" style="width: 100%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="7">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="7">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="7">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com</td>
            </tr>
            </table>
            <table align="center" style="width: 100%;text-align: center;font-family: 'calibri';font-size: 12px;border-left:1px solid;border-right:1px solid;border-bottom:1px solid;"  cellspacing="0" cellpadding="2px" >
            <tr>
                <td style="text-align: right;font-size: 11px;font-family: 'calibri';font-size: 14px;"colspan="4">QSF-0601</td>
            </tr>
            <tr>
                <td style="width:25%;text-align: center;"><b>Sample Booking :</b> </td>
                <td style="width:25%;text-align: center;"> 9.00 am to 5.30 pm</td>
                <td style="width:25%;text-align: center;"> <b>Report Collection</b></td>
                <td style="width:25%;text-align: center;"> 9.00 am to  5.30 pm </td>
            </tr>
            </table>
            <br><br>
            <table align="center" style="width: 90%;text-align: center;font-family: 'calibri';font-size: 12px;"  cellspacing="0" cellpadding="2px">
             <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 17px;font-weight:bold;padding-top:20px;"colspan="2">SAMPLE JOB CARD</td>
            </tr>
            </table>
            <table align="center" style="width: 90%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px;"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
           
            <tr>
                <td style="width:25%;text-align: left;" colspan="">&nbsp;Job Card No:&nbsp;</td>
					<td style="width:75%;text-align: left;border-left: 1px solid;" ><?php 
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
              <!--  <td style="width:75%;text-align: left;border-left: 1px solid;" colspan="">&nbsp;</td>-->
            </tr>
             <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="">&nbsp;Date of booking:&nbsp;</td><td style="text-align: left;border-left: 1px solid;border-top: 1px solid;"><?php echo $put_sample_rec_date; ?></td>
               <!-- <td style="text-align: left;border-left: 1px solid;" colspan="">&nbsp;</td>-->
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="">&nbsp;Sample Description:&nbsp;</td><td style="text-align: left;border-left: 1px solid;border-top: 1px solid;" ><?php echo $matreials_name_one;?></td>
                <!--<td style="text-align: left;border-left: 1px solid;" colspan="">&nbsp;</td>-->
            </tr>
            <tr>
                <td style="text-align: left;border-top: 1px solid;" colspan="">&nbsp;quantity:&nbsp;</td><td style="text-align: left;border-left: 1px solid;border-top: 1px solid;"><?php echo $matreials_qty_array[$keying];?></td>
               <!-- <td style="text-align: left;border-top: 1px solid;" colspan="">&nbsp;</td>-->
            </tr> 
            </table>
            <table align="center" style="width: 90%;text-align: center;font-family: 'calibri';font-size: 12px;"  cellspacing="0" cellpadding="2px">
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 17px;font-weight:bold;"colspan="">DETAILS OF TESTS TO BE CARRIED OUT</td>
            </tr>
            </table>
            
            <table align="center" style="width: 90%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px;"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
                
            <tr style="font-weight:bold;text-align:center">
                <td style="width:25%;border-right:1px solid;" colspan="">&nbsp;S.No</td>
                <td style="width:35%;border-right:1px solid;text-align:left;" colspan="">&nbsp;Test Parameter </td>
                <td style="width:40%;" colspan="">&nbsp;Test Method</td>
            </tr>
            <?php echo $matreials_test_array[$keying];?>
        </table> 
            <br><br><br>
                        <table align="center" style="width: 90%;text-align: center;font-family: 'calibri';font-size: 12px;"  cellspacing="0" cellpadding="2px"  >
                <tr>
                    <td style="font-family: 'Calibri';text-align:left;">Expected Date of Reporting: <?php echo $set_desire_date;?></td>
                </tr>
                <tr>
                    <td style="font-family: 'Calibri';text-align:left;">Specific Instructions, if any</td>
                </tr>
                <tr>
                    <td style="font-family: 'Calibri';text-align:left;">Dated: <?php echo $put_sample_rec_date;?></td>
                </tr>
                <tr>
                    <td style="font-family: 'Calibri';text-align:right;">Authorized Signatory</td>
                </tr>
                <tr>
                    <td style="font-family: 'Calibri';text-align:right;">Miss Ujjwal Katoch</td>
                </tr>
                <tr>
                    <td style="font-family: 'Calibri';text-align:right;">(Customer Service Cell) </td>
                </tr>
            </table>  
        </td>
        </tr>
    </table>
	<br>
	<br>
					</page>
			<?php
			
			}	
		
		
		?>
	