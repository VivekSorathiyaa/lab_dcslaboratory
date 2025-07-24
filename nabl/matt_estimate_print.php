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
		$chk_array=$_GET["chk_array"];
		$explode_chk_array=explode(",",$chk_array);
		$get_trf_no=$explode_chk_array[0];
		$sel_estiamte="select * from estimate_total_span_only_for_estimate where `trf_no`='$chk_array' AND `job_no`='$chk_array'";
		$result_estiamte =mysqli_query($conn,$sel_estiamte);
		$row_estiamte =mysqli_fetch_array($result_estiamte);


		// get name of agency by report no and job no from agency table
		$sel_agency_id=$row_estiamte["agency_id"];
		$txt_bill_to=$row_estiamte["bill_to"];
		$notes=$row_estiamte["notes"];

		$sel_agency="select * from agency_master where `agency_id`=".$sel_agency_id;
		$result_agency =mysqli_query($conn,$sel_agency);
		$row_agency =mysqli_fetch_array($result_agency);
		$agency_name=$row_agency["agency_name"];
		$agency_address=$row_agency["agency_address"];
		$agency_gst=$row_agency["agency_gstno"];


		// get name of work from job by report no
		$sel_job="select * from job where `trf_no`='$get_trf_no'";
		$result_job =mysqli_query($conn,$sel_job);
		$row_job =mysqli_fetch_array($result_job);
		$name_of_work= strip_tags(html_entity_decode($row_job["nameofwork"]),"<strong><em>");

		$get_report_to= $row_job["report_sent_to"];
		$clientname= $row_job["clientname"];
		$agreement_no= $row_job["agreement_no"];
		$client_gstno= $row_job["client_gstno"];

		// set report  send to
		if($txt_bill_to=="1"){

			$sel_city="select * from city where `id`='$row_job[client_city]'";
			$result_city =mysqli_query($conn,$sel_city);
			$row_city =mysqli_fetch_array($result_city);

			$get_clients_name= $row_job["clientname"];
			//$get_clients_address=$row_job["clientaddress"].",".$row_city["city_name"];
			$get_clients_address="";
			//$gst_nos= $row_job["client_gstno"];
			$gst_nos= "";

		}
		if($txt_bill_to=="0"){

			$sel_city="select * from city where `id`='$row_agency[agency_city]'";
			$result_city =mysqli_query($conn,$sel_city);
			$row_city =mysqli_fetch_array($result_city);
			$gst_nos= $row_job["client_gstno"];

			$get_clients_name= $agency_name;
			$get_clients_address=$agency_address.",".$row_city["city_name"];
			$gst_nos= $agency_gst;
		}
		if($txt_bill_to=="2"){



			$get_clients_name= $row_estiamte["other_customer_name"];
			$get_clients_address=$row_estiamte["other_customer_address"];
			$gst_nos=$row_estiamte["other_customer_gst_no"];
		}


		//get from tax
		$sel_tax="select * from tax";
		$result_tax =mysqli_query($conn,$sel_tax);
		$get_tax =mysqli_fetch_array($result_tax);

		$all_hsn_codes_name=explode(",",$row_estiamte["hsn_codes"]);
		$all_material_name=explode(",",$row_estiamte["all_material_name"]);
		$all_material_qty=explode(",",$row_estiamte["all_material_qty"]);
		$all_material_rates=explode(",",$row_estiamte["all_material_rates"]);
		$all_material_amt=explode(",",$row_estiamte["all_material_amt"]);

		$sub_total= $row_estiamte["sub_total"];
		$discount_percent= $row_estiamte["discount_percent"];
		$discount_amount= $row_estiamte["discount_amount"];

		$refno="";
	  foreach($explode_chk_array as $one_trf_nos)
	  {
		  $sel_job="select * from job where `trf_no`='$one_trf_nos'";
		  $result_job =mysqli_query($conn,$sel_job);
		  $row_job =mysqli_fetch_array($result_job);
		  $refno .= '<span style="min-width:100px;">'.$row_job["refno"].'</span>'."&nbsp;&nbsp;&nbsp;&nbsp;Date:-&nbsp;&nbsp;".date('d-m-Y',strtotime($row_job["date"]))."<br>";

		  $update_jobs= "update job set `print_done_by_biller_for_qm_see`=1 where `trf_no`='$one_trf_nos'";
		  $results_jobs =mysqli_query($conn,$update_jobs);
	  }

