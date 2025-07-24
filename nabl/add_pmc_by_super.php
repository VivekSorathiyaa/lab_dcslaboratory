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

if (isset($_POST["add_pmc"])) {

	$serial = "SELECT * FROM pmc ORDER BY pmc_id DESC";
	$res = mysqli_query($conn, $serial);

	if (mysqli_num_rows($res) > 0) {
		$r = mysqli_fetch_assoc($res);
		$ser_no = $r["pmc_code"] + 1;
	} else {
		$ser_no = 1;
	}


	$add_pmc_name = $_POST['add_pmc_name'];
	$add_pmc_mobile = $_POST['add_pmc_mobile'];
	$add_pmc_email = $_POST['add_pmc_email'];
	$add_pmc_gst = $_POST['add_pmc_gst'];
	$add_pmc_address = $_POST['add_pmc_address'];
	$curr_date = date("Y-m-d");

	$query = "INSERT INTO `pmc`(`pmc_code`,`pmcname`,`pmcphone`,`email`,`pmccreatedby`,`pmccreateddate`,`pmcmodifiedby`,`pmcmodifieddate`) values(
						'$ser_no',
						'$add_pmc_name',
						'$add_pmc_mobile',
						'$add_pmc_email',
						'$_SESSION[name]',
						'$curr_date',
						'$_SESSION[name]',
						'$curr_date'
						)";
	$query_run = mysqli_query($conn, $query);

?>
	<script>
		alert("pmc Successfully Inserted....");
		window.location.href = "<?php echo $base_url; ?>view_pmc_lists.php";
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
				Add pmc
			</h1>
			<a href="view_pmc_lists.php" class="btn btn-lg btn-info" style="float:right;">View pmc</a>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">

					<!-- /.box-header -->


					<div class="box-body">
						<form method="post">
							<div class="row">

								<div class="col-md-4">
									<strong>pmc Name</strong>
									<input type="text" class="col-sm-12 form-control" id="add_pmc_name" tabindex="1" name="add_pmc_name" placeholder="Enter pmc Name." required><span style="color:red;">&nbsp;</span>
								</div>
								<div class="col-md-4">
									<strong>pmc Phone </strong>
									<input type="text" class="col-sm-12 form-control" id="add_pmc_mobile" tabindex="2" name="add_pmc_mobile" placeholder="Enter pmc Mobile No.">
								</div>
								<div class="col-md-4">
									<strong>pmc Email</strong>
									<input type="email" class="col-sm-12 form-control" id="add_pmc_email" tabindex="3" name="add_pmc_email" placeholder="Enter pmc email.">
								</div>

							</div>
							<div class="row">

								<div class="col-md-5">

								</div>

								<div class="col-md-4">
									<input type="submit" name="add_pmc" class="btn btn-primary " value="ADD PMC">
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