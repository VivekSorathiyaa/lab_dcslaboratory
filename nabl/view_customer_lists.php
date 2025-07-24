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
				Customer Listing
			</h1>
			<a href="add_customer_by_super.php" class="btn btn-info" style="float:right;">ADD CUSTOMER</a>
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
										<th style="text-align:center;">Customer Code</th>
										<th style="text-align:center;">Customer Name</th>
										<th style="text-align:center;">Email</th>
										<th style="text-align:center;">Gst No</th>
										<th style="text-align:center;">Action</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$count = 0;
									$query = "select * from client where `clientisdeleted`= 0 ORDER BY client_id DESC";
									$result = mysqli_query($conn, $query);
									while ($row = mysqli_fetch_array($result)) {
										$count++;

									?>
										<tr id="tr_<?php echo $row['client_id']; ?>">
											<td style="text-align:center;"><?php echo $count; ?></td>
											<td style="text-align:center;">
												<?php echo $row['client_code']; ?>
											</td>
											<td style="text-align:center;">
												<?php echo $row['clientname']; ?>
											</td>

											<td style="text-align:center;">
												<?php echo $row['email']; ?>
											</td>
											<td style="text-align:center;">
												<?php echo $row['gst_no']; ?>
											</td>

											<td style="text-align:center;">

												<a href="edit_customer_by_super.php?cid=<?php echo $row['client_id']; ?>" class="btn btn-primary ">
													Edit
												</a>

												<a href="javascript:void(0)" class="btn btn_delete btn-danger " data-id="<?php echo $row['client_id']; ?>">
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
										<td colspan="6">&nbsp;</td>
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
			content: "Are You Sure To Delete This Client?",
			buttons: {
				confirm: function() {
					$.ajax({
						type: 'POST',
						url: '<?php $base_url; ?>delete_customer.php',
						data: 'action_type=delete_customer&clicked_id=' + clicked_id,
						success: function() {
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