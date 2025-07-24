<?php include("header.php");?>
<?php
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}



	$perfoma_no= $_GET["perfoma_no"];

	$txt_trf_no= $get_chk_array[0];
	$txt_jobs= $get_chk_array[0];

	// to get job for agency id
$sel_job="select * from job where `trf_no`='$txt_trf_no'";
$query_job= mysqli_query($conn,$sel_job);
$result_job=mysqli_fetch_array($query_job);
$get_agency_id= "";

$sel_agency="select * from agency_master where `agency_id`=".$get_agency_id;
$query_agency= mysqli_query($conn,$sel_agency);
$result_agency=mysqli_fetch_array($query_agency);
$get_agency_gst_no= "";

 // get_estimate if available
 $sel_estiamte="select * from estimate_total_span_only_for_test where `perfoma_no`='$_GET[perfoma_no]' AND `est_isdeleted`=0";

 $estiamte_query= mysqli_query($conn,$sel_estiamte);
 if(mysqli_num_rows($estiamte_query) > 0){

	 $get_estimate= mysqli_fetch_array($estiamte_query);
	 $get_rate_type= $get_estimate["rate_type"];
	 $get_gst_type= $get_estimate["gst_type"];
	 $gst_no= $get_estimate["gst_no"];
	 $get_c_gst_amt= $get_estimate["c_gst_amt"];
	 $get_s_gst_amt= $get_estimate["s_gst_amt"];
	 $get_i_gst_amt= $get_estimate["i_gst_amt"];
	 $get_grand_total= $get_estimate["grand_total"];
	 $get_total_amount= $get_estimate["total_amt"];
	 $get_total_amt_in_word= $get_estimate["total_amt_in_word"];
	 $hsn_codes= $get_estimate["hsn_codes"];
	 $gst_in_or_ex= $get_estimate["gst_in_or_ex"];
     $discount_amount= $get_estimate["discount_amount"];
	 $discount_percent= $get_estimate["discount_percent"];
	 $bill_to= $get_estimate["bill_to"];
	 $other_customer_name= $get_estimate["other_customer_name"];
	 $other_customer_address= $get_estimate["other_customer_address"];
	 $other_customer_gst_no= $get_estimate["other_customer_gst_no"];
	 $bill_no= $get_estimate["bill_no"];
	 $perfoma_nos= $get_estimate["perfoma_no"];
	 $customer_name= $get_estimate["customer_name"];
	 $name_of_work= $get_estimate["name_of_work"];
	 $agreement_no= $get_estimate["agreement_no"];
	 $reference_no= $get_estimate["reference_no"];
	 $agency_id= $get_estimate["agency_id"];


	 $is_estimate_avail="available";

	 $mate_id= explode(",",$get_estimate["mat_ids"]);
	 $mate_name= explode(",",$get_estimate["mate_name"]);
	 $test_name= explode(",",$get_estimate["test_name"]);
	 $test_ids= explode(",",$get_estimate["test_ids"]);
	 $test_qty= explode(",",$get_estimate["test_qty"]);
	 $test_rates= explode(",",$get_estimate["test_rates"]);
	 $test_totals= explode(",",$get_estimate["test_totals"]);

 }else{

		$sel_perfoma="select * from estimate_total_span where `perfoma_no`='$_GET[perfoma_no]' AND `est_isdeleted`=0";
		$perfoma_query= mysqli_query($conn,$sel_perfoma);
		if(mysqli_num_rows($perfoma_query) > 0)
		{
	       $get_perfoma= mysqli_fetch_array($perfoma_query);

		   $merge_material_id_array=explode(",",$get_perfoma["mat_ids"]);
		   $merge_material_name_array=explode(",",$get_perfoma["mate_name"]);
		   $merge_test_id_array=explode(",",$get_perfoma["test_ids"]);
		   $merge_test_name_array=explode(",",$get_perfoma["test_name"]);
		   $merge_test_qty_array=explode(",",$get_perfoma["test_qty"]);
		   $merge_test_rate_array=explode(",",$get_perfoma["test_rates"]);
		   $merge_test_amt_array=explode(",",$get_perfoma["test_totals"]);
		   $get_rate_type=$get_perfoma["rate_type"];
		   $perfoma_nos=$get_perfoma["perfoma_no"];
		   $customer_name=$get_perfoma["customer_name"];
		   $name_of_work=$get_perfoma["name_of_work"];
		   $agreement_no=$get_perfoma["agreement_no"];
		   $reference_no=$get_perfoma["reference_no"];
		   $agency_id=$get_perfoma["agency_id"];
		   $gst_no=$get_perfoma["gst_no"];
		}



	 $get_gst_type="";
	 $get_c_gst_amt="";
	 $get_s_gst_amt="";
	 $get_i_gst_amt="";
	 $get_grand_total="";
	 $get_total_amount="";
	 $get_total_amt_in_word="";
	 $hsn_codes="";


	  $is_estimate_avail="not_available";

	  $gst_in_or_ex="";
	  $discount_amount="0";
	 $discount_percent="0";
	 $bill_to="0";
	 $other_customer_name= "";
	 $other_customer_address= "";
	 $other_customer_gst_no= "";
	 $bill_no="";
 }


		 // bill sequence logic
		 $sel_estiamte_for_bill_no="select * from estimate_total_span_bill_sequence  ORDER BY bill_id DESC";
		 $query_estiamte_for_bill_no = mysqli_query($conn, $sel_estiamte_for_bill_no);

		 if (mysqli_num_rows($query_estiamte_for_bill_no) > 0)
		 {
			$result_estiamte_for_bill_no = mysqli_fetch_assoc($query_estiamte_for_bill_no);
			$explode_bill_no= explode("/",$result_estiamte_for_bill_no["bill_no"]);

			$first_explode=$explode_bill_no[0];
			$second_explode=$explode_bill_no[1];
			$third_explode=$explode_bill_no[2];
			$l_trim_third_explode= ltrim($third_explode,"0");
			$plus_of_bill= intval($l_trim_third_explode)+1;
			$final_bill_no= sprintf('%04d', $plus_of_bill);

			$sel_year="select * from fyearmaster where `fy_isactive`=0";
			$query_year = mysqli_query($conn, $sel_year);
			$result_year = mysqli_fetch_array($query_year);
			$year_name=$result_year["fy_name"];
			$today_date=date("Ymd");

			$set_bill_no= $first_explode."/".$year_name."/".$final_bill_no;
		}
		else
		{
			$sel_year="select * from fyearmaster where `fy_isactive`=0";
			$query_year = mysqli_query($conn, $sel_year);
			$result_year = mysqli_fetch_array($query_year);
			$year_name=$result_year["fy_name"];
			$today_date=date("Ymd");

			$set_bill_no= "GST/".$year_name."/0001";

		}



