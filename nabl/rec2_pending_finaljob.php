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
		
		<!-- Main content -->
		<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto;  
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row" style="margin: 0px 0px 0px 0px;">
		
					<h1 style="text-align:center;">
					PENDING FINAL JOB
						
					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
					<div class="box-body">
							

							<div id="display_data">
								
							<table id="example3" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Report No</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from save_material_assign WHERE `is_deleted`=0 AND `isstatus`=2  ORDER BY sm_id DESC";
												
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											
									?>
											<tr>
											
											<td style="text-align:center;">
											
											<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d reward_save_material" data-id="<?php echo $row['sm_id'];?>" title="Reward"><span class="glyphicon glyphicon-question-ok"></span> Reward</a>
											
											<a href="span_set_rate_by_super_admin.php.php?report_no=<?php echo $row['report_no'];?>&&job_no=<?php echo $row['job_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Invoice</a>
											&nbsp;
											<?php if($row["is_estimate"]==1){ ?>
											<a href="span_bill_print.php?report_no=<?php echo $row['report_no'];?>&&job_no=<?php echo $row['job_no'];?>" class="btn btn-primary btn-lg btn3d" title="" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Print</a>
										<?php } ?>
										
										<!--condition if estimate ready submit button display-->
										
										<?php
										$sel_estimate="select * from save_material_assign where `report_no`='$row[report_no]' AND `is_estimate`=1";
										$query_estimate=mysqli_query($conn,$sel_estimate);
										if(mysqli_num_rows($query_estimate) > 0){
										?>
											&nbsp;<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d send_to_lab"data-id="<?php echo $row['sm_id']."|".$row['report_no']."|".$row['job_no'];?>" title="" target="_blank"><span class="glyphicon glyphicon-question-ok"></span> Submit</a>
										<?php
										}
										?>
											&nbsp;<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d delete_jobs"data-id="<?php echo $row['report_no'];?>" title="" ><span class="glyphicon glyphicon-question-ok"></span> Delete</a>
										 
											</td>
											
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['report_no'];?></td>
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
		buttons: [ 'copy' ], dom: 'Bfrtip',
	 buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
		
    } );
 } );
</script>
<script>
// reward job from perfoma
$(document).on("click", ".reward_save_material", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Reward This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=reward_save_material&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>rec2_pending_finaljob.php";
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

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
			window.location.href="<?php echo $base_url; ?>rec2_pending_finaljob.php";
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

//Work FOr delete job by report no from all related tables
 $(document).on("click", ".delete_jobs", function () {
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
			alert("Job Successfully Deleted..");
			window.location.href="<?php echo $base_url; ?>rec2_pending_finaljob.php";
			
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
