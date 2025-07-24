<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from admixture WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'chk_ash' => $result['chk_ash'],
							'ash_w1' => $result['ash_w1'],
							'ash_w2' => $result['ash_w2'],
							'ash_w3' => $result['ash_w3'],
							'ash_content' => $result['ash_content'],
							'chk_phv' => $result['chk_phv'],
							'phv_before1' => $result['phv_before1'],
							'phv_before2' => $result['phv_before2'],
							'phv_before3' => $result['phv_before3'],
							'phv_avg_before' => $result['phv_avg_before'],
							'phv_after1' => $result['phv_after1'],
							'phv_after2' => $result['phv_after2'],
							'phv_after3' => $result['phv_after3'],
							'phv_avg_after' => $result['phv_avg_after'],
							'phv_temp1' => $result['phv_temp1'],
							'phv_temp2' => $result['phv_temp2'],
							'phv_temp3' => $result['phv_temp3'],
							'phv_avg_temp' => $result['phv_avg_temp'],
							'chk_clr' => $result['chk_clr'],
							'clr_w' => $result['clr_w'],
							'clr_x' => $result['clr_x'],
							'clr_y' => $result['clr_y'],
							'clr_z' => $result['clr_z'],
							'clr_n' => $result['clr_n'],
							'chloride_content' => $result['chloride_content'],
							'chk_rdv' => $result['chk_rdv'],
							'rdv1' => $result['rdv1'],
							'rdv2' => $result['rdv2'],
							'rdv3' => $result['rdv3'],
							'avg_rdv' => $result['avg_rdv'],
							'chk_dmc' => $result['chk_dmc'],
							'dmc_w1' => $result['dmc_w1'],
							'dmc_w2' => $result['dmc_w2'],
							'dmc_w2_w1' => $result['dmc_w2_w1'],
							'dmc_w3' => $result['dmc_w3'],
							'dmc_w3_w1' => $result['dmc_w3_w1'],
							'dmc_content' => $result['dmc_content'],
							'dmc_non_w1' => $result['dmc_non_w1'],
							'dmc_non_w2' => $result['dmc_non_w2'],
							'dmc_non_w2_w1' => $result['dmc_non_w2_w1'],
							'dmc_non_w3' => $result['dmc_non_w3'],
							'dmc_non_w3_w1' => $result['dmc_non_w3_w1'],
							'dmc_non_content' => $result['dmc_non_content'],
							'ash_s_d' => date('d/m/Y', strtotime($result['ash_s_d'])),	
							'ash_e_d' => date('d/m/Y', strtotime($result['ash_e_d'])),	
							'phv_s_d' => date('d/m/Y', strtotime($result['phv_s_d'])),	
							'phv_e_d' => date('d/m/Y', strtotime($result['phv_e_d'])),	
							'clr_s_d' => date('d/m/Y', strtotime($result['clr_s_d'])),	
							'clr_e_d' => date('d/m/Y', strtotime($result['clr_e_d'])),	
							'rdv_s_d' => date('d/m/Y', strtotime($result['rdv_s_d'])),	
							'rdv_e_d' => date('d/m/Y', strtotime($result['rdv_e_d'])),	
							'dmc_s_d' => date('d/m/Y', strtotime($result['dmc_s_d'])),	
							'dmc_e_d' => date('d/m/Y', strtotime($result['dmc_e_d'])),
							'rem_data' => $result['rem_data'],
							'brand_data' => $result['brand_data'],
							'phv_test_method' => $result['phv_test_method'],
							'phv_test_req' => $result['phv_test_req'],
							'phv_test_limit' => $result['phv_test_limit'],
							'rdv_test_method' => $result['rdv_test_method'],
							'rdv_test_req' => $result['rdv_test_req'],
							'rdv_test_limit' => $result['rdv_test_limit'],
							'dmc_test_method' => $result['dmc_test_method'],
							'dmc_test_req' => $result['dmc_test_req'],
							'dmc_test_limit' => $result['dmc_test_limit'],
							'ash_test_method' => $result['ash_test_method'],
							'ash_test_req' => $result['ash_test_req'],
							'ash_test_limit' => $result['ash_test_limit'],
							'clr_test_method' => $result['clr_test_method'],
							'clr_test_req' => $result['clr_test_req'],
							'clr_test_limit' => $result['clr_test_limit']
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
			$rem_data=$_POST['rem_data'];
			$brand_data=$_POST['brand_data'];
			$phv_test_method=$_POST['phv_test_method'];
			$phv_test_req=$_POST['phv_test_req'];
			$phv_test_limit=$_POST['phv_test_limit'];
			$rdv_test_method=$_POST['rdv_test_method'];
			$rdv_test_req=$_POST['rdv_test_req'];
			$rdv_test_limit=$_POST['rdv_test_limit'];
			$dmc_test_method=$_POST['dmc_test_method'];
			$dmc_test_req=$_POST['dmc_test_req'];
			$dmc_test_limit=$_POST['dmc_test_limit'];
			$ash_test_method=$_POST['ash_test_method'];
			$ash_test_req=$_POST['ash_test_req'];
			$ash_test_limit=$_POST['ash_test_limit'];
			$clr_test_method=$_POST['clr_test_method'];
			$clr_test_req=$_POST['clr_test_req'];
			$clr_test_limit=$_POST['clr_test_limit'];
			
			$chk_ash = $_POST['chk_ash'];
			$ash_w1 = $_POST['ash_w1'];
			$ash_w2 = $_POST['ash_w2'];
			$ash_w3 = $_POST['ash_w3'];
			$ash_content = $_POST['ash_content'];
			$chk_phv = $_POST['chk_phv'];
			$phv_before1 = $_POST['phv_before1'];
			$phv_before2 = $_POST['phv_before2'];
			$phv_before3 = $_POST['phv_before3'];
			$phv_avg_before = $_POST['phv_avg_before'];
			$phv_after1 = $_POST['phv_after1'];
			$phv_after2 = $_POST['phv_after2'];
			$phv_after3 = $_POST['phv_after3'];
			$phv_avg_after = $_POST['phv_avg_after'];
			$phv_temp1 = $_POST['phv_temp1'];
			$phv_temp2 = $_POST['phv_temp2'];
			$phv_temp3 = $_POST['phv_temp3'];
			$phv_avg_temp = $_POST['phv_avg_temp'];
			$chk_clr = $_POST['chk_clr'];
			$clr_w = $_POST['clr_w'];
			$clr_x = $_POST['clr_x'];
			$clr_y = $_POST['clr_y'];
			$clr_z = $_POST['clr_z'];
			$clr_n = $_POST['clr_n'];
			$chloride_content = $_POST['chloride_content'];
			$chk_rdv = $_POST['chk_rdv'];
			$rdv1 = $_POST['rdv1'];
			$rdv2 = $_POST['rdv2'];
			$rdv3 = $_POST['rdv3'];
			$avg_rdv = $_POST['avg_rdv'];
			$chk_dmc = $_POST['chk_dmc'];
			$dmc_w1 = $_POST['dmc_w1'];
			$dmc_w2 = $_POST['dmc_w2'];
			$dmc_w2_w1 = $_POST['dmc_w2_w1'];
			$dmc_w3 = $_POST['dmc_w3'];
			$dmc_w3_w1 = $_POST['dmc_w3_w1'];
			$dmc_content = $_POST['dmc_content'];
			$dmc_non_w1 = $_POST['dmc_non_w1'];
			$dmc_non_w2 = $_POST['dmc_non_w2'];
			$dmc_non_w2_w1 = $_POST['dmc_non_w2_w1'];
			$dmc_non_w3 = $_POST['dmc_non_w3'];
			$dmc_non_w3_w1 = $_POST['dmc_non_w3_w1'];
			$dmc_non_content = $_POST['dmc_non_content'];
			$ash_s_d = $_POST['ash_s_d'];
			$ash_e_d = $_POST['ash_e_d'];
			$phv_s_d = $_POST['phv_s_d'];
			$phv_e_d = $_POST['phv_e_d'];
			$clr_s_d = $_POST['clr_s_d'];
			$clr_e_d = $_POST['clr_e_d'];
			$rdv_s_d = $_POST['rdv_s_d'];
			$rdv_e_d = $_POST['rdv_e_d'];
			$dmc_s_d = $_POST['dmc_s_d'];
			$dmc_e_d = $_POST['dmc_e_d'];
			
			if($_POST['ash_s_d'] == ""){$ash_s_d ="0000-00-00";}
			else{$ash_s_d = substr($_POST['ash_s_d'],6,4)."-".substr($_POST['ash_s_d'],3,2)."-".substr($_POST['ash_s_d'],0,2);}

			if($_POST['ash_e_d'] == ""){$ash_e_d ="0000-00-00";}
			else{$ash_e_d = substr($_POST['ash_e_d'],6,4)."-".substr($_POST['ash_e_d'],3,2)."-".substr($_POST['ash_e_d'],0,2);}
			
			if($_POST['phv_s_d'] == ""){$phv_s_d ="0000-00-00";}
			else{$phv_s_d = substr($_POST['phv_s_d'],6,4)."-".substr($_POST['phv_s_d'],3,2)."-".substr($_POST['phv_s_d'],0,2);}

			if($_POST['phv_e_d'] == ""){$phv_e_d ="0000-00-00";}
			else{$phv_e_d = substr($_POST['phv_e_d'],6,4)."-".substr($_POST['phv_e_d'],3,2)."-".substr($_POST['phv_e_d'],0,2);}
			
			if($_POST['clr_s_d'] == ""){$clr_s_d ="0000-00-00";}
			else{$clr_s_d = substr($_POST['clr_s_d'],6,4)."-".substr($_POST['clr_s_d'],3,2)."-".substr($_POST['clr_s_d'],0,2);}

			if($_POST['clr_e_d'] == ""){$clr_e_d ="0000-00-00";}
			else{$clr_e_d = substr($_POST['clr_e_d'],6,4)."-".substr($_POST['clr_e_d'],3,2)."-".substr($_POST['clr_e_d'],0,2);}
			
			if($_POST['rdv_s_d'] == ""){$rdv_s_d ="0000-00-00";}
			else{$rdv_s_d = substr($_POST['rdv_s_d'],6,4)."-".substr($_POST['rdv_s_d'],3,2)."-".substr($_POST['rdv_s_d'],0,2);}

			if($_POST['rdv_e_d'] == ""){$rdv_e_d ="0000-00-00";}
			else{$rdv_e_d = substr($_POST['rdv_e_d'],6,4)."-".substr($_POST['rdv_e_d'],3,2)."-".substr($_POST['rdv_e_d'],0,2);}
			
			if($_POST['dmc_s_d'] == ""){$dmc_s_d ="0000-00-00";}
			else{$dmc_s_d = substr($_POST['dmc_s_d'],6,4)."-".substr($_POST['dmc_s_d'],3,2)."-".substr($_POST['dmc_s_d'],0,2);}

			if($_POST['dmc_e_d'] == ""){$dmc_e_d ="0000-00-00";}
			else{$dmc_e_d = substr($_POST['dmc_e_d'],6,4)."-".substr($_POST['dmc_e_d'],3,2)."-".substr($_POST['dmc_e_d'],0,2);}
			
			
			$curr_date=date("Y-m-d");
			
			
			
		    $insert="INSERT INTO `admixture`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_ash`, `ash_w1`, `ash_w2`, `ash_w3`, `ash_content`, `chk_phv`, `phv_before1`, `phv_before2`, `phv_before3`, `phv_avg_before`, `phv_after1`, `phv_after2`, `phv_after3`, `phv_avg_after`, `phv_temp1`, `phv_temp2`, `phv_temp3`, `phv_avg_temp`, `chk_clr`, `clr_w`, `clr_x`, `clr_y`, `clr_z`, `clr_n`, `chloride_content`, `chk_rdv`, `rdv1`, `rdv2`, `rdv3`, `avg_rdv`, `chk_dmc`, `dmc_w1`, `dmc_w2`, `dmc_w2_w1`, `dmc_w3`, `dmc_w3_w1`, `dmc_content`, `dmc_non_w1`, `dmc_non_w2`, `dmc_non_w2_w1`, `dmc_non_w3`, `dmc_non_w3_w1`, `dmc_non_content`, `ash_s_d`, `ash_e_d`, `phv_s_d`, `phv_e_d`, `clr_s_d`, `clr_e_d`, `rdv_s_d`, `rdv_e_d`, `dmc_s_d`, `dmc_e_d`, `phv_test_method`, `phv_test_req`, `phv_test_limit`, `rdv_test_method`, `rdv_test_req`, `rdv_test_limit`, `dmc_test_method`, `dmc_test_req`, `dmc_test_limit`, `ash_test_method`, `ash_test_req`, `ash_test_limit`, `clr_test_method`, `clr_test_req`, `clr_test_limit`, `rem_data` , `brand_data`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_ash', '$ash_w1', '$ash_w2', '$ash_w3', '$ash_content', '$chk_phv', '$phv_before1', '$phv_before2', '$phv_before3', '$phv_avg_before', '$phv_after1', '$phv_after2', '$phv_after3', '$phv_avg_after', '$phv_temp1', '$phv_temp2', '$phv_temp3', '$phv_avg_temp', '$chk_clr', '$clr_w', '$clr_x', '$clr_y', '$clr_z', '$clr_n', '$chloride_content', '$chk_rdv', '$rdv1', '$rdv2', '$rdv3', '$avg_rdv', '$chk_dmc', '$dmc_w1', '$dmc_w2', '$dmc_w2_w1', '$dmc_w3', '$dmc_w3_w1', '$dmc_content', '$dmc_non_w1', '$dmc_non_w2', '$dmc_non_w2_w1', '$dmc_non_w3', '$dmc_non_w3_w1', '$dmc_non_content', '$ash_s_d', '$ash_e_d', '$phv_s_d', '$phv_e_d', '$clr_s_d', '$clr_e_d', '$rdv_s_d', '$rdv_e_d', '$dmc_s_d', '$dmc_e_d', '$phv_test_method', '$phv_test_req', '$phv_test_limit', '$rdv_test_method', '$rdv_test_req', '$rdv_test_limit', '$dmc_test_method', '$dmc_test_req', '$dmc_test_limit', '$ash_test_method', '$ash_test_req', '$ash_test_limit', '$clr_test_method', '$clr_test_req', '$clr_test_limit' , '$rem_data' , '$brand_data', '$amend_date')"; 

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
													 $query = "select * from `admixture` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
		
			if($_POST['ash_s_d'] == ""){$ash_s_d ="0000-00-00";}
			else{$ash_s_d = substr($_POST['ash_s_d'],6,4)."-".substr($_POST['ash_s_d'],3,2)."-".substr($_POST['ash_s_d'],0,2);}

			if($_POST['ash_e_d'] == ""){$ash_e_d ="0000-00-00";}
			else{$ash_e_d = substr($_POST['ash_e_d'],6,4)."-".substr($_POST['ash_e_d'],3,2)."-".substr($_POST['ash_e_d'],0,2);}
			
			if($_POST['phv_s_d'] == ""){$phv_s_d ="0000-00-00";}
			else{$phv_s_d = substr($_POST['phv_s_d'],6,4)."-".substr($_POST['phv_s_d'],3,2)."-".substr($_POST['phv_s_d'],0,2);}

			if($_POST['phv_e_d'] == ""){$phv_e_d ="0000-00-00";}
			else{$phv_e_d = substr($_POST['phv_e_d'],6,4)."-".substr($_POST['phv_e_d'],3,2)."-".substr($_POST['phv_e_d'],0,2);}
			
			if($_POST['clr_s_d'] == ""){$clr_s_d ="0000-00-00";}
			else{$clr_s_d = substr($_POST['clr_s_d'],6,4)."-".substr($_POST['clr_s_d'],3,2)."-".substr($_POST['clr_s_d'],0,2);}

			if($_POST['clr_e_d'] == ""){$clr_e_d ="0000-00-00";}
			else{$clr_e_d = substr($_POST['clr_e_d'],6,4)."-".substr($_POST['clr_e_d'],3,2)."-".substr($_POST['clr_e_d'],0,2);}
			
			if($_POST['rdv_s_d'] == ""){$rdv_s_d ="0000-00-00";}
			else{$rdv_s_d = substr($_POST['rdv_s_d'],6,4)."-".substr($_POST['rdv_s_d'],3,2)."-".substr($_POST['rdv_s_d'],0,2);}

			if($_POST['rdv_e_d'] == ""){$rdv_e_d ="0000-00-00";}
			else{$rdv_e_d = substr($_POST['rdv_e_d'],6,4)."-".substr($_POST['rdv_e_d'],3,2)."-".substr($_POST['rdv_e_d'],0,2);}
			
			if($_POST['dmc_s_d'] == ""){$dmc_s_d ="0000-00-00";}
			else{$dmc_s_d = substr($_POST['dmc_s_d'],6,4)."-".substr($_POST['dmc_s_d'],3,2)."-".substr($_POST['dmc_s_d'],0,2);}

			if($_POST['dmc_e_d'] == ""){$dmc_e_d ="0000-00-00";}
			else{$dmc_e_d = substr($_POST['dmc_e_d'],6,4)."-".substr($_POST['dmc_e_d'],3,2)."-".substr($_POST['dmc_e_d'],0,2);}
			
					
		
	 $update="update admixture SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,	
					`phv_test_method`='$_POST[phv_test_method]',
					`phv_test_req`='$_POST[phv_test_req]',
					`phv_test_limit`='$_POST[phv_test_limit]',
					`rdv_test_method`='$_POST[rdv_test_method]',
					`rdv_test_req`='$_POST[rdv_test_req]',
					`rdv_test_limit`='$_POST[rdv_test_limit]',
					`dmc_test_method`='$_POST[dmc_test_method]',
					`dmc_test_req`='$_POST[dmc_test_req]',
					`dmc_test_limit`='$_POST[dmc_test_limit]',
					`ash_test_method`='$_POST[ash_test_method]',
					`ash_test_req`='$_POST[ash_test_req]',
					`ash_test_limit`='$_POST[ash_test_limit]',
					`clr_test_method`='$_POST[clr_test_method]',
					`clr_test_req`='$_POST[clr_test_req]',
					`clr_test_limit`='$_POST[clr_test_limit]',
					`chk_ash`='$_POST[chk_ash]',
					`ash_w1`='$_POST[ash_w1]',
					`ash_w2`='$_POST[ash_w2]',
					`ash_w3`='$_POST[ash_w3]',
					`ash_content`='$_POST[ash_content]',
					`chk_phv`='$_POST[chk_phv]',
					`phv_before1`='$_POST[phv_before1]',
					`phv_before2`='$_POST[phv_before2]',
					`phv_before3`='$_POST[phv_before3]',
					`phv_avg_before`='$_POST[phv_avg_before]',
					`phv_after1`='$_POST[phv_after1]',
					`phv_after2`='$_POST[phv_after2]',
					`phv_after3`='$_POST[phv_after3]',
					`phv_avg_after`='$_POST[phv_avg_after]',
					`phv_temp1`='$_POST[phv_temp1]',
					`phv_temp2`='$_POST[phv_temp2]',
					`phv_temp3`='$_POST[phv_temp3]',
					`phv_avg_temp`='$_POST[phv_avg_temp]',
					`chk_clr`='$_POST[chk_clr]',
					`clr_w`='$_POST[clr_w]',
					`clr_x`='$_POST[clr_x]',
					`clr_y`='$_POST[clr_y]',
					`clr_z`='$_POST[clr_z]',
					`clr_n`='$_POST[clr_n]',
					`chloride_content`='$_POST[chloride_content]',
					`chk_rdv`='$_POST[chk_rdv]',
					`rdv1`='$_POST[rdv1]',
					`rdv2`='$_POST[rdv2]',
					`rdv3`='$_POST[rdv3]',
					`avg_rdv`='$_POST[avg_rdv]',
					`chk_dmc`='$_POST[chk_dmc]',
					`dmc_w1`='$_POST[dmc_w1]',
					`dmc_w2`='$_POST[dmc_w2]',
					`dmc_w2_w1`='$_POST[dmc_w2_w1]',
					`dmc_w3`='$_POST[dmc_w3]',
					`dmc_w3_w1`='$_POST[dmc_w3_w1]',
					`dmc_content`='$_POST[dmc_content]',
					`dmc_non_w1`='$_POST[dmc_non_w1]',
					`dmc_non_w2`='$_POST[dmc_non_w2]',
					`dmc_non_w2_w1`='$_POST[dmc_non_w2_w1]',
					`dmc_non_w3`='$_POST[dmc_non_w3]',
					`dmc_non_w3_w1`='$_POST[dmc_non_w3_w1]',
					`dmc_non_content`='$_POST[dmc_non_content]',
					`ash_s_d`='$_POST[ash_s_d]',
					`ash_e_d`='$_POST[ash_e_d]',
					`phv_s_d`='$_POST[phv_s_d]',
					`phv_e_d`='$_POST[phv_e_d]',
					`clr_s_d`='$_POST[clr_s_d]',
					`clr_e_d`='$_POST[clr_e_d]',
					`rdv_s_d`='$_POST[rdv_s_d]',
					`rdv_e_d`='$_POST[rdv_e_d]',
					`dmc_s_d`='$_POST[dmc_s_d]',
					`dmc_e_d`='$_POST[dmc_e_d]',
					`rem_data`='$_POST[rem_data]',
					`brand_data`='$_POST[brand_data]',
					`amend_date`='$_POST[amend_date]'
					
				  WHERE `id`='$_POST[idEdit]'";


		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete')
	{
		
		 $delete="update admixture SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk')
	{
		
		$qry = "SELECT * FROM admixture WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update admixture SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update admixture SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>