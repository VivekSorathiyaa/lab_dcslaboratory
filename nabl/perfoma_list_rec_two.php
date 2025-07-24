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


.form-control { 
font-size: 16px;; 
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
		Performa Invoice
		</h1>
	</div>
<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				
				<!-- /.box-header -->
					
					
						<div class="box-body">
						<div id="display_data_third">
								<table id="example3" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Action</th>
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
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['report_no'];?></td>
											<td style="text-align:center;">
											
											<?php
											 $sel_jobs="select * from job where `report_no`='$row[report_no]'";
											 $result_jobs=mysqli_query($conn,$sel_jobs);
											 $get_jobs=mysqli_fetch_array($result_jobs);
											
											 if($get_jobs["jobcreatedby_id"]==$_SESSION['u_id']  || $_SESSION['isadmin']==0)
											 {
											?>
											<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d reward_save_material" data-id="<?php echo $row['sm_id'];?>" title="Reward"><span class="glyphicon glyphicon-question-ok"></span> Reward</a>
											
											<a href="span_set_rate.php?report_no=<?php echo $row['report_no'];?>&&job_no=<?php echo $row['job_no'];?>" class="btn btn-info btn-lg btn3d" title=""><span class="glyphicon glyphicon-question-list"></span> Invoice</a>
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
										 
											<?php
											}else{
												echo "****";
											}
											?>
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
</script>
