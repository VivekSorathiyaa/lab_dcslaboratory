<?php

session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from flexure_beam WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'chk_com' => $result['chk_com'],
							'top_casting_date' => date('d/m/Y', strtotime($result['casting_date'])),				
							'top_days' => $result['cc_day'],
							'top_grade' => $result['cc_grade'],							
							'top_no_of_cube' => $result['cc_no_of_cube'],							
							'top_remark' => $result['day_remark'],							
							'top_set' => $result['cc_set_of_cube'],									
							'grade1' => $result['grade1'],							
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
							'wat_temp' => $result['wat_temp'],							
							'mark_1' => $result['mark_1'],							
							'mark_2' => $result['mark_2'],							
							'mark_3' => $result['mark_3'],							
							'load_1' => $result['load_1'],							
							'load_2' => $result['load_2'],							
							'load_3' => $result['load_3'],							
							'comp_1' => $result['comp_1'],							
							'comp_2' => $result['comp_2'],							
							'comp_3' => $result['comp_3'],							
							'avg_com_s_1' => $result['avg_com_s_1'],
							'remarks' => $result['remarks'],
							'f_size' => $result['f_size'],
							'f_con' => $result['f_con'],
							'amend_date' => $result['amend_date']
							
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
					
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
			
			$wat_temp = $_POST['wat_temp'];
			$mark_1 = $_POST['mark_1'];
			$mark_2 = $_POST['mark_2'];
			$mark_3 = $_POST['mark_3'];
			
			
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
			$remarks = $_POST['remarks'];
			$f_con = $_POST['f_con'];
			$f_size = $_POST['f_size'];
			$amend_date = $_POST['amend_date'];
			
																
			
			$curr_date=date("Y-m-d");
			




					
		 $insert="INSERT INTO `flexure_beam`( `report_no`, `ulr`, `job_no`, `lab_no`, `cc_grade`, `casting_date`, `cc_day`, `day_remark`, `cc_set_of_cube`, `cc_no_of_cube`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_com`, `grade1`, `caste_date1`, `test_date1`, `day1`, `l1`, `l2`, `l3`, `b1`, `b2`, `b3`, `h1`, `h2`, `h3`, `cross_1`, `cross_2`, `cross_3`, `mass_1`, `mass_2`, `mass_3`, `load_1`, `load_2`, `load_3`, `comp_1`, `comp_2`, `comp_3`, `avg_com_s_1`, `remarks`, `f_size`, `f_con`, `wat_temp`, `mark_1`, `mark_2`, `mark_3`,`amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','$top_grade','$top_casting_date','$top_days','$top_remark','$top_set','$top_no_of_cube','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$chk_com','$grade1','$caste_date1','$test_date1','$day1','$l1','$l2','$l3','$b1','$b2','$b3','$h1','$h2','$h3','$cross_1','$cross_2','$cross_3','$mass_1','$mass_2','$mass_3','$load_1','$load_2','$load_3','$comp_1','$comp_2','$comp_3','$avg_com_s_1','$remarks','$f_size','$f_con','$wat_temp','$mark_1','$mark_2','$mark_3','$amend_date')"; 
			
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
													 $query = "select * from `flexure_beam` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
																
																<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
																	
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
			
			$wat_temp = $_POST['wat_temp'];
			$mark_1 = $_POST['mark_1'];
			$mark_2 = $_POST['mark_2'];
			$mark_3 = $_POST['mark_3'];
			
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
			
			$grade1 = $_POST['grade1'];
			
				
		
	  $update="update flexure_beam SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 
				 `chk_com`='$_POST[chk_com]',		 	 
				 `casting_date`='$top_casting_date',
				 `cc_day`='$_POST[top_days]',
				 `cc_grade`='$_POST[top_grade]',
				 `cc_no_of_cube`='$_POST[top_no_of_cube]',				 
				 `day_remark`='$_POST[top_remark]',
				 `cc_set_of_cube`='$_POST[top_set]',				
				 `caste_date1`='$caste_date1',
				 `test_date1`='$test_date1',				 
				 `grade1`='$grade1',
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
				 `wat_temp`='$wat_temp',
				 `mark_1`='$mark_1',
				 `mark_2`='$mark_2',
				 `mark_3`='$mark_3',
				 `avg_com_s_1`='$_POST[avg_com_s_1]',
				 `f_size`='$_POST[f_size]',
				 `f_con`='$_POST[f_con]',
				 `remarks`='$_POST[remarks]',
				 `amend_date`='$_POST[amend_date]'
				  WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update `flexure_beam` SET `is_deleted`='1' WHERE `id`='$_POST[id]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM flexure_beam WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update flexure_beam SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update flexure_beam SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
	elseif($_POST['action_type'] == 'get_data'){
		$set_type_sample ="";
			if($_POST['dt']=="500,100,100")
			{
				$set_type_sample ='<select class="form-control f_con" id="f_con" name="f_con">
				<option value="a_133">a&gt;133</option><option value="133_a">a&lt;133</option></select>';
			}
			else
			{
				$set_type_sample ='
				<select class="form-control f_con" id="f_con" name="f_con">
				<option value="a_200">a&gt;200</option><option value="200_a">a&lt;200</option>
				</select>';
			}
				
													
								
		 
		
		$fill = array('set_type_sample' => $set_type_sample);	
        echo json_encode($fill);
		
    }
    exit;
	
}
?>