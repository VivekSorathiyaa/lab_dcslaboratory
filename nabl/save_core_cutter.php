<?php

session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from core_cutter WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'field_mdd' => $result['field_mdd'],																		
							'chk_den' => $result['chk_den'],																				
							'fdd_1' => $result['fdd_1'],							
							'fdd_2' => $result['fdd_2'],							
							'fdd_3' => $result['fdd_3'],							
							'fdd_4' => $result['fdd_4'],							
							'empty_core' => $result['empty_core'],							
							'vol_core' => $result['vol_core'],							
							'soil_core' => $result['soil_core'],							
							'wet_soil_core' => $result['wet_soil_core'],							
							'mc_soil' => $result['mc_soil'],							
							'con_no' => $result['con_no'],							
							'con_weight' => $result['con_weight'],							
							'wt_con_wt_soil' => $result['wt_con_wt_soil'],							
							'wt_con_dry_soil' => $result['wt_con_dry_soil'],
							'field_mdd1' => $result['field_mdd1'],
							'field_mdd2' => $result['field_mdd2'],
							'chainage_no' => $result['chainage_no'],
							'chainage_no1' => $result['chainage_no1'],
							'chainage_no2' => $result['chainage_no2'],
							'empty_core1' => $result['empty_core1'],
							'empty_core2' => $result['empty_core2'],
							'vol_core1' => $result['vol_core1'],
							'vol_core2' => $result['vol_core2'],
							'wet_soil_core1' => $result['wet_soil_core1'],
							'wet_soil_core2' => $result['wet_soil_core2'],
							'fdd_1_1' => $result['fdd_1_1'],
							'fdd_1_2' => $result['fdd_1_2'],
							'con_no1' => $result['con_no1'],
							'con_no2' => $result['con_no2'],
							'wt_con_wt_soil1' => $result['wt_con_wt_soil1'],
							'wt_con_wt_soil2' => $result['wt_con_wt_soil2'],
							'wt_con_dry_soil1' => $result['wt_con_dry_soil1'],
							'wt_con_dry_soil2' => $result['wt_con_dry_soil2'],
							'fdd_2_1' => $result['fdd_2_1'],
							'fdd_2_2' => $result['fdd_2_2'],
							'fdd_3_1' => $result['fdd_3_1'],
							'fdd_3_2' => $result['fdd_3_2'],
							'avg_moi' => $result['avg_moi'],
							'avg_dry' => $result['avg_dry'],
							'mdd_1' => $result['mdd_1'],

							'con_weight1' => $result['con_weight1'],
							'con_weight2' => $result['con_weight2'],
							'soil_core1' => $result['soil_core1'],
							'soil_core2' => $result['soil_core2'],
							'remark' => $result['remark'],
							'sheet' => $result['sheet'],


						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
			$remark=$_POST['remark'];
			$sheet=$_POST['sheet'];		
					
			$chk_den =  $_POST['chk_den'];	
			
			$field_mdd = $_POST['field_mdd'];
			
			$fdd_1 = $_POST['fdd_1'];
			$fdd_2 = $_POST['fdd_2'];
			$fdd_3 = $_POST['fdd_3'];
			$fdd_4 = $_POST['fdd_4'];
			$empty_core = $_POST['empty_core'];
			$vol_core = $_POST['vol_core'];
			$soil_core = $_POST['soil_core'];
			$wet_soil_core = $_POST['wet_soil_core'];
			$mc_soil = $_POST['mc_soil'];
			$con_no = $_POST['con_no'];
			$con_weight = $_POST['con_weight'];
			$wt_con_dry_soil = $_POST['wt_con_dry_soil'];
			$wt_con_wt_soil = $_POST['wt_con_wt_soil'];

			$field_mdd1 = $_POST['field_mdd1'];
			$field_mdd2 = $_POST['field_mdd2'];
			$chainage_no = $_POST['chainage_no'];
			$chainage_no1 = $_POST['chainage_no1'];
			$chainage_no2 = $_POST['chainage_no2'];
			$empty_core1 = $_POST['empty_core1'];
			$empty_core2 = $_POST['empty_core2'];
			$vol_core1 = $_POST['vol_core1'];
			$vol_core2 = $_POST['vol_core2'];
			$wet_soil_core1 = $_POST['wet_soil_core1'];
			$wet_soil_core2 = $_POST['wet_soil_core2'];
			$fdd_1_1 = $_POST['fdd_1_1'];
			$fdd_1_2 = $_POST['fdd_1_2'];
			$con_no1 = $_POST['con_no1'];
			$con_no2 = $_POST['con_no2'];
			$wt_con_wt_soil1 = $_POST['wt_con_wt_soil1'];
			$wt_con_wt_soil2 = $_POST['wt_con_wt_soil2'];
			$wt_con_dry_soil1 = $_POST['wt_con_dry_soil1'];
			$wt_con_dry_soil2 = $_POST['wt_con_dry_soil2'];
			$fdd_2_1 = $_POST['fdd_2_1'];
			$fdd_2_2 = $_POST['fdd_2_2'];
			$fdd_3_1 = $_POST['fdd_3_1'];
			$fdd_3_2 = $_POST['fdd_3_2'];
			$avg_moi = $_POST['avg_moi'];
			$avg_dry = $_POST['avg_dry'];
			$mdd_1 = $_POST['mdd_1'];

			$con_weight1 = $_POST['con_weight1'];
			$con_weight2 = $_POST['con_weight2'];
			$soil_core1 = $_POST['soil_core1'];
			$soil_core2 = $_POST['soil_core2'];

			
									
			
			$curr_date=date("Y-m-d");
			
					
		 $insert="INSERT INTO `core_cutter`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `field_mdd`,  `field_mdd1`,  `field_mdd2`, `chainage_no`,  `chainage_no1`,  `chainage_no2`, `chk_den`, `fdd_1`, `fdd_2`, `fdd_3`, `fdd_4`, `empty_core`, `empty_core1`, `empty_core2`, `vol_core`, `soil_core`, `wet_soil_core`, `mc_soil`, `con_no`, `con_weight`, `wt_con_dry_soil`, `wt_con_wt_soil`,`fdd_1_1`,`fdd_1_2`,`con_no1`,`con_no2`,`wt_con_wt_soil1`,`wt_con_wt_soil2`,`wt_con_dry_soil1`,`wt_con_dry_soil2`,`fdd_2_1`,`fdd_2_2`,`fdd_3_1`,`fdd_3_2`,`avg_moi`,`avg_dry`,`mdd_1`,`con_weight1`,`con_weight2`,`soil_core1`,`soil_core2`,`remark`,`sheet`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$field_mdd','$field_mdd1','$field_mdd2','$chainage_no','$chainage_no1','$chainage_no2','$chk_den','$fdd_1','$fdd_2','$fdd_3','$fdd_4', '$empty_core', '$empty_core2', '$empty_core2', '$vol_core', '$soil_core', '$wet_soil_core', '$mc_soil', '$con_no', '$con_weight', '$wt_con_dry_soil', '$wt_con_wt_soil','$fdd_1_1','$fdd_1_2','$con_no1','$con_no2','$wt_con_wt_soil1','$wt_con_wt_soil2','$wt_con_dry_soil1','$wt_con_dry_soil2','$fdd_2_1','$fdd_2_2','$fdd_3_1','$fdd_3_2','$avg_moi','$avg_dry','$mdd_1','$con_weight1','$con_weight2','$soil_core1','$soil_core2','$remark','$sheet')"; 
			
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
													 $query = "select * from `core_cutter` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
			
			
				
		
	  $update="update core_cutter SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 
				 `ulr`='$_POST[ulr]',		 	 				 
				 `field_mdd`='$_POST[field_mdd]',		 	 				 
				 `chk_den`='$_POST[chk_den]',
				 `empty_core`='$_POST[empty_core]',
				 `vol_core`='$_POST[vol_core]',
				 `soil_core`='$_POST[soil_core]',
				 `wet_soil_core`='$_POST[wet_soil_core]',
				 `mc_soil`='$_POST[mc_soil]',
				 `con_no`='$_POST[con_no]',
				 `con_weight`='$_POST[con_weight]',
				 `wt_con_dry_soil`='$_POST[wt_con_dry_soil]',
				 `wt_con_wt_soil`='$_POST[wt_con_wt_soil]',
				 `fdd_1`='$_POST[fdd_1]',
				 `fdd_2`='$_POST[fdd_2]',
				 `fdd_3`='$_POST[fdd_3]',
				 `fdd_4`='$_POST[fdd_4]',
				 `field_mdd1`='$_POST[field_mdd1]',
				`field_mdd2`='$_POST[field_mdd2]',
				`chainage_no`='$_POST[chainage_no]',
				`chainage_no1`='$_POST[chainage_no1]',
				`chainage_no2`='$_POST[chainage_no2]',
				`empty_core1`='$_POST[empty_core1]',
				`empty_core2`='$_POST[empty_core2]',
				`vol_core1`='$_POST[vol_core1]',
				`vol_core2`='$_POST[vol_core2]',
				`wet_soil_core1`='$_POST[wet_soil_core1]',
				`wet_soil_core2`='$_POST[wet_soil_core2]',
				`fdd_1_1`='$_POST[fdd_1_1]',
				`fdd_1_2`='$_POST[fdd_1_2]',
				`con_no1`='$_POST[con_no1]',
				`con_no2`='$_POST[con_no2]',
				`wt_con_wt_soil1`='$_POST[wt_con_wt_soil1]',
				`wt_con_wt_soil2`='$_POST[wt_con_wt_soil2]',
				`wt_con_dry_soil1`='$_POST[wt_con_dry_soil1]',
				`wt_con_dry_soil2`='$_POST[wt_con_dry_soil2]',
				`fdd_2_1`='$_POST[fdd_2_1]',
				`fdd_2_2`='$_POST[fdd_2_2]',
				`fdd_3_1`='$_POST[fdd_3_1]',
				`fdd_3_2`='$_POST[fdd_3_2]',
				`avg_moi`='$_POST[avg_moi]',
				`avg_dry`='$_POST[avg_dry]',
				`mdd_1`='$_POST[mdd_1]',

				`con_weight1`='$_POST[con_weight1]',
				`con_weight2`='$_POST[con_weight2]',
				`soil_core1`='$_POST[soil_core1]',
				`soil_core2`='$_POST[soil_core2]',
				`remark`='$_POST[remark]',
				`sheet`='$_POST[sheet]'


				  WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		
		 $delete="update core_cutter SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM core_cutter WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update core_cutter SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update core_cutter SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>