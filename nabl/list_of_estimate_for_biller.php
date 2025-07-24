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



.form-control {
font-size: 20px;
height: 50px;
}





</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">


<section class="content">
			<?php include("menu.php") ?>
			<div class="row">


	</div>
<div class="row">

		<div class="row">

		<h1 style="text-align:center;">
		Estimate List
		</h1>
	</div>
	<div class="row">
        <div class="col-md-12">
					<div class="box box-info">

							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
							<div class="panel-group">
								<div class="box box-info">
									<div class="box-body">
									  <div class="table-responsive" id="display_data">
										<table class="table no-margin" id="example1"  width="100%">
										  <thead>
										  <tr>
											<th>R</th>
											<th>Report No </th>
											<th>Job No </th>
											<th>Estimaste No </th>
											<th>Agency Name</th>
											<th>Bill Amount</th>
											<th>Action</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
											$sel_estimate="select * from estimate_total_span where `est_isdeleted`=0 AND `is_billing`=0";
											$query_estimate=mysqli_query($conn,$sel_estimate);

											if(mysqli_num_rows($query_estimate) > 0){
											while($get_estimate=mysqli_fetch_array($query_estimate)){

										  ?>
										  <tr>
											<td>
											<!--<input type="checkbox" name="chk_to_skip" class="chk_to_skip" value="<?php //echo $get_estimate["trf_no"]; ?>">--></td>
											<td><?php echo $get_estimate["trf_no"]; ?></td>
											<td><?php echo $get_estimate["job_no"]; ?></td>
											<td><?php echo $get_estimate["estimate_no"]; ?></td>
											<td><?php
											$age_id= $get_estimate["agency_id"];
											$sel_agency="select * from agency_master where `agency_id`=".$age_id;
											$query_agency=mysqli_query($conn,$sel_agency);
											$result_agency=mysqli_fetch_array($query_agency);

											echo $result_agency["agency_name"];
											?>
											</td>
											<td><?php echo $get_estimate["total_amt"]; ?></td>

											<td>
											  <a href="span_set_rate_by_biller.php?trf_no=<?php echo $get_estimate['trf_no'];?>&&job_no=<?php echo $get_estimate['job_no'];?>" class="btn btn-primary btn-lg btn3d" title="View Estimate"><span class="glyphicon glyphicon-question-list"></span> Invoice</a>
											&nbsp;



											<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d report_send_to_bill"  data-id="<?php echo $get_estimate['est_id']."|".$get_estimate['trf_no'];?>" title="Save As Bill"><span class="glyphicon glyphicon-question-list"></span> Send To Bill</a>


											</td>
										  </tr>
										 <?php
										 }
										 }

										 ?>
										 </tbody>
										</table>
									  </div>
									  <!--<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d skip_bulk" title="SKIP"><span class="glyphicon glyphicon-question-ok"></span> SKIP</a>-->
									</div>
								</div>
							</div>
							<br>
						</div>
					</div>
				</div>
		</div>
		<div class="row">

		<h1 style="text-align:center;">
		Bill List By Test
		</h1>
		</div>
		<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				<div class="box-body">
						<div id="display_data_report">
								<table class="table no-margin" id="example2" width="100%">
										  <thead>
										  <tr>
											<th>R</th>
											<th>Report No </th>
											<th>Job No </th>
											<th>Estimaste No </th>
											<th>Agency Name</th>
											<th>Bill Amount</th>
											<th>Action</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
											$sel_estimate="select * from estimate_total_span where `est_isdeleted`=0 AND `is_billing`=1";
											$query_estimate=mysqli_query($conn,$sel_estimate);

											if(mysqli_num_rows($query_estimate) > 0){
											while($get_estimate=mysqli_fetch_array($query_estimate)){

										  ?>
										  <tr>
											<td>
											<?php
											if($get_estimate["is_bill_merged"]==0){
											?>
											<!--<input type="checkbox" name="chk_by_test" class="chk_by_test" value="<?php //echo $get_estimate["trf_no"]; ?>">-->
											<?php
											}else{
												echo "&nbsp;";
											}
											?>
											</td>
											<td><?php echo $get_estimate["trf_no"]; ?></td>
											<td><?php echo $get_estimate["job_no"]; ?></td>
											<td><?php echo $get_estimate["estimate_no"]; ?></td>
											<td><?php
											$age_id= $get_estimate["agency_id"];
											$sel_agency="select * from agency_master where `agency_id`=".$age_id;
											$query_agency=mysqli_query($conn,$sel_agency);
											$result_agency=mysqli_fetch_array($query_agency);

											echo $result_agency["agency_name"];
											?>
											</td>
											<td><?php echo $get_estimate["total_amt"]; ?></td>

											<td>
											  <a href="span_bill_print.php?report_no=<?php echo $get_estimate['trf_no'];?>&&job_no=<?php echo $get_estimate['job_no'];?>" class="btn btn-primary btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Print</a>


											</td>
										  </tr>
										 <?php
										 }
										 }

										 ?>
										 </tbody>
										</table>

							</div>
							<!--<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d merging_by_test" title="Merge"><span class="glyphicon glyphicon-question-ok"></span> BILL MERGE</a>-->

						</div>
				<!-- /.box-body -->
				</div>
			</div>
		</div>
</section>
</div>


<?php include("footer.php");?>

<script>
$(document).ready(function(){
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

	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [

            { extend: 'excel',
			  footer: true,
			}
        ],

    } );


});

$('.startdate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});

$('.enddate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
$('.expdate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});


	//Work FOr Send Estimate to lab
 $(document).on("click", ".report_send_to_bill", function () {
	var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Send For Bill?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=set_estimate_as_bill&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_estimate_for_biller.php";
        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});


$(document).on("click", ".send_to_dispatch", function () {
				var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job To Dispatch?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=send_to_dispatch&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_estimate_for_biller.php";

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
