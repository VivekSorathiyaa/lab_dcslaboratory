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
				Tpi Listing
			</h1>
			<a href="add_tpi_by_super.php" class="btn btn-lg btn-info" style="float:right;">ADD TPI </a>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">

					<!-- /.box-header -->


					<div class="box-body">
						
						<div id="display_data">
							<table id="example1" class="table table-bordered table-striped" style="width:100%;">
								<thead>
									<tr>
										<th style="text-align:center;">Sr No.</th>
										<th style="text-align:center;">Tpi Code</th>
										<th style="text-align:center;">Tpi Name</th>
										<th style="text-align:center;">Email</th>
										<th style="text-align:center;">Action</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$count = 0;
									$query = "select * from tpi where `tpiisdeleted`= 0 ORDER BY tpi_id DESC";
									$result = mysqli_query($conn, $query);
									while ($row = mysqli_fetch_array($result)) {
										$count++;

									?>
										<tr id="tr_<?php echo $row['tpi_id']; ?>">
											<td style="text-align:center;"><?php echo $count; ?></td>
											<td style="text-align:center;">
												<?php echo $row['tpi_code']; ?>
											</td>
											<td style="text-align:center;">
												<?php echo $row['tpi_name']; ?>
											</td>

											<td style="text-align:center;">
												<?php echo $row['tpi_email']; ?>
											</td>

											<td style="text-align:center;">

												<a href="edit_tpi_by_super.php?cid=<?php echo $row['tpi_id']; ?>" class="btn btn-primary ">
													Edit
												</a>

												<a href="javascript:void(0)" class="btn btn_delete btn-danger " data-id="<?php echo $row['tpi_id']; ?>">
													Delete
												</a>
											</td>


										</tr>
									<?php
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>

									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>

									</tr>
								</tfoot>

							</table>

						</div>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>

		<br>
	</section>
</div>

<?php include("footer.php"); ?>

<script>
	$(document).on("click", ".btn_delete", function() {
		var clicked_id = $(this).attr("data-id");
		var set_tr_id = "#tr_" + clicked_id;

		$.confirm({
			title: "warning",
			content: "Are You Sure To Delete This Tpi?",
			buttons: {
				confirm: function() {
					$.ajax({
						type: 'POST',
						url: '<?php $base_url; ?>delete_tpi.php',
						data: 'action_type=delete_tpi&clicked_id=' + clicked_id,
						success: function() {
							alert("Tpi Successfully Deleted....");
							$(set_tr_id).remove();
						}
					});

				},
				cancel: function() {
					return;
				}
			}
		})
	});
</script>