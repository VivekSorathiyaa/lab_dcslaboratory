<style>
@page { margin: 0; }
.tdclass{
    border: 1px solid black;
    font-size:12px;
	 font-family: arial;
}
.test {
    border-collapse: collapse;
}
</style>

<?php include("connection.php");

		$ess_id=$_GET['ess_id'];
		$query = "select * from estimate_bill_total_master WHERE est_sr_no='$ess_id'  AND `bt_isdeleted` = '0'";
		$result = mysqli_query($conn, $query);
		

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$chalan_no= $row['est_sr_no'];
			$sr_no= $row['sr_no'];
			$bill_explode=explode("/",$chalan_no);
			$year_explode=explode("-",$_GET["f_year"]);
			$bill_to_print="MGE/".$bill_explode[1]."/".($year_explode[1]-1)."-".$year_explode[1];
			
			if(isset($_GET["bill_sr_no"])){
				$bill_to_print=$_GET["bill_sr_no"];
				$caption_of_bill="Cash Bill No:";
			}else{
				$caption_of_bill="Estimate Chalan No:";
			}
			$agency_name=$row['agency_name'];
			$auth_name=$row['auth_name'];
			$auth_address=$row['auth_address'];
			$get_auth_state=$row['auth_state'];
			
			$state_query = "select * from state WHERE state_tincode='$get_auth_state'";
			$state_result = mysqli_query($conn, $state_query);
			$state_row = mysqli_fetch_assoc($state_result);
			$auth_state=$state_row['state_name'];
			
			$auth_statecode=$row['auth_statecode'];
			$auth_gstno=$row['auth_gstno'];
			$ref_date=$row['ref_date'];
			$inv_date=$row['inv_date'];
			$bill_in_word=$row['billamt_inword'];
			
			$query_billmaster = "select * from billmaster WHERE sr_no='$chalan_no'  AND `bill_isdeleted` = '0'";
			$result_billmaster = mysqli_query($conn, $query_billmaster);
			
			if (mysqli_num_rows($result_billmaster) > 0) {
				$row_billmaster = mysqli_fetch_assoc($result_billmaster);
				//$name_of_work=$row_billmaster['name_of_work'];
				$name_of_work= strip_tags(html_entity_decode($row_billmaster['name_of_work']),"<strong><em>");
				$ref_name=$row_billmaster['ref_name'];

			}

			
			
		}	
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<br>
<br>
<br>
<br>
<br>
<table align="center" width="90%" class="test">
	<tr>
		<td colspan="6" class="tdclass" style="height:5px;padding:5px;text-align:center;padding-left:100px;"><b>CASH BILL 		</b></td>
	</tr>
	<tr>
	<td colspan="6" class="tdclass" style="height:5px;text-align:center;">&nbsp;</td>
	</tr>
	
	<tr>
	<td  rowspan="3" class="tdclass" style="height:100px;padding:10px;text-align:center;width:200px;">
	<img src="<?php echo $base_url;?>/images/mge.png" height="100">
	</td>
	<td  class="tdclass" style="height:15px;padding:5px;"><b>Corporate Office:</b></td>
	<td  class="tdclass" style="height:15px;padding:5px;"><b>Branch Office:</b></td>
	</tr>
	<tr>
	
	<td  class="tdclass" style="height:30px;padding:5px;">
	<b>Meghraj Geotech Engineering</b>
	<br>
	40,Digvijay Plot,Pavanchakki,
	<br>
	Jamnagar(Gujarat)-361005
	<br>
	E-mail: meghraj_group@yahoo.com
	</td>
	<td  class="tdclass" style="height:30px;padding:5px;">
	<b>Meghraj Geotech Engineering</b>
	<br>
	40,Digvijay Plot,Pavanchakki,
	<br>
	Jamnagar(Gujarat)-361005
	<br>
	E-mail: meghraj_group@yahoo.com
	</td>
	</tr>
	<tr>
	
	<td  colspan="2" class="tdclass" style="padding:5px;"><b>GSTIN |</b> 24AAFPZ5523J1ZE</td>
	
	</tr>
</table>

<table align="center" width="90%" class="test">
<tr>
<td colspan="2" class="tdclass" style="padding:5px;text-align:center;"><b>Recipient Details</b></td>
<td class="tdclass" style="padding:5px;width:80px;"><b><?php echo $caption_of_bill; ?></b></td>
<td class="tdclass" style="padding:5px;text-align:center;width:138px;">
<span id="span_invoice">
<?php echo $bill_to_print; ?>
<!--<input type="text" name="txt_invoice" id="txt_invoice" value="<?php //echo $bill_to_print; ?>">-->
</span>
</td>
</tr>

