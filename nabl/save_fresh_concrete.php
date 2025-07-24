<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from fresh_concrete WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'grade_fresh' => $result['grade_fresh'],
							'slump_req' => $result['slump_req'],
							'mix_temp' => $result['mix_temp'],
							'w_con' => $result['w_con'],
							'chk_slu' => $result['chk_slu'],
							'mix_a1' => $result['mix_a1'],
							'mix_a2' => $result['mix_a2'],
							'mix_a3' => $result['mix_a3'],
							'mix_a4' => $result['mix_a4'],
							'mix_a5' => $result['mix_a5'],
							'mix_a6' => $result['mix_a6'],
							'mix_a7' => $result['mix_a7'],
							'mix_a8' => $result['mix_a8'],
							'mix_b1' => $result['mix_b1'],
							'mix_b2' => $result['mix_b2'],
							'mix_b3' => $result['mix_b3'],
							'mix_b4' => $result['mix_b4'],
							'mix_b5' => $result['mix_b5'],
							'mix_b6' => $result['mix_b6'],
							'mix_b7' => $result['mix_b7'],
							'mix_b8' => $result['mix_b8'],
							'mix_ratio' => $result['mix_ratio'],
							'mix_wtr' => $result['mix_wtr'],
							'slump1' => $result['slump1'],
							'slump2' => $result['slump2'],
							'slump3' => $result['slump3'],
							'slump4' => $result['slump4'],
							'slump5' => $result['slump5'],
							'den1' => $result['den1'],
							'den2' => $result['den2'],
							'den3' => $result['den3'],
							'den4' => $result['den4'],
							'den5' => $result['den5'],
							'bd_1' => $result['bd_1'],
							'flow' => $result['flow'],
							'ac_1' => $result['ac_1'],
							'fr_1_1_1' => $result['fr_1_1_1'],
							'fr_1_1_2' => $result['fr_1_1_2'],
							'fr_1_1_3' => $result['fr_1_1_3'],
							'fr_1_1_4' => $result['fr_1_1_4'],
							'fr_1_1_5' => $result['fr_1_1_5'],
							'fr_1_1_6' => $result['fr_1_1_6'],
							'dry1' => $result['dry1'],
							'dry2' => $result['dry2'],
							'dry3' => $result['dry3'],
							'dry4' => $result['dry4'],
							'dry5' => $result['dry5'],
							'dry6' => $result['dry6'],
							'avg_dry' => $result['avg_dry'],
							'two1' => $result['two1'],
							'two2' => $result['two2'],
							'two3' => $result['two3'],
							'fr_1_2_1' => $result['fr_1_2_1'],
							'fr_1_2_2' => $result['fr_1_2_2'],
							'fr_1_2_3' => $result['fr_1_2_3'],
							'fr_1_2_4' => $result['fr_1_2_4'],
							'fr_1_2_5' => $result['fr_1_2_5'],
							'fr_1_2_6' => $result['fr_1_2_6'],
							'fr_2_1_1' => $result['fr_2_1_1'],
							'fr_2_1_2' => $result['fr_2_1_2'],
							'fr_2_1_3' => $result['fr_2_1_3'],
							'fr_2_1_4' => $result['fr_2_1_4'],
							'fr_2_1_5' => $result['fr_2_1_5'],
							'fr_2_1_6' => $result['fr_2_1_6'],
							'fr_2_2_1' => $result['fr_2_2_1'],
							'fr_2_2_2' => $result['fr_2_2_2'],
							'fr_2_2_3' => $result['fr_2_2_3'],
							'fr_2_2_4' => $result['fr_2_2_4'],
							'fr_2_2_5' => $result['fr_2_2_5'],
							'fr_2_2_6' => $result['fr_2_2_6'],
							'fr_3_1_1' => $result['fr_3_1_1'],
							'fr_3_1_2' => $result['fr_3_1_2'],
							'fr_3_1_3' => $result['fr_3_1_3'],
							'fr_3_1_4' => $result['fr_3_1_4'],
							'fr_3_1_5' => $result['fr_3_1_5'],
							'fr_3_1_6' => $result['fr_3_1_6'],
							'fr_3_2_1' => $result['fr_3_2_1'],
							'fr_3_2_2' => $result['fr_3_2_2'],
							'fr_3_2_3' => $result['fr_3_2_3'],
							'fr_3_2_4' => $result['fr_3_2_4'],
							'fr_3_2_5' => $result['fr_3_2_5'],
							'fr_3_2_6' => $result['fr_3_2_6']
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
			
			$grade_fresh = $_POST['grade_fresh'];
			$slump_req = $_POST['slump_req'];
			$mix_temp = $_POST['mix_temp'];
			$w_con = $_POST['w_con'];
			$chk_slu = $_POST['chk_slu'];
			$mix_a1 = $_POST['mix_a1'];
			$mix_a2 = $_POST['mix_a2'];
			$mix_a3 = $_POST['mix_a3'];
			$mix_a4 = $_POST['mix_a4'];
			$mix_a5 = $_POST['mix_a5'];
			$mix_a6 = $_POST['mix_a6'];
			$mix_a7 = $_POST['mix_a7'];
			$mix_a8 = $_POST['mix_a8'];
			$mix_b1 = $_POST['mix_b1'];
			$mix_b2 = $_POST['mix_b2'];
			$mix_b3 = $_POST['mix_b3'];
			$mix_b4 = $_POST['mix_b4'];
			$mix_b5 = $_POST['mix_b5'];
			$mix_b6 = $_POST['mix_b6'];
			$mix_b7 = $_POST['mix_b7'];
			$mix_b8 = $_POST['mix_b8'];
			$mix_ratio = $_POST['mix_ratio'];
			$mix_wtr = $_POST['mix_wtr'];
			$slump1 = $_POST['slump1'];
			$slump2 = $_POST['slump2'];
			$slump3 = $_POST['slump3'];
			$slump4 = $_POST['slump4'];
			$slump5 = $_POST['slump5'];
			$den1 = $_POST['den1'];
			$den2 = $_POST['den2'];
			$den3 = $_POST['den3'];
			$den4 = $_POST['den4'];
			$den5 = $_POST['den5'];
			$bd_1 = $_POST['bd_1'];
			$flow = $_POST['flow'];
			$ac_1 = $_POST['ac_1'];
			
			$fr_1_1_1 = $_POST['fr_1_1_1'];
			$fr_1_1_2 = $_POST['fr_1_1_2'];
			$fr_1_1_3 = $_POST['fr_1_1_3'];
			$fr_1_1_4 = $_POST['fr_1_1_4'];
			$fr_1_1_5 = $_POST['fr_1_1_5'];
			$fr_1_1_6 = $_POST['fr_1_1_6'];
			$fr_1_2_1 = $_POST['fr_1_2_1'];
			$fr_1_2_2 = $_POST['fr_1_2_2'];
			$fr_1_2_3 = $_POST['fr_1_2_3'];
			$fr_1_2_4 = $_POST['fr_1_2_4'];
			$fr_1_2_5 = $_POST['fr_1_2_5'];
			$fr_1_2_6 = $_POST['fr_1_2_6'];
			$fr_2_1_1 = $_POST['fr_2_1_1'];
			$fr_2_1_2 = $_POST['fr_2_1_2'];
			$fr_2_1_3 = $_POST['fr_2_1_3'];
			$fr_2_1_4 = $_POST['fr_2_1_4'];
			$fr_2_1_5 = $_POST['fr_2_1_5'];
			$fr_2_1_6 = $_POST['fr_2_1_6'];
			$fr_2_2_1 = $_POST['fr_2_2_1'];
			$fr_2_2_2 = $_POST['fr_2_2_2'];
			$fr_2_2_3 = $_POST['fr_2_2_3'];
			$fr_2_2_4 = $_POST['fr_2_2_4'];
			$fr_2_2_5 = $_POST['fr_2_2_5'];
			$fr_2_2_6 = $_POST['fr_2_2_6'];
			$fr_3_1_1 = $_POST['fr_3_1_1'];
			$fr_3_1_2 = $_POST['fr_3_1_2'];
			$fr_3_1_3 = $_POST['fr_3_1_3'];
			$fr_3_1_4 = $_POST['fr_3_1_4'];
			$fr_3_1_5 = $_POST['fr_3_1_5'];
			$fr_3_1_6 = $_POST['fr_3_1_6'];
			$fr_3_2_1 = $_POST['fr_3_2_1'];
			$fr_3_2_2 = $_POST['fr_3_2_2'];
			$fr_3_2_3 = $_POST['fr_3_2_3'];
			$fr_3_2_4 = $_POST['fr_3_2_4'];
			$fr_3_2_5 = $_POST['fr_3_2_5'];
			$fr_3_2_6 = $_POST['fr_3_2_6'];
			$dry1 = $_POST['dry1'];
			$dry2 = $_POST['dry2'];
			$dry3 = $_POST['dry3'];
			$dry4 = $_POST['dry4'];
			$dry5 = $_POST['dry5'];
			$dry6 = $_POST['dry6'];
			$avg_dry = $_POST['avg_dry'];
			$two1 = $_POST['two1'];
			$two2 = $_POST['two2'];
			$two3 = $_POST['two3'];
			
			$curr_date=date("Y-m-d");
			
			
			
		    $insert="INSERT INTO `fresh_concrete`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `grade_fresh`, `slump_req`, `mix_temp`, `w_con`, `chk_slu`, `mix_a1`, `mix_a2`, `mix_a3`, `mix_a4`, `mix_a5`, `mix_a6`, `mix_a7`, `mix_a8`, `mix_b1`, `mix_b2`, `mix_b3`, `mix_b4`, `mix_b5`, `mix_b6`, `mix_b7`, `mix_b8`, `mix_ratio`, `mix_wtr`, `slump1`, `slump2`, `slump3`, `slump4`, `slump5`, `den1`, `den2`, `den3`, `den4`, `den5`, `bd_1`, `flow`, `ac_1`, `fr_1_1_1`, `fr_1_1_2`, `fr_1_1_3`, `fr_1_1_4`, `fr_1_1_5`, `fr_1_1_6`, `fr_1_2_1`, `fr_1_2_2`, `fr_1_2_3`, `fr_1_2_4`, `fr_1_2_5`, `fr_1_2_6`, `fr_2_1_1`, `fr_2_1_2`, `fr_2_1_3`, `fr_2_1_4`, `fr_2_1_5`, `fr_2_1_6`, `fr_2_2_1`, `fr_2_2_2`, `fr_2_2_3`, `fr_2_2_4`, `fr_2_2_5`, `fr_2_2_6`, `fr_3_1_1`, `fr_3_1_2`, `fr_3_1_3`, `fr_3_1_4`, `fr_3_1_5`, `fr_3_1_6`, `fr_3_2_1`, `fr_3_2_2`, `fr_3_2_3`, `fr_3_2_4`, `fr_3_2_5`, `fr_3_2_6`, `dry1`, `dry2`, `dry3`, `dry4`, `dry5`, `dry6`, `avg_dry`, `two1`, `two2`, `two3`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$grade_fresh', '$slump_req', '$mix_temp', '$w_con', '$chk_slu', '$mix_a1', '$mix_a2', '$mix_a3', '$mix_a4', '$mix_a5', '$mix_a6', '$mix_a7', '$mix_a8', '$mix_b1', '$mix_b2', '$mix_b3', '$mix_b4', '$mix_b5', '$mix_b6', '$mix_b7', '$mix_b8', '$mix_ratio', '$mix_wtr', '$slump1', '$slump2', '$slump3', '$slump4', '$slump5', '$den1', '$den2', '$den3', '$den4', '$den5', '$bd_1', '$flow', '$ac_1', '$fr_1_1_1', '$fr_1_1_2', '$fr_1_1_3', '$fr_1_1_4', '$fr_1_1_5', '$fr_1_1_6', '$fr_1_2_1', '$fr_1_2_2', '$fr_1_2_3', '$fr_1_2_4', '$fr_1_2_5', '$fr_1_2_6', '$fr_2_1_1', '$fr_2_1_2', '$fr_2_1_3', '$fr_2_1_4', '$fr_2_1_5', '$fr_2_1_6', '$fr_2_2_1', '$fr_2_2_2', '$fr_2_2_3', '$fr_2_2_4', '$fr_2_2_5', '$fr_2_2_6', '$fr_3_1_1', '$fr_3_1_2', '$fr_3_1_3', '$fr_3_1_4', '$fr_3_1_5', '$fr_3_1_6', '$fr_3_2_1', '$fr_3_2_2', '$fr_3_2_3', '$fr_3_2_4', '$fr_3_2_5', '$fr_3_2_6', '$dry1', '$dry2', '$dry3', '$dry4', '$dry5', '$dry6', '$avg_dry', '$two1', '$two2', '$two3', '$amend_date')"; 

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
														<th style="text-align:center;"><label>Report No.</label></th>	
														<th style="text-align:center;"><label>Job No.</label></th>	
														<th style="text-align:center;"><label>Lab No.</label></th>	
														
																								

													</tr>
														<?php
													 $query = "select * from `fresh_concrete` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
																<td style="text-align:center;"><?php echo $r['report_no'];?></td>
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
	else if($_POST['action_type'] == 'edit')
	{
		
		
		$curr_date=date("Y-m-d");
		
				
		
	  $update="update fresh_concrete SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,	
					`grade_fresh` = '$_POST[grade_fresh]',
					`slump_req` = '$_POST[slump_req]',
					`mix_temp` = '$_POST[mix_temp]',
					`w_con` = '$_POST[w_con]',
					`chk_slu` = '$_POST[chk_slu]',
					`mix_a1` = '$_POST[mix_a1]',
					`mix_a2` = '$_POST[mix_a2]',
					`mix_a3` = '$_POST[mix_a3]',
					`mix_a4` = '$_POST[mix_a4]',
					`mix_a5` = '$_POST[mix_a5]',
					`mix_a6` = '$_POST[mix_a6]',
					`mix_a7` = '$_POST[mix_a7]',
					`mix_a8` = '$_POST[mix_a8]',
					`mix_b1` = '$_POST[mix_b1]',
					`mix_b2` = '$_POST[mix_b2]',
					`mix_b3` = '$_POST[mix_b3]',
					`mix_b4` = '$_POST[mix_b4]',
					`mix_b5` = '$_POST[mix_b5]',
					`mix_b6` = '$_POST[mix_b6]',
					`mix_b7` = '$_POST[mix_b7]',
					`mix_b8` = '$_POST[mix_b8]',
					`mix_ratio` = '$_POST[mix_ratio]',
					`mix_wtr` = '$_POST[mix_wtr]',
					`slump1` = '$_POST[slump1]',
					`slump2` = '$_POST[slump2]',
					`slump3` = '$_POST[slump3]',
					`slump4` = '$_POST[slump4]',
					`slump5` = '$_POST[slump5]',
					`den1` = '$_POST[den1]',
					`den2` = '$_POST[den2]',
					`den3` = '$_POST[den3]',
					`den4` = '$_POST[den4]',
					`den5` = '$_POST[den5]',
					`bd_1` = '$_POST[bd_1]',
					`flow` = '$_POST[flow]',
					`ac_1` = '$_POST[ac_1]',
					`fr_1_1_1` = '$_POST[fr_1_1_1]',
					`fr_1_1_2` = '$_POST[fr_1_1_2]',
					`fr_1_1_3` = '$_POST[fr_1_1_3]',
					`fr_1_1_4` = '$_POST[fr_1_1_4]',
					`fr_1_1_5` = '$_POST[fr_1_1_5]',
					`fr_1_1_6` = '$_POST[fr_1_1_6]',
					`fr_1_2_1` = '$_POST[fr_1_2_1]',
					`fr_1_2_2` = '$_POST[fr_1_2_2]',
					`fr_1_2_3` = '$_POST[fr_1_2_3]',
					`fr_1_2_4` = '$_POST[fr_1_2_4]',
					`fr_1_2_5` = '$_POST[fr_1_2_5]',
					`fr_1_2_6` = '$_POST[fr_1_2_6]',
					`fr_2_1_1` = '$_POST[fr_2_1_1]',
					`fr_2_1_2` = '$_POST[fr_2_1_2]',
					`fr_2_1_3` = '$_POST[fr_2_1_3]',
					`fr_2_1_4` = '$_POST[fr_2_1_4]',
					`fr_2_1_5` = '$_POST[fr_2_1_5]',
					`fr_2_1_6` = '$_POST[fr_2_1_6]',
					`fr_2_2_1` = '$_POST[fr_2_2_1]',
					`fr_2_2_2` = '$_POST[fr_2_2_2]',
					`fr_2_2_3` = '$_POST[fr_2_2_3]',
					`fr_2_2_4` = '$_POST[fr_2_2_4]',
					`fr_2_2_5` = '$_POST[fr_2_2_5]',
					`fr_2_2_6` = '$_POST[fr_2_2_6]',
					`fr_3_1_1` = '$_POST[fr_3_1_1]',
					`fr_3_1_2` = '$_POST[fr_3_1_2]',
					`fr_3_1_3` = '$_POST[fr_3_1_3]',
					`fr_3_1_4` = '$_POST[fr_3_1_4]',
					`fr_3_1_5` = '$_POST[fr_3_1_5]',
					`fr_3_1_6` = '$_POST[fr_3_1_6]',
					`fr_3_2_1` = '$_POST[fr_3_2_1]',
					`fr_3_2_2` = '$_POST[fr_3_2_2]',
					`fr_3_2_3` = '$_POST[fr_3_2_3]',
					`fr_3_2_4` = '$_POST[fr_3_2_4]',
					`fr_3_2_5` = '$_POST[fr_3_2_5]',
					`fr_3_2_6` = '$_POST[fr_3_2_6]',
					`dry1` = '$_POST[dry1]',
					`dry2` = '$_POST[dry2]',
					`dry3` = '$_POST[dry3]',
					`dry4` = '$_POST[dry4]',
					`dry5` = '$_POST[dry5]',
					`dry6` = '$_POST[dry6]',
					`avg_dry` = '$_POST[avg_dry]',
					`two1` = '$_POST[two1]',
					`two2` = '$_POST[two2]',
					`two3` = '$_POST[two3]',
					`amend_date` = '$_POST[amend_date]'					
				  WHERE `id`='$_POST[idEdit]'";

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete')
	{
		
		 $delete="update fresh_concrete SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk')
	{
		
		$qry = "SELECT * FROM fresh_concrete WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update fresh_concrete SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update fresh_concrete SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>