<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from bitumin_span WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'tank_no' => $result['tank_no'],
							'lot_no' => $result['lot_no'],
							'bitumin_grade' => $result['bitumin_grade'],
							'bitumin_make' => $result['bitumin_make'],
							'tag_heading' => $result['tag_heading'],
							'tag_data' => $result['tag_data'],
							'chk_pen' => $result['chk_pen'],
							'pen_temp' => $result['pen_temp'],							
							'pen_1' => $result['pen_1'],							
							'pen_2' => $result['pen_2'],							
							'pen_3' => $result['pen_3'],							
							'avg_pen' => $result['avg_pen'],							
							'chk_sof' => $result['chk_sof'],
							'sof_0' => $result['sof_0'],
							'sof_1' => $result['sof_1'],
							'sof_2' => $result['sof_2'],
							'sof_3' => $result['sof_3'],							
							'sof_4' => $result['sof_4'],							
							'sof_5' => $result['sof_5'],							
							'sof_6' => $result['sof_6'],							
							'sof_7' => $result['sof_7'],							
							'sof_8' => $result['sof_8'],
							'sof_9' => $result['sof_9'],
							'sof_10' => $result['sof_10'],
							'sof_11' => $result['sof_11'],
							'sof_12' => $result['sof_12'],							
							'sof_13' => $result['sof_13'],							
							'sof_14' => $result['sof_14'],							
							'sof_ball_1' => $result['sof_ball_1'],							
							'sof_ball_2' => $result['sof_ball_2'],							
							'avg_sof' => $result['avg_sof'],
							'chk_duc' => $result['chk_duc'],
							'duc_temp' => $result['duc_temp'],
							'duc_1' => $result['duc_1'],
							'duc_2' => $result['duc_2'],							
							'duc_3' => $result['duc_3'],							
							'avg_duc' => $result['avg_duc'],							
							'chk_sp' => $result['chk_sp'],							
							'sp_temp' => $result['sp_temp'],							
							'sp_a_1' => $result['sp_a_1'],
							'sp_a_2' => $result['sp_a_2'],
							'sp_b_1' => $result['sp_b_1'],
							'sp_b_2' => $result['sp_b_2'],
							'sp_c_1' => $result['sp_c_1'],
							'sp_c_2' => $result['sp_c_2'],
							'sp_d_1' => $result['sp_d_1'],
							'sp_d_2' => $result['sp_d_2'],
							'sp_1' => $result['sp_1'],
							'sp_2' => $result['sp_2'],							
							'avg_sp' => $result['avg_sp'],							
							'chk_abs' => $result['chk_abs'],
							'abs_1_1' => $result['abs_1_1'],
							'abs_1_2' => $result['abs_1_2'],
							'abs_2_1' => $result['abs_2_1'],
							'abs_2_2' => $result['abs_2_2'],
							'abs_3_1' => $result['abs_3_1'],
							'abs_3_2' => $result['abs_3_2'],
							'abs_4_1' => $result['abs_4_1'],
							'abs_4_2' => $result['abs_4_2'],
							'abs_5_1' => $result['abs_5_1'],
							'abs_5_2' => $result['abs_5_2'],
							'abs_6_1' => $result['abs_6_1'],
							'abs_6_2' => $result['abs_6_2'],
							'abs_7_1' => $result['abs_7_1'],
							'abs_7_2' => $result['abs_7_2'],
							'abs_8_1' => $result['abs_8_1'],
							'abs_8_2' => $result['abs_8_2'],
							'abs_9_1' => $result['abs_9_1'],
							'abs_9_2' => $result['abs_9_2'],
							'avg_abs' => $result['avg_abs'],
							'chk_kin' => $result['chk_kin'],
							'kin_1_1' => $result['kin_1_1'],
							'kin_1_2' => $result['kin_1_2'],
							'kin_2_1' => $result['kin_2_1'],
							'kin_2_2' => $result['kin_2_2'],
							'kin_3_1' => $result['kin_3_1'],
							'kin_3_2' => $result['kin_3_2'],
							'kin_4_1' => $result['kin_4_1'],
							'kin_4_2' => $result['kin_4_2'],
							'kin_5_1' => $result['kin_5_1'],
							'kin_5_2' => $result['kin_5_2'],
							'kin_6_1' => $result['kin_6_1'],
							'kin_6_2' => $result['kin_6_2'],							
							'avg_kin' => $result['avg_kin'],
							'chk_los' => $result['chk_los'],													
							'los_temp' => $result['los_temp'],
							'los_w1_1' => $result['los_w1_1'],							
							'los_w1_2' => $result['los_w1_2'],
							'los_w2_1' => $result['los_w2_1'],
							'los_w2_2' => $result['los_w2_2'],
							'los_wt_1' => $result['los_wt_1'],
							'los_wt_2' => $result['los_wt_2'],
							'los_1' => $result['los_1'],
							'los_2' => $result['los_2'],			
							'air_1' => $result['air_1'],
							'bath_1' => $result['bath_1'],
							'idg_1' => $result['idg_1'],
                            'idg_2' => $result['idg_2'],
                            'idg_3' => $result['idg_3'],
                            'fdg_1' => $result['fdg_1'],
                            'fdg_2' => $result['fdg_2'],
                            'fdg_3' => $result['fdg_3'],
							's_des' => $result['s_des'],
                            'r_sam' => $result['r_sam'],
                            's_ret' => $result['s_ret'],
                            'qty_1' => $result['qty_1'],
							'avg_los' => $result['avg_los'],
							'tw1' => $result['tw1'],
							'tw2' => $result['tw2'],
							'tw3' => $result['tw3'],
							'tw4' => $result['tw4'],
							'tw5' => $result['tw5'],
							'tw6' => $result['tw6'],
							'tw7' => $result['tw7'],
							'tw8' => $result['tw8'],
							'tw9' => $result['tw9'],
							'tw10' => $result['tw10'],
							'tw11' => $result['tw11'],
							'tw12' => $result['tw12'],
							'tw13' => $result['tw13'],
							'tw14' => $result['tw14'],
							'tw15' => $result['tw15'],
							'tw16' => $result['tw16'],
							'tw17' => $result['tw17'],
							'tw18' => $result['tw18'],
							'tw19' => $result['tw19'],
							'tw20' => $result['tw20'],
							'tw21' => $result['tw21'],
							'tw22' => $result['tw22'],
							'sf1' => $result['sf1'],
							'sf2' => $result['sf2'],
							'sf3' => $result['sf3'],
							'sf4' => $result['sf4'],
							'sf5' => $result['sf5'],
							'sf6' => $result['sf6'],
							'sf7' => $result['sf7'],
							'sf8' => $result['sf8'],
							'sf9' => $result['sf9'],
							'sf10' => $result['sf10'],
							'sf11' => $result['sf11'],
							'bn_1' => $result['bn_1'],
							'bn_2' => $result['bn_2']						
						);	  
			echo json_encode($fill);
		}
		
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];			
			$tank_no =  $_POST['tank_no'];	
			$lot_no =  $_POST['lot_no'];	
			$bitumin_grade =  $_POST['bitumin_grade'];	
			$bitumin_make =  $_POST['bitumin_make'];	
			$ulr =  $_POST['ulr'];	
			$tag_heading =  $_POST['tag_heading'];	
			$tag_data =  $_POST['tag_data'];	
					
			$chk_pen = $_POST['chk_pen'];
			$pen_temp = $_POST['pen_temp'];
			$pen_1 = $_POST['pen_1'];
			$pen_2 = $_POST['pen_2'];
			$pen_3 = $_POST['pen_3'];			
			$avg_pen = $_POST['avg_pen'];			
			$chk_sof = $_POST['chk_sof'];			
			$sof_0 = $_POST['sof_0'];			
			$sof_1 = $_POST['sof_1'];			
			$sof_2 = $_POST['sof_2'];
			$sof_3 = $_POST['sof_3'];
			$sof_4 = $_POST['sof_4'];
			$sof_5 = $_POST['sof_5'];
			$sof_6 = $_POST['sof_6'];		
			$sof_7 = $_POST['sof_7'];		
			$sof_8 = $_POST['sof_8'];		
			$sof_9 = $_POST['sof_9'];		
			$sof_10 = $_POST['sof_10'];		
			$sof_11 = $_POST['sof_11'];
			$sof_12 = $_POST['sof_12'];
			$sof_13 = $_POST['sof_13'];
			$sof_14 = $_POST['sof_14'];
			$sof_ball_1 = $_POST['sof_ball_1'];
			$sof_ball_2 = $_POST['sof_ball_2'];
			$avg_sof = $_POST['avg_sof'];
			$chk_duc = $_POST['chk_duc'];
			$duc_temp = $_POST['duc_temp'];
			$duc_1 = $_POST['duc_1'];
			$duc_2 = $_POST['duc_2'];
			$duc_3 = $_POST['duc_3'];
			$avg_duc = $_POST['avg_duc'];
			$chk_sp = $_POST['chk_sp'];		
			$sp_temp = $_POST['sp_temp'];		
			$sp_a_1 = $_POST['sp_a_1'];		
			$sp_a_2 = $_POST['sp_a_2'];		
			$sp_b_1 = $_POST['sp_b_1'];		
			$sp_b_2 = $_POST['sp_b_2'];
			$sp_c_1 = $_POST['sp_c_1'];
			$sp_c_2 = $_POST['sp_c_2'];
			$sp_d_1 = $_POST['sp_d_1'];
			$sp_d_2 = $_POST['sp_d_2'];		
			$sp_1 = $_POST['sp_1'];						
			$sp_2 = $_POST['sp_2'];						
			$avg_sp = $_POST['avg_sp'];						
			$chk_abs = $_POST['chk_abs'];						
			$abs_1_1 = $_POST['abs_1_1'];			
			$abs_1_2 =  $_POST['abs_1_2'];	
			$abs_2_1 = $_POST['abs_2_1'];			
			$abs_2_2 =  $_POST['abs_2_2'];	
			$abs_3_1 = $_POST['abs_3_1'];			
			$abs_3_2 =  $_POST['abs_3_2'];	
			$abs_4_1 = $_POST['abs_4_1'];			
			$abs_4_2 =  $_POST['abs_4_2'];	
			$abs_5_1 = $_POST['abs_5_1'];			
			$abs_5_2 =  $_POST['abs_5_2'];	
			$abs_6_1 = $_POST['abs_6_1'];			
			$abs_6_2 =  $_POST['abs_6_2'];	
			$abs_7_1 = $_POST['abs_7_1'];			
			$abs_7_2 =  $_POST['abs_7_2'];	
			$abs_8_1 = $_POST['abs_8_1'];			
			$abs_8_2 =  $_POST['abs_8_2'];	
			$abs_9_1 = $_POST['abs_9_1'];			
			$abs_9_2 =  $_POST['abs_9_2'];	
			$avg_abs =  $_POST['avg_abs'];
			$chk_kin = $_POST['chk_kin'];						
			$kin_1_1 = $_POST['kin_1_1'];			
			$kin_1_2 =  $_POST['kin_1_2'];	
			$kin_2_1 = $_POST['kin_2_1'];			
			$kin_2_2 =  $_POST['kin_2_2'];	
			$kin_3_1 = $_POST['kin_3_1'];			
			$kin_3_2 =  $_POST['kin_3_2'];	
			$kin_4_1 = $_POST['kin_4_1'];			
			$kin_4_2 =  $_POST['kin_4_2'];	
			$kin_5_1 = $_POST['kin_5_1'];			
			$kin_5_2 =  $_POST['kin_5_2'];	
			$kin_6_1 = $_POST['kin_6_1'];			
			$kin_6_2 =  $_POST['kin_6_2'];				
			$avg_kin =  $_POST['avg_kin'];	
			$chk_los =  $_POST['chk_los'];	
			$los_temp =  $_POST['los_temp'];	
			$los_w1_1 =  $_POST['los_w1_1'];	
			$los_w1_2 =  $_POST['los_w1_2'];	
			$los_w2_1 =  $_POST['los_w2_1'];	
			$los_w2_2 =  $_POST['los_w2_2'];	
			$los_wt_1 =  $_POST['los_wt_1'];	
			$los_wt_2 =  $_POST['los_wt_2'];	
			$los_1 =  $_POST['los_1'];	
			$los_2 =  $_POST['los_2'];	
			$air_1 = $_POST['air_1'];
			$bath_1 = $_POST['bath_1'];
			$idg_1 = $_POST['idg_1'];
            $idg_2 = $_POST['idg_2'];
            $idg_3 = $_POST['idg_3'];
            $fdg_1 = $_POST['fdg_1'];
            $fdg_2 = $_POST['fdg_2'];
            $fdg_3 = $_POST['fdg_3'];
			$s_des = $_POST['s_des'];
			$r_sam = $_POST['r_sam'];
			$s_ret = $_POST['s_ret'];
			$qty_1 = $_POST['qty_1'];
			$tw1 = $_POST['tw1'];
			$tw2 = $_POST['tw2'];
			$tw3 = $_POST['tw3'];
			$tw4 = $_POST['tw4'];
			$tw5 = $_POST['tw5'];
			$tw6 = $_POST['tw6'];
			$tw7 = $_POST['tw7'];
			$tw8 = $_POST['tw8'];
			$tw9 = $_POST['tw9'];
			$tw10 = $_POST['tw10'];
			$tw11 = $_POST['tw11'];
			$tw12 = $_POST['tw12'];
			$tw13 = $_POST['tw13'];
			$tw14 = $_POST['tw14'];
			$tw15 = $_POST['tw15'];
			$tw16 = $_POST['tw16'];
			$tw17 = $_POST['tw17'];
			$tw18 = $_POST['tw18'];
			$tw19 = $_POST['tw19'];
			$tw20 = $_POST['tw20'];
			$tw21 = $_POST['tw21'];
			$tw22 = $_POST['tw22'];
			$sf1 = $_POST['sf1'];
			$sf2 = $_POST['sf2'];
			$sf3 = $_POST['sf3'];
			$sf4 = $_POST['sf4'];
			$sf5 = $_POST['sf5'];
			$sf6 = $_POST['sf6'];
			$sf7 = $_POST['sf7'];
			$sf8 = $_POST['sf8'];
			$sf9 = $_POST['sf9'];
			$sf10 = $_POST['sf10'];
			$sf11 = $_POST['sf11'];
			$bn_1 = $_POST['bn_1'];
			$bn_2 = $_POST['bn_2'];

			$avg_los =  $_POST['avg_los'];	
			
			$curr_date=date("Y-m-d");
			
			
			 $insert="insert into bitumin_span (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `tank_no`, `lot_no`, `bitumin_grade`, `bitumin_make`, `chk_pen`, `pen_temp`, `pen_1`, `pen_2`, `pen_3`, `avg_pen`, `chk_sof`, `sof_0`, `sof_1`, `sof_2`, `avg_sof`, `chk_duc`, `duc_temp`, `duc_1`, `duc_2`, `duc_3`, `avg_duc`, `chk_sp`, `sp_temp`, `sp_a_1`, `sp_a_2`, `sp_b_1`, `sp_b_2`, `sp_c_1`, `sp_c_2`, `sp_d_1`, `sp_d_2`, `avg_sp`, `chk_abs`, `abs_1_1`, `abs_1_2`, `abs_2_1`, `abs_2_2`, `abs_3_1`, `abs_3_2`, `abs_4_1`, `abs_4_2`, `abs_5_1`, `abs_5_2`, `abs_6_1`, `abs_6_2`, `abs_7_1`, `abs_7_2`, `abs_8_1`, `abs_8_2`, `abs_9_1`, `abs_9_2`, `avg_abs`, `chk_kin`, `kin_1_1`, `kin_1_2`, `kin_2_1`, `kin_2_2`, `kin_3_1`, `kin_3_2`, `kin_4_1`, `kin_4_2`, `kin_5_1`, `kin_5_2`, `kin_6_1`, `kin_6_2`, `avg_kin`, `chk_los`, `los_temp`, `los_w1_1`, `los_w1_2`, `los_w2_1`, `los_w2_2`, `los_wt_1`, `los_wt_2`, `avg_los`,`sp_1`,`sp_2`,`los_1`,`los_2`,`tag_heading`,`tag_data`,`air_1`,`bath_1`,`idg_1`,`idg_2`,`idg_3`,`fdg_1`,`fdg_2`,`fdg_3`,`s_des`,`r_sam`,`s_ret`,`qty_1`,`tw1`,`tw2`,`tw3`,`tw4`,`tw5`,`tw6`,`tw7`,`tw8`,`tw9`,`tw10`,`tw11`,`tw12`,`tw13`,`tw14`,`tw15`,`tw16`,`tw17`,`tw18`,`tw19`,`tw20`,`tw21`,`tw22`,`sf1`,`sf2`,`sf3`,`sf4`,`sf5`,`sf6`,`sf7`,`sf8`,`sf9`,`sf10`,`sf11`,`bn_1`,`bn_2`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$tank_no', '$lot_no', '$bitumin_grade', '$bitumin_make', '$chk_pen', '$pen_temp', '$pen_1', '$pen_2', '$pen_3', '$avg_pen', '$chk_sof', '$sof_0','$sof_1', '$sof_2', '$avg_sof', '$chk_duc', '$duc_temp', '$duc_1', '$duc_2', '$duc_3', '$avg_duc', '$chk_sp', '$sp_temp', '$sp_a_1', '$sp_a_2', '$sp_b_1', '$sp_b_2', '$sp_c_1', '$sp_c_2', '$sp_d_1', '$sp_d_2', '$avg_sp', '$chk_abs', '$abs_1_1', '$abs_1_2', '$abs_2_1', '$abs_2_2', '$abs_3_1', '$abs_3_2', '$abs_4_1', '$abs_4_2', '$abs_5_1', '$abs_5_2', '$abs_6_1', '$abs_6_2', '$abs_7_1', '$abs_7_2', '$abs_8_1', '$abs_8_2', '$abs_9_1', '$abs_9_2', '$avg_abs', '$chk_kin', '$kin_1_1', '$kin_1_2', '$kin_2_1', '$kin_2_2', '$kin_3_1', '$kin_3_2', '$kin_4_1', '$kin_4_2', '$kin_5_1', '$kin_5_2', '$kin_6_1', '$kin_6_2', '$avg_kin', '$chk_los', '$los_temp', '$los_w1_1', '$los_w1_2', '$los_w2_1', '$los_w2_2', '$los_wt_1', '$los_wt_2', '$avg_los','$sp_1','$sp_2','$los_1','$los_2','$tag_heading','$tag_data','$air_1','$bath_1','$idg_1','$idg_2','$idg_3','$fdg_1','$fdg_2','$fdg_3','$s_des','$r_sam','$s_ret','$qty_1','$tw1','$tw2','$tw3','$tw4','$tw5','$tw6','$tw7','$tw8','$tw9','$tw10','$tw11','$tw12','$tw13','$tw14','$tw15','$tw16','$tw17','$tw18','$tw19','$tw20','$tw21','$tw22','$sf1','$sf2','$sf3','$sf4','$sf5','$sf6','$sf7','$sf8','$sf9','$sf10','$sf11','$bn_1','$bn_2')";
				
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
													 $query = "select * from bitumin_span WHERE lab_no='$lab_no' and `is_deleted`='0'";

														$result = mysqli_query($conn, $query);
									

														if (mysqli_num_rows($result) > 0) {
													while($r = mysqli_fetch_array($result)){
											
																if($r['is_deleted'] == 0){
																?>
																<tr>
																<td style="text-align:center;" width="10%">	
																
																<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editData('<?php echo $r['id']; ?>')"></a>
																<?php
																//	$val =  $_SESSION['isadmin'];
																//	if($val == 0 || $val == 5){
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
		
		
		$curr_date=date("Y-m-d");
		
		$update="update bitumin_span SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',
		 `report_no`='$_POST[report_no]',
		 `tag_heading`='$_POST[tag_heading]',
		 `tag_data`='$_POST[tag_data]',
		 `chk_pen`='$_POST[chk_pen]',
		 `pen_temp`='$_POST[pen_temp]',
		 `pen_1`='$_POST[pen_1]',
		 `pen_2`='$_POST[pen_2]',
		 `pen_3`='$_POST[pen_3]',
		 `avg_pen`='$_POST[avg_pen]',
		 `chk_sof`='$_POST[chk_sof]',
		 `sof_0`='$_POST[sof_0]',
		 `sof_1`='$_POST[sof_1]',
		 `sof_2`='$_POST[sof_2]',
		 `avg_sof`='$_POST[avg_sof]',
		 `chk_duc`='$_POST[chk_duc]',
		 `duc_temp`='$_POST[duc_temp]',
		 `duc_1`='$_POST[duc_1]',
		 `duc_2`='$_POST[duc_2]',
		 `duc_3`='$_POST[duc_3]',
		 `avg_duc`='$_POST[avg_duc]',
		 `chk_sp`='$_POST[chk_sp]',
		 `sp_temp`='$_POST[sp_temp]',
		 `sp_a_1`='$_POST[sp_a_1]',
		 `sp_a_2`='$_POST[sp_a_2]',
		 `sp_b_1`='$_POST[sp_b_1]',
		 `sp_b_2`='$_POST[sp_b_2]',
		 `sp_c_1`='$_POST[sp_c_1]',
		 `sp_c_2`='$_POST[sp_c_2]',
		 `sp_d_1`='$_POST[sp_d_1]',
		 `sp_d_2`='$_POST[sp_d_2]',
		 `sp_1`='$_POST[sp_1]',
		 `sp_2`='$_POST[sp_2]',
		 `avg_sp`='$_POST[avg_sp]',
		 `chk_abs`='$_POST[chk_abs]',
		 `abs_1_1`='$_POST[abs_1_1]',
		 `abs_1_2`='$_POST[abs_1_2]',
		 `abs_2_1`='$_POST[abs_2_1]',
		 `abs_2_2`='$_POST[abs_2_2]',
		 `abs_3_1`='$_POST[abs_3_1]',
		 `abs_3_2`='$_POST[abs_3_2]',
		 `abs_4_1`='$_POST[abs_4_1]',
		 `abs_4_2`='$_POST[abs_4_2]',
		 `abs_5_1`='$_POST[abs_5_1]',
		 `abs_5_2`='$_POST[abs_5_2]',
		 `abs_6_1`='$_POST[abs_6_1]',
		 `abs_6_2`='$_POST[abs_6_2]',
		 `abs_7_1`='$_POST[abs_7_1]',
		 `abs_7_2`='$_POST[abs_7_2]',
		 `abs_8_1`='$_POST[abs_8_1]',
		 `abs_8_2`='$_POST[abs_8_2]',
		 `abs_9_1`='$_POST[abs_9_1]',
		 `abs_9_2`='$_POST[abs_9_2]',
		 `avg_abs`='$_POST[avg_abs]',
		 `chk_kin`='$_POST[chk_kin]',
		 `kin_1_1`='$_POST[kin_1_1]',
		 `kin_1_2`='$_POST[kin_1_2]',
		 `kin_2_1`='$_POST[kin_2_1]',
		 `kin_2_2`='$_POST[kin_2_2]',
		 `kin_3_1`='$_POST[kin_3_1]',
		 `kin_3_2`='$_POST[kin_3_2]',
		 `kin_4_1`='$_POST[kin_4_1]',
		 `kin_4_2`='$_POST[kin_4_2]',
		 `kin_5_1`='$_POST[kin_5_1]',
		 `kin_5_2`='$_POST[kin_5_2]',
		 `kin_6_1`='$_POST[kin_6_1]',
		 `kin_6_2`='$_POST[kin_6_2]',
		 `avg_kin`='$_POST[avg_kin]',
		 `chk_los`='$_POST[chk_los]',
		 `los_temp`='$_POST[los_temp]',
		 `los_w1_1`='$_POST[los_w1_1]',
		 `los_w1_2`='$_POST[los_w1_2]',
		 `los_w2_1`='$_POST[los_w2_1]',
		 `los_w2_2`='$_POST[los_w2_2]',
		 `los_wt_1`='$_POST[los_wt_1]',
		 `los_wt_2`='$_POST[los_wt_2]',
		 `los_1`='$_POST[los_1]',
		 `los_2`='$_POST[los_2]',
		 `avg_los`='$_POST[avg_los]',
		 `tank_no`='$_POST[tank_no]',
		 `air_1`='$_POST[air_1]',
		 `bath_1`='$_POST[bath_1]',
		 `idg_1`='$_POST[idg_1]',
         `idg_2`='$_POST[idg_2]',
         `idg_3`='$_POST[idg_3]',
         `fdg_1`='$_POST[fdg_1]',
         `fdg_2`='$_POST[fdg_2]',
		 `s_des`='$_POST[s_des]',
		 `r_sam`='$_POST[r_sam]',
		 `s_ret`='$_POST[s_ret]',
		 `qty_1`='$_POST[qty_1]',
         `fdg_3`='$_POST[fdg_3]',
`tw1`='$_POST[tw1]',
`tw2`='$_POST[tw2]',
`tw3`='$_POST[tw3]',
`tw4`='$_POST[tw4]',
`tw5`='$_POST[tw5]',
`tw6`='$_POST[tw6]',
`tw7`='$_POST[tw7]',
`tw8`='$_POST[tw8]',
`tw9`='$_POST[tw9]',
`tw10`='$_POST[tw10]',
`tw11`='$_POST[tw11]',
`tw12`='$_POST[tw12]',
`tw13`='$_POST[tw13]',
`tw14`='$_POST[tw14]',
`tw15`='$_POST[tw15]',
`tw16`='$_POST[tw16]',
`tw17`='$_POST[tw17]',
`tw18`='$_POST[tw18]',
`tw19`='$_POST[tw19]',
`tw20`='$_POST[tw20]',
`tw21`='$_POST[tw21]',
`tw22`='$_POST[tw22]',
`sf1`='$_POST[sf1]',
`sf2`='$_POST[sf2]',
`sf3`='$_POST[sf3]',
`sf4`='$_POST[sf4]',
`sf5`='$_POST[sf5]',
`sf6`='$_POST[sf6]',
`sf7`='$_POST[sf7]',
`sf8`='$_POST[sf8]',
`sf9`='$_POST[sf9]',
`sf10`='$_POST[sf10]',
`sf11`='$_POST[sf11]',
`bn_1`='$_POST[bn_1]',
`bn_2`='$_POST[bn_2]',
		 `checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update bitumin_span SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM bitumin_span WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update bitumin_span SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update bitumin_span SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
    exit;
	
}
?>