<tr>
<td class="tdclass" style="padding:5px;text-align:left;" width="10%"><b>Name</b></td>
<td class="tdclass" style="padding:5px;height: 75px;" width="40%"><?php echo $auth_name;?></td>
<td class="tdclass" style="padding:5px;width:100px" width="20%"><b>Estimate  Date:<b></td>
<td class="tdclass" style="padding:5px;text-align:center;width:165px;" width="30%"><?php echo date('d-m-Y', strtotime( $inv_date )); ?></td>
</tr>

<tr>
<td class="tdclass" style="padding:5px;text-align:left;" width="10%"><b>Address</b></td>
<td class="tdclass" style="padding:5px;height: 75px;" width="40%"><?php echo $auth_address;?></td>
<td class="tdclass" style="padding:5px;width:215px" width="20%"><b>
Address Of Delivery</b>
</td>
<td class="tdclass" style="text-align:center;" width="30%">--</td>
</tr>

<tr>
<td class="tdclass" style="padding:5px;text-align:left;" width="10%"><b>State</b></td>
<td class="tdclass" style="padding:5px;" width="40%"><?php echo $auth_state;?></td>
<td class="tdclass" style="padding:5px;width:200px" width="20%">
<b>State Code</b>
</td>
<td class="tdclass" style="padding:5px;text-align:center;" width="30%"><?php echo $auth_statecode;?></td>
</tr>

<tr>
<td class="tdclass" style="padding:5px;text-align:left;" width="10%"><b>GSTIN</b></td>
<td class="tdclass" colspan="3" style="padding:5px;" width="40%"><?php echo $auth_gstno;?></td>

</tr>

<tr>
<td rowspan="3" colspan="2"class="tdclass" style="padding:5px;font-size:10px;" height="100"  width="50%">
<b>Name Of Work:</b> <?php echo $name_of_work; ?>
</td>
<td class="tdclass" style="padding:5px;" width="20%" ><b>Letter Ref No.</b></td>
<td class="tdclass" style="padding:5px;text-align:center;" width="30%"><?php echo $ref_name; ?></td>

</tr>

<tr>

<td class="tdclass" style="padding:5px;" width="20%"><b>Letter Ref Date</b></td>
<td class="tdclass" style="padding:5px;text-align:center;" width="30%"><?php echo date('d-m-Y', strtotime( $ref_date )); ?></td>


</tr>

<tr>

<td class="tdclass" style="padding:5px;" width="20%"><b>Work Order No.<b></td>
<td class="tdclass" style="padding:5px;text-align:center;" width="30%">--</td>


</tr>
</table>

<?php
	$query_tot_gst = "select * from billmaster WHERE sr_no='$chalan_no'";
		$result_tot_gst = mysqli_query($conn, $query_tot_gst);
			$no_of_tot_rows=mysqli_num_rows($result_tot_gst);
			$row_tot_gst= mysqli_fetch_assoc($result_tot_gst);
			$cgst_per=$row_tot_gst['cgstper'];
			$sgst_per=$row_tot_gst['sgstper'];
			$gst_type=$row_tot_gst['gst_type'];

?>

