<?php include("header.php");
error_reporting(1); ?>
<?php
if ($_SESSION['name'] == "") {
?>
	<script>
		window.location.href = "<?php echo $base_url; ?>index.php";
	</script>
<?php
}



$perfoma_no = $_GET["perfoma_no"];
//$explode_chk_array=explode(",",$chk_array);

//$txt_trf_no= $explode_chk_array[0];
//$txt_jobs= $_GET["job_no"];  

// to get job for agency id
$sel_job = "select * from job where `trf_no`='$txt_trf_no'";
$query_job = mysqli_query($conn, $sel_job);
$result_job = mysqli_fetch_array($query_job);
$get_agency_id = $result_job["agency"];



// get_estimate if available
$sel_estiamte = "select * from estimate_total_span_only_for_estimate where `perfoma_no`='$perfoma_no'";

$estiamte_query = mysqli_query($conn, $sel_estiamte);
if (mysqli_num_rows($estiamte_query) > 0) {

	$get_estimate = mysqli_fetch_array($estiamte_query);
	$get_rate_type = $get_estimate["rate_type"];
	$get_gst_type = $get_estimate["gst_type"];
	$get_c_gst_amt = $get_estimate["c_gst_amt"];
	$get_s_gst_amt = $get_estimate["s_gst_amt"];
	$get_i_gst_amt = $get_estimate["i_gst_amt"];
	$get_grand_total = $get_estimate["grand_total"];
	$get_total_amount = $get_estimate["total_amt"];
	$get_total_amt_in_word = $get_estimate["total_amt_in_word"];

	$hsn_codes_array = $get_estimate["hsn_codes"];
	$material_array_ids = $get_estimate["all_material_id"];
	$material_array_name = $get_estimate["all_material_name"];
	$material_array_qty = $get_estimate["all_material_qty"];
	$material_array_rates = $get_estimate["all_material_rates"];
	$material_array_amt = $get_estimate["all_material_amt"];

	$gst_in_or_ex = $get_estimate["gst_in_or_ex"];
	$discount_amount = $get_estimate["discount_amount"];
	$discount_percent = $get_estimate["discount_percent"];
	$bill_to = $get_estimate["bill_to"];
	$other_customer_name = $get_estimate["other_customer_name"];
	$other_customer_address = $get_estimate["other_customer_address"];
	$other_customer_gst_no = $get_estimate["other_customer_gst_no"];
	$notes = $get_estimate["notes"];
	$perfoma_no = $get_estimate["perfoma_no"];
	$customer_name = $get_estimate["customer_name"];
	$name_of_work = $get_estimate["name_of_work"];
	$agreement_no = $get_estimate["agreement_no"];
	$reference_no = $get_estimate["reference_no"];
	$agency_id = $get_estimate["agency_id"];

	$explode_hsn_codes_array = explode(",", $hsn_codes_array);
	$explode_material_array_ids = explode(",", $material_array_ids);
	$explode_material_array_name = explode(",", $material_array_name);
	$explode_material_array_qty = explode(",", $material_array_qty);
	$explode_material_array_rates = explode(",", $material_array_rates);
	$explode_material_array_amt = explode(",", $material_array_amt);
} else {
	$get_rate_type = "";
	$get_gst_type = "";
	$get_c_gst_amt = "";
	$get_s_gst_amt = "";
	$get_i_gst_amt = "";
	$get_grand_total = "";
	$get_total_amount = "";
	$get_total_amt_in_word = "";
	$gst_in_or_ex = "";
	$discount_amount = "0";
	$discount_percent = "0";
	$bill_to = "0";
	$other_customer_name = "";
	$other_customer_address = "";
	$other_customer_gst_no = "";
	$notes = "";

	$sel_perfoma = "select * from estimate_total_span where `perfoma_no`='$_GET[perfoma_no]' AND `est_isdeleted`=0";
	$perfoma_query = mysqli_query($conn, $sel_perfoma);
	if (mysqli_num_rows($perfoma_query) > 0) {
		$get_perfoma = mysqli_fetch_array($perfoma_query);

		$get_material_id_array = explode(",", $get_perfoma["mat_ids"]);
		$get_material_name_array = explode(",", $get_perfoma["mate_name"]);
		$get_test_id = explode(",", $get_perfoma["test_ids"]);
		$get_material_qty = explode(",", $get_perfoma["test_qty"]);
		$get_material_rate_array = explode(",", $get_perfoma["test_rates"]);
		$perfoma_no = $get_perfoma["perfoma_no"];
		$customer_name = $get_perfoma["customer_name"];
		$name_of_work = $get_perfoma["name_of_work"];
		$agreement_no = $get_perfoma["agreement_no"];
		$reference_no = $get_perfoma["reference_no"];
		$agency_id = $get_perfoma["agency_id"];

		$set_material_id_array = array();
		$set_material_name_array = array();
		$set_material_qty_array = array();
		$set_material_rate_array = array();

		foreach ($get_material_id_array as $keying => $one_mate_id) {
			if (!in_array($one_mate_id, $set_material_id_array)) {
				$get_mat_ids = "select `material_id` from test_wise_material_rate where `material_cat_id`='$one_mate_id' AND `test_id`='$get_test_id[$keying]'";
				$mat_query = mysqli_query($conn, $get_mat_ids);
				$result_mat_id = mysqli_fetch_assoc($mat_query);

				$materials_id = $result_mat_id["material_id"];

				$sel_mat_id = "select `rate_private` from material where `id`=" . $materials_id;
				$smat_id_query = mysqli_query($conn, $sel_mat_id);
				$one_mat_id = mysqli_fetch_array($smat_id_query);
				$material_rates = $one_mat_id["rate_private"];

				array_push($set_material_id_array, $one_mate_id);
				array_push($set_material_name_array, $get_material_name_array[$keying]);
				array_push($set_material_qty_array, $get_material_qty[$keying]);
				array_push($set_material_rate_array, $material_rates);
			}
		}
	}
}


