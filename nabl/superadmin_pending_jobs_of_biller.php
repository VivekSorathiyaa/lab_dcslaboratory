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


<section class="content"  style="padding: 0px;
     margin-right: auto;
     margin-left: auto;
     padding-left: 0px;
     padding-right: 0px; ">
			<?php include("menu.php") ?>

		<div class="row">

		<h1 style="text-align:center;">
		List Of Arrival Jobs
		</h1>
	</div>
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">

				       <div class="box-body">
					   <a data-toggle="collapse" href="#collapse1" class="btn btn-primary" style="margin-left:45%;width:3%;;" id="add_material_button"><i class="fa fa-search" aria-hidden="true"></i></a>
						<br>
						<br>
						<div id="collapse1" class="panel-collapse collapse">
							<div class="row">
									<div class="col-md-3">
									<label>Agency:</label>
									</div>
									<div class="col-md-3">
									<label>Name Of Work:</label>
									</div>
									<div class="col-md-3">
									<label>Reference No:</label>
									</div>
									<div class="col-md-3">
									<label>Agreement No:</label>
									</div>
							</div>
							<div class="row">
							     <div class="col-md-3">
									<select name="search_sel_agency_ids" id="search_sel_agency_ids" class="form-control select2" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 230px;">
									<option value="">Select-Agency</option>
									<?php
									$sel_agencys="select `agency_id`,`agency_name` from agency_master where `isdeleted`=0";
									$query_agencys = mysqli_query($conn, $sel_agencys);
									if(mysqli_num_rows($query_agencys)> 0)
									{
									while($get_one_agency=mysqli_fetch_array($query_agencys))
									{ ?>
								    <option value="<?php echo $get_one_agency['agency_id'];?>"><?php echo $get_one_agency['agency_name'];?></option>
									<?php } }?>
									</select>
								 </div>
								 <div class="col-md-3">
									<input type="text" name="search_n_o_w" id="search_n_o_w" placeholder="Enter Name Of Work" class="form-control">
								 </div>

								 <div class="col-md-3">
									<input type="text" name="search_ref_no" id="search_ref_no" placeholder="Enter Reference No" class="form-control">
								 </div>

								 <div class="col-md-3">
									<input type="text" name="search_agree_no" id="search_agree_no" placeholder="Enter Agreement No" class="form-control">
								 </div>
							</div>

							<div class="row">
									<div class="col-md-3">
									<label>Client:</label>
									</div>
							</div>
							<div class="row">
							     <div class="col-md-3">
									<select name="search_sel_client_code" id="search_sel_client_code" class="form-control select2" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 230px;">
									<option value="">Select-Clent</option>
									<?php
									$sel_clients="select `client_code`,`clientname` from client where `clientisdeleted`=0";
									$query_clients = mysqli_query($conn, $sel_clients);
									if(mysqli_num_rows($query_clients)> 0)
									{
									while($get_one_client=mysqli_fetch_array($query_clients))
									{ ?>
								    <option value="<?php echo $get_one_client['client_code'];?>"><?php echo $get_one_client['clientname'];?></option>
									<?php } }?>
									</select>
								 </div>
							</div>
							<div class="row">
								<div class="col-md-5">
								</div>
								<div class="col-md-3">
									<a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_agency" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> Search</a>
									<a href="javascript:void(0);" class="btn btn-primary" onclick="location.reload()" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> View All</a>
								</div>
							</div>
						</div>
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">R</th>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">S.R.F. No</th>
										<th style="text-align:center;">Job No</th>
										<th style="text-align:center;">Client Name</th>
										<th style="text-align:center;">Reference No</th>
										<th style="text-align:center;">Agency No</th>
										<th style="text-align:center;">Name of Work</th>
										<th style="text-align:center;">Agreement No</th>
										<th style="text-align:center;">Received sample Date</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from job WHERE `jobisdeleted`=0 AND `job_for_rec_and_biller`=1 AND `perfoma_completed_by_biller`=0 ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											$sel_agency_id=$row["agency"];
											$sel_agency="select * from agency_master where `agency_id`=".$sel_agency_id;
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];

											$sel_client_code=$row["client_code"];
											$sel_client="select `clientname` from client where `client_code`='$sel_client_code'";
											$result_client =mysqli_query($conn,$sel_client);
											$row_client =mysqli_fetch_array($result_client);
											$client_name=$row_client["clientname"];

											$name_of_work= strip_tags(html_entity_decode($row["nameofwork"]),"<strong><em>");

									?>
											<tr>
											<td style="text-align:center;">
											<input type="checkbox" name="chk_tfr" class="chk_tfr" value="<?php echo $row["trf_no"]; ?>">
											</td>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['job_number'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $client_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['refno'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo substr($name_of_work,0,20);?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['agreement_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php
											$date = new DateTime($row['sample_rec_date']);
											echo $date->format('d-m-Y');
											?></td>
											<td style="text-align:center;">

											<a href="span_set_rate_merging_perfoma.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> perfoma</a>
											&nbsp;

											<a href="span_perfoma_excel_upload.php?chk_array=<?php echo $row['trf_no'];?>" class="btn btn-warning btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Excel Upload</a>
											&nbsp;
											<a href="print_trf.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
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
<div class="row">
			<div class="col-lg-12 text-center">
				<a href="javascript:void(0);" class="btn btn-danger btn-lg   merging_perfoma" title="Merge"><span class="glyphicon glyphicon-question-ok"></span> PERFOMA MERGE</a>
			</div>
		</div>


</div>


<?php include("footer.php");?>

<script>
$(document).ready(function(){
	var table = $('#example2').DataTable( {
        'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [

            { extend: 'excel',
			  footer: true,
			}
        ],
    });
    $(function () {
		$('.select2').select2();
	})
});


$(".search_job_by_agency").click(function()
{

	var sel_agency_ids = $('#search_sel_agency_ids').val();
	var search_sel_client_code = $('#search_sel_client_code').val();
	var search_ref_no = $('#search_ref_no').val();
	var search_agree_no = $('#search_agree_no').val();
	var search_n_o_w = $('#search_n_o_w').val();

	if(sel_agency_ids =="" && search_ref_no =="" && search_agree_no =="" && search_n_o_w =="" && search_sel_client_code =="")
	{
		alert("Please Atlist One select");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&sel_agency_ids='+sel_agency_ids+'&search_ref_no='+search_ref_no+'&search_agree_no='+search_agree_no+'&search_n_o_w='+search_n_o_w+'&search_sel_client_code='+search_sel_client_code;

		$.ajax({
			url : "<?php echo $base_url; ?>search_list_of_job_report_for_biller.php",
			type: "POST",
			data : postData,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success: function(data,status,  xhr)
			{
				document.getElementById("overlay_div").style.display="none";
				$("#display_data_report").html(data);
			}
			});
});





$(document).on("click", ".merging_perfoma", function () {

		var chk_array = [];
        var oTable = $("#example2").dataTable();
	 $(".chk_tfr:checked", oTable.fnGetNodes()).each(function() {
		 chk_array.push($(this).val());
		 });

		if (chk_array.length === 0) {
			alert("Please Select Atlist One Record");
			return false;
		}


		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To Merge Selected Perfoma ?",
			buttons: {
			confirm: function ()
			{
			window.location.href="<?php echo $base_url; ?>span_set_rate_merging_perfoma.php?chk_array="+chk_array;
			},
			cancel: function () {
					return;
				}
				}
			})
	});
</script>