<table class="test" align="center" width="90%">
	<tr>
		<th width="5%" class="tdclass"><label>Sr No.</label></th>
		<th width="40%" class="tdclass"><label>Material</label></th>	
		<th width="10%" class="tdclass"><label>Quantity</label></th>	
		<th width="10%" class="tdclass"><label>Rate<br></label></th>	
		<!--<th width="10%" class="tdclass"><label>Taxable Amount</label></th>-->	
		<!--<th width="10%" class="tdclass"><label>CGST &nbsp;(<?php //echo $cgst_per."%";?>)</label></th>	
		<th width="10%" class="tdclass"><label>SGST &nbsp;(<?php //echo $sgst_per."%";?>)</label></th>-->	
		<th width="32%" class="tdclass"><label>Net</label></th>		
	<tr>
	<?php
	$query_bill = "select * from billmaster WHERE sr_no='$chalan_no' AND `bill_isdeleted` = '0'";
		$result_bill = mysqli_query($conn, $query_bill);
			$no_of_rows=mysqli_num_rows($result_bill);
			$tot_rows=8;
			$row_loop=$tot_rows-$no_of_rows;
			$count=0;
			$final_amt=0;
			$total_of_sgst_amt=0;
			$total_of_cgst_amt=0;
			$total_of_igst_amt=0;
		if (mysqli_num_rows($result_bill) > 0) {
			while($row_bill = mysqli_fetch_assoc($result_bill)){
			$count++;
			
			$query_mt = "select * from material WHERE id='$row_bill[material_id]' ";
			$result_mt = mysqli_query($conn, $query_mt);
			$rw = mysqli_fetch_array($result_mt);
			
			
			$qty=$row_bill['qty'];
			$rate=$row_bill['rate'];
			$amt=$qty*$rate;
			$final_amt=$final_amt+$amt;
			
				$query_sum = "select SUM(taxable_amt) as sum_taxable,SUM(cgstamt) as sum_cgstamt ,SUM(sgstamt) as sum_sgstamt,SUM(igstamt) as sum_igstamt,SUM(netamt) as sum_netamt from billmaster WHERE sr_no='$chalan_no' AND bill_isdeleted='0' ";
				$result_sum = mysqli_query($conn, $query_sum);

				$r_sum = mysqli_fetch_array($result_sum);
				
				$cgst=round($r_sum['sum_cgstamt'],2);
				$sgst=round($r_sum['sum_sgstamt'],2);
				$igst=round($r_sum['sum_igstamt'],2);
				if($auth_statecode==24){
				$gst=$cgst+$sgst;
				}else{
				$gst=$igst;
				}
																			
				$net=round($r_sum['sum_netamt']);
				$total_of_taxable_amt +=$row_bill['taxable_amt'];
				$total_of_sgst_amt +=$row_bill['sgstamt'];
				$total_of_cgst_amt +=$row_bill['cgstamt'];
				$total_of_igst_amt +=$row_bill['igstamt'];
				
			
			?>
				<?php if($gst_type=="include"){  ?>
				<tr>
				<td style="text-align:center;" width="10%" class="tdclass"><?php echo $count;?></td>
				<td style="text-align:center;" width="35%" class="tdclass"><?php echo $rw['mt_name'];?></td>
				<td style="text-align:center;" width="5%" class="tdclass"><?php echo $row_bill['qty'];?></td>
				<td style="text-align:right;" width="10%" class="tdclass"><?php echo $row_bill['netamt']/$row_bill['qty'];?></td>
				<!--<td style="text-align:right;" width="10%" class="tdclass"><?php //echo $row_bill['taxable_amt'];?></td>-->
				<!--<td style="text-align:right;" width="10%" class="tdclass"><?php //echo $row_bill['cgstamt'];?></td>
				<td style="text-align:right;" width="10%" class="tdclass"><?php //echo $row_bill['sgstamt'];?></td>-->
				<td style="text-align:right;" width="10%" class="tdclass"><?php echo $row_bill['netamt'];?></td>
				
				</tr>
			<?php } else{ ?>
			
				<tr>
				<td style="text-align:center;" width="10%" class="tdclass"><?php echo $count;?></td>
				<td style="text-align:center;" width="35%" class="tdclass"><?php echo $rw['mt_name'];?></td>
				<td style="text-align:center;" width="5%" class="tdclass"><?php echo $row_bill['qty'];?></td>
				<td style="text-align:right;" width="10%" class="tdclass"><?php echo $row_bill['rate'];?></td>
				<!--<td style="text-align:right;" width="10%" class="tdclass"><?php //echo $row_bill['rate'];?></td>-->
				<!--<td style="text-align:right;" width="10%" class="tdclass"><?php //echo $row_bill['cgstamt'];?></td>
				<td style="text-align:right;" width="10%" class="tdclass"><?php //echo $row_bill['sgstamt'];?></td>-->
				<td style="text-align:right;" width="10%" class="tdclass"><?php echo $row_bill['rate']*$row_bill['qty'];?></td>
				
				</tr>
				
				
			<?php } ?>
				<?php
			}
			
				for($i=0;$i<$row_loop;$i++){
					$count++;
					?>
				<tr>
				<td class="tdclass" style="text-align:center;" width="10%"><?php echo $count?></td>
				<td class="tdclass" style="text-align:center;" width="35%">&nbsp;</td>
				<td class="tdclass" style="text-align:center;" width="5%">&nbsp;</td>
				<td class="tdclass" style="text-align:right;" width="10%">&nbsp;</td>
				<!--<td class="tdclass" style="text-align:right;" width="10%">&nbsp;</td>-->
				<!--<td class="tdclass" style="text-align:right;" width="10%">&nbsp;</td>
				<td class="tdclass" style="text-align:right;" width="10%">&nbsp;</td>-->
				<td class="tdclass" style="text-align:right;" width="10%">&nbsp;</td>
				
				</tr>
				<?php	
				}
			?>
			
			
				<!----------->
				
				<!--<tr>

			<th  class="tdclass"><label>&nbsp;</label></th>
			<th  class="tdclass"><label>&nbsp;</label></th>
			<th  class="tdclass"><label>&nbsp;</label></th>
			<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_taxable'], 2);?><b>jhTotal</b></th>
			<!--<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_cgstamt'], 2);?></th>
			<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_sgstamt'], 2);?></th>-->
			<?php //if($gst_type=="include"){ ?>
			<!--<th style="text-align:right;padding-right:5px" class="tdclass">j<?php //echo $r_sum['sum_netamt'];?></th>
			<?php //} else{ ?>
			<th style="text-align:right;padding-right:5px" class="tdclass"><?php// $tot=round($r_sum['sum_netamt'], 2);
			//echo $total_of_taxable_amt;?></th>-->
			<?php //} ?>
			
			<!--</tr>-->
				
				
				<!----------->
			
			<!--<tr>
			<th colspan="4" style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_taxable'], 2);?><b>Total Taxable Value For Goods & Services</b></th>
			<!--<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_cgstamt'], 2);?></th>
			<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_sgstamt'], 2);?></th>-->
			<!--<td style="text-align:right;padding-right:5px" class="tdclass"><?php// echo $total_of_taxable_amt;?></td>
			</tr>-->
			
			<?php if($auth_statecode==24){?>
			<!--<tr>

			<th colspan="4" style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_taxable'], 2);?><b>+ SGST@<?php //echo $sgst_per."%";?></b></th>
			<!--<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_cgstamt'], 2);?></th>
			<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_sgstamt'], 2);?></th>-->
			<!--<td style="text-align:right;padding-right:5px" class="tdclass"><?php //echo $total_of_sgst_amt;?></td>
			</tr>-->
			
			<!--<tr>

			<th colspan="4" style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_taxable'], 2);?><b>+ CGST@<?php //echo $cgst_per."%";?></b></th>
			<!--<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_cgstamt'], 2);?></th>
			<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_sgstamt'], 2);?></th>-->
			<!--<td style="text-align:right;padding-right:5px" class="tdclass"><?php //echo $total_of_cgst_amt;?></td>
			</tr>-->
			
	
			<?php } else{?>
			
			<!--<tr>

			<th colspan="4" style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_taxable'], 2);?><b>+ IGST@<?php //echo $igst_per."%";?></b></th>
			<!--<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_cgstamt'], 2);?></th>
			<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_sgstamt'], 2);?></th>-->
			<!--<td style="text-align:right;padding-right:5px" class="tdclass"><?php //echo $total_of_igst_amt;?></td>
			</tr>-->
			<?php } ?>
			
			<!--<tr>
			<th colspan="4" style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_taxable'], 2);?><b>Total</b></th>
			<!--<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_cgstamt'], 2);?></th>
			<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_sgstamt'], 2);?></th>-->
			<!--<td style="text-align:right;padding-right:5px" class="tdclass"><?php //$tot=round($r_sum['sum_netamt'], 2);
			//echo $total_of_taxable_amt+$total_of_sgst_amt+$total_of_cgst_amt+$total_of_igst_amt;?></td>
			</tr>-->
			
			<tr>

			
			<th colspan="4" style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_taxable'], 2);?><b>Round Off Total</b></th>
			<!--<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_cgstamt'], 2);?></th>
			<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_sgstamt'], 2);?></th>-->
			<th style="text-align:right;padding-right:5px" class="tdclass"><b><?php $tot=round($r_sum['sum_netamt'], 2);
			echo round($r_sum['sum_netamt']);?></b></th>
			</tr>
			
			<?php
		}
		
	?>
	<tr>
		
		<th style="text-align:left;" colspan="4" class="tdclass">Amounts in Words: (<?php echo $bill_in_word." "."Only";?>)</th>
		<th style="text-align:right;" class="tdclass"><i class="fa fa-inr"></i>&nbsp;</th>
	</tr>
	
	<table align="center" width="90%" class="test">
	<tr>

	<th  rowspan="3" colspan="3" style="text-align:left;" class="tdclass" width="62%" ><i class="fa fa-inr"></i>
	<b><br><br><br>
	IF SUPPLY OF SERVICES:<br>
	ORIGINAL FOR RECIPIENT | DUPLICATE FOR SUPPLIER.
	</b>
	</th>
	<th  colspan="2" style="text-align:left;font-size:11px;" class="tdclass" width="38%" ><i class="fa fa-inr"></i>
	<b>For, MEGHRAJ GEOTECH ENGINEEING</b><br><br><br><br><br>
	<b style="float:right;">Authorized Signatory</b>
	</th>
	</tr>
</table>
</table>
 
<script type="text/javascript">
window.onload = function(){ 
	setTimeout(function()
		{
			
			window.print();
		}, 
		1000);

}
$('.btn_print').on('click', function() {
    $('.btn_print').hide();
});
</script>
