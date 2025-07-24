<style>
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
		$sr_no=$_GET['sr_no'];
		$query = "select * from bill_totalmaster WHERE sr_no='$sr_no'";
		$result = mysqli_query($conn, $query);
		
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			
			$sr_no_bill= $row['sr_no'];
			$bill_explode=explode("/",$_GET["sr_no"]);
			$year_explode=explode("-",$_GET["f_year"]);
			$bill_to_print="MGE/BILL/".$bill_explode[1]."/".($year_explode[1]-1)."-".$year_explode[1];
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
			$bill_in_word=$row['billamt_inword'];
			$paymenttype=$row['paymenttype'];
			if($paymenttype=="cash"){
				$paytype="CASH";
			}
			if($paymenttype=="cheque"){
				$paytype="CREDIT";
			}
			if($paymenttype=="rtgs"){
				$paytype="CREDIT";
			}
				
			$query_billmaster = "select * from billmaster WHERE sr_no='$sr_no'";
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
<table align="center" width="90%" class="test">
	<tr>
		<td colspan="6" class="tdclass" style="height:5px;padding:5px;text-align:center;padding-left:100px;"><b>TAX INVOICE
		<span style="float:right;">Original | <strike>Duplicate</strike> | <strike>Triplicate</strike><span>
		</b></td>
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
	
	<td  colspan="2" class="tdclass" style="padding:5px;"><b>GSTIN | 24AAFPZ5523J1ZE</b></td>
	
	</tr>
</table>

<table align="center" width="90%" class="test">
<tr>
<td colspan="2" class="tdclass" style="padding:5px;text-align:center;"><b>Recipient Details</b></td>
<td class="tdclass" style="width:80px;">Tax Invoice No:</td>
<td class="tdclass" style="padding:5px;text-align:left;width:150px;">
<span id="span_invoice">
<input type="text" name="txt_invoice" id="txt_invoice" value="<?php echo $bill_to_print; ?>">
</span>
</td>
</tr>

<tr>
<td class="tdclass" style="padding:5px;text-align:left;"><b>Name</b></td>
<td class="tdclass" style="padding:5px;"><?php echo $auth_name;?></td>
<td class="tdclass" style="padding:5px;width:100px">Tax Invoice Date:</td>
<td class="tdclass" style="padding:5px;text-align:left;"><?php echo date('d-m-Y', strtotime( $inv_date )); ?></td>
</tr>

<tr>
<td class="tdclass" style="padding:5px;text-align:left;"><b>Address</b></td>
<td class="tdclass" style="padding:5px;"><?php echo $auth_address;?></td>
<td class="tdclass" style="padding:5px;width:215px">
Address Of Delivery
</td>
<td class="tdclass" style="text-align:left;">--</td>
</tr>

<tr>
<td class="tdclass" style="padding:5px;text-align:left;"><b>State</b></td>
<td class="tdclass" style="padding:5px;"><?php echo $auth_state;?></td>
<td class="tdclass" style="padding:5px;width:200px">
State Code
</td>
<td class="tdclass" style="padding:5px;text-align:left;"><?php echo $auth_statecode;?></td>
</tr>

<tr>
<td class="tdclass" style="padding:5px;text-align:left;"><b>GSTIN</b></td>
<td class="tdclass" style="padding:5px;"><?php echo $auth_gstno;?></td>
<td class="tdclass" style="padding:5px;width:200px">
Tax Is Payable on
<br>
Reverse Charge
</td>
<td class="tdclass" style="text-align:left;">&nbsp;</td>
</tr>

<tr>
<td rowspan="3" colspan="2"class="tdclass" style="padding:5px;">
Name Of Work: <?php echo $name_of_work; ?>
</td>
<td class="tdclass" style="padding:5px;">Letter Ref No.</td>
<td class="tdclass" style="padding:5px;text-align:left;"><?php echo $ref_name; ?></td>

</tr>

<tr>

