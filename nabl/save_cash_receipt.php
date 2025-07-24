<?php
session_start();
include("connection.php");
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
{
		 if($_POST['action_type'] == 'one_changes')
		{
			$user_types=$_POST['user_types'];
			$sends=$_POST['sends'];
			
			$sel_voch="select * from cash_balance_sheet WHERE `user_type`='$user_types' AND `user_id`='$sends'";
			$query_vouch=mysqli_query($conn,$sel_voch);
			if(mysqli_num_rows($query_vouch) > 0)
			{
				$one_vouch=mysqli_fetch_array($query_vouch);
				$total_balance=$one_vouch["total_balance"];
				$paid_balance=$one_vouch["paid_balance"];
				$remain_balance=$one_vouch["remain_balance"];
			}else{
				$total_balance="0";
				$paid_balance="0";
				$remain_balance="0";
			}
		
			$fill = array("total_balance" => $total_balance,"paid_balance" => $paid_balance,"remain_balance" => $remain_balance);
					echo json_encode($fill);
			
		}else if($_POST['action_type'] == 'for_bill_gets')
		{
			$bill_to=$_POST['bill_to'];
			$user_ids=$_POST['user_ids'];
			
			if($bill_to=="0")
			{
				$wheres=" AND `bill_to`='$bill_to' AND `agency_id`='$user_ids'";
			}else if($bill_to=="1")
			{
				$wheres=" AND `bill_to`='$bill_to' AND `client_code`='$user_ids'";			
			}else
			{
				$wheres=" AND `bill_to`='$bill_to' AND `oth_cust_id`='$user_ids'";
			}
			$designs='<table style="width:100%;" border="1">';
			$designs .="<tr><th>R</th><th>sr</th><th>Party Name</th><th>bill no</th><th>Grand Total</th><th>Cgst</th><th>Sgst</th><th>Total</th></tr>";
			
			$sel_voch="select * from estimate_total_span_only_for_material WHERE `est_isdeleted`=0 AND `is_bill_done`='0'".$wheres;
			$query_vouch=mysqli_query($conn,$sel_voch);
			if(mysqli_num_rows($query_vouch) > 0)
			{
				$countings=1;
				while($ones=mysqli_fetch_array($query_vouch))
				{
					$designs .='<tr>';
					$designs .='<td>'.'<input type="checkbox" class="chk_class_bill" value="'.$ones["bill_no"].'|'.$ones["est_id"].'">'.'</td>';
					$designs .='<td>'.$countings.'</td>';
					$designs .='<td>'.$ones["bill_to_name"].'</td>';
					$designs .='<td>'.$ones["bill_no"].'</td>';
					$designs .='<td>'.$ones["grand_total"].'</td>';
					$designs .='<td>'.$ones["c_gst_amt"].'</td>';
					$designs .='<td>'.$ones["s_gst_amt"].'</td>';
					$designs .='<td>'.$ones["total_amt"].'</td>';
					$designs .='</tr>';
					$countings++;
				}
			}
			else
			{
				$designs .='<tr><td colspan="8">NO RECORDS</td></tr>';
			}
			
			$designs .="</table>";
			$fill = array("designs" => $designs);
					echo json_encode($fill);
			
		}
		else if($_POST['action_type'] == 'add_receipt')
		{
			$user_type=$_POST['user_type'];
			$user_ids=$_POST['sends'];
			$replace_date= str_replace("/","-",$_POST['receipt_date']);
			$receipt_date= date('Y-m-d', strtotime($replace_date));
			$pay_type=$_POST['pay_type'];
			$payment_amounts=$_POST['payment_amounts'];
			$tds_amounts=$_POST['tds_amounts'];
			$total_amounts=$_POST['total_amounts'];
			$discripts=$_POST['discripts'];
			
			$balance="select * from cash_balance_sheet where `user_id`='$user_ids' AND `user_type`='$user_type'";
				$query_balance=mysqli_query($conn,$balance);
				if(mysqli_num_rows($query_balance) > 0)
				{
					$one_bal=mysqli_fetch_array($query_balance);
					$total_balance=$one_bal["total_balance"];
					$paid_balance=$one_bal["paid_balance"];
					$remain_balance=$one_bal["remain_balance"];
					$names=$one_bal["user_name"];
					
					$set_paid= floatval($paid_balance) + floatval($total_amounts);
					$set_remain= floatval($remain_balance) - floatval($total_amounts);
					
					$up_balance="update cash_balance_sheet set `paid_balance`='$set_paid',`remain_balance`='$set_remain',`last_action`='cash_Receipt_add' where `user_type`='$user_type' AND `user_id`='$user_ids'";
					mysqli_query($conn,$up_balance);
				}else{
					$names="";
				}
				
				$sel_voch="select * from cash_receipt ORDER BY receipt_id DESC LIMIT 0,1";
				$query_vouch=mysqli_query($conn,$sel_voch);
				if(mysqli_num_rows($query_vouch) > 0)
				{
					$one_vouch=mysqli_fetch_array($query_vouch);
					$explodings=explode("/",$one_vouch["receipt_code"]);
					$lasts=intval($explodings[1])+1;
					$sets= sprintf('%04d', $lasts);
					
					$txt_vouch=$cash_first_parts.$sets;
				}else{
					$txt_vouch=$cash_first_parts."0001";
				}
				$todays=date("Y-m-d");
				$insert_job_only="INSERT INTO `cash_receipt`(`user_type`, `user_id`, `user_name`, `receipt_code`, `receipt_date`, `payment_amount`, `tds_amout`, `total_amount`, `payment_type`, `remark`, `created_by`, `created_date`) values(
						'$user_type',
						'$user_ids',
						'$names',
						'$txt_vouch',
						'$receipt_date',
						'$payment_amounts',
						'$tds_amounts',
						'$total_amounts',
						'$pay_type',
						'$discripts',
						'$_SESSION[name]',
						'$todays')";
				mysqli_query($conn,$insert_job_only);
				
				$ins_ledger="insert into st_ledger(`user_type`,`entry_type`,`user_id`,`user_name`,`bill_no`,`receipt_no`,`entry_date`,`debits`,`credits`,`created_by`,`created_name`)VALUES('$user_type','cash_receipting','$user_ids','$names','0','$txt_vouch','$receipt_date','$total_amounts','0','29','KINJAL SORTHIYA')";
		mysqli_query($conn,$ins_ledger);
			
			
			
			$fill = array("status" => "1","msg" => "Successfully Done");
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'delete_cash_receipt')
		{
			$delete_rec_id=$_POST["delete_rec_id"];
			
			$sel_voch="select * from cash_receipt where `receipt_id`=".$delete_rec_id;
			$query_vouch=mysqli_query($conn,$sel_voch);
			if(mysqli_num_rows($query_vouch) > 0)
			{
				$one_vouch=mysqli_fetch_array($query_vouch);
				$user_type=$one_vouch["user_type"];
				$user_id=$one_vouch["user_id"];
				$receipt_code=$one_vouch["receipt_code"];
				$total_amount=$one_vouch["total_amount"];
				
				$sel_balances="select * from cash_balance_sheet where `user_type`='$user_type' AND `user_id`='$user_id'";
				$query_balances=mysqli_query($conn,$sel_balances);
				
				if(mysqli_num_rows($query_balances) > 0)
				{
					$one_blalances=mysqli_fetch_array($query_balances);
					$totals= $one_blalances["total_balance"];
					$paid= $one_blalances["paid_balance"];
					$remain= $one_blalances["remain_balance"];
					
					//$set_total= floatval($totals) + floatval($total_amount);
					$set_paid= floatval($paid) - floatval($total_amount);
					$set_remain= floatval($remain) + floatval($total_amount);
					
					$up_balance="update cash_balance_sheet set `paid_balance`='$set_paid',`remain_balance`='$set_remain',`last_action`='cash_receipt_delete' where `user_type`='$user_type' AND `user_id`='$user_id'";
					mysqli_query($conn,$up_balance);
					
				}
				
				$del_ledger="delete from st_ledger where `receipt_no`='$receipt_code'";
				mysqli_query($conn,$del_ledger);
			}
			$del_vouch="delete from cash_receipt where `receipt_id`=".$delete_rec_id;
			mysqli_query($conn,$del_vouch);			
		}
	
    exit;
	
}
?>