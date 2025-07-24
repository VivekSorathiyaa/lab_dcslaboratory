<?php
include("connection.php");
error_reporting(1);

if($_GET["where"] !=""){
	$seting=" AND `sample_rec_date` >='".$_GET["start_date"]."' AND `sample_rec_date` <='".$_GET["end_date"]."'";
	$msgs="RECORD FROM ".date("d-m-Y", strtotime($_GET["start_date"]))." TO ".date("d-m-Y", strtotime($_GET["end_date"]));
}else{
	$seting="";
	$msgs="ALL RECORD";
}
?>
<table align="center" style="width: 99%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >
            <tr>
                <td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;"></td>
                
            </tr>
            <tr>
                <td style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;" colspan="13">DCS ENGINEERS & CONSULTANT Pvt. Ltd.</td> 
            </tr>
            
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="13"><b>Regd. Office : </b>VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 14px;" colspan="13">District Kangra Himachal Pradesh (176081)</td>
            </tr>
            <tr>
                <td style="text-align: center;font-size: 11px;font-family: 'calibri';font-size: 13px;" colspan="13">Mobile : +91-7018819894, +91-7833853738,e-mail : officialdcspvtltd@gmail.com
				<br>
				<br>
				<span style="text-align: center;font-weight: bold;font-family: 'calibri';font-size: 25px;">SAMPLE ENTRY REGISTER (C.S.C.)</span>
				</td>
            </tr>
			
            </table>
