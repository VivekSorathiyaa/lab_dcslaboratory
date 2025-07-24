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





.disabled{
  pointer-events: none;
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
			<!--<div class="row">
		
		<h1 style="text-align:center;">
		View Reports
		</h1>
	</div>-->
<div class="row">
				
		<div class="row">
		
		<h1 style="text-align:center;">
		View Completed Jobs For Reception
		</h1>
	</div>		
	<div class="row m-0">
        <div class="col-xs-12">
			<div class="box box-info">
				
				<!-- /.box-header -->
					
					
						<div class="box-body">
						<a data-toggle="collapse" href="#collapse1" class="btn btn-primary" style="margin-left:45%;width:3%;;" id="add_material_button"><i class="fa fa-search" aria-hidden="true"></i></a>
						<br>
						<br>
						<div id="collapse1" class="panel-collapse collapse">
							<div class="row">
									<div class="col-md-2">
									<label>S.R.F. No:</label>
									</div>
									<div class="col-md-2">
									<label>SAMPLE DATE:</label>
									</div>
									<div class="col-md-2">
									<label>SAMPLE MONTH:</label>
									</div>
									<div class="col-md-2">
									<label>AGENCY NAME:</label>
									</div>
									<div class="col-md-2">
									<label>CLIENT NAME:</label>
									</div>
									<div class="col-md-2">
									<label>PMC NAME:</label>
									</div>
							</div>
							<div class="row">
							    <div class="col-md-2">
									<input type="text" name="search_trf_no" id="search_trf_no" placeholder="Enter S.R.F. No" class="form-control">
								 </div>
								 
								 <div class="col-md-2">
									<input type="text" name="search_sam_date" id="search_sam_date" placeholder="Enter Date in (Y-m-d) Format" class="form-control">
								 </div>
								 
								 <div class="col-md-2">
									<select id="search_sam_month" class="form-control">
										<option value="">Select Month</option>
										<option value="01">01</option>
										<option value="02">02</option>
										<option value="03">03</option>
										<option value="04">04</option>
										<option value="05">05</option>
										<option value="06">06</option>
										<option value="07">07</option>
										<option value="08">08</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
								 </div>
								 
								 <div class="col-md-2">
									<input type="text" name="search_agency_name" id="search_agency_name" placeholder="Enter Agency Name" class="form-control">
								 </div>
								 
								 <div class="col-md-2">
									<input type="text" name="search_client_name" id="search_client_name" placeholder="Enter Client Name" class="form-control">
								 </div>
								 
								 <div class="col-md-2">
									<input type="text" name="search_pmc_name" id="search_pmc_name" placeholder="Enter Pmc Name" class="form-control">
								 </div>
								 
								 
							</div>
							<br>
							<div class="row">
							    <div class="col-md-2">
									<label>TPI NAME:</label>
									<input type="text" name="search_tpi_name" id="search_tpi_name" placeholder="Enter Tpi Name" class="form-control">
								 </div>
								 
							</div>
							
							<div class="row">
								<div class="col-md-5">
								</div>
								<div class="col-md-3">
									<a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_rec" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> Search</a>
									<a href="javascript:void(0);" class="btn btn-primary" onclick="location.reload()" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> View All</a>
								</div>
							</div>
						</div>
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;width:1%;">SN</th>
										<th style="text-align:center;width:1%;">Action<span style="color:white;">___________________</span></th>
										<th style="text-align:left;width:1%;">S.R.F. No</th>
										<th style="text-align:center;width:1%;">Agency</th>
										<th style="text-align:center;width:1%;">Client</th>
										<th style="text-align:center;width:1%;">Material</th>
										<th style="text-align:center;width:1%;">Tpi</th>
										<th style="text-align:center;width:1%;">pmc</th>
										<th style="text-align:center;width:1%;">Sample Date</th>
										<th style="text-align:center;width:1%;">Reporting Date</th>
										<th style="text-align:center;width:1%;">Refernce</th>
										<th style="text-align:center;width:1%;">Name Of Work</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `any_report_done_by_any_qm`='1' AND `accepted_by_qm`=1 AND `job_owner_eng_and_qm`=2 AND `appoved_by_qm_to_print`=1 AND `job_sent_to_qm`=1 AND `job_owner_qm_and_biller`=1 AND `jobcreatedby_id`='$_SESSION[u_id]'  ORDER BY job_id DESC LIMIT 0,200";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											//if($row["appoved_by_qm_to_print"] =="1" || $row["appoved_by_qm_to_print"] =="2")
											//{
											$count++;
											
											if($row["agency"]!= ""){
											$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$row["agency"];
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];
											}else{
												$agency_name="";
											}
											
											if($row["client_code"] !=""){
											$sel_client="select * from client where `clientisdeleted`=0 and `client_code`='$row[client_code]'";
											$result_client =mysqli_query($conn,$sel_client);
											$row_client =mysqli_fetch_array($result_client);
											$client_name=$row_client["clientname"];
											}else{
												$client_name="";
											}
											
											$obs_link="";
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
													$obs_link= $row_final["upload_obs"];
													
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
											
											
									
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;">
											<?php if($row["morr"]=="r")
											{ ?>
											<!--<a href="view_job_by_reception.php?trf_no=<?php //echo $row['trf_no'];?>&&job_no=<?php// echo $row['job_number'];?>" class="btn btn-primary" title="View Job"><span class="fa fa-truck"></span></a>-->
											
											<a href="download_data.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title="View Job"><span class="fa fa-print"></span></a>
											
											<a href="print_trf.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title="VIEW TRF" target="_blank"><span class="fa fa-tripadvisor"></span> </a>
											<a href="print_job_card.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-success" title="VIEW JOB CARD" target="_blank"><i class="fa fa-credit-card" aria-hidden="true"></i></a>
												<a href="print_sample_token.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-success" title="" target="_blank"><i class="fa fa-tag" aria-hidden="true"></i></a>
												
												<a href="print_receipt.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-success" title="VIEW RECEIPT" target="_blank"><i class="fa fa-address-card" aria-hidden="true"></i></a>
												
											
											<?php //if($row['scan_document'] !=""){?>
											<a href="<?php echo $base_url."scan_document/".$row['scan_document'] ?>" class="btn btn-primary" title="VIEW LETTER" target="_blank"><span class="fa fa-eye"></span></a>
											
											<?php //}?>
											<?php
											//if($row["is_scan"]=="1"){?>
											<a href="view_scan_by_trf_no.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title="SCAN"><span class="fa fa-qrcode"></span></a>
											<?php
											//} 
											} 
											?>
												<a href="upload_wriiten_obs/<?php echo $obs_link;?>" class="btn btn-primary" target="_blank" title="VIEW DOCUMENT">OBS.</a>
											</td>
										
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["agency_name"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["clientname"];?></td>
											<td style="white-space:nowrap;text-align:left;"><?php echo $set_materilas;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['tpi_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['pmc_name'];?></td>
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
										//}	
										
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
$(document).ready(function(){
	
	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		//buttons: [ 'copy' ], dom: 'Bfrtip',
		//buttons: [
			
         //   { extend: 'excel',
		//	  footer: true,
		//	}
       // ],
		"pageLength": 1000
    } );

});

