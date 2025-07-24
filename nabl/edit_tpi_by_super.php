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

if (isset($_POST["edit_tpi"])) {


	$add_tpi_name = $_POST['add_tpi_name'];
	$add_tpi_mobile = $_POST['add_tpi_mobile'];
	$add_tpi_email = $_POST['add_tpi_email'];
	$hidden_cid = $_POST["hidden_cid"];


	$up_client = "update tpi set `tpi_name`='$add_tpi_name',`tpi_phone`='$add_tpi_mobile',`tpi_email`='$add_tpi_email' where `tpi_id`=" . $hidden_cid;

	mysqli_query($conn, $up_client);
?>
	<script>
		alert("Tpi Successfully Updated....");
		window.location.href = "<?php echo $base_url; ?>view_tpi_lists.php";
	</script>
<?php

}

$get_cid = $_GET["cid"];
$sel_c = "select * from tpi where `tpi_id`=" . $get_cid;
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
				Edit Tpi
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
									<strong>Tpi Name</strong>
									<input type="text" class="col-sm-12 form-control" id="add_tpi_name" tabindex="1" name="add_tpi_name" placeholder="Enter tpi Name." value="<?php echo $one_record['tpi_name']; ?>" required><span style="color:red;">&nbsp;</span>
								</div>
								<div class="col-md-4">
									<strong>Tpi Phone </strong>
									<input type="text" class="col-sm-12 form-control" id="add_tpi_mobile" tabindex="2" name="add_tpi_mobile" placeholder="Enter tpi Mobile No." value="<?php echo $one_record['tpi_phone']; ?>">
								</div>
								<div class="col-md-4">
									<strong>Tpi Email</strong>
									<input type="email" class="col-sm-12 form-control" id="add_tpi_email" tabindex="3" name="add_tpi_email" placeholder="Enter tpi email." value="<?php echo $one_record['tpi_email']; ?>">
								</div>

							</div>

							<br><br>
							<div class="row">

								<div class="col-md-5">
									<input type="hidden" name="hidden_cid" value="<?php echo $one_record['tpi_id']; ?>">
								</div>

								<div class="col-md-4">
									<input type="submit" name="edit_tpi" class="btn btn-primary " value="UPDATE TPI">
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