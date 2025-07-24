<?php

session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from dcp WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'chk_cbr' => $result['chk_cbr'],																				
							'f1' => $result['f1'],							
							'f2' => $result['f2'],
							't1' => $result['t1'],							
							't2' => $result['t2'],							
							's1' => $result['s1'],							
							's2' => $result['s2'],							
							'p1' => $result['p1'],							
							'p2' => $result['p2'],							
							'b1' => $result['b1'],							
							'b2' => $result['b2'],							
							'c1' => $result['c1'],							
							'c2' => $result['c2'],
							'avg_c' => $result['avg_c'],
							'cbr' => $result['cbr'],
							'layer_mt' => $result['layer_mt'],
							'field_mos' => $result['field_mos'],
							'hsr_0' => $result['hsr_0'],
							'hsr_1' => $result['hsr_1'],
							'hsr_2' => $result['hsr_2'],
							'hsr_3' => $result['hsr_3'],
							'hsr_4' => $result['hsr_4'],
							'hsr_5' => $result['hsr_5'],
							'hsr_6' => $result['hsr_6'],
							'hsr_7' => $result['hsr_7'],
							'hsr_8' => $result['hsr_8'],
							'hsr_9' => $result['hsr_9'],
							'hsr_10' => $result['hsr_10'],
							'hsr_11' => $result['hsr_11'],
							'hsr_12' => $result['hsr_12'],
							'hsr_13' => $result['hsr_13'],
							'hsr_14' => $result['hsr_14'],
							'hsr_15' => $result['hsr_15'],
							'hsr_16' => $result['hsr_16'],
							'hsr_17' => $result['hsr_17'],
							'hsr_18' => $result['hsr_18'],
							'hsr_19' => $result['hsr_19'],
							'hsr_20' => $result['hsr_20'],
							'hsr_21' => $result['hsr_21'],
							'hsr_22' => $result['hsr_22'],
							'hsr_23' => $result['hsr_23'],
							'hsr_24' => $result['hsr_24'],
							'hsr_25' => $result['hsr_25'],
							'hsr_26' => $result['hsr_26'],
							'hsr_27' => $result['hsr_27'],
							'hsr_28' => $result['hsr_28'],
							'hsr_29' => $result['hsr_29'],
							'hsr_30' => $result['hsr_30'],
							'hsr_31' => $result['hsr_31'],
							'hsr_32' => $result['hsr_32'],
							'hsr_33' => $result['hsr_33'],
							'hsr_34' => $result['hsr_34'],
							'hsr_35' => $result['hsr_35'],
							'hsr_36' => $result['hsr_36'],
							'hsr_37' => $result['hsr_37'],
							'hsr_38' => $result['hsr_38'],
							'hsr_39' => $result['hsr_39'],
							'hsr_40' => $result['hsr_40'],
							'hsr_41' => $result['hsr_41']
							
							
 							
							
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
					
			$chk_cbr =  $_POST['chk_cbr'];	
			
			
			$f1 = $_POST['f1'];
			$f2 = $_POST['f2'];
			$t1 = $_POST['t1'];
			$t2 = $_POST['t2'];
			$s1 = $_POST['s1'];
			$s2 = $_POST['s2'];
			$p1 = $_POST['p1'];
			$p2 = $_POST['p2'];
			$b1 = $_POST['b1'];
			$b2 = $_POST['b2'];
			$c1 = $_POST['c1'];
			$c2 = $_POST['c2'];
			$avg_c = $_POST['avg_c'];
			$cbr = $_POST['cbr'];
			$layer_mt = $_POST['layer_mt'];
			$field_mos = $_POST['field_mos'];
			$hsr_0 = $_POST['hsr_0'];
			$hsr_1 = $_POST['hsr_1'];
			$hsr_2 = $_POST['hsr_2'];
			$hsr_3 = $_POST['hsr_3'];
			$hsr_4 = $_POST['hsr_4'];
			$hsr_5 = $_POST['hsr_5'];
			$hsr_6 = $_POST['hsr_6'];
			$hsr_7 = $_POST['hsr_7'];
			$hsr_8 = $_POST['hsr_8'];
			$hsr_9 = $_POST['hsr_9'];
			$hsr_10 = $_POST['hsr_10'];
			$hsr_11 = $_POST['hsr_11'];
			$hsr_12 = $_POST['hsr_12'];
			$hsr_13 = $_POST['hsr_13'];
			$hsr_14 = $_POST['hsr_14'];
			$hsr_15 = $_POST['hsr_15'];
			$hsr_16 = $_POST['hsr_16'];
			$hsr_17 = $_POST['hsr_17'];
			$hsr_18 = $_POST['hsr_18'];
			$hsr_19 = $_POST['hsr_19'];
			$hsr_20 = $_POST['hsr_20'];
			$hsr_21 = $_POST['hsr_21'];
			$hsr_22 = $_POST['hsr_22'];
			$hsr_23 = $_POST['hsr_23'];
			$hsr_24 = $_POST['hsr_24'];
			$hsr_25 = $_POST['hsr_25'];
			$hsr_26 = $_POST['hsr_26'];
			$hsr_27 = $_POST['hsr_27'];
			$hsr_28 = $_POST['hsr_28'];
			$hsr_29 = $_POST['hsr_29'];
			$hsr_30 = $_POST['hsr_30'];
			$hsr_31 = $_POST['hsr_31'];
			$hsr_32 = $_POST['hsr_32'];
			$hsr_33 = $_POST['hsr_33'];
			$hsr_34 = $_POST['hsr_34'];
			$hsr_35 = $_POST['hsr_35'];
			$hsr_36 = $_POST['hsr_36'];
			$hsr_37 = $_POST['hsr_37'];
			$hsr_38 = $_POST['hsr_38'];
			$hsr_39 = $_POST['hsr_39'];
			$hsr_40 = $_POST['hsr_40'];
			$hsr_41 = $_POST['hsr_41'];
			
			
									
			
			$curr_date=date("Y-m-d");
					
		 $insert="INSERT INTO `dcp`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `f1`, `f2`, `t1`, `t2`, `s1`, `s2`, `p1`, `p2`, `b1`, `b2`, `c1`, `c2`, `avg_c`, `chk_cbr`, `cbr`, `layer_mt`, `field_mos`, `hsr_0`, `hsr_1`, `hsr_2`, `hsr_3`, `hsr_4`, `hsr_5`, `hsr_6`, `hsr_7`, `hsr_8`, `hsr_9`, `hsr_10`, `hsr_11`, `hsr_12`, `hsr_13`, `hsr_14`, `hsr_15`, `hsr_16`, `hsr_17`, `hsr_18`, `hsr_19`, `hsr_20`, `hsr_21`, `hsr_22`, `hsr_23`, `hsr_24`, `hsr_25`, `hsr_26`, `hsr_27`, `hsr_28`, `hsr_29`, `hsr_30`, `hsr_31`, `hsr_32`, `hsr_33`, `hsr_34`, `hsr_35`, `hsr_36`, `hsr_37`, `hsr_38`, `hsr_39`, `hsr_40`, `hsr_41`, `amend_date`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$f1','$f2','$t1','$t2','$s1','$s2','$p1','$p2','$b1','$b2','$c1','$c2','$avg_c','$chk_cbr','$cbr','$layer_mt','$field_mos','$hsr_0','$hsr_1','$hsr_2','$hsr_3','$hsr_4','$hsr_5','$hsr_6','$hsr_7','$hsr_8','$hsr_9','$hsr_10','$hsr_11','$hsr_12','$hsr_13','$hsr_14','$hsr_15','$hsr_16','$hsr_17','$hsr_18','$hsr_19','$hsr_20','$hsr_21','$hsr_22','$hsr_23','$hsr_24','$hsr_25','$hsr_26','$hsr_27','$hsr_28','$hsr_29','$hsr_30','$hsr_31','$hsr_32','$hsr_33','$hsr_34','$hsr_35','$hsr_36','$hsr_37','$hsr_38','$hsr_39','$hsr_40', '$hsr_41', '$amend_date')"; 
			
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
													 $query = "select * from `dcp` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
			
			
				
		
	  $update="update dcp SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
					 `modified_by`='$_SESSION[name]',
					 `modified_date`='$curr_date',					
					 `checked_by`=NULL,					 				 	 	 				
				 `ulr`='$_POST[ulr]',
				 `chk_cbr`='$_POST[chk_cbr]',
				 `f1`='$_POST[f1]',
				 `f2`='$_POST[f2]',
				 `t1`='$_POST[t1]',
				 `t2`='$_POST[t2]',
				 `s1`='$_POST[s1]',
				 `s2`='$_POST[s2]',
				 `p1`='$_POST[p1]',
				 `p2`='$_POST[p2]',
				 `b1`='$_POST[b1]',
				 `b2`='$_POST[b2]',
				 `c1`='$_POST[c1]',
				 `c2`='$_POST[c2]',
				 `avg_c`='$_POST[avg_c]',
				 `layer_mt`='$_POST[layer_mt]',
				 `field_mos`='$_POST[field_mos]',
				 `hsr_0`='$_POST[hsr_0]',
				 `hsr_1`='$_POST[hsr_1]',
				 `hsr_2`='$_POST[hsr_2]',
				 `hsr_3`='$_POST[hsr_3]',
				 `hsr_4`='$_POST[hsr_4]',
				 `hsr_5`='$_POST[hsr_5]',
				 `hsr_6`='$_POST[hsr_6]',
				 `hsr_7`='$_POST[hsr_7]',
				 `hsr_8`='$_POST[hsr_8]',
				 `hsr_9`='$_POST[hsr_9]',
				 `hsr_10`='$_POST[hsr_10]',
				 `hsr_11`='$_POST[hsr_11]',
				 `hsr_12`='$_POST[hsr_12]',
				 `hsr_13`='$_POST[hsr_13]',
				 `hsr_14`='$_POST[hsr_14]',
				 `hsr_15`='$_POST[hsr_15]',
				 `hsr_16`='$_POST[hsr_16]',
				 `hsr_17`='$_POST[hsr_17]',
				 `hsr_18`='$_POST[hsr_18]',
				 `hsr_19`='$_POST[hsr_19]',
				 `hsr_20`='$_POST[hsr_20]',
				 `hsr_21`='$_POST[hsr_21]',
				 `hsr_22`='$_POST[hsr_22]',
				 `hsr_23`='$_POST[hsr_23]',
				 `hsr_24`='$_POST[hsr_24]',
				 `hsr_25`='$_POST[hsr_25]',
				 `hsr_26`='$_POST[hsr_26]',
				 `hsr_27`='$_POST[hsr_27]',
				 `hsr_28`='$_POST[hsr_28]',
				 `hsr_29`='$_POST[hsr_29]',
				 `hsr_30`='$_POST[hsr_30]',
				 `hsr_31`='$_POST[hsr_31]',
				 `hsr_32`='$_POST[hsr_32]',
				 `hsr_33`='$_POST[hsr_33]',
				 `hsr_34`='$_POST[hsr_34]',
				 `hsr_35`='$_POST[hsr_35]',
				 `hsr_36`='$_POST[hsr_36]',
				 `hsr_37`='$_POST[hsr_37]',
				 `hsr_38`='$_POST[hsr_38]',
				 `hsr_39`='$_POST[hsr_39]',
				 `hsr_40`='$_POST[hsr_40]',
				 `hsr_41`='$_POST[hsr_41]',
				 `avg_c`='$_POST[avg_c]',
				 `cbr`='$_POST[cbr]',
				 `amend_date`='$_POST[amend_date]'
				  WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update dcp SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM dcp WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update dcp SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update dcp SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
			
			
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>