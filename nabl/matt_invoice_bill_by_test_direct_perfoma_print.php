<?php
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
@page { margin: 0; }


@media print{@page }

.tdclass{
    border: 1px solid black;
    font-size:12px;
	 font-family: Book Antiqua;
}
.test {
    border-collapse: collapse;
}
	.tdclass1{

    font-size:12px;
	 font-family: Book Antiqua;
}
. padding_class
{
padding:10px;
}

</style>
<html>
	<body>
<?php
		// get estimate by report no and job no
		$perfoma_no=$_GET["perfoma_no"];
		$explode_trf_no=explode(",",$_GET["perfoma_no"]);
		//$one_trf_no=$explode_trf_no[0];
		$one_trf_no="";
	    $sel_estiamte="select * from estimate_total_span_only_for_test where `perfoma_no`='$perfoma_no'";
		$result_estiamte =mysqli_query($conn,$sel_estiamte);
		$row_estiamte =mysqli_fetch_array($result_estiamte);


		// get name of agency by report no and job no from agency table
		$sel_agency_id=$row_estiamte["agency_id"];
		$hsn_codes=$row_estiamte["hsn_codes"];
		$bill_no=$row_estiamte["bill_no"];
		$bill_to=$row_estiamte["bill_to"];
		$gst_type=$row_estiamte["gst_type"];
		$gst_in_or_ex=$row_estiamte["gst_in_or_ex"];
		$discount_percent=$row_estiamte["discount_percent"];
		$discount_amount=$row_estiamte["discount_amount"];

		$sel_agency="select * from agency_master where `agency_id`=".$sel_agency_id;
		$result_agency =mysqli_query($conn,$sel_agency);
		$row_agency =mysqli_fetch_array($result_agency);
		$agency_address=$row_agency["agency_address"];
		$agency_gst=$row_agency["agency_gstno"];

		$agency_name=$row_agency["agency_name"];
		$name_of_work=$row_estiamte["name_of_work"];
		$customer_name=$row_estiamte["customer_name"];
		$agreement_no=$row_estiamte["agreement_no"];
		$refno=$row_estiamte["reference_no"];

	    $client_gstno= "";

		// set report  send to
		if($bill_to=="1"){

			$get_clients_name= $customer_name;
			$get_clients_address="";
		}else{

			$sel_city="select * from city where `id`='$row_agency[agency_city]'";
			$result_city =mysqli_query($conn,$sel_city);
			$row_city =mysqli_fetch_array($result_city);

			$get_clients_name= $agency_name;
			$get_clients_address="";
		}


		//get from tax
		$sel_tax="select * from tax";
		$result_tax =mysqli_query($conn,$sel_tax);
		$get_tax =mysqli_fetch_array($result_tax);

		$mate_id_array=explode(",",$row_estiamte["mat_ids"]);
		$mate_name_array=explode(",",$row_estiamte["mate_name"]);
		$test_ids_array=explode(",",$row_estiamte["test_ids"]);
		$test_name_array=explode(",",$row_estiamte["test_name"]);
		$test_qty_array=explode(",",$row_estiamte["test_qty"]);
		$test_rates_array=explode(",",$row_estiamte["test_rates"]);
		$test_totals_array=explode(",",$row_estiamte["test_totals"]);

		$sub_total= $row_estiamte["sub_total"];
		$discount_percent= $row_estiamte["discount_percent"];
		$discount_amount= $row_estiamte["discount_amount"];

