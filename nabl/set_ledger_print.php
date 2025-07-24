<?php 
include("connection.php");
error_reporting("ALL");

if($_GET['start_date']!="" || $_GET['end_date']!="")
{
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

	$where=" AND entry_date BETWEEN '" . $start_date . "' AND  '" . $end_date."'";
	$datings=" From: ".date("d/m/Y",strtotime($start_date))." To ".date("d/m/Y",strtotime($end_date));
}else{
	$where="";
	$datings="";
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
	

?>
<table id="example1" class="table table-bordered table-striped" style="width:100%;font-family:Arial;" >
									<thead>
									
									<tr >
									<td ><center>
									<img src="images/mat_logo.png" style="width:80px;">
									</center></td>
									<td colspan="3" style="padding:5px;;font-size:20px;">
									<center><b>PTH Consultancy Services LLP</b></center>
									</td>
									</tr>
									<tr>
									<th colspan="5" style="text-align:center;font-size:16px;border-top:solid 1px black;">ACCOUNT STATEMENT</th>
									</tr>
									<tr>
									<th colspan="5" style="text-align:Left;font-size:12px;">Statement To : <?php echo $names;?></th>
									</tr>
									<tr>
									<th colspan="5" style="text-align:Left;font-size:12px;"><?php echo $datings;?></th>
									</tr>
									<tr >
										
										<th style="text-align:center;border-bottom:1px solid black;">Date</th>
										<th style="text-align:left;border-bottom:1px solid black;">Particular </th>
										<th style="text-align:center;border-bottom:1px solid black;">Debit</th>
										<th style="text-align:center;border-bottom:1px solid black;">Credit</th>
										<th style="text-align:center;border-bottom:1px solid black;">Closing</th>
																	
								
									</tr>
								</thead>
								<tbody>
									<?php
									
										$count=0;
										$closings=0;
										
										$query="select * from st_ledger where `is_deleted`=0".$sets.$where." ORDER BY ledger_id ASC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{$mt_cnt=0;
											$count++;
											
											if($row["entry_type"]=="billing")
											{
												$closings= floatval($closings) + floatval($row["credits"]);
											}
											else
											{
												$closings= floatval($closings) - floatval($row["debits"]);
											}
											
									?>
											<tr>
											<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($row['entry_date']));?></td>
											<td style="text-align:Left;"><?php echo $row["user_name"]." Ref:";?>
											<?php 
											if($row["bill_no"] !="0")
											{
													echo $row["bill_no"];
											}
											
											if($row["receipt_no"] !="0")
											{
													echo $row["receipt_no"];
											}
											
											?>
											
											</td>
											<td style="text-align:center;">
											<?php 
											if($row["debits"] !="0")
											{
												echo $row["debits"];
											}
											
											?>
											</td>
											<td style="text-align:center;">
											<?php 
											if($row["credits"] !="0")
											{
												echo $row["credits"];
											}
											
											?>
											</td>
											<td style="text-align:center;"><b><?php echo $closings;?><b></td>
											
										</tr>
									<?php
										}	
									?>
									<tr>
									<td colspan="5" style="text-align:center;border-top:1px dashed black;">&nbsp;</td>
									</tr>
									
									<tr>
									<td colspan="3">&nbsp;</td>
									<td style="text-align:Right;">Closing Balance : </td>
									<td style="text-align:center;"><b><?php echo $closings;?><b></td>
									</tr>
									
									
									
									<!--<tr>
									<td colspan="9">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
										<td><b>TOTAL</b></td>
										<td><b>PAID</b></td>
										<td><b>REMAIN</b></td>
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
										<td><b><?php //echo $total_balance;?></b></td>
										<td><b><?php //echo $paid_balance;?></b></td>
										<td><b><?php //echo $remain_balance;?></b></td>
									</tr>-->
								</tbody>
						
							  </table>
