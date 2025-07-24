<?php
session_start();
include("connection.php");
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
{
		 if($_POST['action_type'] == 'one_changes')
		{
			$user_types=$_POST['user_types'];
			$sends=$_POST['sends'];
			
			$sel_voch="select * from st_balance_sheet WHERE `user_type`='$user_types' AND `user_id`='$sends'";
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
		else if($_POST['action_type'] == 'add_purchase_out')
		{
			$pur_code=$_POST['pur_code'];
			$explodes=explode("|",$_POST['party_name']);
			$party_id=$explodes[0];
			$party_name=$explodes[1];
			$replace_date= str_replace("/","-",$_POST['bill_date']);
			$bill_date= date('Y-m-d', strtotime($replace_date));
			$gst_no=$_POST['gst_no'];
			$bill_no=$_POST['bill_no'];
			$taxable_amnt=$_POST['taxable_amnt'];
			$cgst_amnt=$_POST['cgst_amnt'];
			$sgst_amnt=$_POST['sgst_amnt'];
			$igst_amnt=$_POST['igst_amnt'];
			$total_amnt=$_POST['total_amnt'];
			$tds_amnt=$_POST['tds_amnt'];
			$discripts=$_POST['discripts'];
			$payment_type=$_POST['payment_type'];
			
			
				
				$sel_voch="select * from purchages_out ORDER BY purchage_out_id DESC LIMIT 0,1";
				$query_vouch=mysqli_query($conn,$sel_voch);
				if(mysqli_num_rows($query_vouch) > 0)
				{
					$one_vouch=mysqli_fetch_array($query_vouch);
					$explodings=explode("/",$one_vouch["purchage_out_code"]);
					$lasts=intval($explodings[2])+1;
					$sets= sprintf('%04d', $lasts);
					
					$txt_vouch=$pur_out_first_parts.$sets;
				}else{
					$txt_vouch=$pur_out_first_parts."0001";
				}
				$todays=date("Y-m-d");
				$insert_job_only="INSERT INTO `purchages_out`(`purchage_out_code`,`party_id`, `party_name`, `gst_no`, `bill_no`, `bill_date`, `taxable_amnt`,`sgst`,`cgst`,`igst`,`total_amnt`,`tds_amnt`,`remark`, `created_date`,`payment_type`, `created_by`) values(
						'$txt_vouch',
						'$party_id',
						'$party_name',
						'$gst_no',
						'$bill_no',
						'$bill_date',
						'0',
						'0',
						'0',
						'0',
						'$total_amnt',
						'$tds_amnt',
						'$discripts',
						'$todays',
						'$payment_type',
						'$_SESSION[name]')";
				mysqli_query($conn,$insert_job_only);
				
				$sel_balance="select * from party_balance_sheet where `user_type`='party' AND `user_id`='$party_id'";
				$query_balance=mysqli_query($conn,$sel_balance);
				
				if(mysqli_num_rows($query_balance) > 0)
				{
					$one_blalance=mysqli_fetch_array($query_balance);
					$totals= $one_blalance["total_balance"];
					$paid_balance= $one_blalance["paid_balance"];
					$remain_balance= $one_blalance["remain_balance"];
					
					$plus_tds= floatval($total_amnt) + floatval($tds_amnt);
					$set_paid= floatval($paid_balance) + floatval($plus_tds);
					$set_remain= floatval($remain_balance) - floatval($plus_tds);
					
					
					$up_balance="update party_balance_sheet set `paid_balance`='$set_paid',`remain_balance`='$set_remain',`last_action`='purchage_out' where `user_type`='party' AND `user_id`='$party_id'";
					mysqli_query($conn,$up_balance);
					
					$ins_ledger="insert into party_ledger(`user_type`,`entry_type`,`user_id`,`user_name`,`bill_no`,`receipt_no`,`entry_date`,`totals_amnt`,`tds_amnt`,`debits`,`credits`,`created_by`,`created_name`)VALUES('party','purchase_out','$party_id','$party_name','$txt_vouch','0','$bill_date','$total_amnt','$tds_amnt','$plus_tds','0','29','KINJAL SORTHIYA')";
					mysqli_query($conn,$ins_ledger);
					
					
				}
			
			
			$fill = array("status" => "1","msg" => "Purchage Bill Successfully Inserted");
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'edit_purchase_out')
		{
			$pur_code=$_POST['pur_code'];
			$explodings=explode("|",$_POST['party_name']);
			$party_id=$explodings[0];
			$party_name=$explodings[1];
			$replace_date= str_replace("/","-",$_POST['bill_date']);
			$bill_date= date('Y-m-d', strtotime($replace_date));
			$gst_no=$_POST['gst_no'];
			$bill_no=$_POST['bill_no'];
			$taxable_amnt="0";
			$cgst_amnt="0";
			$sgst_amnt="0";
			$igst_amnt="0";
			$total_amnt=$_POST['total_amnt'];
			$tds_amnt=$_POST['tds_amnt'];
			$discripts=$_POST['discripts'];
			$txt_id=$_POST['txt_id'];
			$payment_type=$_POST['payment_type'];
			$plusings=floatval($total_amnt) + floatval($tds_amnt);
			
			$sel_perfomas="select * from purchages_out where `purchage_out_id`=".$txt_id;
			$result_perfomas=mysqli_query($conn,$sel_perfomas);
			$get_perfomas=mysqli_fetch_array($result_perfomas);
			$total_amting=floatval($get_perfomas["total_amnt"]) + floatval($get_perfomas["tds_amnt"]);
			

				$todays=date("Y-m-d");
				$insert_job_only="update `purchages_out` set `party_id`='$party_id',`party_name`='$party_name', `gst_no`='$gst_no', `bill_no`='$bill_no', `bill_date`='$bill_date', `taxable_amnt`='$taxable_amnt', `sgst`='$sgst_amnt', `cgst`='$cgst_amnt', `igst`='$igst_amnt', `total_amnt`='$total_amnt', `tds_amnt`='$tds_amnt', `remark`='$discripts', `payment_type`='$payment_type' where `purchage_out_id`=".$txt_id;
				mysqli_query($conn,$insert_job_only);
				
				$sel_balance="select * from party_balance_sheet where `user_type`='party' AND `user_id`='$party_id'";
				$query_balance=mysqli_query($conn,$sel_balance);
				
				if(mysqli_num_rows($query_balance) > 0)
				{
					$one_blalance=mysqli_fetch_array($query_balance);
					$totals= $one_blalance["total_balance"];
					$paid= $one_blalance["paid_balance"];
					$remain= $one_blalance["remain_balance"];
					
					$set_paid= floatval($paid) - floatval($total_amting);
					$set_remain= floatval($remain) + floatval($total_amting);
					
					
					$up_balance="update party_balance_sheet set `paid_balance`='$set_paid',`remain_balance`='$set_remain',`last_action`='update_purchage' where `user_type`='party' AND `user_id`='$party_id'";
					mysqli_query($conn,$up_balance);
					
					$del_legders="delete from party_ledger where `bill_no`='$pur_code'";
					$query_ledgs=mysqli_query($conn,$del_legders);
					
					
					$ins_ledger="insert into party_ledger(`user_type`,`entry_type`,`user_id`,`user_name`,`bill_no`,`receipt_no`,`entry_date`,`totals_amnt`,`tds_amnt`,`debits`,`credits`,`created_by`,`created_name`)VALUES('party','purchase_out','$party_id','$party_name','$bill_no','0','$bill_date','$total_amnt','$tds_amnt','$plusings','0','29','KINJAL SORTHIYA')";
					mysqli_query($conn,$ins_ledger);
				}
				
				$sel_balances="select * from party_balance_sheet where `user_type`='party' AND `user_id`='$party_id'";
				$query_balances=mysqli_query($conn,$sel_balances);
				
				if(mysqli_num_rows($query_balances) > 0)
				{
					$one_blalances=mysqli_fetch_array($query_balances);
					$totals= $one_blalances["total_balance"];
					$paid= $one_blalances["paid_balance"];
					$remain= $one_blalances["remain_balance"];
					
					
					$set_paid= floatval($paid) + floatval($plusings);
					$set_remain= floatval($remain) - floatval($plusings);
					
					$up_balance="update party_balance_sheet set `paid_balance`='$set_paid',`remain_balance`='$set_remain',`last_action`='update_purchase_out' where `user_type`='party' AND `user_id`='$party_id'";
					mysqli_query($conn,$up_balance);
					
				}
			
			
			$fill = array("status" => "1","msg" => "Cheque Successfully Updated");
			echo json_encode($fill);
		}
		
		else if($_POST['action_type'] == 'change_amnt')
		{
			$taxable_amnt=$_POST['taxable_amnt'];
			
			$c_gst_amt= floatval($taxable_amnt) / 100 *9;
			$s_gst_amt= floatval($taxable_amnt) / 100 *9;
			$totals= floatval($taxable_amnt) + floatval($c_gst_amt) + floatval($s_gst_amt);
			
			$fill = array("status" => "1","c_gst_amt" => $c_gst_amt,"s_gst_amt" => $s_gst_amt,"totals" => $totals);
			echo json_encode($fill);
		}
		else if($_POST['action_type'] == 'change_party')
		{
			$exploding=explode("|",$_POST['party_name']);
			$party_id=$exploding[0];
			$party_name=$exploding[1];
			
			$sel_estiamte="select * from party_master where `party_id`=".$party_id;
			$estiamte_query= mysqli_query($conn,$sel_estiamte);
			$get_estimate= mysqli_fetch_array($estiamte_query);
			$party_gst=$get_estimate["party_gst"];
			
			$sel_balance="select * from party_balance_sheet where `user_type`='party' AND `user_id`='$party_id'";
			$query_balance=mysqli_query($conn,$sel_balance);
			$one_blalance=mysqli_fetch_array($query_balance);
			$get_totals= $one_blalance["total_balance"];
			$get_paid= $one_blalance["paid_balance"];
			$get_remain= $one_blalance["remain_balance"];
			
			
			$fill = array("party_gst" => $party_gst,"get_totals" => $get_totals,"get_paid" => $get_paid,"get_remain" => $get_remain);
			echo json_encode($fill);
		}else if($_POST['action_type'] == 'delete_vouch')
		{
			$delete_vouch_id=$_POST["delete_vouch_id"];
			$sel_estiamte="select * from purchages_out where `purchage_out_id`=".$delete_vouch_id;
			$estiamte_query= mysqli_query($conn,$sel_estiamte);
			$get_estimate= mysqli_fetch_array($estiamte_query);
			$user_id=$get_estimate["party_id"];
			$total_amting=$get_estimate["total_amnt"];
			$bill_no=$get_estimate["purchage_out_code"];
			
			
			$sel_balance="select * from party_balance_sheet where `user_type`='party' AND `user_id`='$user_id'";
		$query_balance=mysqli_query($conn,$sel_balance);
		
		if(mysqli_num_rows($query_balance) > 0)
		{
			$one_blalance=mysqli_fetch_array($query_balance);
			$totals= $one_blalance["total_balance"];
			$paid= $one_blalance["paid_balance"];
			$remain= $one_blalance["remain_balance"];
			
			$set_paid= floatval($paid) - floatval($total_amting);
			$set_remain= floatval($remain) + floatval($total_amting);
			
			
			$up_balance="update party_balance_sheet set `paid_balance`='$set_paid',`remain_balance`='$set_remain',`last_action`='delete_purchase_in' where `user_type`='party' AND `user_id`='$user_id'";
			mysqli_query($conn,$up_balance);
			
			$del_legders="delete from party_ledger where `bill_no`='$bill_no' AND `user_id`='$user_id' AND `entry_type`='purchase_out'";
			$query_ledgs=mysqli_query($conn,$del_legders);
			
		}
			
			
			$del_vouch="delete from purchages_out where `purchage_out_id`=".$delete_vouch_id;
			mysqli_query($conn,$del_vouch);			
		}
	
}

function numtowords($num){
	$number = $num;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
 // return $result . "Rupees  " . $points;
 return strtoupper($result . "Rupees  Only");
}
?>