<?php 
include("connection.php");
error_reporting("ALL");

if($_GET['start_date']!="" || $_GET['end_date']!="")
{
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

	$where=" AND receipt_date BETWEEN '" . $start_date . "' AND  '" . $end_date."'";
}else{
	$where="";
}


if($_GET["u_types"]=="0")
{
	$u_types="agency";
	$sets=" AND `user_type`='$u_types' AND `user_id`='$_GET[user_id]'";
	$user_id=$_GET["user_id"];
	$sel_balances="select * from st_balance_sheet where `user_type`='$u_types' AND `user_id`='$user_id' AND `is_deleted`='0'";
}else if ($_GET["u_types"]=="1"){
	$u_types="clients";
	$sets=" AND `user_type`='$u_types' AND `user_id`='$_GET[user_id]'";
	$user_id=$_GET["user_id"];
	$sel_balances="select * from st_balance_sheet where `user_type`='$u_types' AND `user_id`='$user_id' AND `is_deleted`='0'";
}else if ($_GET["u_types"]=="2"){
	$u_types="other_customer";
	$sets=" AND `user_type`='$u_types' AND `user_id`='$_GET[user_id]'";
	$user_id=$_GET["user_id"];
	$sel_balances="select * from st_balance_sheet where `user_type`='$u_types' AND `user_id`='$user_id' AND `is_deleted`='0'";
}
else
{
	$user_id=$_GET["user_id"];
	$sel_balances="select * from st_balance_sheet WHERE ".$where." AND `is_deleted`='0'";
}
	

	$query_balnce=mysqli_query($conn,$sel_balances);
	if(mysqli_num_rows($query_balnce) > 0)
	{
		$results=mysqli_fetch_array($query_balnce);
		$names=$results["user_name"];
		$total_balance=$results["total_balance"];
		$paid_balance=$results["paid_balance"];
		$remain_balance=$results["remain_balance"];
	}
	
if($_GET['pays']!="")
{
	$pays=" AND payment_type='" .$_GET['pays'] . "'";
}else{
	$pays="";
}
?>
<table id="example1" class="table table-bordered table-striped" cellspacing="0" border="1" style="width:100%">
									<thead>
									<tr>
									<th colspan="9" style="text-align:center;font-size:16px;">PAYMENT RECEIVED REPORT</th>
									</tr>
									<tr>
									<th colspan="9" style="text-align:center;font-size:16px;">Name :<?php echo $names;?></th>
									</tr>
									<tr >
										
										<th style="text-align:center;Width:2%">SR.No</th>
										<th style="text-align:center;Width:20%">Party Name</th>	
										<th style="text-align:center;Width:8%">receipt code</th>
										<th style="text-align:center;Width:8%">Receipt date</th>
										<th style="text-align:center;Width:9%">Payment  Amount</th>
										<th style="text-align:center;Width:9%">Tds Value</th>
										<th style="text-align:center;Width:11%">Total Amount</th>
										<th style="text-align:center;Width:11%">payment type</th>
										<th style="text-align:center;Width:22%">remark</th>										
								
									</tr>
								</thead>
								<tbody>
									<?php
									
										$count=0;
										
										 $query="select * from st_receipt where `is_deleted`='0'".$sets.$where.$pays." ORDER BY receipt_id ASC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{$mt_cnt=0;
											$count++;
											
									?>
											<tr style="text-align:center;">
											<td><?php echo $count;?></td>
											<?php
											
											$selecting="select * from  job where `tfr_no`='$row[trf_no]'";
											$queryings = mysqli_query($conn, $selecting);
											$getings = mysqli_fetch_array($queryings);
											
											if($row["bill_to"]=="0")
											{
												$clients="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$row["agency_id"];
												$query_client=mysqli_query($conn,$clients);
												$one_client=mysqli_fetch_array($query_client);
												$concect=$one_client["agency_name"];
												$gst_numbers=$one_client["agency_gstno"];
											}else if($row["bill_to"]=="1"){
												$clients="select * from client where `clientisdeleted`=0 AND `client_code`='$row[client_code]'";
												$query_client=mysqli_query($conn,$clients);
												$one_client=mysqli_fetch_array($query_client);
												$concect=$one_client["clientname"];
												$gst_numbers=$one_client["gst_no"];
											}else{
												$concect=$row["bill_to_name"];
												$gst_numbers="";
												
											}
											?>
											<td><?php echo $row["user_name"];?></td>
											<td><?php echo $row["receipt_code"];?></td>
											<td><?php echo date('d/m/Y', strtotime($row['receipt_date']));?></td>
											<td><?php echo $row["payment_amount"];?></td>
											<td><?php echo $row["tds_amout"];?></td>
											<td><?php echo $row["total_amount"];?></td>
											<td><?php echo $row["payment_type"];?></td>
											<td><?php echo $row["remark"];?></td>
										</tr>
									<?php
										}	
									?>
									<!--<tr>
									<td colspan="9">&nbsp;</td>
									</tr>
									
									<tr style="text-align:center">
										<td colspan="6">&nbsp;</td>
										<td><b>Total Amount (Rs.)</b></td>
										<td><b>Recevied Amount (Rs.)</b></td>
										<td><b>Pending Amount (Rs.)</b></td>
									</tr>
									<tr style="text-align:center;">
										<td colspan="6">&nbsp;</td>
										<td><b><?php //echo $total_balance;?></b></td>
										<td><b><?php //echo $paid_balance;?></b></td>
										<td><b><?php //echo $remain_balance;?></b></td>
									</tr>-->
								</tbody>
						
							  </table>