?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}



.form-control {
font-size: 20px;
height: 50px;
}



</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">

<section class="content">
			<?php include("menu.php") ?>
			<div class="row">

		<h1 style="text-align:center;">
		Invoice By Test
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">

							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									<div class="col-sm-4">
									<label for="inputEmail3" class="col-sm-2 control-label">Agency:</label>
									</div>

									<div class="col-sm-2">
									<label for="inputEmail3" class="col-sm-2 control-label">Agreement No.</label>
									</div>

									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Reference No.</label>
									</div>

									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label"> Date:</label>
									</div>
								</div>
								<div class="row">

										  <div class="col-sm-3">
											<select class="form-control  select2 col-sm-12" data-placeholder="Select Agency" tabindex="9"  id="select_agency" name="select_agency" required >
														<option value="">Select Agency</option>
														<?php
															$cat_sql = "select * from agency_master where `isdeleted`=0";

															$cat_result = mysqli_query($conn, $cat_sql);

																while($cat_row = mysqli_fetch_assoc($cat_result)) {

															?>
															<option value="<?php echo $cat_row['agency_id']; ?>" <?php if($agency_id==$cat_row['agency_id']){ echo "selected"; }?>>
															<?php echo $cat_row['agency_name']; ?></option>
															<?php  }?>
											 </select>
										  </div>
										  <div class="col-sm-1">
														<input type="button" value="+" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-agency">

										</div>


											<div class="col-sm-2">

													<input type="text" class="form-control" value="<?php echo $agreement_no; ?>" id="agreement_no" name="agreement_no" >
											</div>


											<div class="col-sm-3">

													<input type="text" class="form-control" value="<?php echo $reference_no; ?>" id="reference_no" name="reference_no" >
											</div>

											<div class="col-md-3">
													<input type="text"  class="form-control" name="invoice_date" id="invoice_date" value="<?php echo date('d/m/Y')?>">

											</div>

								</div>
								<br>
								<div class="row">
									<div class="col-sm-1">
									<label for="inputEmail3" class="col-sm-2 control-label">Name Of Work:</label>
									</div>

									<div class="col-sm-4">
									<textarea name="name_of_work" id="name_of_work" class="form-control"><?php echo $name_of_work; ?></textarea>
									</div>
									<div class="col-sm-1">
									<label for="inputEmail3" class="col-sm-2 control-label">Customer Name:</label>
									</div>

									<div class="col-sm-4">
									<input type="text" class="form-control" value="<?php echo $customer_name; ?>" id="customer_name" name="customer_name" >
									</div>


								</div>
								<br>
								<div class="row">
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Rate:</label>
									</div>
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">GST NO:</label>
									</div>
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">HSN/SAC Code:</label>
									</div>
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Bill No:</label>
									</div>
								</div>
								<div class="row">

										  <div class="col-md-3">
											<div class="form-group">

												<div class="col-sm-12">
													<select class="form-control " name="select_rate" id="select_rate" >
														<option value="" <?php if($get_rate_type==""){echo "selected";}?>>Select Rate</option>
														<option value="0" <?php if($get_rate_type=="0"){echo "selected";}?>>Government</option>
														<option value="1" <?php if($get_rate_type=="1"){echo "selected";}?>>Private</option>
														<option value="2" <?php if($get_rate_type=="2"){echo "selected";}?>>Other</option>

													</select>
												</div>
											</div>
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="gst_no" id="gst_no" value="<?php echo $gst_no;?>">
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="hsn_codes" id="hsn_codes" value="">
										  </div>
										  <div class="col-md-3">
												<input type="text"  class="form-control" name="bill_no" id="bill_no" value="<?php if($bill_no==""){ echo $set_bill_no; }else{ echo $bill_no;}?>" >

										  </div>
								</div>
								<br>
								<div class="row">
										<div class="col-sm-2">
										<label for="inputEmail3" class="control-label">Bill To :</label>
										</div>
										<div class="col-sm-9">
											<input type="radio" style="width:33px;height:25px;" name="txt_bill_to" value="0" <?php if($bill_to=="0"){ echo "checked";} ?>><span style="font-size:20px;" ><b>Agency</b></span>
											<input type="radio" style="width:33px;height:25px;"name="txt_bill_to" value="1" <?php if($bill_to=="1"){ echo "checked";} ?>><span style="font-size:20px;"><b>Client<b></span>
											<input type="radio" style="width:33px;height:25px;"name="txt_bill_to" value="2" <?php if($bill_to=="2"){ echo "checked";} ?>><span style="font-size:20px;"><b>Other<b></span>
										</div>
								</div>
								<br>
								<div class="row" id="bill_to_hide_show" style="<?php if($bill_to!="2"){ echo "display:none";}else{ echo "display:block";} ?>">


									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Customer Name:</label>
									</div>

									<div class="col-md-2">
									<input type="text" name="other_customer_name" class="form-control" id="other_customer_name" value="<?php echo $other_customer_name;?>">
									</div>

									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Customer Address:</label>
									</div>

									<div class="col-md-2">
									<input type="text" name="other_customer_address" class="form-control" id="other_customer_address" value="<?php echo $other_customer_address;?>">
									</div>

									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">Customer GSt No:</label>
									</div>

									<div class="col-md-2">
									<input type="text" name="other_customer_gst_no" class="form-control" id="other_customer_gst_no" value="<?php echo $other_customer_gst_no;?>">
									</div>



								</div>
								<br>
							<div class="panel-group">
								<div class="box box-info">
									<div class="box-body">
									  <div class="table-responsive" id="display_data">
										<table class="table no-margin">
										  <thead>
										  <tr>
											<th>Test Name</th>
											<th>Qty</th>
											<th>Rate</th>
											<th>Amount<?php echo $is_estimate_avail;?></th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php

											if($is_estimate_avail=="not_available")
											{
												foreach($merge_test_id_array as $keyer => $one_test_id)
												{
														  ?>
														  <tr>
														  <td colspan="4">
														  <input type="hidden" name="mt_id[]" class="class_mate_id" id="mateid_<?php echo $keyer;?>" value="<?php echo $merge_material_id_array[$keyer]; ?>">
														  <input type="text" name="mat_name[]" class="class_mate_name" id="matename_<?php echo $keyer;?>" value="<?php echo $merge_material_name_array[$keyer]; ?>" disabled style="width:200px;font-weight:bold;">
														  </td>
														  </tr>
														  <tr>
															<td>
															<input type="hidden" name="test_id[]" class="class_test_id" id="testid_<?php echo $keyer;?>" value="<?php echo $one_test_id;?>">
															<input type="text" name="test_name[]" class="form-control class_test" id="test_<?php echo $keyer;?>" value="<?php echo $merge_test_name_array[$keyer];?>" >
															</td>
															<td>
															<input type="text" name="qty[]" class="form-control class_qty" id="qty_<?php echo $keyer;?>" value="<?php echo $merge_test_qty_array[$keyer];?>" >
															</td>
															<td>
															<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_<?php echo $keyer;?>" value="<?php echo $merge_test_rate_array[$keyer];?>">
															</td>
															<td>
															  <input type="text" name="amt[]" class="form-control class_amnt" id="amt_<?php echo $keyer;?>" value="<?php echo $merge_test_amt_array[$keyer];?>" disabled>
															</td>
														  </tr>
														<?php
													     }
										    }
										  if($is_estimate_avail=="available")
											{
												foreach($test_name as $one_key => $one_tests)
												{ ?>

													<tr>
													 <td colspan="4">
													 <input type="hidden" name="mt_id[]" class="class_mate_id" id="mateid_<?php echo $one_key;?>" value="<?php echo $mate_id[$one_key]; ?>">
													<input type="text" name="mat_name[]" class=" class_mate_name" id="matename_<?php echo $keyer;?>" value="<?php echo $mate_name[$one_key]; ?>" disabled style="width:200px;font-weight:bold;">
													</td>
													</tr>
													<tr>
													<td>
													<input type="hidden" name="test_id[]" class="class_test_id" id="testid_<?php echo $one_key;?>" value="<?php echo $test_ids[$one_key];?>">
													<input type="text" name="test_name[]" class="form-control class_test" id="test_<?php echo $one_key;?>" value="<?php echo $one_tests; ?>" >
													</td>
													<td>
													<input type="text" name="qty[]" class="form-control class_qty" id="qty_<?php echo $one_key;?>" value="<?php echo $test_qty[$one_key]; ?>" >
													</td>
													<td>
													<input type="text" name="rate[]" class="form-control txt_rate_class" id="rate_<?php echo $one_key;?>" value="<?php echo $test_rates[$one_key]; ?>">
													</td>
													<td>
													  <input type="text" name="amt[]" class="form-control class_amnt" id="amt_<?php echo $one_key;?>" value="<?php echo $test_totals[$one_key]; ?>" disabled>
													</td>
													</tr>


												<?php
												}
											}

										?>
										  </tbody>
										</table>
									  </div>
									</div>
								</div>
							</div>
							<br>
							<div class="box box-info">
							<br>
								<div class="row">
									<div class="col-sm-2"><label for="inputEmail3" class="control-label">Sub Total:</label></div>
									<div class="col-sm-1">
									<input type="text" name="txt_sub_total" class="form-control" id="txt_sub_total" value="">
									</div>
									<div class="col-sm-2"><label for="inputEmail3" class="control-label">Discount Percent:</label></div>
									<div class="col-sm-1">
									<input type="text" name="txt_discount_percent" class="form-control" id="txt_discount_percent" value="<?php echo $discount_percent;?>">
									</div>
									<div class="col-sm-2"><label for="inputEmail3" class="control-label">Discount Amount:</label></div>
									<div class="col-sm-2">
									<input type="text" name="txt_discount_amount" class="form-control" id="txt_discount_amount" value="<?php echo $discount_amount;?>">
									</div>
								</div>
							<br>
							</div>
							<div class="box box-info">
							<input type="hidden" name="hidden_gst_type" id="hidden_gst_type" value="without_gst">
							<input type="hidden" name="hidden_gst_in_ex" id="hidden_gst_in_ex" value="">
							<input type="hidden" name="hidden_perfoma_nos" id="hidden_perfoma_nos" value="<?php echo $perfoma_nos;?>">
								<div class="row">
									<div class="col-sm-2">
									<label for="inputEmail3" class="control-label">GST TYPE:</label>
									</div>

									<div class="col-sm-9">
										<input type="radio" style="width:33px;height:25px;" name="gst_type" value="with_gst" <?php if($get_gst_type=="with_gst"){ echo "checked";} ?>><span style="font-size:20px;" ><b>With GST</b></span>
										<input type="radio" style="width:33px;height:25px;"name="gst_type" value="without_gst" <?php if($get_gst_type=="" || $get_gst_type=="without_gst"){ echo "checked";} ?>><span style="font-size:20px;"><b>Without GST<b></span>
										<input type="radio" style="width:33px;height:25px;"name="gst_type" value="with_igst" <?php if($get_gst_type!="" && $get_gst_type=="with_igst"){ echo "checked";} ?>><span style="font-size:20px;"><b>With IGST<b></span>
									</div>
								</div>
								<br>
								<div class="row" id="gst_hide_show" style="<?php if($get_gst_type=="" || $get_gst_type=="without_gst"){ echo "display:none";}else{ echo "display:block";} ?>">

									<div class="row">
										<div class="col-sm-2">
										<label for="inputEmail3" class="control-label">&nbsp;</label>
										</div>
										<div class="col-sm-9">
											<input type="radio" style="width:33px;height:25px;" name="in_or_ex" value="include" <?php if($gst_in_or_ex=="include"){ echo "checked";} ?>><span style="font-size:20px;" ><b>Include</b></span>
											<input type="radio" style="width:33px;height:25px;"name="in_or_ex" value="exclude" <?php if($gst_in_or_ex=="exclude"){ echo "checked";} ?>><span style="font-size:20px;"><b>Exclude<b></span>
										</div>
									</div>
									<br>
									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">CGST AMONUT:</label>
									</div>

									<div class="col-md-2">
									<input type="text" name="txt_cgst" class="form-control" id="txt_cgst" value="<?php echo $get_c_gst_amt;?>" disabled>
									</div>

									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">SGST AMONUT:</label>
									</div>

									<div class="col-md-2">
									<input type="text" name="txt_sgst" class="form-control" id="txt_sgst" value="<?php echo $get_s_gst_amt;?>" disabled>
									</div>

									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">IGST AMONUT:</label>
									</div>

									<div class="col-md-2">
									<input type="text" name="txt_igst" class="form-control" id="txt_igst" value="<?php echo $get_i_gst_amt;?>" disabled>
									</div>

									<div class="col-md-1">
									<label for="inputEmail3" class="control-label">GRAND TOTAL:</label>
									</div>

									<div class="col-md-2">
									<input type="text" name="txt_grand" class="form-control" id="txt_grand" value="<?php echo $get_grand_total;?>" disabled>
									</div>
								</div>

							</div>
							<div class="box box-info">
							<br>
								<div class="row">
									<div class="col-md-3">
									<label for="inputEmail3" class="control-label">Total Amount In Word:</label>
									</div>

									<div class="col-md-4">
									<input type="text" name="txt_amt_in_word" class="form-control" id="txt_amt_in_word" value="<?php if($get_total_amt_in_word !=""){ echo $get_total_amt_in_word;}else{ echo numtowords($get_total_amt);} ?>" disabled>
									</div>

									<div class="col-md-2">
									<label for="inputEmail3" class="control-label">Total Amount:</label>
									</div>

									<div class="col-md-3">
									<input type="text" name="total_amt" class="form-control" id="total_amt" value="<?php if($get_total_amount !=""){ echo $get_total_amount;}else{ echo $get_total_amt;} ?>" disabled>
									</div>
								</div>
								<br>
							<input type="hidden" name="hidden_agency" id="hidden_agency" value="<?php echo $get_agency_id;?>">
								<div class="row">
									<div class="col-md-3">&nbsp;</div>
									<div class="col-md-6">
									<!--<button type="button" class="btn btn-info"  onclick="addData('add_estimate')" name="btn_add_data" id="btn_add_data" style="width:100px;font-size:20px;" >Save</button>-->

									<button type="button" class="btn btn-info"  onclick="addData('save_rate_by_test_direct_perfoma')" name="btn_add_data" id="btn_add_data" style="width:150px;font-size:20px;" >Save</button>

									<a href="matt_invoice_bill_by_test_direct_perfoma_print.php?perfoma_no=<?php echo $perfoma_nos;?>" class="btn btn-info" title="" target="_blank" style="width:150px;font-size:20px;"><span class="glyphicon glyphicon-question-list"></span> Print</a>

									<!--<button type="button" class="btn btn-info"  onclick="addData('save_next_estimate')" name="btn_add_data" id="btn_add_data" style="width:150px;font-size:20px;" >Next</button>-->
									</div>
									<div class="col-md-3">&nbsp;</div>

								</div>
							</div>



							</div>

					</div>
				</div>
