<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php
session_start();
include("connection.php");
error_reporting(1);
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
	</script>
	<?php
}

if($_POST['from_date']!="" || $_POST['to_date']!="")
{
$ref_dayc1_0=substr($_POST['from_date'],0,2);
$ref_monthc1_0=substr($_POST['from_date'],3,2);
$ref_yearc1_0=substr($_POST['from_date'],6,4);
$start_date = $ref_yearc1_0."-".$ref_monthc1_0."-".$ref_dayc1_0;

$ref_dayc2_0=substr($_POST['to_date'],0,2);
$ref_monthc2_0=substr($_POST['to_date'],3,2);
$ref_yearc2_0=substr($_POST['to_date'],6,4);
$end_date = $ref_yearc2_0."-".$ref_monthc2_0."-".$ref_dayc2_0;



$arraying=array(
array($start_date," AND `sample_rec_date` >='".$start_date."'"),
array($end_date," AND `sample_rec_date` <='".$end_date."'")
);

$where="";
$is_available="Y";
foreach($arraying as $keys =>$one_array)
{
	if($one_array[0]!="")
	{
		$where .=$one_array[1];
	}
}
}
else
{
$where="";
$is_available="";
$start_date="";
$end_date="";
}



?>
									<form action="admin_inward_print.php" method="POST" target="_blank">
									<input type="hidden" name="chk_job_card" value="<?php echo $base_url; ?>set_inward_print.php?where=<?php echo $is_available;?>&&start_date=<?php echo $start_date;?>&&end_date=<?php echo $end_date;?>">
									<input type="submit" name="submit_job_card" value="PRINT" class="btn btn-primary form-control" style="height:0%;width:10%;">
									</form>
									<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>

										<!--<th style="text-align:center;">Indication</th>
										<th style="text-align:center;">Action</th>-->
										<th style="text-align:center;"></th>
										<th style="text-align:center;">Name of Suppliers</th>
										<th style="text-align:center;">Ref. No. &amp; Date</th>
										<th style="text-align:center;">Name of Work</th>
										<th style="text-align:center;">Date of Sample Received</th>
										<th style="text-align:center;">Type of Sample</th>
										<th style="text-align:center;">Total Sample Quantity</th>
										<th style="text-align:center;">Job No.</th>
										<th style="text-align:center;">Lab No.</th>
										<th style="text-align:center;">Material Handled<br>over Name</th>
										<th style="text-align:center;" >Intial Date</th>
										<th style="text-align:center;">Testing Charge</th>
										<th style="text-align:center;">Cheque No. / D.D. No./ Date</th>
										<th style="text-align:center;">Tentitve Date</th>
										<th style="text-align:center;">Dispatch Date</th>
										<th style="text-align:center;">Remarks</th>

									</tr>
								</thead>
								<tbody>
									<?php

										$count=0;

										 $query="select * from job where  `jobisdeleted`='0' And `jobisstatus` = '1' AND `material_assign`='1'".$where." ORDER BY job_id";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{$mt_cnt=0;
											$count++;
											$name_of_work= strip_tags(html_entity_decode($row["nameofwork"]),"<strong><em>");

									?>
											<tr>



											<td><?php echo $count;?></td>


											<?php $sel_agency="select * from agency_master where `agency_id`=".$row["agency"];
											$query_agency = mysqli_query($conn, $sel_agency);
											$get_agency = mysqli_fetch_array($query_agency);
											 $sel_agency_city="select * from city where `id`=".$row["agency_city"];
											$query_agency_city = mysqli_query($conn, $sel_agency_city);
											$get_agency_city = mysqli_fetch_array($query_agency_city);
											?>
											<td><?php echo $get_agency['agency_name']." ".$row['agency_address']." ".$get_agency_city['city_name']."<br>[".$row['clientname']." ".$row['clientaddress']."]";?></td>



											<td><?php echo $row['refno']."<br>".date('d/m/Y', strtotime($row['date']));?></td>
											<td><?php echo $name_of_work;?></td>
											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['sample_rec_date']));?></td>

											<?php
											// final material assign table data
											$get_final_material="select * from final_material_assign_master where `trf_no`='$row[trf_no]' AND `job_no`='$row[job_number]' AND `is_deleted`='0' order by convert(`lab_no`, decimal) ASC";
											$result_final_materials =mysqli_query($conn,$get_final_material);

											$lab_id="";
											$job_id="";
											$mt_names="";
											if(mysqli_num_rows($result_final_materials)>0)
											{
												while($one_final_materials=mysqli_fetch_array($result_final_materials))
												{	$mt_cnt++;
													// material name get code
													$materials_ids= $one_final_materials["material_id"];
													$sel_materials_names="select * from material where `id`=$materials_ids AND `mt_isdeleted`=0";
													$result_material_name =mysqli_query($conn,$sel_materials_names);
													$row_material_name =mysqli_fetch_array($result_material_name);
													$mt_names .=  $row_material_name['mt_name']."\n<br>";
													$lab_id .= $one_final_materials['lab_no']."\n<br>";
													$job_id = $one_final_materials['job_no']."<br>";
												}

											}
											?>
											<td style="white-space:nowrap;">
												<?php echo $mt_names;?>
											</td>
											<td>
												<table>

											<?php

											for($i=1;$i<=$mt_cnt;$i++)
											{?>
												<tr><td>
												<?php echo "01";?>
												</td></tr>
											<?php
											}
											?>
												</table>
											</td>
											<td><?php echo $lab_id;?></td>
											<td><?php echo $job_id;?></td>
											<td><?php echo $row["jobcreatedby"]?></td>
											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['sample_rec_date']));?></td>
											<?php
												$billcharges;
												$chequeno;
												$ch_date;
												if($row['perfoma_completed_by_biller']==1)
												{
													  $final_bill_qury = "SELECT `make_test_bill`,`make_material_bill`,`make_estimate`,`perfoma_completed_by_biller`,`total_amt` FROM `estimate_total_span` where find_in_set($row[trf_no],`trf_no`) <> 0 and `est_isdeleted`=0";
													$result_final_bill_qury =mysqli_query($conn,$final_bill_qury);
													if(mysqli_num_rows($result_final_bill_qury)>0)
													{
														$row_main_bill=mysqli_fetch_array($result_final_bill_qury);
														if($row_main_bill['make_test_bill']=="1")
														{
															 $final_make_test_bill = "SELECT `total_amt`,`chequeno`,`ch_date` FROM `estimate_total_span_only_for_test` where find_in_set($row[trf_no],`trf_no`) <> 0 and `est_isdeleted`=0";
															$result_make_test_bill = mysqli_query($conn,$final_make_test_bill);
															$row_test=mysqli_fetch_array($result_make_test_bill);
															$billcharges = $row_test['total_amt'];
															$chequeno = $row_test['chequeno'];
															$ch_date = $row_test['ch_date'];

														}
														else if($row_main_bill['make_material_bill']=="1")
														{
															$final_make_material_bill = "SELECT `total_amt`,`chequeno`,`ch_date` FROM `estimate_total_span_only_for_material` where find_in_set($row[trf_no],`trf_no`) <> 0 and `est_isdeleted`=0";
															$result_make_material_bill = mysqli_query($conn,$final_make_material_bill);
															$row_mt_bill=mysqli_fetch_array($result_make_material_bill);
															$billcharges = $row_mt_bill['total_amt'];
															$chequeno = $row_mt_bill['chequeno'];
															$ch_date = $row_mt_bill['ch_date'];
														}
														else if($row_main_bill['make_estimate']=="1")
														{

															$final_make_estimate_bill = "SELECT `total_amt` FROM `estimate_total_span_only_for_material` where find_in_set($row[trf_no],`trf_no`) <> 0 and `est_isdeleted`=0";
															$result_make_estimate_bill = mysqli_query($conn,$final_make_estimate_bill);
															$row_est=mysqli_fetch_array($result_make_estimate_bill);
															$billcharges = $row_est['total_amt'];
															$chequeno = "";
															$ch_date = "";
														}
														else if($row_main_bill['perfoma_completed_by_biller']=="1")
														{
															$billcharges = $row_main_bill['total_amt'];
															$chequeno = "";
															$ch_date = "";
														}


													}
													else
													{
														$billcharges = "";
														$chequeno = "";
														$ch_date = "";
													}
												}
												else
												{
													$billcharges = "";
													$chequeno = "";
													$ch_date = "";
												}
											?>
											<td><?php echo $billcharges;?></td>
											<td><?php
											if($ch_date!="")
											{
												$dats = date('d/m/Y',strtotime($ch_date));
											}
											else
											{ $dats=""; }

											echo $chequeno."<br>".$dats;?></td>



											<?php
											// final material assign table data
											$get_final_material1="select * from final_material_assign_master where `trf_no`='$row[trf_no]' AND `job_no`='$row[job_number]' AND `is_deleted`='0' order by convert(`lab_no`, decimal) ASC";
											$result_final_materials1 =mysqli_query($conn,$get_final_material1);


											$enddate="";
											$dispdate="";
											if(mysqli_num_rows($result_final_materials1)>0)
											{
												while($one_final_materials1=mysqli_fetch_array($result_final_materials1))
												{
													// material name get code

													 $sel_materials_names1="SELECT * FROM `job_for_engineer`  WHERE `trf_no`='$row[trf_no]' AND `job_no`='$row[job_number]' AND `lab_no`='$one_final_materials1[lab_no]'";
													$result_material_name1 =mysqli_query($conn,$sel_materials_names1);

													if(mysqli_num_rows($result_material_name1)>0)
													{
													$row_material_name1 =mysqli_fetch_array($result_material_name1);
													$enddate .=  date('d/m/Y',strtotime($row_material_name1['end_date']))."<br>";
													}
													else
													{
													$enddate .=  "<br>";
													}

													$sel_materials_names2="SELECT `courier_date` FROM `report_dispatch`  WHERE `trf_no`='$row[trf_no]' AND `job_no`='$row[job_number]' AND `lab_no`='$one_final_materials1[lab_no]'";
													$result_material_name2 =mysqli_query($conn,$sel_materials_names2);
													if(mysqli_num_rows($result_material_name2)>0)
													{
													$row_material_name2 =mysqli_fetch_array($result_material_name2);
													$dispdate .=  date('d/m/Y',strtotime($row_material_name2['courier_date']))."<br>";
													}
													else
													{
													$dispdate .=  "<br>";
													}

												}

											}
											?>
											<td><?php echo $enddate;?></td>
											<td><?php echo $dispdate;?></td>

											<td></td>

										</tr>
									<?php
										}
									?>
								</tbody>

							  </table>

<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
<script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
$(document).ready(function(){
	var table = $('#example1').DataTable( {
        'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [

            { extend: 'excel',
			  footer: true,
			}
        ],
    });

	$(function () {
		$('.select2').select2()
	})

});
</script>
