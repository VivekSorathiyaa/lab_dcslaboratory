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

if (isset($_POST["edit_pmc"])) {


	$add_pmc_name = $_POST['add_pmc_name'];
	$add_pmc_mobile = $_POST['add_pmc_mobile'];
	$add_pmc_email = $_POST['add_pmc_email'];
	$hidden_cid = $_POST["hidden_cid"];


	$up_client = "update pmc set `pmcname`='$add_pmc_name',`pmcphone`='$add_pmc_mobile',`email`='$add_pmc_email' where `pmc_id`=" . $hidden_cid;

	mysqli_query($conn, $up_client);
?>
	<script>
		alert("pmc Successfully Updated....");
		window.location.href = "<?php echo $base_url; ?>view_pmc_lists.php";
	</script>
<?php

}

$get_cid = $_GET["cid"];
$sel_c = "select * from pmc where `pmc_id`=" . $get_cid;
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
				Edit Pmc
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
									<strong>pmc Name</strong>
									<input type="text" class="col-sm-12 form-control" id="add_pmc_name" tabindex="1" name="add_pmc_name" placeholder="Enter pmc Name." value="<?php echo $one_record['pmcname']; ?>" required><span style="color:red;">&nbsp;</span>
								</div>
								<div class="col-md-4">
									<strong>pmc Phone </strong>
									<input type="text" class="col-sm-12 form-control" id="add_pmc_mobile" tabindex="2" name="add_pmc_mobile" placeholder="Enter pmc Mobile No." value="<?php echo $one_record['pmcphone']; ?>">
								</div>
								<div class="col-md-4">
									<strong>pmc Email</strong>
									<input type="email" class="col-sm-12 form-control" id="add_pmc_email" tabindex="3" name="add_pmc_email" placeholder="Enter pmc email." value="<?php echo $one_record['email']; ?>">
								</div>

							</div>
							<br><br>

							<div class="row">

								<div class="col-md-5">
									<input type="hidden" name="hidden_cid" value="<?php echo $one_record['pmc_id']; ?>">
								</div>

								<div class="col-md-4">
									<input type="submit" name="edit_pmc" class="btn btn-primary " value="UPDATE PMC">
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