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
   
  
<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			
		<div class="row">
		
		<h1 style="text-align:center;">
		Under Process Inward
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
								<div class="col-md-12" style="text-align: center;">
									<a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_rec" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> Search</a>
									<a href="javascript:void(0);" class="btn btn-primary" onclick="location.reload()" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> View All</a>
								</div>
							</div>
						</div>
						<div id="display_data_third">
								<table id="example3" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Action<span style="color:white;">...............................................</span></th>
										<th style="text-align:left;width:20px; !important">SN</th>
										<th style="text-align:center;width:30px;">S.R.F. No</th>
										<th style="text-align:center;width:50px;">Agency</th>
										<th style="text-align:center;width:30px;">Client</th>
										<th style="text-align:center;width:30px;">Material</th>
										<th style="text-align:center;width:20px;">Tpi</th>
										<th style="text-align:center;width:30px;">pmc</th>
										<th style="text-align:center;width:20px;">Sample Date</th>
										<th style="text-align:center;width:20px;">Reporting Date</th>
										<th style="text-align:center;width:20px;">Refernce</th>
										<th style="text-align:center;width:20px;">Name Of Work</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										
										$query="select * from job WHERE `jobisdeleted`=0 AND `any_report_done_by_any_qm`='0'AND `jobcreatedby_id`='$_SESSION[u_id]' ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											//if($row["appoved_by_qm_to_print"] =="1" || $row["appoved_by_qm_to_print"] =="2")
											//{
											$count++;
											if($row["agency"]!= ""){
											$sel_agency="select * from agency_master where `isdeleted`=0 and `agency_id`=".$row["agency"];
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
											
											$set_materilas="";
											$sel_final="select * from final_material_assign_master where `trf_no`='$row[trf_no]' AND `temporary_trf_no`='$row[temporary_trf_no]'";
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
									
									?>
											<tr>
											<td style="text-align:center;">
											<a href="print_trf.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title="VIEW TRF" target="_blank"><span class="fa fa-tripadvisor"></span> </a>
											
											<a href="edit_client_form.php?trf_no=<?php echo $row['job_id'];?>" class="btn btn-primary" title="EDIT INWARD"><span class="fa fa-edit"></span></a>
											
											<?php //if($row['scan_document'] !=""){?>
											<a href="<?php echo $base_url."scan_document/".$row['scan_document'] ?>" class="btn btn-primary" title="VIEW LETTER" target="_blank"><span class="fa fa-eye"></span></a>
											
											<?php //}?>
											<?php if($row['set_url'] =="1" && $row['nabl_type'] =="nabl"){?>
											<a href="update_span_material_assigning.php?temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title="EDIT MATERIAL"><span class="fa fa-list"></span></a>
											<?php }
											if($row["set_url"]=="0"  && $row['nabl_type'] =="nabl"){ ?>
													<a href="set_ulr_no.php?temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title="Material Assign"><span class="glyphicon glyphicon-question-list"></span> set ulr</a>
												
												<?php } 
												if($row['nabl_type'] =="non_nabl"){?>
											<a href="update_span_material_assigning.php?temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title="EDIT MATERIAL"><span class="fa fa-list"></span></a>
											<?php }
												?>
											<a href="javascript:void(0);" class="btn btn-danger delete_job_all" data-id="<?php echo $row['trf_no'];?>" title="DELETE JOB" ><span class="fa fa-trash"></span></a>
											
											</td>
											
											<td style="text-align:left;width:50px;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;width:50px;"><?php echo $row["agency_name"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["clientname"];?></td>
											<td style="white-space:nowrap;text-align:left;"><?php echo $set_materilas;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['tpi_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['pmc_name'];?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php
											$date=date_create($row['sample_rec_date']);
											echo date_format($date,"d/m/Y");
											?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php
											$date=date_create($row['date']);
											echo date_format($date,"d/m/Y");
											?>
											</td>
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
    $(document).ready(function() {
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
    } );
	
	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
    } );
	
	var table = $('#example3').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		"pageLength": 100
    } );
 } );

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


	
	
	
	


	$(document).on("click", ".send_to_perfoma", function () {
				var clicked_id = $(this).attr("data-id");  
				var split_clicked= clicked_id.split("|");
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job To Perfoma?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=send_to_perfoma&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>job_listing_for_second_reception.php";
		}
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});


$(document).on("click", ".delete_job_all", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "All Data For This Job Will Delete, Are You Really Sure To Delete This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=delete_all_job_by_rec&clicked_id='+clicked_id,
		dataType:'JSON',
        success:function(data){
			if(data.status=="1"){
				alert(data.msg);
			}else{
				alert(data.msg);
				window.location.href="<?php echo $base_url; ?>progress_job_list_for_rec.php";
			}
		}
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});



function get_save_material(){
		
    $.ajax({
        type: 'POST',
		dataType:'JSON',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=get_jobing_after_send_perfoma',
        success:function(html){
            $('#display_data_second').html(html.for_update_part);
            $('#display_data_third').html(html.for_perfoma_part);
        }
    });
}

//Work FOr Send Estimate to lab
 $(document).on("click", ".send_to_lab", function () {
	var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job To Submit?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=send_estimate_to_lab&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>job_listing_for_second_reception.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

 $(document).on("click", ".reward_save_material", function () {
	var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Reward To Update?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=reward_save_material&clicked_id='+clicked_id,
        success:function(html){
			get_save_material();
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

$(document).on("click", ".delete_the_jobs", function () {
	var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=delete_the_jobs&clicked_id='+clicked_id,
        success:function(html){
		window.location.href="<?php echo $base_url; ?>job_listing_for_second_reception.php";
			
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
			url : "<?php echo $base_url; ?>seach_progress_job_by_rec.php",
			type: "POST",
			data : postData,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success: function(data,status,  xhr)
			{
				document.getElementById("overlay_div").style.display="none";
				$("#display_data_third").html(data);
			}
			}); 
});
</script>
