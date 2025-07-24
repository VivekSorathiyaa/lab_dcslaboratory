<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from rubble WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'chk_sp' => $result['chk_sp'],
							'amend_date' => $result['amend_date'],
							'sp_specific_gravity' => $result['sp_specific_gravity'],
							'sp_specific_gravity_1' => $result['sp_specific_gravity_1'],
							'sp_specific_gravity_2' => $result['sp_specific_gravity_2'],
							'sp_water_abr_1' => $result['sp_water_abr_1'],
							'sp_water_abr_2' => $result['sp_water_abr_2'],
							'sp_water_abr' => $result['sp_water_abr'],											
							'sp_w_sur_1' => $result['sp_w_sur_1'],
							'sp_w_sur_2' => $result['sp_w_sur_2'],
							'sp_wt_st_1' => $result['sp_wt_st_1'],
							'sp_wt_st_2' => $result['sp_wt_st_2'],
							'sp_w_s_1' => $result['sp_w_s_1'],							
							'sp_w_s_2' => $result['sp_w_s_2'],							
							'url' => $result['url']
							
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];
			
			
			$chk_sp =  $_POST['chk_sp'];
			$sp_wt_st_1 = $_POST['sp_wt_st_1'];
			$sp_wt_st_2 = $_POST['sp_wt_st_2'];
			$sp_w_sur_2 = $_POST['sp_w_sur_2'];
			$sp_w_s_2 = $_POST['sp_w_s_2'];
			$sp_specific_gravity_1 = $_POST['sp_specific_gravity_1'];
			$sp_specific_gravity_2 = $_POST['sp_specific_gravity_2'];
			$sp_water_abr_1 = $_POST['sp_water_abr_1'];
			$sp_water_abr_2 = $_POST['sp_water_abr_2'];
			$sp_water_abr = $_POST['sp_water_abr'];
			$sp_w_sur_1 = $_POST['sp_w_sur_1'];
			$sp_w_s_1 = $_POST['sp_w_s_1'];			
			$sp_specific_gravity = $_POST['sp_specific_gravity'];
			
			
			$ulr =  $_POST['ulr'];
			$amend_date =  $_POST['amend_date'];

			$curr_date=date("Y-m-d");

			 $insert="INSERT INTO `rubble`(`report_no`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_sp`, `sp_wt_st_1`, `sp_wt_st_2`, `sp_w_sur_1`, `sp_w_sur_2`, `sp_w_s_1`, `sp_w_s_2`, `sp_specific_gravity_1`, `sp_specific_gravity_2`, `sp_specific_gravity`, `sp_water_abr_1`, `sp_water_abr_2`, `sp_water_abr`, `ulr`, `amend_date`) VALUES ('$report_no','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$chk_sp','$sp_wt_st_1','$sp_wt_st_2','$sp_w_sur_1','$sp_w_sur_2','$sp_w_s_1','$sp_w_s_2','$sp_specific_gravity_1','$sp_specific_gravity_2','$sp_specific_gravity','$sp_water_abr_1','$sp_water_abr_2','$sp_water_abr','$ulr','$amend_date')";
			
		
				
			
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
													 $query = "select * from rubble WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
		
		
		$update= "update `rubble` SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',`ulr`='$_POST[ulr]',		
      `chk_sp`='$_POST[chk_sp]',`sp_wt_st_1`='$_POST[sp_wt_st_1]',`sp_wt_st_2`='$_POST[sp_wt_st_2]',`sp_w_sur_1`='$_POST[sp_w_sur_1]',`sp_w_sur_2`='$_POST[sp_w_sur_2]',`sp_w_s_1`='$_POST[sp_w_s_1]',`sp_w_s_2`='$_POST[sp_w_s_2]',`sp_specific_gravity_1`='$_POST[sp_specific_gravity_1]',`sp_specific_gravity_2`='$_POST[sp_specific_gravity_2]',`sp_specific_gravity`='$_POST[sp_specific_gravity]',`sp_water_abr_1`='$_POST[sp_water_abr_1]',`sp_water_abr_2`='$_POST[sp_water_abr_2]',`sp_water_abr`='$_POST[sp_water_abr]',`amend_date`='$_POST[amend_date]',`checked_by`=NULL WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update rubble SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM rubble WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update rubble SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update rubble SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>