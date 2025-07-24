<?php
session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from bitumin_span_mix WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'chk_msf' => $result['chk_msf'],
							'avg_stabilty' => $result['avg_stabilty'],							
							'avg_flow' => $result['avg_flow'],							
							'Location_1' => $result['Location_1'],							
							'ms_11' => $result['ms_11'],							
							'ms_12' => $result['ms_12'],							
							'ms_13' => $result['ms_13'],
							'ms_21' => $result['ms_21'],							
							'ms_22' => $result['ms_22'],							
							'ms_23' => $result['ms_23'],
							'ms_31' => $result['ms_31'],							
							'ms_32' => $result['ms_32'],							
							'ms_33' => $result['ms_33'],							
							'chk_cdm' => $result['chk_cdm'],							
							'avg_density' => $result['avg_density'],
							's1' => $result['s1'],
							's2' => $result['s2'],
							's3' => $result['s3'],
							'a1' => $result['a1'],
							'a2' => $result['a2'],
							'a3' => $result['a3'],
							'b1' => $result['b1'],
							'b2' => $result['b2'],
							'b3' => $result['b3'],
							'c1' => $result['c1'],
							'c2' => $result['c2'],
							'c3' => $result['c3'],
							'd1' => $result['d1'],
							'd2' => $result['d2'],
							'd3' => $result['d3'],
							'e1' => $result['e1'],
							'e2' => $result['e2'],
							'e3' => $result['e3'],
							'chk_bin' => $result['chk_bin'],
							'per_bin1' => $result['per_bin1'],
							'per_bin2' => $result['per_bin2'],
							'avg_bin' => $result['avg_bin'],
							'b11' => $result['b11'],							
							'b12' => $result['b12'],							
							'b21' => $result['b21'],							
							'b22' => $result['b22'],							
							'b31' => $result['b31'],							
							'b32' => $result['b32'],							
							'b41' => $result['b41'],							
							'b42' => $result['b42'],							
							'b51' => $result['b51'],							
							'b52' => $result['b52'],							
							'b61' => $result['b61'],							
							'b62' => $result['b62'],							
							'b71' => $result['b71'],							
							'b72' => $result['b72'],							
							'b81' => $result['b81'],							
							'b82' => $result['b82'],
							
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
			$ulr=$_POST['ulr'];			
				
					
			$chk_msf = $_POST['chk_msf'];
			$avg_stabilty = $_POST['avg_stabilty'];
			$avg_flow = $_POST['avg_flow'];
			$Location_1 = $_POST['Location_1'];
			$ms_11 = $_POST['ms_11'];
			$ms_12 = $_POST['ms_12'];
			$ms_13 = $_POST['ms_13'];
			$ms_21 = $_POST['ms_21'];
			$ms_22 = $_POST['ms_22'];
			$ms_23 = $_POST['ms_23'];
			$ms_31 = $_POST['ms_31'];
			$ms_32 = $_POST['ms_32'];
			$ms_33 = $_POST['ms_33'];	
			
			$chk_cdm = $_POST['chk_cdm'];			
			$avg_density = $_POST['avg_density'];					
			$s1 = $_POST['s1'];			
			$s2 = $_POST['s2'];
			$s3 = $_POST['s3'];
			$a1 = $_POST['a1'];			
			$a2 = $_POST['a2'];
			$a3 = $_POST['a3'];
			$b1 = $_POST['b1'];			
			$b2 = $_POST['b2'];
			$b3 = $_POST['b3'];
			$c1 = $_POST['c1'];			
			$c2 = $_POST['c2'];
			$c3 = $_POST['c3'];
			$d1 = $_POST['d1'];			
			$d2 = $_POST['d2'];
			$d3 = $_POST['d3'];
			$e1 = $_POST['e1'];			
			$e2 = $_POST['e2'];
			$e3 = $_POST['e3'];
			
			
			$chk_bin = $_POST['chk_bin'];
			$per_bin1 = $_POST['per_bin1'];
			$per_bin2 = $_POST['per_bin2'];
			$avg_bin = $_POST['avg_bin'];		
			
			$b11 = $_POST['b11'];
			$b12 = $_POST['b12'];
			$b21 = $_POST['b21'];
			$b22 = $_POST['b22'];
			$b31 = $_POST['b31'];
			$b32 = $_POST['b32'];
			$b41 = $_POST['b41'];
			$b42 = $_POST['b42'];
			$b51 = $_POST['b51'];
			$b52 = $_POST['b52'];
			$b61 = $_POST['b61'];
			$b62 = $_POST['b62'];
			$b71 = $_POST['b71'];
			$b72 = $_POST['b72'];
			$b81 = $_POST['b81'];
			$b82 = $_POST['b82'];
			
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
			
			$curr_date=date("Y-m-d");
			
			
		
		
			$insert="insert into bitumin_span_mix (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_msf`, `ms_11`, `ms_12`, `ms_13`, `ms_21`, `ms_22`, `ms_23`, `ms_31`, `ms_32`, `ms_33`, `avg_stabilty`, `avg_flow`, `chk_cdm`, `s1`, `s2`, `s3`, `a1`, `a2`, `a3`, `b1`, `b2`, `b3`, `c1`, `c2`, `c3`, `d1`, `d2`, `d3`, `e1`, `e2`, `e3`, `avg_density`, `chk_bin`, `b11`, `b12`, `b21`, `b22`, `b31`, `b32`, `b41`, `b42`, `b51`, `b52`, `b61`, `b62`, `b71`, `b72`, `b81`, `b82`, `per_bin1`, `per_bin2`, `avg_bin`, `Location_1`,`tw1`,`tw2`,`tw3`,`tw4`,`tw5`,`tw6`,`tw7`,`tw8`,`tw9`,`tw10`,`tw11`,`tw12`,`tw13`,`tw14`,`tw15`,`tw16`,`tw17`,`tw18`,`tw19`,`tw20`,`tw21`,`tw22`,`sf1`,`sf2`,`sf3`,`sf4`,`sf5`,`sf6`,`sf7`,`sf8`,`sf9`,`sf10`,`sf11`,`bn_1`,`bn_2`) values
			('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_msf', '$ms_11', '$ms_12', '$ms_13', '$ms_21', '$ms_22', '$ms_23', '$ms_31', '$ms_32', '$ms_33', '$avg_stabilty', '$avg_flow', '$chk_cdm', '$s1', '$s2', '$s3', '$a1', '$a2', '$a3', '$b1', '$b2', '$b3', '$c1', '$c2', '$c3', '$d1', '$d2', '$d3', '$e1', '$e2', '$e3', '$avg_density', '$chk_bin', '$b11', '$b12', '$b21', '$b22', '$b31', '$b32', '$b41', '$b42', '$b51', '$b52', '$b61', '$b62', '$b71', '$b72', '$b81', '$b82', '$per_bin1', '$per_bin2', '$avg_bin', '$Location_1','$tw1','$tw2','$tw3','$tw4','$tw5','$tw6','$tw7','$tw8','$tw9','$tw10','$tw11','$tw12','$tw13','$tw14','$tw15','$tw16','$tw17','$tw18','$tw19','$tw20','$tw21','$tw22','$sf1','$sf2','$sf3','$sf4','$sf5','$sf6','$sf7','$sf8','$sf9','$sf10','$sf11','$bn_1','$bn_2')"; 

				
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
													 $query = "select * from bitumin_span_mix WHERE lab_no='$lab_no' and `is_deleted`='0'";
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
		 $update="update bitumin_span_mix SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',`chk_msf`='$_POST[chk_msf]',`avg_stabilty`='$_POST[avg_stabilty]',`avg_flow`='$_POST[avg_flow]',`ms_11`='$_POST[ms_11]',`ms_12`='$_POST[ms_12]',`ms_13`='$_POST[ms_13]',`ms_21`='$_POST[ms_21]',`ms_22`='$_POST[ms_22]',`ms_23`='$_POST[ms_23]',`ms_31`='$_POST[ms_31]',`ms_32`='$_POST[ms_32]',`ms_33`='$_POST[ms_33]',`chk_cdm`='$_POST[chk_cdm]',`avg_density`='$_POST[avg_density]',`s1`='$_POST[s1]',`s2`='$_POST[s2]',`s3`='$_POST[s3]',`a1`='$_POST[a1]',`a2`='$_POST[a2]',`a3`='$_POST[a3]',`b1`='$_POST[a1]',`b2`='$_POST[b2]',`b3`='$_POST[b3]',`c1`='$_POST[c1]',`c2`='$_POST[c2]',`c3`='$_POST[c3]',`d1`='$_POST[d1]',`d2`='$_POST[d2]',`d3`='$_POST[d3]',`e1`='$_POST[e1]',`e2`='$_POST[e2]',`e3`='$_POST[e3]',`chk_bin`='$_POST[chk_bin]',`per_bin1`='$_POST[per_bin1]',`per_bin2`='$_POST[per_bin2]',`avg_bin`='$_POST[avg_bin]',`b11`='$_POST[b11]',
		 `b12`='$_POST[b12]',
		 `b21`='$_POST[b21]',
		 `b22`='$_POST[b22]',
		 `b31`='$_POST[b31]',
		 `b32`='$_POST[b32]',
		 `b41`='$_POST[b41]',
		 `b42`='$_POST[b42]',
		 `b51`='$_POST[b51]',
		 `b52`='$_POST[b52]',
		 `b61`='$_POST[b61]',
		 `b62`='$_POST[b62]',
		 `b71`='$_POST[b71]',
		 `b72`='$_POST[b72]',
		 `b81`='$_POST[b81]',
		 `b82`='$_POST[b82]',
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

		 
		 `Location_1`='$_POST[Location_1]',
		 `checked_by`=NULL WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
	elseif($_POST['action_type'] == 'delete'){
		 $delete="update bitumin_span_mix SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		$result_of_delete=mysqli_query($conn,$delete);	
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }	
	elseif($_POST['action_type'] == 'chk'){
		$qry = "SELECT * FROM bitumin_span_mix WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update bitumin_span_mix SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update bitumin_span_mix SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
				}
			}
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
    exit;
}
?>