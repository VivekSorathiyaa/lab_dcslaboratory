<?php include("header.php");?>
<?php
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
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

		<!-- Main content -->
		<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto;
     padding-left: 0px;
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row" style="margin: 0px 0px 0px 0px;">

					<h1 style="text-align:center;">
					ESTIMATE

					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Estimate</h3>
				</div>
				<!-- /.box-header -->

						<div class="box-body">


							<div id="display_data">
							<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>

										<th style="text-align:center;">ACTION</th>
										<th style="text-align:center;"></th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Job No</th>
										<th style="text-align:center;">Estimate Date</th>
										<th style="text-align:center;">Agency Name</th>
										<th style="text-align:center;">Agency</th>
										<th style="text-align:center;">GST Type</th>
										<th style="text-align:center;">CGST Amt</th>
										<th style="text-align:center;" >SGST Amt</th>
										<th style="text-align:center;">IGST Amt</th>
										<th style="text-align:center;">Grand Total</th>
										<th style="text-align:center;">Total Amt</th>
										<th style="text-align:center;">is Billing</th>

									</tr>
								</thead>
								<tbody>
									<?php

										$count=0;
										 $query="select * from estimate_total_span where `est_isdeleted`='0'  ";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;

									?>
											<tr id="tr_<?php echo $row['est_id']?>">
											  <td style="white-space:nowrap;">

												<a href="<?php echo $base_url;?>span_set_rate_by_super_admin.php?report_no=<?php echo $row['report_no'];?>&&job_no=<?php echo $row['job_no'];?>" class="btn btn-primary btn-lg btn3d"title="Print"><span class="glyphicon glyphicon-question-ok"></span>Edit</a>

												&nbsp;<a href="<?php echo $base_url;?>span_bill_print.php?report_no=<?php echo $row['report_no'];?>&&job_no=<?php echo $row['job_no'];?>" class="btn btn-primary btn-lg btn3d"title="Print" target="_blank"><span class="glyphicon glyphicon-question-ok"></span>Print</a>

												&nbsp;<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d delete_estimate_by_sadmin" data-id="<?php echo $row['est_id'];?>"title="DELETE"><span class="glyphicon glyphicon-question-ok"></span>DELETE</a>

											</td>
											<td><?php echo $count;?></td>
											<td style="white-space:nowrap;"><?php echo $row['report_no'];?></td>
											<td><?php echo $row['job_no'];?></td>
											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['estimate_date']));?></td>
											<td><?php echo $row['estimate_no'];?></td>


											<?php $sel_agency="select * from agency_master where `agency_id`=".$row["agency_id"];
											$query_agency = mysqli_query($conn, $sel_agency);
											$get_agency = mysqli_fetch_array($query_agency);
											?>
											<td><?php echo $get_agency['agency_name'];?></td>
											<td><?php echo $row['gst_type'];?></td>
											<td><?php echo $row['c_gst_amt'];?></td>
											<td><?php echo $row['s_gst_amt'];?></td>
											<td><?php echo $row['i_gst_amt'];?></td>
											<td><?php echo $row['grand_total'];?></td>
											<td><?php echo $row['total_amt'];?></td>
											<td>
											<?php if($row['is_billing']=='1'){
												echo "yes";
											}else{
												echo "no";
											}?>
											</td>

										</tr>
									<?php
										}
									?>
								</tbody>

							  </table>

							</div>
						</div>
				<!-- /.box-body -->
				</div>
			</div>
		</div>
</section>
</div>

<?php include("footer.php");?>

<script>
    $(document).ready(function() {
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
	 buttons: [

            { extend: 'excel',
			  footer: true,
			}
        ],

    } );
 } );

	$('#from_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy',
	  //startDate: new Date(inv_start_date),
	 // endDate: new Date(inv_end_date)
	})
	$('#to_date').datepicker({
	  autoclose: true,
	  format: 'dd/mm/yyyy',
	 // startDate: new Date(inv_start_date),
	  //endDate: new Date(inv_end_date)
	})

	$(function () {
		$('.select2').select2()
	})
</script>
<script>

		$(document).on("click", ".delete_estimate_by_sadmin", function () {
					var delete_ids = $(this).attr("data-id");


		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To Delete Bill ?",
			buttons: {
				confirm: function () {
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>superadmin_delete_bill.php',
			data: 'action_type=sendrec1&delete_ids='+delete_ids,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success:function(html){
				document.getElementById("overlay_div").style.display="none";
				var set_id="#tr_"+delete_ids;
				$(set_id).remove();
				//get_jobs();
			}
		});

		},
				cancel: function () {
					return;
				}
				}
			})
	});






</script>
