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

if(isset($_SESSION['reporting_no']))
{
	unset($_SESSION['reporting_no']);
}

if(isset($_SESSION['jobing_no']))
{
	unset($_SESSION['jobing_no']);
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
					JOB INVERT FINAL LISTING

					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">JOB INVERT FINAL LISTING&nbsp;<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal">Light Indication</button></h3>
				</div>
				<!-- /.box-header -->

						<div class="box-body">


							<div id="display_data">
							<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>

										<th style="text-align:center;">Indication</th>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;"></th>
										<th style="text-align:center;">Client Name</th>
										<th style="text-align:center;">Client Address</th>
										<th style="text-align:center;">Client Phone</th>
										<th style="text-align:center;">Email</th>
										<th style="text-align:center;">Client Gst No</th>
										<th style="text-align:center;">Client city</th>
										<th style="text-align:center;">Agency</th>
										<th style="text-align:center;">Agency Address</th>
										<th style="text-align:center;" >Agency Mobile</th>
										<th style="text-align:center;">Agency City</th>
										<th style="text-align:center;">Agency Gstno</th>
										<th style="text-align:center;">Agency Email</th>
										<th style="text-align:center;">Name of Work</th>
										<th style="text-align:center;">Authorized Name</th>
										<th style="text-align:center;">Ref No</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Job Number</th>
										<th style="text-align:center;">Sample Sent By</th>
										<th style="text-align:center;">Sample Rec Date</th>
										<th style="text-align:center;">Condition of Sample Receved</th>


									</tr>
								</thead>
								<tbody>
									<?php

										$count=0;
										$query="select * from job where  `jobisdeleted`='0' ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;

									?>
											<tr>
											<td>
											<?php
											$lights=$row['admin_special_light'];

											if($lights==0)
											{
											echo '<img src="images/admin_light/off.png">';
											$urls="job_listing.php?a=rec1";
											$classes="color: black";
											}
											if($lights==1)
											{
											echo '<img src="images/admin_light/yellow.png">';
											$urls="job_listing_for_second_reception.php?a=rec2";
											$classes="color: yellow";
											}
											if($lights==2)
											{
											echo '<img src="images/admin_light/orange.png">';
											$urls="perfoma_list_rec_two.php?a=rec2";
											$classes="color: orange";
											}
											if($lights==3)
											{
											echo '<img src="images/admin_light/sky.png">';
											$urls="view_job_by_eng.php?report_no=".$row['report_no']."&&job_no=".$row['job_number'];
											$classes="color: #03aba8";
											}
											if($lights==4)
											{
											echo '<img src="images/admin_light/marron.png">';
											$urls="dilevery_detail.php?report_no=".$row['report_no']."&&job_no=".$row['job_number'];
											$classes="color: brown";
											}
											if($lights==5)
											{
											echo '<img src="images/admin_light/green.png">';
											$urls="dilevery_detail.php?report_no=".$row['report_no']."&&job_no=".$row['job_number'];
											$classes="color: green";
											}
											?>
											</td>
											<td style="white-space:nowrap;">

											<a href="<?php echo $urls;?>" class="btn btn-default btn-lg btn3d" title="GO" style="<?php echo $classes;?>;background-color:darkgray;"><span class="glyphicon glyphicon-question-ok"></span>GO</a>

											</td>
											<td><?php echo $count;?></td>
											<td style="white-space:nowrap;"><?php echo $row['clientname'];?></td>
											<td><?php echo $row['clientaddress'];?></td>
											<td><?php echo $row['clientphone'];?></td>
											<td><?php echo $row['email'];?></td>
											<td><?php echo $row['client_gstno'];?></td>

											<?php
											$sel_city="select * from city where id=".$row['client_city'];
											$query_city = mysqli_query($conn, $sel_city);
											$get_city = mysqli_fetch_array($query_city);
											?>
											<td><?php echo $get_city['city_name'];?></td>

											<?php $sel_agency="select * from agency_master where `agency_id`=".$row["agency"];
											$query_agency = mysqli_query($conn, $sel_agency);
											$get_agency = mysqli_fetch_array($query_agency);
											?>
											<td><?php echo $get_agency['agency_name'];?></td>
											<td><?php echo $row['agency_address'];?></td>
											<td><?php echo $row['agency_mobile'];?></td>
											<?php $sel_agency_city="select * from city where `id`=".$row["agency_city"];
											$query_agency_city = mysqli_query($conn, $sel_agency_city);
											$get_agency_city = mysqli_fetch_array($query_agency_city);
											?>
											<td><?php echo $get_agency_city['city_name'];?></td>
											<td><?php echo $row['agency_gstno'];?></td>
											<td><?php echo $row['agency_email'];?></td>
											<td><?php echo $row['nameofwork'];?></td>
											<td><?php echo $row['person_name'];?></td>
											<td><?php echo $row['refno'];?></td>
											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['date']));?></td>
											<td><?php echo $row['report_no'];?></td>
											<td><?php echo $row['job_number'];?></td>
											<td>
											<?php if($row['sample_sent_by']=='0'){
												echo $row['clientname'];
											}else{
												echo $get_agency['agency_name'];
											}?>
											</td>

											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row[	'sample_rec_date']));?></td>
											<td>
											<?php if($row['condition_of_sample_receved']=='0'){
												echo $row['clientname'];
											}else{
												echo $get_agency['agency_name'];
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

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="text-align:center;font-size:30px;">LIGHT WISE JOB INDICATION</h4>
        </div>
        <div class="modal-body">
          <table align="center" border="1px;">
          <tr>
          <th style="width:200px;height:50px;text-align:center;">LIGHT</th>
          <th style="width:200px;height:50px;text-align:center;">DESCRIPTION</th>
		  </tr>

		  <tr>
          <td style="width:200px;height:50px;text-align:center;"><img src="images/admin_light/off.png">OFF</td>
          <td style="width:200px;height:50px;text-align:center;">JOB AVAILABLE IN INVERT</td>
		  </tr>

		  <tr>
          <td style="width:200px;height:50px;text-align:center;"><img src="images/admin_light/yellow.png">YELLOW</td>
          <td style="width:200px;height:50px;text-align:center;">JOB AVAILABLE IN MATERIAL SELECTION</td>
		  </tr>

		  <tr>
          <td style="width:200px;height:50px;text-align:center;"><img src="images/admin_light/orange.png">ORANGE</td>
          <td style="width:200px;height:50px;text-align:center;">JOB AVAILABLE IN ESTIMATE</td>
		  </tr>

		  <tr>
          <td style="width:200px;height:50px;text-align:center;"><img src="images/admin_light/sky.png">#03aba8</td>
          <td style="width:200px;height:50px;text-align:center;">JOB AVAILABLE IN REPORT</td>
		  </tr>

		  <tr>
          <td style="width:200px;height:50px;text-align:center;"><img src="images/admin_light/marron.png">BROWN</td>
          <td style="width:200px;height:50px;text-align:center;">JOB AVAILABLE IN DISPATCH BUT NOT CLEAR BY REPORT AND BILL ALSO</td>
		  </tr><tr>
          <td style="width:200px;height:50px;text-align:center;"><img src="images/admin_light/green.png">GREEN</td>
          <td style="width:200px;height:50px;text-align:center;">JOB AVAILABLE IN REPORT</td>
		  </tr>
		  </table>
        </div>
        <div class="modal-footer">
		<h4 class="modal-title" style="text-align:center;">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </h4>
        </div>
      </div>

    </div>
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

	$(document).on("click", ".send_to_second", function () {
					var report_no = $(this).attr("data-id");


		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To Delete This Job ?",
			buttons: {
				confirm: function () {
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>delete_ess_bill.php',
			data: 'action_type=delete_bill&report_no='+report_no,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success:function(html){
				document.getElementById("overlay_div").style.display="none";
				getJobs();
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
