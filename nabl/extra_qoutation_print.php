<?php 
error_reporting("ALL");
session_start();
include("connection.php");
?> 
<?php 
//if($_SESSION['name']=="")
//{
	?>
	<script >
		//window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
//}
?>
<style>
@page {  
margin: 5mm 2mm 2mm 2mm; 
}



@media print{@page }

.tdclass{
    border: 1px solid black;
    font-size:11px;
	 font-family: Book Antiqua;
}
.test {
    border-collapse: collapse;
}
	.tdclass1{
    
    font-size:11px;
	 font-family: Book Antiqua;
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

</style>
<html>
	<body>
<?php
		// get estimate by report no and job no
		$quotations_id=$_GET["quotations_id"];
	$sel_qat="select * from quotations where `quotations_id`=".$quotations_id;
	 $result=mysqli_query($conn,$sel_qat);
	 $rowes=mysqli_fetch_array($result);
	 
	 $mat_ids="";
	 if($rowes["mate_name"] !="")
	 {
		 $mat_ids=explode(",",$rowes["mat_ids"]);
		 $mate_name=explode(",",$rowes["mate_name"]);
		 $test_ids=explode(",",$rowes["test_ids"]);
		 $test_name=explode(",",$rowes["test_name"]);
		 $test_qty=explode(",",$rowes["test_qty"]);
		 $test_rates=explode(",",$rowes["test_rates"]);
		 $test_totals=explode(",",$rowes["test_totals"]);
		 $txt_discount_percentage=explode(",",$rowes["txt_discount_percentage"]);
		 
		 if($txt_discount_percentage[0]!="0"){ $sets="6";}else{ $sets="5";}
	 }
	 $get_agency = "SELECT * FROM `agency_master` WHERE `agency_id`='$rowes[agency_id]'";
		$result_agency = mysqli_query($conn, $get_agency);
		$agency_row = mysqli_fetch_array($result_agency);
		
		$sel_branch = "select * from branches where `branch_short_code`='RJT'";
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
		
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
		
		<div id="contents">
		<page size="A4">
		<table align="center" width="98%" class="test" id="table_1" border="1px" style="font-family: sans-serif;">		
		<tr>
				<td width="20%" style="border-right:2px white solid;"><center>
				<img src="images/branch_logo/<?php echo $company_logo;?>" style="width:300px;height:75px;">
				</center></td>
				<td colspan="3" width="40%" style="width:75px;height:75px;"><center>
				<b style="font-size: 16px;"><?php echo $company_name;?></b>
				
				<p style="margin-top: 6px;margin-bottom: 25px;font-size: 13px;"><?php echo $company_address;?></p>
				</center></td>
				<td width="20%" style="border-left:2px white solid;"><center>&nbsp;</center></td>
				
		</tr>
		</table>
		<table align="center" width="98%" class="test" id="table_1" border="1px" style="font-family: sans-serif;font-size: 12px;">
		<tr>
				<td colspan="5" style="background-color:#5eaecd;"><center>
				<b style="font-size: 14px;">QUOTATION</b>
				</center></td>
		</tr>
		
		<tr>
				<td width="34.7%" style="font-size: 14px;"><b>Quotation No.: <?php echo $rowes["quatation_no"];?></b></td>
				<td width="40%" style="font-size: 14px;"><b>Dated: <?php echo date("d-m-Y",strtotime($rowes["quatation_date"]));?></b></td>
				<td colspan="3" style="font-size: 14px;"><b>Valid Till: <?php echo date("d-m-Y",strtotime($rowes["quatation_date"]. ' + 15 days'));?></b></td>
				
		</tr>
		
		
		
		</table>
		<table align="center" width="98%" class="test" border="1px"  style="font-family: Book Antiqua;">
		
		<tr style="border:1px solid black;">
			    <td colspan="2" width="40%" style="padding:5px;font-size:12px;" >Billing Address<br>
				Name :
				<b style="padding:0px;font-size:12px;"><?php echo $agency_row["agency_name"];?></b><br>
				Address :
				<?php echo $agency_row["agency_address"];?><br>
				GST No : <?php echo $agency_row["agency_gstno"];?><br>
				Phone No. : <?php echo $agency_row["agency_mobile"];?>.<br>
				Email ID. : <?php echo $agency_row["agency_email"];?>.<br>
				</td>
				
				<td colspan="2" width="34.7%" style="padding:5px;font-size:12px;vertical-align:top;" >
				<?php echo $rowes["name_of_work"];?>
				</td>
				
				<td colspan="2" style="padding:5px;font-size:12px;" >
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				</td>
			    
		</tr>
		</table>
		
		<table align="center" width="98%" class="test" id="table_1" border="1px" style="font-family: Book Antiqua;">
		<thead style="margin-top:30px;">
		
		<tr style="border:1px solid black;background-color:#5eaecd;font-family: Book Antiqua;">
			<td width="5%;"><center><b style="font-size:12px;">Sr No.</b></center></td>
			<td width="15%;"><center><b style="font-size:12px;">Material</b></center></td>
			<td width="15%;"><center><b style="font-size:12px;">Test</b></center></td>
			
			<td width="9%;"><center><b style="font-size:12px;">Qty. (Nos)</b></center></td>
			<td width="10%;"><center><b style="font-size:12px;">Rate (Rs.)</b></center></td>
			<?php if($txt_discount_percentage[0]!="0"){ ?>
			<td width="10%;"><center><b style="font-size:12px;">Discount (%)</b></center></td>
			<?php } ?>
			<td width="6%;"><center><b style="font-size:12px;">Amount (Rs.)</b></center></td>
		</tr>
		</thead>
		 <tbody>
		 <?php
		 $counts=1;
		 $totals=0;
		 foreach($mat_ids as $keyer => $one_mt_id)
		{
		?>
		<tr>
			<td class="tdclass" style="padding:5px;font-size: 10px;"><center><?php echo $counts;?></center></td>
			<td class="tdclass" style="padding:5px;font-size:10px"><b><center><?php echo $mate_name[$keyer];?></center></b></td>
			<td class="tdclass" style="padding:5px;font-size:10px;"><b><?php echo $test_name[$keyer];?></b></td>
			<td class="tdclass" style="padding:5px;font-size:10px;"><center><?php echo $test_qty[$keyer];?></center></td>
			<td class="tdclass" style="padding:5px;padding-left: 17px;font-size:10px;"><center><?php echo $test_rates[$keyer];?></center></td>
			<?php if($txt_discount_percentage[0]!="0"){ ?>
			<td class="tdclass" style="padding:5px;padding-left: 17px;font-size:10px;"><center><?php echo $txt_discount_percentage[$keyer];?></center></td>
			<?php } ?>
			<td class="tdclass" style="padding:0px;font-size:10px;text-align:right;"><?php echo $test_totals[$keyer].".00";?></td>
		</tr>
		<?php 
		$totals= intval($totals) + intval($test_totals[$keyer]);
		$counts++;
		} 
		$set_after=intval($totals) - intval($rowes["discount_amount"])
		?>
		<tr>
			<td colspan="<?php echo $sets;?>" style="font-size:14px;text-align:right;">Total</td>
			<td class="tdclass" style="padding:0px;font-size:10px;text-align:right;"><?php echo $totals.".00";?></td>
		</tr>
		<?php if($rowes["discount_amount"]!="0"){?>
		<tr>
			<td colspan="5" style="font-size:14px;text-align:right;">Discount (<span style="font-size:10px;"><?php echo $rowes["discount_percent"];?>%</span>)</td>
			<td class="tdclass" style="padding:0px;font-size:10px;text-align:right;"><?php echo $rowes["discount_amount"].".00";?></td>
		</tr>
		
		<tr>
			<td colspan="5" style="font-size:14px;text-align:right;">Sub Total </td>
			<td class="tdclass" style="padding:0px;font-size:10px;text-align:right;"><?php echo $rowes["grand_total"].".00";?></td>
		</tr>
		<?php } ?>
		
		
		<?php if($rowes["c_gst_amt"]!="0"){?>
		<tr>
			<td colspan="<?php echo $sets;?>" style="font-size:14px;text-align:right;">CGST</td>
			<td class="tdclass" style="padding:0px;font-size:10px;text-align:right;">
			<?php 
			echo $cgsts= $set_after * 9 /100;
			?>
			</td>
		</tr>
		<?php } ?>
		<?php if($rowes["s_gst_amt"]!="0"){?>
		<tr>
			<td colspan="<?php echo $sets;?>" style="font-size:14px;text-align:right;">SGST</td>
			<td class="tdclass" style="padding:0px;font-size:10px;text-align:right;">
			<?php 
			echo $sgsts= $set_after * 9 /100;
			?>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="<?php echo $sets;?>" style="font-size:14px;text-align:right;">Gross Total</td>
			<td class="tdclass" style="padding:0px;font-size:10px;text-align:right;">
			<?php 
			echo $final_total= $set_after + $cgsts + $sgsts;
			?>
			</td>
		</tr>
		 </tbody>
		</table>
		<table align="center" width="98%" class="test" id="table_1" border="1px" style="font-family: Book Antiqua;">
		<tr style="border:1px solid black;background-color:#5eaecd;height:20px;">
			<td colspan="6"><b style="font-size:14px;">Terms & Conditions</b></td>
		</tr>
		<tr style="border:1px solid black;">
			<td colspan="6"><b style="font-size:10px;" id="put_id">
			<textarea style="font-size:10px;width:100%;height:auto;font-family: sans-serif;border:none;" id="textarea_content" rows="8"></textarea>
			</b></td>
		</tr>
		
		<tr style="border:1px solid black;background-color:#5eaecd;">
			<td colspan="6"><b style="font-size:12px;">Bank Details</b></td>
		</tr>
		<tr style="border:1px solid black;">
			<td colspan="6" style="width:50%;"><b style="font-size:12px;"> Beneficiary Name : <?php echo strtoupper($company_name);?></b></td>
			
		</tr>
		<tr style="border:1px solid black;">
			<td colspan="6" style="width:50%;"><b style="font-size:12px;"> Bank Name : <?php echo strtoupper($bank_name);?></b></td>
		</tr>
		<tr style="border:1px solid black;">
			<td colspan="6" style="width:50%;"><b style="font-size:12px;">Bank Account No  : <?php echo strtoupper($bank_account_no);?></b></td>
			
		</tr>
		<tr style="border:1px solid black;">
			<td colspan="6" style="width:50%;"><b style="font-size:12px;"> Bank IFSC Code : <?php echo strtoupper($ifsc_code);?></b></td>
			
		</tr>
		<tr style="border:1px solid black;background-color:#5eaecd;">
			<td colspan="6"><b style="font-size:12px;">Official Details</b></td>
		</tr>
		<tr style="border:1px solid black;">
			<td colspan="2" style="width:50%;"><b style="font-size:12px;">Service Tax No.:</b></td>
			<td colspan="4"><b style="font-size:12px;">PAN No.: <?php echo $pan_no;?></b></td>
		</tr>
		<tr style="border:1px solid black;">
			<td colspan="2" style="width:50%;"><b style="font-size:12px;">GST TIN: <?php echo $branch_gst_no;?></b></td>
			<td colspan="4"><b style="font-size:12px;">CST TIN:</b></td>
		</tr>
		<tr style="border:1px solid black;">
			<td colspan="2" style="width:50%;"><b style="font-size:12px;">CIN No.: </b></td>
			<td colspan="4"><b style="font-size:12px;">&nbsp;</b></td>
		</tr>
		<tr style="border:1px solid black;">
			<td colspan="2" style="width:40%;height:auto;text-align:center;">
			<!--<img src="images/barcodes.png" style="width:90%;text-align:center;">-->
			<br>
				<br>
				<br>
				<br>
				<br>
				<br>
			</td>
			<td colspan="4" style="text-align:center;width:60%;vertical-align:top;">
			
				
				Authorized Signature<br>
				<!--<img src="images/sign.png" style="width:30%;text-align:center;">-->
				<br><br><br>For, <?php echo strtoupper($company_name);?>
				
				
			
			</td>
		</tr>
		</table>
		</page>
		</div>
		<input style="margin-top: 25px;margin-left: 650;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">
	</body>
</html>
	<script src="bower_components/ckeditor/ckeditor.js"></script>
	<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('txt_auth_address')
    //bootstrap WYSIHTML5 - text editor
   // $('.textarea').wysihtml5()
  })
</script>
<script type="text/javascript">
window.onload = function(){ 
	setTimeout(function()
		{
			
			//window.print();
		}, 
		1000);

}

const message = document.getElementById('textarea_content');

const line1 = '1.Please issue work order.';
const line2 = '2.Our rate EXCLUDING 18 % GST.';
const line3 = '3.Payment should be made in NEFT, cheque/D.D payable at per Surat drawn in favor of “PTH CONSULTANCY SERVICES LLP”';
const line4 = '4.Report shall be submitted on release of balance payment.';
const line5 = '5.No Security Deposit shall be deducted from our bills. Any deductions made shall be released along with our final payment.';
const line6 = '6.If You have any queries Concerning this quotation , Please Call 90 16 32 97 36';

message.value = `${line1}\r\n${line2}\r\n${line3}\r\n${line4}\r\n${line5}\r\n${line6}`;

$("#print_button").on("click",function(){
	$('#print_button').hide();
	window.print();
});

</script>