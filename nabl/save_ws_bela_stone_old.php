<?php
	session_start();
	include("connection.php");
	error_reporting(0);
	if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from ws_bela_stone WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
					'chk_tsg' => $result['chk_tsg'],
					'tsg1' => $result['tsg1'],
					'tsg2' => $result['tsg2'],
					'tsg3' => $result['tsg3'],
					'tsg4' => $result['tsg4'],
					'tsg5' => $result['tsg5'],
					'tsg6' => $result['tsg6'],
					'chk_asg' => $result['chk_asg'],
					'asg1' => $result['asg1'],
					'asg2' => $result['asg2'],
					'asg3' => $result['asg3'],
					'chk_wtr' => $result['chk_wtr'],
					'wtr1' => $result['wtr1'],
					'wtr2' => $result['wtr2'],
					'wtr3' => $result['wtr3'],
					'chk_com' => $result['chk_com'],
					'com1' => $result['com1'],
					'com2' => $result['com2'],
					'com3' => $result['com3'],
					'com4' => $result['com4'],
					'com5' => $result['com5'],
					'com6' => $result['com6'],
					'com7' => $result['com7'],
					'com8' => $result['com8'],
			);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];
			$ulr=$_POST['ulr'];
			
			$chk_tsg = $_POST['chk_tsg'];
			$tsg1 = $_POST['tsg1'];
			$tsg2 = $_POST['tsg2'];
			$tsg3 = $_POST['tsg3'];
			$tsg4 = $_POST['tsg4'];
			$tsg5 = $_POST['tsg5'];
			$tsg6 = $_POST['tsg6'];
			
			$chk_asg = $_POST['chk_asg'];
			$asg1 = $_POST['asg1'];
			$asg2 = $_POST['asg2'];
			$asg3 = $_POST['asg3'];
			
			$chk_wtr = $_POST['chk_wtr'];
			$wtr1 = $_POST['wtr1'];
			$wtr2 = $_POST['wtr2'];
			$wtr3 = $_POST['wtr3'];
			
			$chk_com = $_POST['chk_com'];
			$com1 = $_POST['com1'];
			$com2 = $_POST['com2'];
			$com3 = $_POST['com3'];
			$com4 = $_POST['com4'];
			$com5 = $_POST['com5'];
			$com6 = $_POST['com6'];
			$com7 = $_POST['com7'];
			$com8 = $_POST['com8'];

			$curr_date=date("Y-m-d");

			 $insert="INSERT INTO `ws_bela_stone`(`report_no`,`ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_tsg`, `tsg1`, `tsg2`, `tsg3`, `tsg4`, `tsg5`, `tsg6`, `chk_asg`, `asg1`, `asg2`, `asg3`, `chk_wtr`, `wtr1`, `wtr2`, `wtr3`, `chk_com`, `com1`, `com2`, `com3`, `com4`, `com5`, `com6`, `com7`, `com8`) VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_tsg', '$tsg1', '$tsg2', '$tsg3', '$tsg4', '$tsg5', '$tsg6', '$chk_asg', '$asg1', '$asg2', '$asg3', '$chk_wtr', '$wtr1', '$wtr2', '$wtr3', '$chk_com', '$com1', '$com2', '$com3', '$com4', '$com5', '$com6', '$com7', '$com8')";
			
		
				
			
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
													 $query = "select * from ws_bela_stone WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
																	//}
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
		
		
		$curr_date=date("Y-m-d");
		
		
		$update= "update `ws_bela_stone` SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
		`ulr`='$_POST[ulr]',
		`chk_tsg`='$_POST[chk_tsg]',
		`tsg1`='$_POST[tsg1]',
		`tsg2`='$_POST[tsg2]',
		`tsg3`='$_POST[tsg3]',
		`tsg4`='$_POST[tsg4]',
		`tsg5`='$_POST[tsg5]',
		`tsg6`='$_POST[tsg6]',
		`chk_asg`='$_POST[chk_asg]',
		`asg1`='$_POST[asg1]',
		`asg2`='$_POST[asg2]',
		`asg3`='$_POST[asg3]',
		`chk_wtr`='$_POST[chk_wtr]',
		`wtr1`='$_POST[wtr1]',
		`wtr2`='$_POST[wtr2]',
		`wtr3`='$_POST[wtr3]',
		`chk_com`='$_POST[chk_com]',
		`com1`='$_POST[com1]',
		`com2`='$_POST[com2]',
		`com3`='$_POST[com3]',
		`com4`='$_POST[com4]',
		`com5`='$_POST[com5]',
		`com6`='$_POST[com6]',
		`com7`='$_POST[com7]',
		`com8`='$_POST[com8]',
		`checked_by`=NULL WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update ws_bela_stone SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM ws_bela_stone WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update ws_bela_stone SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$cc);	
				}
				else
				{
					$cc="update ws_bela_stone SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>