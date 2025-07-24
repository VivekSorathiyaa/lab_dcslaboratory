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
   
  
<section class="content"  style="padding: 0px;margin-right: auto;margin-left: auto; padding-left: 0px; padding-right: 0px; ">
<?php include("menu.php") ?>
			
	<div class="row">
		
		<h1 style="text-align:center;">
		List Of Cancel Perfoma 
	</h1>
	</div>		
	<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				<div class="box-body">
					
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Job No</th>
										<th style="text-align:center;">Name Of Customer</th>
										<th style="text-align:center;">Agency No</th>
										<th style="text-align:center;">Perfoma No</th>
										<th style="text-align:center;">Perfoma Date</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from estimate_total_span WHERE `est_isdeleted`=1  AND `perfoma_completed_by_biller`='0' ORDER BY est_id DESC LIMIT 0,200";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											$sel_agency_id=$row["agency_id"];
											$sel_agency="select * from agency_master where `isdeleted`=0 and `agency_id`=".$sel_agency_id;
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];
											
											
											$get_one_trf_no=explode(",",$row['trf_no']);
											$one_trf_no=$get_one_trf_no[0];
											$query_job="select * from job WHERE `jobisdeleted`=0 AND `trf_no`='$one_trf_no' ORDER BY job_id DESC";
											$result_job =mysqli_query($conn,$query_job);
											
											
											$row_job =mysqli_fetch_array($result_job);
											$customer_name=$row_job['clientname'];
											if($row["perfoma_type"]=="direct_perfoma")
											{
												$customer_name=$row['customer_name'];
											}
											
											$name_of_work= strip_tags(html_entity_decode($row_job["nameofwork"]),"<strong><em>");
											
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['job_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $customer_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $agency_name;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["perfoma_no"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php
											$date = new DateTime($row['estimate_date']);
											echo $date->format('d-m-Y');
											?></td>
											<td style="text-align:center;">
										
											<a href="javascript:void(0);" class=" btn-success perfoma_restore_by_est_id" data-id="<?php echo $row['est_id'];?>"title="Material Assign"><span class="glyphicon glyphicon-question-list"></span>&nbsp;Restore&nbsp;&nbsp;</a>
											
											
											
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
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    });
	$(function () {
		$('.select2').select2()
	})

});



$(document).on("click", ".perfoma_restore_by_est_id", function () {
				var clicked_id = $(this).attr("data-id"); 
	$.confirm({
        title: "warning",
        content: "Are You Sure To Restore This Perfoma ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=perfoma_restore_by_est_id&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_completed_perfoma_for_biller_canceled.php";
			
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