?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<br>
		<br>
		<br>


		<page size="A4">
		<table align="center" width="80%" class="test" border="1px" style="font-family: Book Antiqua;">

		<tr class="padding_class">
				<td colspan="6" style="text-align:right;"><b>Date :- <?php echo date('d.m.Y', strtotime($row_estiamte['estimate_date']));?></b></td>
		</tr>

		<tr class="padding_class">
				<td colspan="6"><b>Customer Detail</b><span style="float:right;" id="duplicate_id"></span></td>
		</tr>

		<tr class="padding_class" style="height: 40px;">
				<td colspan="6"><b>Name of Customer</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:-</b>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $get_clients_name; ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $get_clients_address; ?>
				</td>

		</tr>
		<tr class="padding_class" style="height: 80px;padding:20px;">
				<td colspan="6">
				<table align="center" width="100%" class="test" border="0px" style="font-family: Book Antiqua;">
				<tr>
				<td width="16%"><b>Code MT</b></td>
				<td width="2%"><b>:-</b></td>
				<td>Invoice No:- <?php echo $bill_no;?></td>
				</tr>
				<tr>
				<td width="16%"><b>Name of Agency</b></td>
				<td width="2%"><b>:-</b></td>
				<td><?php echo $agency_name;?></td>
				</tr>
				<tr>
				<td width="16%"><b>Name of Work</b></td>
				<td width="2%"><b>:-</b></td>
				<td><?php echo $name_of_work;?></td>
				</tr>

				<tr>
				<td width="16%"><b>Agreement. No</b></td>
				<td width="2%"><b>:-</b></td>
				<td><?php echo $agreement_no;?></td>
				</tr>

				<tr>
				<td width="16%"><b>Reference No</b></td>
				<td width="2%"><b>:-</b></td>
				<td><?php echo $refno;?></td>
				</tr>

				<tr>
				<td width="16%"><b>Subject</b></td>
				<td width="2%"><b>:-</b></td>
				<td>Material Testing Invoice</td>
				</tr>
				</table>

				</td>
		</tr>
		<tr class="padding_class">
				<td colspan="6">&nbsp;</td>
		</tr>
		<tr>
						<td width="11%"><b>Sr No.</b></td>
						<td width="28%"><b>Particular</b></td>
						<td width="11%"><b>Qty</b></td>
						<td width="11%"><b>Unit</b></td>
						<td width="11%"><b>Unit Rate</b></td>
						<td width="11%"><b>Amount</b></td>
		</tr>

		<?php

				$set_unique_mat_id_array=array();
				foreach($mate_id_array as $one_mat_id)
				{
					if (!in_array($one_mat_id, $set_unique_mat_id_array))
					{
						array_push($set_unique_mat_id_array,$one_mat_id);
					}
				}

				$set_unique_mat_name_array=array();
				foreach($mate_name_array as $one_mat_name)
				{
					if (!in_array($one_mat_name, $set_unique_mat_name_array))
					{
						array_push($set_unique_mat_name_array,$one_mat_name);
					}
				}

				  if(count($set_unique_mat_name_array) > 0)
				  {
				  $count_get=1;
				  foreach($set_unique_mat_name_array as $keying => $one_unique_mat_name)
				  { ?>
					<tr style="border-top-width: 2px;">
					<td width="11%"><b><?php echo $count_get; ?></b></td>
						<td width="28%"><i><b>Testing of &nbsp; <?php echo $one_unique_mat_name;?></b></i></td>
						<td width="11%"><b></b></td>
						<td width="11%"><b></b></td>
						<td width="11%"><b> </b></td>
						<td width="11%"><b></b></td>
					</tr>
				  <?php
					foreach($test_name_array as $keys => $one_test_name)
					{
					 $sele_test_categorys="select * from test_wise_material_rate where `material_cat_id`='$set_unique_mat_id_array[$keying]' AND `test_id`=".$test_ids_array[$keys];
					$query_test_category=mysqli_query($conn,$sele_test_categorys);

					if(mysqli_num_rows($query_test_category)>0)
					{
					?>

					<tr>
						<td width="11%">&nbsp;</td>
						<td width="28%">&nbsp; <?php echo ucwords($test_name_array[$keys]);?></td>
						<td width="11%">&nbsp; <?php echo $test_qty_array[$keys];?></td>
						<td width="11%">&nbsp; No.</td>
						<td width="11%">&nbsp; <?php echo $test_rates_array[$keys];?></td>
						<td width="11%">&nbsp; <?php echo $test_totals_array[$keys];?></td>

					    </tr>
					<?php
					}
					}
					$count_get++;
				  }
				  }

				if($gst_type !="without_gst" && $gst_in_or_ex=="include")
				{
				?>
				<tr>
					<td colspan="5" style="text-align:right;">Sub Total Rs.</td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["total_amt"],2);?></td>
				</tr>
				<?php
				}
				else
				{ ?>
				<tr>
					<td colspan="5" style="text-align:right;">Sub Total Rs.</td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["grand_total"],2);?></td>
				</tr>
				<?php
				}

				if($discount_percent !="0")
				{ ?>
				<tr>
					<td colspan="5" style="text-align:right;">Discount(<?php echo $discount_percent;?>%)</td>
					<td width="11%">&nbsp;<?php echo $discount_amount;?></td>
				</tr>
				<?php }

				if($gst_type !="without_gst" && $gst_in_or_ex=="exclude")
				{
				?>
				<tr>
					<td colspan="5" style="text-align:right;">CGST 9%</td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["c_gst_amt"],2);?></td>
				</tr>
				<tr>
					<td colspan="5" style="text-align:right;">SGST 9%</td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["s_gst_amt"],2);?></td>
				</tr>
				<tr>
					<td colspan="5" style="text-align:right;">Total</td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["total_amt"],2);?></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="5" style="text-align:right;">Say Rs.</td>
					<td width="11%"><b>&nbsp;<?php echo number_format($row_estiamte["total_amt"],2);?></b></td>
				</tr>
				<tr>
					<td colspan="6" style="border: 2px solid black;"><b>In Words &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucwords($row_estiamte["total_amt_in_word"]);?></b></td>
				</tr>
				<tr>
					<td colspan="6" style="border: 2px solid black;">&nbsp;</td>
				</tr>
		</table>
		<table align="center" width="80%" class="test" border="1px" style="font-family: Book Antiqua;">
			<?php
			if($gst_type !="without_gst" && $gst_in_or_ex=="include")
			{
			?>
			<tr>
				<td rowspan="2" colspan="2" style="width:20%;"><b>HSN/SAC Code</b></td>
				<td rowspan="2" style="width:10%;"><b>Taxable Value</b></td>
				<td colspan="2" style=""><b>Central Tax</b></td>
				<td colspan="2" style=""><b>State Tax</b></td>
				<td style=""><b>Total</b></td>
			</tr>
			<tr>
				<td style=""><b>Rate</b></td>
				<td style=""><b>Amount<b></td>
				<td style=""><b>Rate</b></td>
				<td style=""><b>Amount<b></td>
				<td style=""><b>Tax Amount</b></td>

			</tr>
			<tr>
				<td colspan="2" style=""><?php echo $hsn_codes;?></td>
				<td style=""><?php echo number_format($row_estiamte["grand_total"],2);?></td>
				<td style="">9%</td>
				<td style=""><?php echo number_format($row_estiamte["c_gst_amt"],2);?></td>
				<td style="">9%</td>
				<td style=""><?php echo number_format($row_estiamte["s_gst_amt"],2);?></td>
				<td style=""><?php echo number_format($row_estiamte["s_gst_amt"] + $row_estiamte["c_gst_amt"],2);?></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:right;">Total</td>
				<td style=""><?php echo number_format($row_estiamte["grand_total"],2);?></td>
				<td style="">&nbsp;</td>
				<td style=""><?php echo number_format($row_estiamte["c_gst_amt"],2);?></td>
				<td style="">&nbsp;</td>
				<td style=""><?php echo number_format($row_estiamte["s_gst_amt"],2);?></td>
				<td style=""><?php echo number_format($row_estiamte["s_gst_amt"] + $row_estiamte["c_gst_amt"],2);?></td>
			</tr>
			<tr>
				<td colspan="8" style="border: 2px solid black;">&nbsp;</td>
			</tr>
			<?php } ?>
			<tr class="padding_class" style="height: 50px;padding:20px;">
				<td colspan="8">
				<span ><b>TAN No</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:- SRTM08283C<br>
				<span ><b>GST Number</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:-</b>&nbsp;&nbsp;&nbsp;&nbsp;24AAVFM4506G1Z6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p style="text-align:right;margin-right: 124px;"><b><i><span style="font-size:13px">For</span> <span style="font-size:16px">Mattest Engineering Services</span></b></i></p>
				</td>
		</tr>
		</table>

			<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

			<input style="margin-top: -50px;margin-left: 732;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_duplicate" id="print_duplicate" value="DUPLICATE">
</page>
	</body>
</html>

<script type="text/javascript">
$("#print_button").on("click",function(){
	$('#print_button').hide();
	$('#print_duplicate').hide();
	window.print();
});

$("#print_duplicate").on("click",function(){
	$('#print_button').hide();
	$('#print_duplicate').hide();
	$("#duplicate_id").html('<span style="color: lightgray;">Duplicate Copy</span>');
	window.print();
});

</script>
