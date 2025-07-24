<?php
error_reporting(0);
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from np2_pipe WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'np_dia' => $result['np_dia'],																		
							'chk_dia' => $result['chk_dia'],
							'avg_dia' => $result['avg_dia'],
							'chk_col' => $result['chk_col'],
							'col1' => $result['col1'],
							'col2' => $result['col2'],
							'col3' => $result['col3'],
							'chk_thk' => $result['chk_thk'],
							'avg_thk' => $result['avg_thk'],
							'chk_ini' => $result['chk_ini'],
							'ini1' => $result['ini1'],
							'ini2' => $result['ini2'],
							'chk_str' => $result['chk_str'],
							'avg_str' => $result['avg_str']
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
			$np_dia=$_POST['np_dia'];		
					
			$chk_dia = $_POST['chk_dia'];
			$avg_dia = $_POST['avg_dia'];
			$chk_col = $_POST['chk_col'];
			$col1 = $_POST['col1'];
			$col2 = $_POST['col2'];
			$col3 = $_POST['col3'];
			$chk_thk = $_POST['chk_thk'];
			$avg_thk = $_POST['avg_thk'];
			$chk_ini = $_POST['chk_ini'];
			$ini1 = $_POST['ini1'];
			$ini2 = $_POST['ini2'];
			$chk_str = $_POST['chk_str'];
			$avg_str = $_POST['avg_str'];
			
									
			
			$curr_date=date("Y-m-d");
					
		  $insert="INSERT INTO `np2_pipe`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `np_dia`, `chk_dia`, `avg_dia`, `chk_col`, `col1`, `col2`, `col3`, `chk_thk`, `avg_thk`, `chk_ini`, `ini1`, `ini2`, `chk_str`, `avg_str`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$np_dia',  '$chk_dia', '$avg_dia', '$chk_col', '$col1', '$col2', '$col3', '$chk_thk', '$avg_thk', '$chk_ini', '$ini1', '$ini2', '$chk_str', '$avg_str')"; 
			
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
													 $query = "select * from `np2_pipe` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
			
			
				
		
	  $update="update np2_pipe SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 
				 `ulr`='$_POST[ulr]',		 	 				 
				 `np_dia`='$_POST[np_dia]',		 	 				 
				 `chk_dia` = '$_POST[chk_dia]',
				`avg_dia` = '$_POST[avg_dia]',
				`chk_col` = '$_POST[chk_col]',
				`col1` = '$_POST[col1]',
				`col2` = '$_POST[col2]',
				`col3` = '$_POST[col3]',
				`chk_thk` = '$_POST[chk_thk]',
				`avg_thk` = '$_POST[avg_thk]',
				`chk_ini` = '$_POST[chk_ini]',
				`ini1` = '$_POST[ini1]',
				`ini2` = '$_POST[ini2]',
				`chk_str` = '$_POST[chk_str]',
				`avg_str` = '$_POST[avg_str]'				 
				  WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		
		 $delete="update np2_pipe SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);		
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM np2_pipe WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update np2_pipe SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update np2_pipe SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>