</section>
</div>

<div class="modal fade" id="modal-agency">
          <div class="modal-dialog" style="width:80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Agency</h4>
              </div>
				<form id="form_agency" name="form_agency" method="post">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
									<div class="col-md-6">
											<input type="text" class="form-control" PlaceHolder="Enter Agency Name." name="agency_name" id="add_agency_name" required >
										</div>

										<div class="col-md-6">
											<input type="text" class="form-control"  PlaceHolder="Enter Agency Mobile No." name="agency_mobile" id="add_agency_mobile" required >
										</div>
									</div>
												<br>
												<div class="row">
												<div class="col-md-6">
													<textarea name="add_agency_address" placeholder="Enter Agency Address." id="add_agency_address" class="col-sm-12 form-control"required ></textarea>
												</div>

												<div class="col-md-6">
													<select class="form-control col-sm-12" placeholder="Select City" tabindex="6"   id="add_sel_agency_city" name="sel_agency_city" required >
													<option value="">Select City</option>
													<?php
													$sql = "select * from city";

													$result = mysqli_query($conn, $sql);

														while($row = mysqli_fetch_assoc($result)) {

													?>
													<option value="<?php echo $row['id']; ?>">
													<?php echo $row['city_name']; ?></option>
													<?php  }?>
													</select>

												</div>
												</div>
												<br>
												<div class="row">
												<div class="col-md-6">
													<input type="text" class="form-control" placeholder="Enter Agency Pincode" name="add_agency_pincode" id="add_agency_pincode" required >
												</div>

												<div class="col-md-6">
													<input type="text" class="form-control" placeholder="Enter Agency EmailId" name="add_agency_email" id="add_agency_email" required >
												</div>
												</div>
												<br>
												<div class="row">
												<div class="col-md-6">
													<input type="text" class="form-control" placeholder="Enter Agency GST No." name="add_agency_gstno" id="add_agency_gstno" required >
												</div>

												<div class="col-md-6">
													<select class="form-control col-md-7 col-xs-12" name="add_agency_status" id="add_agency_status">
														<option  value="0">Activate</option>
														<option value="1">Deactivate</option>
													<select>
												</div>
												</div>


											</div>
					</div>
					<div class="modal-footer">

						<button type="button" class="btn btn-primary" id="btn_add_agency" name="btn_add_agency" data-dismiss="modal">Add Agency</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>

