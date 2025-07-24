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



$chk_array = $_GET["chk_array"];
$explode_chk_array = explode(",", $chk_array);

$temporary_trf_no_array = $_GET["temporary_trf_no"];
$explode_temporary_trf_no = explode(",", $temporary_trf_no_array);

$txt_trf_no = $explode_chk_array[0];
$temporary_trf_no = $explode_temporary_trf_no[0];
$txt_jobs = $_GET["job_no"];

// to get job for agency id
$sel_job = "select * from job where `trf_no`='$txt_trf_no' AND `temporary_trf_no`='$temporary_trf_no'";
$query_job = mysqli_query($conn_of_non, $sel_job);
$result_job = mysqli_fetch_array($query_job);
$get_agency_id = $result_job["agency"];



// get_estimate if available
$sel_estiamte = "select * from estimate_total_span_only_for_estimate where `trf_no`='$chk_array' AND `job_no`='$chk_array' AND `nabl_type`='non_nabl' AND `temporary_trf_no`='$temporary_trf_no_array'";

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

	$sel_perfoma = "select * from estimate_total_span where `trf_no`='$_GET[chk_array]' AND `job_no`='$_GET[chk_array]'  AND `est_isdeleted`=0 AND `nabl_type`='non_nabl' AND `temporary_trf_no`='$_GET[temporary_trf_no]'";
	$perfoma_query = mysqli_query($conn, $sel_perfoma);
	$get_perfoma = mysqli_fetch_array($perfoma_query);
	$perfoma_no = $get_perfoma["perfoma_no"];

	$set_material_id_array = array();
	$set_material_name_array = array();
	$set_material_qty_array = array();
	$set_material_rate_array = array();


	foreach ($explode_chk_array as $keys => $one_chk_arrays) {
		$sel_test_mater = "select *,`final_material_id`,count(final_material_id) as get_count from test_wise_material_rate where `trf_no`='$one_chk_arrays' AND `job_no`='$one_chk_arrays'  AND `is_deleted`=0 AND `temporary_trf_no`='$explode_temporary_trf_no[$keys]' GROUP BY final_material_id";


		$perfoma_query = mysqli_query($conn_of_non, $sel_test_mater);

		if (mysqli_num_rows($perfoma_query) > 0) {
			while ($one_perfoma = mysqli_fetch_array($perfoma_query)) {
				$material_cat_id = $one_perfoma["material_cat_id"];
				$sel_mat_cat = "select `material_cat_name` from material_category where `material_cat_id`=" . $material_cat_id;
				$cat_query = mysqli_query($conn_of_non, $sel_mat_cat);
				$one_cat_query = mysqli_fetch_array($cat_query);
				$material_cat_name = $one_cat_query["material_cat_name"];

				$material_id = $one_perfoma["material_id"];
				$sel_mat_id = "select `rate_private` from material where `id`=" . $material_id;
				$smat_id_query = mysqli_query($conn_of_non, $sel_mat_id);
				$one_mat_id = mysqli_fetch_array($smat_id_query);
				$material_rates = $one_mat_id["rate_private"];

				if (!in_array($material_cat_id, $set_material_id_array)) {
					array_push($set_material_id_array, $material_cat_id);
					array_push($set_material_name_array, $material_cat_name);
					array_push($set_material_qty_array, $one_perfoma["qty"]);
					array_push($set_material_rate_array, $material_rates);
				} else {
					$keys = array_search($material_cat_id, $set_material_id_array);
					$plus = intval($set_material_qty_array[$keys]) + intval($one_perfoma["qty"]);
					$set_material_qty_array[$keys] = $plus;
				}
			}
		}
	}
}

