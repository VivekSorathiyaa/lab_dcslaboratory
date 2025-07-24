<?php

session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from rebound_hammer WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'chk_rha' => $result['chk_rha'],
							'rh_location' => $result['rh_location'],
							'rh_cast_date' => $result['rh_cast_date'],
							'rh_r1' => $result['rh_r1'],
							'rh_r2' => $result['rh_r2'],
							'rh_r3' => $result['rh_r3'],
							'rh_r4' => $result['rh_r4'],
							'rh_r5' => $result['rh_r5'],
							'rh_r6' => $result['rh_r6'],
							'rh_r7' => $result['rh_r7'],
							'rh_r8' => $result['rh_r8'],
							'rh_r9' => $result['rh_r9'],
							'rh_r10' => $result['rh_r10'],
							'avg_r_num' => $result['avg_r_num'],
							'std_dev' => $result['std_dev'],
							'rh_max' => $result['rh_max'],
							'rh_min' => $result['rh_min'],
							'rh_range' => $result['rh_range'],
							'rh_rs' => $result['rh_rs'],
							'rh_level' => $result['rh_level'],
							'rh_out' => $result['rh_out'],
							'rh_relation' => $result['rh_relation'],
							'rh_verticle' => $result['rh_verticle'],
							'rh_age' => $result['rh_age'],
							'rh_rcc' => $result['rh_rcc'],
							'temp' => $result['temp'],
							'grade1' => $result['grade1'],
							'rh_direction' => $result['rh_direction']
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
			$grade1=$_POST['grade1'];		
					
			$temp =  $_POST['temp'];	
			$chk_rha =  $_POST['chk_rha'];	
			$rh_location =  $_POST['rh_location'];	
			$rh_cast_date =  $_POST['rh_cast_date'];	
			$rh_r1 =  $_POST['rh_r1'];	
			$rh_r2 =  $_POST['rh_r2'];	
			$rh_r3 =  $_POST['rh_r3'];	
			$rh_r4 =  $_POST['rh_r4'];	
			$rh_r5 =  $_POST['rh_r5'];	
			$rh_r6 =  $_POST['rh_r6'];	
			$rh_r7 =  $_POST['rh_r7'];	
			$rh_r8 =  $_POST['rh_r8'];	
			$rh_r9 =  $_POST['rh_r9'];	
			$rh_r10 =  $_POST['rh_r10'];	
			$avg_r_num =  $_POST['avg_r_num'];	
			$std_dev =  $_POST['std_dev'];	
			$rh_max =  $_POST['rh_max'];	
			$rh_min =  $_POST['rh_min'];	
			$rh_range =  $_POST['rh_range'];	
			$rh_rs =  $_POST['rh_rs'];	
			$rh_level =  $_POST['rh_level'];	
			$rh_out =  $_POST['rh_out'];	
			$rh_relation =  $_POST['rh_relation'];	
			$rh_verticle =  $_POST['rh_verticle'];	
			$rh_age =  $_POST['rh_age'];	
			$rh_rcc =  $_POST['rh_rcc'];	
			$rh_direction =  $_POST['rh_direction'];	
			
		   $curr_date=date("Y-m-d");
			

					
		 $insert="INSERT INTO `rebound_hammer` (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`,  `checked_by`,  `chk_rha`, `rh_location`, `rh_cast_date`, `rh_r1`, `rh_r2`, `rh_r3`, `rh_r4`, `rh_r5`, `rh_r6`, `rh_r7`, `rh_r8`, `rh_r9`, `rh_r10`, `avg_r_num`, `std_dev`, `rh_max`, `rh_min`, `rh_range`, `rh_rs`, `rh_level`, `rh_out`, `rh_relation`, `rh_verticle`, `rh_age`, `rh_rcc`, `rh_direction`, `temp`, `grade1`) values(
				'$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','',
				'$chk_rha', '$rh_location', '$rh_cast_date', '$rh_r1', '$rh_r2', '$rh_r3', '$rh_r4', '$rh_r5', '$rh_r6', '$rh_r7', '$rh_r8', '$rh_r9', '$rh_r10', '$avg_r_num', '$std_dev', '$rh_max', '$rh_min', '$rh_range', '$rh_rs', '$rh_level', '$rh_out', '$rh_relation', '$rh_verticle', '$rh_age', '$rh_rcc', '$rh_direction', '$temp', '$grade1')"; 
			
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
													</tr>
														<?php
													 $query = "select * from `rebound_hammer` WHERE lab_no='$lab_no' and `is_deleted`='0' ORDER BY `id`";

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
																		
																	</td>
																	<td style="text-align:center;"><?php echo $cnt;?></td>
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
				
		
	  $update="update rebound_hammer SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]', `chk_rha`='$_POST[chk_rha]', `rh_location`='$_POST[rh_location]', `rh_cast_date`='$_POST[rh_cast_date]',
			 `rh_r1`='$_POST[rh_r1]',
			 `rh_r2`='$_POST[rh_r2]',
			 `rh_r3`='$_POST[rh_r3]',
			 `rh_r4`='$_POST[rh_r4]',
			 `rh_r5`='$_POST[rh_r5]',
			 `rh_r6`='$_POST[rh_r6]',
			 `rh_r7`='$_POST[rh_r7]',
			 `rh_r8`='$_POST[rh_r8]',
			 `rh_r9`='$_POST[rh_r9]',
			 `rh_r10`='$_POST[rh_r10]',
			 `avg_r_num`='$_POST[avg_r_num]',
			 `grade1`='$_POST[grade1]',
			 `std_dev`='$_POST[std_dev]',
			 `rh_max`='$_POST[rh_max]',
			 `rh_min`='$_POST[rh_min]',
			 `rh_range`='$_POST[rh_range]',
			 `rh_rs`='$_POST[rh_rs]',
			 `rh_level`='$_POST[rh_level]',
			 `rh_out`='$_POST[rh_out]',
			 `rh_relation`='$_POST[rh_relation]',
			 `rh_verticle`='$_POST[rh_verticle]',
			 `rh_age`='$_POST[rh_age]',
			 `rh_rcc`='$_POST[rh_rcc]',
			 `temp`='$_POST[temp]',
			 `rh_direction`='$_POST[rh_direction]',`checked_by`=NULL WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		$delete="update `rebound_hammer` SET `is_deleted`='1' WHERE `lab_no`='$_POST[lab_no]' AND `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		$lab_no =$_POST['lab_no']; 		
		$qry = "select * from `rebound_hammer` WHERE lab_no='$lab_no' and `is_deleted`='0'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		
		 
		
		$fill = array('total_row' => $rows1); 
		echo json_encode($fill);	
		
    }
	
	if($_POST['action_type'] == 'set_sample_qty'){
		$trf_no = $_POST['trf_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$rebound_qty = $_POST['rebound_qty'];
		
		  $upd_final="update span_material_assign SET `rebound_qty`='$rebound_qty' WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no'";
		
		if(mysqli_query($conn,$upd_final)){
		 	$fill = array('status' => 'success'); 
		}else{
			$fill = array('status' => 'failed'); 
		} 
		echo json_encode($fill);
    }
	
    exit;
	
}
?>