<td class="tdclass" style="padding:5px;">Letter Ref Date</td>
<td class="tdclass" style="padding:5px;text-align:left;"><?php echo date('d-m-Y', strtotime( $ref_date )); ?></td>


</tr>

<tr>

<td class="tdclass" style="padding:5px;">Work Order No.</td>
<td class="tdclass" style="padding:5px;text-align:left;">--</td>


</tr>
</table>

<?php
	$query_tot_gst = "select * from billmaster WHERE sr_no='$sr_no'";
		$result_tot_gst = mysqli_query($conn, $query_tot_gst);
			$no_of_tot_rows=mysqli_num_rows($result_tot_gst);
			$row_tot_gst= mysqli_fetch_assoc($result_tot_gst);
			$cgst_per=$row_tot_gst['cgstper'];
			$sgst_per=$row_tot_gst['sgstper'];
			$gst_type=$row_tot_gst['gst_type'];

?>

<table class="test" align="center" width="90%">
	<tr>
		<th width="10%" class="tdclass"><label>SrNo.</label></th>
		<th width="35%" class="tdclass"><label>Material</label></th>	
		<th width="5%" class="tdclass"><label>Quantity</label></th>	
		<th width="10%" class="tdclass"><label>Rate</label></th>	
		<th width="10%" class="tdclass"><label>Net</label></th>		
	<tr>
	<?php
	$query_bill = "select * from billmaster WHERE sr_no='$sr_no' AND bill_isdeleted='0'";
		$result_bill = mysqli_query($conn, $query_bill);
			$no_of_rows=mysqli_num_rows($result_bill);
			$tot_rows=10;
			$row_loop=$tot_rows-$no_of_rows;
			$count=0;
			$final_amt=0;
		if (mysqli_num_rows($result_bill) > 0) {
			while($row_bill = mysqli_fetch_assoc($result_bill)){
			$count++;
			
			
			$query_mt = "select * from material WHERE id='$row_bill[material_id]'";
			$result_mt = mysqli_query($conn, $query_mt);
			$rw = mysqli_fetch_array($result_mt);
			
			
			$qty=$row_bill['qty'];
			$rate=$row_bill['rate'];
			$cgstamt=$row_bill['cgstamt'];
			$sgstamt=$row_bill['sgstamt'];
			$show_rate= $rate + $cgstamt + $sgstamt;
			$show_net_amt= $show_rate * $qty; 
			$amt=$qty*$show_rate;
			$final_amt=$final_amt+$amt;
			
				$query_sum = "select SUM(taxable_amt) as sum_taxable,SUM(cgstamt) as sum_cgstamt ,SUM(sgstamt) as sum_sgstamt,SUM(netamt) as sum_netamt from billmaster WHERE sr_no='$sr_no' AND bill_isdeleted='0' ";
				$result_sum = mysqli_query($conn, $query_sum);

				$r_sum = mysqli_fetch_array($result_sum);
				
				$cgst=round($r_sum['sum_cgstamt'],2);
				$sgst=round($r_sum['sum_sgstamt'],2);
				$gst=$cgst+$sgst;
																			
				$net=round($r_sum['sum_netamt']);
			
			?>
				<tr>
				<td style="text-align:center;" width="10%" class="tdclass"><?php echo $count;?></td>
				<td style="text-align:center;" width="35%" class="tdclass"><?php echo $rw['mt_name'];?></td>
				<td style="text-align:center;" width="5%" class="tdclass"><?php echo $row_bill['qty'];?></td>
				<td style="text-align:right;" width="10%" class="tdclass"><?php echo $show_rate;?></td>
				<td style="text-align:right;" width="10%" class="tdclass"><?php echo $show_net_amt;?></td>
				
				</tr>
				
				<?php
			}
			
				for($i=0;$i<$row_loop;$i++){
					$count++;
					?>
					<tr>
				<td style="text-align:center;" width="10%" class="tdclass"><?php echo $count?></td>
				<td style="text-align:center;" width="35%" class="tdclass">&nbsp;</td>
				<td style="text-align:center;" width="5%" class="tdclass">&nbsp;</td>
				<td style="text-align:right;" width="10%" class="tdclass">&nbsp;</td>
				<td style="text-align:right;" width="10%" class="tdclass">&nbsp;</td>
				
				</tr>
				<?php	
				}
				
			
			?>
			
			<tr>

			
			<th colspan="4" style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_taxable'], 2);?><b>Total Taxable Value For Goods & Services</b></th>
			<!--<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_cgstamt'], 2);?></th>
			<th style="text-align:right;" class="tdclass"><?php //echo round($r_sum['sum_sgstamt'], 2);?></th>-->
			<th style="text-align:right;" class="tdclass"><?php echo $final_amt;?></th>
			</tr>
			<?php
		}
		
	?>
	
	<tr>
		
		<th style="text-align:left;" colspan="4" class="tdclass"><?php echo numtowords($final_amt);?></th>
		<th style="text-align:right;" class="tdclass"><i class="fa fa-inr"></i></i><?php echo $final_amt;?></th>
	</tr>
	<tr>

	<th  rowspan="3" colspan="3" style="text-align:left;" class="tdclass"><i class="fa fa-inr"></i>
	<b>
	IF SUPPLY OF SERVICES:<br><br><br><br><br>
	ORIGINAL FOR RECIPIENT | DUPLICATE FOR SUPPLIER.
	</b>
	</th>
	<th  colspan="3" style="text-align:left;" class="tdclass"><i class="fa fa-inr"></i>
	<b>For, MEGHRAJ GEOTECH ENGINEEING</b><br><br><br><br><br>
	<b style="float:right;">Authorized Signatory</b>
	</th>
	</tr>
