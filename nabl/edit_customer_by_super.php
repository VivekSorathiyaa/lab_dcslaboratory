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

if (isset($_POST["edit_client"])) {


	$client_name = $_POST["client_name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	$pincode = $_POST["pincode"];
	$sel_city = $_POST["sel_city"];
	$customer_gst_no = $_POST["customer_gst_no"];
	$hidden_cid = $_POST["hidden_cid"];


	$up_client = "update client set `clientname`='$client_name',`client_city`='$sel_city',`clientphone`='$phone',`email`='$email',`pincode`='$pincode',`gst_no`='$customer_gst_no',`clientaddress`='$address' where `client_id`=" . $hidden_cid;

	mysqli_query($conn, $up_client);
?>
	<script>
		window.location.href = "<?php echo $base_url; ?>view_customer_lists.php";
	</script>
<?php

}

$get_cid = $_GET["cid"];
$sel_c = "select * from client where `client_id`=" . $get_cid;
$get_result = mysqli_query($conn, $sel_c);
$one_record = mysqli_fetch_array($get_result);



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
				Edit Customer
			</h1>
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
									<input type="text" class="col-sm-12 form-control" id="client_name" tabindex="1" name="client_name" placeholder="Enter Customer Name" value="<?php echo $one_record['clientname']; ?>"><span style="color:red;">&nbsp;</span>
								</div>
								<div class="col-md-4">
									<strong>Client Phone </strong>
									<input type="text" class="col-sm-12 form-control" id="phone" tabindex="2" name="phone" placeholder="Enter Phone no." value="<?php echo $one_record['clientphone']; ?>">
								</div>
								<div class="col-md-4">
									<strong>Client Email</strong>
									<input type="email" class="col-sm-12 form-control" id="email" tabindex="3" name="email" placeholder="Enter Email Id." value="<?php echo $one_record['email']; ?>">
								</div>

							</div>
							<br><br>
							<div class="row">
								<div class="col-md-6">
									<strong>Client Address</strong>
									<textarea id="address" tabindex="4" style="height:50px" name="address" class="col-sm-12 form-control" placeholder="Enter Address.">
										<?php echo $one_record['clientaddress']; ?>
										</textarea>
								</div>

								<div class="col-md-6">
									<strong>Pincode</strong>
									<input type="text" class="col-sm-12 form-control" id="pincode" tabindex="5" placeholder="Enter Pincode." tabindex="8" name="pincode" value="<?php echo $one_record['pincode']; ?>">
								</div>
							</div>
							<br>
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
									<input type="text" placeholder="Enter GST No." class="col-sm-12 form-control" id="customer_gst_no" tabindex="7" name="customer_gst_no" value="<?php echo $one_record['gst_no']; ?>">
								</div>

							</div>

							<div class="row">

								<div class="col-md-5">
									<input type="hidden" name="hidden_cid" value="<?php echo $one_record['client_id']; ?>">
								</div>

								<div class="col-md-4">
									<input type="submit" name="edit_client" class="btn btn-primary " value="Update">
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