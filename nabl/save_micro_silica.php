<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from micro_silica WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
			$select_result = mysqli_query($conn, $get_query);
			$result=mysqli_fetch_array($select_result);
			$id=$result['id'];
			$report_no=$result['report_no'];
			$job_no=$result['job_no'];
			$lab_no=$result['lab_no'];
			$ulr=$result['ulr'];
			
			if($result['con_date_test'] == "0000-00-00")
			{
				$con_date_test="";
			}
			else
			{
				$con_date_test = date('d/m/Y', strtotime($result['con_date_test']));							
			}
			if($result['den_date_test'] == "0000-00-00")
			{
				$den_date_test="";
			}
			else
			{
				$den_date_test = date('d/m/Y', strtotime($result['den_date_test']));						
			}
			$fill = array(
							'id' => $id,
							'report_no' => $report_no,
							'ulr' => $result['ulr'],
							'amend_date' => $result['amend_date'],
							'job_no' => $job_no,
							'lab_no' => $lab_no,	
							'chk_dry' => $result['chk_dry'],
							'd1_1' => $result['d1_1'],
							'd1_2' => $result['d1_2'],
							'd2_1' => $result['d2_1'],
							'd2_2' => $result['d2_2'],
							'd3_1' => $result['d3_1'],
							'd3_2' => $result['d3_2'],
							'avg_dry' => $result['avg_dry'],
							'chk_wet' => $result['chk_wet'],
							'w1_1' => $result['w1_1'],
							'w1_2' => $result['w1_2'],
							'w2_1' => $result['w2_1'],
							'w2_2' => $result['w2_2'],
							'w3_1' => $result['w3_1'],
							'w3_2' => $result['w3_2'],
							'avg_wet' => $result['avg_wet'],
							'chk_fine' => $result['chk_fine'],
							'w1' => $result['w1'],
							'w2' => $result['w2'],
							'w3' => $result['w3'],
							'w4' => $result['w4'],
							't1' => $result['t1'],
							't2' => $result['t2'],
							't3' => $result['t3'],
							't4' => $result['t4'],
							'avg_mass' => $result['avg_mass'],
							'avg_t' => $result['avg_t'],
							'avg_fines' => $result['avg_fines'],
							'chk_sou' => $result['chk_sou'],
							'bar1' => $result['bar1'],
							'bar2' => $result['bar2'],
							'dis1_1' => $result['dis1_1'],
							'dis1_2' => $result['dis1_2'],
							'dis2_1' => $result['dis2_1'],
							'dis2_2' => $result['dis2_2'],
							'avg_sou' => $result['avg_sou'],
							'chk_lime' => $result['chk_lime'],
							'chk_cem' => $result['chk_cem'],
							'chk_fly' => $result['chk_fly'],
							'caste_date1' => $result['caste_date1'],
							'caste_date2' => $result['caste_date2'],
							'caste_date3' => $result['caste_date3'],
							'test_date1' => $result['test_date1'],
							'test_date2' => $result['test_date2'],
							'test_date3' => $result['test_date3'],
							'age1' => $result['age1'],
							'age2' => $result['age2'],
							'age3' => $result['age3'],
							'id1' => $result['id1'],
							'id2' => $result['id2'],
							'id3' => $result['id3'],
							'id4' => $result['id4'],
							'id5' => $result['id5'],
							'id6' => $result['id6'],
							'id7' => $result['id7'],
							'id8' => $result['id8'],
							'id9' => $result['id9'],
							'l1' => $result['l1'],
							'l2' => $result['l2'],
							'l3' => $result['l3'],
							'l4' => $result['l4'],
							'l5' => $result['l5'],
							'l6' => $result['l6'],
							'l7' => $result['l7'],
							'l8' => $result['l8'],
							'l9' => $result['l9'],
							'wi1' => $result['wi1'],
							'wi2' => $result['wi2'],
							'wi3' => $result['wi3'],
							'wi4' => $result['wi4'],
							'wi5' => $result['wi5'],
							'wi6' => $result['wi6'],
							'wi7' => $result['wi7'],
							'wi8' => $result['wi8'],
							'wi9' => $result['wi9'],
							'a1' => $result['a1'],
							'a2' => $result['a2'],
							'a3' => $result['a3'],
							'a4' => $result['a4'],
							'a5' => $result['a5'],
							'a6' => $result['a6'],
							'a7' => $result['a7'],
							'a8' => $result['a8'],
							'a9' => $result['a9'],
							'load_1' => $result['load_1'],
							'load_2' => $result['load_2'],
							'load_3' => $result['load_3'],
							'load_4' => $result['load_4'],
							'load_5' => $result['load_5'],
							'load_6' => $result['load_6'],
							'load_7' => $result['load_7'],
							'load_8' => $result['load_8'],
							'load_9' => $result['load_9'],
							'com_1' => $result['com_1'],
							'com_2' => $result['com_2'],
							'com_3' => $result['com_3'],
							'com_4' => $result['com_4'],
							'com_5' => $result['com_5'],
							'com_6' => $result['com_6'],
							'com_7' => $result['com_7'],
							'com_8' => $result['com_8'],
							'com_9' => $result['com_9'],
							'avg_lime' => $result['avg_lime'],
							'avg_cem' => $result['avg_cem'],
							'avg_fly' => $result['avg_fly'],
							'chk_shr' => $result['chk_shr'],
							'shr_temp' => $result['shr_temp'],
							'shr_humidity' => $result['shr_humidity'],
							'ans_n' => $result['ans_n'],
							'ans_po' => $result['ans_po'],
							'per' => $result['per'],
							't_age' => $result['t_age'],
							't_date' => date("d/m/Y", strtotime($result['t_date'])),
							's1' => $result['s1'],
							's2' => $result['s2'],
							's3' => $result['s3'],
							'rbar1' => $result['rbar1'],
							'rbar2' => $result['rbar2'],
							'rbar3' => $result['rbar3'],
							'len1' => $result['len1'],
							'len2' => $result['len2'],
							'len3' => $result['len3'],
							'lena1' => $result['lena1'],
							'lena2' => $result['lena2'],
							'lena3' => $result['lena3'],
							'dif1' => $result['dif1'],
							'dif2' => $result['dif2'],
							'dif3' => $result['dif3'],
							'dry1' => $result['dry1'],
							'dry2' => $result['dry2'],
							'dry3' => $result['dry3'],
							'avg_shr' => $result['avg_shr'],
							'chk_mass' => $result['chk_mass'],
							'in_w1' => $result['in_w1'],
							'in_w2' => $result['in_w2'],
							'fn_w1' => $result['fn_w1'],
							'fn_w2' => $result['fn_w2'],
							'mo1' => $result['mo1'],
							'mo2' => $result['mo2'],
							'avg_mo' => $result['avg_mo']						
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
					
			$chk_dry = $_POST['chk_dry'];
			$d1_1 = $_POST['d1_1'];
			$d1_2 = $_POST['d1_2'];
			$d2_1 = $_POST['d2_1'];
			$d2_2 = $_POST['d2_2'];
			$d3_1 = $_POST['d3_1'];
			$d3_2 = $_POST['d3_2'];
			$avg_dry = $_POST['avg_dry'];
			$chk_wet = $_POST['chk_wet'];
			$w1_1 = $_POST['w1_1'];
			$w1_2 = $_POST['w1_2'];
			$w2_1 = $_POST['w2_1'];
			$w2_2 = $_POST['w2_2'];
			$w3_1 = $_POST['w3_1'];
			$w3_2 = $_POST['w3_2'];
			$avg_wet = $_POST['avg_wet'];
			$chk_fine = $_POST['chk_fine'];
			$w1 = $_POST['w1'];
			$w2 = $_POST['w2'];
			$w3 = $_POST['w3'];
			$w4 = $_POST['w4'];
			$t1 = $_POST['t1'];
			$t2 = $_POST['t2'];
			$t3 = $_POST['t3'];
			$t4 = $_POST['t4'];
			$avg_mass = $_POST['avg_mass'];
			$avg_t = $_POST['avg_t'];
			$avg_fines = $_POST['avg_fines'];
			$chk_sou = $_POST['chk_sou'];
			$bar1 = $_POST['bar1'];
			$bar2 = $_POST['bar2'];
			$dis1_1 = $_POST['dis1_1'];
			$dis1_2 = $_POST['dis1_2'];
			$dis2_1 = $_POST['dis2_1'];
			$dis2_2 = $_POST['dis2_2'];
			$avg_sou = $_POST['avg_sou'];
			$chk_lime = $_POST['chk_lime'];
			$chk_cem = $_POST['chk_cem'];
			$chk_fly = $_POST['chk_fly'];
			
			$top_c_date1 = $_POST['caste_date1'];
			$tt1 = str_replace('/','-', $top_c_date1);
			$caste_date1 =date('Y-m-d', strtotime($tt1));
			
			$top_c_date2 = $_POST['caste_date2'];
			$tt2 = str_replace('/','-', $top_c_date2);
			$caste_date2 =date('Y-m-d', strtotime($tt2));
			
			$top_c_date3 = $_POST['caste_date3'];
			$tt3 = str_replace('/','-', $top_c_date3);
			$caste_date3 =date('Y-m-d', strtotime($tt3));
			
			$top_c_date4 = $_POST['test_date1'];
			$tt4 = str_replace('/','-', $top_c_date4);
			$test_date1 =date('Y-m-d', strtotime($tt4));
			
			$top_c_date5 = $_POST['test_date2'];
			$tt5 = str_replace('/','-', $top_c_date5);
			$test_date2 =date('Y-m-d', strtotime($tt5));
			
			$top_c_date6 = $_POST['test_date3'];
			$tt6 = str_replace('/','-', $top_c_date6);
			$test_date3 =date('Y-m-d', strtotime($tt6));
			
			$age1 = $_POST['age1'];
			$age2 = $_POST['age2'];
			$age3 = $_POST['age3'];
			$id1 = $_POST['id1'];
			$id2 = $_POST['id2'];
			$id3 = $_POST['id3'];
			$id4 = $_POST['id4'];
			$id5 = $_POST['id5'];
			$id6 = $_POST['id6'];
			$id7 = $_POST['id7'];
			$id8 = $_POST['id8'];
			$id9 = $_POST['id9'];
			$l1 = $_POST['l1'];
			$l2 = $_POST['l2'];
			$l3 = $_POST['l3'];
			$l4 = $_POST['l4'];
			$l5 = $_POST['l5'];
			$l6 = $_POST['l6'];
			$l7 = $_POST['l7'];
			$l8 = $_POST['l8'];
			$l9 = $_POST['l9'];
			$wi1 = $_POST['wi1'];
			$wi2 = $_POST['wi2'];
			$wi3 = $_POST['wi3'];
			$wi4 = $_POST['wi4'];
			$wi5 = $_POST['wi5'];
			$wi6 = $_POST['wi6'];
			$wi7 = $_POST['wi7'];
			$wi8 = $_POST['wi8'];
			$wi9 = $_POST['wi9'];
			$a1 = $_POST['a1'];
			$a2 = $_POST['a2'];
			$a3 = $_POST['a3'];
			$a4 = $_POST['a4'];
			$a5 = $_POST['a5'];
			$a6 = $_POST['a6'];
			$a7 = $_POST['a7'];
			$a8 = $_POST['a8'];
			$a9 = $_POST['a9'];
			$load_1 = $_POST['load_1'];
			$load_2 = $_POST['load_2'];
			$load_3 = $_POST['load_3'];
			$load_4 = $_POST['load_4'];
			$load_5 = $_POST['load_5'];
			$load_6 = $_POST['load_6'];
			$load_7 = $_POST['load_7'];
			$load_8 = $_POST['load_8'];
			$load_9 = $_POST['load_9'];
			$com_1 = $_POST['com_1'];
			$com_2 = $_POST['com_2'];
			$com_3 = $_POST['com_3'];
			$com_4 = $_POST['com_4'];
			$com_5 = $_POST['com_5'];
			$com_6 = $_POST['com_6'];
			$com_7 = $_POST['com_7'];
			$com_8 = $_POST['com_8'];
			$com_9 = $_POST['com_9'];
			$avg_lime = $_POST['avg_lime'];
			$avg_cem = $_POST['avg_cem'];
			$avg_fly = $_POST['avg_fly'];
			$chk_shr = $_POST['chk_shr'];
			$shr_temp = $_POST['shr_temp'];
			$shr_humidity = $_POST['shr_humidity'];
			$ans_n = $_POST['ans_n'];
			$ans_po = $_POST['ans_po'];
			$per = $_POST['per'];
			$t_age = $_POST['t_age'];
			$top_c_date7 = $_POST['t_date'];
			$tt7 = str_replace('/','-', $top_c_date7);
			$t_date =date('Y-m-d', strtotime($tt7));
			
			
			$s1 = $_POST['s1'];
			$s2 = $_POST['s2'];
			$s3 = $_POST['s3'];
			$rbar1 = $_POST['rbar1'];
			$rbar2 = $_POST['rbar2'];
			$rbar3 = $_POST['rbar3'];
			$len1 = $_POST['len1'];
			$len2 = $_POST['len2'];
			$len3 = $_POST['len3'];
			$lena1 = $_POST['lena1'];
			$lena2 = $_POST['lena2'];
			$lena3 = $_POST['lena3'];
			$dif1 = $_POST['dif1'];
			$dif2 = $_POST['dif2'];
			$dif3 = $_POST['dif3'];
			$dry1 = $_POST['dry1'];
			$dry2 = $_POST['dry2'];
			$dry3 = $_POST['dry3'];
			$avg_shr = $_POST['avg_shr'];
			$chk_mass = $_POST['chk_mass'];
			$in_w1 = $_POST['in_w1'];
			$in_w2 = $_POST['in_w2'];
			$fn_w1 = $_POST['fn_w1'];
			$fn_w2 = $_POST['fn_w2'];
			$mo1 = $_POST['mo1'];
			$mo2 = $_POST['mo2'];
			$avg_mo = $_POST['avg_mo'];
			
			
			
			
			

			
			
		   $insert="INSERT INTO `micro_silica`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_dry`, `d1_1`, `d1_2`, `d2_1`, `d2_2`, `d3_1`, `d3_2`, `avg_dry`, `chk_wet`, `w1_1`, `w1_2`, `w2_1`, `w2_2`, `w3_1`, `w3_2`, `avg_wet`, `chk_fine`, `w1`, `w2`, `w3`, `w4`, `t1`, `t2`, `t3`, `t4`, `avg_mass`, `avg_t`, `avg_fines`, `chk_sou`, `bar1`, `bar2`, `dis1_1`, `dis1_2`, `dis2_1`, `dis2_2`, `avg_sou`, `chk_lime`, `chk_cem`, `chk_fly`, `caste_date1`, `caste_date2`, `caste_date3`, `test_date1`, `test_date2`, `test_date3`, `age1`, `age2`, `age3`, `id1`, `id2`, `id3`, `id4`, `id5`, `id6`, `id7`, `id8`, `id9`, `l1`, `l2`, `l3`, `l4`, `l5`, `l6`, `l7`, `l8`, `l9`, `wi1`, `wi2`, `wi3`, `wi4`, `wi5`, `wi6`, `wi7`, `wi8`, `wi9`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `load_1`, `load_2`, `load_3`, `load_4`, `load_5`, `load_6`, `load_7`, `load_8`, `load_9`, `com_1`, `com_2`, `com_3`, `com_4`, `com_5`, `com_6`, `com_7`, `com_8`, `com_9`, `avg_lime`, `avg_cem`, `avg_fly`, `chk_shr`, `shr_temp`, `shr_humidity`, `ans_n`, `ans_po`, `per`, `t_age`, `t_date`, `s1`, `s2`, `s3`, `rbar1`, `rbar2`, `rbar3`, `len1`, `len2`, `len3`, `lena1`, `lena2`, `lena3`, `dif1`, `dif2`, `dif3`, `dry1`, `dry2`, `dry3`, `avg_shr`, `chk_mass`, `in_w1`, `in_w2`, `fn_w1`, `fn_w2`, `mo1`, `mo2`, `avg_mo`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_dry', '$d1_1', '$d1_2', '$d2_1', '$d2_2', '$d3_1', '$d3_2', '$avg_dry', '$chk_wet', '$w1_1', '$w1_2', '$w2_1', '$w2_2', '$w3_1', '$w3_2', '$avg_wet', '$chk_fine', '$w1', '$w2', '$w3', '$w4', '$t1', '$t2', '$t3', '$t4', '$avg_mass', '$avg_t', '$avg_fines', '$chk_sou', '$bar1', '$bar2', '$dis1_1', '$dis1_2', '$dis2_1', '$dis2_2', '$avg_sou', '$chk_lime', '$chk_cem', '$chk_fly', '$caste_date1', '$caste_date2', '$caste_date3', '$test_date1', '$test_date2', '$test_date3', '$age1', '$age2', '$age3', '$id1', '$id2', '$id3', '$id4', '$id5', '$id6', '$id7', '$id8', '$id9', '$l1', '$l2', '$l3', '$l4', '$l5', '$l6', '$l7', '$l8', '$l9', '$wi1', '$wi2', '$wi3', '$wi4', '$wi5', '$wi6', '$wi7', '$wi8', '$wi9', '$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8', '$a9', '$load_1', '$load_2', '$load_3', '$load_4', '$load_5', '$load_6', '$load_7', '$load_8', '$load_9', '$com_1', '$com_2', '$com_3', '$com_4', '$com_5', '$com_6', '$com_7', '$com_8', '$com_9', '$avg_lime', '$avg_cem', '$avg_fly', '$chk_shr', '$shr_temp', '$shr_humidity', '$ans_n', '$ans_po', '$per', '$t_age', '$t_date', '$s1', '$s2', '$s3', '$rbar1', '$rbar2', '$rbar3', '$len1', '$len2', '$len3', '$lena1', '$lena2', '$lena3', '$dif1', '$dif2', '$dif3', '$dry1', '$dry2', '$dry3', '$avg_shr', '$chk_mass', '$in_w1', '$in_w2', '$fn_w1', '$fn_w2', '$mo1', '$mo2', '$avg_mo', '$amend_date')"; 
			
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
													 $query = "select * from `micro_silica` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
		
			$curr_date = date("Y-m-d");
			
			$top_c_date1 = $_POST['caste_date1'];
			$tt1 = str_replace('/','-', $top_c_date1);
			$caste_date1 =date('Y-m-d', strtotime($tt1));
			
			$top_c_date2 = $_POST['caste_date2'];
			$tt2 = str_replace('/','-', $top_c_date2);
			$caste_date2 =date('Y-m-d', strtotime($tt2));
			
			$top_c_date3 = $_POST['caste_date3'];
			$tt3 = str_replace('/','-', $top_c_date3);
			$caste_date3 =date('Y-m-d', strtotime($tt3));
			
			$top_c_date4 = $_POST['test_date1'];
			$tt4 = str_replace('/','-', $top_c_date4);
			$test_date1 =date('Y-m-d', strtotime($tt4));
			
			$top_c_date5 = $_POST['test_date2'];
			$tt5 = str_replace('/','-', $top_c_date5);
			$test_date2 =date('Y-m-d', strtotime($tt5));
			
			$top_c_date6 = $_POST['test_date3'];
			$tt6 = str_replace('/','-', $top_c_date6);
			$test_date3 =date('Y-m-d', strtotime($tt6));
			
			$top_c_date7 = $_POST['t_date'];
			$tt7 = str_replace('/','-', $top_c_date7);
			$t_date =date('Y-m-d', strtotime($tt7));
			
			
			$update="update micro_silica SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					`modified_by`='$_SESSION[name]',
					`modified_date`='$curr_date',					
					`checked_by`=NULL,					 
					`ulr`='$_POST[ulr]',
					`chk_dry` = '$_POST[chk_dry]',
					`d1_1` = '$_POST[d1_1]',
					`d1_2` = '$_POST[d1_2]',
					`d2_1` = '$_POST[d2_1]',
					`d2_2` = '$_POST[d2_2]',
					`d3_1` = '$_POST[d3_1]',
					`d3_2` = '$_POST[d3_2]',
					`avg_dry` = '$_POST[avg_dry]',
					`chk_wet` = '$_POST[chk_wet]',
					`w1_1` = '$_POST[w1_1]',
					`w1_2` = '$_POST[w1_2]',
					`w2_1` = '$_POST[w2_1]',
					`w2_2` = '$_POST[w2_2]',
					`w3_1` = '$_POST[w3_1]',
					`w3_2` = '$_POST[w3_2]',
					`avg_wet` = '$_POST[avg_wet]',
					`chk_fine` = '$_POST[chk_fine]',
					`w1` = '$_POST[w1]',
					`w2` = '$_POST[w2]',
					`w3` = '$_POST[w3]',
					`w4` = '$_POST[w4]',
					`t1` = '$_POST[t1]',
					`t2` = '$_POST[t2]',
					`t3` = '$_POST[t3]',
					`t4` = '$_POST[t4]',
					`avg_mass` = '$_POST[avg_mass]',
					`avg_t` = '$_POST[avg_t]',
					`avg_fines` = '$_POST[avg_fines]',
					`chk_sou` = '$_POST[chk_sou]',
					`bar1` = '$_POST[bar1]',
					`bar2` = '$_POST[bar2]',
					`dis1_1` = '$_POST[dis1_1]',
					`dis1_2` = '$_POST[dis1_2]',
					`dis2_1` = '$_POST[dis2_1]',
					`dis2_2` = '$_POST[dis2_2]',
					`avg_sou` = '$_POST[avg_sou]',
					`chk_lime` = '$_POST[chk_lime]',
					`chk_cem` = '$_POST[chk_cem]',
					`chk_fly` = '$_POST[chk_fly]',
					`caste_date1` = '$caste_date1',
					`caste_date2` = '$caste_date2',
					`caste_date3` = '$caste_date3',
					`test_date1` = '$test_date1',
					`test_date2` = '$test_date2',
					`test_date3` = '$test_date3',
					`age1` = '$_POST[age1]',
					`age2` = '$_POST[age2]',
					`age3` = '$_POST[age3]',
					`id1` = '$_POST[id1]',
					`id2` = '$_POST[id2]',
					`id3` = '$_POST[id3]',
					`id4` = '$_POST[id4]',
					`id5` = '$_POST[id5]',
					`id6` = '$_POST[id6]',
					`id7` = '$_POST[id7]',
					`id8` = '$_POST[id8]',
					`id9` = '$_POST[id9]',
					`l1` = '$_POST[l1]',
					`l2` = '$_POST[l2]',
					`l3` = '$_POST[l3]',
					`l4` = '$_POST[l4]',
					`l5` = '$_POST[l5]',
					`l6` = '$_POST[l6]',
					`l7` = '$_POST[l7]',
					`l8` = '$_POST[l8]',
					`l9` = '$_POST[l9]',
					`wi1` = '$_POST[wi1]',
					`wi2` = '$_POST[wi2]',
					`wi3` = '$_POST[wi3]',
					`wi4` = '$_POST[wi4]',
					`wi5` = '$_POST[wi5]',
					`wi6` = '$_POST[wi6]',
					`wi7` = '$_POST[wi7]',
					`wi8` = '$_POST[wi8]',
					`wi9` = '$_POST[wi9]',
					`a1` = '$_POST[a1]',
					`a2` = '$_POST[a2]',
					`a3` = '$_POST[a3]',
					`a4` = '$_POST[a4]',
					`a5` = '$_POST[a5]',
					`a6` = '$_POST[a6]',
					`a7` = '$_POST[a7]',
					`a8` = '$_POST[a8]',
					`a9` = '$_POST[a9]',
					`load_1` = '$_POST[load_1]',
					`load_2` = '$_POST[load_2]',
					`load_3` = '$_POST[load_3]',
					`load_4` = '$_POST[load_4]',
					`load_5` = '$_POST[load_5]',
					`load_6` = '$_POST[load_6]',
					`load_7` = '$_POST[load_7]',
					`load_8` = '$_POST[load_8]',
					`load_9` = '$_POST[load_9]',
					`com_1` = '$_POST[com_1]',
					`com_2` = '$_POST[com_2]',
					`com_3` = '$_POST[com_3]',
					`com_4` = '$_POST[com_4]',
					`com_5` = '$_POST[com_5]',
					`com_6` = '$_POST[com_6]',
					`com_7` = '$_POST[com_7]',
					`com_8` = '$_POST[com_8]',
					`com_9` = '$_POST[com_9]',
					`avg_lime` = '$_POST[avg_lime]',
					`avg_cem` = '$_POST[avg_cem]',
					`avg_fly` = '$_POST[avg_fly]',
					`chk_shr` = '$_POST[chk_shr]',
					`shr_temp` = '$_POST[shr_temp]',
					`shr_humidity` = '$_POST[shr_humidity]',
					`ans_n` = '$_POST[ans_n]',
					`ans_po` = '$_POST[ans_po]',
					`per` = '$_POST[per]',
					`t_age` = '$_POST[t_age]',
					`t_date` = '$t_date',
					`s1` = '$_POST[s1]',
					`s2` = '$_POST[s2]',
					`s3` = '$_POST[s3]',
					`rbar1` = '$_POST[rbar1]',
					`rbar2` = '$_POST[rbar2]',
					`rbar3` = '$_POST[rbar3]',
					`len1` = '$_POST[len1]',
					`len2` = '$_POST[len2]',
					`len3` = '$_POST[len3]',
					`lena1` = '$_POST[lena1]',
					`lena2` = '$_POST[lena2]',
					`lena3` = '$_POST[lena3]',
					`dif1` = '$_POST[dif1]',
					`dif2` = '$_POST[dif2]',
					`dif3` = '$_POST[dif3]',
					`dry1` = '$_POST[dry1]',
					`dry2` = '$_POST[dry2]',
					`dry3` = '$_POST[dry3]',
					`avg_shr` = '$_POST[avg_shr]',
					`chk_mass` = '$_POST[chk_mass]',
					`in_w1` = '$_POST[in_w1]',
					`in_w2` = '$_POST[in_w2]',
					`fn_w1` = '$_POST[fn_w1]',
					`fn_w2` = '$_POST[fn_w2]',
					`mo1` = '$_POST[mo1]',
					`mo2` = '$_POST[mo2]',
					`avg_mo` = '$_POST[avg_mo]',
					`amend_date` = '$_POST[amend_date]' WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update micro_silica SET `is_deleted`='1',`deleted_by`='$_SESSION[name]'WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM micro_silica WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update micro_silica SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update micro_silica SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>