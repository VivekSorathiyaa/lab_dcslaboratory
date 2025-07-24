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
$user_id=$_SESSION['u_id'];
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
					PENDING JOB LIST OF LAB
						
					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
					
					
						<div class="box-body">
						<div id="display_data_lab">
								<table id="example1" class="table table-bordered table-striped" style="width:100%;">
								<thead>
								<tr>
									<th style="text-align:center;">Serial No</th>
									<th style="text-align:center;">Report No</th>
									<th style="text-align:center;">Job No</th>
									<th style="text-align:center;">Received sample Date</th>
									<th style="text-align:center;">Status</th>
									<th style="text-align:center;">Action</th>
								</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										//$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `report_job_printing`='1' AND `tested_by`='$user_id' AND `job_sent_to_qm`=0 ORDER BY job_id DESC";
										 
										/* $query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `tested_by`='$user_id' AND `job_sent_to_qm`=0 AND `job_owner`=2 ORDER BY job_id DESC"; */
										
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `job_lab_assign`='1' AND `job_lab_progress`= '1' AND `job_sent_to_qm`=0 AND `job_owner`=2 ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['report_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['job_number'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php 
											$date = new DateTime($row['sample_rec_date']);
											echo $date->format('d-m-Y');
											?></td>
											<td style="white-space:nowrap;text-align:center;">
											<?php
											if($row['eng_light_status']==0){
											echo '<img src="images/work_light/off.png">';
											}
											elseif($row['eng_light_status']==1){
											echo '<img src="images/work_light/work.png">';
											}
											elseif($row['eng_light_status']==2){
											echo '<img src="images/work_light/done.png">';
											}
											?>
											</td>
											<td style="text-align:center;">
											<?php
												if($row['tested_by']==$user_id)
												{
													
											?>
											
											<a href="view_job_by_eng.php?report_no=<?php echo $row['report_no'];?>&&job_no=<?php echo $row['job_number'];?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> View</a>
											&nbsp;
											<?php if($row["report_received"]==1){?>
											<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d job_send_to_qm" data-id="<?php echo $row['report_no']."|".$row['job_number'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span> Submit</a>
											<?php }

												}
												else
												{
													echo "****";
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
 } );

	
$(function () {
		$('.select2').select2()
})
	
	
$(document).on("click", ".job_send_to_qm", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job To Quality Manager?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=send_job_to_qlty_manager&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>job_listing_for_engineer.php";
			
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
<script>