?>

<style>
	#billing label {
		display: block;
		text-align: center;
		line-height: 150%;
		font-size: .85em;
	}

	/* only for 3d button effects */

	.btn3d {
		transition: all .08s linear;
		position: relative;
		outline: medium none;
		-moz-outline-style: none;
		border: 0px;
		margin-right: 10px;
		margin-top: 15px;
	}

	.btn3d:focus {
		outline: medium none;
		-moz-outline-style: none;
	}

	.btn3d:active {
		top: 9px;
	}

	.btn-primary {
		box-shadow: 0 0 0 1px #428bca inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0, 0, 0, 0.4), 0 8px 8px 1px rgba(0, 0, 0, 0.5);
		background-color: #428bca;
	}

	.btn-success {
		box-shadow: 0 0 0 1px #5cb85c inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #4cae4c, 0 8px 0 1px rgba(0, 0, 0, 0.4), 0 8px 8px 1px rgba(0, 0, 0, 0.5);
		background-color: #5cb85c;
	}

	.btn-info {
		box-shadow: 0 0 0 1px #5bc0de inset, 0 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 8px 0 0 #46b8da, 0 8px 0 1px rgba(0, 0, 0, 0.4), 0 8px 8px 1px rgba(0, 0, 0, 0.5);
		background-color: #5bc0de;
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
		<div class="row main_breadcrumb">

			<h1 style="text-align:center;">
				Estimate
			</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">

					<div class="box-body" style="border:1px groove #ddd;">
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
								<select class="form-control  select2 col-sm-12" data-placeholder="Select Agency" tabindex="9" id="select_agency" name="select_agency" required>
									<option value="">Select Agency</option>
									<?php
									$cat_sql = "select * from agency_master where `isdeleted`=0";

									$cat_result = mysqli_query($conn, $cat_sql);

									while ($cat_row = mysqli_fetch_assoc($cat_result)) {

									?>
										<option value="<?php echo $cat_row['agency_id']; ?>" <?php if ($agency_id == $cat_row['agency_id']) {
																									echo "selected";
																								} ?>>
											<?php echo $cat_row['agency_name']; ?></option>
									<?php  } ?>
								</select>
							</div>
							<div class="col-sm-1">
								<input type="button" value="+" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-agency">

							</div>


							<div class="col-sm-2">

								<input type="text" class="form-control" value="<?php echo $agreement_no; ?>" id="agreement_no" name="agreement_no">
							</div>


							<div class="col-sm-3">

								<input type="text" class="form-control" value="<?php echo $reference_no; ?>" id="reference_no" name="reference_no">
							</div>

							<div class="col-md-3">
								<input type="text" class="form-control" name="invoice_date" id="invoice_date" value="<?php echo date('d/m/Y') ?>">

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
								<input type="text" class="form-control" value="<?php echo $customer_name; ?>" id="customer_name" name="customer_name">
							</div>


						</div>
						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="inputEmail3" class="control-label">Bill To :</label>
							</div>
							<div class="col-sm-5">
								<input type="radio" style="width:33px;height:25px;" name="txt_bill_to" value="0" <?php if ($bill_to == "0") {
																														echo "checked";
																													} ?>><span style="font-size:20px;"><b>Agency</b></span>
								<input type="radio" style="width:33px;height:25px;" name="txt_bill_to" value="1" <?php if ($bill_to == "1") {
																														echo "checked";
																													} ?>><span style="font-size:20px;"><b>Client<b></span>
								<input type="radio" style="width:33px;height:25px;" name="txt_bill_to" value="2" <?php if ($bill_to == "2") {
																														echo "checked";
																													} ?>><span style="font-size:20px;"><b>Other<b></span>
							</div>

						</div>
						<br>
						<div class="row" id="bill_to_hide_show" style="<?php if ($bill_to != "2") {
																			echo "display:none";
																		} else {
																			echo "display:block";
																		} ?>">


							<div class="col-md-1">
								<label for="inputEmail3" class="control-label">Customer Name:</label>
							</div>

							<div class="col-md-2">
								<input type="text" name="other_customer_name" class="form-control" id="other_customer_name" value="<?php echo $other_customer_name; ?>">
							</div>

							<div class="col-md-1">
								<label for="inputEmail3" class="control-label">Customer Address:</label>
							</div>

							<div class="col-md-2">
								<input type="text" name="other_customer_address" class="form-control" id="other_customer_address" value="<?php echo $other_customer_address; ?>">
							</div>

							<div class="col-md-1">
								<label for="inputEmail3" class="control-label">Customer GSt No:</label>
							</div>

							<div class="col-md-2">
								<input type="text" name="other_customer_gst_no" class="form-control" id="other_customer_gst_no" value="<?php echo $other_customer_gst_no; ?>">
							</div>



						</div>
						<br>
						<div class="panel-group">
							<div class="box box-info">
								<div class="box-body">
									<div class="table-responsive" id="display_data">
										<br>
										<hr>
										<table class="table no-margin">
											<thead>
												<tr>
													<th>SAC Code</th>
													<th>Material Name</th>
													<th>Qty</th>
													<th>Material Rate</th>
													<th>Total Amount</th>

												</tr>
											</thead>
											<tbody>

												<?php
												// if data available in estimate_total_span_only_for_material table
												if (!empty($explode_material_array_ids)) {
													foreach ($explode_material_array_ids as $mat_key => $one_explode_material_array_ids) {
												?>
														<tr>
															<td>

																<input type="text" name="material_hsn_codes[]" class="form-control class_hsn_codes" id="material_hsn_codes" value="<?php echo $explode_hsn_codes_array[$mat_key]; ?>">
															</td>
															<td>
																<input type="hidden" name="material_ids[]" class="form-control class_material_id" id="" value="<?php echo $one_explode_material_array_ids; ?>" disabled>
																<input type="text" name="material_names[]" class="form-control class_material_name" id="material_names" value="<?php echo $explode_material_array_name[$mat_key]; ?>">
															</td>
															<td>
																<input type="text" name="material_qty[]" class="form-control class_material_qty" id="material_qty" value="<?php echo $explode_material_array_qty[$mat_key]; ?>">
															</td>

															<td>
																<input type="text" name="material_rating[]" class="form-control class_material_rates" id="material_rating" value="<?php echo $explode_material_array_rates[$mat_key]; ?>">
															</td>
															<td>

																<?php
																// multification of qty and material_rate 
																$multi_of_qty_and_mate_rate = $get_material_qty[$mat_key] * $explode_material_array_rates[$mat_key];
																?>
																<input type="text" name="material_totals[]" class="form-control class_total_amt" id="material_totals_<?php echo $mat_key; ?>" value="<?php echo $explode_material_array_amt[$mat_key]; ?>" disabled>
															</td>
														</tr>
													<?php }
												} else {
													foreach ($set_material_id_array as $mat_key => $one_material) {


													?>
														<tr>
															<td>
																<input type="text" name="material_hsn_codes[]" class="form-control class_hsn_codes" id="material_hsn_codes" value=" ">
															</td>
															<td>
																<input type="hidden" name="material_ids[]" class="form-control class_material_id" id="" value="<?php echo $one_material; ?>" disabled>
																<input type="text" name="material_names[]" class="form-control class_material_name" id="material_names" value="<?php echo $set_material_name_array[$mat_key]; ?>">
															</td>
															<td>
																<input type="text" name="material_qty[]" class="form-control class_material_qty" id="material_qty" value="<?php echo $set_material_qty_array[$mat_key]; ?>">
															</td>

															<td>
																<input type="text" name="material_rating[]" class="form-control class_material_rates" id="material_rating" value="<?php echo $set_material_rate_array[$mat_key]; ?>">
															</td>
															<td>

																<?php
																// multification of qty and material_rate 
																$multi_of_qty_and_mate_rate = $set_material_qty_array[$mat_key] * $set_material_rate_array[$mat_key];
																?>
																<input type="text" name="material_totals[]" class="form-control class_total_amt" id="material_totals_<?php echo $mat_key; ?>" value="<?php echo $multi_of_qty_and_mate_rate; ?>" disabled>
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
									<input type="text" name="txt_discount_percent" class="form-control" id="txt_discount_percent" value="<?php echo $discount_percent; ?>">
								</div>
								<div class="col-sm-2"><label for="inputEmail3" class="control-label">Discount Amount:</label></div>
								<div class="col-sm-2">
									<input type="text" name="txt_discount_amount" class="form-control" id="txt_discount_amount" value="<?php echo $discount_amount; ?>">
								</div>
							</div>
							<br>
						</div>
						<div class="box box-info">
							<input type="hidden" name="hidden_gst_type" id="hidden_gst_type" value="<?php echo $get_gst_type; ?>">
							<input type="hidden" name="hidden_gst_in_ex" id="hidden_gst_in_ex" value="<?php echo $gst_in_or_ex; ?>">
							<input type="hidden" name="hidden_perfoma_no" id="hidden_perfoma_no" value="<?php echo $perfoma_no; ?>">
							<div class="row">
								<div class="col-sm-2">
									<label for="inputEmail3" class="control-label">GST TYPE:</label>
								</div>

								<div class="col-sm-9">
									<input type="radio" style="width:33px;height:25px;" name="gst_type" value="with_gst" <?php if ($get_gst_type == "with_gst") {
																																echo "checked";
																															} ?>><span style="font-size:20px;"><b>With GST</b></span>

									<input type="radio" style="width:33px;height:25px;" name="gst_type" value="without_gst" <?php if ($get_gst_type == "without_gst") {
																																echo "checked";
																															} ?>><span style="font-size:20px;"><b>Without GST<b></span>

									<input type="radio" style="width:33px;height:25px;" name="gst_type" value="with_igst" <?php if ($get_gst_type == "with_igst") {
																																echo "checked";
																															} ?>><span style="font-size:20px;"><b>With IGST<b></span>
								</div>
							</div>
							<br>
							<div class="row" id="gst_hide_show" style="<?php if ($get_gst_type == "" || $get_gst_type == "without_gst") {
																			echo "display:none";
																		} else {
																			echo "display:block";
																		} ?>">
								<div class="row">
									<div class="col-sm-2">
										<label for="inputEmail3" class="control-label">&nbsp;</label>
									</div>
									<div class="col-sm-9">
										<input type="radio" style="width:33px;height:25px;" name="in_or_ex" value="include" <?php if ($gst_in_or_ex == "include") {
																																echo "checked";
																															} ?>><span style="font-size:20px;"><b>Include</b></span>
										<input type="radio" style="width:33px;height:25px;" name="in_or_ex" value="exclude" <?php if ($gst_in_or_ex == "exclude") {
																																echo "checked";
																															} ?>><span style="font-size:20px;"><b>Exclude<b></span>
									</div>
								</div>
								<br>
								<div class="col-md-1">
									<label for="inputEmail3" class="control-label">CGST AMONUT:</label>
								</div>

								<div class="col-md-2">
									<input type="text" name="txt_cgst" class="form-control" id="txt_cgst" value="<?php echo $get_c_gst_amt; ?>" disabled>
								</div>

								<div class="col-md-1">
									<label for="inputEmail3" class="control-label">SGST AMONUT:</label>
								</div>

								<div class="col-md-2">
									<input type="text" name="txt_sgst" class="form-control" id="txt_sgst" value="<?php echo $get_s_gst_amt; ?>" disabled>
								</div>

								<div class="col-md-1">
									<label for="inputEmail3" class="control-label">IGST AMONUT:</label>
								</div>

								<div class="col-md-2">
									<input type="text" name="txt_igst" class="form-control" id="txt_igst" value="<?php echo $get_i_gst_amt; ?>" disabled>
								</div>

								<div class="col-md-1">
									<label for="inputEmail3" class="control-label">GRAND TOTAL:</label>
								</div>

								<div class="col-md-2">
									<input type="text" name="txt_grand" class="form-control" id="txt_grand" value="<?php if ($get_grand_total != "") {
																														echo $get_grand_total;
																													} else {
																														echo $get_total_amt;
																													} ?>" disabled>
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
									<input type="text" name="txt_amt_in_word" class="form-control" id="txt_amt_in_word" value="<?php if ($get_total_amt_in_word != "") {
																																	echo $get_total_amt_in_word;
																																} else {
																																	echo numtowords($get_total_amt);
																																} ?>" disabled>
								</div>

								<div class="col-md-2">
									<label for="inputEmail3" class="control-label">Total Amount:</label>
								</div>

								<div class="col-md-3">
									<input type="text" name="total_amt" class="form-control" id="total_amt" value="<?php if ($get_total_amount != "") {
																														echo $get_total_amount;
																													} else {
																														echo $get_total_amt;
																													} ?>" disabled>
								</div>
							</div>
							<br>
							<div class="row">

								<div class="col-md-3">
									<label for="inputEmail3" class="control-label">Notes:</label>
								</div>

								<div class="col-md-4">
									<textarea style="height:50px;width:100%;" name="notes" id="notes"><?php echo $notes; ?></textarea>
								</div>

							</div>
							<br>
							<input type="hidden" name="hidden_agency" id="hidden_agency" value="<?php echo $get_agency_id; ?>">
							<div class="row">
								<div class="col-md-3">&nbsp;</div>
								<div class="col-md-3">
									<button type="button" class="btn btn-info" onclick="addData('add_estimate_only_for_estimate_direct_perfoma')" name="btn_add_data" id="btn_add_data" style="width:100px;font-size:20px;">Save</button>

									<a href="matt_estimate_direct_perfoma_print.php?perfoma_no=<?php echo $perfoma_no; ?>" class="btn btn-info" title="" target="_blank" style="width:150px;font-size:20px;"><span class="glyphicon glyphicon-question-list"></span> Print</a>
									<br>
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
								<input type="text" class="form-control" PlaceHolder="Enter Agency Name." name="agency_name" id="add_agency_name" required>
							</div>

							<div class="col-md-6">
								<input type="text" class="form-control" PlaceHolder="Enter Agency Mobile No." name="agency_mobile" id="add_agency_mobile" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6">
								<textarea name="add_agency_address" placeholder="Enter Agency Address." id="add_agency_address" class="col-sm-12 form-control" required></textarea>
							</div>

							<div class="col-md-6">
								<select class="form-control col-sm-12" placeholder="Select City" tabindex="6" id="add_sel_agency_city" name="sel_agency_city" required>
									<option value="">Select City</option>
									<?php
									$sql = "select * from city";

									$result = mysqli_query($conn, $sql);

									while ($row = mysqli_fetch_assoc($result)) {

									?>
										<option value="<?php echo $row['id']; ?>">
											<?php echo $row['city_name']; ?></option>
									<?php  } ?>
								</select>

							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6">
								<input type="text" class="form-control" placeholder="Enter Agency Pincode" name="add_agency_pincode" id="add_agency_pincode" required>
							</div>

							<div class="col-md-6">
								<input type="text" class="form-control" placeholder="Enter Agency EmailId" name="add_agency_email" id="add_agency_email" required>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6">
								<input type="text" class="form-control" placeholder="Enter Agency GST No." name="add_agency_gstno" id="add_agency_gstno" required>
							</div>

							<div class="col-md-6">
								<select class="form-control col-md-7 col-xs-12" name="add_agency_status" id="add_agency_status">
									<option value="0">Activate</option>
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
<?php include("footer.php"); ?>

