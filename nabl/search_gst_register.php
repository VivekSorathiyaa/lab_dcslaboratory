<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php 
session_start();
include("connection.php");
error_reporting("ALL");
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

	$where=" AND invoice_date BETWEEN '" . $start_date . "' AND  '" . $end_date."'";
	$where_pur=" AND bill_date BETWEEN '" . $start_date . "' AND  '" . $end_date."'";
	$months_name= date('M', strtotime($end_date));
	$year_name= date('Y', strtotime($end_date));
	$months_title="MONTH";
	$year_title="YEAR";
}else{
	$where="";
	$where_pur="";
	$months_name="";
	$months_title="";
	$year_title="";
	$year_name="";
}

$sends=$_POST["sends"];
$user_type=$_POST["user_type"];
if($_POST["user_type"] =="0")
{
	$sets=" AND `bill_to_id`='$_POST[sends]'";
	
}else if($_POST["user_type"] =="1")
{
	$sets=" AND `bill_to_id`='$_POST[sends]'";
	
}else if($_POST["user_type"] =="2")
{
	$sets=" AND `bill_to_name`='$_POST[sends]'";
	
}else{
	
	$sets="";
}


?>								
									
									<form action="admin_inward_print.php" method="POST" target="_blank">
									
									<input type="hidden" name="chk_job_card" value="<?php echo $base_url; ?>set_gst_print.php?sends=<?php echo $sends;?>&&start_date=<?php echo $start_date;?>&&end_date=<?php echo $end_date;?>&&user_type=<?php echo $user_type;?>">
									<input type="submit" name="submit_job_card" value="PRINT" class="btn btn-primary form-control" style="height:0%;width:10%;">
									</form>
									<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th colspan="13" style="text-align:center;font-family:Times New Roman, Times, serif;">PRAMUKH TEST HOUSE</th>
									</tr>
									
									<tr>
										<th style="text-align:center;font-family:Times New Roman, Times, serif;">&nbsp;</th>
										<th colspan="3" style="text-align:center;font-family:Times New Roman, Times, serif;">SALES DETAILS</th>
										
										<th style="text-align:center;font-family:Times New Roman, Times, serif;"><?php echo $months_title;?></th>
										<th style="text-align:center;font-family:Times New Roman, Times, serif;"><?php echo $months_name;?></th>
										<th style="text-align:center;font-family:Times New Roman, Times, serif;"><?php echo $year_title;?></th>
										<th style="text-align:center;font-family:Times New Roman, Times, serif;"><?php echo $year_name;?></th>
										<th colspan="5" style="text-align:center;font-family:Times New Roman, Times, serif;">&nbsp;</th>
									</tr>
									<tr>
										
										<th style="text-align:center;">SR. No</th>						
										<th style="text-align:center;">PARTY NAME</th>						
										<th style="text-align:center;">GST No</th>						
										<th style="text-align:center;">BILL No</th>						
										<th style="text-align:center;">BILL DATE</th>						
										<th style="text-align:center;">TAXABLE VALUE</th>						
										<th style="text-align:center;">CGST</th>						
										<th style="text-align:center;">SGST</th>						
										<th style="text-align:center;">IGST</th>						
										<th style="text-align:center;">TOTAL VALUE</th>						
										<th style="text-align:center;">CHALLAN NO.</th>						
										<th style="text-align:center;">RATE</th>						
										<th style="text-align:center;">REMARK</th>						
								
									</tr>
								</thead>
								<tbody>
									<?php
									
										$count=0;
										$total_c=0;
										$total_s=0;
										$total_i=0;
										$total_taxble=0;
										$totals=0;
										
										$query="select * from estimate_total_span where `which_made`='2'".$where.$sets." ORDER BY est_id ASC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<?php
											if($row["bill_to"]=="0")
											{
												$clients="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$row["bill_to_id"];
												$query_client=mysqli_query($conn,$clients);
												$one_client=mysqli_fetch_array($query_client);
												$concect=$one_client["agency_name"];
												$gst_numbers=$one_client["agency_gstno"];

											}else if($row["bill_to"]=="1")
											{
												$clients="select * from client where `clientisdeleted`=0 AND `client_code`='$row[bill_to_id]'";
												$query_client=mysqli_query($conn,$clients);
												$one_client=mysqli_fetch_array($query_client);
												$concect=$one_client["clientname"];
												$gst_numbers=$one_client["gst_no"];
											}else
											{
												$concect=$row["bill_to_name"];
												$gst_numbers=$row["gst_no"];
											}
											
											$total_s = floatval($total_s) + floatval($row["s_gst_amt"]);
											$total_c = floatval($total_c) + floatval($row["c_gst_amt"]);
											$total_i = floatval($total_i) + floatval($row["i_gst_amt"]);
											$total_taxble = floatval($total_taxble) + floatval($row["grand_total"]);
											$totals = floatval($totals) + floatval($row["total_amt"]);
											?>
											<td><?php echo $concect;?></td>
											<td style="text-align:center;"><?php echo $gst_numbers;?></td>
											<td style="text-align:center;"><?php echo $row["invoice_no"];?></td>
											<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($row['invoice_date']));?></td>
											<td style="text-align:center;"><?php echo $row["grand_total"];?></td>
											<td style="text-align:center;"><?php echo $row["s_gst_amt"];?></td>
											<td style="text-align:center;"><?php echo $row["c_gst_amt"];?></td>
											<td style="text-align:center;"><?php echo $row["i_gst_amt"];?></td>
											<td style="text-align:center;"><?php echo $row["total_amt"];?></td>
											<td style="text-align:center;">&nbsp;</td>
											<td style="text-align:center;">&nbsp;</td>
											<td style="text-align:center;">&nbsp;</td>
										</tr>
									<?php
										}	
									?>
									
											
									
										
									<tr><td colspan="13">&nbsp;<td></tr>
									<tr>
										<th style="text-align:center;font-family:Times New Roman, Times, serif;">&nbsp;</th>
										<th colspan="3" style="text-align:center;font-family:Times New Roman, Times, serif;">PURCHASE DETAILS</th>
										
										<th style="text-align:center;font-family:Times New Roman, Times, serif;"><?php echo $months_title;?></th>
										<th style="text-align:center;font-family:Times New Roman, Times, serif;"><?php echo $months_name;?></th>
										<th style="text-align:center;font-family:Times New Roman, Times, serif;"><?php echo $year_title;?></th>
										<th style="text-align:center;font-family:Times New Roman, Times, serif;"><?php echo $year_name;?></th>
										<th colspan="5" style="text-align:center;font-family:Times New Roman, Times, serif;">&nbsp;</th>
									</tr>
										
									<tr>
										
										<th style="text-align:center;">SR. No</th>						
										<th style="text-align:center;">PARTY NAME</th>						
										<th style="text-align:center;">GST No</th>						
										<th style="text-align:center;">BILL No</th>						
										<th style="text-align:center;">BILL DATE</th>						
										<th style="text-align:center;">TAXABLE VALUE</th>						
										<th style="text-align:center;">CGST</th>						
										<th style="text-align:center;">SGST</th>						
										<th style="text-align:center;">IGST</th>						
										<th style="text-align:center;">TOTAL VALUE</th>						
										<th style="text-align:center;">CHALLAN NO.</th>						
										<th style="text-align:center;">RATE</th>						
										<th style="text-align:center;">REMARK</th>						
								
									</tr>
									
									<?php
									$count_p=0;
									$total_c_p=0;
									$total_s_p=0;
									$total_i_p=0;
									$query_p="select * from purchages where `is_deleted`='0'".$where_pur." ORDER BY purchage_id ASC";
										$result_p=mysqli_query($conn,$query_p);
										while($row_p=mysqli_fetch_array($result_p))
										{
											$count_p++;
											
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count_p;?></td>
											<?php
											
											
											$total_s_p = floatval($total_s_p) + floatval($row_p["sgst"]);
											$total_c_p = floatval($total_c_p) + floatval($row_p["cgst"]);
											$total_i_p = floatval($total_i_p) + floatval($row_p["igst"]);
											?>
											<td style="text-align:center;"><?php echo $row_p["party_name"];?></td>
											<td style="text-align:center;"><?php echo $row_p["gst_no"];?></td>
											<td style="text-align:center;"><?php echo $row_p["bill_no"];?></td>
											<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($row_p['bill_date']));?></td>
											<td style="text-align:center;"><?php echo $row_p["taxable_amnt"];?></td>
											<td style="text-align:center;"><?php echo $row_p["cgst"];?></td>
											<td style="text-align:center;"><?php echo $row_p["sgst"];?></td>
											<td style="text-align:center;"><?php echo $row_p["igst"];?></td>
											<td style="text-align:center;"><?php echo $row_p["total_amnt"];?></td>
											<td style="text-align:center;">&nbsp;</td>
											<td style="text-align:center;">&nbsp;</td>
											<td style="text-align:center;">&nbsp;</td>
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