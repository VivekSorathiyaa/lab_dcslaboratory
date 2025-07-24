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
    box-shadow:0 0 0 1px #f0ad4e inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #eea236, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#f0ad4e;
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
		Jobs For Scanning
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
										<th style="text-align:center;">Reference No</th>
										<th style="text-align:center;">Reference Date</th>
										<th style="text-align:center;">Received sample Date</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										
										 $query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `any_report_done_by_any_qm`='1' AND `job_completed_by_scanner`=0 ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											//if($row["appoved_by_qm_to_print"] =="1" || $row["appoved_by_qm_to_print"] =="2")
											//{
											$count++;
									
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['refno'];?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php
											$ref_date = new DateTime($row['date']);
											echo $ref_date->format('d-m-Y');
											?>
											</td>
											<td style="white-space:nowrap;text-align:center;"><?php
											$date = new DateTime($row['sample_rec_date']);
											echo $date->format('d-m-Y');
											?></td>
											
											
											<td style="text-align:center;">
											
											<a href="upload_file_for_trf_by_scanner_in_super_admin.php?trf_no=<?php echo $row['trf_no'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>&nbsp;
											
											<a href="print_trf.php?trf_no=<?php echo $row['trf_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-success btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Trf</a>
											
											
											
											<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d complete_job_by_scanner" data-id="<?php echo $row['trf_no'];?>" title="Merge"><span class="glyphicon glyphicon-question-ok"></span>Complete</a>
											</td>
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
    } );

});

$(document).on("click", ".complete_job_by_scanner", function () {
	var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Completed this job after Upload Files?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_upload_file_for_trf_by_scanner.php',
        data: 'action_type=complete_job_by_scanner&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_completed_job_for_scanner.php";
			
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
