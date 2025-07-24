<?php

session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from con_cylinder WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'top_casting_date' => date('d/m/Y', strtotime($result['casting_date'])),				
							'remarks' => $result['remarks'],
							'top_days' => $result['cc_day'],
							'top_grade' => $result['cc_grade'],							
							'top_no_of_cube' => $result['cc_no_of_cube'],							
							'top_remark' => $result['day_remark'],							
							'top_set' => $result['cc_set_of_cube'],									
							'grade1' => $result['grade1'],							
							'cc_qty' => $result['cc_qty'],							
							'cc_identification_mark' => $result['cc_identification_mark'],							
							'caste_date1' => date('d/m/Y', strtotime($result['caste_date1'])),							
							'test_date1' => date('d/m/Y', strtotime($result['test_date1'])),							
							'day1' => $result['day1'],														
							'l1' => $result['l1'],							
							'l2' => $result['l2'],							
							'l3' => $result['l3'],							
							'b1' => $result['b1'],							
							'b2' => $result['b2'],							
							'b3' => $result['b3'],							
							'h1' => $result['h1'],							
							'h2' => $result['h2'],							
							'h3' => $result['h3'],							
							'cross_1' => $result['cross_1'],							
							'cross_2' => $result['cross_2'],							
							'cross_3' => $result['cross_3'],							
							'mass_1' => $result['mass_1'],							
							'mass_2' => $result['mass_2'],							
							'mass_3' => $result['mass_3'],							
							'load_1' => $result['load_1'],							
							'load_2' => $result['load_2'],							
							'load_3' => $result['load_3'],							
							'comp_1' => $result['comp_1'],							
							'comp_2' => $result['comp_2'],							
							'comp_3' => $result['comp_3'],							
							'fail_pat_1' => $result['fail_pat_1'],							
							'fail_pat_2' => $result['fail_pat_2'],							
							'fail_pat_3' => $result['fail_pat_3'],							
							'avg_com_s_1' => $result['avg_com_s_1'],
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
							'average' => $result['average']	
							
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
					
			$chk_com =  $_POST['chk_com'];	
			
			$remarks = $_POST['remarks'];
			$top_c_date = $_POST['top_casting_date'];
			$tt=str_replace('/','-',$top_c_date);
			$top_casting_date=date('Y-m-d',strtotime($tt));
			
			$top_days = $_POST['top_days'];
			$top_grade = $_POST['top_grade'];
			$top_no_of_cube = $_POST['top_no_of_cube'];
			$top_remark = $_POST['top_remark'];
			$top_set = $_POST['top_set'];
			$cc_identification_marks = $_POST['cc_identification_mark'];
			$cc_identification_mark = str_replace("school","+",$cc_identification_marks);
			$cc_qty = $_POST['cc_qty'];
			
			$avg_com_s_1 = $_POST['avg_com_s_1'];
			
			$grade1 = $_POST['grade1'];

			
			$t_caste_date1 = $_POST['caste_date1'];
			$t1=str_replace('/','-',$t_caste_date1);
			$caste_date1=date('Y-m-d',strtotime($t1));
			
			
			$t_test_date1 = $_POST['test_date1'];
			$s1=str_replace('/','-',$t_test_date1);
			$test_date1=date('Y-m-d',strtotime($s1));
			
			
			$day1 = $_POST['day1'];
			
			$l1 = $_POST['l1'];
			$l2 = $_POST['l2'];
			$l3 = $_POST['l3'];
			
			
			$b1 = $_POST['b1'];
			$b2 = $_POST['b2'];
			$b3 = $_POST['b3'];
			
			
			$h1 = $_POST['h1'];
			$h2 = $_POST['h2'];
			$h3 = $_POST['h3'];
			
			
			$cross_1 = $_POST['cross_1'];
			$cross_2 = $_POST['cross_2'];
			$cross_3 = $_POST['cross_3'];
			
			
			$mass_1 = $_POST['mass_1'];
			$mass_2 = $_POST['mass_2'];
			$mass_3 = $_POST['mass_3'];
			
			
			$load_1 = $_POST['load_1'];
			$load_2 = $_POST['load_2'];
			$load_3 = $_POST['load_3'];
			
			
			$comp_1 = $_POST['comp_1'];
			$comp_2 = $_POST['comp_2'];
			$comp_3 = $_POST['comp_3'];
			
			$fail_pat_1 = $_POST['fail_pat_1'];
			$fail_pat_2 = $_POST['fail_pat_2'];
			$fail_pat_3 = $_POST['fail_pat_3'];
			
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
																
			
			$curr_date=date("Y-m-d");
			

					
		 $insert="INSERT INTO `con_cylinder`( `report_no`,`ulr`, `job_no`, `lab_no`, `cc_grade`, `casting_date`, `cc_day`, `day_remark`, `cc_set_of_cube`, `cc_no_of_cube`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_com`, `grade1`, `caste_date1`, `test_date1`, `day1`, `l1`, `l2`, `l3`, `b1`, `b2`, `b3`, `h1`, `h2`, `h3`, `cross_1`, `cross_2`, `cross_3`, `mass_1`, `mass_2`, `mass_3`, `load_1`, `load_2`, `load_3`, `comp_1`, `comp_2`, `comp_3`, `avg_com_s_1`, `fail_pat_1`, `fail_pat_2`, `fail_pat_3`, `cc_qty`, `cc_identification_mark`,`remarks`, `chk_spl`, `d_read1_1`, `d_read1_2`, `d_read1_3`, `d_read2_1`, `d_read2_2`, `d_read2_3`, `d_read3_1`, `d_read3_2`, `d_read3_3`, `avg_dia1`, `avg_dia2`, `avg_dia3`, `l_read1_1`, `l_read1_2`, `l_read1_3`, `l_read2_1`, `l_read2_2`, `l_read2_3`, `avg_len1`, `avg_len2`, `avg_len3`, `spl_load1`, `spl_load2`, `spl_load3`, `spl_str1`, `spl_str2`, `spl_avg1`, `spl_avg2`, `average`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','$top_grade','$top_casting_date','$top_days','$top_remark','$top_set','$top_no_of_cube','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$chk_com','$grade1','$caste_date1','$test_date1','$day1','$l1','$l2','$l3','$b1','$b2','$b3','$h1','$h2','$h3','$cross_1','$cross_2','$cross_3','$mass_1','$mass_2','$mass_3','$load_1','$load_2','$load_3','$comp_1','$comp_2','$comp_3','$avg_com_s_1','$fail_pat_1','$fail_pat_2','$fail_pat_3','$cc_qty','$cc_identification_mark','$remarks', '$chk_spl', '$d_read1_1', '$d_read1_2', '$d_read1_3', '$d_read2_1', '$d_read2_2', '$d_read2_3', '$d_read3_1', '$d_read3_2', '$d_read3_3', '$avg_dia1', '$avg_dia2', '$avg_dia3', '$l_read1_1', '$l_read1_2', '$l_read1_3', '$l_read2_1', '$l_read2_2', '$l_read2_3', '$avg_len1', '$avg_len2', '$avg_len3', '$spl_load1', '$spl_load2', '$spl_load3', '$spl_str1', '$spl_str2', '$spl_avg1', '$spl_avg2', '$average', '$amend_date')"; 
			
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
															<th style="text-align:center;"><label>Sr. No.</label></th>	
															<th style="text-align:center;"><label>Lab No.</label></th>	
															<th style="text-align:center;"><label>Job No.</label></th>	
															<th style="text-align:center;"><label>Casting Date</label></th>	
															<th style="text-align:center;"><label>Testing Date</label></th>	
															<th style="text-align:center;"><label>Days</label></th>	
															<th style="text-align:center;"><label>Grade</label></th>	
															<th style="text-align:center;"><label>Identification Mark</label></th>	
															<th style="text-align:center;"><label>Avg. Compressive Strength</label></th>	
														
																								

													</tr>
														<?php
													 $query = "select * from `con_cylinder` WHERE lab_no='$lab_no' and `is_deleted`='0' ORDER BY `id`";

														$result = mysqli_query($conn, $query);
									
														$cnt=0;
														$detail=0;
														if (mysqli_num_rows($result) > 0) {
													while($r = mysqli_fetch_array($result)){
																$cnt++;
																$detail+=2;
																if($r['is_deleted'] == 0){
																?>
																<tr>
																<td style="text-align:center;" width="10%">	
																
																<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
																<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="ccDelete('<?php echo $r['id']; ?>')"></a>
																	
																</td>
																<td style="text-align:center;"><?php echo $cnt;?></td>
																<td style="text-align:center;"><?php echo $r['job_no'];?></td>
																<td style="text-align:center;"><?php echo $r['lab_no'];?></td>					
																<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['caste_date1']));?></td>	
																<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($r['test_date1']));?></td>	
																<td style="text-align:center;"><?php echo $r['day1'];?></td>					
																<td style="text-align:center;"><?php echo $r['cc_grade'];?></td>					
																<td style="text-align:center;"><?php echo $r['cc_identification_mark'];?></td>					
																<td style="text-align:center;"><?php echo $r['avg_com_s_1'];?></td>								
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
			$t_caste_date1 = $_POST['caste_date1'];
			$t1=str_replace('/','-',$t_caste_date1);
			$caste_date1=date('Y-m-d',strtotime($t1));
			
			
			
			
			$t_test_date1 = $_POST['test_date1'];
			$s1=str_replace('/','-',$t_test_date1);
			$test_date1=date('Y-m-d',strtotime($s1));
			
			
			
			
			
			
			$day1 = $_POST['day1'];
			$remarks = $_POST['remarks'];
			
			
			$l1 = $_POST['l1'];
			$l2 = $_POST['l2'];
			$l3 = $_POST['l3'];
			
			$b1 = $_POST['b1'];
			$b2 = $_POST['b2'];
			$b3 = $_POST['b3'];
			
			$h1 = $_POST['h1'];
			$h2 = $_POST['h2'];
			$h3 = $_POST['h3'];
			
			
			$cross_1 = $_POST['cross_1'];
			$cross_2 = $_POST['cross_2'];
			$cross_3 = $_POST['cross_3'];
			
			$fail_pat_1 = $_POST['fail_pat_1'];
			$fail_pat_2 = $_POST['fail_pat_2'];
			$fail_pat_3 = $_POST['fail_pat_3'];
			
			$mass_1 = $_POST['mass_1'];
			$mass_2 = $_POST['mass_2'];
			$mass_3 = $_POST['mass_3'];
			
			$load_1 = $_POST['load_1'];
			$load_2 = $_POST['load_2'];
			$load_3 = $_POST['load_3'];
			
			$comp_1 = $_POST['comp_1'];
			$comp_2 = $_POST['comp_2'];
			$comp_3 = $_POST['comp_3'];
			
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
					
			$chk_com =  $_POST['chk_com'];	
			
			
			$top_c_date = $_POST['top_casting_date'];
			$tt=str_replace('/','-',$top_c_date);
			$top_casting_date=date('Y-m-d',strtotime($tt));
			
			$top_days = $_POST['top_days'];
			$top_grade = $_POST['top_grade'];
			$top_no_of_cube = $_POST['top_no_of_cube'];
			$top_remark = $_POST['top_remark'];
			$top_set = $_POST['top_set'];
			
			$avg_com_s_1 = $_POST['avg_com_s_1'];
			
			$cc_identification_marks = $_POST['cc_identification_mark'];
			$cc_identification_mark = str_replace("school","+",$cc_identification_marks);
		
			$grade1 = $_POST['grade1'];
			$cc_qty = $_POST['cc_qty'];
			
				
		
	  echo $update="update con_cylinder SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 
				 `chk_com`='$_POST[chk_com]',		 	 
				 `casting_date`='$top_casting_date',
				 `cc_day`='$_POST[top_days]',
				 `remarks`='$_POST[remarks]',
				 `cc_grade`='$_POST[top_grade]',
				 `cc_no_of_cube`='$_POST[top_no_of_cube]',				 
				 `day_remark`='$_POST[top_remark]',
				 `cc_set_of_cube`='$_POST[top_set]',				
				 `caste_date1`='$caste_date1',
				 `test_date1`='$test_date1',				 
				 `grade1`='$grade1',
				 `cc_identification_mark`='$cc_identification_mark',
				 `cc_qty`='$cc_qty',
				 `day1`='$day1',
				 `l1`='$l1',
				 `l2`='$l2',
				 `l3`='$l3',
				 `b1`='$b1',
				 `b2`='$b2',
				 `b3`='$b3',
				 `h1`='$h1',
				 `h2`='$h2',
				 `h3`='$h3',
				 `cross_1`='$cross_1',
				 `cross_2`='$cross_2',
				 `cross_3`='$cross_3',
				 `mass_1`='$mass_1',
				 `mass_2`='$mass_2',
				 `mass_3`='$mass_3',
				 `load_1`='$load_1',
				 `load_2`='$load_2',
				 `load_3`='$load_3',
				 `comp_1`='$comp_1',
				 `comp_2`='$comp_2',
				 `comp_3`='$comp_3',
				 `fail_pat_1`='$fail_pat_1',
				 `fail_pat_2`='$fail_pat_2',
				 `fail_pat_3`='$fail_pat_3',
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
				 `avg_com_s_1`='$_POST[avg_com_s_1]',
				 `amend_date`='$_POST[amend_date]'
				  WHERE `id`='$_POST[idEdit]'"; 

				  exit;

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update `con_cylinder` SET `is_deleted`='1' WHERE `id`='$_POST[id]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		$lab_no =$_POST['lab_no']; 		
		$qry = "select * from `con_cylinder` WHERE lab_no='$lab_no' and `is_deleted`='0'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		
		 
		
		$fill = array('total_row' => $rows1); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>