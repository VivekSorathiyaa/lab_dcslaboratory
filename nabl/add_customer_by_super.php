<?php include("header.php");
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


<?php

if (isset($_POST["add_client"])) {



	$serial = "SELECT * FROM client ORDER BY client_id DESC";
	$res = mysqli_query($conn, $serial);

	if (mysqli_num_rows($res) > 0) {
		$r = mysqli_fetch_assoc($res);
		$ser_no = $r["client_code"] + 1;
	} else {
		$ser_no = 1;
	}


	$client_name = $_POST["client_name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	$pincode = $_POST["pincode"];
	$sel_city = $_POST["sel_city"];
	$customer_gst_no = $_POST["customer_gst_no"];
	$curr_date = date("Y-m-d");

	$insert = "INSERT INTO `client`(`client_code`, `clientname`, `client_city`,`clientphone`,`email`,`pincode`,`gst_no`,`clientaddress`,`clientcreatedby`,`clientcreateddate`,`clientmodifiedby`,`clientmodifieddate`) values(
						'$ser_no',
						'$client_name',
						'$sel_city',
						'$phone',
						'$email',
						'$pincode',
						'$customer_gst_no',
						'$address',
						'$_SESSION[name]',
						'$curr_date',
						'$_SESSION[name]',
						'$curr_date'
						)";
	$result_of_insert = mysqli_query($conn, $insert);

?>
	<script>
		window.location.href = "<?php echo $base_url; ?>view_customer_lists.php";
	</script>
<?php

}





?>

<style>
	#billing label {
		display: block;
		text-align: center;
		line-height: 150%;
		font-size: .85em;
	}

	
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 0px !important;">


	<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
		<?php include("menu.php") ?>
		<div class="row main_breadcrumb">

			<h1 style="text-align:center;">
				Add Customer
			</h1>
			<a href="view_customer_lists.php" class="btn btn-lg btn-info me-3" style="float:right;">View CUSTOMER</a>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">

					<!-- /.box-header -->


					<div class="box-body">
						<form method="post">
							<div class="row">

								<div class="col-md-4">
									<strong>Client Name</strong>
									<input type="text" class="col-sm-12 form-control" id="client_name" tabindex="1" name="client_name" placeholder="Enter Customer Name" required><span style="color:red;">&nbsp;</span>
								</div>
								<div class="col-md-4">
									<strong>Client Phone </strong>
									<input type="text" class="col-sm-12 form-control" id="phone" tabindex="2" name="phone" placeholder="Enter Phone no.">
								</div>
								<div class="col-md-4">
									<strong>Client Email</strong>
									<input type="email" class="col-sm-12 form-control" id="email" tabindex="3" name="email" placeholder="Enter Email Id.">
								</div>

							</div>
							<br>
							<div class="row">
								<div class="col-md-6">
									<strong>Client Address</strong>
									<textarea id="address" tabindex="4" style="height:50px" name="address" class="col-sm-12 form-control" placeholder="Enter Address.">

										</textarea>
								</div>

								<div class="col-md-6">
									<strong>Pincode</strong>
									<input type="text" class="col-sm-12 form-control" id="pincode" tabindex="5" placeholder="Enter Pincode." tabindex="8" name="pincode">
								</div>
							</div>
							<br>
							<div class="row">

								<div class="col-md-6">
									<strong>Client City</strong>
									<select class="form-control col-sm-12 " tabindex="6" data-placeholder="Select City." id="sel_city" name="sel_city">
										<option value="">Select City</option>
										<?php
										$sql = "select * from city";

										$result = mysqli_query($conn, $sql);

										while ($row = mysqli_fetch_assoc($result)) {

										?>
											<option value="<?php echo $row['id']; ?>" <?php if ($one_record['client_city'] == $row['id']) {
																							echo "selected";
																						} ?>>
												<?php echo $row['city_name']; ?></option>
										<?php  } ?>
									</select>

								</div>

								<div class="col-md-6">
									<strong>Gst No</strong>
									<input type="text" placeholder="Enter GST No." class="col-sm-12 form-control" id="customer_gst_no" tabindex="7" name="customer_gst_no">
								</div>

							</div>

							<div class="row">

								<div class="col-md-5">

								</div>

								<div class="col-md-4">
									<input type="submit" name="add_client" class="btn btn-primary " value="ADD">
								</div>

								<div class="col-md-3">
								</div>
							</div>


						</form>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>

		<br>
	</section>
</div>

<?php include("footer.php"); ?>