$(document).on("click", ".dispatch_jobs_by_reception", function () {
	var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Completed this job after Report Dispatched?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=dispatch_jobs_by_reception&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_completed_job_report_for_reception.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

$(".search_job_by_rec").click(function()
{
					
	var search_trf_no = $('#search_trf_no').val(); 
	var search_sam_date = $('#search_sam_date').val(); 
	var search_sam_month = $('#search_sam_month').val(); 
	var search_agency_name = $('#search_agency_name').val(); 
	var search_client_name = $('#search_client_name').val(); 
	var search_pmc_name = $('#search_pmc_name').val(); 
	var search_tpi_name = $('#search_tpi_name').val(); 
					
	if(search_trf_no =="" && search_sam_date =="" && search_agency_name =="" && search_client_name =="" && search_pmc_name =="" && search_tpi_name =="" && search_sam_month =="")
	{
		alert("Please Atlist One select");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&search_trf_no='+search_trf_no+'&search_sam_date='+search_sam_date+'&search_agency_name='+search_agency_name+'&search_client_name='+search_client_name+'&search_pmc_name='+search_pmc_name+'&search_tpi_name='+search_tpi_name+'&search_sam_month='+search_sam_month;
			
		$.ajax({
			url : "<?php echo $base_url; ?>search_list_of_completed_job_report_for_reception.php",
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
</script>
