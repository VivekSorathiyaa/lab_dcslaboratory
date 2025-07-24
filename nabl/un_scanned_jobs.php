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
		Pending List For Scan
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
									<div class="col-md-3">
									<label>&nbsp;</label>
									</div>
									<div class="col-md-3">
									<label>S.R.F. No:</label>
									</div>
									<div class="col-md-3">
									<label>SAMPLE DATE:</label>
									</div>
									<div class="col-md-3">
									<label>&nbsp;</label>
									</div>
							</div>
							<div class="row">
							     <div class="col-md-3">&nbsp;</div>
								 <div class="col-md-3">
									<input type="text" name="search_trf_no" id="search_trf_no" placeholder="Enter S.R.F. No" class="form-control">
								 </div>
								 
								 <div class="col-md-3">
									<input type="text" name="search_sam_date" id="search_sam_date" placeholder="Enter Date in (Y-m-d) Format" class="form-control">
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
										<th style="text-align:center;width:5%;">Action<span style="color:white;">...................</span></th>
										<th style="text-align:left;width:1%;">S.R.F. No</th>
										<th style="text-align:left;width:1%;">Report No</th>
										<th style="text-align:center;width:1%;">Agency</th>
										<th style="text-align:center;width:1%;">Email</th>
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
										
										//$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `any_report_done_by_any_qm`='1'  AND `is_scan`='0' AND `jobcreatedby_id`='$_SESSION[u_id]' AND `accepted_by_qm`=1,`job_owner_eng_and_qm`=2,`appoved_by_qm_to_print`=1, job_sent_to_qm=1, job_owner_qm_and_biller=1  ORDER BY job_id DESC LIMIT 0,100";
										
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `any_report_done_by_any_qm`='1'  AND `is_scan`='0' AND `jobcreatedby_id`='$_SESSION[u_id]' ORDER BY job_id DESC LIMIT 0,100";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											//if($row["appoved_by_qm_to_print"] =="1" || $row["appoved_by_qm_to_print"] =="2")
											//{
											$count++;
											
											$billing_to_id=$row["billing_to_id"];
											$sel_agency_for_bill_to="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$row["billing_to_id"];
											$result_agency_for_bill_to =mysqli_query($conn,$sel_agency_for_bill_to);
											$row_agency_for_bill_to =mysqli_fetch_array($result_agency_for_bill_to);
											$agency_email=$row_agency_for_bill_to["agency_email"];
											$agency_name_email=$row_agency_for_bill_to["agency_name"];
											
											
											if($row["agency"]!= ""){
											$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$row["agency"];
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];
											}else{
												$agency_name="";
											}
											
											if($row["client_code"] !=""){
											$sel_client="select * from agency_master where `isdeleted`=0 AND `client_code`='$row[client_code]'";
											$result_client =mysqli_query($conn,$sel_client);
											$row_client =mysqli_fetch_array($result_client);
											$client_name=$row_client["client_name"];
											}else{
												$client_name="";
											}
											
											$set_materilas="";
											$sel_final="select * from final_material_assign_master where `trf_no`='$row[trf_no]' AND `is_scan`='0'";
											$query_final=mysqli_query($conn,$sel_final);
											if(mysqli_num_rows($query_final) > 0)
											{
												while($row_final=mysqli_fetch_array($query_final))
												{
													$sel_mates="select * from material where `id`=".$row_final["material_id"];
													$query_mates=mysqli_query($conn,$sel_mates);
													$row_mates=mysqli_fetch_array($query_mates);
													$set_materilas= $row_mates["mt_name"].", ";
													
												$sel_eng="Select * from job_for_engineer where `lab_no`='$row_final[lab_no]'";
												$query_eng= mysqli_query($conn,$sel_eng);
												if(mysqli_num_rows($query_eng) > 0)
												{
													$get_eng= mysqli_fetch_array($query_eng);	
												if($get_eng["appoved_by_qm_to_print"]==1)
												{
											
											
									
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="">
											<?php
											if($row_final["is_scan"]=="0"){ ?>
											
											<a href="download_data.php?trf_no=<?php echo $row_final['trf_no'];?>&&job_no=<?php echo $row_final['job_no'];?>" class="btn btn-primary" title="ALL REPORTS" target="_blank"><span class="fa fa-id-card"></span></a>
											&nbsp;
											
											<a target = '_blank' href="<?php echo $base_url.'print_report/'?><?php echo $row_mates["print_report"];?>?trf_no=<?php echo $row_final['trf_no']; ?>&&job_no=<?php echo $row_final['job_no']; ?>&&lab_no=<?php echo $row_final['lab_no']; ?>&&report_no=<?php echo $row_final['report_no']; ?>&&ulr=<?php echo $static_ulr.$row_final['ulr_no']."F"; ?>&&tbl_name=<?php echo $row_mates["table_name"];?>" title="ONE REPORTS" class="btn btn-primary" style=""><span class="fa fa-print"></span></a>
											
											&nbsp;&nbsp;&nbsp;
											<input type="file" class="btn-primary form-control uplodings" id="uploads_<?php echo $count;?>" style="width: 35px;font-size: 18px;" multiple >
											<?php }else{ 
											$sel_docs="select * from scanned_trf_document where `report_no`='$row_final[report_no]'";
											$rep_docs=mysqli_query($conn,$sel_docs);
											$results=mysqli_fetch_array($rep_docs);
											$filesed=$results["document"];
											?>
											<a href="scanned_document/<?php echo $filesed;?>" class="btn btn-primary" target="_blank" title="VIEW DOCUMENT"><span class="fa fa-eye"></span></a>
											
											<a href="javascript:void(0);" class="btn btn-danger delete_scaned" data-id="<?php echo $row_final['report_no']."|".$row_final['trf_no'];?>" title="DELETE UPLOADED FILE" ><span class="fa fa-trash"></span></a>
											<?php } ?>
											</td>
										
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row_final['report_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_email;?></td>
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
											<td style="white-space:nowrap;text-align:left;"><?php echo $row['nameofwork'];?>
											<input type="hidden" id="txt_<?php echo $count;?>" value="<?php echo $row_final['report_no'].'|'.$row_final['trf_no'].'|'.$agency_email.'|'.$billing_to_id.'|'.$agency_name_email;?>">
											</td>
										</tr>
									<?php
										//}	
											}
											}
											}
										}
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
		"pageLength": 100
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
					
	if(search_trf_no =="" && search_sam_date =="")
	{
		alert("Please Atlist One select");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&search_trf_no='+search_trf_no+'&search_sam_date='+search_sam_date;
			
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

$(document).on("change", ".uplodings", function () {
                var fd = new FormData();
                var files = $(this)[0].files[0];
				var idss=$(this).attr("id");
				var spliteds= idss.split("_");
				var set_ids= "#txt_"+spliteds[1];
				var txt_boxes= $(set_ids).val();
				
				var spliting= txt_boxes.split("|");
				var	trf_nos= spliting[1];
				
				var acb = $(this).val();
	
		if(acb ==""){
			alert("Please Select File First");
			return false;
		}
               var totalfiles = $(this)[0].files.length;
			   
			   for (var index = 0; index < totalfiles; index++) {
				  
				   var sizes = $(this)[0].files[index].size ;
				   if(sizes < 15728640)
					{
						 fd.append("file[]", $(this)[0].files[index]);
					}
			   }

			   
			   fd.append('action_type', "add");
                fd.append('txt_boxes', txt_boxes);
       
                $.ajax({
                    url: 'save_scanners.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        window.location.href="<?php echo $base_url; ?>un_scanned_jobs.php";
                    },
                });
            });
			
$(document).on("click", ".delete_scaned", function () {
	var clicked_id = $(this).attr("data-id");  
	var spliting= clicked_id.split("|");
    var	trf_nos= spliting[1];
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Uploded Document?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_scanners.php',
        data: 'action_type=delete_scaned&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>un_scanned_jobs.php";
			
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