<?php include("footer.php");?>

<?php
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
  return $result . "Rupees  ";
}
?>
<script>
$(document).ready(function(){
	$('#invoice_date').datepicker({
		  autoclose: true,
		  format: 'dd/mm/yyyy',
		  endDate: '-1d'
	});

	var plus_total_amount=0;
	$(".class_amnt").each(function(){
			plus_total_amount +=parseInt($(this).val());
		});
	$("#txt_sub_total").val(plus_total_amount);
	var txt_discount_amount= $("#txt_discount_amount").val();
	var set_grand_total= parseInt(plus_total_amount)- parseInt(txt_discount_amount);
	$("#txt_grand").val(set_grand_total);

});

$(document).on("blur","#txt_discount_percent",function(){

	var txt_discount_percent= $("#txt_discount_percent").val();
	var txt_sub_total= $("#txt_sub_total").val();
	var discount_amounts= parseInt(txt_sub_total)*parseInt(txt_discount_percent)/100;
	var set_grand_total= parseInt(txt_sub_total)- parseInt(discount_amounts);
	$("#txt_discount_amount").val(discount_amounts);
	$("#txt_grand").val(set_grand_total);
	$('input[name=in_or_ex]').prop("checked", false);
	$('input[name=gst_type]').prop("checked", false);

});



