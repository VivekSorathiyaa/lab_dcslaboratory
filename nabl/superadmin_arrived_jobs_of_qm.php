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
		View Jobs of Qm
		</h1>
	</div>		
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				
				<!-- /.box-header -->
					
					
						<div class="box-body">
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">S.R.F. No</th>
										<th style="text-align:center;">Job No</th>
										<th style="text-align:center;">Received sample Date</th>
										<!--<th style="text-align:center;">Status</th>-->
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										
										$count=0;
										//$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'r' AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `appoved_by_qm_to_print`=0 AND `job_owner_eng_and_qm`=1 ORDER BY job_id DESC";
										
									     $query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1'  AND `any_report_done_by_any_eng`=1 AND `accepted_by_qm`=0  ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['job_number'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php
											$date = new DateTime($row['sample_rec_date']);
											echo $date->format('d-m-Y');
											?></td>
											
											<td style="text-align:center;">
											
											
											<a href="view_job_by_qlty_manager_for_super_admin.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>&nbsp;
											<!--<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d job_sent_to_eng" data-id="<?php //echo $row['report_no'];?>" title="Report Send To Engineer"><span class="glyphicon glyphicon-question-list"></span> Reward</a>-->
											<?php if($row['accepted_by_qm']==0){
												
											$disabling="";
											$select_job_for_qm="select `accepted_by_qm` from job_for_engineer where `accepted_by_qm`=0 AND `trf_no` ='$row[trf_no]'";
											$query_job_for_qm=mysqli_query($conn,$select_job_for_qm);
											if(mysqli_num_rows($query_job_for_qm) >0)
											{
											   $disabling="disabled";
											}
											
											
											$select_job_for_qm_for_download="select `accepted_by_qm` from job_for_engineer where `accepted_by_qm`=1 AND `trf_no` ='$row[trf_no]'";
											$query_job_for_qm_for_download=mysqli_query($conn,$select_job_for_qm_for_download);
											if(mysqli_num_rows($query_job_for_qm_for_download) >0)
											{ ?>
											   <a href="download_data.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-warning btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> Downlaod</a>&nbsp;
											<?php } ?>
											
											<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d job_send_to_accept <?php echo $disabling;?>" data-id="<?php echo $row['trf_no']."|".$row['job_number'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span> Accept job</a>
											
											<?php }else{ ?>
											
											<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d job_send_to_print" data-id="<?php echo $row['trf_no']."|".$row['job_number'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span>job Send To Print</a>
											
											<?php } ?>
											
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
$(document).ready(function(){
	
	var table = $('#example2').DataTable( {
        'autoWidth': true,
		'scrollX': true,
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

//  start date change

$(document).on('change','.startdate_class',function(){
	var get_start_date= $(this).val();
	var get_id= $(this).attr('id');
	var only_id=get_id.split("_");
	var set_id="#enddate_"+only_id[1];
	var get_end_date= $(set_id).val();
	
	var a = moment(get_start_date,'D/M/YYYY');
	var b = moment(get_end_date,'D/M/YYYY');
	var diffDays = b.diff(a, 'days');
	
	var set_day="#day_"+only_id[1];
	$(set_day).val(diffDays);
	
	var labs_id="#labno_"+only_id[1];
	var get_lab_id=$(labs_id).val();
	
	var material_id="#material_"+only_id[1];
	var get_material_id=$(material_id).val();
	
	var test_id="#testlist_"+only_id[1];
	var get_test_id=$(test_id).val();
	
	var expdate="#expdate_"+only_id[1];
	var get_expdate=$(expdate).val();
	
	var get_report_no= $("#txt_report_no").val();
	var get_job_no= $("#txt_job_no").val();
	
	
	// perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
	update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,get_report_no,get_job_no,get_expdate);
   
});

//  end date change

$(document).on('change','.enddate_class',function(){
	var get_end_date= $(this).val();
	var get_id= $(this).attr('id');
	var only_id=get_id.split("_");
	var set_id="#startdate_"+only_id[1];
	var get_start_date= $(set_id).val();
	
	var a = moment(get_start_date,'D/M/YYYY');
	var b = moment(get_end_date,'D/M/YYYY');
	var diffDays = b.diff(a, 'days');
	
	var set_day="#day_"+only_id[1];
	$(set_day).val(diffDays);
     
	 var labs_id="#labno_"+only_id[1];
	var get_lab_id=$(labs_id).val();
	
	var material_id="#material_"+only_id[1];
	var get_material_id=$(material_id).val();
	
	var test_id="#testlist_"+only_id[1];
	var get_test_id=$(test_id).val();
	
	var expdate="#expdate_"+only_id[1];
	var get_expdate=$(expdate).val();
	
	var get_report_no= $("#txt_report_no").val();
	var get_job_no= $("#txt_job_no").val();
	
	
	// perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
	update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,get_report_no,get_job_no,get_expdate);
});


function update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,get_report_no,get_job_no,get_expdate){
	
	var billData = '&action_type=update_engineer'+'&get_start_date='+get_start_date+'&get_end_date='+get_end_date+'&diffDays='+diffDays+'&get_lab_id='+get_lab_id+'&get_material_id='+get_material_id+'&get_test_id='+get_test_id+'&get_report_no='+get_report_no+'&get_job_no='+get_job_no+'&get_expdate='+get_expdate;
	
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: billData,
        success:function(msg){
          
        }
    });
	
	
}
//send report to accept

$(document).on("click", ".report_send_to_accept", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=report_send_to_accept&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_job_report_for_qm.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

$(document).on("click", ".job_sent_to_eng", function () {
				var clicked_id = $(this).attr("data-id");  
				//var txt_report_no= $("#txt_report_no").val();
				//var job_no= $("#txt_job_no").val();
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=job_sent_to_eng&clicked_id='+clicked_id,
        success:function(html){
			location.reload();
			window.location.href="<?php echo $base_url; ?>list_of_job_report_for_qm.php?report_no="+txt_report_no+'&&job_no='+job_no;
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});



//send report to print

$(document).on("click", ".report_send_to_print", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=report_send_to_print&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_job_report_for_qm.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

//send job to accept

$(document).on("click", ".job_send_to_accept", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Job ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=send_job_to_accept&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>superadmin_arrived_jobs_of_qm.php";
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});



//send job to print

$(document).on("click", ".job_send_to_print", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To SentTo Print This Job ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=job_send_to_print&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>superadmin_arrived_jobs_of_qm.php";
			
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