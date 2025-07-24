

<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php 
session_start();
include("connection.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
	</script>
	<?php
}

$arraying=array(
array($_POST["sel_agency_ids"]," AND `bill_to_id` LIKE '%".$_POST['sel_agency_ids']."%'"),
array($_POST["bill_no"]," AND `invoice_no` LIKE '%".ltrim($_POST['bill_no'],1)."%'")
);

$where="";
foreach($arraying as $keys =>$one_array)
{
	if($one_array[0]!="")
	{
		$where .=$one_array[1];
	}
}
?>

	<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Prints</th>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Type</th>
										<th style="text-align:center;">Job No</th>
										<th style="text-align:center;">Invoice Name</th>
										<th style="text-align:center;">Invoice No</th>
										<th style="text-align:center;">Invoice Date</th>
										<th style="text-align:center;">Total Amount</th>
										<!--<th style="text-align:center;">Material</th>
										<th style="text-align:center;">Qty</th>
										<th style="text-align:center;">Amounts</th>-->
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
								// if data of bill in estimate_test table
								$count=0;
								 $sel_test_table="select * from estimate_total_span WHERE `est_isdeleted`=0  AND `perfoma_completed_by_biller`='0' AND `which_made`='2'".$where;
								$result_test_table =mysqli_query($conn,$sel_test_table);
								if(mysqli_num_rows($result_test_table)>0)
								{
								while($row =mysqli_fetch_array($result_test_table))
								{
											$count++;
											
												$get_one_trf_no=explode(",",$row['trf_no']);
												$one_trf_no=$get_one_trf_no[0];
												$query_job="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' ORDER BY job_id DESC";
												$result_job =mysqli_query($conn,$query_job);
												
												$sel_agency_id=$row["agency_id"];
												$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$sel_agency_id;
												$result_agency =mysqli_query($conn,$sel_agency);
												$row_agency =mysqli_fetch_array($result_agency);
												$agency_name=$row_agency["agency_name"];
												
											
											
											$row_job =mysqli_fetch_array($result_job);
											$customer_name=$row_job['clientname'];
											if($row["perfoma_type"]=="direct_perfoma")
											{
												$customer_name=$row['customer_name'];
											}
											
											$name_of_work= strip_tags(html_entity_decode($row_job["nameofwork"]),"<strong><em>");
											
											if($row['make_test_bill']=="1"){ $make_test_bill='<img src="images/green_dot.png">';}else { $make_test_bill="";}
											if($row['make_material_bill']=="1"){ $make_material_bill='<img src="images/green_dot.png">';}else { $make_material_bill="";}
											if($row['make_estimate']=="1"){ $make_estiamte='<img src="images/green_dot.png">';}else { $make_estiamte="";}
											
											$mat_ids_array=explode(",",$row["mat_ids"]);
											$mat_name_array=explode(",",$row["mate_name"]);
											
											$make_by=$row["make_by"];
											
											//by test
											if($make_by=="0")
											{
												$test_qty_array=explode(",",$row["test_qty"]);
												$test_totals_array=explode(",",$row["test_totals"]);
											}else{
													//by material
												$test_qty_array=explode(",",$row["material_qty"]);
												$test_totals_array=explode(",",$row["material_amnt"]);
											}
											
											$uniq_mat_id=array();
											$uniq_mat_name=array();
											$uniq_mat_qty=array();
											$uniq_mat_amnt=array();
											
											foreach($mat_ids_array as $keyed =>$one_mat_id)
											{
												if (!in_array($one_mat_id, $uniq_mat_id))
												{
													array_push($uniq_mat_id,$one_mat_id);
													array_push($uniq_mat_name,$mat_name_array[$keyed]);
													array_push($uniq_mat_qty,$test_qty_array[$keyed]);
													array_push($uniq_mat_amnt,$test_totals_array[$keyed]);
												}
												else
												{
													$keys = array_search ($one_mat_id, $uniq_mat_id);
													$plus_qty= intval($uniq_mat_amnt[$keys]) + intval($test_totals_array[$keyed]);
													$uniq_mat_amnt[$keys] = $plus_qty;
												}
											}
											
									?>
											<tr>
											<td >
											<input type="text" class="print_counts" style="width: 90px;"  value="<?php echo $row["print_counts"]; ?>" data-id="<?php echo $row["est_id"]; ?>"></td>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;">
											<?php
											//if perfoma type is excel then only excel button view
											if($row["perfoma_type"]=="excel")
											{
												echo "EXCEL";
											}
											if($row["perfoma_type"]=="direct_perfoma")
											{
												echo "DIRECT PERFOMA";
											}
											if($row["perfoma_type"] != "excel" && $row["perfoma_type"]!= "direct_perfoma" && $row["perfoma_type"] != "direct_perfoma_excel")
											{
												echo "REGULAR";
											}
											if($row["perfoma_type"] == "direct_perfoma_excel")
											{
												echo "DIRECT PERFOMA EXCEL";
											}
										    ?>
											</td>
											<td style="white-space:nowrap;text-align:center;">
											<?php 
											$explode_job= explode(",",$row['job_no']);
											$set_counts_job=1;
											foreach($explode_job as $keys => $one_jobs)
											{
												if($set_counts_job==4)
												{
													echo $one_jobs."</br>";
													$set_counts_job=0;
												}else
												{
													echo $one_jobs.",";
												}
												
												$set_counts_job++;
											}
											?>
											</td>
											<td style="white-space:nowrap;text-align:center;">
											<?php 
											//if($row["bill_to"]=="0"){ echo $agency_name; }else{ echo $customer_name;  }
											echo $row["bill_to_name"];
											?>
											</td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["invoice_no"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php
											$date = new DateTime($row['invoice_date']);
											echo $date->format('d-m-Y');
											?></td>
											<td style="white-space:nowrap;text-align:center;"><?php
											echo $row['total_amt']
											?></td>
											
											<?php
											$names="";
											$qtys="";
											$totals="";
											foreach($uniq_mat_name as $kk => $one_mat_names)
											{
												$names .= $uniq_mat_name[$kk].", ";
												$qtys .= $uniq_mat_qty[$kk].", ";
												$totals .= $uniq_mat_amnt[$kk].", ";
											}
											
											?>
											<!--<td style="white-space:nowrap;text-align:center;"><?php //echo $names?></td>
											<td style="white-space:nowrap;text-align:center;"><?php //echo $qtys?></td>
											<td style="white-space:nowrap;text-align:center;"><?php //echo $totals?></td>-->
											<td style="text-align:center;">
										
											<?php
											//if perfoma type is excel then only excel button view
											if($row["perfoma_type"]=="direct_perfoma_excel")
											{
										    ?>
											<a href="span_edit_direct_perfoma_excel_upload.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;Direct perfoma Excel&nbsp;&nbsp;</a>
											
											<a href="span_invoice_excel_upload_for_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(E) Invoice Excel&nbsp;&nbsp;</a>
											&nbsp;
											<?php											
											}
											else if($row["perfoma_type"]=="excel")
											{
											 ?>
											<a href="span_perfoma_excel_upload.php?chk_array=<?php echo $row['trf_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(E) perfoma Excel&nbsp;&nbsp;</a>
											
											<a href="span_invoice_excel_upload.php?chk_array=<?php echo $row['trf_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(E) Invoice Excel&nbsp;&nbsp;</a>
											&nbsp;
											<?php											
											
											    
											
											}else
											{
											?>
											<?php
                                            if($row["perfoma_type"]=="direct_perfoma")
											{
											?>
											<a href="span_edit_new_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D) perfoma&nbsp;&nbsp;</a>
											&nbsp;
											
											<a href="span_set_rate_only_by_test_of_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D)<?php echo $make_test_bill;?> Invoice By Test&nbsp;&nbsp;</a>
											
											<a href="span_set_rate_only_by_material_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D)<?php echo $make_material_bill;?> Invoice By Material&nbsp;&nbsp;</a>
											
											<a href="span_set_rate_only_for_estimate_direct_perfoma.php?perfoma_no=<?php echo $row['perfoma_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span>&nbsp;(D)<?php echo $make_estiamte;?> Estimate&nbsp;&nbsp;</a>
											
											<?php 
											}
											else
											{
												if($row["make_by"]=="0"){
												?>
												<!--<a href="update_perfoma.php?perfoma_nos=<?php //echo $row['perfoma_no'];?>" class="btn btn-primary" title=""><span class="glyphicon glyphicon-question-list" ></span> &nbsp;proforma&nbsp;&nbsp;</a>-->
												&nbsp;
												<a href="invoice_print.php?perfoma_nos=<?php echo $row['perfoma_no'];?>&&print_counts=<?php echo base64_encode($row["print_counts"]); ?>" class="btn btn-primary" title="" target="_blank">&nbsp;Print&nbsp;&nbsp;</a>
												&nbsp;
												<?php }else{?>
												<!--<a href="update_perfoma_by_material.php?perfoma_nos=<?php //echo $row['perfoma_no'];?>" class="btn btn-primary" title=""><span class="glyphicon glyphicon-question-list" ></span> &nbsp;proforma&nbsp;&nbsp;</a>-->
												
												<a href="invoice_print_by_material.php?perfoma_nos=<?php echo $row['perfoma_no'];?>&&print_counts=<?php echo base64_encode($row["print_counts"]); ?>" class="btn btn-primary" title="" target="_blank">&nbsp;Print&nbsp;&nbsp;</a>
												&nbsp;
												<?php } ?>
												
												<!--<a href="make_bill.php?perfoma_nos=<?php //echo $row['perfoma_no'];?>" class="btn btn-primary" title="" target="_blank">&nbsp;Invoice&nbsp;&nbsp;</a>
												
												<a href="perfoma_print_by_material.php?perfoma_nos=<?php //echo $row['perfoma_no'];?>&&print_counts=<?php //echo base64_encode($row["print_counts"]); ?>" class="btn btn-primary" title="" target="_blank">&nbsp;Estimate&nbsp;&nbsp;</a>-->
												
												
												<!--<a href="span_set_rate_only_for_estimate_merging.php?chk_array=<?php //echo $row['trf_no'];?>" class=" btn-info" title=""><span class="glyphicon glyphicon-question-list"></span><?php //echo $make_estiamte;?> &nbsp;Estimate&nbsp;&nbsp;</a>-->
												<?php
												
												
											}
											}
											
											if($row["perfoma_type"] !="direct_perfoma" && $row["perfoma_type"] !="direct_perfoma_excel")
											{
											?>
											<a href="list_of_multi_trf.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-success" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> &nbsp;Trf&nbsp;&nbsp;</a>
											&nbsp;
											
											<?php		
											}
											?>
											
											
											
											
											</td>
										</tr> 
									<?php
										}
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
	var table = $('#example2').DataTable( {
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