// on rate change

$("#select_rate").change(function(){
      var select_rate = $('#select_rate').val();
       var test_id_array=[];
       var test_ids_id_array=[];
       var test_total_amnt_array=[];
		$(".class_test_id").each(function ()
		{
			test_id_array.push($(this).val());
			var get_id=$(this).attr("id");
			var split_data=get_id.split("_");
			var get_rates_id= "#rate_"+split_data[1];
			var get_total_id= "#amt_"+split_data[1];
			test_ids_id_array.push(get_rates_id);
			test_total_amnt_array.push(get_total_id);
		});

		var test_qty_array=[];
		$(".class_qty").each(function () {
		test_qty_array.push($(this).val());
		});

	  if(select_rate != ""){
      var postData = 'action_type=get_data_by_rate&select_rate='+select_rate+'&test_id_array='+test_id_array+'&test_qty_array='+test_qty_array;
	  }else{
		  alert("Select Rate First");
		  return false;
	  }

			$.ajax({
				url : "<?php $base_url; ?>save_span_set_rate_for_test_direct_perfoma.php",
				type: "POST",
				data : postData,
				dataType:'JSON',
				success: function(data)
				 {
					var get_test_rates_array=data.test_wise_rate_array;
					var get_test_total_array=data.test_wise_total_array;

					for(var i=0; i < get_test_rates_array.length; i++)
					{
						$(test_ids_id_array[i]).val(get_test_rates_array[i]);
						$(test_total_amnt_array[i]).val(get_test_total_array[i]);


					}
					$('input[name=in_or_ex]').prop("checked", false);
					$('input[name=gst_type]').prop("checked", false);
					$('#hidden_gst_in_ex').val("");
					$('#hidden_gst_type').val("");

					var plus_total_amount=0;
					$(".class_amnt").each(function(){
						plus_total_amount +=parseInt($(this).val());
					});
					$("#txt_sub_total").val(plus_total_amount);
					$("#txt_discount_percent").val("0");
					$("#txt_discount_amount").val("0");
					$("#txt_grand").val(plus_total_amount);
				 }
			});
});





