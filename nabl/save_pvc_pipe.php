<?php
error_reporting(0);
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from pvc_pipe WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'pvc_kg' => $result['pvc_kg'],																		
							'pvc_dia' => $result['pvc_dia'],																		
							'avg_class' => $result['avg_class'],																		
							'avg_dia' => $result['avg_dia'],																		
							'avg_color' => $result['avg_color'],																		
							'avg_thick' => $result['avg_thick'],																		
							'chk_out' => $result['chk_out'],																				
							'avg_out' => $result['avg_out'],							
							'chk_mea' => $result['chk_mea'],							
							'avg_mea' => $result['avg_mea'],							
							'chk_any' => $result['chk_any'],							
							'avg_any' => $result['avg_any'],							
							'chk_pre' => $result['chk_pre'],							
							'avg_pre' => $result['avg_pre']
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
			$pvc_kg=$_POST['pvc_kg'];		
			$pvc_dia=$_POST['pvc_dia'];		
			$avg_class=$_POST['avg_class'];		
			$avg_color=$_POST['avg_color'];		
			$avg_thick=$_POST['avg_thick'];		
			$avg_dia=$_POST['avg_dia'];	
					
			$chk_out =  $_POST['chk_out'];				
			$avg_out = $_POST['avg_out'];
			$chk_mea = $_POST['chk_mea'];
			$avg_mea = $_POST['avg_mea'];
			$chk_any = $_POST['chk_any'];
			$avg_any = $_POST['avg_any'];
			$chk_pre = $_POST['chk_pre'];
			$avg_pre = $_POST['avg_pre'];
			
			$curr_date=date("Y-m-d");
					
		  $insert="INSERT INTO `pvc_pipe`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `pvc_kg`, `pvc_dia`, `avg_class`, `avg_color`, `avg_thick`, `avg_dia`, `chk_out`, `avg_out`, `chk_mea`, `avg_mea`, `chk_any`, `avg_any`, `chk_pre`, `avg_pre`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$pvc_kg', '$pvc_dia', '$avg_class', '$avg_color', '$avg_thick', '$avg_dia', '$chk_out', '$avg_out', '$chk_mea', '$avg_mea', '$chk_any', '$avg_any', '$chk_pre', '$avg_pre')"; 
			
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
													 $query = "select * from `pvc_pipe` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
			
			
				
		
	  $update="update pvc_pipe SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 
					 `ulr`='$_POST[ulr]',		 	 				 
				 `pvc_kg`='$_POST[pvc_kg]',		 	 				 
				 `pvc_dia`='$_POST[pvc_dia]',		 	 				 
				 `avg_class`='$_POST[avg_class]',		 	 				 
				 `avg_color`='$_POST[avg_color]',		 	 				 
				 `avg_dia`='$_POST[avg_dia]',		 	 				 
				 `avg_thick`='$_POST[avg_thick]',		 	 				 
				 `chk_out`='$_POST[chk_out]',		 	 				 
				 `avg_out`='$_POST[avg_out]',		 	 				 
				 `chk_mea`='$_POST[chk_mea]',		 	 				 
				 `avg_mea`='$_POST[avg_mea]',		 	 				 
				 `chk_any`='$_POST[chk_any]',		 	 				 
				 `avg_any`='$_POST[avg_any]',		 	 				 
				 `chk_pre`='$_POST[chk_pre]',		 	 				 
				 `avg_pre`='$_POST[avg_pre]'
				  WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		
		 $delete="update pvc_pipe SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);		
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM pvc_pipe WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update pvc_pipe SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update pvc_pipe SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>