//get trf print also for biller view
$merge_upload_document = '';
foreach ($explode_chk_array as $keyeds => $one_chk_array) {
	$sel_jobs_doc = "select * from `job` where `trf_no`='$one_chk_array' AND `temporary_trf_no`='$explode_temporary_trf_no[$keyeds]'";
	$query_jobs_doc = mysqli_query($conn_of_non, $sel_jobs_doc);
	$result_jobs_doc = mysqli_fetch_array($query_jobs_doc);
	if ($result_jobs_doc["scan_document"] != "") {
		$merge_upload_document .= '<iframe src="' . $base_url . '../../mattest_n/non_nabl/scan_document/' . $result_jobs_doc["scan_document"] . '" style="height:1120px;width:1105px;"></iframe>';
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
							<div class="col-sm-3">
								<label for="inputEmail3" class="col-sm-2 control-label">S.R.F. No:</label>
							</div>

							<div class="col-sm-3">
								<label for="inputEmail3" class="col-sm-2 control-label">Job No:</label>
							</div>

							<div class="col-sm-3">
								<label for="inputEmail3" class="col-sm-2 control-label">Estimate Date:</label>
							</div>
						</div>
						<div class="row">

							<div class="col-sm-3">
								<input type="text" class="form-control" value="<?php echo $_GET['chk_array']; ?>" id="txt_trf_no" name="txt_trf_no" disabled>


								<input type="text" class="form-control" value="<?php echo $_GET['temporary_trf_no']; ?>" id="txt_temporary_trf_no" name="txt_temporary_trf_no" disabled>
							</div>



							<div class="col-sm-3">

								<input type="text" class="form-control" value="<?php echo $_GET['chk_array']; ?>" id="txt_job_no" name="txt_job_no" disabled>
							</div>

							<div class="col-md-3">
								<input type="text" class="form-control" name="invoice_date" id="invoice_date" value="<?php echo date('d/m/Y') ?>">

							</div>

						</div>

						<br>
						<div class="row">
							<div class="col-sm-2">
								<label for="inputEmail3" class="control-label">Bill To :</label>
							</div>
							<div class="col-sm-8">
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

							<div class="col-sm-2">
								<div class="form-group">
									<div class="col-sm-12">
										<a href="JavaScript:void(0)" class="put_iframe_in_modal btn btn-success" data-id='<?php echo $merge_upload_document; ?>' data-toggle='modal' data-target='#myModal' title='Add field'><b>VIEW UPLOADED DOCUMENT</b></a>


									</div>
								</div>
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
									<button type="button" class="btn btn-info" onclick="addData('add_estimate_only_for_estimate')" name="btn_add_data" id="btn_add_data" style="width:100px;font-size:20px;">Save</button>

									<a href="non_nabl_matt_estimate_print.php?chk_array=<?php echo $chk_array; ?>&&temporary_trf_no=<?php echo $temporary_trf_no_array ?>" class="btn btn-info" title="" target="_blank" style="width:150px;font-size:20px;"><span class="glyphicon glyphicon-question-list"></span> Print</a>
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

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" style="width: 100%;">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<div id="display_data_for_update" style="text-align:center;">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
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
			url: '<?php $base_url; ?>non_nabl_save_span_set_rate_for_estimate_merging.php',
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
			url: '<?php $base_url; ?>non_nabl_save_span_set_rate_for_estimate_merging.php',
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
			url: '<?php $base_url; ?>non_nabl_save_span_set_rate_for_estimate_merging.php',
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
			url: '<?php $base_url; ?>non_nabl_save_span_set_rate_for_estimate_merging.php',
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
			var txt_trf_no = $("#txt_trf_no").val();
			var txt_job_no = $("#txt_job_no").val();
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
		if (type == 'add_estimate_only_for_estimate') {
			var txt_trf_no = $('#txt_trf_no').val();
			var temporary_trf_no = $('#txt_temporary_trf_no').val();
			var txt_job_no = $('#txt_job_no').val();
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

			var hidden_agency = $('#hidden_agency').val();

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

			billData = '&action_type=' + type + '&id=' + id + '&txt_trf_no=' + txt_trf_no + '&txt_job_no=' + txt_job_no + '&invoice_date=' + invoice_date + '&hidden_gst_type=' + hidden_gst_type + '&txt_cgst=' + txt_cgst + '&txt_sgst=' + txt_sgst + '&txt_igst=' + txt_igst + '&txt_grand=' + txt_grand + '&txt_amt_in_word=' + txt_amt_in_word + '&total_amt=' + total_amt + '&hidden_agency=' + hidden_agency + '&all_material_id=' + all_material_id + '&all_material_name=' + all_material_name + '&all_material_qty=' + all_material_qty + '&all_material_rates=' + all_material_rates + '&all_material_amt=' + all_material_amt + '&hidden_gst_in_ex=' + hidden_gst_in_ex + '&all_hsn_codes=' + all_hsn_codes + '&txt_sub_total=' + txt_sub_total + '&txt_discount_percent=' + txt_discount_percent + '&txt_discount_amount=' + txt_discount_amount + '&txt_bill_to=' + txt_bill_to + '&notes=' + notes + '&hidden_perfoma_no=' + hidden_perfoma_no + '&other_customer_name=' + other_customer_name + '&other_customer_address=' + other_customer_address + '&other_customer_gst_no=' + other_customer_gst_no + '&temporary_trf_no=' + temporary_trf_no;

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
			url: '<?php $base_url; ?>non_nabl_save_span_set_rate_for_estimate_merging.php',
			data: billData,
			success: function(msg) {
				alert("Successfully Saved..");
				window.location.href = "<?php echo $base_url; ?>non_nabl_span_set_rate_only_for_estimate_merging.php?chk_array=" + txt_trf_no + "&&temporary_trf_no=" + temporary_trf_no;

			}
		});



	}

	$(document).on("click", ".put_iframe_in_modal", function() {
		var abc = $(this).attr('data-id');
		$('#display_data_for_update').html(abc);

	});
</script>