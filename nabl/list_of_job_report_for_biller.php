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



.btn-warning {
    background-color: #f0ad4e;
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
										<th style="text-align:center;width:1%;">SN</th>
										<th style="text-align:center;">R</th>
										<th style="text-align:center;width:3%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th style="text-align:left;width:1%;">S.R.F. No</th>
										<th style="width:1%;">Bill To
										<select name="search_sel_agency_ids" id="search_bill_to" class="form-control select2" style="height: 55px;background-color: aquamarine;background-color: aquamarine;height: 55px;font-size: 20px;width: 200px;">
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
										</th>
										<th style="text-align:center;width:1%;">Agency</th>
										<th style="text-align:center;width:1%;">Client</th>
										<th style="text-align:center;width:1%;">Tpi</th>
										<th style="text-align:center;width:1%;">pmc</th>
										<th style="text-align:center;width:1%;">Material</th>
										<th style="text-align:center;width:1%;">Sample Date</th>
										<th style="text-align:center;width:1%;">Reporting Date</th>
										<th style="text-align:center;width:1%;">Refernce</th>
										<th style="text-align:center;width:1%;">Name Of Work</th>
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
											$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$sel_agency_id;
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];
											
											$billing_to_id=$row["billing_to_id"];
											$sel_bill_to="select `agency_name` from agency_master where `agency_id`='$billing_to_id'";
											$result_bill =mysqli_query($conn,$sel_bill_to);
											$row_bill =mysqli_fetch_array($result_bill);
											$bill_to=$row_bill["agency_name"];
											
											$name_of_work= strip_tags(html_entity_decode($row["nameofwork"]),"<strong><em>");
											$set_materilas="";
											$sel_final="select * from final_material_assign_master where `trf_no`='$row[trf_no]'";
											$query_final=mysqli_query($conn,$sel_final);
											if(mysqli_num_rows($query_final) > 0)
											{
												while($row_final=mysqli_fetch_array($query_final))
												{
													$sel_mates="select * from material where `id`=".$row_final["material_id"];
													$query_mates=mysqli_query($conn,$sel_mates);
													$row_mates=mysqli_fetch_array($query_mates);
													$set_materilas .= $row_mates["mt_name"].", ";
													
												}
											}
											
											$job_for_eng="SELECT MIN(issue_date) as datings FROM `job_for_engineer` where `trf_no`='$row[trf_no]'";
											$query_eng=mysqli_query($conn,$job_for_eng);
											if(mysqli_num_rows($query_eng) > 0)
											{
												$row_final=mysqli_fetch_assoc($query_eng);
												$reporting_dates=date("d/m/Y",strtotime($row_final["datings"]));
												
											}else{
												$reporting_dates="";
												
											}
											
											if($row["job_owner_eng_and_qm"]=="1")
											{
												$set_pi_class="btn-warning";
											}else
											{
												$set_pi_class="btn-info";
											}
											
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;">
											<input type="checkbox" name="chk_tfr" class="chk_tfr" value="<?php echo $row["trf_no"]; ?>">
											</td>
											
											<td style="text-align:center;">
											<a href="edit_only_trf_by_biller.php?trf_no=<?php echo $row['trf_no'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title=""><span class="fa fa-edit"></span></a>
											
											<a href="span_set_rate_merging_perfoma.php?chk_array=<?php echo $row['trf_no'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn <?php echo $set_pi_class;?>" title=""><span class="glyphicon glyphicon-question-list"></span> PI</a>
											
											<a href="print_trf.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-success" title="" target="_blank"><span class="fa fa-tripadvisor"></span></a>
											</td>
											
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $bill_to;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["agency_name"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["clientname"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['tpi_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['pmc_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $set_materilas;?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php
											$date=date_create($row['sample_rec_date']);
											echo date_format($date,"d/m/Y");
											?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $reporting_dates;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['refno'];?></td>
											<td style="white-space:nowrap;text-align:left;"><?php echo $row['nameofwork'];?></td>
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
		<div class="row">
			<div class="col-xl-12 text-center">
				<a href="javascript:void(0);" class="btn btn-danger btn-lg   merging_perfoma text-center" title="Merge"><span class="glyphicon glyphicon-question-ok"></span> JOB MERGE</a>	
			</div>
		</div>
		
</section>


</div>
  
	
<?php include("footer.php");?>
	  	  
<script>
$(document).ready(function(){
	var table = $('#example2').DataTable( {
        'autoWidth': true,
		'scrollX': true,
		"lengthMenu": [[100, 200, 250, -1], [100, 200, 250, "All"]],
		buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
		
    });
	var table = $('#example3').DataTable( {
        'autoWidth': true,
		'scrollX': true,
		
		
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
	
$(document).on("click", ".merging_perfoma_non_nabl", function () {
					
		var chk_array = [];
		var temporary_trf_array = [];
        var oTable = $("#example3").dataTable();      
	 $(".chk_trf_non_nabl:checked", oTable.fnGetNodes()).each(function() {
		 var splited_values= $(this).val();
		 var res = splited_values.split("|");
		 chk_array.push(res[0]);      
		 temporary_trf_array.push(res[1]);      
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
			window.location.href="<?php echo $base_url; ?>non_nabl_span_set_rate_merging_perfoma.php?chk_array="+chk_array+"&&temporary_trf_no="+temporary_trf_array;
			},
			cancel: function () {
					return;
				}
				}
			})
	});
	
	
	
$(document).on("change", "#search_bill_to", function () {
					
		var search_bill_to = $('#search_bill_to').val(); 
	  
					
	if(search_bill_to =="")
	{
		alert("Please Select Bill To");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&search_bill_to='+search_bill_to;
			
		$.ajax({
			url : "<?php echo $base_url; ?>search_billing_to.php",
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
	
$(document).on("change", "#chk_all", function () {
					
		if ($(this).is(':checked')) 
		{
         
		  $(".chk_tfr").attr('checked',true);
        }
		else
		{
		  $(".chk_tfr").attr('checked', false);
		}
	});
</script>