<?php
session_start();
include("connection.php");
error_reporting(1);
?>
<?php
if ($_SESSION['name'] == "") {
?>
	<script>
		window.location.href = "<?php echo $base_url; ?>index.php";
	</script>
<?php
}
?>
<style>
	@page {
		margin: 0;
	}


	@media print {
		@page
	}

	.tdclass {
		border: 1px solid black;
		font-size: 11px;
		font-family: arial;
	}

	.test {
		border-collapse: collapse;
	}

	.tdclass1 {

		font-size: 11px;
		font-family: arial;
	}
</style>
<html>

<body>
	<?php
	// get estimate by report no and job no
	$get_trf_no = $_GET["trf_no"];
	$get_job_no = $_GET["job_no"];
	$sel_estiamte = "select * from estimate_total_span where `trf_no`='$get_trf_no' AND `job_no`='$get_job_no'";
	$result_estiamte = mysqli_query($conn, $sel_estiamte);
	$row_estiamte = mysqli_fetch_array($result_estiamte);


	// get name of agency by report no and job no from agency table
	$sel_agency_id = $row_estiamte["agency_id"];

	$sel_agency = "select * from agency_master where `agency_id`=" . $sel_agency_id;
	$result_agency = mysqli_query($conn, $sel_agency);
	$row_agency = mysqli_fetch_array($result_agency);
	$agency_name = $row_agency["agency_name"];
	$agency_address = $row_agency["agency_address"];
	$agency_gst = $row_agency["agency_gstno"];


	// get name of work from job by report no
	$sel_job = "select * from job where `trf_no`='$get_trf_no'";
	$result_job = mysqli_query($conn, $sel_job);
	$row_job = mysqli_fetch_array($result_job);
	$name_of_work = strip_tags(html_entity_decode($row_job["nameofwork"]), "<strong><em>");

	$get_report_to = $row_job["report_sent_to"];

	// set report  send to
	if ($get_report_to == "0") {

		$sel_city = "select * from city where `id`='$row_job[client_city]'";
		$result_city = mysqli_query($conn, $sel_city);
		$row_city = mysqli_fetch_array($result_city);

		$set_report_sent_to = $row_job["clientname"] . "" . $row_job["clientaddress"] . "," . $row_city["city_name"];
	} else {

		$sel_city = "select * from city where `id`='$row_agency[agency_city]'";
		$result_city = mysqli_query($conn, $sel_city);
		$row_city = mysqli_fetch_array($result_city);

		$set_report_sent_to = $agency_name . " " . $agency_address . "," . $row_city["city_name"];
	}


	//get from tax
	$sel_tax = "select * from tax";
	$result_tax = mysqli_query($conn, $sel_tax);
	$get_tax = mysqli_fetch_array($result_tax);

	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<br>
	<br>
	<br>


	<page size="A4">
		<table align="center" width="80%" class="test" border="1px" style="font-family: arial;">
			<tr>
				<td colspan="8">
					<b>PERFOMA INVOICE</b>
				</td>
			</tr>
			<tr>
				<td colspan="4" width="20%"><b>Billed To :</b>&nbsp;&nbsp;<?php echo $set_report_sent_to; ?></td>
				<td colspan="2" width="20%" style="text-align:right;"><b>Perfoma Invoice No </b></td>
				<td colspan="2" width="20%">&nbsp;:&nbsp;<?php echo $row_estiamte["estimate_no"]; ?></td>

			</tr>
			<tr>
				<td colspan="4" width="40%"></td>
				<td colspan="2" width="20%" style="text-align:right;"><b>Place of Supply </b></td>
				<td colspan="2" width="20%">&nbsp;:&nbsp;Gujarat (24)</td>
			</tr>
			<tr>
				<td colspan="4" width="40%"><b></b></td>
				<td colspan="2" width="20%" style="text-align:right;"><b>Date </b></td>
				<td colspan="2" width="20%">&nbsp;:&nbsp;<?php echo date('d-m-Y', strtotime($row_estiamte['estimate_date'])); ?></td>
			</tr>
			<tr>
				<td colspan="4" width="40%"></td>
				<td colspan="2" width="20%"></td>
				<td colspan="2" width="20%"></td>
			</tr>
			<tr>
				<td colspan="4" width="40%"><b>GST IN :&nbsp; <?php echo $agency_gst; ?></b></td>
				<td colspan="4" width="40%"></td>
			</tr>
			<tr>
				<td width="10%"><b>Subject :</b></td>
				<td colspan="7" width="70%"><b>Testing Bill of Material Supplied by You</b></td>
			</tr>
			<tr style="height: 60px;">
				<td width="10%"><b>Name of Work:</b></td>
				<td colspan="7" width="70%"><?php echo $name_of_work; ?></td>
			</tr>
		</table>
		<table align="center" width="80%" class="test" border="1px" style="font-family: arial;">

			<tr>
				<td width="11%"><b>
						SR NO.
					</b></td>
				<td colspan="3" width="28%"><b>
						ITEM
					</b></td>
				<td width="11%"><b>
						QUANTITY
					</b></td>
				<td width="11%"><b>
						RATE
					</b></td>
				<td width="7%"><b>
						PER
					</b></td>
				<td width="11%"><b>
						AMOUNT RS.
					</b></td>
			</tr>

			<?php
			$sel_test_wise_material_rate = "SELECT  material_category.material_cat_id,COUNT(*)as cnt FROM material_category, test_master, test_wise_material_rate WHERE test_wise_material_rate.test_id = test_master.test_id AND test_master.mat_category_id = material_category.material_cat_id AND test_wise_material_rate.trf_no ='$get_trf_no' AND test_wise_material_rate.job_no = '$get_job_no' GROUP BY  material_category.material_cat_id";
			$query_wise = mysqli_query($conn, $sel_test_wise_material_rate);


			if (mysqli_num_rows($query_wise) > 0) {
				$count_get = 1;
				while ($rows = mysqli_fetch_array($query_wise)) {
					$material_cat_id = $rows["material_cat_id"];


					// category name
					$sel_cate = "select * from material_category where `material_cat_id`=" . $material_cat_id;
					$query_cate = mysqli_query($conn, $sel_cate);
					$get_cate = mysqli_fetch_array($query_cate);

			?>

					<tr>
						<td width="11%"><b>
								<?php echo $count_get; ?>
							</b></td>
						<td colspan="3" width="28%"><b>Testing Charge of&nbsp; <?php echo $get_cate["material_cat_name"]; ?></b></td>
						<td width="11%">
							
						</td>
						<td width="11%">
							
						</td>
						<td width="7%">
							
						</td>
						<td width="11%">
							
						</td>
					</tr>
					<?php

					$material_test = "SELECT test_master.test_id,test_master.test_name,test_wise_material_rate.qty,test_wise_material_rate.rate,test_wise_material_rate.amt FROM material_category, test_master, test_wise_material_rate WHERE test_wise_material_rate.test_id = test_master.test_id AND test_master.mat_category_id = material_category.material_cat_id AND test_wise_material_rate.trf_no ='$get_trf_no' AND test_wise_material_rate.job_no = '$get_job_no' AND material_category.material_cat_id = '$material_cat_id'";

					$query_material_wise_test = mysqli_query($conn, $material_test);

					$check_array_for_steel_test = array();
					$check_array_for_steel_qty;
					$check_array_for_steel_rates;
					$check_array_for_steel_amount;
					if (mysqli_num_rows($query_material_wise_test) > 0) {

						while ($test_rows = mysqli_fetch_array($query_material_wise_test)) {

							if ($test_rows["test_id"] != "92" && $test_rows["test_id"] != "93" && $test_rows["test_id"] != "94") { ?>
								<tr>
									<td width="11%"><b>
											
										</b></td>
									<td colspan="3" width="28%"><?php echo $test_rows["test_name"]; ?> </td>
									<td width="11%">
										<?php echo $test_rows["qty"]; ?>
									</td>
									<td width="11%" style="text-align:right;"><?php echo number_format($test_rows["rate"], 2); ?></td>
									<td width="7%">
										No
									</td>
									<td width="11%" style="text-align:right;"><?php echo number_format($test_rows["amt"], 2); ?></td>
								</tr>
								<?php }

							$check_array_for_steel_qty = $test_rows['qty'];
							$check_array_for_steel_rates = $test_rows['rate'];
							$check_array_for_steel_amount = $test_rows['amt'];
							if ($test_rows["test_id"] == "92" || $test_rows["test_id"] == "93" || $test_rows["test_id"] == "94") {

								if ($row_estiamte["rate_type"] == "0") {
									array_push($check_array_for_steel_test, $test_rows["test_name"]);
								} else { ?>
									<tr>
										<td width="11%"><b>
												
											</b></td>
										<td colspan="3" width="28%"><?php echo $test_rows["test_name"]; ?> </td>
										<td width="11%">
											<?php echo $test_rows["qty"]; ?>
										</td>
										<td width="11%" style="text-align:right;"><?php echo number_format($test_rows["rate"], 2); ?></td>
										<td width="7%">
											No
										</td>
										<td width="11%" style="text-align:right;"><?php echo number_format($test_rows["amt"], 2); ?></td>
									</tr>
							<?php }
							}
						}

						if (!empty($check_array_for_steel_test)) { ?>
							<tr>
								<td width="11%"><b>
										
									</b></td>
								<td colspan="3" width="28%"><?php echo implode(",", $check_array_for_steel_test); ?> </td>
								<td width="11%">
									<?php echo $check_array_for_steel_qty; ?>
								</td>
								<td width="11%" style="text-align:right;"><?php echo number_format($check_array_for_steel_rates, 2); ?></td>
								<td width="7%">
									No
								</td>
								<td width="11%" style="text-align:right;"><?php echo number_format($check_array_for_steel_amount, 2); ?></td>
							</tr>

			<?php }
					}
					$count_get++;
				}
			} ?>

			<tr>
				<td width="11%"></td>
				<td colspan="3" width="28%"></td>
				<td width="11%">
					
				</td>
				<td width="11%">
					TOTAL
				</td>
				<td width="7%">
					RS
				</td>
				<td width="11%" style="text-align:right;"><?php echo number_format($row_estiamte["grand_total"], 2); ?></td>
			</tr>
			<tr>
				<td colspan="5" rowspan="2" width="44%"><b>Rs.&nbsp;<?php echo strtoupper($row_estiamte["total_amt_in_word"]); ?></b></td>
				<td colspan="2" width="22%">
					Grand Total
				</td>
				<td width="11%" style="text-align:right;"><?php echo number_format($row_estiamte["grand_total"], 2); ?></td>
			</tr>
			<tr>

				<td colspan="2" width="22%">
					<b>TOTAL</b>
				</td>
				<td width="11%" style="text-align:right;">&nbsp;<?php echo number_format($row_estiamte["total_amt"], 2); ?></td>
			</tr>

		</table>

		<table align="center" width="80%" class="test" border="1px" style="font-family: arial;">

			<tr>
				<td colspan="3" rowspan="6" width="40%"></td>
				<td colspan="2" width="22%"><b>GST Analysis</b></td>
				<td width="7%">
					
				</td>
				<td width="11%">
					
				</td>
			</tr>
			<tr>

				<td colspan="2" width="22%">Assesment Amt </td>
				<td width="7%">
					GST <?php echo $get_tax["tax_sgst"] + $get_tax["tax_cgst"]; ?>%
				</td>
				<td width="11%">
					Tax Amount
				</td>
			</tr>
			<tr>

				<td width="11%" style="text-align:right;"><?php echo number_format($row_estiamte["grand_total"], 2); ?></td>
				<td width="11%" style="text-align:right;">CGST</td>
				<td width="7%">
					<?php echo $get_tax["tax_cgst"]; ?>%
				</td>
				<td width="11%" style="text-align:right;"><?php echo number_format($row_estiamte["c_gst_amt"], 2); ?></td>
			</tr>
			<tr>

				<td width="11%"></td>
				<td width="11%" style="text-align:right;">SGST</td>
				<td width="7%">
					<?php echo $get_tax["tax_sgst"]; ?>%
				</td>
				<td width="11%" style="text-align:right;"><?php echo number_format($row_estiamte["s_gst_amt"], 2); ?></td>
			</tr>
			<tr>

				<td width="11%"></td>
				<td width="11%" style="text-align:right;">IGST</td>
				<td width="7%">
					<?php echo $get_tax["tax_igst"]; ?>%
				</td>
				<td width="11%" style="text-align:right;"><?php echo number_format($row_estiamte["i_gst_amt"], 2); ?></td>
			</tr>
			<tr>

				<td width="11%"></td>
				<td width="11%" style="text-align:right;">TOTAL</td>
				<td width="7%">
					<?php echo $get_tax["tax_sgst"] + $get_tax["tax_cgst"]; ?>%
				</td>
				<td width="11%" style="text-align:right;"><?php echo number_format($row_estiamte["s_gst_amt"] + $row_estiamte["c_gst_amt"] + $row_estiamte["i_gst_amt"], 2); ?></td>
			</tr>
			<tr>
				<td colspan="3" width="40%">For MATTEST ENGINEERING SERVICES </td>
				<td width="11%">Pan No :</td>
				<td width="11%"><?php echo $pancard_no; ?></td>
				<td width="7%">
					
				</td>
				<td width="11%">
					
				</td>
			</tr>
			<tr>
				<td colspan="3" width="40%">Material Testing and Consultancy Service</td>
				<td width="11%">GST IN :</td>
				<td width="11%"><?php echo $gst_no; ?></td>
				<td width="7%">
					
				</td>
				<td width="11%">
					
				</td>
			</tr>
			<tr>
				<td colspan="8" width="40%">Note:&nbsp;
					<span id="span_notes">
						<input type="text" name="txt_notes" id="txt_notes" style="width:100%;height:40px;" value="Testing Charge must be paid to only MATTEST ENGINEERING SERVICES.">
						</textarea>
					</span>
					<br>

				</td>

			</tr>
			<tr>
				<td colspan="8" width="40%" height="100px;">
					<span id="span_auth_address">
						<textarea name="txt_auth_address" id="txt_auth_address" style="width:100%;height:200px;">
						<strong>RTGS BANK A/C DETAIL</strong><br>
						BANK NAME :- State Bank Of India<br>
						A/C Name  :- <br>
						Branch    :- <br>
						A/C No.   :- <br>
						IFSC CODE :- <br>
						Pan No    :- <br>
						GSTIN     :- <br>
						</textarea>
					</span>
				</td>

			</tr>
		</table>
		<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">
	</page>
</body>

</html>
<script src="bower_components/ckeditor/ckeditor.js"></script>
<script>
	$(function() {
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace('txt_auth_address')
		//bootstrap WYSIHTML5 - text editor
		$('.textarea').wysihtml5()
	})
</script>
<script type="text/javascript">
	window.onload = function() {
		setTimeout(function() {

				//window.print();
			},
			1000);

	}

	$("#print_button").on("click", function() {


		var txt_auth_address1 = CKEDITOR.instances.txt_auth_address.getData();
		var newStr = txt_auth_address1.replace(/<p>/g, "");
		var aaa = newStr.replace(/<p>/g, "<br>");
		var txt_notes = $("#txt_notes").val();

		document.getElementById("span_auth_address").innerHTML = aaa;
		document.getElementById("span_notes").innerHTML = txt_notes;
		$("#print_button").hide();
		window.print();




	});

	$("#print_button").on("click", function() {
		$('#print_button').hide();
		window.print();
	});
</script>
