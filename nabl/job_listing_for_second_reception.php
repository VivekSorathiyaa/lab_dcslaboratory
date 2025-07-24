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
		Material Selection
		</h1>
	</div>
	<div class="row m-0">
			<div class="col-xs-12">
				<div class="box box-info">
					
					<!-- /.box-header -->
						
						
							<div class="box-body">
							<div id="display_data">
									<table id="example1" class="table table-bordered table-striped" style="width:100%;">
										<thead>
										<tr>
											<th style="text-align:center;">Serial No</th>
											<th style="text-align:center;">Agency Name</th>
											<th style="text-align:center;">Sample Receive Date</th>
											<th style="text-align:center;">Token No.</th>
											<th style="text-align:center;">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$count=0;
											$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 0 AND `jobcreatedby_id`='$_SESSION[u_id]' AND `morr`='r' ORDER BY job_id DESC";
											$result=mysqli_query($conn,$query);
											while($row=mysqli_fetch_array($result))
											{
												$count++;
												
												if($row["re_generate"]=="yes")
												{
													$set_c="color:blue;font-weight:bold;";
												}else{
													$set_c="";
												}
												
										?>
												<tr style="<?php echo $set_c;?>">
												<td style="text-align:center;"><?php echo $count;?></td>
												<td style="text-align:center;"><?php echo $row["agency_name"];?></td>
												<td style="white-space:nowrap;text-align:center;">
												<?php
												$date=date_create($row['sample_rec_date']);
												echo date_format($date,"d/m/Y");
												?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row['temporary_trf_no'];?></td>
												<td style="text-align:center;">
												
												<a href="edit_client_form.php?trf_no=<?php echo $row['job_id'];?>" class="btn btn-warning" title="Edit Job"><span class="glyphicon glyphicon-question-list"></span> Edit</a>
												&nbsp;
												
												<a href="span_material_assigning.php?temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title="Material Assign"><span class="glyphicon glyphicon-question-list"></span> Material Selection</a>
												&nbsp;
												<?php if($row['scan_document'] !=""){?>
												<a href="<?php echo $base_url."scan_document/".$row['scan_document'] ?>" class="btn btn-success" title="Downlaod Document" download><span class="glyphicon glyphicon-question-downlaod"></span> Download</a>
												
											<?php }?>
											
											<a href="javascript:void(0);" class="btn btn-danger job_delete_before_slection" data-id="<?php echo $row['temporary_trf_no'];?>" title="Send to Perfoma Invoice"><span class="glyphicon glyphicon-question-ok"></span> Delete</a>
											
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
			
			<!--------Second-------->
	<div class="row m-0">
			
			<h1 style="text-align:center;">
			Material Update
			</h1>
	</div>
	<div class="row m-0">
			<div class="col-xs-12">
				<div class="box box-info">
					
				
						
						
							<div class="box-body">
							<div id="display_data_second">
									<table id="example2" class="table table-bordered table-striped" style="width:100%;">
										<thead>
										<tr>
											<th style="text-align:center;">Serial No</th>
											<th style="text-align:center;">Agency Name</th>
											<th style="text-align:center;">Type</th>
											<th style="text-align:center;">S.R.F. No</th>
											<th style="text-align:center;">Receive Sample Date</th>
											<th style="text-align:center;">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$count=0;
											$query="select * from save_material_assign WHERE `is_deleted`=0 AND `isstatus`=1  ORDER BY sm_id DESC";
											$result=mysqli_query($conn,$query);
											while($row=mysqli_fetch_array($result))
											{
												$query_job="select * from job WHERE `jobisdeleted`=0 AND `temporary_trf_no`='$row[temporary_trf_no]'";
												$result_jobs=mysqli_query($conn,$query_job);
												$row_jobs=mysqli_fetch_array($result_jobs);
												
												$count++; 
												
										?>
												<tr>
												<td style="text-align:center;"><?php echo $count;?></td>
												<td style="text-align:center;"><?php echo $row_jobs["agency_name"];?></td>
												<td style="text-align:center;"><?php if($row["nabl_type"]=="nabl"){ echo "NABL";}else{ echo "NON NABL";}?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
												<td style="white-space:nowrap;text-align:center;">
												<?php
												$date=date_create($row['created_date']);
												echo date_format($date,"d/m/Y");
												?></td>
												<td style="text-align:center;">
												
												
												<a href="update_span_material_assigning.php?temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-primary" title="Material Assign"><span class="glyphicon glyphicon-question-list"></span> Edit</a>
												
												<a href="javascript:void(0);" class="btn btn-success send_to_perfoma" data-id="<?php echo $row['sm_id'];?>" title="Send to Perfoma Invoice"><span class="glyphicon glyphicon-question-ok"></span> Submit</a>
												</td>
											</tr>
										<?php
											}	
										?>
									</tbody>
									
								</table>
									
								</div>
								
								
							</div>
					
					</div>
				</div>
	</div>

			
	<div class="row m-0">
			
			<h1 style="text-align:center;">
			Performa Invoice
			</h1>
	</div>
	<div class="row m-0">
			<div class="col-xs-12">
				<div class="box box-info">
					
					<!-- /.box-header -->
						
						
							<div class="box-body">
							<div id="display_data_third">
									<table id="example3" class="table table-bordered table-striped" style="width:100%;">
										<thead>
										<tr>
											<th style="text-align:center;">Action<span style="color:white;">_______________________________</span></th>
											<th style="text-align:center;">SN</th>
											<th style="text-align:center;">S.R.F. No</th>
											<th style="text-align:center;">Agency Name</th>
											<th style="text-align:center;">Client Name</th>
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
											$query="select * from save_material_assign WHERE `is_deleted`=0 AND `isstatus`=2 AND `created_by`='$_SESSION[u_id]'  ORDER BY sm_id DESC";
													
											$result=mysqli_query($conn,$query);
											while($row=mysqli_fetch_array($result))
											{
												$count++;
											$query_ref_no="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$row[trf_no]' AND `temporary_trf_no`='$row[temporary_trf_no]'";
											$result_ref_no=mysqli_query($conn,$query_ref_no);
											$row_ref_no=mysqli_fetch_array($result_ref_no);
											
											$sel_agency_id = $row_ref_no["agency"];
											$agency_name = 'N/A'; // Default if no agency ID or agency not found

											if (!empty($sel_agency_id)) {
												$sel_agency = "SELECT * FROM agency_master WHERE `isdeleted` = 0 AND `agency_id` = " . intval($sel_agency_id);
												$result_agency = mysqli_query($conn, $sel_agency);

												if ($result_agency && mysqli_num_rows($result_agency) > 0) {
													$row_agency = mysqli_fetch_array($result_agency);
													$agency_name = $row_agency["agency_name"];
												}
											}

											
											
											if($row_ref_no["client_code"] !="")
											{
											$sel_client="select * from client where `clientisdeleted`=0 AND `client_code`='$row_ref_no[client_code]'";
											$result_client =mysqli_query($conn,$sel_client);
											$row_client =mysqli_fetch_array($result_client);
											$client_name=$row_client["clientname"];
											}
											else
											{
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
												<a href="javascript:void(0);" class="btn btn-danger delete_the_jobs" data-id="<?php echo $row['sm_id']."|".$row['trf_no']."|".$row['job_no']."|".$row['temporary_trf_no'];?>" title="DELETE JOB" ><span class="fa fa-trash"></span></a>
												
												<a href="print_trf.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_no'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-success" title="PRINT TRF" target="_blank"><span class="fa fa-tripadvisor"></span></a>
												
												
												<a href="print_job_card.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_no'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-success" title="PRINT JOB CARD" target="_blank"><i class="fa fa-credit-card" aria-hidden="true"></i></a>
												<a href="print_sample_token.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_no'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-success" title="" target="_blank"><i class="fa fa-tag" aria-hidden="true"></i></a>
												
												<a href="print_receipt.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_no'];?>&&temporary_trf_no=<?php echo $row['temporary_trf_no'];?>" class="btn btn-success" title="PRINT RECEIPT" target="_blank"><i class="fa fa-address-card" aria-hidden="true"></i></a>
												
												<a href="javascript:void(0);" class="btn btn-success send_to_lab" data-id="<?php echo $row['sm_id']."|".$row['trf_no']."|".$row['job_no']."|".$row['temporary_trf_no'];?>" title="SUBMIT JOB" ><span class="fa fa-arrow-circle-right"></span></a>
											</td>
												<td style="text-align:center;"><?php echo $count;?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $client_name;?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row_ref_no['tpi_name'];?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row_ref_no['pmc_name'];?></td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $set_materilas;?></td>
												<td style="white-space:nowrap;text-align:center;">
												<?php
												$date=date_create($row_ref_no['sample_rec_date']);
												echo date_format($date,"d/m/Y");
												?></td>
												<td style="white-space:nowrap;text-align:center;">-</td>
												<td style="white-space:nowrap;text-align:center;"><?php echo $row_ref_no['refno'];?></td>
												<td style="white-space:nowrap;text-align:left;"><?php echo $row_ref_no['nameofwork'];?></td>
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
		beforeSend: function(){
			document.getElementById("overlay_div").style.display="block";
		},
        success:function(html){
			document.getElementById("overlay_div").style.display="none";
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

$(document).on("click", ".job_delete_before_slection", function () {
				var clicked_id = $(this).attr("data-id");  
				var split_clicked= clicked_id.split("|");
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=job_delete_before_slection&clicked_id='+clicked_id,
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
        content: "Are You Sure To Send This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=send_estimate_to_lab&clicked_id='+clicked_id,
		beforeSend: function(){
			document.getElementById("overlay_div").style.display="block";
		},
        success:function(html){
			document.getElementById("overlay_div").style.display="none";
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
		beforeSend: function(){
			document.getElementById("overlay_div").style.display="block";
		},
        success:function(html){
		document.getElementById("overlay_div").style.display="none";
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
</script>