function get_table_after_update(id){
    id = (typeof id == "undefined")?'':id;
    var billData = '';

	billData = '&action_type=get_table_after_update&id='+id;

    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_set_rate_for_test_direct_perfoma.php',
        data: billData,
		dataType:'JSON',
        success:function(msg){
          //$('#display_data').html(msg.table_design);
          $('#txt_cgst').val(msg.cgst);
          $('#txt_sgst').val(msg.sgst);
          $('#txt_igst').val(msg.igst);
          $('#txt_grand').val(msg.grand_total);
          $('#txt_amt_in_word').val(msg.get_total_amt_in_word);
          $('#total_amt').val(Math.round(msg.net_total));

        }
    });
}

// on rate change

$(document).on("blur",".txt_rate_class",function(){

      var get_rate = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_qty= $("#qty_"+split_data[1]).val();
	  var txt_amnts=parseInt(get_rate)* parseInt(get_qty);

	  $("#amt_"+split_data[1]).val(txt_amnts);
	  $('input[name=in_or_ex]').prop("checked", false);
	  $('#hidden_gst_in_ex').val("");

	  var gst_type=$( 'input[name=gst_type]:checked' ).val();
	  $('input[name=in_or_ex]').prop("checked", false);
		if(gst_type=="with_gst"){
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_gst");
			$('#hidden_gst_in_ex').val("");
		}else if(gst_type=="with_igst"){
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_igst");
			$('#hidden_gst_in_ex').val("");
		}else{
			$("#gst_hide_show").hide();
			$('#hidden_gst_type').val("without_gst");
			$('#hidden_gst_in_ex').val("");
		}

			var plus_total_amount=0;
			$(".class_amnt").each(function(){
				plus_total_amount +=parseInt($(this).val());
			});
			    $("#txt_sub_total").val(plus_total_amount);
				$("#txt_discount_percent").val("0");
				$("#txt_discount_amount").val("0");
				$("#txt_grand").val(plus_total_amount);
});

// on qty change

$(document).on("blur",".class_qty",function(){

      var get_qty = $(this).val();
      var get_id = $( this ).attr( "id" );
	  var split_data=get_id.split("_");
	  var get_rate= $("#rate_"+split_data[1]).val();
	  var txt_amnts=parseInt(get_rate)* parseInt(get_qty);

	  $("#amt_"+split_data[1]).val(txt_amnts);
	  $('input[name=in_or_ex]').prop("checked", false);
	  $('#hidden_gst_in_ex').val("");

	  var gst_type=$( 'input[name=gst_type]:checked' ).val();
	  $('input[name=in_or_ex]').prop("checked", false);

		if(gst_type=="with_gst"){
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_gst");
			$('#hidden_gst_in_ex').val("");
		}else if(gst_type=="with_igst"){
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_igst");
			$('#hidden_gst_in_ex').val("");
		}else{
			$("#gst_hide_show").hide();
			$('#hidden_gst_type').val("without_gst");
			$('#hidden_gst_in_ex').val("");
		}

		var plus_total_amount=0;
				$(".class_amnt").each(function(){
						plus_total_amount +=parseInt($(this).val());
					});
				$("#txt_sub_total").val(plus_total_amount);
				$("#txt_discount_percent").val("0");
				$("#txt_discount_amount").val("0");
				$("#txt_grand").val(plus_total_amount);
});