<table border="1" align="center" style="width: 99%;text-align: center;border:1px solid black;font-family: 'calibri';font-size: 12px"  cellspacing="0" cellpadding="2px" bordercolor ="black" >	
									<thead>
									<tr>

										<th style="text-align:center;">SR NO.</th>
										<th style="text-align:center;">Date of Receipt</th>
										<th style="text-align:center;">Job Card No</th>
										<th style="text-align:center;">Unique Identity of Sample</th>
										<th style="text-align:center;">Name and Address of the Client/Agency</th>
										<th style="text-align:center;">Sample Description</th>
										<th style="text-align:center;">Test To be Conducted</th>
										<th style="text-align:center;">Ref. No.</th>
										<th style="text-align:center;">Date Of Letter</th>
										<th style="text-align:center;">Date Of Reporting</th>
										<th style="text-align:center;">Date Of Issue</th>
										<th style="text-align:center;">Name Of The Analyst</th>
										<th style="text-align:center;">Signature</th>

									</tr>
								</thead>
								<tbody>
									<?php

										$count=0;

										$query="select * from job where  `jobisdeleted`='0' And `jobisstatus` = '1' AND `material_assign`='1'".$where." ORDER BY job_id";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{$mt_cnt=0;
											$count++;
											$name_of_work= strip_tags(html_entity_decode($row["nameofwork"]),"<strong><em>");

									?>
											<tr>



											<td>
											<a href="print_receipt.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" target="_blank" style="text-decoration:none;">
											<?php echo $count;?>
											</a>
											</td>


											<?php $sel_agency="select * from agency_master where `agency_id`=".$row["agency"];
											$query_agency = mysqli_query($conn, $sel_agency);
											$get_agency = mysqli_fetch_array($query_agency);
											/*  $sel_agency_city="select * from city where `id`=".$row["agency_city"];
											$query_agency_city = mysqli_query($conn, $sel_agency_city);
											$get_agency_city = mysqli_fetch_array($query_agency_city); */


											$lab_no="";
											$set_materilas="";
											$joint_desciptions="";
											$tested_by="";
											$sel_final="select * from final_material_assign_master where `trf_no`='$row[trf_no]'";
											$query_final=mysqli_query($conn,$sel_final);
											if(mysqli_num_rows($query_final) > 0)
											{
												while($row_final=mysqli_fetch_array($query_final))
												{
													$sel_mul="select * from multi_login where `id`=".$row_final["tested_by"];
													$query_mul=mysqli_query($conn,$sel_mul);
													$row_mul=mysqli_fetch_array($query_mul);
													$tested_by= $row_mul["staff_fullname"];
													
													$lab_no= $row_final["lab_no"];
													$set_materilas .= $row_mates["mt_name"].", ";
													
													$sel_mates="select * from material where `id`=".$row_final["material_id"];
													$query_mates=mysqli_query($conn,$sel_mates);
													$row_mates=mysqli_fetch_array($query_mates);
													$lab_no= $row_final["lab_no"];
													$set_materilas .= $row_mates["mt_name"].", ";
													
													$test_name="";
													$get_test="select * from test_wise_material_rate where `trf_no`='$row_final[trf_no]' AND `final_material_id`='$row_final[final_material_id]'";
													$query_test =mysqli_query($conn,$get_test);
													if(mysqli_num_rows($query_test) > 0)
													{
															while($achive_test=mysqli_fetch_array($query_test))
															{
																$test_id= $achive_test["test_id"];
																
																$sel_test_name="select * from test_master where `test_id`=".$test_id;
																$result_test_name =mysqli_query($conn,$sel_test_name);
																$row_test_name =mysqli_fetch_array($result_test_name);
																$test_name .=$row_test_name["test_name"].",<br>";
															}
													}
													
													$sel_material_assign_descri="select * from span_material_assign where `material_category`='$row_final[material_category]' AND `material_id`='$row_final[material_id]' AND `trf_no`='$row_final[trf_no]' AND `job_number`='$row_final[job_no]' AND `lab_no`='$row_final[lab_no]'";
													$result_material_assign_descri =mysqli_query($conn,$sel_material_assign_descri);
													$one_material_assign_descri=mysqli_fetch_assoc($result_material_assign_descri);
													
													if($row_mates["mt_prefix"]=="CM")
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
													
													if($row_mates["mt_prefix"]=="CA")
													{
														if($one_material_assign_descri["agg_source"] !=""){
															$joint_desciptions .= " Source: ".$one_material_assign_descri["agg_source"]."<br>";
														}
														$qty_parm = "1 Bag.";
													}
													
													if($row_mates["mt_prefix"]=="BR")
													{
														if($one_material_assign_descri["brick_mark"] !=""){
															$joint_desciptions .= " Mark: ".$one_material_assign_descri["brick_mark"]."<br>";
														}
														if($one_material_assign_descri["brick_specification"] !=""){
															$joint_desciptions .= " Specification: ".$one_material_assign_descri["brick_specification"]."<br>";
														}
														$qty_parm = "20 Nos.";
													}
													
													if($row_mates["mt_prefix"]=="FB")
													{
														if($one_material_assign_descri["brick_mark"] !=""){
															$joint_desciptions .= " Mark: ".$one_material_assign_descri["brick_mark"]."<br>";
														}
														if($one_material_assign_descri["brick_specification"] !=""){
															$joint_desciptions .= " Specification: ".$one_material_assign_descri["brick_specification"]."<br>";
														}
														$qty_parm = "20 Nos.";
													}
													
													if($row_mates["mt_prefix"]=="BT")
													{
													  
														if($one_material_assign_descri["bitumin_grade"] !=""){
															$joint_desciptions .= " Type of Sample: ".$one_material_assign_descri["bitumin_grade"]."<br>";
														}
														$qty_parm = "1 Con.";
													
													}
													
													if($row_mates["mt_prefix"]=="CC")
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
													
													if($row_mates["mt_prefix"]=="FX")
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
													
													if($row_mates["mt_prefix"]=="PB")
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
													
													if($row_mates["mt_prefix"]=="SO")
													{
														if($one_material_assign_descri["soil_location"] !=""){
															$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
														}
														if($one_material_assign_descri["chainage_no"] !=""){
															$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
														}
														$qty_parm = "1 Bag.";
													}
													
													if($row_mates["mt_prefix"]=="MU")
													{
														if($one_material_assign_descri["soil_location"] !=""){
															$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
														}
														if($one_material_assign_descri["chainage_no"] !=""){
															$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
														}
														$qty_parm = "1 Bag.";
													}
													
													if($row_mates["mt_prefix"]=="SC")
													{
														if($one_material_assign_descri["soil_location"] !=""){
															$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
														}
														if($one_material_assign_descri["chainage_no"] !=""){
															$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
														}
														$qty_parm = "1 Nos.";
													}
													
													if($row_mates["mt_prefix"]=="DC")
													{
														if($one_material_assign_descri["soil_location"] !=""){
															$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
														}
														if($one_material_assign_descri["chainage_no"] !=""){
															$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
														}
														$qty_parm = "1 Nos.";
													}
													
													if($row_mates["mt_prefix"]=="DD")
													{
														if($one_material_assign_descri["soil_location"] !=""){
															$joint_desciptions .= " Location: ".$one_material_assign_descri["soil_location"]."<br>";
														}
														if($one_material_assign_descri["chainage_no"] !=""){
															$joint_desciptions .= " Chainage No: ".$one_material_assign_descri["chainage_no"]."";
														}
														$qty_parm = "1 Nos.";
													}
													
													if($row_mates["mt_prefix"]=="ST")
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
													
													if($row_mates["mt_prefix"]=="WA")
													{
														if($one_material_assign_descri["water_source"] !=""){
															$joint_desciptions .= " Source: ".$one_material_assign_descri["water_source"]."<br>";
														}
													}
													
													if($row_mates["mt_prefix"]=="TI")
													{
														if($one_material_assign_descri["water_specification"] !=""){
															$joint_desciptions .= " Specification: ".$one_material_assign_descri["water_specification"]."<br>";
														}
														if($one_material_assign_descri["water_brand"] !=""){
															$joint_desciptions .= " Brand: ".$one_material_assign_descri["water_brand"]."<br>";
														}
													}
													
													if($row_mates["mt_prefix"]=="FI")
													{
														if($one_material_assign_descri["fine_aggregate_source"] !=""){
															$joint_desciptions .= " Source: ".$one_material_assign_descri["fine_aggregate_source"]."<br>";
														}
														$qty_parm = "1 Bag.";
													}
													
													if($row_mates["mt_prefix"]=="QU")
													{
														if($one_material_assign_descri["quarry_spall_source"] !=""){
															$joint_desciptions .= " Source: ".$one_material_assign_descri["quarry_spall_source"]."<br>";
														}
														$qty_parm = "1 Bag.";
													}
													
													if($row_mates["mt_prefix"]=="BM")
													{
														if($one_material_assign_descri["bit_mix"] !=""){
															$joint_desciptions .= " Source: ".$one_material_assign_descri["bit_mix"]."<br>";
														}
														$qty_parm = "3 Mould.";
													}

												}
											}
											?>
											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['sample_rec_date']));?></td>
											<td style="white-space:nowrap;"><?php echo $row['job_number'];?></td>
											<td style="white-space:nowrap;"><?php echo $lab_no;?></td>
											<td style="white-space:nowrap;"><?php echo $get_agency['agency_name']." , ".$get_agency['agency_address'];?></td>
											<td style="white-space:nowrap;"><?php echo $joint_desciptions;?></td>
											<td style="white-space:nowrap;"><?php echo $test_name;?></td>
											<td style="white-space:nowrap;"><?php echo $row["refno"];?></td>
											<td><?php
											if($row['date'] !="")
											{
											date('d/m/Y', strtotime($row['date']));
											}else{ echo "-";}
											?>
											</td>
											


											<?php
											// final material assign table data
											$get_final_material="select * from final_material_assign_master where `trf_no`='$row[trf_no]' AND `job_no`='$row[job_number]' AND `is_deleted`='0' AND `temporary_trf_no`='$row[temporary_trf_no]' order by convert(`lab_no`, decimal) ASC";
											$result_final_materials =mysqli_query($conn,$get_final_material);

											$lab_id="";
											$job_id="";
											$mt_names="";
											if(mysqli_num_rows($result_final_materials)>0)
											{
												while($one_final_materials=mysqli_fetch_array($result_final_materials))
												{	$mt_cnt++;
													// material name get code
													$materials_ids= $one_final_materials["material_id"];
													$sel_materials_names="select * from material where `id`=$materials_ids AND `mt_isdeleted`=0";
													$result_material_name =mysqli_query($conn,$sel_materials_names);
													$row_mates =mysqli_fetch_array($result_material_name);
													$mt_names .=  $row_mates['mt_name']."\n<br>";
													$lab_id .= $one_final_materials['lab_no']."\n<br>";
													$job_id = $one_final_materials['job_no']."<br>";
												}

											}
											?>
											<?php
												$billcharges;
												$chequeno;
												$ch_date;
												if($row['perfoma_completed_by_biller']==1)
												{
													  $final_bill_qury = "SELECT `make_test_bill`,`make_material_bill`,`make_estimate`,`perfoma_completed_by_biller`,`total_amt` FROM `estimate_total_span` where find_in_set('$row[trf_no]',`trf_no`) <> 0 and `est_isdeleted`=0";
													$result_final_bill_qury =mysqli_query($conn,$final_bill_qury);
													if(mysqli_num_rows($result_final_bill_qury)>0)
													{
														$row_main_bill=mysqli_fetch_array($result_final_bill_qury);
														if($row_main_bill['make_test_bill']=="1")
														{
															 $final_make_test_bill = "SELECT `total_amt`,`chequeno`,`ch_date` FROM `estimate_total_span_only_for_test` where find_in_set($row[trf_no],`trf_no`) <> 0 and `est_isdeleted`=0";
															$result_make_test_bill = mysqli_query($conn,$final_make_test_bill);
															$row_test=mysqli_fetch_array($result_make_test_bill);
															$billcharges = $row_test['total_amt'];
															$chequeno = $row_test['chequeno'];
															$ch_date = $row_test['ch_date'];

														}
														else if($row_main_bill['make_material_bill']=="1")
														{
															$final_make_material_bill = "SELECT `total_amt`,`chequeno`,`ch_date` FROM `estimate_total_span_only_for_material` where find_in_set($row[trf_no],`trf_no`) <> 0 and `est_isdeleted`=0";
															$result_make_material_bill = mysqli_query($conn,$final_make_material_bill);
															$row_mt_bill=mysqli_fetch_array($result_make_material_bill);
															$billcharges = $row_mt_bill['total_amt'];
															$chequeno = $row_mt_bill['chequeno'];
															$ch_date = $row_mt_bill['ch_date'];
														}
														else if($row_main_bill['make_estimate']=="1")
														{

															$final_make_estimate_bill = "SELECT `total_amt` FROM `estimate_total_span_only_for_material` where find_in_set($row[trf_no],`trf_no`) <> 0 and `est_isdeleted`=0";
															$result_make_estimate_bill = mysqli_query($conn,$final_make_estimate_bill);
															$row_est=mysqli_fetch_array($result_make_estimate_bill);
															$billcharges = $row_est['total_amt'];
															$chequeno = "";
															$ch_date = "";
														}
														else if($row_main_bill['perfoma_completed_by_biller']=="1")
														{
															$billcharges = $row_main_bill['total_amt'];
															$chequeno = "";
															$ch_date = "";
														}


													}
													else
													{
														$billcharges = "";
														$chequeno = "";
														$ch_date = "";
													}
												}
												else
												{
													$billcharges = "";
													$chequeno = "";
													$ch_date = "";
												}
											?>




											<?php
											// final material assign table data
											$get_final_material1="select * from final_material_assign_master where `trf_no`='$row[trf_no]' AND `job_no`='$row[job_number]' AND `is_deleted`='0' AND `temporary_trf_no`='$row[temporary_trf_no]'order by convert(`lab_no`, decimal) ASC";
											$result_final_materials1 =mysqli_query($conn,$get_final_material1);


											$enddate="";
											$issue_date="";
											$dispdate="";
											if(mysqli_num_rows($result_final_materials1)>0)
											{
												while($one_final_materials1=mysqli_fetch_array($result_final_materials1))
												{
													// material name get code

													 $sel_materials_names1="SELECT * FROM `job_for_engineer`  WHERE `trf_no`='$row[trf_no]' AND `job_no`='$row[job_number]' AND `lab_no`='$one_final_materials1[lab_no]'";
													$result_material_name1 =mysqli_query($conn,$sel_materials_names1);

													if(mysqli_num_rows($result_material_name1)>0)
													{
													$row_material_name1 =mysqli_fetch_array($result_material_name1);
													$enddate =  date('d/m/Y',strtotime($row_material_name1['end_date']));
													$issue_date =  date('d/m/Y',strtotime($row_material_name1['issue_date']));
													}
													else
													{
													$enddate =  "-";
													$issue_date =  "-";
													}

													$sel_materials_names2="SELECT `courier_date` FROM `report_dispatch`  WHERE `trf_no`='$row[trf_no]' AND `job_no`='$row[job_number]' AND `lab_no`='$one_final_materials1[lab_no]'";
													$result_material_name2 =mysqli_query($conn,$sel_materials_names2);
													if(mysqli_num_rows($result_material_name2)>0)
													{
													$row_material_name2 =mysqli_fetch_array($result_material_name2);
													$dispdate .=  date('d/m/Y',strtotime($row_material_name2['courier_date']))."<br>";
													}
													else
													{
													$dispdate .=  "<br>";
													}

												}

											}
											?>
											<td><?php echo $enddate;?></td>
											<td><?php echo $issue_date;?></td>
											<td><?php echo $tested_by;?></td>
											<td>&nbsp;</td>

										</tr>
									<?php
										}
									?>
								</tbody>

							  </table>
