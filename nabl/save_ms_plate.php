<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from `ms_plate` WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'tube_temp' => $result['tube_temp'],
							'tube_temp2' => $result['tube_temp2'],
							'tube_humidity' => $result['tube_humidity'],
							'chk_dia' => $result['chk_dia'],
							'chk_elo' => $result['chk_elo'],
							'chk_ten' => $result['chk_ten'],
							'chk_yled' => $result['chk_yled'],
							'chk_thk' => $result['chk_thk'],
							'chk_mass' => $result['chk_mass'],
							'chk_bend' => $result['chk_bend'],
							'bend1' => $result['bend1'],
							'bend12' => $result['bend12'],
							'ms_grade' => $result['ms_grade'],
							'l1' => $result['l1'],
							'l12' => $result['l12'],
							'w1' => $result['w1'],
							'w12' => $result['w12'],
							't1' => $result['t1'],
							't12' => $result['t12'],
							'out1' => $result['out1'],
							'out12' => $result['out12'],
							'weight1' => $result['weight1'],
							'weight12' => $result['weight12'],
							'len1' => $result['len1'],
							'len12' => $result['len12'],
							'mass1' => $result['mass1'],						
							'mass12' => $result['mass12'],						
							'dia1' => $result['dia1'],						
							'dia12' => $result['dia12'],						
							'width1' => $result['width1'],						
							'width12' => $result['width12'],						
							'thk1' => $result['thk1'],						
							'thk12' => $result['thk12'],						
							'area1' => $result['area1'],						
							'area12' => $result['area12'],						
							'load1' => $result['load1'],						
							'load12' => $result['load12'],						
							'str1' => $result['str1'],						
							'str12' => $result['str12'],						
							'ult1' => $result['ult1'],						
							'ult12' => $result['ult12'],						
							'ten1' => $result['ten1'],						
							'ten12' => $result['ten12'],						
							'initial1' => $result['initial1'],						
							'initial12' => $result['initial12'],						
							'final1' => $result['final1'],											
							'final12' => $result['final12'],											
							'elo1' => $result['elo1'],						
							'elo12' => $result['elo12'],						
							'location1' => $result['location1'],
							'location12' => $result['location12'],
							'chk_chem' => $result['chk_chem'],
							'c1' => $result['c1'],
							'c2' => $result['c2'],
							'c3' => $result['c3'],
							'c4' => $result['c4'],
							'c5' => $result['c5'],
							'c6' => $result['c6'],
							'c7' => $result['c7'],
							'c8' => $result['c8'],
							'c9' => $result['c9'],
							'c10' => $result['c10'],
							'c11' => $result['c11'],
							'c12' => $result['c12'],
							'c13' => $result['c13'],
							'c14' => $result['c14'],							
							'chk_two' => $result['chk_two'],
							'amend_date' => $result['amend_date']							
												
						);	  
			echo json_encode($fill);
		}
		
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];			
			$ulr =  $_POST['ulr'];	
			$tube_humidity =  $_POST['tube_humidity'];	
			$tube_temp =  $_POST['tube_temp'];	
			$tube_temp2 =  $_POST['tube_temp2'];	
			
			$chk_two =  $_POST['chk_two'];
			$chk_dia =  $_POST['chk_dia'];
			$chk_elo =  $_POST['chk_elo'];
			$chk_ten =  $_POST['chk_ten'];
			$chk_yled =  $_POST['chk_yled'];
			$chk_thk =  $_POST['chk_thk'];
			$chk_mass =  $_POST['chk_mass'];
			$chk_bend =  $_POST['chk_bend'];
			$bend1 =  $_POST['bend1'];
			$bend12 =  $_POST['bend12'];
			$ms_grade =  $_POST['ms_grade'];
			$l1 =  $_POST['l1'];
			$l12 =  $_POST['l12'];
			$w1 =  $_POST['w1'];
			$w12 =  $_POST['w12'];
			$t1 =  $_POST['t1'];
			$t12 =  $_POST['t12'];
			$out1 =  $_POST['out1'];
			$out12 =  $_POST['out12'];
			$weight1 =  $_POST['weight1'];
			$weight12 =  $_POST['weight12'];
			$len1 =  $_POST['len1'];
			$len12 =  $_POST['len12'];
			$mass1 =  $_POST['mass1'];						
			$mass12 =  $_POST['mass12'];						
			$dia1 =  $_POST['dia1'];						
			$dia12 =  $_POST['dia12'];						
			$width1 =  $_POST['width1'];						
			$width12 =  $_POST['width12'];						
			$thk1 =  $_POST['thk1'];						
			$thk12 =  $_POST['thk12'];						
			$area1 =  $_POST['area1'];						
			$area12 =  $_POST['area12'];						
			$load1 =  $_POST['load1'];						
			$load12 =  $_POST['load12'];						
			$str1 =  $_POST['str1'];						
			$str12 =  $_POST['str12'];						
			$ult1 =  $_POST['ult1'];						
			$ult12 =  $_POST['ult12'];						
			$ten1 =  $_POST['ten1'];						
			$ten12 =  $_POST['ten12'];						
			$initial1 =  $_POST['initial1'];						
			$initial12 =  $_POST['initial12'];						
			$final1 =  $_POST['final1'];											
			$final12 =  $_POST['final12'];											
			$elo1 =  $_POST['elo1'];						
			$elo12 =  $_POST['elo12'];						
			$location1 =  $_POST['location1'];	
			$location12 =  $_POST['location12'];	
			
			$chk_chem =  $_POST['chk_chem'];	
			$c1 =  $_POST['c1'];	
			$c2 =  $_POST['c2'];	
			$c3 =  $_POST['c3'];	
			$c4 =  $_POST['c4'];	
			$c5 =  $_POST['c5'];	
			$c6 =  $_POST['c6'];	
			$c7 =  $_POST['c7'];	
			$c8 =  $_POST['c8'];	
			$c9 =  $_POST['c9'];	
			$c10 =  $_POST['c10'];	
			$c11 =  $_POST['c11'];	
			$c12 =  $_POST['c12'];	
			$c13 =  $_POST['c13'];	
			$c14 =  $_POST['c14'];
			$amend_date =  $_POST['amend_date'];
			$curr_date=date("Y-m-d");
			
			 $insert="insert into `ms_plate` (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_dia`, `chk_elo`, `chk_ten`, `chk_yled`, `chk_thk`, `chk_mass`, `chk_bend`, `bend1`, `bend12`, `ms_grade`, `l1`, `w1`, `t1`, `out1`, `weight1`, `len1`, `mass1`, `dia1`, `width1`, `thk1`, `area1`, `load1`, `str1`, `ult1`, `ten1`, `initial1`, `final1`, `elo1`, `location1`, `tube_temp`,`l12`, `w12`, `t12`, `out12`, `weight12`, `len12`, `mass12`, `dia12`, `width12`, `thk12`, `area12`, `load12`, `str12`, `ult12`, `ten12`, `initial12`, `final12`, `elo12`, `location12`, `tube_temp2`, `tube_humidity`, `chk_chem`,`c1`,`c2`,`c3`,`c4`,`c5`,`c6`,`c7`,`c8`,`c9`,`c10`,`c11`,`c12`,`c13`,`c14`,`chk_two`,`amend_date`) values('$report_no', '$ulr', '$job_no', '$lab_no', '$status', '$created_by', '$created_date', '$modified_by', '$modified_date', '$is_deleted', '$deleted_by', '$checked_by', '$chk_dia', '$chk_elo', '$chk_ten', '$chk_yled', '$chk_thk', '$chk_mass', '$chk_bend', '$bend1', '$bend12', '$ms_grade', '$l1', '$w1', '$t1', '$out1', '$weight1', '$len1', '$mass1', '$dia1', '$width1', '$thk1', '$area1', '$load1', '$str1', '$ult1', '$ten1', '$initial1', '$final1', '$elo1', '$location1', '$tube_temp', '$l12', '$w12', '$t12', '$out12', '$weight12', '$len12', '$mass12', '$dia12', '$width12', '$thk12', '$area12', '$load12', '$str12', '$ult12', '$ten12', '$initial12', '$final12', '$elo12', '$location12', '$tube_temp2', '$tube_humidity', '$chk_chem','$c1','$c2','$c3','$c4','$c5','$c6','$c7','$c8','$c9','$c10','$c11','$c12','$c13','$c14','$chk_two','$amend_date')"; 
				
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
													 $query = "select * from ms_plate WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
		
		$update="update `ms_plate` SET 
		`job_no`='$_POST[job_no]',
		`lab_no`='$_POST[lab_no]',
		`ulr`='$_POST[ulr]',		 
		`tube_humidity`='$_POST[tube_humidity]',		 
		`tube_temp`='$_POST[tube_temp]',		 
		`tube_temp2`='$_POST[tube_temp2]',		 
		`chk_dia` = '$_POST[chk_dia]',
		`chk_elo` = '$_POST[chk_elo]',
		`chk_ten` = '$_POST[chk_ten]',
		`chk_yled` = '$_POST[chk_yled]',
		`chk_thk` = '$_POST[chk_thk]',
		`chk_mass` = '$_POST[chk_mass]',
		`chk_bend` = '$_POST[chk_bend]',
		`chk_two` = '$_POST[chk_two]',
		`bend1` = '$_POST[bend1]',
		`bend12` = '$_POST[bend12]',
		`ms_grade` = '$_POST[ms_grade]',
		`l1` = '$_POST[l1]',
		`l12` = '$_POST[l12]',
		`w1` = '$_POST[w1]',
		`w12` = '$_POST[w12]',
		`t1` = '$_POST[t1]',
		`t12` = '$_POST[t12]',
		`out1` = '$_POST[out1]',
		`out12` = '$_POST[out12]',
		`weight1` = '$_POST[weight1]',
		`weight12` = '$_POST[weight12]',
		`len1` = '$_POST[len1]',
		`len12` = '$_POST[len12]',
		`mass1` = '$_POST[mass1]',
		`mass12` = '$_POST[mass12]',
		`dia1` = '$_POST[dia1]',
		`dia12` = '$_POST[dia12]',
		`width1` = '$_POST[width1]',
		`width12` = '$_POST[width12]',
		`thk1` = '$_POST[thk1]',
		`thk12` = '$_POST[thk12]',
		`area1` = '$_POST[area1]',
		`area12` = '$_POST[area12]',
		`load1` = '$_POST[load1]',
		`load12` = '$_POST[load12]',
		`str1` = '$_POST[str1]',
		`str12` = '$_POST[str12]',
		`ult1` = '$_POST[ult1]',
		`ult12` = '$_POST[ult12]',
		`ten1` = '$_POST[ten1]',
		`ten12` = '$_POST[ten12]',
		`initial1` = '$_POST[initial1]',
		`initial12` = '$_POST[initial12]',
		`final1` = '$_POST[final1]',
		`final12` = '$_POST[final12]',
		
		`elo1` = '$_POST[elo1]',
		`elo12` = '$_POST[elo12]',
		`chk_chem`='$_POST[chk_chem]',`c1`='$_POST[c1]',`c2`='$_POST[c2]',`c3`='$_POST[c3]',`c4`='$_POST[c4]',`c5`='$_POST[c5]',`c6`='$_POST[c6]',`c7`='$_POST[c7]',`c8`='$_POST[c8]',`c9`='$_POST[c9]',`c10`='$_POST[c10]',`c11`='$_POST[c11]',`c12`='$_POST[c12]',`c13`='$_POST[c13]',`c14`='$_POST[c14]',
		`location1` = '$_POST[location1]',
		`location12` = '$_POST[location12]',
		`amend_date` = '$_POST[amend_date]',
		 
		`checked_by`=NULL WHERE `id`='$_POST[idEdit]'"; 

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update `ms_plate` SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM ms_plate WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update ms_plate SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update ms_plate SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
    }
    exit;
	
}
?>