$("input[name='gst_type']").change(
    function(e)
    {
		var gst_type=$( 'input[name=gst_type]:checked' ).val();
		$('input[name=in_or_ex]').prop("checked", false);
		var in_or_ex="";
		if(gst_type=="with_gst"){
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_gst");
			$('#hidden_gst_in_ex').val("");
		}else if(gst_type=="with_igst"){
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_igst");
			$('#hidden_gst_in_ex').val("");
		}else{
			$("#gst_hide_show").hide();
			$('#hidden_gst_type').val("without_gst");
			$('#hidden_gst_in_ex').val("");
		}

		var txt_sub_total= $("#txt_sub_total").val();
		var txt_discount_amount=$("#txt_discount_amount").val();
		var all_material_amt= parseInt(txt_sub_total)- parseInt(txt_discount_amount);

		billData = '&action_type=set_c_s_and_amt&&all_material_amt='+all_material_amt+'&gst_type='+gst_type+'&in_or_ex='+in_or_ex;

		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_set_rate_for_test_direct_perfoma.php',
			data: billData,
			dataType:'JSON',
			success:function(msg){

			  $('#txt_cgst').val(msg.cgst);
			  $('#txt_sgst').val(msg.sgst);
			  $('#txt_igst').val(msg.igst);
			  $('#txt_grand').val(msg.grand_total);
			  $('#txt_amt_in_word').val(msg.get_total_amt_in_word);
			  $('#total_amt').val(Math.round(msg.net_total));

			}
		});

});

$("input[name='txt_bill_to']").change(
    function(e)
    {
		var txt_bill_to=$( 'input[name=txt_bill_to]:checked' ).val();
		if(txt_bill_to=="2"){
			$("#bill_to_hide_show").show();
			$("#other_customer_name").val("");
			$("#other_customer_address").val("");
			$("#other_customer_gst_no").val("");
		}else{
			$("#bill_to_hide_show").hide();
		}
});

$("input[name='in_or_ex']").change(
    function(e)
    {
		var gst_type=$( 'input[name=gst_type]:checked' ).val();
		var in_or_ex=$( 'input[name=in_or_ex]:checked' ).val();
		var txt_trf_no="";
		var txt_job_no="";
		$('#hidden_gst_in_ex').val(in_or_ex);

		var txt_sub_total= $("#txt_sub_total").val();
		var txt_discount_amount=$("#txt_discount_amount").val();
		var all_material_amt= parseInt(txt_sub_total)- parseInt(txt_discount_amount);

					var send= "0"+"|"+txt_trf_no+"|"+txt_job_no+"|"+gst_type+"|"+in_or_ex+"|"+all_material_amt;
					get_table_after_update(send);

});
// save estimate_date