<?php
function numtowords($num)
{
	$number = $num;
	$no = round($number);
	$point = round($number - $no, 2) * 100;
	$hundred = null;
	$digits_1 = strlen($no);
	$i = 0;
	$str = array();
	$words = array(
		'0' => '', '1' => 'one', '2' => 'two',
		'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
		'7' => 'seven', '8' => 'eight', '9' => 'nine',
		'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
		'13' => 'thirteen', '14' => 'fourteen',
		'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
		'18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
		'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
		'60' => 'sixty', '70' => 'seventy',
		'80' => 'eighty', '90' => 'ninety'
	);
	$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
	while ($i < $digits_1) {
		$divider = ($i == 2) ? 10 : 100;
		$number = floor($no % $divider);
		$no = floor($no / $divider);
		$i += ($divider == 10) ? 1 : 2;
		if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str[] = ($number < 21) ? $words[$number] .
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
	$(document).ready(function() {
		var plus_total_amount = 0;
		$(".class_total_amt").each(function() {
			plus_total_amount += parseInt($(this).val());
		});
		$("#txt_sub_total").val(plus_total_amount);
		var txt_discount_amount = $("#txt_discount_amount").val();
		var set_grand_total = parseInt(plus_total_amount) - parseInt(txt_discount_amount);
		$("#txt_grand").val(set_grand_total);
	});

	// on qty change

	$(document).on("blur", "#txt_discount_percent", function() {

		var txt_discount_percent = $("#txt_discount_percent").val();
		var txt_sub_total = $("#txt_sub_total").val();
		var discount_amounts = parseInt(txt_sub_total) * parseInt(txt_discount_percent) / 100;
		var set_grand_total = parseInt(txt_sub_total) - parseInt(discount_amounts);
		$("#txt_discount_amount").val(discount_amounts);
		$("#txt_grand").val(set_grand_total);
		$('input[name=in_or_ex]').prop("checked", false);
		$('input[name=gst_type]').prop("checked", false);

	});

	$('#invoice_date').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	});

	// on rate change



	function get_table_after_update(id) {
		id = (typeof id == "undefined") ? '' : id;
		var billData = '';

		billData = '&action_type=get_table_after_update&id=' + id;

		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_set_rate_for_estimate_direct_perfoma.php',
			data: billData,
			dataType: 'JSON',
			success: function(msg) {
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

	$(document).on("blur", ".class_material_rates", function() {

		var gst_type = $('input[name=gst_type]:checked').val();
		$('input[name=in_or_ex]').prop("checked", false);
		if (gst_type == "with_gst") {
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_gst");
			$('#hidden_gst_in_ex').val("");
		} else if (gst_type == "with_igst") {
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_igst");
			$('#hidden_gst_in_ex').val("");
		} else {
			$("#gst_hide_show").hide();
			$('#hidden_gst_type').val("without_gst");
			$('#hidden_gst_in_ex').val("");
		}


		var all_material_qty = new Array();
		var all_material_rates = new Array();
		var all_material_amt = new Array();

		$(".class_material_qty").each(function() {
			all_material_qty.push($(this).val());
		});

		$(".class_material_rates").each(function() {
			all_material_rates.push($(this).val());
		});
		$(".class_total_amt").each(function() {
			all_material_amt.push($(this).val());
		});


		billData = '&action_type=set_c_s_and_amt_on_rate_change&all_material_qty=' + all_material_qty + '&all_material_rates=' + all_material_rates + '&all_material_amt=' + all_material_amt + '&gst_type=' + gst_type;

		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_set_rate_for_estimate_direct_perfoma.php',
			data: billData,
			dataType: 'JSON',
			success: function(msg) {

				$('#txt_cgst').val(msg.cgst);
				$('#txt_sgst').val(msg.sgst);
				$('#txt_igst').val(msg.igst);
				$('#txt_grand').val(msg.grand_total);
				$('#txt_amt_in_word').val(msg.get_total_amt_in_word);
				$('#total_amt').val(Math.round(msg.net_total));


				$.each(msg.push_amont, function(key, value) {
					var set_ids = "#material_totals_" + key;
					$(set_ids).val(value);
				});

				var plus_total_amount = 0;
				$(".class_total_amt").each(function() {
					plus_total_amount += parseInt($(this).val());
				});
				$("#txt_sub_total").val(plus_total_amount);
				$("#txt_discount_percent").val("0");
				$("#txt_discount_amount").val("0");
				$("#txt_grand").val(plus_total_amount);


			}
		});
	});


	// on qty change

	$(document).on("blur", ".class_material_qty", function() {

		var gst_type = $('input[name=gst_type]:checked').val();
		$('input[name=in_or_ex]').prop("checked", false);

		if (gst_type == "with_gst") {
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_gst");
			$('#hidden_gst_in_ex').val("");
		} else if (gst_type == "with_igst") {
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_igst");
			$('#hidden_gst_in_ex').val("");
		} else {
			$("#gst_hide_show").hide();
			$('#hidden_gst_type').val("without_gst");
			$('#hidden_gst_in_ex').val("");
		}


		var all_material_qty = new Array();
		var all_material_rates = new Array();
		var all_material_amt = new Array();

		$(".class_material_qty").each(function() {
			all_material_qty.push($(this).val());
		});

		$(".class_material_rates").each(function() {
			all_material_rates.push($(this).val());
		});
		$(".class_total_amt").each(function() {
			all_material_amt.push($(this).val());
		});


		billData = '&action_type=set_c_s_and_amt_on_rate_change&all_material_qty=' + all_material_qty + '&all_material_rates=' + all_material_rates + '&all_material_amt=' + all_material_amt + '&gst_type=' + gst_type;

		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_set_rate_for_estimate_direct_perfoma.php',
			data: billData,
			dataType: 'JSON',
			success: function(msg) {

				$('#txt_cgst').val(msg.cgst);
				$('#txt_sgst').val(msg.sgst);
				$('#txt_igst').val(msg.igst);
				$('#txt_grand').val(msg.grand_total);
				$('#txt_amt_in_word').val(msg.get_total_amt_in_word);
				$('#total_amt').val(Math.round(msg.net_total));


				$.each(msg.push_amont, function(key, value) {
					var set_ids = "#material_totals_" + key;
					$(set_ids).val(value);
				});


				var plus_total_amount = 0;
				$(".class_total_amt").each(function() {
					plus_total_amount += parseInt($(this).val());
				});
				$("#txt_sub_total").val(plus_total_amount);
				$("#txt_discount_percent").val("0");
				$("#txt_discount_amount").val("0");
				$("#txt_grand").val(plus_total_amount);

			}
		});
	});

	$("input[name='gst_type']").change(function(e) {
		var gst_type = $('input[name=gst_type]:checked').val();
		$('input[name=in_or_ex]').prop("checked", false);
		var in_or_ex = "";
		if (gst_type == "with_gst") {
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_gst");
			$('#hidden_gst_in_ex').val("");
		} else if (gst_type == "with_igst") {
			$("#gst_hide_show").show();
			$('#hidden_gst_type').val("with_igst");
			$('#hidden_gst_in_ex').val("");
		} else {
			$("#gst_hide_show").hide();
			$('#hidden_gst_type').val("without_gst");
			$('#hidden_gst_in_ex').val("");
		}


		var txt_sub_total = $("#txt_sub_total").val();
		var txt_discount_amount = $("#txt_discount_amount").val();
		var all_material_amt = parseInt(txt_sub_total) - parseInt(txt_discount_amount);

		billData = '&action_type=set_c_s_and_amt&&all_material_amt=' + all_material_amt + '&gst_type=' + gst_type + '&in_or_ex=' + in_or_ex;

		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_set_rate_for_estimate_direct_perfoma.php',
			data: billData,
			dataType: 'JSON',
			success: function(msg) {

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
		function(e) {
			var txt_bill_to = $('input[name=txt_bill_to]:checked').val();
			if (txt_bill_to == "2") {
				$("#bill_to_hide_show").show();
				$("#other_customer_name").val("");
				$("#other_customer_address").val("");
				$("#other_customer_gst_no").val("");
			} else {
				$("#bill_to_hide_show").hide();
			}
		});

	$("input[name='in_or_ex']").change(
		function(e) {
			var gst_type = $('input[name=gst_type]:checked').val();
			var in_or_ex = $('input[name=in_or_ex]:checked').val();
			var txt_trf_no = "";
			var txt_job_no = "";
			$('#hidden_gst_in_ex').val(in_or_ex);

			var txt_sub_total = $("#txt_sub_total").val();
			var txt_discount_amount = $("#txt_discount_amount").val();
			var all_material_amt = parseInt(txt_sub_total) - parseInt(txt_discount_amount);

			var send = "0" + "|" + txt_trf_no + "|" + txt_job_no + "|" + gst_type + "|" + in_or_ex + "|" + all_material_amt;
			get_table_after_update(send);

		});


	// save estimate_date

	function addData(type, id) {
		id = (typeof id == "undefined") ? '' : id;
		var statusArr = {
			add: "added",
			edit: "updated",
			delete: "deleted"
		};
		var billData = '';
		if (type == 'add_estimate_only_for_estimate_direct_perfoma') {
			var txt_trf_no = "";
			var txt_job_no = "";
			var invoice_date = $('#invoice_date').val();
			var hidden_gst_type = $('#hidden_gst_type').val();
			var txt_cgst = $('#txt_cgst').val();
			var txt_sgst = $('#txt_sgst').val();
			var txt_igst = $('#txt_igst').val();
			var txt_grand = $('#txt_grand').val();
			var txt_amt_in_word = $('#txt_amt_in_word').val();
			var total_amt = $('#total_amt').val();
			var hidden_gst_in_ex = $('#hidden_gst_in_ex').val();
			var txt_sub_total = $('#txt_sub_total').val();
			var txt_discount_percent = $('#txt_discount_percent').val();
			var txt_discount_amount = $('#txt_discount_amount').val();
			var txt_bill_to = $('input[name=txt_bill_to]:checked').val();
			var other_customer_name = $('#other_customer_name').val();
			var other_customer_address = $('#other_customer_address').val();
			var other_customer_gst_no = $('#other_customer_gst_no').val();
			var notes = $('#notes').val();
			var hidden_perfoma_no = $('#hidden_perfoma_no').val();

			var customer_name = $("#customer_name").val();
			var hidden_agency = $("#select_agency").val();
			var name_of_work = $("#name_of_work").val();
			var agreement_no = $("#agreement_no").val();
			var reference_no = $("#reference_no").val();

			var all_hsn_codes = new Array();
			var all_material_id = new Array();
			var all_material_name = new Array();
			var all_material_qty = new Array();
			var all_material_rates = new Array();
			var all_material_amt = new Array();

			$(".class_hsn_codes").each(function() {
				all_hsn_codes.push($(this).val());
			});
			$(".class_material_id").each(function() {
				all_material_id.push($(this).val());
			});
			$(".class_material_name").each(function() {
				all_material_name.push($(this).val());
			});
			$(".class_material_qty").each(function() {
				all_material_qty.push($(this).val());
			});

			$(".class_material_rates").each(function() {
				all_material_rates.push($(this).val());
			});
			$(".class_total_amt").each(function() {
				all_material_amt.push($(this).val());
			});

			billData = '&action_type=' + type + '&id=' + id + '&txt_trf_no=' + txt_trf_no + '&txt_job_no=' + txt_job_no + '&invoice_date=' + invoice_date + '&hidden_gst_type=' + hidden_gst_type + '&txt_cgst=' + txt_cgst + '&txt_sgst=' + txt_sgst + '&txt_igst=' + txt_igst + '&txt_grand=' + txt_grand + '&txt_amt_in_word=' + txt_amt_in_word + '&total_amt=' + total_amt + '&hidden_agency=' + hidden_agency + '&all_material_id=' + all_material_id + '&all_material_name=' + all_material_name + '&all_material_qty=' + all_material_qty + '&all_material_rates=' + all_material_rates + '&all_material_amt=' + all_material_amt + '&hidden_gst_in_ex=' + hidden_gst_in_ex + '&all_hsn_codes=' + all_hsn_codes + '&txt_sub_total=' + txt_sub_total + '&txt_discount_percent=' + txt_discount_percent + '&txt_discount_amount=' + txt_discount_amount + '&txt_bill_to=' + txt_bill_to + '&notes=' + notes + '&hidden_perfoma_no=' + hidden_perfoma_no + '&customer_name=' + customer_name + '&name_of_work=' + name_of_work + '&agreement_no=' + agreement_no + '&reference_no=' + reference_no + '&other_customer_name=' + other_customer_name + '&other_customer_address=' + other_customer_address + '&other_customer_gst_no=' + other_customer_gst_no;

		} else {


			billData = 'action_type=' + type + '&id=' + id;

		}

		var hidden_gst_type = $('#hidden_gst_type').val();

		if (hidden_gst_type == "") {
			alert("Please Select Gst..");
			return false;
		}

		if (hidden_gst_in_ex == "" && hidden_gst_type != "without_gst") {

			alert("Please Select Include Or Exclude..");
			return false;
		}
		if (hidden_gst_type == "without_gst") {
			hidden_gst_in_ex = "";

		}

		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_span_set_rate_for_estimate_direct_perfoma.php',
			data: billData,
			success: function(msg) {
				alert("Successfully Saved..");
				window.location.href = "<?php echo $base_url; ?>span_set_rate_only_for_estimate_direct_perfoma.php?perfoma_no=" + hidden_perfoma_no;

			}
		});
	}

	$("#btn_add_agency").click(function() {
		var agency_name = $('#add_agency_name').val();
		var agency_mobile = $('#add_agency_mobile').val();
		var agency_address = $('#add_agency_address').val();
		var sel_agency_city = $('#add_sel_agency_city').val();
		var agency_pincode = $('#add_agency_pincode').val();
		var agency_email = $('#add_agency_email').val();
		var agency_gstno = $('#add_agency_gstno').val();
		var agency_status = $('#add_agency_status').val();
		var postData = '&agency_name=' + agency_name + '&agency_mobile=' + agency_mobile + '&agency_address=' + agency_address + '&sel_agency_city=' + sel_agency_city + '&agency_pincode=' + agency_pincode + '&agency_email=' + agency_email + '&agency_gstno=' + agency_gstno + '&agency_status=' + agency_status;

		if (agency_name != "") {
			$.ajax({
				url: "<?php $base_url; ?>agency_Data.php",
				type: "POST",
				data: postData,
				success: function(data, status, xhr) {

					$("#select_agency").html(data);
					$('#txt_new_agency').val("");
					$('#form_agency').each(function() {
						this.reset();
					});
				}

			});
		} else {
			alert("All Fields Are Required..");
			return false;
		}
	});
</script>