</table>
	<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">
<?php

function numtowords($num){ 
$decones = array( 
            '01' => "One", 
            '02' => "Two", 
            '03' => "Three", 
            '04' => "Four", 
            '05' => "Five", 
            '06' => "Six", 
            '07' => "Seven", 
            '08' => "Eight", 
            '09' => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            );
$ones = array( 
            0 => " ",
            1 => "One",     
            2 => "Two", 
            3 => "Three", 
            4 => "Four", 
            5 => "Five", 
            6 => "Six", 
            7 => "Seven", 
            8 => "Eight", 
            9 => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            ); 
$tens = array( 
            0 => "",
            2 => "Twenty", 
            3 => "Thirty", 
            4 => "Forty", 
            5 => "Fifty", 
            6 => "Sixty", 
            7 => "Seventy", 
            8 => "Eighty", 
            9 => "Ninety" 
            ); 
$hundreds = array( 
            "Hundred", 
            "Thousand", 
            "Million", 
            "Billion", 
            "Trillion", 
            "Quadrillion" 
            ); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
    if($i < 20){ 
        $rettxt .= $ones[$i]; 
    }
    elseif($i < 100){ 
        $rettxt .= $tens[substr($i,0,1)]; 
        $rettxt .= " ".$ones[substr($i,1,1)]; 
    }
    else{ 
        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        $rettxt .= " ".$tens[substr($i,1,1)]; 
        $rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
    } 

} 
$rettxt = $rettxt." Rupees";

if($decnum > 0){ 
    $rettxt .= " and "; 
    if($decnum < 20){ 
        $rettxt .= $decones[$decnum]; 
    }
    elseif($decnum < 100){ 
        $rettxt .= $tens[substr($decnum,0,1)]; 
        $rettxt .= " ".$ones[substr($decnum,1,1)]; 
    }
    $rettxt = $rettxt." Paise"; 
} 
return $rettxt;
}

?>
<script type="text/javascript">
$("#print_button").on("click",function(){
	
	var invoice_value= $("#txt_invoice").val();
	document.getElementById("span_invoice").innerHTML = invoice_value;
	$("#print_button").hide();
	window.print();
	
});
$('.btn_print').on('click', function() {
    $('.btn_print').hide();
});
</script>
