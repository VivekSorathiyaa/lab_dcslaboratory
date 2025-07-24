<?php

session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from tmt_steel WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'grade' => $result['grade'],
							'dia' => $result['dia'],
							'brand' => $result['brand'],
							'tag_heading' => $result['tag_heading'],
							'tag_data' => $result['tag_data'],
							'chk_phy' => $result['chk_phy'],
							'chk1' => $result['chk1'],
							'chk2' => $result['chk2'],
							'chk3' => $result['chk3'],
							'chk4' => $result['chk4'],
							'chk5' => $result['chk5'],
							'chk6' => $result['chk6'],
							'chk7' => $result['chk7'],
							'labno1' => $result['labno1'],
							'labno2' => $result['labno2'],
							'labno3' => $result['labno3'],
							'labno4' => $result['labno4'],
							'labno5' => $result['labno5'],
							'labno6' => $result['labno6'],
							'labno7' => $result['labno7'],
							'dia_1' => $result['dia_1'],
							'dia_2' => $result['dia_2'],
							'dia_3' => $result['dia_3'],
							'dia_4' => $result['dia_4'],
							'dia_5' => $result['dia_5'],
							'dia_6' => $result['dia_6'],
							'dia_7' => $result['dia_7'],
							'w_1' => $result['w_1'],
							'w_2' => $result['w_2'],
							'w_3' => $result['w_3'],
							'w_4' => $result['w_4'],
							'w_5' => $result['w_5'],
							'w_6' => $result['w_6'],
							'w_7' => $result['w_7'],
							'l_1' => $result['l_1'],
							'l_2' => $result['l_2'],
							'l_3' => $result['l_3'],
							'l_4' => $result['l_4'],
							'l_5' => $result['l_5'],
							'l_6' => $result['l_6'],
							'l_7' => $result['l_7'],
							'cs_1' => $result['cs_1'],
							'cs_2' => $result['cs_2'],
							'cs_3' => $result['cs_3'],
							'cs_4' => $result['cs_4'],
							'cs_5' => $result['cs_5'],
							'cs_6' => $result['cs_6'],
							'cs_7' => $result['cs_7'],
							'gl_1' => $result['gl_1'],
							'gl_2' => $result['gl_2'],
							'gl_3' => $result['gl_3'],
							'gl_4' => $result['gl_4'],
							'gl_5' => $result['gl_5'],
							'gl_6' => $result['gl_6'],
							'gl_7' => $result['gl_7'],
							'yp_1' => $result['yp_1'],
							'yp_2' => $result['yp_2'],
							'yp_3' => $result['yp_3'],
							'yp_4' => $result['yp_4'],
							'yp_5' => $result['yp_5'],
							'yp_6' => $result['yp_6'],
							'yp_7' => $result['yp_7'],
							'up_1' => $result['up_1'],
							'up_2' => $result['up_2'],
							'up_3' => $result['up_3'],
							'up_4' => $result['up_4'],
							'up_5' => $result['up_5'],
							'up_6' => $result['up_6'],
							'up_7' => $result['up_7'],
							'ys_1' => $result['ys_1'],
							'ys_2' => $result['ys_2'],
							'ys_3' => $result['ys_3'],
							'ys_4' => $result['ys_4'],
							'ys_5' => $result['ys_5'],
							'ys_6' => $result['ys_6'],
							'ys_7' => $result['ys_7'],
							'ten_1' => $result['ten_1'],
							'ten_2' => $result['ten_2'],
							'ten_3' => $result['ten_3'],
							'ten_4' => $result['ten_4'],
							'ten_5' => $result['ten_5'],
							'ten_6' => $result['ten_6'],
							'ten_7' => $result['ten_7'],
							'og_1' => $result['og_1'],
							'og_2' => $result['og_2'],
							'og_3' => $result['og_3'],
							'og_4' => $result['og_4'],
							'og_5' => $result['og_5'],
							'og_6' => $result['og_6'],
							'og_7' => $result['og_7'],
							'fg_1' => $result['fg_1'],
							'fg_2' => $result['fg_2'],
							'fg_3' => $result['fg_3'],
							'fg_4' => $result['fg_4'],
							'fg_5' => $result['fg_5'],
							'fg_6' => $result['fg_6'],
							'fg_7' => $result['fg_7'],
							'elo_1' => $result['elo_1'],
							'elo_2' => $result['elo_2'],
							'elo_3' => $result['elo_3'],
							'elo_4' => $result['elo_4'],
							'elo_5' => $result['elo_5'],
							'elo_6' => $result['elo_6'],
							'elo_7' => $result['elo_7'],
							'bend_1' => $result['bend_1'],
							'bend_2' => $result['bend_2'],
							'bend_3' => $result['bend_3'],
							'bend_4' => $result['bend_4'],
							'bend_5' => $result['bend_5'],
							'bend_6' => $result['bend_6'],
							'bend_7' => $result['bend_7'],
							'rebend_1' => $result['rebend_1'],
							'rebend_2' => $result['rebend_2'],
							'rebend_3' => $result['rebend_3'],
							'rebend_4' => $result['rebend_4'],
							'rebend_5' => $result['rebend_5'],
							'rebend_6' => $result['rebend_6'],
							'rebend_7' => $result['rebend_7'],
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
							'len_1' => $result['len_1'],
							'samp_1' => $result['samp_1'],
							'heat_no' => $result['heat_no'],
							'chk_len' => $result['chk_len'],
							'phy_temp' => $result['phy_temp']
							
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];
			$grade =  $_POST['grade'];	
			$dia =  $_POST['dia'];	
			$brand =  $_POST['brand'];	
			$ulr =  $_POST['ulr'];	
			$amend_date =  $_POST['amend_date'];	
			$tag_heading =  $_POST['tag_heading'];	
			$tag_data =  $_POST['tag_data'];	
			$chk_phy =  $_POST['chk_phy'];	
			$chk_len =  $_POST['chk_len'];	
			$chk1 =  $_POST['chk1'];	
			$chk2 =  $_POST['chk2'];	
			$chk3 =  $_POST['chk3'];	
			$chk4 =  $_POST['chk4'];	
			$chk5 =  $_POST['chk5'];	
			$chk6 =  $_POST['chk6'];	
			$chk7 =  $_POST['chk7'];	
			$labno1 =  $_POST['labno1'];	
			$labno2 =  $_POST['labno2'];	
			$labno3 =  $_POST['labno3'];	
			$labno4 =  $_POST['labno4'];	
			$labno5 =  $_POST['labno5'];	
			$labno6 =  $_POST['labno6'];	
			$labno7 =  $_POST['labno7'];	
			$dia_1 =  $_POST['dia_1'];	
			$dia_2 =  $_POST['dia_2'];	
			$dia_3 =  $_POST['dia_3'];	
			$dia_4 =  $_POST['dia_4'];	
			$dia_5 =  $_POST['dia_5'];	
			$dia_6 =  $_POST['dia_6'];	
			$dia_7 =  $_POST['dia_7'];	
			$w_1 =  $_POST['w_1'];	
			$w_2 =  $_POST['w_2'];	
			$w_3 =  $_POST['w_3'];	
			$w_4 =  $_POST['w_4'];	
			$w_5 =  $_POST['w_5'];	
			$w_6 =  $_POST['w_6'];	
			$w_7 =  $_POST['w_7'];	
			$l_1 =  $_POST['l_1'];	
			$l_2 =  $_POST['l_2'];	
			$l_3 =  $_POST['l_3'];	
			$l_4 =  $_POST['l_4'];	
			$l_5 =  $_POST['l_5'];	
			$l_6 =  $_POST['l_6'];	
			$l_7 =  $_POST['l_7'];	
			$cs_1 =  $_POST['cs_1'];	
			$cs_2 =  $_POST['cs_2'];	
			$cs_3 =  $_POST['cs_3'];	
			$cs_4 =  $_POST['cs_4'];	
			$cs_5 =  $_POST['cs_5'];	
			$cs_6 =  $_POST['cs_6'];	
			$cs_7 =  $_POST['cs_7'];	
			$gl_1 =  $_POST['gl_1'];	
			$gl_2 =  $_POST['gl_2'];	
			$gl_3 =  $_POST['gl_3'];	
			$gl_4 =  $_POST['gl_4'];	
			$gl_5 =  $_POST['gl_5'];	
			$gl_6 =  $_POST['gl_6'];	
			$gl_7 =  $_POST['gl_7'];	
			$yp_1 =  $_POST['yp_1'];	
			$yp_2 =  $_POST['yp_2'];	
			$yp_3 =  $_POST['yp_3'];	
			$yp_4 =  $_POST['yp_4'];	
			$yp_5 =  $_POST['yp_5'];	
			$yp_6 =  $_POST['yp_6'];	
			$yp_7 =  $_POST['yp_7'];	
			$up_1 =  $_POST['up_1'];	
			$up_2 =  $_POST['up_2'];	
			$up_3 =  $_POST['up_3'];	
			$up_4 =  $_POST['up_4'];	
			$up_5 =  $_POST['up_5'];	
			$up_6 =  $_POST['up_6'];	
			$up_7 =  $_POST['up_7'];	
			$ys_1 =  $_POST['ys_1'];	
			$ys_2 =  $_POST['ys_2'];	
			$ys_3 =  $_POST['ys_3'];	
			$ys_4 =  $_POST['ys_4'];	
			$ys_5 =  $_POST['ys_5'];	
			$ys_6 =  $_POST['ys_6'];	
			$ys_7 =  $_POST['ys_7'];	
			$ten_1 =  $_POST['ten_1'];	
			$ten_2 =  $_POST['ten_2'];	
			$ten_3 =  $_POST['ten_3'];	
			$ten_4 =  $_POST['ten_4'];	
			$ten_5 =  $_POST['ten_5'];	
			$ten_6 =  $_POST['ten_6'];	
			$ten_7 =  $_POST['ten_7'];	
			$og_1 =  $_POST['og_1'];	
			$og_2 =  $_POST['og_2'];	
			$og_3 =  $_POST['og_3'];	
			$og_4 =  $_POST['og_4'];	
			$og_5 =  $_POST['og_5'];	
			$og_6 =  $_POST['og_6'];	
			$og_7 =  $_POST['og_7'];	
			$fg_1 =  $_POST['fg_1'];	
			$fg_2 =  $_POST['fg_2'];	
			$fg_3 =  $_POST['fg_3'];	
			$fg_4 =  $_POST['fg_4'];	
			$fg_5 =  $_POST['fg_5'];	
			$fg_6 =  $_POST['fg_6'];	
			$fg_7 =  $_POST['fg_7'];	
			$elo_1 =  $_POST['elo_1'];	
			$elo_2 =  $_POST['elo_2'];	
			$elo_3 =  $_POST['elo_3'];	
			$elo_4 =  $_POST['elo_4'];	
			$elo_5 =  $_POST['elo_5'];	
			$elo_6 =  $_POST['elo_6'];	
			$elo_7 =  $_POST['elo_7'];	
			$bend_1 =  $_POST['bend_1'];	
			$bend_2 =  $_POST['bend_2'];	
			$bend_3 =  $_POST['bend_3'];	
			$bend_4 =  $_POST['bend_4'];	
			$bend_5 =  $_POST['bend_5'];	
			$bend_6 =  $_POST['bend_6'];	
			$bend_7 =  $_POST['bend_7'];	
			$rebend_1 =  $_POST['rebend_1'];	
			$rebend_2 =  $_POST['rebend_2'];	
			$rebend_3 =  $_POST['rebend_3'];	
			$rebend_4 =  $_POST['rebend_4'];	
			$rebend_5 =  $_POST['rebend_5'];	
			$rebend_6 =  $_POST['rebend_6'];	
			$rebend_7 =  $_POST['rebend_7'];	
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
				
			$len_1 =  $_POST['len_1'];	
			$samp_1 =  $_POST['samp_1'];	
			$sample_qty =  $_POST['sample_qty'];	
			$heat_no =  $_POST['heat_no'];	
			$phy_temp =  $_POST['phy_temp'];	
					
			
           
		   $curr_date=date("Y-m-d");
			
		
			    $insert="insert into tmt_steel (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`,`grade`,`dia`,`brand`,`chk_phy`,`chk1`,`chk2`,`chk3`,`chk4`,`chk5`,`chk6`,`chk7`,`labno1`,`labno2`,`labno3`,`labno4`,`labno5`,`labno6`,`labno7`,`dia_1`,`dia_2`,`dia_3`,`dia_4`,`dia_5`,`dia_6`,`dia_7`,`w_1`,`w_2`,`w_3`,`w_4`,`w_5`,`w_6`,`w_7`,`l_1`,`l_2`,`l_3`,`l_4`,`l_5`,`l_6`,`l_7`,`cs_1`,`cs_2`,`cs_3`,`cs_4`,`cs_5`,`cs_6`,`cs_7`,`gl_1`,`gl_2`,`gl_3`,`gl_4`,`gl_5`,`gl_6`,`gl_7`,`yp_1`,`yp_2`,`yp_3`,`yp_4`,`yp_5`,`yp_6`,`yp_7`,`up_1`,`up_2`,`up_3`,`up_4`,`up_5`,`up_6`,`up_7`,`ys_1`,`ys_2`,`ys_3`,`ys_4`,`ys_5`,`ys_6`,`ys_7`,`ten_1`,`ten_2`,`ten_3`,`ten_4`,`ten_5`,`ten_6`,`ten_7`,`og_1`,`og_2`,`og_3`,`og_4`,`og_5`,`og_6`,`og_7`,`fg_1`,`fg_2`,`fg_3`,`fg_4`,`fg_5`,`fg_6`,`fg_7`,`elo_1`,`elo_2`,`elo_3`,`elo_4`,`elo_5`,`elo_6`,`elo_7`,`bend_1`,`bend_2`,`bend_3`,`bend_4`,`bend_5`,`bend_6`,`bend_7`,`rebend_1`,`rebend_2`,`rebend_3`,`rebend_4`,`rebend_5`,`rebend_6`,`rebend_7`,`chk_chem`,`c1`,`c2`,`c3`,`c4`,`c5`,`c6`,`c7`,`c8`,`c9`,`c10`,`c11`,`c12`,`c13`,`c14`,`len_1`,`samp_1`,`sample_qty`,`heat_no`,`tag_heading`,`tag_data`,`chk_len`,`phy_temp`,`amend_date`) values(
				'$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','',
				'$grade','$dia','$brand','$chk_phy','$chk1','$chk2','$chk3','$chk4','$chk5','$chk6','$chk7','$labno1','$labno2','$labno3','$labno4','$labno5','$labno6','$labno7','$dia_1','$dia_2','$dia_3','$dia_4','$dia_5','$dia_6','$dia_7','$w_1','$w_2','$w_3','$w_4','$w_5','$w_6','$w_7','$l_1','$l_2','$l_3','$l_4','$l_5','$l_6','$l_7','$cs_1','$cs_2','$cs_3','$cs_4','$cs_5','$cs_6','$cs_7','$gl_1','$gl_2','$gl_3','$gl_4','$gl_5','$gl_6','$gl_7','$yp_1','$yp_2','$yp_3','$yp_4','$yp_5','$yp_6','$yp_7','$up_1','$up_2','$up_3','$up_4','$up_5','$up_6','$up_7','$ys_1','$ys_2','$ys_3','$ys_4','$ys_5','$ys_6','$ys_7','$ten_1','$ten_2','$ten_3','$ten_4','$ten_5','$ten_6','$ten_7','$og_1','$og_2','$og_3','$og_4','$og_5','$og_6','$og_7','$fg_1','$fg_2','$fg_3','$fg_4','$fg_5','$fg_6','$fg_7','$elo_1','$elo_2','$elo_3','$elo_4','$elo_5','$elo_6','$elo_7','$bend_1','$bend_2','$bend_3','$bend_4','$bend_5','$bend_6','$bend_7','$rebend_1','$rebend_2','$rebend_3','$rebend_4','$rebend_5','$rebend_6','$rebend_7','$chk_chem','$c1','$c2','$c3','$c4','$c5','$c6','$c7','$c8','$c9','$c10','$c11','$c12','$c13','$c14','$len_1','$samp_1','$sample_qty','$heat_no','$tag_heading','$tag_data','$chk_len','$phy_temp','$amend_date')";


 
				
				
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
														<th style="text-align:center;"><label>Dia</label></th>	
														<th style="text-align:center;"><label>Heat No.</label></th>	
														<th style="text-align:center;"><label>Sample Id</label></th>	
								
																								

													</tr>
														<?php
													 $query = "select * from tmt_steel WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
																	//if($val == 0 || $val == 5){
																	?>
																<!-- <a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="confirm('Are you sure to delete data?')?ccDelete(<?php// echo $r['id']; ?>):false;"></a> -->
																<?php
																	//}
																?>	
																</td>
																<!--<td style="text-align:center;"><?php //echo $r['report_no'];?></td>-->
																<td style="text-align:center;"><?php echo $r['job_no'];?></td>
																<td style="text-align:center;"><?php echo $r['lab_no'];?></td>	
																<td style="text-align:center;"><?php echo $r['dia'];?></td>					
																<td style="text-align:center;"><?php echo $r['heat_no'];?></td>					
																<td style="text-align:center;"><?php echo $r['labno1'];?></td>																		
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
		
			  $update="update tmt_steel SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',`grade`='$_POST[grade]',`dia`='$_POST[dia]',`brand`='$_POST[brand]',`chk_phy`='$_POST[chk_phy]',`chk1`='$_POST[chk1]',`chk2`='$_POST[chk2]',`chk3`='$_POST[chk3]',`chk4`='$_POST[chk4]',`chk5`='$_POST[chk5]',`chk6`='$_POST[chk6]',`chk7`='$_POST[chk7]',`labno1`='$_POST[labno1]',`labno2`='$_POST[labno2]',`labno3`='$_POST[labno3]',`labno4`='$_POST[labno4]',`labno5`='$_POST[labno5]',`labno6`='$_POST[labno6]',`labno7`='$_POST[labno7]',`dia_1`='$_POST[dia_1]',`dia_2`='$_POST[dia_2]',`dia_3`='$_POST[dia_3]',`dia_4`='$_POST[dia_4]',`dia_5`='$_POST[dia_5]',`dia_6`='$_POST[dia_6]',`dia_7`='$_POST[dia_7]',`w_1`='$_POST[w_1]',`w_2`='$_POST[w_2]',`w_3`='$_POST[w_3]',`w_4`='$_POST[w_4]',`w_5`='$_POST[w_5]',`w_6`='$_POST[w_6]',`w_7`='$_POST[w_7]',`l_1`='$_POST[l_1]',`l_2`='$_POST[l_2]',`l_3`='$_POST[l_3]',`l_4`='$_POST[l_4]',`l_5`='$_POST[l_5]',`l_6`='$_POST[l_6]',`l_7`='$_POST[l_7]',`cs_1`='$_POST[cs_1]',`cs_2`='$_POST[cs_2]',`cs_3`='$_POST[cs_3]',`cs_4`='$_POST[cs_4]',`cs_5`='$_POST[cs_5]',`cs_6`='$_POST[cs_6]',`cs_7`='$_POST[cs_7]',`gl_1`='$_POST[gl_1]',`gl_2`='$_POST[gl_2]',`gl_3`='$_POST[gl_3]',`gl_4`='$_POST[gl_4]',`gl_5`='$_POST[gl_5]',`gl_6`='$_POST[gl_6]',`gl_7`='$_POST[gl_7]',`yp_1`='$_POST[yp_1]',`yp_2`='$_POST[yp_2]',`yp_3`='$_POST[yp_3]',`yp_4`='$_POST[yp_4]',`yp_5`='$_POST[yp_5]',`yp_6`='$_POST[yp_6]',`yp_7`='$_POST[yp_7]',`up_1`='$_POST[up_1]',`up_2`='$_POST[up_2]',`up_3`='$_POST[up_3]',`up_4`='$_POST[up_4]',`up_5`='$_POST[up_5]',`up_6`='$_POST[up_6]',`up_7`='$_POST[up_7]',`ys_1`='$_POST[ys_1]',`ys_2`='$_POST[ys_2]',`ys_3`='$_POST[ys_3]',`ys_4`='$_POST[ys_4]',`ys_5`='$_POST[ys_5]',`ys_6`='$_POST[ys_6]',`ys_7`='$_POST[ys_7]',`ten_1`='$_POST[ten_1]',`ten_2`='$_POST[ten_2]',`ten_3`='$_POST[ten_4]',`ten_5`='$_POST[ten_5]',`ten_6`='$_POST[ten_6]',`ten_7`='$_POST[ten_7]',`og_1`='$_POST[og_1]',`og_2`='$_POST[og_2]',`og_3`='$_POST[og_3]',`og_4`='$_POST[og_4]',`og_5`='$_POST[og_5]',`og_6`='$_POST[og_6]',`og_7`='$_POST[og_7]',`fg_1`='$_POST[fg_1]',`fg_2`='$_POST[fg_2]',`fg_3`='$_POST[fg_3]',`fg_4`='$_POST[fg_4]',`fg_5`='$_POST[fg_5]',`fg_6`='$_POST[fg_6]',`fg_7`='$_POST[fg_7]',`elo_1`='$_POST[elo_1]',`elo_2`='$_POST[elo_2]',`elo_3`='$_POST[elo_3]',`elo_4`='$_POST[elo_4]',`elo_5`='$_POST[elo_5]',`elo_6`='$_POST[elo_6]',`elo_7`='$_POST[elo_7]',`bend_1`='$_POST[bend_1]',`bend_2`='$_POST[bend_2]',`bend_3`='$_POST[bend_3]',`bend_4`='$_POST[bend_4]',`bend_5`='$_POST[bend_5]',`bend_6`='$_POST[bend_6]',`bend_7`='$_POST[bend_7]',`rebend_1`='$_POST[rebend_1]',`rebend_2`='$_POST[rebend_2]',`rebend_3`='$_POST[rebend_3]',`rebend_4`='$_POST[rebend_4]',`rebend_5`='$_POST[rebend_5]',`rebend_6`='$_POST[rebend_6]',`rebend_7`='$_POST[rebend_7]',`chk_chem`='$_POST[chk_chem]',`c1`='$_POST[c1]',`c2`='$_POST[c2]',`c3`='$_POST[c3]',`c4`='$_POST[c4]',`c5`='$_POST[c5]',`c6`='$_POST[c6]',`c7`='$_POST[c7]',`c8`='$_POST[c8]',`c9`='$_POST[c9]',`c10`='$_POST[c10]',`c11`='$_POST[c11]',`c12`='$_POST[c12]',`c13`='$_POST[c13]',`c14`='$_POST[c14]',`len_1`='$_POST[len_1]',`samp_1`='$_POST[samp_1]',
			 `sample_qty`='$_POST[sample_qty]',
			 `heat_no`='$_POST[heat_no]',
			 `chk_len`='$_POST[chk_len]',
			 `tag_heading`='$_POST[tag_heading]',
			 `tag_data`='$_POST[tag_data]',
			 `phy_temp`='$_POST[phy_temp]',
			 `amend_date`='$_POST[amend_date]',
			 `checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update=mysqli_query($conn,$update);	
		
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update `tmt_steel` SET `is_deleted`='1' WHERE `lab_no`='$_POST[lab_no]' AND `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$lab_no =$_POST['lab_no']; 		
		$qry = "select * from `tmt_steel` WHERE lab_no='$lab_no' and `is_deleted`='0'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		
		 
		
		$fill = array('total_row' => $rows1); 
		echo json_encode($fill);	
    }
    exit;
}
?>