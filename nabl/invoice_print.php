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
		if(isset($_GET["print_counts"]))
		{
			$print_counts=base64_decode($_GET["print_counts"]);
		}else{ 
			$print_counts=28; 
		}
		// get estimate by report no and job no
		$perfoma_nos=$_GET["perfoma_nos"];
		
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
		$invoice_date=$row_estiamte["invoice_date"];
		$invoice_no=$row_estiamte["invoice_no"];
		$invoice_character=$row_estiamte["invoice_character"];
		$bill_to_name=$row_estiamte["bill_to_name"];
		
		$letter_heading=$row_estiamte["letter_heading"];
		$letter_nos=$row_estiamte["letter_nos"];
		$letter_dated=$row_estiamte["letter_dated"];
		
		$est_id=$row_estiamte["est_id"];
		$branch_short_code = $row_estiamte["branch_short_code"];
	
		$sel_branch = "select * from branches where `branch_short_code`='$branch_short_code'";
		$query_branch = mysqli_query($conn, $sel_branch);
		$row_branch = mysqli_fetch_array($query_branch);
		$company_name=$row_branch["company_name"];
		$company_logo=$row_branch["company_logo"];
		$company_address=$row_branch["company_address"];
		$contact_mobile=$row_branch["contact_mobile"];
		$branch_name=$row_branch["branch_name"];
		$bank_name=$row_branch["bank_name"];
		$bank_account_no=$row_branch["bank_account_no"];
		$ifsc_code=$row_branch["ifsc_code"];
		$pan_no=$row_branch["pan_no"];
		$branch_gst_no=$row_branch["gst_no"];
		
		$sel_agency="select * from agency_master where `isdeleted`=0 and `agency_id`=".$sel_agency_id;
		$result_agency =mysqli_query($conn,$sel_agency);
		$row_agency =mysqli_fetch_array($result_agency);
		$agency_name=$row_agency["agency_name"];
		$agency_address=$row_agency["agency_address"];
		$agency_gst=$row_agency["agency_gstno"];
		
		
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
			
			$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$row_estiamte["bill_to_id"];
			$result_agency =mysqli_query($conn,$sel_agency);
			$row_agency =mysqli_fetch_array($result_agency);
			
			$sel_city="select * from city where `id`='$row_agency[agency_city]'";
			$result_city =mysqli_query($conn,$sel_city);
			$row_city =mysqli_fetch_array($result_city);
			
			$get_clients_name= $row_agency["agency_name"];
			$get_clients_address=$row_agency["agency_address"].",".$row_city["city_name"];
			$gst_nos= $row_agency["agency_gstno"];
		
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
		
		$sel_agency="select * from agency_master where `agency_id`=".$row_estiamte["bill_to_id"];
			$query_agency=mysqli_query($conn,$sel_agency);
			$result_agency=mysqli_fetch_array($query_agency);
			$get_clients_address=$result_agency["agency_address"];
		
		$gst_no=$gst_nos;
		
		//get from tax 
		/* $sel_tax="select * from tax";
		$result_tax =mysqli_query($conn,$sel_tax);
		$get_tax =mysqli_fetch_array($result_tax); */
		
		$mat_ids_array=explode(",",$row_estiamte["mat_ids"]);
		$mat_name_array=explode(",",$row_estiamte["mate_name"]);
		$test_ids_array=explode(",",$row_estiamte["test_ids"]);
		$test_name_array=explode(",",$row_estiamte["test_name"]);
		$test_qty_array=explode(",",$row_estiamte["test_qty"]);
		$test_rates_array=explode(",",$row_estiamte["test_rates"]);
		$test_totals_array=explode(",",$row_estiamte["test_totals"]);
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
		<tr class="padding_class tdclass">
				<td colspan="6" style="text-align:left;borde:0px;">
				<b style="font-size: 20px;padding-left:5px;"><?php echo $company_name;?></b>
                        <p style="font-size: 11px;margin-top:0px;padding-left:5px;"><?php echo $company_address;?></p>
                        <img src="images/branch_logo/<?php echo $company_logo;?>" style="float:right;width:150px;height:50px;margin-top:-10px;">
				</td>
				
		</tr>
		
		<tr class="padding_class only_fonts">
				<td colspan="2" style="text-align:left;font-size:13px;border-right: 0px solid red;">
				<span><b>Debit /</b> Cash Memo</span>
				</td>
				<td colspan="2" style="text-align:center;font-size:15px;border-left: 0px solid red;border-right: 0px solid red;">
				<span><b>TAX INVOICE</b></span>
				</td>
				<td colspan="2" style="text-align:right;font-size:13px;border-left: 0px solid red;">
				<span><b class="set_last">
				<select id="sel_original"> 
				<option value="Original For Recipient">Original For Recipient</option>
				<option value="Duplicate For Transporter">Duplicate For Transporter</option>
				<option value="Triplicate For Assessee">Triplicate For Assessee</option>
				</select> 
				</b></span>
				</td>
		</tr>
		
		<tr class="padding_class only_fonts" style="height: 50px;">
				<td colspan="3" style="width:60%"><b><?php echo $bill_to_name; ?></b><br>
				<?php echo $get_clients_address;?><br>
				GSTIN:&nbsp;&nbsp;
				<?php echo $gst_no; ?>
				</td>
				
				<td colspan="3" style="width:40%">
				<span style="width:50%">&nbsp;Bill No.&nbsp;&nbsp;:<?php echo $invoice_no;?></span>
				<span style="width:50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bill Date&nbsp; :<?php echo date("d/m/Y",strtotime($invoice_date));?></span><br>
				<span style="width:50%">&nbsp;PAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $pan_no;?></span>
				<span style="width:50%">&nbsp;SAC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:998346</span><br>
				<span style="width:50%">&nbsp;GSTIN&nbsp;:<?php echo $branch_gst_no;?></span>
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
											<td width="">Particular</td>	
											<td width="7%">Qty</td>	
											<td width="7%">Unit</td>
											<td width="7%">Unit Rate</td>
											<td width="8%">Amount</td>
										  </tr>
		<?php
				$now_array=array();
				 $contings=0;
				 $set_page_no=0;
				if($test_name_array==$print_counts) {
					
				$total_counts=ceil(count($test_name_array)/$print_counts);
				}else{
					
				$total_counts=ceil(count($test_name_array)/($print_counts + 1));
				}
				if($total_counts==0){
					$total_counts=1;
				}
				//$total_counts=ceil(count($explode_trf_no)/$print_counts);
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
										  
											foreach($test_name_array as $one_key => $one_tests)
												{
													if($one_chk_array==$trf_no_array[$one_key])
													{
													$contings++;
													?>
													
													<tr>
													<td><?php echo $one_key + 1; ?></td>
													<td><?php echo $mat_name_array[$one_key];?></td>
													<td>&nbsp;
													<?php echo substr($one_tests,0,56); ?>
													 
													</td>
													<td>
													
													<?php echo $test_qty_array[$one_key]; ?>
													
													</td>
													<td>Unit</td>
													<td>
													
													<?php echo $test_rates_array[$one_key]; ?>
													
													</td>
													<td style="text-align:right">
													  <?php echo $test_totals_array[$one_key].".00"; ?>
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
													<tr class="padding_class tdclass">
															<td colspan="6" style="text-align:left;borde:0px;">
															<b style="font-size: 20px;padding-left:5px;"><?php echo $company_name;?></b>
															<p style="font-size: 11px;margin-top:0px;padding-left:5px;"><?php echo $company_address;?></p>
															<img src="images/branch_logo/<?php echo $company_logo;?>" style="float:right;width:150px;height:50px;margin-top:-10px;">
															</td>
															
													</tr>
													
													<tr class="padding_class only_fonts">
															<td colspan="2" style="text-align:left;font-size:13px;border-right: 0px solid red;">
															<span><b>Debit /</b> Cash Memo</span>
															</td>
															<td colspan="2" style="text-align:center;font-size:15px;border-left: 0px solid red;border-right: 0px solid red;">
															<span><b>TAX INVOICE</b></span>
															</td>
															<td colspan="2" style="text-align:right;font-size:13px;border-left: 0px solid red;">
															<span><b class="set_last"></b></span>
															</td>
													</tr>
													
													<tr class="padding_class only_fonts" style="height: 50px;">
															<td colspan="3" style="width:60%"><b><?php echo $get_clients_name; ?></b><br>
															<?php echo $get_clients_address;?><br>
															GSTIN:&nbsp;&nbsp;
															<?php echo $gst_nos; ?>
															</td>
															
															<td colspan="3" style="width:40%">
															<span style="width:50%">&nbsp;Bill No.&nbsp;&nbsp;:<?php echo $invoice_character.$invoice_no;?></span>
															<span style="width:50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bill Date&nbsp; :<?php echo date("d/m/Y",strtotime($invoice_date));?></span><br>
															<span style="width:50%">&nbsp;PAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<?php echo $pan_no;?></span>
															<span style="width:50%">&nbsp;SAC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:998346</span><br>
															<span style="width:50%">&nbsp;GSTIN&nbsp;:<?php echo $branch_gst_no;?></span>
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
														<td width="">Particular</td>	
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
					<?php if($row_estiamte["rate_type"]=="0"){ ?>
					<td colspan="6" style="text-align:right;border-right: 0px solid red;"><b>Total Amount including GST(&#x20b9;) :</b></td>
					<td width="11%" style="text-align:right;border-left: 0px solid red;"><b>&nbsp;<?php echo number_format($total_amt,2);?></b></td>	
					<?php }else{ ?>
					<td colspan="6" style="text-align:right;border-right: 0px solid red;">Sub Total (&#x20b9;)</td>
					<td width="11%" style="text-align:right;border-left: 0px solid red;">&nbsp;<?php echo number_format($grand_total,2);?></td>
					<?php } ?>
				</tr>
				<tr>
					<td colspan="3" width="69%" style="border: 1px solid black;">
					<?php 
					if($row_estiamte["rate_type"]=="1")
					{ ?>
					<b>GST Amount in Words :</b>
					<br>
					<?php
					
					 $gst_totals= $s_gst_amt + $c_gst_amt + $i_gst_amt;
					echo getIndianCurrency($gst_totals);
					}else{
						echo "&nbsp;";
					}
					?>
					
					<br>&nbsp;
					</td>	
					<td rowspan="3" colspan="6" style="border: 1px solid black;margin-top:20px;min-height:200px;">
					<?php 
					if($row_estiamte["rate_type"]=="1")
					{
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
					<span>Taxable Amount</span><span style="float:right;"><?php echo $taxable_amnt;?></span><br>
					<?php 
					}
					?>
					<?php 
					if($s_gst_amt !="0")
					{
					?>
					<span>SGST @9.00 %</span><span style="float:right;"><?php echo $s_gst_amt;?></span><br>
					<?php 
					}
					?>
					<?php 
					if($c_gst_amt !="0")
					{
					?>
					<span>CGST @9.00 %</span><span style="float:right;"><?php echo $c_gst_amt;?></span><br>
					<?php 
					}
					?>
					<?php 
					if($i_gst_amt !="0")
					{
					?>
					<span>iGST @18.00 %</span><span style="float:right;"><?php echo $i_gst_amt;?></span><br>
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
					}else{
						echo "&nbsp;";
					}
					?>
					</td>	
				</tr>
				
				<tr>
					<td colspan="3" style="border: 0px solid black;"><b>Invoice Amount in Words :</b>
					<br>
					<?php echo getIndianCurrency($total_amt);?>
					<br>&nbsp;
					</td>	
						
				</tr>
				
				</tbody>
		</table>
		<table align="center" width="90%" class="test only_fonts" border="0px" id="table_1" style="font-family: arial;">
		<tr>
			<td colspan="3" style="border: 1px solid black;width:69%;">Subject to <?php echo ucfirst(strtolower($branch_name));?> Jurisdiction.</td>	
			<td colspan="3" style="border: 1px solid black;">
			<?php if($row_estiamte["rate_type"]=="1"){ ?>
			<b>Total Amount (&#8377;) :</b>
			<span style="float:right;"><b><?php echo $total_amt.".00";?></b></span>
			
			<?php }else{ echo "&nbsp;";} ?>
			</td>	
		</tr>
		<tr>
			<td rowspan="6" colspan="3" style="border: 1px solid black;"><b style="padding:10px;">Bank Detail :</b> <?php echo strtoupper($bank_name);?>
			<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current A/C : <?php echo strtoupper($bank_account_no);?><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IFSC Code: <?php echo strtoupper($ifsc_code);?><br>
			&nbsp;
			<b>E. & O. E.</b>
			<img src="images/upi_code.jpeg" style="float:right;width:100px;height:110px;margin-top:-60px;">
			</td>	
			<td rowspan="6" colspan="3" style="border: 1px solid black;text-align:right;">For, <?php echo strtoupper($company_name);?><br><br><br><br>
			<!--<img src="images/signatory.png" style="float:right;margin-right:20px;"><br><br><br><br><br><br>-->
			<span style="float:right;">Authorised Signatory</span>
			</td>	
		</tr>
		
		</table>
		<table align="center" width="90%" class="test only_fonts" border="0px" id="table_1" style="font-family: arial;">
		<tr>
			<td rowspan="6" colspan="6" style="border: 0px solid black;text-align:right;"><span style="float:right;">Page <?php echo $set_page_no+1 ." of ".$total_counts;?></span>
			</td>	
		</tr>
		
		</table>
		<input style="margin-top: 25px;margin-left: 200;font-size: 17px;color: white;background-color: #03aba8;border: 1px solid #03aba8;border-radius: 10px;padding: 8px 18px;" type="button" name="print_button" id="print_button" value="PRINT">
		
		<a href="update_perfoma.php?perfoma_nos=<?php echo $_GET['perfoma_nos'];?>" class="btn btn-primary" title="" style="" id="edit_button">
		<input style="margin-top: 25px;margin-left: 200;font-size: 17px;color: white;background-color: #03aba8;border: 1px solid #03aba8;border-radius: 10px;padding: 8px 18px;" type="button" name="print_button" id="print_button" value="EDIT">
		
		</a>
		
		
		<a href="javascript:void(0);" class=" btn-danger invoice_deletes" data-id="<?php echo $est_id;?>"title="Material Assign" style=""  id="delete_button">
		<input style="margin-top: 25px;margin-left: 200;font-size: 17px;color: white;background-color: #03aba8;border: 1px solid #03aba8;border-radius: 10px;padding: 8px 18px;" type="button" name="print_button" value="DELETE INVOICE">
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
	$('.set_last').html(sel_original);
	window.print();
});
$(document).on("click", ".invoice_deletes", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Invoice ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=invoice_deletes&clicked_id='+clicked_id,
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