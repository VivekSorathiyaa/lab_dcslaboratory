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




.form-control {
font-size: 20px;;
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
	<div class="row">

		<h1 style="text-align:center;">
		Job Listing
		</h1>
	</div>
	<a class="pull-left btn btn-info" href="client_form.php" title="ADD JOB" style="margin-left:5px;">ADD JOB</a>

	<button type="button" class="pull-left btn btn-info" data-toggle="modal" data-target="#myModal" style="margin-left:10px;">Light Indication</button>
	<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">

					<!-- /.box-header -->


							<div class="box-body">

								<hr style="border-top: 1px solid;">
								<div class="row">

									<div class="col-md-3">
									<label>Clients:</label>
									<select name="sel_clients_ids" id="sel_clients_ids" class="form-control" style="height: 55px;background-color: aquamarine;" multiple="multiple">
									<option value="">Select-Client</option>
									<?php
									$sel_clients="select * from client where `clientisdeleted`=0";
									$query_clients = mysqli_query($conn, $sel_clients);
									if(mysqli_num_rows($query_clients)> 0)
									{
									while($get_one_clients=mysqli_fetch_array($query_clients))
									{ ?>
								    <option value="<?php echo $get_one_clients['client_code'];?>"><?php echo $get_one_clients['clientname'];?></option>

									<?php
									}
									}
									?>
									</select>
									</div>

									<div class="col-md-3">
									<label>Agency:</label>
									<select name="sel_agency_ids" id="sel_agency_ids" class="form-control" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 230px;" multiple="multiple">
									<option value="">Select-Agency</option>
									<?php
									$sel_agencys="select * from agency_master where `isdeleted`=0";
									$query_agencys = mysqli_query($conn, $sel_agencys);
									if(mysqli_num_rows($query_agencys)> 0)
									{
									while($get_one_agency=mysqli_fetch_array($query_agencys))
									{ ?>
								    <option value="<?php echo $get_one_agency['agency_id'];?>"><?php echo $get_one_agency['agency_name'];?></option>

									<?php
									}
									}
									?>
									</select>
									</div>

									<div class="col-md-3">
									<label>Aurthority:</label>
									<select name="sel_auth_names" id="sel_auth_names" class="form-control" style="height: 55px;background-color: aquamarine;" multiple="multiple">
									<option value="">Select-Authority</option>
									<?php
									$sel_auths="select * from authority where `auth_isdeleted`=0";
									$query_auths = mysqli_query($conn, $sel_auths);
									if(mysqli_num_rows($query_auths)> 0)
									{
									while($get_one_auths=mysqli_fetch_array($query_auths))
									{ ?>
								    <option value="<?php echo $get_one_auths['auth_name'];?>"><?php echo $get_one_auths['auth_name'];?></option>

									<?php
									}
									}
									?>
									</select>
									</div>
									<div class="col-md-3">
									<label>Agreement No:</label>
									<select name="agree_nos" id="agree_nos" class="form-control" style="height: 55px;background-color: aquamarine;" multiple="multiple">
									<option value="">Select-Agreement</option>
									<?php
									$sel_agree="select * from job where `jobisdeleted`=0 AND `agreement_no` !='' GROUP BY `agreement_no`";
									$query_agree= mysqli_query($conn, $sel_agree);
									if(mysqli_num_rows($query_agree)> 0)
									{
									while($get_one_agree=mysqli_fetch_array($query_agree))
									{ ?>
								    <option value="<?php echo $get_one_agree['agreement_no'];?>"><?php echo $get_one_agree['agreement_no'];?></option>

									<?php
									}
									}
									?>
									</select>
									</div>

								</div>
								<div class="row">
								<div class="col-md-5">
								</div>
								<div class="col-md-3">
									<a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_agency"><span class="glyphicon glyphicon-question-ok"></span> Search</a>

									<a href="job_listing_for_admin.php?a=rec1" class="btn btn-primary btn3d"><span class="glyphicon glyphicon-question-ok"></span> View All</a>
									</div>
								</div>
								<br>
								<div id="display_data">
									<table id="example1" class="table table-bordered table-striped" style="width:100%;">
										<thead>
										<tr>
										<th style="text-align:center;">Sr.</th>
										<th style="text-align:center;">Indication</th>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;">Client Name</th>
										<th style="text-align:center;">Client Address</th>
										<th style="text-align:center;">Client Phone</th>
										<th style="text-align:center;">Email</th>
										<th style="text-align:center;">Client Gst No</th>
										<th style="text-align:center;">Client city</th>
										<th style="text-align:center;">Agreement No </th>
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
										$query="select * from job where  `jobisdeleted`='0'";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											$reports_no=$row['report_no'];
											$jobs_no=$row['job_number'];

									?>
											<tr>
											<td><?php echo $count;?></td>
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
											$urls="span_set_rate.php?a=rec2&&report_no=".$reports_no."&&job_no=".$jobs_no;
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
											$urls="span_set_rate_final_bill.php?a=rec2&&report_no=".$row['report_no']."&&job_no=".$row['job_number'];
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
											<td><?php echo $row['agreement_no'];?></td>
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

	<br>
</section>

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
          <td style="width:200px;height:50px;text-align:center;">JOB AVAILABLE IN BILL </td>
		  </tr>

		  <tr>
          <td style="width:200px;height:50px;text-align:center;"><img src="images/admin_light/green.png">GREEN</td>
          <td style="width:200px;height:50px;text-align:center;">JOB AVAILABLE IN DISPATCH</td>
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
</div>

<?php include("footer.php");?>
	<link rel="stylesheet" href="https://www.jquery-az.com/boots/css/bootstrap-multiselect/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="https://www.jquery-az.com/boots/js/bootstrap-multiselect/bootstrap-multiselect.js"></script>
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

	$('#sel_agency_ids').multiselect();
	$('#sel_clients_ids').multiselect();
	$('#sel_auth_names').multiselect();
	$('#agree_nos').multiselect();

	$('#from_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	})
	$('#to_date').datepicker({
	  autoclose: true,
	  format: 'dd-mm-yyyy'
	})

	$(function () {
		$('.select2').select2()
	})
</script>
<script>


	$("#btn_search").click(function(){

					var from_date = $('#from_date').val();
					var to_date = $('#to_date').val();

					var postData = '&from_date='+from_date+'&to_date='+to_date+'&get_by_rece_second=get_by_rece_second';

					$.ajax({
						url : "<?php echo $base_url; ?>search_job_listing.php",
						type: "POST",
						data : postData,
						success: function(data,status,  xhr)
						 {

							$("#display_data").html(data);

						 }

					});
	});

	$(".search_job_by_agency").click(function(){

					var sel_agency_ids = $('#sel_agency_ids').val();
					var sel_clients_ids = $('#sel_clients_ids').val();
					var sel_auth_names = $('#sel_auth_names').val();
					var agree_nos = $('#agree_nos').val();

					if(sel_agency_ids =="" && sel_clients_ids =="" && sel_auth_names =="" && agree_nos =="")
					{
						alert("Please Atlist One select");
						return false;
					}
					var postData = '&type=search_all_job_for_admin&sel_agency_ids='+sel_agency_ids+'&sel_clients_ids='+sel_clients_ids+'&sel_auth_names='+sel_auth_names+'&agree_nos='+agree_nos;

					$.ajax({
						url : "<?php echo $base_url; ?>search_all_job_for_admin.php",
						type: "POST",
						data : postData,
						success: function(data,status,  xhr)
						 {

							$("#display_data").html(data);

						 }

					});
	});


	function deleteData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';

     if (type == 'delete'){

			billData = 'action_type='+type+'&id='+id;

    }
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>delete_ess_bill.php',
        data: billData,
        success:function(msg){
			//alert("kkkkkk");
            if(msg == 'ok'){
                alert('Bill data has been '+statusArr[type]+' successfully.');
                getbills();

				  window.location.href="<?php echo $base_url; ?>view_est_bill.php";

            }else{
                alert('Bill data has been '+statusArr[type]+' successfully.');
				 window.location.href="<?php echo $base_url; ?>view_est_bill.php";
            }
        }
    });
}


	$(document).on("click", ".send_to_second", function () {
				var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=send_job_to_second_reception&clicked_id='+clicked_id,
        success:function(html){
			get_jobs();
        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});

$(document).on("click", ".delete_job", function () {
				var clicked_id = $(this).attr("data-id");


	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=delete_job_by_rec&clicked_id='+clicked_id,
        success:function(html){
			get_jobs();
        }
    });

	},
            cancel: function () {
				return;
            }
			}
        })
});

function get_jobs(){

    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=get_jobing_for_first_reception',
        success:function(html){
            $('#display_data').html(html);
        }
    });
}

</script>
