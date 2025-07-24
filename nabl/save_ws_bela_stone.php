<?php

session_start();
include("connection.php");
error_reporting(0);
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		if($_POST['action_type'] == 'data')
		{
			$get_query = "select * from ws_bela_stone WHERE id='$_POST[id]' AND `is_deleted`='0'"; 
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
							'chk_spg' => $result['chk_spg'],
							'w1_1' => $result['w1_1'],
							'w1_2' => $result['w1_2'],
							'w1_3' => $result['w1_3'],
							'avg_w1' => $result['avg_w1'],
							'w2_1' => $result['w2_1'],
							'w2_2' => $result['w2_2'],
							'w2_3' => $result['w2_3'],
							'avg_w2' => $result['avg_w2'],
							'w3_1' => $result['w3_1'],
							'w3_2' => $result['w3_2'],
							'w3_3' => $result['w3_3'],
							'avg_w3' => $result['avg_w3'],
							'w4_1' => $result['w4_1'],
							'w4_2' => $result['w4_2'],
							'w4_3' => $result['w4_3'],
							'avg_w4' => $result['avg_w4'],
							'spg_1' => $result['spg_1'],
							'spg_2' => $result['spg_2'],
							'spg_3' => $result['spg_3'],
							'avg_spg' => $result['avg_spg'],
							'chk_por' => $result['chk_por'],
							'a1' => $result['a1'],
							'a2' => $result['a2'],
							'a3' => $result['a3'],
							'avg_a' => $result['avg_a'],
							'b1' => $result['b1'],
							'b2' => $result['b2'],
							'b3' => $result['b3'],
							'avg_b' => $result['avg_b'],
							'c1' => $result['c1'],
							'c2' => $result['c2'],
							'c3' => $result['c3'],
							'avg_c' => $result['avg_c'],
							'asg1' => $result['asg1'],
							'asg2' => $result['asg2'],
							'asg3' => $result['asg3'],
							'avg_asg' => $result['avg_asg'],
							'wtr1' => $result['wtr1'],
							'wtr2' => $result['wtr2'],
							'wtr3' => $result['wtr3'],
							'avg_wtr' => $result['avg_wtr'],
							'por1' => $result['por1'],
							'por2' => $result['por2'],
							'por3' => $result['por3'],
							'avg_por' => $result['avg_por'],
							'tspg1' => $result['tspg1'],
							'tspg2' => $result['tspg2'],
							'tspg3' => $result['tspg3'],
							'avg_tspg' => $result['avg_tspg'],
							'tpor1' => $result['tpor1'],
							'tpor2' => $result['tpor2'],
							'tpor3' => $result['tpor3'],
							'avg_tpor' => $result['avg_tpor'],
							'chk_com' => $result['chk_com'],
							'con1' => $result['con1'],
							'con2' => $result['con2'],
							'con3' => $result['con3'],
							'con4' => $result['con4'],
							'con5' => $result['con5'],
							'con6' => $result['con6'],
							'len1' => $result['len1'],
							'len2' => $result['len2'],
							'len3' => $result['len3'],
							'len4' => $result['len4'],
							'len5' => $result['len5'],
							'len6' => $result['len6'],
							'h1' => $result['h1'],
							'h2' => $result['h2'],
							'h3' => $result['h3'],
							'h4' => $result['h4'],
							'h5' => $result['h5'],
							'h6' => $result['h6'],
							'ratio1' => $result['ratio1'],
							'ratio2' => $result['ratio2'],
							'ratio3' => $result['ratio3'],
							'ratio4' => $result['ratio4'],
							'ratio5' => $result['ratio5'],
							'ratio6' => $result['ratio6'],
							'area1' => $result['area1'],
							'area2' => $result['area2'],
							'area3' => $result['area3'],
							'area4' => $result['area4'],
							'area5' => $result['area5'],
							'area6' => $result['area6'],
							'load1' => $result['load1'],
							'load2' => $result['load2'],
							'load3' => $result['load3'],
							'load4' => $result['load4'],
							'load5' => $result['load5'],
							'load6' => $result['load6'],
							'com1' => $result['com1'],
							'com2' => $result['com2'],
							'com3' => $result['com3'],
							'com4' => $result['com4'],
							'com5' => $result['com5'],
							'com6' => $result['com6'],
							'avg_com1' => $result['avg_com1'],
							'avg_com2' => $result['avg_com2'],
							'chk_tra' => $result['chk_tra'],
							'tcon1' => $result['tcon1'],
							'tcon2' => $result['tcon2'],
							'tcon3' => $result['tcon3'],
							'tcon4' => $result['tcon4'],
							'tcon5' => $result['tcon5'],
							'tcon6' => $result['tcon6'],
							'tl1' => $result['tl1'],
							'tl2' => $result['tl2'],
							'tl3' => $result['tl3'],
							'tl4' => $result['tl4'],
							'tl5' => $result['tl5'],
							'tl6' => $result['tl6'],
							'tb1' => $result['tb1'],
							'tb2' => $result['tb2'],
							'tb3' => $result['tb3'],
							'tb4' => $result['tb4'],
							'tb5' => $result['tb5'],
							'tb6' => $result['tb6'],
							'ta1' => $result['ta1'],
							'ta2' => $result['ta2'],
							'ta3' => $result['ta3'],
							'ta4' => $result['ta4'],
							'ta5' => $result['ta5'],
							'ta6' => $result['ta6'],
							'cb1' => $result['cb1'],
							'cb2' => $result['cb2'],
							'cb3' => $result['cb3'],
							'cb4' => $result['cb4'],
							'cb5' => $result['cb5'],
							'cb6' => $result['cb6'],
							'tra1' => $result['tra1'],
							'tra2' => $result['tra2'],
							'tra3' => $result['tra3'],
							'tra4' => $result['tra4'],
							'tra5' => $result['tra5'],
							'tra6' => $result['tra6'],
							'avg_tra1' => $result['avg_tra1'],
							'avg_tra2' => $result['avg_tra2'],
							'chk_ten' => $result['chk_ten'],
							'scon1' => $result['scon1'],
							'scon2' => $result['scon2'],
							'scon3' => $result['scon3'],
							'scon4' => $result['scon4'],
							'scon5' => $result['scon5'],
							'scon6' => $result['scon6'],
							'scon7' => $result['scon7'],
							'scon8' => $result['scon8'],
							'scon9' => $result['scon9'],
							'scon10' => $result['scon10'],
							'sd1' => $result['sd1'],
							'sd2' => $result['sd2'],
							'sd3' => $result['sd3'],
							'sd4' => $result['sd4'],
							'sd5' => $result['sd5'],
							'sd6' => $result['sd6'],
							'sd7' => $result['sd7'],
							'sd8' => $result['sd8'],
							'sd9' => $result['sd9'],
							'sd10' => $result['sd10'],
							'sl1' => $result['sl1'],
							'sl2' => $result['sl2'],
							'sl3' => $result['sl3'],
							'sl4' => $result['sl4'],
							'sl5' => $result['sl5'],
							'sl6' => $result['sl6'],
							'sl7' => $result['sl7'],
							'sl8' => $result['sl8'],
							'sl9' => $result['sl9'],
							'sl10' => $result['sl10'],
							'sload1' => $result['sload1'],
							'sload2' => $result['sload2'],
							'sload3' => $result['sload3'],
							'sload4' => $result['sload4'],
							'sload5' => $result['sload5'],
							'sload6' => $result['sload6'],
							'sload7' => $result['sload7'],
							'sload8' => $result['sload8'],
							'sload9' => $result['sload9'],
							'sload10' => $result['sload10'],
							'ten1' => $result['ten1'],
							'ten2' => $result['ten2'],
							'ten3' => $result['ten3'],
							'ten4' => $result['ten4'],
							'ten5' => $result['ten5'],
							'ten6' => $result['ten6'],
							'ten7' => $result['ten7'],
							'ten8' => $result['ten8'],
							'ten9' => $result['ten9'],
							'ten10' => $result['ten10'],
							'avg_ten1' => $result['avg_ten1'],
							'avg_ten2' => $result['avg_ten2']
						);	  
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'add')
		{
			$report_no = $_POST['report_no'];
			$job_no=$_POST['job_no'];
			$lab_no=$_POST['lab_no'];		
			$ulr=$_POST['ulr'];		
					
			$chk_spg = $_POST['chk_spg'];
			$w1_1 = $_POST['w1_1'];
			$w1_2 = $_POST['w1_2'];
			$w1_3 = $_POST['w1_3'];
			$avg_w1 = $_POST['avg_w1'];
			$w2_1 = $_POST['w2_1'];
			$w2_2 = $_POST['w2_2'];
			$w2_3 = $_POST['w2_3'];
			$avg_w2 = $_POST['avg_w2'];
			$w3_1 = $_POST['w3_1'];
			$w3_2 = $_POST['w3_2'];
			$w3_3 = $_POST['w3_3'];
			$avg_w3 = $_POST['avg_w3'];
			$w4_1 = $_POST['w4_1'];
			$w4_2 = $_POST['w4_2'];
			$w4_3 = $_POST['w4_3'];
			$avg_w4 = $_POST['avg_w4'];
			$spg_1 = $_POST['spg_1'];
			$spg_2 = $_POST['spg_2'];
			$spg_3 = $_POST['spg_3'];
			$avg_spg = $_POST['avg_spg'];
			$chk_por = $_POST['chk_por'];
			$a1 = $_POST['a1'];
			$a2 = $_POST['a2'];
			$a3 = $_POST['a3'];
			$avg_a = $_POST['avg_a'];
			$b1 = $_POST['b1'];
			$b2 = $_POST['b2'];
			$b3 = $_POST['b3'];
			$avg_b = $_POST['avg_b'];
			$c1 = $_POST['c1'];
			$c2 = $_POST['c2'];
			$c3 = $_POST['c3'];
			$avg_c = $_POST['avg_c'];
			$asg1 = $_POST['asg1'];
			$asg2 = $_POST['asg2'];
			$asg3 = $_POST['asg3'];
			$avg_asg = $_POST['avg_asg'];
			$wtr1 = $_POST['wtr1'];
			$wtr2 = $_POST['wtr2'];
			$wtr3 = $_POST['wtr3'];
			$avg_wtr = $_POST['avg_wtr'];
			$por1 = $_POST['por1'];
			$por2 = $_POST['por2'];
			$por3 = $_POST['por3'];
			$avg_por = $_POST['avg_por'];
			$tspg1 = $_POST['tspg1'];
			$tspg2 = $_POST['tspg2'];
			$tspg3 = $_POST['tspg3'];
			$avg_tspg = $_POST['avg_tspg'];
			$tpor1 = $_POST['tpor1'];
			$tpor2 = $_POST['tpor2'];
			$tpor3 = $_POST['tpor3'];
			$avg_tpor = $_POST['avg_tpor'];
			$chk_com = $_POST['chk_com'];
			$con1 = $_POST['con1'];
			$con2 = $_POST['con2'];
			$con3 = $_POST['con3'];
			$con4 = $_POST['con4'];
			$con5 = $_POST['con5'];
			$con6 = $_POST['con6'];
			$len1 = $_POST['len1'];
			$len2 = $_POST['len2'];
			$len3 = $_POST['len3'];
			$len4 = $_POST['len4'];
			$len5 = $_POST['len5'];
			$len6 = $_POST['len6'];
			$h1 = $_POST['h1'];
			$h2 = $_POST['h2'];
			$h3 = $_POST['h3'];
			$h4 = $_POST['h4'];
			$h5 = $_POST['h5'];
			$h6 = $_POST['h6'];
			$ratio1 = $_POST['ratio1'];
			$ratio2 = $_POST['ratio2'];
			$ratio3 = $_POST['ratio3'];
			$ratio4 = $_POST['ratio4'];
			$ratio5 = $_POST['ratio5'];
			$ratio6 = $_POST['ratio6'];
			$area1 = $_POST['area1'];
			$area2 = $_POST['area2'];
			$area3 = $_POST['area3'];
			$area4 = $_POST['area4'];
			$area5 = $_POST['area5'];
			$area6 = $_POST['area6'];
			$load1 = $_POST['load1'];
			$load2 = $_POST['load2'];
			$load3 = $_POST['load3'];
			$load4 = $_POST['load4'];
			$load5 = $_POST['load5'];
			$load6 = $_POST['load6'];
			$com1 = $_POST['com1'];
			$com2 = $_POST['com2'];
			$com3 = $_POST['com3'];
			$com4 = $_POST['com4'];
			$com5 = $_POST['com5'];
			$com6 = $_POST['com6'];
			$avg_com1 = $_POST['avg_com1'];
			$avg_com2 = $_POST['avg_com2'];
			$chk_tra = $_POST['chk_tra'];
			$tcon1 = $_POST['tcon1'];
			$tcon2 = $_POST['tcon2'];
			$tcon3 = $_POST['tcon3'];
			$tcon4 = $_POST['tcon4'];
			$tcon5 = $_POST['tcon5'];
			$tcon6 = $_POST['tcon6'];
			$tl1 = $_POST['tl1'];
			$tl2 = $_POST['tl2'];
			$tl3 = $_POST['tl3'];
			$tl4 = $_POST['tl4'];
			$tl5 = $_POST['tl5'];
			$tl6 = $_POST['tl6'];
			$tb1 = $_POST['tb1'];
			$tb2 = $_POST['tb2'];
			$tb3 = $_POST['tb3'];
			$tb4 = $_POST['tb4'];
			$tb5 = $_POST['tb5'];
			$tb6 = $_POST['tb6'];
			$ta1 = $_POST['ta1'];
			$ta2 = $_POST['ta2'];
			$ta3 = $_POST['ta3'];
			$ta4 = $_POST['ta4'];
			$ta5 = $_POST['ta5'];
			$ta6 = $_POST['ta6'];
			$cb1 = $_POST['cb1'];
			$cb2 = $_POST['cb2'];
			$cb3 = $_POST['cb3'];
			$cb4 = $_POST['cb4'];
			$cb5 = $_POST['cb5'];
			$cb6 = $_POST['cb6'];
			$tra1 = $_POST['tra1'];
			$tra2 = $_POST['tra2'];
			$tra3 = $_POST['tra3'];
			$tra4 = $_POST['tra4'];
			$tra5 = $_POST['tra5'];
			$tra6 = $_POST['tra6'];
			$avg_tra1 = $_POST['avg_tra1'];
			$avg_tra2 = $_POST['avg_tra2'];
			$chk_ten = $_POST['chk_ten'];
			$scon1 = $_POST['scon1'];
			$scon2 = $_POST['scon2'];
			$scon3 = $_POST['scon3'];
			$scon4 = $_POST['scon4'];
			$scon5 = $_POST['scon5'];
			$scon6 = $_POST['scon6'];
			$scon7 = $_POST['scon7'];
			$scon8 = $_POST['scon8'];
			$scon9 = $_POST['scon9'];
			$scon10 = $_POST['scon10'];
			$sd1 = $_POST['sd1'];
			$sd2 = $_POST['sd2'];
			$sd3 = $_POST['sd3'];
			$sd4 = $_POST['sd4'];
			$sd5 = $_POST['sd5'];
			$sd6 = $_POST['sd6'];
			$sd7 = $_POST['sd7'];
			$sd8 = $_POST['sd8'];
			$sd9 = $_POST['sd9'];
			$sd10 = $_POST['sd10'];
			$sl1 = $_POST['sl1'];
			$sl2 = $_POST['sl2'];
			$sl3 = $_POST['sl3'];
			$sl4 = $_POST['sl4'];
			$sl5 = $_POST['sl5'];
			$sl6 = $_POST['sl6'];
			$sl7 = $_POST['sl7'];
			$sl8 = $_POST['sl8'];
			$sl9 = $_POST['sl9'];
			$sl10 = $_POST['sl10'];
			$sload1 = $_POST['sload1'];
			$sload2 = $_POST['sload2'];
			$sload3 = $_POST['sload3'];
			$sload4 = $_POST['sload4'];
			$sload5 = $_POST['sload5'];
			$sload6 = $_POST['sload6'];
			$sload7 = $_POST['sload7'];
			$sload8 = $_POST['sload8'];
			$sload9 = $_POST['sload9'];
			$sload10 = $_POST['sload10'];
			$ten1 = $_POST['ten1'];
			$ten2 = $_POST['ten2'];
			$ten3 = $_POST['ten3'];
			$ten4 = $_POST['ten4'];
			$ten5 = $_POST['ten5'];
			$ten6 = $_POST['ten6'];
			$ten7 = $_POST['ten7'];
			$ten8 = $_POST['ten8'];
			$ten9 = $_POST['ten9'];
			$ten10 = $_POST['ten10'];
			$avg_ten1 = $_POST['avg_ten1'];
			$avg_ten2 = $_POST['avg_ten2'];
			
			
			$curr_date=date("Y-m-d");
			
			
			
		      $insert="INSERT INTO `ws_bela_stone`(`report_no`,`ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_spg`, `w1_1`, `w1_2`, `w1_3`, `avg_w1`, `w2_1`, `w2_2`, `w2_3`, `avg_w2`, `w3_1`, `w3_2`, `w3_3`, `avg_w3`, `w4_1`, `w4_2`, `w4_3`, `avg_w4`, `spg_1`, `spg_2`, `spg_3`, `avg_spg`, `chk_por`, `a1`, `a2`, `a3`, `avg_a`, `b1`, `b2`, `b3`, `avg_b`, `c1`, `c2`, `c3`, `avg_c`, `asg1`, `asg2`, `asg3`, `avg_asg`, `wtr1`, `wtr2`, `wtr3`, `avg_wtr`, `por1`, `por2`, `por3`, `avg_por`, `tspg1`, `tspg2`, `tspg3`, `avg_tspg`, `tpor1`, `tpor2`, `tpor3`, `avg_tpor`, `chk_com`, `con1`, `con2`, `con3`, `con4`, `con5`, `con6`, `len1`, `len2`, `len3`, `len4`, `len5`, `len6`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `ratio1`, `ratio2`, `ratio3`, `ratio4`, `ratio5`, `ratio6`, `area1`, `area2`, `area3`, `area4`, `area5`, `area6`, `load1`, `load2`, `load3`, `load4`, `load5`, `load6`, `com1`, `com2`, `com3`, `com4`, `com5`, `com6`, `avg_com1`, `avg_com2`, `chk_tra`, `tcon1`, `tcon2`, `tcon3`, `tcon4`, `tcon5`, `tcon6`, `tl1`, `tl2`, `tl3`, `tl4`, `tl5`, `tl6`, `tb1`, `tb2`, `tb3`, `tb4`, `tb5`, `tb6`, `ta1`, `ta2`, `ta3`, `ta4`, `ta5`, `ta6`, `cb1`, `cb2`, `cb3`, `cb4`, `cb5`, `cb6`, `tra1`, `tra2`, `tra3`, `tra4`, `tra5`, `tra6`, `avg_tra1`, `avg_tra2`, `chk_ten`, `scon1`, `scon2`, `scon3`, `scon4`, `scon5`, `scon6`, `scon7`, `scon8`, `scon9`, `scon10`, `sd1`, `sd2`, `sd3`, `sd4`, `sd5`, `sd6`, `sd7`, `sd8`, `sd9`, `sd10`, `sl1`, `sl2`, `sl3`, `sl4`, `sl5`, `sl6`, `sl7`, `sl8`, `sl9`, `sl10`, `sload1`, `sload2`, `sload3`, `sload4`, `sload5`, `sload6`, `sload7`, `sload8`, `sload9`, `sload10`, `ten1`, `ten2`, `ten3`, `ten4`, `ten5`, `ten6`, `ten7`, `ten8`, `ten9`, `ten10`, `avg_ten1`, `avg_ten2`)  VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$chk_spg', '$w1_1', '$w1_2', '$w1_3', '$avg_w1', '$w2_1', '$w2_2', '$w2_3', '$avg_w2', '$w3_1', '$w3_2', '$w3_3', '$avg_w3', '$w4_1', '$w4_2', '$w4_3', '$avg_w4', '$spg_1', '$spg_2', '$spg_3', '$avg_spg', '$chk_por', '$a1', '$a2', '$a3', '$avg_a', '$b1', '$b2', '$b3', '$avg_b', '$c1', '$c2', '$c3', '$avg_c', '$asg1', '$asg2', '$asg3', '$avg_asg', '$wtr1', '$wtr2', '$wtr3', '$avg_wtr', '$por1', '$por2', '$por3', '$avg_por', '$tspg1', '$tspg2', '$tspg3', '$avg_tspg', '$tpor1', '$tpor2', '$tpor3', '$avg_tpor', '$chk_com', '$con1', '$con2', '$con3', '$con4', '$con5', '$con6', '$len1', '$len2', '$len3', '$len4', '$len5', '$len6', '$h1', '$h2', '$h3', '$h4', '$h5', '$h6', '$ratio1', '$ratio2', '$ratio3', '$ratio4', '$ratio5', '$ratio6', '$area1', '$area2', '$area3', '$area4', '$area5', '$area6', '$load1', '$load2', '$load3', '$load4', '$load5', '$load6', '$com1', '$com2', '$com3', '$com4', '$com5', '$com6', '$avg_com1', '$avg_com2', '$chk_tra', '$tcon1', '$tcon2', '$tcon3', '$tcon4', '$tcon5', '$tcon6', '$tl1', '$tl2', '$tl3', '$tl4', '$tl5', '$tl6', '$tb1', '$tb2', '$tb3', '$tb4', '$tb5', '$tb6', '$ta1', '$ta2', '$ta3', '$ta4', '$ta5', '$ta6', '$cb1', '$cb2', '$cb3', '$cb4', '$cb5', '$cb6', '$tra1', '$tra2', '$tra3', '$tra4', '$tra5', '$tra6', '$avg_tra1', '$avg_tra2', '$chk_ten', '$scon1', '$scon2', '$scon3', '$scon4', '$scon5', '$scon6', '$scon7', '$scon8', '$scon9', '$scon10', '$sd1', '$sd2', '$sd3', '$sd4', '$sd5', '$sd6', '$sd7', '$sd8', '$sd9', '$sd10', '$sl1', '$sl2', '$sl3', '$sl4', '$sl5', '$sl6', '$sl7', '$sl8', '$sl9', '$sl10', '$sload1', '$sload2', '$sload3', '$sload4', '$sload5', '$sload6', '$sload7', '$sload8', '$sload9', '$sload10', '$ten1', '$ten2', '$ten3', '$ten4', '$ten5', '$ten6', '$ten7', '$ten8', '$ten9', '$ten10', '$avg_ten1', '$avg_ten2')"; 
			
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
													 $query = "select * from `ws_bela_stone` WHERE lab_no='$lab_no' and `is_deleted`='0'";

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
	else if($_POST['action_type'] == 'edit'){
		
		
		$curr_date=date("Y-m-d");
		
				
		
	  $update="update ws_bela_stone SET `job_no`='$_POST[job_no]',`ulr`='$_POST[ulr]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
				`modified_by`='$_SESSION[name]',
				`modified_date`='$curr_date',					
				`checked_by`=NULL,					 
				`chk_spg` = '$_POST[chk_spg]',
				`w1_1` = '$_POST[w1_1]',
				`w1_2` = '$_POST[w1_2]',
				`w1_3` = '$_POST[w1_3]',
				`avg_w1` = '$_POST[avg_w1]',
				`w2_1` = '$_POST[w2_1]',
				`w2_2` = '$_POST[w2_2]',
				`w2_3` = '$_POST[w2_3]',
				`avg_w2` = '$_POST[avg_w2]',
				`w3_1` = '$_POST[w3_1]',
				`w3_2` = '$_POST[w3_2]',
				`w3_3` = '$_POST[w3_3]',
				`avg_w3` = '$_POST[avg_w3]',
				`w4_1` = '$_POST[w4_1]',
				`w4_2` = '$_POST[w4_2]',
				`w4_3` = '$_POST[w4_3]',
				`avg_w4` = '$_POST[avg_w4]',
				`spg_1` = '$_POST[spg_1]',
				`spg_2` = '$_POST[spg_2]',
				`spg_3` = '$_POST[spg_3]',
				`avg_spg` = '$_POST[avg_spg]',
				`chk_por` = '$_POST[chk_por]',
				`a1` = '$_POST[a1]',
				`a2` = '$_POST[a2]',
				`a3` = '$_POST[a3]',
				`avg_a` = '$_POST[avg_a]',
				`b1` = '$_POST[b1]',
				`b2` = '$_POST[b2]',
				`b3` = '$_POST[b3]',
				`avg_b` = '$_POST[avg_b]',
				`c1` = '$_POST[c1]',
				`c2` = '$_POST[c2]',
				`c3` = '$_POST[c3]',
				`avg_c` = '$_POST[avg_c]',
				`asg1` = '$_POST[asg1]',
				`asg2` = '$_POST[asg2]',
				`asg3` = '$_POST[asg3]',
				`avg_asg` = '$_POST[avg_asg]',
				`wtr1` = '$_POST[wtr1]',
				`wtr2` = '$_POST[wtr2]',
				`wtr3` = '$_POST[wtr3]',
				`avg_wtr` = '$_POST[avg_wtr]',
				`por1` = '$_POST[por1]',
				`por2` = '$_POST[por2]',
				`por3` = '$_POST[por3]',
				`avg_por` = '$_POST[avg_por]',
				`tspg1` = '$_POST[tspg1]',
				`tspg2` = '$_POST[tspg2]',
				`tspg3` = '$_POST[tspg3]',
				`avg_tspg` = '$_POST[avg_tspg]',
				`tpor1` = '$_POST[tpor1]',
				`tpor2` = '$_POST[tpor2]',
				`tpor3` = '$_POST[tpor3]',
				`avg_tpor` = '$_POST[avg_tpor]',
				`chk_com` = '$_POST[chk_com]',
				`con1` = '$_POST[con1]',
				`con2` = '$_POST[con2]',
				`con3` = '$_POST[con3]',
				`con4` = '$_POST[con4]',
				`con5` = '$_POST[con5]',
				`con6` = '$_POST[con6]',
				`len1` = '$_POST[len1]',
				`len2` = '$_POST[len2]',
				`len3` = '$_POST[len3]',
				`len4` = '$_POST[len4]',
				`len5` = '$_POST[len5]',
				`len6` = '$_POST[len6]',
				`h1` = '$_POST[h1]',
				`h2` = '$_POST[h2]',
				`h3` = '$_POST[h3]',
				`h4` = '$_POST[h4]',
				`h5` = '$_POST[h5]',
				`h6` = '$_POST[h6]',
				`ratio1` = '$_POST[ratio1]',
				`ratio2` = '$_POST[ratio2]',
				`ratio3` = '$_POST[ratio3]',
				`ratio4` = '$_POST[ratio4]',
				`ratio5` = '$_POST[ratio5]',
				`ratio6` = '$_POST[ratio6]',
				`area1` = '$_POST[area1]',
				`area2` = '$_POST[area2]',
				`area3` = '$_POST[area3]',
				`area4` = '$_POST[area4]',
				`area5` = '$_POST[area5]',
				`area6` = '$_POST[area6]',
				`load1` = '$_POST[load1]',
				`load2` = '$_POST[load2]',
				`load3` = '$_POST[load3]',
				`load4` = '$_POST[load4]',
				`load5` = '$_POST[load5]',
				`load6` = '$_POST[load6]',
				`com1` = '$_POST[com1]',
				`com2` = '$_POST[com2]',
				`com3` = '$_POST[com3]',
				`com4` = '$_POST[com4]',
				`com5` = '$_POST[com5]',
				`com6` = '$_POST[com6]',
				`avg_com1` = '$_POST[avg_com1]',
				`avg_com2` = '$_POST[avg_com2]',
				`chk_tra` = '$_POST[chk_tra]',
				`tcon1` = '$_POST[tcon1]',
				`tcon2` = '$_POST[tcon2]',
				`tcon3` = '$_POST[tcon3]',
				`tcon4` = '$_POST[tcon4]',
				`tcon5` = '$_POST[tcon5]',
				`tcon6` = '$_POST[tcon6]',
				`tl1` = '$_POST[tl1]',
				`tl2` = '$_POST[tl2]',
				`tl3` = '$_POST[tl3]',
				`tl4` = '$_POST[tl4]',
				`tl5` = '$_POST[tl5]',
				`tl6` = '$_POST[tl6]',
				`tb1` = '$_POST[tb1]',
				`tb2` = '$_POST[tb2]',
				`tb3` = '$_POST[tb3]',
				`tb4` = '$_POST[tb4]',
				`tb5` = '$_POST[tb5]',
				`tb6` = '$_POST[tb6]',
				`ta1` = '$_POST[ta1]',
				`ta2` = '$_POST[ta2]',
				`ta3` = '$_POST[ta3]',
				`ta4` = '$_POST[ta4]',
				`ta5` = '$_POST[ta5]',
				`ta6` = '$_POST[ta6]',
				`cb1` = '$_POST[cb1]',
				`cb2` = '$_POST[cb2]',
				`cb3` = '$_POST[cb3]',
				`cb4` = '$_POST[cb4]',
				`cb5` = '$_POST[cb5]',
				`cb6` = '$_POST[cb6]',
				`tra1` = '$_POST[tra1]',
				`tra2` = '$_POST[tra2]',
				`tra3` = '$_POST[tra3]',
				`tra4` = '$_POST[tra4]',
				`tra5` = '$_POST[tra5]',
				`tra6` = '$_POST[tra6]',
				`avg_tra1` = '$_POST[avg_tra1]',
				`avg_tra2` = '$_POST[avg_tra2]',
				`chk_ten` = '$_POST[chk_ten]',
				`scon1` = '$_POST[scon1]',
				`scon2` = '$_POST[scon2]',
				`scon3` = '$_POST[scon3]',
				`scon4` = '$_POST[scon4]',
				`scon5` = '$_POST[scon5]',
				`scon6` = '$_POST[scon6]',
				`scon7` = '$_POST[scon7]',
				`scon8` = '$_POST[scon8]',
				`scon9` = '$_POST[scon9]',
				`scon10` = '$_POST[scon10]',
				`sd1` = '$_POST[sd1]',
				`sd2` = '$_POST[sd2]',
				`sd3` = '$_POST[sd3]',
				`sd4` = '$_POST[sd4]',
				`sd5` = '$_POST[sd5]',
				`sd6` = '$_POST[sd6]',
				`sd7` = '$_POST[sd7]',
				`sd8` = '$_POST[sd8]',
				`sd9` = '$_POST[sd9]',
				`sd10` = '$_POST[sd10]',
				`sl1` = '$_POST[sl1]',
				`sl2` = '$_POST[sl2]',
				`sl3` = '$_POST[sl3]',
				`sl4` = '$_POST[sl4]',
				`sl5` = '$_POST[sl5]',
				`sl6` = '$_POST[sl6]',
				`sl7` = '$_POST[sl7]',
				`sl8` = '$_POST[sl8]',
				`sl9` = '$_POST[sl9]',
				`sl10` = '$_POST[sl10]',
				`sload1` = '$_POST[sload1]',
				`sload2` = '$_POST[sload2]',
				`sload3` = '$_POST[sload3]',
				`sload4` = '$_POST[sload4]',
				`sload5` = '$_POST[sload5]',
				`sload6` = '$_POST[sload6]',
				`sload7` = '$_POST[sload7]',
				`sload8` = '$_POST[sload8]',
				`sload9` = '$_POST[sload9]',
				`sload10` = '$_POST[sload10]',
				`ten1` = '$_POST[ten1]',
				`ten2` = '$_POST[ten2]',
				`ten3` = '$_POST[ten3]',
				`ten4` = '$_POST[ten4]',
				`ten5` = '$_POST[ten5]',
				`ten6` = '$_POST[ten6]',
				`ten7` = '$_POST[ten7]',
				`ten8` = '$_POST[ten8]',
				`ten9` = '$_POST[ten9]',
				`ten10` = '$_POST[ten10]',
				`avg_ten1` = '$_POST[avg_ten1]',
				`avg_ten2` = '$_POST[avg_ten2]'
				WHERE `id`='$_POST[idEdit]'";

		$result_of_update=mysqli_query($conn,$update);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
	
    }
	elseif($_POST['action_type'] == 'delete'){
		
		 $delete="update ws_bela_stone SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";
		
		$result_of_delete=mysqli_query($conn,$delete);	
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }	
	elseif($_POST['action_type'] == 'chk'){
		
		$qry = "SELECT * FROM ws_bela_stone WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn,$qry);
		$rows1=mysqli_num_rows($arr);
		while($r2 = mysqli_fetch_array($arr)){
				if($r2['checked_by']!="")
				{
					$c1c="update ws_bela_stone SET `checked_by`='' WHERE `id`='$_POST[id]'";			
					$result_of_delete1=mysqli_query($conn,$c1c);	
				}
				else
				{
					$cc="update ws_bela_stone SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";			
					$result_of_delete2=mysqli_query($conn,$cc);	
					
				}
			
			}
		 
		
		$fill = array('lab_no' => $_POST['lab_no']); 
		echo json_encode($fill);	
		
    }
    exit;
	
}
?>