function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_estimate' || 'save_next_estimate' || 'save_rate_by_test_direct_perfoma') {
				var txt_trf_no = "";
				var txt_job_no = "";
				var txt_invoice_no = "";
				var invoice_date = $('#invoice_date').val();
				var gst_no = $('#gst_no').val();
				var select_rate = $('#select_rate').val();
				var hidden_gst_type = $('#hidden_gst_type').val();
				var hidden_gst_in_ex = $('#hidden_gst_in_ex').val();
				var txt_cgst = $('#txt_cgst').val();
				var txt_sgst = $('#txt_sgst').val();
				var txt_igst = $('#txt_igst').val();
				var txt_grand = $('#txt_grand').val();
				var txt_amt_in_word = $('#txt_amt_in_word').val();
				var total_amt = $('#total_amt').val();
				var bill_no = $('#bill_no').val();
				var hsn_codes = $('#hsn_codes').val();
				var txt_sub_total = $('#txt_sub_total').val();
				var txt_discount_percent = $('#txt_discount_percent').val();
				var txt_discount_amount = $('#txt_discount_amount').val();
				var txt_bill_to=$( 'input[name=txt_bill_to]:checked' ).val();
				var other_customer_name = $('#other_customer_name').val();
				var other_customer_address = $('#other_customer_address').val();
				var other_customer_gst_no = $('#other_customer_gst_no').val();
				var hidden_perfoma_nos = $('#hidden_perfoma_nos').val();

				var test_ids_array=[];
				$(".class_test_id").each(function () {
					test_ids_array.push($(this).val());
				});

				var test_name_array=[];
				$(".class_test").each(function () {
					test_name_array.push($(this).val());
				});

				var test_qty_array=[];
				$(".class_qty").each(function () {
					test_qty_array.push($(this).val());
				});

				var test_rates_array=[];
				$(".txt_rate_class").each(function () {
					test_rates_array.push($(this).val());
				});

				var test_amnt_array=[];
				$(".class_amnt").each(function () {
					test_amnt_array.push($(this).val());
				});

				var test_mate_array=[];
				$(".class_mate_name").each(function () {
					test_mate_array.push($(this).val());
				});

				var test_mate_id_array=[];
				$(".class_mate_id").each(function () {
					test_mate_id_array.push($(this).val());
				});

				var customer_name= $("#customer_name").val();
				var hidden_agency= $("#select_agency").val();
				var name_of_work= $("#name_of_work").val();
				var agreement_no= $("#agreement_no").val();
				var reference_no= $("#reference_no").val();

				billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&txt_invoice_no='+txt_invoice_no+'&invoice_date='+invoice_date+'&select_rate='+select_rate+'&hidden_gst_type='+hidden_gst_type+'&txt_cgst='+txt_cgst+'&txt_sgst='+txt_sgst+'&txt_igst='+txt_igst+'&txt_grand='+txt_grand+'&txt_amt_in_word='+txt_amt_in_word+'&total_amt='+total_amt+'&hidden_agency='+hidden_agency+'&gst_no='+gst_no+'&test_ids_array='+test_ids_array+'&test_name_array='+test_name_array+'&test_qty_array='+test_qty_array+'&test_rates_array='+test_rates_array+'&test_amnt_array='+test_amnt_array+'&hidden_gst_in_ex='+hidden_gst_in_ex+'&hsn_codes='+hsn_codes+'&bill_no='+bill_no+'&txt_sub_total='+txt_sub_total+'&txt_discount_percent='+txt_discount_percent+'&txt_discount_amount='+txt_discount_amount+'&txt_bill_to='+txt_bill_to+'&test_mate_array='+test_mate_array+'&test_mate_id_array='+test_mate_id_array+'&hidden_perfoma_nos='+hidden_perfoma_nos+'&customer_name='+customer_name+'&name_of_work='+name_of_work+'&agreement_no='+agreement_no+'&reference_no='+reference_no+'&other_customer_name='+other_customer_name+'&other_customer_address='+other_customer_address+'&other_customer_gst_no='+other_customer_gst_no;

    }else{


				billData = 'action_type='+type+'&id='+id;

    }
		var gst_no = $('#gst_no').val();
		var hidden_gst_type = $('#hidden_gst_type').val();

		if(invoice_date=="")
		{
			alert("Please Select Invoice Date..");
			return false;
		}
		if(hidden_gst_type=="")
		{
			alert("Please Select Gst..");
			return false;
		}
		if(select_rate=="")
		{
			alert("Please Select Rate Type");
			return false;
		}

		if(hidden_gst_type !="without_gst")
		{
			if(hidden_gst_in_ex==""){

				alert("Please Select Include Or Exclude..");
			}
			else if(gst_no==null || gst_no=="")
			{
				alert("GST No. Require..");
			}
			else
			{
					$.ajax({
				type: 'POST',
				url: '<?php $base_url; ?>save_span_set_rate_for_test_direct_perfoma.php',
				data: billData,
				success:function(msg){
					if(type=="save_next_estimate"){
					window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?a=eng&&trf_no="+txt_trf_no+"&&job_no="+txt_job_no;

					}else if(type=="save_rate_by_test_direct_perfoma"){
					alert("Successfully Saved..");
					window.location.href="<?php echo $base_url; ?>span_set_rate_only_by_test_of_direct_perfoma.php?perfoma_no="+hidden_perfoma_nos;

					}else{
					window.location.href="<?php echo $base_url; ?>perfoma_list_rec_two.php?a=rec2";
					}
					}
					 });
			}
		}
		else
		{
			 $.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_set_rate_for_test_direct_perfoma.php',
			data: billData,
			success:function(msg){
				if(type=="save_next_estimate"){
					window.location.href="<?php echo $base_url; ?>view_job_by_eng.php?a=eng&&trf_no="+txt_trf_no+"&&job_no="+txt_job_no;

					}else if(type=="save_rate_by_test_direct_perfoma"){
					alert("Successfully Saved..");
					window.location.href="<?php echo $base_url; ?>span_set_rate_only_by_test_of_direct_perfoma.php?perfoma_no="+hidden_perfoma_nos;

					}else{
					window.location.href="<?php echo $base_url; ?>perfoma_list_rec_two.php?a=rec2";
					}
			}
				 });



		}


}

$("#btn_add_agency").click(function(){
 var agency_name = $('#add_agency_name').val();
 var agency_mobile = $('#add_agency_mobile').val();
 var agency_address = $('#add_agency_address').val();
 var sel_agency_city = $('#add_sel_agency_city').val();
 var agency_pincode = $('#add_agency_pincode').val();
 var agency_email = $('#add_agency_email').val();
 var agency_gstno = $('#add_agency_gstno').val();
 var agency_status = $('#add_agency_status').val();
 var postData = '&agency_name='+agency_name+'&agency_mobile='+agency_mobile+'&agency_address='+agency_address+'&sel_agency_city='+sel_agency_city+'&agency_pincode='+agency_pincode+'&agency_email='+agency_email+'&agency_gstno='+agency_gstno+'&agency_status='+agency_status;

	if(agency_name!=""){
	  $.ajax({
		url : "<?php $base_url; ?>agency_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {

			$("#select_agency").html(data);
		   $('#txt_new_agency').val("");
		   $( '#form_agency' ).each(function(){
				this.reset();
			});
		 }

	});
}else{
	alert("All Fields Are Required..");
	return false;
}
});
</script>
