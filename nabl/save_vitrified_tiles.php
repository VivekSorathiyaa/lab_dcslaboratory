<?php
session_start();
include("connection.php");
error_reporting(1);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from vit_tiles WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'color' => $result['color'],
			'size1' => $result['size1'],
			'size2' => $result['size2'],
			'size3' => $result['size3'],
			'chk_dim' => $result['chk_dim'],
			'len1' => $result['len1'],
			'len2' => $result['len2'],
			'len3' => $result['len3'],
			'len4' => $result['len4'],
			'len5' => $result['len5'],
			'len6' => $result['len6'],
			'len7' => $result['len7'],
			'len8' => $result['len8'],
			'len9' => $result['len9'],
			'len10' => $result['len10'],
			'avglen' => $result['avglen'],
			'wid1' => $result['wid1'],
			'wid2' => $result['wid2'],
			'wid3' => $result['wid3'],
			'wid4' => $result['wid4'],
			'wid5' => $result['wid5'],
			'wid6' => $result['wid6'],
			'wid7' => $result['wid7'],
			'wid8' => $result['wid8'],
			'wid9' => $result['wid9'],
			'wid10' => $result['wid10'],
			'avgwid' => $result['avgwid'],
			'thk1' => $result['thk1'],
			'thk2' => $result['thk2'],
			'thk3' => $result['thk3'],
			'thk4' => $result['thk4'],
			'thk5' => $result['thk5'],
			'thk6' => $result['thk6'],
			'thk7' => $result['thk7'],
			'thk8' => $result['thk8'],
			'thk9' => $result['thk9'],
			'thk10' => $result['thk10'],
			'avgthk' => $result['avgthk'],
			'str1' => $result['str1'],
			'str2' => $result['str2'],
			'str3' => $result['str3'],
			'str4' => $result['str4'],
			'str5' => $result['str5'],
			'str6' => $result['str6'],
			'str7' => $result['str7'],
			'str8' => $result['str8'],
			'str9' => $result['str9'],
			'str10' => $result['str10'],
			'avgstr' => $result['avgstr'],
			'rec1' => $result['rec1'],
			'rec2' => $result['rec2'],
			'rec3' => $result['rec3'],
			'rec4' => $result['rec4'],
			'rec5' => $result['rec5'],
			'rec6' => $result['rec6'],
			'rec7' => $result['rec7'],
			'rec8' => $result['rec8'],
			'rec9' => $result['rec9'],
			'rec10' => $result['rec10'],
			'avgrec' => $result['avgrec'],
			'sur1' => $result['sur1'],
			'sur2' => $result['sur2'],
			'sur3' => $result['sur3'],
			'sur4' => $result['sur4'],
			'sur5' => $result['sur5'],
			'sur6' => $result['sur6'],
			'sur7' => $result['sur7'],
			'sur8' => $result['sur8'],
			'sur9' => $result['sur9'],
			'sur10' => $result['sur10'],
			'avgsur' => $result['avgsur'],
			'chk_phy' => $result['chk_phy'],
			'wtr1' => $result['wtr1'],
			'wtr2' => $result['wtr2'],
			'wtr3' => $result['wtr3'],
			'wtr4' => $result['wtr4'],
			'wtr5' => $result['wtr5'],
			'avgwtr' => $result['avgwtr'],
			'brk1' => $result['brk1'],
			'brk2' => $result['brk2'],
			'brk3' => $result['brk3'],
			'brk4' => $result['brk4'],
			'brk5' => $result['brk5'],
			'brk6' => $result['brk6'],
			'brk7' => $result['brk7'],
			'brk8' => $result['brk8'],
			'brk9' => $result['brk9'],
			'brk10' => $result['brk10'],
			'avgbrk' => $result['avgbrk'],
			'mod1' => $result['mod1'],
			'mod2' => $result['mod2'],
			'mod3' => $result['mod3'],
			'mod4' => $result['mod4'],
			'mod5' => $result['mod5'],
			'mod6' => $result['mod6'],
			'mod7' => $result['mod7'],
			'mod8' => $result['mod8'],
			'mod9' => $result['mod9'],
			'mod10' => $result['mod10'],
			'avgmod' => $result['avgmod'],
			'hrd1' => $result['hrd1'],
			'hrd2' => $result['hrd2'],
			'hrd3' => $result['hrd3'],
			'avghrd' => $result['avghrd'],
			'den1' => $result['den1'],
			'den2' => $result['den2'],
			'den3' => $result['den3'],
			'den4' => $result['den4'],
			'den5' => $result['den5'],
			'den6' => $result['den6'],
			'den7' => $result['den7'],
			'den8' => $result['den8'],
			'den9' => $result['den9'],
			'den10' => $result['den10'],
			'avgden' => $result['avgden'],
			'chk_che' => $result['chk_che'],
			'res1' => $result['res1'],
			'res2' => $result['res2'],
			'res3' => $result['res3'],
			'res4' => $result['res4'],
			'res5' => $result['res5'],
			'avgres' => $result['avgres'],
			'hou1' => $result['hou1'],
			'hou2' => $result['hou2'],
			'hou3' => $result['hou3'],
			'hou4' => $result['hou4'],
			'hou5' => $result['hou5'],
			'avghou' => $result['avghou'],
			'alk1' => $result['alk1'],
			'alk2' => $result['alk2'],
			'alk3' => $result['alk3'],
			'alk4' => $result['alk4'],
			'alk5' => $result['alk5'],
			'avgalk' => $result['avgalk'],
			'sur_qua' => $result['sur_qua'],
			'chk_wtr' => $result['chk_wtr'],
			'wtr_a_1' => $result['wtr_a_1'],
			'wtr_a_2' => $result['wtr_a_2'],
			'wtr_a_3' => $result['wtr_a_3'],
			'wtr_a_4' => $result['wtr_a_4'],
			'wtr_a_5' => $result['wtr_a_5'],
			'wtr_a_6' => $result['wtr_a_6'],
			'wtr_a_7' => $result['wtr_a_7'],
			'wtr_a_8' => $result['wtr_a_8'],
			'wtr_a_9' => $result['wtr_a_9'],
			'wtr_a_10' => $result['wtr_a_10'],
			'wtr_b_1' => $result['wtr_b_1'],
			'wtr_b_2' => $result['wtr_b_2'],
			'wtr_b_3' => $result['wtr_b_3'],
			'wtr_b_4' => $result['wtr_b_4'],
			'wtr_b_5' => $result['wtr_b_5'],
			'wtr_b_6' => $result['wtr_b_6'],
			'wtr_b_7' => $result['wtr_b_7'],
			'wtr_b_8' => $result['wtr_b_8'],
			'wtr_b_9' => $result['wtr_b_9'],
			'wtr_b_10' => $result['wtr_b_10'],
			'wtr_1' => $result['wtr_1'],
			'wtr_2' => $result['wtr_2'],
			'wtr_3' => $result['wtr_3'],
			'wtr_4' => $result['wtr_4'],
			'wtr_5' => $result['wtr_5'],
			'wtr_6' => $result['wtr_6'],
			'wtr_7' => $result['wtr_7'],
			'wtr_8' => $result['wtr_8'],
			'wtr_9' => $result['wtr_9'],
			'wtr_10' => $result['wtr_10'],
			'avg_wtr_1' => $result['avg_wtr_1'],
			'amend_date' => $result['amend_date']
		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr = $_POST['ulr'];
		$amend_date = $_POST['amend_date'];
		$sur_qua = $_POST['sur_qua'];
		$color = $_POST['color'];
		$size1 = $_POST['size1'];
		$size2 = $_POST['size2'];
		$size3 = $_POST['size3'];
		$chk_dim = $_POST['chk_dim'];
		$len1 = $_POST['len1'];
		$len2 = $_POST['len2'];
		$len3 = $_POST['len3'];
		$len4 = $_POST['len4'];
		$len5 = $_POST['len5'];
		$len6 = $_POST['len6'];
		$len7 = $_POST['len7'];
		$len8 = $_POST['len8'];
		$len9 = $_POST['len9'];
		$len10 = $_POST['len10'];
		$avglen = $_POST['avglen'];
		$wid1 = $_POST['wid1'];
		$wid2 = $_POST['wid2'];
		$wid3 = $_POST['wid3'];
		$wid4 = $_POST['wid4'];
		$wid5 = $_POST['wid5'];
		$wid6 = $_POST['wid6'];
		$wid7 = $_POST['wid7'];
		$wid8 = $_POST['wid8'];
		$wid9 = $_POST['wid9'];
		$wid10 = $_POST['wid10'];
		$avgwid = $_POST['avgwid'];
		$thk1 = $_POST['thk1'];
		$thk2 = $_POST['thk2'];
		$thk3 = $_POST['thk3'];
		$thk4 = $_POST['thk4'];
		$thk5 = $_POST['thk5'];
		$thk6 = $_POST['thk6'];
		$thk7 = $_POST['thk7'];
		$thk8 = $_POST['thk8'];
		$thk9 = $_POST['thk9'];
		$thk10 = $_POST['thk10'];
		$avgthk = $_POST['avgthk'];
		$str1 = $_POST['str1'];
		$str2 = $_POST['str2'];
		$str3 = $_POST['str3'];
		$str4 = $_POST['str4'];
		$str5 = $_POST['str5'];
		$str6 = $_POST['str6'];
		$str7 = $_POST['str7'];
		$str8 = $_POST['str8'];
		$str9 = $_POST['str9'];
		$str10 = $_POST['str10'];
		$avgstr = $_POST['avgstr'];
		$rec1 = $_POST['rec1'];
		$rec2 = $_POST['rec2'];
		$rec3 = $_POST['rec3'];
		$rec4 = $_POST['rec4'];
		$rec5 = $_POST['rec5'];
		$rec6 = $_POST['rec6'];
		$rec7 = $_POST['rec7'];
		$rec8 = $_POST['rec8'];
		$rec9 = $_POST['rec9'];
		$rec10 = $_POST['rec10'];
		$avgrec = $_POST['avgrec'];
		$sur1 = $_POST['sur1'];
		$sur2 = $_POST['sur2'];
		$sur3 = $_POST['sur3'];
		$sur4 = $_POST['sur4'];
		$sur5 = $_POST['sur5'];
		$sur6 = $_POST['sur6'];
		$sur7 = $_POST['sur7'];
		$sur8 = $_POST['sur8'];
		$sur9 = $_POST['sur9'];
		$sur10 = $_POST['sur10'];
		$avgsur = $_POST['avgsur'];
		$chk_phy = $_POST['chk_phy'];
		$wtr1 = $_POST['wtr1'];
		$wtr2 = $_POST['wtr2'];
		$wtr3 = $_POST['wtr3'];
		$wtr4 = $_POST['wtr4'];
		$wtr5 = $_POST['wtr5'];
		$avgwtr = $_POST['avgwtr'];
		$brk1 = $_POST['brk1'];
		$brk2 = $_POST['brk2'];
		$brk3 = $_POST['brk3'];
		$brk4 = $_POST['brk4'];
		$brk5 = $_POST['brk5'];
		$brk6 = $_POST['brk6'];
		$brk7 = $_POST['brk7'];
		$brk8 = $_POST['brk8'];
		$brk9 = $_POST['brk9'];
		$brk10 = $_POST['brk10'];
		$avgbrk = $_POST['avgbrk'];
		$mod1 = $_POST['mod1'];
		$mod2 = $_POST['mod2'];
		$mod3 = $_POST['mod3'];
		$mod4 = $_POST['mod4'];
		$mod5 = $_POST['mod5'];
		$mod6 = $_POST['mod6'];
		$mod7 = $_POST['mod7'];
		$mod8 = $_POST['mod8'];
		$mod9 = $_POST['mod9'];
		$mod10 = $_POST['mod10'];
		$avgmod = $_POST['avgmod'];
		$hrd1 = $_POST['hrd1'];
		$hrd2 = $_POST['hrd2'];
		$hrd3 = $_POST['hrd3'];
		$avghrd = $_POST['avghrd'];
		$den1 = $_POST['den1'];
		$den2 = $_POST['den2'];
		$den3 = $_POST['den3'];
		$den4 = $_POST['den4'];
		$den5 = $_POST['den5'];
		$den6 = $_POST['den6'];
		$den7 = $_POST['den7'];
		$den8 = $_POST['den8'];
		$den9 = $_POST['den9'];
		$den10 = $_POST['den10'];
		$avgden = $_POST['avgden'];
		$chk_che = $_POST['chk_che'];
		$res1 = $_POST['res1'];
		$res2 = $_POST['res2'];
		$res3 = $_POST['res3'];
		$res4 = $_POST['res4'];
		$res5 = $_POST['res5'];
		$avgres = $_POST['avgres'];
		$hou1 = $_POST['hou1'];
		$hou2 = $_POST['hou2'];
		$hou3 = $_POST['hou3'];
		$hou4 = $_POST['hou4'];
		$hou5 = $_POST['hou5'];
		$avghou = $_POST['avghou'];
		$alk1 = $_POST['alk1'];
		$alk2 = $_POST['alk2'];
		$alk3 = $_POST['alk3'];
		$alk4 = $_POST['alk4'];
		$alk5 = $_POST['alk5'];
		$avgalk = $_POST['avgalk'];
		$chk_wtr = $_POST['chk_wtr'];
		$wtr_a_1 = $_POST['wtr_a_1'];
		$wtr_a_2 = $_POST['wtr_a_2'];
		$wtr_a_3 = $_POST['wtr_a_3'];
		$wtr_a_4 = $_POST['wtr_a_4'];
		$wtr_a_5 = $_POST['wtr_a_5'];
		$wtr_a_6 = $_POST['wtr_a_6'];
		$wtr_a_7 = $_POST['wtr_a_7'];
		$wtr_a_8 = $_POST['wtr_a_8'];
		$wtr_a_9 = $_POST['wtr_a_9'];
		$wtr_a_10 = $_POST['wtr_a_10'];
		$wtr_b_1 = $_POST['wtr_b_1'];
		$wtr_b_2 = $_POST['wtr_b_2'];
		$wtr_b_3 = $_POST['wtr_b_3'];
		$wtr_b_4 = $_POST['wtr_b_4'];
		$wtr_b_5 = $_POST['wtr_b_5'];
		$wtr_b_6 = $_POST['wtr_b_6'];
		$wtr_b_7 = $_POST['wtr_b_7'];
		$wtr_b_8 = $_POST['wtr_b_8'];
		$wtr_b_9 = $_POST['wtr_b_9'];
		$wtr_b_10 = $_POST['wtr_b_10'];
		$wtr_1 = $_POST['wtr_1'];
		$wtr_2 = $_POST['wtr_2'];
		$wtr_3 = $_POST['wtr_3'];
		$wtr_4 = $_POST['wtr_4'];
		$wtr_5 = $_POST['wtr_5'];
		$wtr_6 = $_POST['wtr_6'];
		$wtr_7 = $_POST['wtr_7'];
		$wtr_8 = $_POST['wtr_8'];
		$wtr_9 = $_POST['wtr_9'];
		$wtr_10 = $_POST['wtr_10'];
		$avg_wtr_1 = $_POST['avg_wtr_1'];


		$curr_date = date("Y-m-d");



		$insert = "INSERT INTO `vit_tiles`(`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `color`, `size1`, `size2`, `size3`, `chk_dim`, `len1`, `len2`, `len3`, `len4`, `len5`, `len6`, `len7`, `len8`, `len9`, `len10`, `avglen`, `wid1`, `wid2`, `wid3`, `wid4`, `wid5`, `wid6`, `wid7`, `wid8`, `wid9`, `wid10`, `avgwid`, `thk1`, `thk2`, `thk3`, `thk4`, `thk5`, `thk6`, `thk7`, `thk8`, `thk9`, `thk10`, `avgthk`, `str1`, `str2`, `str3`, `str4`, `str5`, `str6`, `str7`, `str8`, `str9`, `str10`, `avgstr`, `rec1`, `rec2`, `rec3`, `rec4`, `rec5`, `rec6`, `rec7`, `rec8`, `rec9`, `rec10`, `avgrec`, `sur1`, `sur2`, `sur3`, `sur4`, `sur5`, `sur6`, `sur7`, `sur8`, `sur9`, `sur10`, `avgsur`, `sur_qua`, `chk_phy`, `wtr1`, `wtr2`, `wtr3`, `wtr4`, `wtr5`, `avgwtr`, `brk1`, `brk2`, `brk3`, `brk4`, `brk5`, `brk6`, `brk7`, `brk8`, `brk9`, `brk10`, `avgbrk`, `mod1`, `mod2`, `mod3`, `mod4`, `mod5`, `mod6`, `mod7`, `mod8`, `mod9`, `mod10`, `avgmod`, `hrd1`, `hrd2`, `hrd3`, `avghrd`, `den1`, `den2`, `den3`, `den4`, `den5`, `den6`, `den7`, `den8`, `den9`, `den10`, `avgden`, `chk_che`, `res1`, `res2`, `res3`, `res4`, `res5`, `avgres`, `hou1`, `hou2`, `hou3`, `hou4`, `hou5`, `avghou`, `alk1`, `alk2`, `alk3`, `alk4`, `alk5`, `avgalk`, `chk_wtr`, `wtr_a_1`, `wtr_a_2`, `wtr_a_3`, `wtr_a_4`, `wtr_a_5`, `wtr_a_6`, `wtr_a_7`, `wtr_a_8`, `wtr_a_9`, `wtr_a_10`, `wtr_b_1`, `wtr_b_2`, `wtr_b_3`, `wtr_b_4`, `wtr_b_5`, `wtr_b_6`, `wtr_b_7`, `wtr_b_8`, `wtr_b_9`, `wtr_b_10`, `wtr_1`, `wtr_2`, `wtr_3`, `wtr_4`, `wtr_5`, `wtr_6`, `wtr_7`, `wtr_8`, `wtr_9`, `wtr_10`, `avg_wtr_1`, `amend_date`) VALUES ('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','','$color','$size1','$size2','$size3', '$chk_dim', '$len1', '$len2', '$len3', '$len4', '$len5', '$len6', '$len7', '$len8', '$len9', '$len10', '$avglen', '$wid1', '$wid2', '$wid3', '$wid4', '$wid5', '$wid6', '$wid7', '$wid8', '$wid9', '$wid10', '$avgwid', '$thk1', '$thk2', '$thk3', '$thk4', '$thk5', '$thk6', '$thk7', '$thk8', '$thk9', '$thk10', '$avgthk', '$str1', '$str2', '$str3', '$str4', '$str5', '$str6', '$str7', '$str8', '$str9', '$str10', '$avgstr', '$rec1', '$rec2', '$rec3', '$rec4', '$rec5', '$rec6', '$rec7', '$rec8', '$rec9', '$rec10', '$avgrec', '$sur1', '$sur2', '$sur3', '$sur4', '$sur5', '$sur6', '$sur7', '$sur8', '$sur9', '$sur10', '$avgsur', '$sur_qua', '$chk_phy', '$wtr1', '$wtr2', '$wtr3', '$wtr4', '$wtr5', '$avgwtr', '$brk1', '$brk2', '$brk3', '$brk4', '$brk5', '$brk6', '$brk7', '$brk8', '$brk9', '$brk10', '$avgbrk', '$mod1', '$mod2', '$mod3', '$mod4', '$mod5', '$mod6', '$mod7', '$mod8', '$mod9', '$mod10', '$avgmod', '$hrd1', '$hrd2', '$hrd3', '$avghrd', '$den1', '$den2', '$den3', '$den4', '$den5', '$den6', '$den7', '$den8', '$den9', '$den10', '$avgden', '$chk_che', '$res1', '$res2', '$res3', '$res4', '$res5', '$avgres', '$hou1', '$hou2', '$hou3', '$hou4', '$hou5', '$avghou', '$alk1', '$alk2', '$alk3', '$alk4', '$alk5', '$avgalk', '$chk_wtr', '$wtr_a_1', '$wtr_a_2', '$wtr_a_3', '$wtr_a_4', '$wtr_a_5', '$wtr_a_6', '$wtr_a_7', '$wtr_a_8', '$wtr_a_9', '$wtr_a_10', '$wtr_b_1', '$wtr_b_2', '$wtr_b_3', '$wtr_b_4', '$wtr_b_5', '$wtr_b_6', '$wtr_b_7', '$wtr_b_8', '$wtr_b_9', '$wtr_b_10', '$wtr_1', '$wtr_2', '$wtr_3', '$wtr_4', '$wtr_5', '$wtr_6', '$wtr_7', '$wtr_8', '$wtr_9', '$wtr_10', '$avg_wtr_1', '$amend_date')";




		$result_of_insert = mysqli_query($conn, $insert);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
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
						$query = "select * from vit_tiles WHERE lab_no='$lab_no' and `is_deleted`='0'";

						$result = mysqli_query($conn, $query);


						if (mysqli_num_rows($result) > 0) {
							while ($r = mysqli_fetch_array($result)) {

								if ($r['is_deleted'] == 0) {
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

		$update = "update `vit_tiles` SET `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`report_no`='$_POST[report_no]',
		`ulr`='$_POST[ulr]',
		`sur_qua`='$_POST[sur_qua]',
		`color`='$_POST[color]',
		`size1`='$_POST[size1]',
		`size2`='$_POST[size2]',
		`size3`='$_POST[size3]',
		`chk_dim`='$_POST[chk_dim]',
		`len1`='$_POST[len1]',
		`len2`='$_POST[len2]',
		`len3`='$_POST[len3]',
		`len4`='$_POST[len4]',
		`len5`='$_POST[len5]',
		`len6`='$_POST[len6]',
		`len7`='$_POST[len7]',
		`len8`='$_POST[len8]',
		`len9`='$_POST[len9]',
		`len10`='$_POST[len10]',
		`avglen`='$_POST[avglen]',
		`wid1`='$_POST[wid1]',
		`wid2`='$_POST[wid2]',
		`wid3`='$_POST[wid3]',
		`wid4`='$_POST[wid4]',
		`wid5`='$_POST[wid5]',
		`wid6`='$_POST[wid6]',
		`wid7`='$_POST[wid7]',
		`wid8`='$_POST[wid8]',
		`wid9`='$_POST[wid9]',
		`wid10`='$_POST[wid10]',
		`avgwid`='$_POST[avgwid]',
		`thk1`='$_POST[thk1]',
		`thk2`='$_POST[thk2]',
		`thk3`='$_POST[thk3]',
		`thk4`='$_POST[thk4]',
		`thk5`='$_POST[thk5]',
		`thk6`='$_POST[thk6]',
		`thk7`='$_POST[thk7]',
		`thk8`='$_POST[thk8]',
		`thk9`='$_POST[thk9]',
		`thk10`='$_POST[thk10]',
		`avgthk`='$_POST[avgthk]',
		`str1`='$_POST[str1]',
		`str2`='$_POST[str2]',
		`str3`='$_POST[str3]',
		`str4`='$_POST[str4]',
		`str5`='$_POST[str5]',
		`str6`='$_POST[str6]',
		`str7`='$_POST[str7]',
		`str8`='$_POST[str8]',
		`str9`='$_POST[str9]',
		`str10`='$_POST[str10]',
		`avgstr`='$_POST[avgstr]',
		`rec1`='$_POST[rec1]',
		`rec2`='$_POST[rec2]',
		`rec3`='$_POST[rec3]',
		`rec4`='$_POST[rec4]',
		`rec5`='$_POST[rec5]',
		`rec6`='$_POST[rec6]',
		`rec7`='$_POST[rec7]',
		`rec8`='$_POST[rec8]',
		`rec9`='$_POST[rec9]',
		`rec10`='$_POST[rec10]',
		`avgrec`='$_POST[avgrec]',
		`sur1`='$_POST[sur1]',
		`sur2`='$_POST[sur2]',
		`sur3`='$_POST[sur3]',
		`sur4`='$_POST[sur4]',
		`sur5`='$_POST[sur5]',
		`sur6`='$_POST[sur6]',
		`sur7`='$_POST[sur7]',
		`sur8`='$_POST[sur8]',
		`sur9`='$_POST[sur9]',
		`sur10`='$_POST[sur10]',
		`avgsur`='$_POST[avgsur]',
		`chk_phy`='$_POST[chk_phy]',
		`wtr1`='$_POST[wtr1]',
		`wtr2`='$_POST[wtr2]',
		`wtr3`='$_POST[wtr3]',
		`wtr4`='$_POST[wtr4]',
		`wtr5`='$_POST[wtr5]',
		`avgwtr`='$_POST[avgwtr]',
		`brk1`='$_POST[brk1]',
		`brk2`='$_POST[brk2]',
		`brk3`='$_POST[brk3]',
		`brk4`='$_POST[brk4]',
		`brk5`='$_POST[brk5]',
		`brk6`='$_POST[brk6]',
		`brk7`='$_POST[brk7]',
		`brk8`='$_POST[brk8]',
		`brk9`='$_POST[brk9]',
		`brk10`='$_POST[brk10]',
		`avgbrk`='$_POST[avgbrk]',
		`mod1`='$_POST[mod1]',
		`mod2`='$_POST[mod2]',
		`mod3`='$_POST[mod3]',
		`mod4`='$_POST[mod4]',
		`mod5`='$_POST[mod5]',
		`mod6`='$_POST[mod6]',
		`mod7`='$_POST[mod7]',
		`mod8`='$_POST[mod8]',
		`mod9`='$_POST[mod9]',
		`mod10`='$_POST[mod10]',
		`avgmod`='$_POST[avgmod]',
		`hrd1`='$_POST[hrd1]',
		`hrd2`='$_POST[hrd2]',
		`hrd3`='$_POST[hrd3]',
		`avghrd`='$_POST[avghrd]',
		`den1`='$_POST[den1]',
		`den2`='$_POST[den2]',
		`den3`='$_POST[den3]',
		`den4`='$_POST[den4]',
		`den5`='$_POST[den5]',
		`den6`='$_POST[den6]',
		`den7`='$_POST[den7]',
		`den8`='$_POST[den8]',
		`den9`='$_POST[den9]',
		`den10`='$_POST[den10]',
		`avgden`='$_POST[avgden]',
		`chk_che`='$_POST[chk_che]',
		`res1`='$_POST[res1]',
		`res2`='$_POST[res2]',
		`res3`='$_POST[res3]',
		`res4`='$_POST[res4]',
		`res5`='$_POST[res5]',
		`avgres`='$_POST[avgres]',
		`hou1`='$_POST[hou1]',
		`hou2`='$_POST[hou2]',
		`hou3`='$_POST[hou3]',
		`hou4`='$_POST[hou4]',
		`hou5`='$_POST[hou5]',
		`avghou`='$_POST[avghou]',
		`alk1`='$_POST[alk1]',
		`alk2`='$_POST[alk2]',
		`alk3`='$_POST[alk3]',
		`alk4`='$_POST[alk4]',
		`alk5`='$_POST[alk5]',
		`avgalk`='$_POST[avgalk]',
		`chk_wtr`='$_POST[chk_wtr]',
		`wtr_a_1`='$_POST[wtr_a_1]',
		`wtr_a_2`='$_POST[wtr_a_2]',
		`wtr_a_3`='$_POST[wtr_a_3]',
		`wtr_a_4`='$_POST[wtr_a_4]',
		`wtr_a_5`='$_POST[wtr_a_5]',
		`wtr_a_6`='$_POST[wtr_a_6]',
		`wtr_a_7`='$_POST[wtr_a_7]',
		`wtr_a_8`='$_POST[wtr_a_8]',
		`wtr_a_9`='$_POST[wtr_a_9]',
		`wtr_a_10`='$_POST[wtr_a_10]',
		`wtr_b_1`='$_POST[wtr_b_1]',
		`wtr_b_2`='$_POST[wtr_b_2]',
		`wtr_b_3`='$_POST[wtr_b_3]',
		`wtr_b_4`='$_POST[wtr_b_4]',
		`wtr_b_5`='$_POST[wtr_b_5]',
		`wtr_b_6`='$_POST[wtr_b_6]',
		`wtr_b_7`='$_POST[wtr_b_7]',
		`wtr_b_8`='$_POST[wtr_b_8]',
		`wtr_b_9`='$_POST[wtr_b_9]',
		`wtr_b_10`='$_POST[wtr_b_10]',
		`wtr_1`='$_POST[wtr_1]',
		`wtr_2`='$_POST[wtr_2]',
		`wtr_3`='$_POST[wtr_3]',
		`wtr_4`='$_POST[wtr_4]',
		`wtr_5`='$_POST[wtr_5]',
		`wtr_6`='$_POST[wtr_6]',
		`wtr_7`='$_POST[wtr_7]',
		`wtr_8`='$_POST[wtr_8]',
		`wtr_9`='$_POST[wtr_9]',
		`wtr_10`='$_POST[wtr_10]',
		`avg_wtr_1`='$_POST[avg_wtr_1]',
		`amend_date`='$_POST[amend_date]',
	  `checked_by`=NULL WHERE `id`='$_POST[idEdit]'";
	  
		$result_of_update = mysqli_query($conn, $update);
		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update vit_tiles SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM vit_tiles WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update vit_tiles SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $cc);
			} else {
				$cc = "update vit_tiles SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);
			}
		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;
}
?>