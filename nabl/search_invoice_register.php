

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
array($_POST["sel_agency_ids"]," AND `agency_id` LIKE '%".$_POST['sel_agency_ids']."%'"),
array($_POST["old_bill_no"]," AND `old_bill_no` LIKE '%".$_POST['old_bill_no']."%'"),
array($_POST["bill_no"]," AND `bill_no` LIKE '%".$_POST['bill_no']."%'"),
array($_POST["bill_amnt_id"]," AND `total_amt` LIKE '%".$_POST['bill_amnt_id']."%'"),
array($_POST["cheque_no"]," AND `chequeno` LIKE '%".$_POST['cheque_no']."%'"),
array($_POST["bank_name"]," AND `bank_name` LIKE '%".$_POST['bank_name']."%'"),
array($_POST["tds_amt"]," AND `tds` LIKE '%".$_POST['tds_amt']."%'"),
array($_POST["paid_amt"]," AND `paid_amt` LIKE '%".$_POST['paid_amt']."%'"),
array($_POST["cheque_amt"]," AND `cheque_amt` LIKE '%".$_POST['cheque_amt']."%'"),
array($_POST["remarks"]," AND `remarks` LIKE '%".$_POST['remarks']."%'")
);

$where="";
foreach($arraying as $keys =>$one_array)
{
	if($one_array[0]!="")
	{
		$where .=$one_array[1];
	}
}
$search_customer_name=$_POST["customer_name"];
if($search_customer_name !="")
{
	$where_clients=" AND `client_code`='$search_customer_name'";
}else
{
	$where_clients="";
}

?>

	<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Agency Name</th>
										<th style="text-align:center;">Old Bill No</th>
										<th style="text-align:center;">Bill No</th>
										<th style="text-align:center;">Name of Department</th>
										<th style="text-align:center;">Bill Amount</th>
										<th style="text-align:center;">Cheque Date</th>
										<th style="text-align:center;">Cheque No.</th>
										<th style="text-align:center;">Bank Name</th>
										<th style="text-align:center;">TDS</th>
										<th style="text-align:center;">Paid Amount</th>
										<th style="text-align:center;">Remarks</th>
										<th style="text-align:center;">Cheque Amount</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
								// if data of bill in estimate_test table
								$count=1;
								 $sel_test_table="select * from estimate_total_span_only_for_test where `est_isdeleted`=0".$where;
								$result_test_table =mysqli_query($conn,$sel_test_table);
								if(mysqli_num_rows($result_test_table)>0)
								{
								while($row_test =mysqli_fetch_array($result_test_table))
								{
									      $agency_id=$row_test["agency_id"];
										  $bill_amt=$row_test["total_amt"];
										  $old_bill_no=$row_test["old_bill_no"];
										  $cheque_date=$row_test["ch_date"];
										  $cheque_no=$row_test["chequeno"];
										  $bank_name=$row_test["bank_name"];
										  $tds=$row_test["tds"];
										  $paid_amt=$row_test["paid_amt"];
										  $remarks=$row_test["remarks"];
										  $cheque_amt=$row_test["cheque_amt"];
										  $invoice_type=$row_test["invoice_type"];
										  $excel_upload=$row_test["invoice_excel_upload"];
										  $trf_no=$row_test["trf_no"];
										  $perfoma_no=$row_test["perfoma_no"];
										  $customer_name=$row_test["customer_name"];
										  $est_id=$row_test["est_id"];
										  $table_type="test";
										  $what="test_mathi";

										  $sel_agency="select * from agency_master where `agency_id`=".$agency_id;
										  $result_agency =mysqli_query($conn,$sel_agency);
										  $row_agency =mysqli_fetch_array($result_agency);
										  $agency_name=$row_agency["agency_name"];

										  $explode_trf=explode(",",$trf_no);
										  $set_trf_no=$explode_trf[0];
										  $sel_jobs="select * from job where `trf_no`='$set_trf_no'".$where_clients;
										  $result_job=mysqli_query($conn,$sel_jobs);
										  $row_job =mysqli_fetch_array($result_job);
										  $clientname=$row_job["clientname"];

										  if($invoice_type=="direct_perfoma" || $invoice_type=="direct")
										  {
										  	$clientname=$customer_name;
										  }
								?>

								       <tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;"><?php echo $row["estimate_date"];?></td>
											<td style="text-align:center;"><?php echo $agency_name;?></td>
											<td style="text-align:center;"><?php echo $old_bill_no;?></td>
											<td style="text-align:center;"><?php echo $row["bill_no"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $clientname;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $bill_amt;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_date;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_no;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $bank_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $tds;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $paid_amt;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $remarks;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_amt;?></td>
											<td style="text-align:center;">&nbsp;</td>
										</tr>
								<?php
								$count++;
								}
								}
								//if data of bill in estimate_material table
								$sel_mat_table="select * from estimate_total_span_only_for_material where `est_isdeleted`=0".$where;
							    $result_mat_table =mysqli_query($conn,$sel_mat_table);
								if(mysqli_num_rows($result_mat_table)>0)
								{
								while($row_mat =mysqli_fetch_array($result_mat_table))
								{
									   $agency_id=$row_mat["agency_id"];
									   $bill_amt=$row_mat["total_amt"];
									   $old_bill_no=$row_mat["old_bill_no"];
									   $cheque_date=$row_mat["ch_date"];
									   $cheque_no=$row_mat["chequeno"];
									   $bank_name=$row_mat["bank_name"];
									   $tds=$row_mat["tds"];
									   $paid_amt=$row_mat["paid_amt"];
									   $remarks=$row_mat["remarks"];
									   $cheque_amt=$row_mat["cheque_amt"];
									   $invoice_type=$row_mat["invoice_type"];
									   $excel_upload="";
									   $trf_no=$row_mat["trf_no"];
									   $perfoma_no=$row_mat["perfoma_no"];
									   $customer_name=$row_mat["customer_name"];
									   $est_id=$row_mat["est_id"];
									   $table_type="material";
									   $what="mat_mathi";

									   $sel_agency="select * from agency_master where `agency_id`=".$agency_id;
									   $result_agency =mysqli_query($conn,$sel_agency);
									   $row_agency =mysqli_fetch_array($result_agency);
									   $agency_name=$row_agency["agency_name"];

									   $explode_trf=explode(",",$trf_no);
									   $set_trf_no=$explode_trf[0];
									   $sel_jobs="select * from job where `trf_no`='$set_trf_no'";
									   $result_job=mysqli_query($conn,$sel_jobs);
									   $row_job =mysqli_fetch_array($result_job);
									   $clientname=$row_job["clientname"];

									   if($invoice_type=="direct_perfoma" || $invoice_type=="direct")
									   {
									   	$clientname=$customer_name;
									   }
								?>
								      <tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;"><?php echo $row["estimate_date"];?></td>
											<td style="text-align:center;"><?php echo $agency_name;?></td>
											<td style="text-align:center;"><?php echo $old_bill_no;?></td>
											<td style="text-align:center;"><?php echo $row["bill_no"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $clientname;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $bill_amt;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_date;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_no;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $bank_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $tds;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $paid_amt;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $remarks;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $cheque_amt;?></td>
											<td style="text-align:center;">&nbsp;</td>
										</tr>
								<?php
								$count++;
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