?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<br>
		<br>
		<br>


		<page size="A4">
		<table align="center" width="80%" class="test" border="1px" style="font-family: Book Antiqua;">

		<tr class="padding_class">
				<td colspan="7" style="text-align:right;"><b>Date :- <?php echo date('d.m.Y', strtotime($row_estiamte['estimate_date']));?></b></td>
		</tr>

		<tr class="padding_class" style="height: 40px;border:0px;">
				<td colspan="7">
				<b>To,</b><br>
				<b><?php echo $get_clients_name; ?></b><br>
				<?php echo $get_clients_address; ?><br>

				</td>

		</tr>

		<tr class="padding_class" style="height: 80px;padding:20px;">
				<td colspan="7">
				<br>
				<table align="center" width="100%" class="test" border="0px" style="font-family: Book Antiqua;">
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
				<td>Material Testing Estimate</td>
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

				  $count_get=1;
				  foreach($all_material_name as $keys => $one_material_name)
				  { ?>
					<tr>
						<td width="11%" rowspan="2"><b><?php echo $count_get;?></b></td>
						<td width="28%"><b>Testing of <?php echo $one_material_name;?></b></td>
						<td width="11%"><b>&nbsp;</b></td>
						<td width="11%"><b>&nbsp;</b></td>
						<td width="11%"><b>&nbsp;</b></td>
						<td width="11%"><b>&nbsp;</b></td>
					</tr>
					<tr>
						<td width="28%"><b>&nbsp;</b></td>
						<td width="11%"><?php echo $all_material_qty[$keys];?></td>
						<td width="11%">No.</td>
						<td width="11%"><?php echo $all_material_rates[$keys];?></td>
						<td width="11%"><?php echo $all_material_amt[$keys];?></td>
					</tr>
					<?php

					$count_get++;
				  }

				?>
				<?php
				if($discount_percent !="0")
				{
				?>
					<tr>
					<td colspan="5" style="text-align:right;"><b>Sub Total Rs.</b></td>
					<td width="11%">&nbsp;<?php echo number_format($sub_total,2);?></td>
					</tr>

					<tr>
					<td colspan="5" style="text-align:right;"><b>Discount(<?php echo $discount_percent;?>%)</b></td>
					<td width="11%">&nbsp;<?php echo number_format($discount_amount,2);?></td>
					</tr>

					<tr>
					<td colspan="5" style="text-align:right;"><b>Grand Total Rs.</b></td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["grand_total"],2);?></td>
				    </tr>
				<?php
				}else{
				?>
					<tr>
					<td colspan="5" style="text-align:right;"><b>Sub Total Rs.</b></td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["grand_total"],2);?></td>
				    </tr>
				<?php
				}
				?>
				<?php
				if($row_estiamte["gst_type"]!="without_gst"){
				?>
				<tr>
					<td colspan="5" style="text-align:right;"><b>CGST 9%</b></td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["c_gst_amt"],2);?></td>
				</tr>
				<tr>
					<td colspan="5" style="text-align:right;"><b>SGST 9%</b></td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["s_gst_amt"],2);?></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="5" style="text-align:right;"><b>Total</b></td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["total_amt"],2);?></td>
				</tr><tr>
					<td colspan="5" style="text-align:right;"><b>Say Rs.</b></td>
					<td width="11%">&nbsp;<?php echo number_format($row_estiamte["total_amt"],2);?></td>
				</tr>
				<tr>
					<td colspan="6" style="border: 2px solid black;"><b>In Words &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucwords($row_estiamte["total_amt_in_word"]);?></b></td>
				</tr>

		<tr class="padding_class" style="height: 50px;padding:0px;">
				<td colspan="6">
				<?php echo $notes; ?>
				</td>
		</tr>

		</table>

			<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">
</page>
	</body>
</html>

<script type="text/javascript">
$("#print_button").on("click",function(){
	$('#print_button').hide();
	window.print();
});

</script>
