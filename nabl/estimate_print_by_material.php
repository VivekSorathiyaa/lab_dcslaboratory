<?php 
error_reporting(1);
session_start();
include("connection.php");
?>
<?php 
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}
?>
<style>

@page {  
margin: 10mm 2mm 0mm 2mm; 
}

@media print{@page }

.tdclass{
    border: 1px solid black;
    font-size:11px;
	 /*font-family: arial;*/
	 font-family: "arial";
}
.only_fonts{
	font-size:13px;
}
.test {
    border-collapse: collapse;
}
	.tdclass1{
    
    font-size:11px;
	 font-family: arial;
}
. padding_class
{
padding:10px;
}
.pagebreak { page-break-before: always; }

	#table_1 {
        page-break-inside: auto;
		
      }
     #table_1 tr {
        page-break-inside: avoid;
        page-break-after: auto;
		
      }
     #table_1 thead {
        display: table-header-group;
		
      }
     #table_1 tfoot {
        display: table-footer-group;
      }
  
#content {
    display: table;
}

#pageFooter {
    display: table-footer-group;
}

#pageFooter:after {
    counter-increment: page;
    content:"Page " counter(page);
    left: 0; 
    top: 100%;
    white-space: nowrap; 
    z-index: 20;
    -moz-border-radius: 5px; 
    -moz-box-shadow: 0px 0px 4px #222;  
    background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);  
  }
.only_fonts{
	font-size:13px;
}
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: red;
   color: white;
   text-align: center;
}
@media print {
  .tt { 
    page-break-before: always;
  }
}
</style>
<html>
	<body>
