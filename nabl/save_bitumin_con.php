<?php

session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from bitumin_con WHERE id='$_POST[id]' AND `is_deleted`='0'";
		$select_result = mysqli_query($conn, $get_query);
		$result = mysqli_fetch_array($select_result);
		$id = $result['id'];
		$report_no = $result['report_no'];
		$job_no = $result['job_no'];
		$lab_no = $result['lab_no'];
		$fill = array(
			'id' => $id,
			'report_no' => $report_no,
			'job_no' => $job_no,
			'lab_no' => $lab_no,
			'ulr' => $result['ulr'],
			'amend_date' => $result['amend_date'],
			'bic_1' => $result['bic_1'],
			'den_1' => $result['den_1'],
			'den_2' => $result['den_2'],
			'den_3' => $result['den_3'],
			'ms_1' => $result['ms_1'],
			'ms_2' => $result['ms_2'],
			'ms_3' => $result['ms_3'],
			'bit_srn_1' => $result['bit_srn_1'],
			'bit_srn_2' => $result['bit_srn_2'],
			'bit_srn_3' => $result['bit_srn_3'],
			'bit_srn_4' => $result['bit_srn_4'],
			'bit_srn_5' => $result['bit_srn_5'],
			'bit_w1_1' => $result['bit_w1_1'],
			'bit_w1_2' => $result['bit_w1_2'],
			'bit_w1_3' => $result['bit_w1_3'],
			'bit_w1_4' => $result['bit_w1_4'],
			'bit_w1_5' => $result['bit_w1_5'],
			'bit_f_1' => $result['bit_f_1'],
			'bit_f_2' => $result['bit_f_2'],
			'bit_f_3' => $result['bit_f_3'],
			'bit_f_4' => $result['bit_f_4'],
			'bit_f_5' => $result['bit_f_5'],
			'bit_w2_1' => $result['bit_w2_1'],
			'bit_w2_2' => $result['bit_w2_2'],
			'bit_w2_3' => $result['bit_w2_3'],
			'bit_w2_4' => $result['bit_w2_4'],
			'bit_w2_5' => $result['bit_w2_5'],
			'bit_w3_1' => $result['bit_w3_1'],
			'bit_w3_2' => $result['bit_w3_2'],
			'bit_w3_3' => $result['bit_w3_3'],
			'bit_w3_4' => $result['bit_w3_4'],
			'bit_w3_5' => $result['bit_w3_5'],
			'bit_w4_1' => $result['bit_w4_1'],
			'bit_w4_2' => $result['bit_w4_2'],
			'bit_w4_3' => $result['bit_w4_3'],
			'bit_w4_4' => $result['bit_w4_4'],
			'bit_w4_5' => $result['bit_w4_5'],
			'bit_w5_1' => $result['bit_w5_1'],
			'bit_w5_2' => $result['bit_w5_2'],
			'bit_w5_3' => $result['bit_w5_3'],
			'bit_w5_4' => $result['bit_w5_4'],
			'bit_w5_5' => $result['bit_w5_5'],
			'bit_bc_1' => $result['bit_bc_1'],
			'bit_bc_2' => $result['bit_bc_2'],
			'bit_bc_3' => $result['bit_bc_3'],
			'bit_bc_4' => $result['bit_bc_4'],
			'bit_bc_5' => $result['bit_bc_5'],
			'chk_mas' => $result['chk_mas'],
            'a1' => $result['a1'],
			'a2' => $result['a2'],
			'a3' => $result['a3'],
            'b1' => $result['b1'],
			'b2' => $result['b2'],
			'b3' => $result['b3'],
            'c1' => $result['c1'],
			'c2' => $result['c2'],
			'c3' => $result['c3'],
            's1' => $result['s1'],
			's2' => $result['s2'],
			's3' => $result['s3'],
            'd1' => $result['d1'],
			'd2' => $result['d2'],
			'd3' => $result['d3'],

            't1' => $result['t1'],
			't2' => $result['t2'],
			't3' => $result['t3']
			
		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$bitumin_grade =  $_POST['bitumin_grade'];
		$bitumin_make =  $_POST['bitumin_make'];
		$ulr =  $_POST['ulr'];
		$amend_date =  $_POST['amend_date'];

        $chk_mas = $_POST['chk_mas'];
		$bic_1 = $_POST['bic_1'];
		$den_1 = $_POST['den_1'];
		$den_2 = $_POST['den_2'];
		$den_3 = $_POST['den_3'];
		$ms_1 = $_POST['ms_1'];
		$ms_2 = $_POST['ms_2'];
		$ms_3 = $_POST['ms_3'];
		$bit_srn_1 = $_POST['bit_srn_1'];
        $bit_srn_2 = $_POST['bit_srn_2'];
        $bit_srn_3 = $_POST['bit_srn_3'];
        $bit_srn_4 = $_POST['bit_srn_4'];
        $bit_srn_5 = $_POST['bit_srn_5'];
        $bit_w1_1 = $_POST['bit_w1_1'];
        $bit_w1_2 = $_POST['bit_w1_2'];
        $bit_w1_3 = $_POST['bit_w1_3'];
        $bit_w1_4 = $_POST['bit_w1_4'];
        $bit_w1_5 = $_POST['bit_w1_5'];
        $bit_f_1 = $_POST['bit_f_1'];
        $bit_f_2 = $_POST['bit_f_2'];
        $bit_f_3 = $_POST['bit_f_3'];
        $bit_f_4 = $_POST['bit_f_4'];
        $bit_f_5 = $_POST['bit_f_5'];
        $bit_w2_1 = $_POST['bit_w2_1'];
        $bit_w2_2 = $_POST['bit_w2_2'];
        $bit_w2_3 = $_POST['bit_w2_3'];
        $bit_w2_4 = $_POST['bit_w2_4'];
        $bit_w2_5 = $_POST['bit_w2_5'];
        $bit_w3_1 = $_POST['bit_w3_1'];
        $bit_w3_2 = $_POST['bit_w3_2'];
        $bit_w3_3 = $_POST['bit_w3_3'];
        $bit_w3_4 = $_POST['bit_w3_4'];
        $bit_w3_5 = $_POST['bit_w3_5'];
        $bit_w4_1 = $_POST['bit_w4_1'];
        $bit_w4_2 = $_POST['bit_w4_2'];
        $bit_w4_3 = $_POST['bit_w4_3'];
        $bit_w4_4 = $_POST['bit_w4_4'];
        $bit_w4_5 = $_POST['bit_w4_5'];
        $bit_w5_1 = $_POST['bit_w5_1'];
        $bit_w5_2 = $_POST['bit_w5_2'];
        $bit_w5_3 = $_POST['bit_w5_3'];
        $bit_w5_4 = $_POST['bit_w5_4'];
        $bit_w5_5 = $_POST['bit_w5_5'];
        $bit_bc_1 = $_POST['bit_bc_1'];
        $bit_bc_2 = $_POST['bit_bc_2'];
        $bit_bc_3 = $_POST['bit_bc_3'];
        $bit_bc_4 = $_POST['bit_bc_4'];
        $bit_bc_5 = $_POST['bit_bc_5'];

        $d1 = $_POST['d1'];
		$d2 = $_POST['d2'];
		$d3 = $_POST['d3'];

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

        $t1 = $_POST['t1'];
		$t2 = $_POST['t2'];
		$t3 = $_POST['t3'];


		$insert = "insert into bitumin_con (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`,`bic_1`,`ms_1`,`ms_2`,`ms_3`,`den_1`,`den_2`,`den_3`,`amend_date`,`bit_srn_1`,`bit_srn_2`,`bit_srn_3`,`bit_srn_4`,`bit_srn_5`,`bit_w1_1`,`bit_w1_2`,`bit_w1_3`,`bit_w1_4`,`bit_w1_5`,`bit_f_1`,`bit_f_2`,`bit_f_3`,`bit_f_4`,`bit_f_5`,`bit_w2_1`,`bit_w2_2`,`bit_w2_3`,`bit_w2_4`,`bit_w2_5`,`bit_w3_1`,`bit_w3_2`,`bit_w3_3`,`bit_w3_4`,`bit_w3_5`,`bit_w4_1`,`bit_w4_2`,`bit_w4_3`,`bit_w4_4`,`bit_w4_5`,`bit_w5_1`,`bit_w5_2`,`bit_w5_3`,`bit_w5_4`,`bit_w5_5`,`bit_bc_1`,`bit_bc_2`,`bit_bc_3`,`bit_bc_4`,`bit_bc_5`,`chk_mas`,`s1`,`s2`,`s3`,`a1`,`a2`,`a3`,`b1`,`b2`,`b3`,`c1`,`c2`,`c3`,`d1`,`d2`,`d3`,`t1`,`t2`,`t3`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$bic_1', '$ms_1', '$ms_2', '$ms_3','$den_1','$den_2','$den_3','$amend_date','$bit_srn_1','$bit_srn_2','$bit_srn_3','$bit_srn_4','$bit_srn_5','$bit_w1_1','$bit_w1_2','$bit_w1_3','$bit_w1_4','$bit_w1_5','$bit_f_1','$bit_f_2','$bit_f_3','$bit_f_4','$bit_f_5','$bit_w2_1','$bit_w2_2','$bit_w2_3','$bit_w2_4','$bit_w2_5','$bit_w3_1','$bit_w3_2','$bit_w3_3','$bit_w3_4','$bit_w3_5','$bit_w4_1','$bit_w4_2','$bit_w4_3','$bit_w4_4','$bit_w4_5','$bit_w5_1','$bit_w5_2','$bit_w5_3','$bit_w5_4','$bit_w5_5','$bit_bc_1','$bit_bc_2','$bit_bc_3','$bit_bc_4','$bit_bc_5','$chk_mas','$s1','$s2','$s3','$a1','$a2','$a3','$b1','$b2','$b3','$c1','$c2','$c3','$d1','$d2','$d3','$t1','$t2','$t3')";
		
		/* echo "insert into bitumin_con (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`,`bic_1`,`ms_1`,`ms_2`,`ms_3`,`den_1`,`den_2`,`den_3`,`amend_date`,`bit_srn_1`,`bit_srn_2`,`bit_srn_3`,`bit_srn_4`,`bit_srn_5`,`bit_w1_1`,`bit_w1_2`,`bit_w1_3`,`bit_w1_4`,`bit_w1_5`,`bit_f_1`,`bit_f_2`,`bit_f_3`,`bit_f_4`,`bit_f_5`,`bit_w2_1`,`bit_w2_2`,`bit_w2_3`,`bit_w2_4`,`bit_w2_5`,`bit_w3_1`,`bit_w3_2`,`bit_w3_3`,`bit_w3_4`,`bit_w3_5`,`bit_w4_1`,`bit_w4_2`,`bit_w4_3`,`bit_w4_4`,`bit_w4_5`,`bit_w5_1`,`bit_w5_2`,`bit_w5_3`,`bit_w5_4`,`bit_w5_5`,`bit_bc_1`,`bit_bc_2`,`bit_bc_3`,`bit_bc_4`,`bit_bc_5`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$bic_1', '$ms_1', '$ms_2', '$ms_3','$den_1','$den_2','$den_3','$amend_date','$bit_srn_1','$bit_srn_2','$bit_srn_3','$bit_srn_4','$bit_srn_5','$bit_w1_1','$bit_w1_2','$bit_w1_3','$bit_w1_4','$bit_w1_5','$bit_f_1','$bit_f_2','$bit_f_3','$bit_f_4','$bit_f_5','$bit_w2_1','$bit_w2_2','$bit_w2_3','$bit_w2_4','$bit_w2_5','$bit_w3_1','$bit_w3_2','$bit_w3_3','$bit_w3_4','$bit_w3_5','$bit_w4_1','$bit_w4_2','$bit_w4_3','$bit_w4_4','$bit_w4_5','$bit_w5_1','$bit_w5_2','$bit_w5_3','$bit_w5_4','$bit_w5_5','$bit_bc_1','$bit_bc_2','$bit_bc_3','$bit_bc_4','$bit_bc_5')"; */

		$result_of_insert = mysqli_query($conn, $insert);
		
		if($result_of_insert)
		{
			
	    	$fill = array('lab_no' => $_POST['lab_no']);
		}
		else
		{
			//$error = $insert;
			$fill = array('lab_no' => $insert);
		}
		
		
	} else if ($_POST['action_type'] == 'view') {
		$lab_no = $_POST['lab_no'];

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
						$query = "select * from bitumin_con WHERE lab_no='$lab_no' and `is_deleted`='0'";

						$result = mysqli_query($conn, $query);


						if (mysqli_num_rows($result) > 0) {
							while ($r = mysqli_fetch_array($result)) {

								if ($r['is_deleted'] == 0) {
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
										<!--<td style="text-align:center;"><?php //echo $r['report_no'];
																			?></td>-->
										<td style="text-align:center;"><?php echo $r['job_no']; ?></td>
										<td style="text-align:center;"><?php echo $r['lab_no']; ?></td>
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

	} else if ($_POST['action_type'] == 'edit') {


		$curr_date = date("Y-m-d");

		$update = "update bitumin_con SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',`bic_1`='$_POST[bic_1]',`ms_1`='$_POST[ms_1]',`ms_2`='$_POST[ms_2]',`ms_3`='$_POST[ms_3]',`den_1`='$_POST[den_1]',`den_2`='$_POST[den_2]',`den_3`='$_POST[den_3]',`amend_date`='$_POST[amend_date]',`checked_by`=NULL,`bit_srn_1`='$_POST[bit_srn_1]',`bit_srn_2`='$_POST[bit_srn_2]',`bit_srn_3`='$_POST[bit_srn_3]',`bit_srn_4`='$_POST[bit_srn_4]',`bit_srn_5`='$_POST[bit_srn_5]',`bit_w1_1`='$_POST[bit_w1_1]',`bit_w1_2`='$_POST[bit_w1_2]',`bit_w1_3`='$_POST[bit_w1_3]',`bit_w1_4`='$_POST[bit_w1_4]',`bit_w1_5`='$_POST[bit_w1_5]',`bit_f_1`='$_POST[bit_f_1]',`bit_f_2`='$_POST[bit_f_2]',`bit_f_3`='$_POST[bit_f_3]',`bit_f_4`='$_POST[bit_f_4]',`bit_f_5`='$_POST[bit_f_5]',`bit_w2_1`='$_POST[bit_w2_1]',`bit_w2_2`='$_POST[bit_w2_2]',`bit_w2_3`='$_POST[bit_w2_3]',`bit_w2_4`='$_POST[bit_w2_4]',`bit_w2_5`='$_POST[bit_w2_5]',`bit_w3_1`='$_POST[bit_w3_1]',`bit_w3_2`='$_POST[bit_w3_2]',`bit_w3_3`='$_POST[bit_w3_3]',`bit_w3_4`='$_POST[bit_w3_4]',`bit_w3_5`='$_POST[bit_w3_5]',`bit_w4_1`='$_POST[bit_w4_1]',`bit_w4_2`='$_POST[bit_w4_2]',`bit_w4_3`='$_POST[bit_w4_3]',`bit_w4_4`='$_POST[bit_w4_4]',`bit_w4_5`='$_POST[bit_w4_5]',`bit_w5_1`='$_POST[bit_w5_1]',`bit_w5_2`='$_POST[bit_w5_2]',`bit_w5_3`='$_POST[bit_w5_3]',`bit_w5_4`='$_POST[bit_w5_4]',`bit_w5_5`='$_POST[bit_w5_5]',`bit_bc_1`='$_POST[bit_bc_1]',`bit_bc_2`='$_POST[bit_bc_2]',`bit_bc_3`='$_POST[bit_bc_3]',`bit_bc_4`='$_POST[bit_bc_4]',`bit_bc_5`='$_POST[bit_bc_5]',`chk_mas`='$_POST[chk_mas]',`a1`='$_POST[a1]',`a2`='$_POST[a2]',`a3`='$_POST[a3]',`b1`='$_POST[b1]',`b2`='$_POST[b2]',`b3`='$_POST[b3]',`c1`='$_POST[c1]',`c2`='$_POST[c2]',`c3`='$_POST[c3]',`d1`='$_POST[d1]',`d2`='$_POST[d2]',`d3`='$_POST[d3]',`s1`='$_POST[s1]',`s2`='$_POST[s2]',`s3`='$_POST[s3]',`t1`='$_POST[t1]',`t2`='$_POST[t2]',`t3`='$_POST[t3]'  WHERE `id`='$_POST[idEdit]'";


         //,`a1`='$_POST[a1]',`a2`='$_POST[a2]',`a3`='$_POST[a3]',`b1`='$_POST[b1]',`b2`='$_POST[b2]',`b3`='$_POST[b3]',`c1`='$_POST[c1]',`c2`='$_POST[c2]',`c3`='$_POST[c3]',`d1`='$_POST[d1]',`d2`='$_POST[d2]',`d3`='$_POST[d3]',`s1`='$_POST[s1]',`s2`='$_POST[s2]',`s3`='$_POST[s3]'

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update bitumin_con SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM bitumin_con WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update bitumin_con SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
				
				
				
			} else {
				$cc = "update bitumin_con SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>