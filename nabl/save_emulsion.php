<?php 
	session_start();
	include("connection.php");
	error_reporting(0);
	if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from emulsion WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
					'chk_kin' => $result['chk_kin'],
					'chk_sol' => $result['chk_sol'],
					'chk_duc' => $result['chk_duc'],
					'chk_rec' => $result['chk_rec'],
					'chk_pen' => $result['chk_pen'],
					'chk_mwa' => $result['chk_mwa'],
					'chk_par' => $result['chk_par'],
					'chk_mic' => $result['chk_mic'],
					'ems1' => $result['ems1'],
					'ems2' => $result['ems2'],
					'ems3' => $result['ems3'],
					'ems4' => $result['ems4'],
					'ems5' => $result['ems5'],
					'ems6' => $result['ems6'],
					'ems7' => $result['ems7'],
					'ems8' => $result['ems8'],
					'ems9' => $result['ems9'],
					'ems10' => $result['ems10'],
					'ems11' => $result['ems11'],
					'ems12' => $result['ems12'],
					'ems13' => $result['ems13'],
					'ems14' => $result['ems14'],
					'ems15' => $result['ems15'],
					'ems16' => $result['ems16'],
					'ems17' => $result['ems17'],
					'ems18' => $result['ems18'],
					'ems19' => $result['ems19'],
					'ems20' => $result['ems20'],
					'ems21' => $result['ems21'],
					'pen_1' => $result['pen_1'],
					'pen_2' => $result['pen_2'],
					'pen_3' => $result['pen_3'],
					'pen_4' => $result['pen_4'],
					'w1_1' => $result['w1_1'],
					'w2_1' => $result['w2_1'],
					'wt_1' => $result['wt_1'],
					'wt_2' => $result['wt_2'],
					'wt_3' => $result['wt_3'],
					'wt_4' => $result['wt_4'],
					'wt_5' => $result['wt_5'],
					'wt_6' => $result['wt_6'],
					'wt_7' => $result['wt_7'],
					'wt_8' => $result['wt_8'],
					'wt_9' => $result['wt_9'],
					'wt_10' => $result['wt_10'],
					'duc_1' => $result['duc_1'],
					'duc_2' => $result['duc_2'],
					'grade' => $result['grade']
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
			$grade=$_POST['grade'];
			
			
			$chk_kin = $_POST['chk_kin'];
			$chk_sol = $_POST['chk_sol'];
			$chk_duc = $_POST['chk_duc'];
			$chk_rec = $_POST['chk_rec'];
			$chk_pen = $_POST['chk_pen'];
			$chk_mwa = $_POST['chk_mwa'];
			$chk_par = $_POST['chk_par'];
			$chk_mic = $_POST['chk_mic'];
			$ems1 = $_POST['ems1'];
			$ems2 = $_POST['ems2'];
			$ems3 = $_POST['ems3'];
			$ems4 = $_POST['ems4'];
			$ems5 = $_POST['ems5'];
			$ems6 = $_POST['ems6'];
			$ems7 = $_POST['ems7'];
			$ems8 = $_POST['ems8'];
			$ems9 = $_POST['ems9'];
			$ems10 = $_POST['ems10'];
			$ems11 = $_POST['ems11'];
			$ems12 = $_POST['ems12'];
			$ems13 = $_POST['ems13'];
			$ems14 = $_POST['ems14'];
			$ems15 = $_POST['ems15'];
			$ems16 = $_POST['ems16'];
			$ems17 = $_POST['ems17'];
			$ems18 = $_POST['ems18'];
			$ems19 = $_POST['ems19'];
			$ems20 = $_POST['ems20'];
			$ems21 = $_POST['ems21'];
			$duc_1 = $_POST['duc_1'];
			$duc_2 = $_POST['duc_2'];
			$pen_1 = $_POST['pen_1'];
			$pen_2 = $_POST['pen_2'];
			$pen_3 = $_POST['pen_3'];
			$pen_4 = $_POST['pen_4'];
			$w1_1 = $_POST['w1_1'];
			$w2_1 = $_POST['w2_1'];
			$wt_1 = $_POST['wt_1'];
			$wt_2 = $_POST['wt_2'];
			$wt_3 = $_POST['wt_3'];
			$wt_4 = $_POST['wt_4'];
			$wt_5 = $_POST['wt_5'];
			$wt_6 = $_POST['wt_6'];
			$wt_7 = $_POST['wt_7'];
			$wt_8 = $_POST['wt_8'];
			$wt_9 = $_POST['wt_9'];
			$wt_10 = $_POST['wt_10'];
			

			$curr_date=date("Y-m-d");

			 $insert="INSERT INTO `emulsion`(`report_no`,`ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_kin`, `chk_sol`, `chk_duc`, `chk_rec`, `chk_pen`, `chk_mwa`, `chk_par`, `chk_mic`, `ems1`, `ems2`, `ems3`, `ems4`, `ems5`, `ems6`, `ems7`, `ems8`, `ems9`, `ems10`, `ems11`, `ems12`, `ems13`, `ems14`, `ems15`, `ems16`, `ems17`, `ems18`, `ems19`, `ems20`, `ems21`, `duc_1`, `duc_2`, `pen_1`, `pen_2`, `pen_3`, `pen_4`, `w1_1`, `w2_1`, `wt_1`, `wt_2`, `wt_3`, `wt_4`, `wt_5`, `wt_6`, `wt_7`, `wt_8`, `wt_9`, `wt_10`, `amend_date`, `grade`) VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_kin', '$chk_sol', '$chk_duc', '$chk_rec', '$chk_pen', '$chk_mwa', '$chk_par', '$chk_mic', '$ems1', '$ems2', '$ems3', '$ems4', '$ems5', '$ems6', '$ems7', '$ems8', '$ems9', '$ems10', '$ems11', '$ems12', '$ems13', '$ems14', '$ems15', '$ems16', '$ems17', '$ems18', '$ems19', '$ems20', '$ems21', '$duc_1', '$duc_2', '$pen_1', '$pen_2', '$pen_3', '$pen_4', '$w1_1', '$w2_1', '$wt_1', '$wt_2', '$wt_3', '$wt_4', '$wt_5', '$wt_6', '$wt_7', '$wt_8', '$wt_9', '$wt_10', '$amend_date', '$grade')";
			
		
				
			
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
													 $query = "select * from emulsion WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
		
		
		$update= "update `emulsion` SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]', `ulr`='$_POST[ulr]',
		`chk_kin`='$_POST[chk_kin]',
		`chk_sol`='$_POST[chk_sol]',
		`chk_rec`='$_POST[chk_rec]',
		`chk_pen`='$_POST[chk_pen]',
		`chk_duc`='$_POST[chk_duc]',
		`chk_mwa`='$_POST[chk_mwa]',
		`chk_par`='$_POST[chk_par]',
		`chk_mic`='$_POST[chk_mic]',
		`grade`='$_POST[grade]',
		`ems1`='$_POST[ems1]',
		`ems2`='$_POST[ems2]',
		`ems3`='$_POST[ems3]',
		`ems4`='$_POST[ems4]',
		`ems5`='$_POST[ems5]',
		`ems6`='$_POST[ems6]',
		`ems7`='$_POST[ems7]',
		`ems8`='$_POST[ems8]',
		`ems9`='$_POST[ems9]',
		`ems10`='$_POST[ems10]',
		`ems11`='$_POST[ems11]',
		`ems12`='$_POST[ems12]',
		`ems13`='$_POST[ems13]',
		`ems14`='$_POST[ems14]',
		`ems15`='$_POST[ems15]',
		`ems16`='$_POST[ems16]',
		`ems17`='$_POST[ems17]',
		`ems18`='$_POST[ems18]',
		`ems19`='$_POST[ems19]',
		`ems20`='$_POST[ems20]',
		`ems21`='$_POST[ems21]',
		`duc_1`='$_POST[duc_1]',
		`duc_2`='$_POST[duc_2]',
		`pen_1`='$_POST[pen_1]',
		`pen_2`='$_POST[pen_2]',
		`pen_3`='$_POST[pen_3]',
		`pen_4`='$_POST[pen_4]',
		`w1_1`='$_POST[w1_1]',
		`w2_1`='$_POST[w2_1]',
		`wt_1`='$_POST[wt_1]',
		`wt_2`='$_POST[wt_2]',
		`wt_3`='$_POST[wt_3]',
		`wt_4`='$_POST[wt_4]',
		`wt_5`='$_POST[wt_5]',
		`wt_6`='$_POST[wt_6]',
		`wt_7`='$_POST[wt_7]',
		`wt_8`='$_POST[wt_8]',
		`wt_9`='$_POST[wt_9]',
		`wt_10`='$_POST[wt_10]',
		`amend_date`='$_POST[amend_date]',
		`checked_by`=NULL WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update emulsion SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM emulsion WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update emulsion SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$cc);	
				}
				else
				{
					$cc="update emulsion SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>