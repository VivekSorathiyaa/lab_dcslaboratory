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

if (isset($_POST["add_tpi"])) {

	$serial = "SELECT * FROM tpi ORDER BY tpi_id DESC";
	$res = mysqli_query($conn, $serial);

	if (mysqli_num_rows($res) > 0) {
		$r = mysqli_fetch_assoc($res);
		$ser_no = $r["tpi_code"] + 1;
	} else {
		$ser_no = 1;
	}


	$add_tpi_name = $_POST['add_tpi_name'];
	$add_tpi_mobile = $_POST['add_tpi_mobile'];
	$add_tpi_email = $_POST['add_tpi_email'];
	$curr_date = date("Y-m-d");

	$query = "INSERT INTO `tpi`(`tpi_code`,`tpi_name`,`tpi_phone`,`tpi_email`,`tpicreatedby`,`tpicreateddate`,`tpimodifiedby`,`tpimodifieddate`) values(
						'$ser_no',
						'$add_tpi_name',
						'$add_tpi_mobile',
						'$add_tpi_email',
						'$_SESSION[name]',
						'$curr_date',
						'$_SESSION[name]',
						'$curr_date'
						)";
	$query_run = mysqli_query($conn, $query);

?>
	<script>
		alert("Tpi Successfully Inserted....");
		window.location.href = "<?php echo $base_url; ?>view_tpi_lists.php";
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
				Add Tpi
			</h1>
			<a href="view_tpi_lists.php" class="btn btn-lg btn-info" style="float:right;">View TPI</a>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">

					<!-- /.box-header -->


					<div class="box-body">
						<form method="post">
							<div class="row">

								<div class="col-md-4">
									<strong>Tpi Name</strong>
									<input type="text" class="col-sm-12 form-control" id="add_tpi_name" tabindex="1" name="add_tpi_name" placeholder="Enter tpi Name." required><span style="color:red;">&nbsp;</span>
								</div>
								<div class="col-md-4">
									<strong>Tpi Phone </strong>
									<input type="text" class="col-sm-12 form-control" id="add_tpi_mobile" tabindex="2" name="add_tpi_mobile" placeholder="Enter tpi Mobile No.">
								</div>
								<div class="col-md-4">
									<strong>Tpi Email</strong>
									<input type="email" class="col-sm-12 form-control" id="add_tpi_email" tabindex="3" name="add_tpi_email" placeholder="Enter tpi email.">
								</div>

							</div>
							<br><br>
							<div class="row">
								<div class="col-md-6">
									<strong>Tpi Gst</strong>
									<input type="text" class="col-sm-12 form-control" id="add_tpi_gst" tabindex="5" placeholder="Enter tpi Gst" name="add_tpi_gst">
								</div>

								<div class="col-md-6">
									<strong>Tpi Address</strong>
									<textarea id="add_tpi_address" tabindex="4" style="height:50px" name="add_tpi_address" class="col-sm-12 form-control" placeholder="Enter tpi Address.">

										</textarea>
								</div>
							</div>
							<div class="row">

								<div class="col-md-5">

								</div>

								<div class="col-md-4">
									<input type="submit" name="add_tpi" class="btn btn-primary " value="ADD TPI">
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