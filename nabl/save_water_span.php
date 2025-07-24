<?php

session_start();
include("connection.php");
error_reporting(0);
if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
	if ($_POST['action_type'] == 'data') {
		$get_query = "select * from water WHERE id='$_POST[id]' AND `is_deleted`='0'";
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
			'chk_phv' => $result['chk_phv'],
			'p1' => $result['p1'],
			'p2' => $result['p2'],
			'p3' => $result['p3'],
			'avgp' => $result['avgp'],
			'chk_hso' => $result['chk_hso'],
			'h1' => $result['h1'],
			'h2' => $result['h2'],
			'h3' => $result['h3'],
			'avgh' => $result['avgh'],
			'chk_nao' => $result['chk_nao'],
			'n1' => $result['n1'],
			'n2' => $result['n2'],
			'n3' => $result['n3'],
			'avgn' => $result['avgn'],
			'chk_tso' => $result['chk_tso'],
			'tsa1' => $result['tsa1'],
			'tsa2' => $result['tsa2'],
			'tsb1' => $result['tsb1'],
			'tsb2' => $result['tsb2'],
			'tsc1' => $result['tsc1'],
			'tsc2' => $result['tsc2'],
			'tsd1' => $result['tsd1'],
			'tsd2' => $result['tsd2'],
			'ts1' => $result['ts1'],
			'ts2' => $result['ts2'],
			'avgts' => $result['avgts'],
			'chk_tds' => $result['chk_tds'],
			'tda1' => $result['tda1'],
			'tda2' => $result['tda2'],
			'tdb1' => $result['tdb1'],
			'tdb2' => $result['tdb2'],
			'tdc1' => $result['tdc1'],
			'tdc2' => $result['tdc2'],
			'tdd1' => $result['tdd1'],
			'tdd2' => $result['tdd2'],
			'td1' => $result['td1'],
			'td2' => $result['td2'],
			'avgtd' => $result['avgtd'],
			'chk_sus' => $result['chk_sus'],
			'uua1' => $result['uua1'],
			'uua2' => $result['uua2'],
			'uub1' => $result['uub1'],
			'uub2' => $result['uub2'],
			'uuc1' => $result['uuc1'],
			'uuc2' => $result['uuc2'],
			'uud1' => $result['uud1'],
			'uud2' => $result['uud2'],
			'uu1' => $result['uu1'],
			'uu2' => $result['uu2'],
			'avguu' => $result['avguu'],
			'chk_org' => $result['chk_org'],
			'ora1' => $result['ora1'],
			'ora2' => $result['ora2'],
			'orb1' => $result['orb1'],
			'orb2' => $result['orb2'],
			'orc1' => $result['orc1'],
			'orc2' => $result['orc2'],
			'ord1' => $result['ord1'],
			'ord2' => $result['ord2'],
			'or1' => $result['or1'],
			'or2' => $result['or2'],
			'avgor' => $result['avgor'],
			'chk_ino' => $result['chk_ino'],
			'ina1' => $result['ina1'],
			'ina2' => $result['ina2'],
			'inb1' => $result['inb1'],
			'inb2' => $result['inb2'],
			'inc1' => $result['inc1'],
			'inc2' => $result['inc2'],
			'ind1' => $result['ind1'],
			'ind2' => $result['ind2'],
			'in1' => $result['in1'],
			'in2' => $result['in2'],
			'avgin' => $result['avgin'],
			'chk_chl' => $result['chk_chl'],
			'cha1' => $result['cha1'],
			'cha2' => $result['cha2'],
			'chb1' => $result['chb1'],
			'chb2' => $result['chb2'],
			'chc1' => $result['chc1'],
			'chc2' => $result['chc2'],
			'chd1' => $result['chd1'],
			'chd2' => $result['chd2'],
			'ch1' => $result['ch1'],
			'ch2' => $result['ch2'],
			'avgch' => $result['avgch'],
			'chk_sul' => $result['chk_sul'],
			'sua1' => $result['sua1'],
			'sua2' => $result['sua2'],
			'sub1' => $result['sub1'],
			'sub2' => $result['sub2'],
			'suc1' => $result['suc1'],
			'suc2' => $result['suc2'],
			'sud1' => $result['sud1'],
			'sud2' => $result['sud2'],
			'su1' => $result['su1'],
			'su2' => $result['su2'],
			'avgsu' => $result['avgsu'],
			'sutotal' => $result['sutotal'],
			'chk_hrd' => $result['chk_hrd'],
			'hra1' => $result['hra1'],
			'hra2' => $result['hra2'],
			'hrb1' => $result['hrb1'],
			'hrb2' => $result['hrb2'],
			'hrc1' => $result['hrc1'],
			'hrc2' => $result['hrc2'],
			'hrd1' => $result['hrd1'],
			'hrd2' => $result['hrd2'],
			'hr1' => $result['hr1'],
			'hr2' => $result['hr2'],
			'avghr' => $result['avghr'],
			'hrtotal' => $result['hrtotal'],
			'chk_bod' => $result['chk_bod'],
			'avgbo' => $result['avgbo'],
			'chk_cod' => $result['chk_cod'],
			'avgco' => $result['avgco'],
			'plant' => $result['plant']


		);
		echo json_encode($fill);
	} else if ($_POST['action_type'] == 'add') {
		$report_no = $_POST['report_no'];
		$job_no = $_POST['job_no'];
		$lab_no = $_POST['lab_no'];
		$ulr = $_POST['ulr'];

		$chk_phv = $_POST['chk_phv'];
		$p1 = $_POST['p1'];
		$p2 = $_POST['p2'];
		$p3 = $_POST['p3'];
		$avgp = $_POST['avgp'];
		$chk_hso = $_POST['chk_hso'];
		$h1 = $_POST['h1'];
		$h2 = $_POST['h2'];
		$h3 = $_POST['h3'];
		$avgh = $_POST['avgh'];
		$chk_nao = $_POST['chk_nao'];
		$n1 = $_POST['n1'];
		$n2 = $_POST['n2'];
		$n3 = $_POST['n3'];
		$avgn = $_POST['avgn'];
		$chk_tso = $_POST['chk_tso'];
		$tsa1 = $_POST['tsa1'];
		$tsa2 = $_POST['tsa2'];
		$tsb1 = $_POST['tsb1'];
		$tsb2 = $_POST['tsb2'];
		$tsc1 = $_POST['tsc1'];
		$tsc2 = $_POST['tsc2'];
		$tsd1 = $_POST['tsd1'];
		$tsd2 = $_POST['tsd2'];
		$ts1 = $_POST['ts1'];
		$ts2 = $_POST['ts2'];
		$avgts = $_POST['avgts'];
		$chk_tds = $_POST['chk_tds'];
		$tda1 = $_POST['tda1'];
		$tda2 = $_POST['tda2'];
		$tdb1 = $_POST['tdb1'];
		$tdb2 = $_POST['tdb2'];
		$tdc1 = $_POST['tdc1'];
		$tdc2 = $_POST['tdc2'];
		$tdd1 = $_POST['tdd1'];
		$tdd2 = $_POST['tdd2'];
		$td1 = $_POST['td1'];
		$td2 = $_POST['td2'];
		$avgtd = $_POST['avgtd'];
		$chk_sus = $_POST['chk_sus'];
		$uua1 = $_POST['uua1'];
		$uua2 = $_POST['uua2'];
		$uub1 = $_POST['uub1'];
		$uub2 = $_POST['uub2'];
		$uuc1 = $_POST['uuc1'];
		$uuc2 = $_POST['uuc2'];
		$uud1 = $_POST['uud1'];
		$uud2 = $_POST['uud2'];
		$uu1 = $_POST['uu1'];
		$uu2 = $_POST['uu2'];
		$avguu = $_POST['avguu'];
		$chk_org = $_POST['chk_org'];
		$ora1 = $_POST['ora1'];
		$ora2 = $_POST['ora2'];
		$orb1 = $_POST['orb1'];
		$orb2 = $_POST['orb2'];
		$orc1 = $_POST['orc1'];
		$orc2 = $_POST['orc2'];
		$ord1 = $_POST['ord1'];
		$ord2 = $_POST['ord2'];
		$or1 = $_POST['or1'];
		$or2 = $_POST['or2'];
		$avgor = $_POST['avgor'];
		$chk_ino = $_POST['chk_ino'];
		$ina1 = $_POST['ina1'];
		$ina2 = $_POST['ina2'];
		$inb1 = $_POST['inb1'];
		$inb2 = $_POST['inb2'];
		$inc1 = $_POST['inc1'];
		$inc2 = $_POST['inc2'];
		$ind1 = $_POST['ind1'];
		$ind2 = $_POST['ind2'];
		$in1 = $_POST['in1'];
		$in2 = $_POST['in2'];
		$avgin = $_POST['avgin'];
		$chk_chl = $_POST['chk_chl'];
		$cha1 = $_POST['cha1'];
		$cha2 = $_POST['cha2'];
		$chb1 = $_POST['chb1'];
		$chb2 = $_POST['chb2'];
		$chc1 = $_POST['chc1'];
		$chc2 = $_POST['chc2'];
		$chd1 = $_POST['chd1'];
		$chd2 = $_POST['chd2'];
		$ch1 = $_POST['ch1'];
		$ch2 = $_POST['ch2'];
		$avgch = $_POST['avgch'];
		$chk_sul = $_POST['chk_sul'];
		$sua1 = $_POST['sua1'];
		$sua2 = $_POST['sua2'];
		$sub1 = $_POST['sub1'];
		$sub2 = $_POST['sub2'];
		$suc1 = $_POST['suc1'];
		$suc2 = $_POST['suc2'];
		$sud1 = $_POST['sud1'];
		$sud2 = $_POST['sud2'];
		$su1 = $_POST['su1'];
		$su2 = $_POST['su2'];
		$avgsu = $_POST['avgsu'];
		$sutotal = $_POST['sutotal'];
		$chk_hrd = $_POST['chk_hrd'];
		$hra1 = $_POST['hra1'];
		$hra2 = $_POST['hra2'];
		$hrb1 = $_POST['hrb1'];
		$hrb2 = $_POST['hrb2'];
		$hrc1 = $_POST['hrc1'];
		$hrc2 = $_POST['hrc2'];
		$hrd1 = $_POST['hrd1'];
		$hrd2 = $_POST['hrd2'];
		$hr1 = $_POST['hr1'];
		$hr2 = $_POST['hr2'];
		$avghr = $_POST['avghr'];
		$hrtotal = $_POST['hrtotal'];
		$chk_bod = $_POST['chk_bod'];
		$avgbo = $_POST['avgbo'];
		$chk_cod = $_POST['chk_cod'];
		$avgco = $_POST['avgco'];
		$plant = $_POST['plant'];

		$curr_date = date("Y-m-d");


		$insert = "insert into water (`report_no`, `ulr`, `job_no`, `lab_no`, `status`, `created_by`, `created_date`, `modified_by`, `modified_date`, `is_deleted`, `deleted_by`, `checked_by`, `chk_phv`, `p1`, `p2`, `p3`, `avgp`, `chk_hso`, `h1`, `h2`, `h3`, `avgh`, `chk_nao`, `n1`, `n2`, `n3`, `avgn`, `chk_tso`, `tsa1`, `tsa2`, `tsb1`, `tsb2`, `tsc1`, `tsc2`, `tsd1`, `tsd2`, `ts1`, `ts2`, `avgts`, `chk_tds`, `tda1`, `tda2`, `tdb1`, `tdb2`, `tdc1`, `tdc2`, `tdd1`, `tdd2`, `td1`, `td2`, `avgtd`, `chk_sus`, `uua1`, `uua2`, `uub1`, `uub2`, `uuc1`, `uuc2`, `uud1`, `uud2`, `uu1`, `uu2`, `avguu`, `chk_org`, `ora1`, `ora2`, `orb1`, `orb2`, `orc1`, `orc2`, `ord1`, `ord2`, `or1`, `or2`, `avgor`, `chk_ino`, `ina1`, `ina2`, `inb1`, `inb2`, `inc1`, `inc2`, `ind1`, `ind2`, `in1`, `in2`, `avgin`, `chk_chl`, `cha1`, `cha2`, `chb1`, `chb2`, `chc1`, `chc2`, `chd1`, `chd2`, `ch1`, `ch2`, `avgch`, `chk_sul`, `sua1`, `sua2`, `sub1`, `sub2`, `suc1`, `suc2`, `sud1`, `sud2`, `su1`, `su2`, `avgsu`, `sutotal`, `chk_hrd`, `hra1`, `hra2`, `hrb1`, `hrb2`, `hrc1`, `hrc2`, `hrd1`, `hrd2`, `hr1`, `hr2`, `avghr`, `hrtotal`, `chk_bod`, `avgbo`, `chk_cod`, `avgco`, `plant`) values('$report_no','$ulr','$job_no','$lab_no','0','$_SESSION[name]','$curr_date','','0000-00-00','0','','', '$chk_phv', '$p1', '$p2', '$p3', '$avgp', '$chk_hso', '$h1', '$h2', '$h3', '$avgh', '$chk_nao', '$n1', '$n2', '$n3', '$avgn', '$chk_tso', '$tsa1', '$tsa2', '$tsb1', '$tsb2', '$tsc1', '$tsc2', '$tsd1', '$tsd2', '$ts1', '$ts2', '$avgts', '$chk_tds', '$tda1', '$tda2', '$tdb1', '$tdb2', '$tdc1', '$tdc2', '$tdd1', '$tdd2', '$td1', '$td2', '$avgtd', '$chk_sus', '$uua1', '$uua2', '$uub1', '$uub2', '$uuc1', '$uuc2', '$uud1', '$uud2', '$uu1', '$uu2', '$avguu', '$chk_org', '$ora1', '$ora2', '$orb1', '$orb2', '$orc1', '$orc2', '$ord1', '$ord2', '$or1', '$or2', '$avgor', '$chk_ino', '$ina1', '$ina2', '$inb1', '$inb2', '$inc1', '$inc2', '$ind1', '$ind2', '$in1', '$in2', '$avgin', '$chk_chl', '$cha1', '$cha2', '$chb1', '$chb2', '$chc1', '$chc2', '$chd1', '$chd2', '$ch1', '$ch2', '$avgch', '$chk_sul', '$sua1', '$sua2', '$sub1', '$sub2', '$suc1', '$suc2', '$sud1', '$sud2', '$su1', '$su2', '$avgsu', '$sutotal', '$chk_hrd', '$hra1', '$hra2', '$hrb1', '$hrb2', '$hrc1', '$hrc2', '$hrd1', '$hrd2', '$hr1', '$hr2', '$avghr', '$hrtotal', '$chk_bod', '$avgbo', '$chk_cod', '$avgco', '$plant')";

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
							$query = "select * from water WHERE lab_no='$lab_no' and `is_deleted`='0'";

							$result = mysqli_query($conn, $query);


							if (mysqli_num_rows($result) > 0) {
								while ($r = mysqli_fetch_array($result)) {

									if ($r['is_deleted'] == 0) {
										?>
											<tr>
												<td style="text-align:center;" width="10%">

													<a href="javascript:void(0);" class="glyphicon glyphicon-edit"
														onclick="editData('<?php echo $r['id']; ?>')"></a>
												<?php
												//	$val =  $_SESSION['isadmin'];
												//	if($val == 0 || $val == 5){
												?>
													<a href="javascript:void(0);" class="glyphicon glyphicon-trash"
														onclick="confirm('Are you sure to delete data?')?saveMetal('delete','<?php echo $r['id']; ?>'):false;"></a>
												<?php
												//	}
												?>
												</td>
												<!--<td style="text-align:center;"><?php //echo $r['report_no'];?></td>-->
												<td style="text-align:center;">
											<?php echo $r['job_no']; ?>
												</td>
												<td style="text-align:center;">
											<?php echo $r['lab_no']; ?>
												</td>
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

		$update = "update water SET 
		 `job_no`='$_POST[job_no]',`lab_no`='$_POST[lab_no]',`ulr`='$_POST[ulr]',`report_no`='$_POST[report_no]',
		 `chk_phv`='$_POST[chk_phv]',
		`p1`='$_POST[p1]',							
		`p2`='$_POST[p2]',							
		`p3`='$_POST[p3]',							
		`avgp`='$_POST[avgp]',							
		`chk_hso`='$_POST[chk_hso]',
		`h1`='$_POST[h1]',							
		`h2`='$_POST[h2]',							
		`h3`='$_POST[h3]',							
		`avgh`='$_POST[avgh]',							
		`chk_nao`='$_POST[chk_nao]',
		`n1`='$_POST[n1]',							
		`n2`='$_POST[n2]',							
		`n3`='$_POST[n3]',							
		`avgh`='$_POST[avgh]',							
		`chk_tso`='$_POST[chk_tso]',							
		`tsa1`='$_POST[tsa1]',
		`tsa2`='$_POST[tsa2]',
		`tsb1`='$_POST[tsb1]',
		`tsb2`='$_POST[tsb2]',
		`tsc1`='$_POST[tsc1]',
		`tsc2`='$_POST[tsc2]',
		`tsd1`='$_POST[tsd1]',
		`tsd2`='$_POST[tsd2]',
		`ts1`='$_POST[ts1]',
		`ts2`='$_POST[ts2]',							
		`avgts`='$_POST[avgts]',							
		`chk_tds`='$_POST[chk_tds]',							
		`tda1`='$_POST[tda1]',
		`tda2`='$_POST[tda2]',
		`tdb1`='$_POST[tdb1]',
		`tdb2`='$_POST[tdb2]',
		`tdc1`='$_POST[tdc1]',
		`tdc2`='$_POST[tdc2]',
		`tdd1`='$_POST[tdd1]',
		`tdd2`='$_POST[tdd2]',
		`td1`='$_POST[td1]',
		`td2`='$_POST[td2]',							
		`avgtd`='$_POST[avgtd]',							
		`chk_sus`='$_POST[chk_sus]',							
		`uua1`='$_POST[uua1]',
		`uua2`='$_POST[uua2]',
		`uub1`='$_POST[uub1]',
		`uub2`='$_POST[uub2]',
		`uuc1`='$_POST[uuc1]',
		`uuc2`='$_POST[uuc2]',
		`uud1`='$_POST[uud1]',
		`uud2`='$_POST[uud2]',
		`uu1`='$_POST[uu1]',
		`uu2`='$_POST[uu2]',							
		`avguu`='$_POST[avguu]',							
		`chk_org`='$_POST[chk_org]',							
		`ora1`='$_POST[ora1]',
		`ora2`='$_POST[ora2]',
		`orb1`='$_POST[orb1]',
		`orb2`='$_POST[orb2]',
		`orc1`='$_POST[orc1]',
		`orc2`='$_POST[orc2]',
		`ord1`='$_POST[ord1]',
		`ord2`='$_POST[ord2]',
		`or1`='$_POST[or1]',
		`or2`='$_POST[or2]',							
		`avgor`='$_POST[avgor]',							
		`chk_ino`='$_POST[chk_ino]',							
		`ina1`='$_POST[ina1]',
		`ina2`='$_POST[ina2]',
		`inb1`='$_POST[inb1]',
		`inb2`='$_POST[inb2]',
		`inc1`='$_POST[inc1]',
		`inc2`='$_POST[inc2]',
		`ind1`='$_POST[ind1]',
		`ind2`='$_POST[ind2]',
		`in1`='$_POST[in1]',
		`in2`='$_POST[in2]',							
		`avgin`='$_POST[avgin]',							
		`chk_chl`='$_POST[chk_chl]',							
		`cha1`='$_POST[cha1]',
		`cha2`='$_POST[cha2]',
		`chb1`='$_POST[chb1]',
		`chb2`='$_POST[chb2]',
		`chc1`='$_POST[chc1]',
		`chc2`='$_POST[chc2]',
		`chd1`='$_POST[chd1]',
		`chd2`='$_POST[chd2]',
		`ch1`='$_POST[ch1]',
		`ch2`='$_POST[ch2]',							
		`avgch`='$_POST[avgch]',							
		`chk_sul`='$_POST[chk_sul]',							
		`sua1`='$_POST[sua1]',
		`sua2`='$_POST[sua2]',
		`sub1`='$_POST[sub1]',
		`sub2`='$_POST[sub2]',
		`suc1`='$_POST[suc1]',
		`suc2`='$_POST[suc2]',
		`sud1`='$_POST[sud1]',
		`sud2`='$_POST[sud2]',
		`su1`='$_POST[su1]',
		`su2`='$_POST[su2]',							
		`avgsu`='$_POST[avgsu]',							
		`sutotal`='$_POST[sutotal]',							
		`chk_hrd`='$_POST[chk_hrd]',							
		`hra1`='$_POST[hra1]',
		`hra2`='$_POST[hra2]',
		`hrb1`='$_POST[hrb1]',
		`hrb2`='$_POST[hrb2]',
		`hrc1`='$_POST[hrc1]',
		`hrc2`='$_POST[hrc2]',
		`hrd1`='$_POST[hrd1]',
		`hrd2`='$_POST[hrd2]',
		`hr1`='$_POST[hr1]',
		`hr2`='$_POST[hr2]',							
		`avghr`='$_POST[avghr]',							
		`hrtotal`='$_POST[hrtotal]',	
		`chk_bod`='$_POST[chk_bod]',
		`avgbo`='$_POST[avgbo]',
		`chk_cod`='$_POST[chk_cod]',
		`avgco`='$_POST[avgco]',
		`plant`='$_POST[plant]',
		 `checked_by`=NULL WHERE `id`='$_POST[idEdit]'";

		$result_of_update = mysqli_query($conn, $update);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'delete') {

		$delete = "update water SET `is_deleted`='1',`deleted_by`='$_SESSION[name]' WHERE `report_no`='$_POST[report_no]' and `lab_no`='$_POST[lab_no]' and `job_no`='$_POST[job_no]'";

		$result_of_delete = mysqli_query($conn, $delete);

		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	} elseif ($_POST['action_type'] == 'chk') {

		$qry = "SELECT * FROM water WHERE `id`='$_POST[id]'";
		$arr = mysqli_query($conn, $qry);
		$rows1 = mysqli_num_rows($arr);
		while ($r2 = mysqli_fetch_array($arr)) {
			if ($r2['checked_by'] != "") {
				$c1c = "update water SET `checked_by`='' WHERE `id`='$_POST[id]'";
				$result_of_delete1 = mysqli_query($conn, $c1c);
			} else {
				$cc = "update water SET `checked_by`='$_SESSION[name]' WHERE `id`='$_POST[id]'";
				$result_of_delete2 = mysqli_query($conn, $cc);

			}

		}


		$fill = array('lab_no' => $_POST['lab_no']);
		echo json_encode($fill);
	}
	exit;

}
?>