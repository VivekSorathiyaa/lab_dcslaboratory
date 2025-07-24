<?php

session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from murrum WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'chk_grn' => $result['chk_grain'],
							'chk_attr' => $result['chk_attr'],
							'chk_shrink' => $result['chk_shrink'],
							'chk_swell' => $result['chk_swell'],
							'chk_class' => $result['chk_class'],
							'chk_light' => $result['chk_light'],
							'chk_heavy' => $result['chk_heavy'],
							'chk_sp' => $result['chk_sp'],
							'chk_duu' => $result['chk_duu'],
							'chk_con' => $result['chk_con'],
							'chk_cbr1' => $result['chk_cbr1'],
							'chk_cbr2' => $result['chk_cbr2'],
							'chk_uu' => $result['chk_uu'],
							'chk_den' => $result['chk_den'],
							'chk_ucs' => $result['chk_ucs'],
							'chk_press' => $result['chk_press'],
							'g1' => $result['g1'],							
							'g2' => $result['g2'],
							'g3' => $result['g3'],
							'g4' => $result['g4'],
							'a1' => $result['a1'],							
							'a2' => $result['a2'],							
							'a3' => $result['a3'],							
							's1' => $result['s1'],							
							'f1' => $result['f1'],							
							'so1' => $result['so1'],														
							'l1' => $result['l1'],							
							'l2' => $result['l2'],							
							'h1' => $result['h1'],							
							'h2' => $result['h2'],							
							'sp1' => $result['sp1'],							
							'd1' => $result['d1'],							
							'd2' => $result['d2'],
							'c1' => $result['c1'],							
							'c2' => $result['c2'],
							'cbr1' => $result['cbr1'],
							'cbr2' => $result['cbr2'],
							't1' => $result['t1'],							
							't2' => $result['t2'],
							'u1' => $result['u1'],
							'r1' => $result['r1'],
							'sw1' => $result['sw1'],
							'grd_1' => $result['grd_1'],
							'grd_2' => $result['grd_2'],
							'grd_3' => $result['grd_3'],
							'grd_4' => $result['grd_4'],
							'grd_5' => $result['grd_5'],
							'grd_6' => $result['grd_6']
							
 							
							
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
			$chk_grn = $_POST['chk_grn'];
			$chk_attr = $_POST['chk_attr'];
			$chk_shrink = $_POST['chk_shrink'];
			$chk_swell = $_POST['chk_swell'];
			$chk_class = $_POST['chk_class'];
			$chk_light = $_POST['chk_light'];
			$chk_heavy = $_POST['chk_heavy'];
			$chk_sp = $_POST['chk_sp'];
			$chk_duu = $_POST['chk_duu'];
			$chk_con = $_POST['chk_con'];
			$chk_cbr1 = $_POST['chk_cbr1'];
			$chk_cbr2 = $_POST['chk_cbr2'];
			$chk_uu = $_POST['chk_uu'];
			$chk_den = $_POST['chk_den'];
			$chk_ucs = $_POST['chk_ucs'];
			$chk_press = $_POST['chk_press'];
			$g1 = $_POST['g1'];							
			$g2 = $_POST['g2'];
			$g3 = $_POST['g3'];
			$g4 = $_POST['g4'];
			$a1 = $_POST['a1'];							
			$a2 = $_POST['a2'];							
			$a3 = $_POST['a3'];							
			$s1 = $_POST['s1'];							
			$f1 = $_POST['f1'];							
			$so1 = $_POST['so1'];														
			$l1 = $_POST['l1'];							
			$l2 = $_POST['l2'];							
			$h1 = $_POST['h1'];							
			$h2 = $_POST['h2'];						
			$sp1 = $_POST['sp1'];
			$d1 = $_POST['d1'];							
			$d2 = $_POST['d2'];
			$c1 = $_POST['c1'];							
			$c2 = $_POST['c2'];
			$cbr1 = $_POST['cbr1'];
			$cbr2 = $_POST['cbr2'];
			$t1 = $_POST['t1'];							
			$t2 = $_POST['t2'];
			$u1 = $_POST['u1'];
			$r1 = $_POST['r1'];
			$sw1 = $_POST['sw1'];	
			$grd_1 = $_POST['grd_1'];	
			$grd_2 = $_POST['grd_2'];	
			$grd_3 = $_POST['grd_3'];	
			$grd_4 = $_POST['grd_4'];	
			$grd_5 = $_POST['grd_5'];	
			$grd_6 = $_POST['grd_6'];	
			
									
			
			$curr_date=date("Y-m-d");
					
		 $insert="INSERT INTO `murrum`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_grain`, `g1`, `g2`, `g3`, `g4`, `chk_attr`, `a1`, `a2`, `a3`, `chk_shrink`, `s1`, `chk_swell`, `f1`, `chk_class`, `so1`, `chk_light`, `l1`, `l2`, `chk_heavy`, `h1`, `h2`, `chk_sp`, `sp1`, `chk_duu`, `d1`, `d2`, `chk_con`, `c1`, `c2`, `chk_cbr1`, `cbr1`, `chk_cbr2`, `cbr2`, `chk_uu`, `t1`, `t2`, `chk_den`, `r1`, `chk_ucs`, `u1`, `chk_press`, `sw1`, `grd_1`, `grd_2`, `grd_3`, `grd_4`, `grd_5`, `grd_6`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_grn', '$g1', '$g2', '$g3', '$g4', '$chk_attr', '$a1', '$a2', '$a3', '$chk_shrink', '$s1', '$chk_swell', '$f1', '$chk_class', '$so1', '$chk_light', '$l1', '$l2', '$chk_heavy', '$h1', '$h2', '$chk_sp', '$sp1', '$chk_duu', '$d1', '$d2', '$chk_con', '$c1', '$c2', '$chk_cbr1', '$cbr1', '$chk_cbr2', '$cbr2', '$chk_uu', '$t1', '$t2', '$chk_den', '$r1', '$chk_ucs', '$u1', '$chk_press', '$sw1', '$grd_1', '$grd_2', '$grd_3', '$grd_4', '$grd_5', '$grd_6')"; 
			
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
													 $query = "select * from `murrum` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
		$ulr = $_POST['ulr'];
		$chk_grain = $_POST['chk_grn'];
			$chk_attr = $_POST['chk_attr'];
			$chk_shrink = $_POST['chk_shrink'];
			$chk_swell = $_POST['chk_swell'];
			$chk_class = $_POST['chk_class'];
			$chk_light = $_POST['chk_light'];
			$chk_heavy = $_POST['chk_heavy'];
			$chk_sp = $_POST['chk_sp'];
			$chk_duu = $_POST['chk_duu'];
			$chk_con = $_POST['chk_con'];
			$chk_cbr1 = $_POST['chk_cbr1'];
			$chk_cbr2 = $_POST['chk_cbr2'];
			$chk_uu = $_POST['chk_uu'];
			$chk_den = $_POST['chk_den'];
			$chk_ucs = $_POST['chk_ucs'];
			$chk_press = $_POST['chk_press'];
			$g1 = $_POST['g1'];							
			$g2 = $_POST['g2'];
			$g3 = $_POST['g3'];
			$g4 = $_POST['g4'];
			$a1 = $_POST['a1'];							
			$a2 = $_POST['a2'];							
			$a3 = $_POST['a3'];							
			$s1 = $_POST['s1'];							
			$f1 = $_POST['f1'];							
			$so1 = $_POST['so1'];														
			$l1 = $_POST['l1'];							
			$l2 = $_POST['l2'];							
			$h1 = $_POST['h1'];							
			$h2 = $_POST['h2'];						
			$sp1 = $_POST['sp1'];
			$d1 = $_POST['d1'];							
			$d2 = $_POST['d2'];
			$c1 = $_POST['c1'];							
			$c2 = $_POST['c2'];
			$cbr1 = $_POST['cbr1'];
			$cbr2 = $_POST['cbr2'];
			$t1 = $_POST['t1'];							
			$t2 = $_POST['t2'];
			$u1 = $_POST['u1'];
			$r1 = $_POST['r1'];
			$sw1 = $_POST['sw1'];	
			$grd_1 = $_POST['grd_1'];	
			$grd_2 = $_POST['grd_2'];	
			$grd_3 = $_POST['grd_3'];	
			$grd_4 = $_POST['grd_4'];	
			$grd_5 = $_POST['grd_5'];	
			$grd_6 = $_POST['grd_6'];	
			
				
		
	  $update="update murrum SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 				 	 	 				
				 `ulr`='$ulr',
				 `chk_attr`='$chk_attr',
				 `chk_shrink`='$chk_shrink',
				 `chk_swell`='$chk_swell',
				 `chk_class`='$chk_class',
				 `chk_light`='$chk_light',
				 `chk_heavy`='$chk_heavy',
				 `chk_sp`='$chk_sp',
				 `chk_duu`='$chk_duu',
				 `chk_con`='$chk_con',
				 `chk_cbr1`='$chk_cbr1',
				 `chk_cbr2`='$chk_cbr2',
				 `chk_uu`='$chk_uu',
				 `chk_den`='$chk_den',
				 `chk_ucs`='$chk_ucs',
				 `chk_press`='$chk_press',
				 `chk_grain`='$chk_grain',
				 `g1`='$g1',
				 `g2`='$g2',
				 `g3`='$g3',
				 `g4`='$g4',
				 `a1`='$a1',
				 `a2`='$a2',
				 `a3`='$a3',
				 `s1`='$s1',
				 `f1`='$f1',
				 `so1`='$so1',
				 `l1`='$l1',
				 `l2`='$l2',
				 `h1`='$h1',
				 `h2`='$h2',
				 `sp1`='$sp1',
				 `d1`='$d1',
				 `d2`='$d2',
				 `c1`='$c1',
				 `c2`='$c2',
				 `cbr1`='$cbr1',
				 `cbr2`='$cbr2',
				 `t1`='$t1',
				 `t2`='$t2',
				 `r1`='$r1',
				 `u1`='$u1',
				 `sw1`='$sw1',				 
				 `grd_1`='$grd_1',				 
				 `grd_2`='$grd_2',				 
				 `grd_3`='$grd_3',				 
				 `grd_4`='$grd_4',				 
				 `grd_5`='$grd_5',				 
				 `grd_6`='$grd_6'				 
				  WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update murrum SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);		
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM murrum WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update murrum SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update murrum SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
			
			
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>