<?php
		// get estimate by report no and job no
		$perfoma_nos=$_GET["perfoma_nos"];
		$print_counts=base64_decode($_GET["print_counts"]);
		//$plused_counts=intval($print_counts)+2;
		$plused_counts=28;
		
		$sel_estiamte="select * from estimate_total_span where `perfoma_no`='$perfoma_nos'";
		$result_estiamte =mysqli_query($conn,$sel_estiamte);
		$row_estiamte =mysqli_fetch_array($result_estiamte);
		
		$explode_trf_no=explode(",",$row_estiamte["trf_no"]);
		$one_trf_no=$explode_trf_no[0];
		
		// get name of agency by report no and job no from agency table
		$sel_agency_id=$row_estiamte["agency_id"];
		$hsn_codes=$row_estiamte["hsn_codes"];
		$bill_no=$row_estiamte["bill_no"];
		$bill_to=$row_estiamte["bill_to"];
		$gst_type=$row_estiamte["gst_type"];
		$gst_in_or_ex=$row_estiamte["gst_in_or_ex"];
		$discount_percent=$row_estiamte["discount_percent"];
		$discount_amount=$row_estiamte["discount_amount"];
		$estimating_date=$row_estiamte["estimating_date"];
		$estimate_numbers=$row_estiamte["estimate_numbers"];
		$bill_to_id=$row_estiamte["bill_to_id"];
		$bill_to_name=$row_estiamte["bill_to_name"];
		
		$letter_heading=$row_estiamte["letter_heading"];
		$letter_nos=$row_estiamte["letter_nos"];
		$letter_dated=$row_estiamte["letter_dated"];
		
		$est_id=$row_estiamte["est_id"];
		
		$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$sel_agency_id;
		$result_agency =mysqli_query($conn,$sel_agency);
		$row_agency =mysqli_fetch_array($result_agency);
		$agency_name=$row_agency["agency_name"];
		$agency_address=$row_agency["agency_address"];
		$agency_gst=$row_agency["agency_gstno"];
		
		$sel_bill="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$bill_to_id;
		$result_bill =mysqli_query($conn,$sel_bill);
		$row_bill =mysqli_fetch_array($result_bill);
		$bill_adress=$row_bill["agency_address"];
		
		
		// get name of work from job by report no 
		$sel_job="select * from job where `trf_no`='$one_trf_no'";
		$result_job =mysqli_query($conn,$sel_job);
		$row_job =mysqli_fetch_array($result_job);
		$name_of_work= strip_tags(html_entity_decode($row_job["nameofwork"]),"<strong><em>");
		
		$get_report_to= $row_job["report_sent_to"];
		$clientname= $row_job["clientname"];
		$agreement_no= $row_job["agreement_no"];
		$client_gstno= $row_job["client_gstno"];
		
		// set report  send to
		if($bill_to=="1"){
			
			$sel_city="select * from city where `id`='$row_job[client_city]'";
			$result_city =mysqli_query($conn,$sel_city);
			$row_city =mysqli_fetch_array($result_city);
			
			$get_clients_name= $row_job["clientname"];
			$get_clients_address=$row_job["clientaddress"].",".$row_city["city_name"];
			$gst_nos= $row_job["client_gstno"];
		
		}
		if($bill_to=="0"){
			
			$sel_city="select * from city where `id`='$row_agency[agency_city]'";
			$result_city =mysqli_query($conn,$sel_city);
			$row_city =mysqli_fetch_array($result_city);
			$gst_nos= $row_job["client_gstno"];
			
			$get_clients_name= $agency_name;
			$get_clients_address=$agency_address.",".$row_city["city_name"];
			$gst_nos= $agency_gst;
		}
		if($bill_to=="2"){
			
			
			
			$get_clients_name= $row_estiamte["other_customer_name"];
			$get_clients_address=$row_estiamte["other_customer_address"];
			$gst_nos=$row_estiamte["other_customer_gst_no"];
		}
		$gst_no=$gst_nos;
		
		$sel_agency="select * from agency_master where `agency_id`=".$row_estiamte["bill_to_id"];
			$query_agency=mysqli_query($conn,$sel_agency);
			$result_agency=mysqli_fetch_array($query_agency);
			$get_clients_address=$result_agency["agency_address"];
		
		
		$mat_ids_array=explode(",",$row_estiamte["mat_ids"]);
		$mat_name_array=explode(",",$row_estiamte["mate_name"]);
		$material_qty_array=explode(",",$row_estiamte["material_qty"]);
		$material_rates_array=explode(",",$row_estiamte["material_rates"]);
		$material_amnt_array=explode(",",$row_estiamte["material_amnt"]);
		$trf_no_array=explode(",",$row_estiamte["trf_no_array"]);
		
		$grand_total= $row_estiamte["grand_total"];
		$discount_percent= $row_estiamte["discount_percent"];
		$discount_amount= $row_estiamte["discount_amount"];
		
		$charge_one= $row_estiamte["charge_one"];
		$charge_one_percentage= $row_estiamte["charge_one_percentage"];
		$charge_one_amount= $row_estiamte["charge_one_amount"];
		
		$charge_two= $row_estiamte["charge_two"];
		$charge_two_percentage= $row_estiamte["charge_two_percentage"];
		$charge_two_amount= $row_estiamte["charge_two_amount"];
		
		$discount_percentage= $row_estiamte["discount_percentage"];
		$discount_amnt= $row_estiamte["discount_amnt"];
		$taxable_amnt= $row_estiamte["taxable_amnt"];
		
		$c_gst_amt= $row_estiamte["c_gst_amt"];
		$s_gst_amt= $row_estiamte["s_gst_amt"];
		$i_gst_amt= $row_estiamte["i_gst_amt"];
		
		$round_up_amnt= $row_estiamte["round_up_amnt"];
		$total_amt= $row_estiamte["total_amt"];
		$which_made= $row_estiamte["which_made"];
		
		$refno="";
		$now_arraying=array();
		$refno_arraying=array();
	  foreach($explode_trf_no as $one_trf_nos)
	  {
		  $sel_job="select * from job where `trf_no`='$one_trf_nos'";
		  $result_job =mysqli_query($conn,$sel_job);
		  $row_job =mysqli_fetch_array($result_job);
		  $refno .= '<span style="min-width:100px;">'.$row_job["refno"].'</span>'."&nbsp;&nbsp;&nbsp;&nbsp;Date:-&nbsp;&nbsp;".date('d-m-Y',strtotime($row_job["date"]))."<br>";
		 
		  if(!in_array($row_job["nameofwork"],$now_arraying))
		  {
			  $refno_arraying[$one_trf_nos]= $row_job["refno"]." Dated:".date('d/m/Y',strtotime($row_job["date"]));
			  $now_arraying[$one_trf_nos]= $row_job["nameofwork"];
			  
		  }else{
				$keys = array_search ($row_job["nameofwork"], $now_arraying);
				$plus= $refno_arraying[$keys].", ".$row_job["refno"]." Dated:".date('d/m/Y',strtotime($row_job["date"]));
				$refno_arraying[$keys] = $plus;

			}
		  
		  $update_jobs= "update job set `print_done_by_biller_for_qm_see`=1 where `trf_no`='$one_trf_nos'";
		  $results_jobs =mysqli_query($conn,$update_jobs);
	  }
	
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
		<page size="A4">
		<table align="center" width="90%" class="test" id="table_1" border="1px" style="font-family: arial;">
		<tbody>
		<tr class="padding_class only_fonts">
				<td colspan="6" style="text-align:center;font-size:15px;">
				<span><b>ESTIMATE</b></span>
				</td>
		</tr>
		
		<tr class="padding_class only_fonts" style="height: 50px;">
				<td colspan="3" style="width:60%"><b><?php echo $bill_to_name; ?></b><br>
				<?php echo $bill_adress;?><br>
				</td>
				
				<td colspan="3" style="width:40%">
				<span style="width:50%">&nbsp;Estimate No.&nbsp;&nbsp;:<?php echo $estimate_numbers;?></span>
				<span style="width:50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estimate Date&nbsp; :<?php echo date("d/m/Y",strtotime($estimating_date));?></span><br>
				<?php 
				if($letter_heading !="")
				{ ?>
				<br>
				<span style="width:50%">&nbsp;<?php echo $letter_heading;?>&nbsp;:<?php echo $letter_nos;?>, Dated.:<?php echo $letter_dated;?></span><br>
					
				<?php } ?>
				</td>
				
		</tr>
		</tbody>
		</table>
	
		<table align="center" width="90%" class="test only_fonts" border="1px" id="table_1" style="font-family: arial;">
		<thead>
		</thead>
		 <tbody>
		 <tr>
										  <td width="4%">Sr No.</td>
										  <td width="17%">Material</td>
											<td width="7%">Qty</td>	
											<td width="7%">Unit</td>
											<td width="7%">Unit Rate</td>
											<td width="8%">Amount</td>
										  </tr>
		<?php
				$now_array=array();
				 $contings=0;
				 $set_page_no=0;
				if($mat_name_array==$print_counts) {
					
				$total_counts=ceil(count($mat_name_array)/$print_counts);
				}else{
					
				$total_counts=ceil(count($mat_name_array)/($print_counts + 1));
				}
				if($total_counts==0){
					$total_counts=1;
				}
				foreach($explode_trf_no as $one_chk_array)
				{
										
										  $sel_jobs="select nameofwork,refno from job where `trf_no`='$one_chk_array'";
										  $query_jobs=mysqli_query($conn,$sel_jobs);
										  $get_now=mysqli_fetch_array($query_jobs);
										  $name_of_works=$get_now["nameofwork"];
										  if (!in_array($name_of_works, $now_array))
										  {
										  ?>
										  <tr>
										  <td colspan="7">Name Of Work:<?php echo strip_tags($name_of_works);?><br>
										  Reference: <?php echo $refno_arraying[$one_chk_array]; ?>
										  </td>
										  </tr>
										  
										  <?php	
											array_push($now_array,$name_of_works);										  
										   }
										   ?>
										   <tr>
										  <td colspan="7">Job No: <?php echo $one_chk_array;?></th>
										  </tr>
										   <?php
										  
											foreach($mat_name_array as $one_key => $one_mat)
												{
													if($one_chk_array==$trf_no_array[$one_key])
													{
													$contings++;
													?>
													
													<tr>
													<td><?php echo $one_key + 1; ?></td>
													<td>&nbsp;
													<?php echo substr($one_mat,0,56); ?>
													 
													</td>
													<td>
													
													<?php echo $material_qty_array[$one_key]; ?>
													
													</td>
													<td>Unit</td>
													<td>
													
													<?php echo $material_rates_array[$one_key]; ?>
													
													</td>
													<td style="text-align:right">
													  <?php echo $material_amnt_array[$one_key].".00"; ?>
													</td>
													</tr>
													<?php
													if($contings> $print_counts)
													{
														
													$contings=0;
													$set_page_no++;
													?>
													</tbody>
													</table>
													<table align="center" width="90%" class="test only_fonts" border="0px" id="table_1" style="font-family: arial;">
													<tr>
														<td rowspan="6" colspan="6" style="border: 0px solid black;text-align:right;"><span style="float:right;">Page <?php echo $set_page_no." of ".$total_counts;?></span>
														</td>	
													</tr>
													
													</table>
													
													<div class="tt"></div>
													
													<table align="center" width="90%" class="test" id="table_1" border="1px" style="font-family: arial;">
													<tbody>
													<tr class="padding_class only_fonts">
															<td colspan="6" style="text-align:center;font-size:15px;">
															<span><b>ESTIMATE</b></span>
															</td>
													</tr>
													
													<tr class="padding_class only_fonts" style="height: 50px;">
															<td colspan="3" style="width:60%"><b><?php echo $get_clients_name; ?></b><br>
															<?php echo $get_clients_address;?><br>
															GSTIN:&nbsp;&nbsp;
															<?php echo $gst_nos; ?>
															</td>
															
															<td colspan="3" style="width:40%">
															<span style="width:50%">&nbsp;Estimate No.&nbsp;&nbsp;:<?php echo $estimate_numbers;?></span>
															<span style="width:50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estimate Date&nbsp; :<?php echo date("d/m/Y",strtotime($estimating_date));?></span><br>
															<span style="width:50%">&nbsp;PAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:AARFR2036E</span>
															<span style="width:50%">&nbsp;SAC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:998346</span><br>
															<span style="width:50%">&nbsp;GSTIN&nbsp;:24AARFR2036E1ZC</span>
															<?php 
															if($letter_heading !="")
															{ ?>
															<br>
															<span style="width:50%">&nbsp;<?php echo $letter_heading;?>&nbsp;:<?php echo $letter_nos;?>, Dated.:<?php echo $letter_dated;?></span><br>
																
															<?php } ?>
															</td>
															
													</tr>
													</tbody>
													</table>
													
													<table align="center" width="90%" class="test only_fonts" border="1px" id="table_1" style="font-family: arial;">
													<thead>
													</thead>
													 <tbody>
													  <tr>
													  <td width="4%">Sr No.</td>
													  <td width="17%">Material</td>
														<td width="7%">Qty</td>	
														<td width="7%">Unit</td>
														<td width="7%">Unit Rate</td>
														<td width="8%">Amount</td>
													  </tr>
													<?php
													}
													}
													}
													}
													
													for($i=$plused_counts;$i>$contings;$i--)
													{
													echo '<tr><td colspan="7" style="border: 0px;">&nbsp;</td></tr>';	
													}
													
				
				?>
				</tbody>
				</table>
				<table align="center" width="90%" class="test only_fonts " border="1px" id="table_1" style="font-family:arial;">
				<tbody>
				<tr>
					<td colspan="6" style="text-align:right;border-right: 0px solid red;">Sub Total (&#x20b9;)</td>
					<td width="11%" style="text-align:right;border-left: 0px solid red;">&nbsp;<?php echo number_format($grand_total,2);?></td>	
				</tr>
				<tr>
					<td colspan="3" width="69%" style="border: 1px solid black;">&nbsp;</td>	
					<td rowspan="3" colspan="6" style="border: 1px solid black;margin-top:20px;min-height:200px;">
					<?php 
					if($charge_one !="")
					{
					?>
					<span><?php echo $charge_one." @ ".$charge_one_percentage;?>  %</span><span style="float:right;"><?php echo $charge_one_amount;?></span><br>
					<?php 
					}
					?>
					<?php 
					if($charge_two !="")
					{
					?>
					<span><?php echo $charge_two." @ ".$charge_two_percentage;?>  %</span><span style="float:right;"><?php echo $charge_two_amount;?></span><br>
					<?php 
					}
					?>
					<?php 
					if($discount_percentage !="")
					{
					?>
					<span><?php echo "Discount @ ".$discount_percentage;?>  %</span><span style="float:right;"><?php echo $discount_amnt;?></span><br>
					<?php 
					}
					?>
					<?php 
					if($taxable_amnt !="")
					{
					?>
					<span>Amount</span><span style="float:right;"><?php echo $taxable_amnt;?></span><br>
					<?php 
					}
					?>
					<?php 
					if($round_up_amnt !="0")
					{
					?>
					<span>Round Off</span><span style="float:right;"><?php echo $round_up_amnt;?></span><br>
					<?php 
					}
					?>
					</td>	
				</tr>
				
				<tr>
					<td colspan="3" style="border: 0px solid black;"><b>Estimate Amount in Words :</b>
					<br>
					<?php echo getIndianCurrency($taxable_amnt);?>
					<br>&nbsp;
					</td>	
						
				</tr>
				
				</tbody>
		</table>
		<table align="center" width="90%" class="test only_fonts" border="0px" id="table_1" style="font-family: arial;">
		<tr>
			<td colspan="3" style="border: 1px solid black;width:69%;">&nbsp;</td>	
			<td colspan="3" style="border: 1px solid black;">
			<b>Total Amount (&#8377;) :</b>
			<span style="float:right;"><b><?php echo $taxable_amnt.".00";?></b></span>
			
			</td>	
		</tr>
		<!--<tr>
			<td rowspan="6" colspan="3" style="border: 1px solid black;"><b style="padding:10px;">Bank Detail :</b> HDFC BANK
			<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Branch: Vavdi, Rajkot, Gujarat<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current A/C : 50200007079712<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IFSC Code: HDFC0003101<br>
			&nbsp;
			<b>E. & O. E.</b>
			</td>	
			<td rowspan="6" colspan="3" style="border: 1px solid black;text-align:right;">For, RAJKOT METLAB SERVICES<br><br><br><br>
			<!--<img src="images/signatory.png" style="float:right;margin-right:20px;"><br><br><br><br><br><br>
			<span style="float:right;">Authorised Signatory</span>
			</td>	
		</tr>-->
		
		</table>
		<table align="center" width="90%" class="test only_fonts" border="0px" id="table_1" style="font-family: arial;">
		<tr>
			<td rowspan="6" colspan="6" style="border: 0px solid black;text-align:right;"><span style="float:right;">Page <?php echo $set_page_no+1 ." of ".$total_counts;?></span>
			</td>	
		</tr>
		
		</table>
		
		<input style="margin-top: 25px;margin-left: 200;font-size: 17px;color: white;background-color: #03aba8;border: 1px solid #03aba8;border-radius: 10px;padding: 8px 18px;" type="button" name="print_button" id="print_button" value="PRINT">
		
		<a href="update_perfoma_by_material.php?perfoma_nos=<?php echo $_GET['perfoma_nos'];?>" class="btn btn-primary" title="" style="" id="edit_button">
		<input style="margin-top: 25px;margin-left: 200;font-size: 17px;color: white;background-color: #03aba8;border: 1px solid #03aba8;border-radius: 10px;padding: 8px 18px;" type="button" name="print_button" id="print_button" value="EDIT">
		
		</a>
		
		<a href="javascript:void(0);" class=" btn-danger estimate_deletes" data-id="<?php echo $est_id;?>"title="Material Assign" style=""  id="delete_button">
		<input style="margin-top: 25px;margin-left: 200;font-size: 17px;color: white;background-color: #03aba8;border: 1px solid #03aba8;border-radius: 10px;padding: 8px 18px;" type="button" name="print_button" id="print_button" value="DELETE ESTIMATE">
		</a>
		
		
			
			<!--<input style="margin-top: -50px;margin-left: 732;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_duplicate" id="print_duplicate" value="DUPLICATE">-->
</page>
	</body>
</html>
<link rel="stylesheet" href="bower_components/custom/jquery-confirm.min.css">
<script src="bower_components/jquery-confirm.min.js"></script>
<?php
function getIndianCurrency(float $number){
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? " " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise." Only";
}
?>	
<script type="text/javascript">
$("#print_button").on("click",function(){
	$('#print_button').hide();
	$('#edit_button').hide();
	$('#delete_button').hide();
	var sel_original= $("#sel_original").val();
	$('#set_last').html(sel_original);	
	window.print();
});
$(document).on("click", ".estimate_deletes", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Invoice ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=estimate_deletes&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_final_bill_by_biller.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});
</script>