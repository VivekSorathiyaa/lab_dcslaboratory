<?php

session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from soil_calibration WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'cal_mdd' => $result['cal_mdd'],																		
							'chk_cali' => $result['chk_cali'],																				
							'c1' => $result['c1'],							
							'c2' => $result['c2'],							
							'c3' => $result['c3'],							
							'c4' => $result['c4'],							
							'c5' => $result['c5'],							
							'c6' => $result['c6'],							
							'd1' => $result['d1'],							
							'd2' => $result['d2'],							
							'd3' => $result['d3'],							
							'd4' => $result['d4'],							
							'd5' => $result['d5'],							
							'd6' => $result['d6'],							
							'd7' => $result['d7'],							
							'd8' => $result['d8'],							
							'layer_mt' => $result['layer_mt'],							
							'con_no' => $result['con_no'],							
							'con_weight' => $result['con_weight'],							
							'wt_con_wt_soil' => $result['wt_con_wt_soil'],							
							'wt_con_dry_soil' => $result['wt_con_dry_soil'],							
							'mc_od' => $result['mc_od']					
							
							
 							
							
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
					
			$chk_cali =  $_POST['chk_cali'];	
			
			$cal_mdd = $_POST['cal_mdd'];
			
			$c1 = $_POST['c1'];
			$c2 = $_POST['c2'];
			$c3 = $_POST['c3'];
			$c4 = $_POST['c4'];
			$c5 = $_POST['c5'];
			$c6 = $_POST['c6'];
			
			$d1 = $_POST['d1'];
			$d2 = $_POST['d2'];
			$d3 = $_POST['d3'];
			$d4 = $_POST['d4'];
			$d5 = $_POST['d5'];
			$d6 = $_POST['d6'];
			$d7 = $_POST['d7'];
			$d8 = $_POST['d8'];
			$layer_mt = $_POST['layer_mt'];
			$con_no = $_POST['con_no'];
			$con_weight = $_POST['con_weight'];
			$wt_con_dry_soil = $_POST['wt_con_dry_soil'];
			$wt_con_wt_soil = $_POST['wt_con_wt_soil'];
			$mc_od = $_POST['mc_od'];
			
									
			
			$curr_date=date("Y-m-d");
			
					
		 $insert="INSERT INTO `soil_calibration`( `report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `cal_mdd`, `chk_cali`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `d1`, `d2`, `d3`, `d4`, `d5`, `d6`, `d7`, `d8`, `layer_mt`, `con_no`, `con_weight`, `wt_con_dry_soil`, `wt_con_wt_soil`, `mc_od`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$cal_mdd','$chk_cali','$c1','$c2','$c3','$c4','$c5','$c6','$d1','$d2','$d3','$d4','$d5','$d6','$d7','$d8','$layer_mt','$con_no','$con_weight','$wt_con_dry_soil','$wt_con_wt_soil','$mc_od')"; 
			
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
														<th style="text-align:center;"><label>Job No.</label></th>
								<th style="text-align:center;"><label>Unique Identity No.</label></th>	
														
																								

													</tr>
														<?php
													 $query = "select * from `soil_calibration` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
			
			
				
		
	  $update="update soil_calibration SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 
				 `ulr`='$_POST[ulr]',		 	 				 
				 `cal_mdd`='$_POST[cal_mdd]',		 	 				 
				 `chk_cali`='$_POST[chk_cali]',
				 `layer_mt`='$_POST[layer_mt]',
				 `con_no`='$_POST[con_no]',
				 `con_weight`='$_POST[con_weight]',
				 `wt_con_dry_soil`='$_POST[wt_con_dry_soil]',
				 `wt_con_wt_soil`='$_POST[wt_con_wt_soil]',
				 `mc_od`='$_POST[mc_od]',
				 `c1`='$_POST[c1]',
				 `c2`='$_POST[c2]',
				 `c3`='$_POST[c3]',
				 `c4`='$_POST[c4]',
				 `c5`='$_POST[c5]',
				 `c6`='$_POST[c6]',
				 `d1`='$_POST[d1]',
				 `d2`='$_POST[d2]',
				 `d3`='$_POST[d3]',
				 `d4`='$_POST[d4]',
				 `d5`='$_POST[d5]',
				 `d6`='$_POST[d6]',
				 `d7`='$_POST[d7]',
				 `d8`='$_POST[d8]'
				  WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		
		 $delete="update soil_calibration SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);		
		
    }	
	elseif ($_POST['action_type'] == 'chk') {
		$lab_no = $_POST['lab_no'];
		$qry = "select * from `soil_calibration` WHERE lab_no='$lab_no' and `is_deleted`='0'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);



		$fill = array('total_row' => $rows1);
		echo json_encode($fill);
	}
    exit;
	
}
?>