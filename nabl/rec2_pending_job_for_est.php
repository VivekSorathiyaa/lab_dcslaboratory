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
					PENDING JOBS FOR ESTIMATES
						
					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-body">
							
							<div id="display_data">
							
							<table id="example1" class="table table-bordered table-striped" style="width:100%">
									<thead>
									<tr>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Report No</th>	
										<th style="text-align:center;">Job No</th>
										
								
									</tr>
								</thead>
								<tbody>
									<?php
									
										$count=0;
										 $query="select * from save_material_assign where  isstatus='1' and is_deleted='0'";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;
											
									?>
											<tr >
											<td style="white-space:nowrap;text-align:center;">
												
												<input type="button" class="btn btn-info btn-lg view_detail_from_job" data-id="<?php echo $row['report_no']."|".$row['job_no'];?>" data-toggle="modal" data-target="#myModal" value="View"> 
												&nbsp;
												<a href="edit_span_material_assigning_by_super_admin.php?report_no=<?php echo $row['report_no'];?>&&job_no=<?php echo $row['job_no'];?>" class="btn btn-primary btn-lg btn3d" title="Edit"><span class="glyphicon glyphicon-question-list"></span> Edit</a>
											&nbsp;
												
												<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d send_to_perfoma" data-id="<?php echo $row['sm_id'];?>" title="Send to Perfoma Invoice"><span class="glyphicon glyphicon-question-ok"></span> Submit</a>
												
												&nbsp;
												
												<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d delete_data_of_jobs" data-id="<?php echo $row['report_no'];?>" title="Send to Perfoma Invoice"><span class="glyphicon glyphicon-question-ok"></span> Delete</a>
											</td>     
					
											<td style="white-space:nowrap;text-align:center;"><?php echo $count;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['report_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['job_no'];?></td>
											
											
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

<!--model for view-->
	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 90%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<div class="row">
			<div class="col-md-6"><h3 class="modal-title" style="color:black;">Report Number :<span id="report_span"></span></h3></div>
			<div class="col-md-6" style="margin-top: -15px;"><h3 class="modal-title" style="color:black;">Job Number :<span id="job_span"></span></h3></div>
		</div>
        
      </div>
      <div class="modal-body">
		<div id="display_data_of_materials">
		
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
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

	$('#from_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy',
	  //startDate: new Date(inv_start_date),
	 // endDate: new Date(inv_end_date)
	})
	$('#to_date').datepicker({
	  autoclose: true,
	  format: 'dd/mm/yyyy',
	 // startDate: new Date(inv_start_date),
	  //endDate: new Date(inv_end_date)
	})
		
	$(function () {
		$('.select2').select2()
	})
</script>
<script>

$(document).on("click", ".send_to_perfoma", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
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
			//get_save_material();
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});


// delete data related of job but not delete job

$(document).on("click", ".delete_data_of_jobs", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete Assigned Material For This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=delete_data_of_jobs&clicked_id='+clicked_id,
        success:function(html){
			//var set_ids="#tr_"+clicked_id;
			//$(set_ids).remove();
			//get_save_material();
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

// for first portion	
		$(document).on('click','.view_detail_from_job',function(){
			var abc = $(this).attr('data-id');
			$.ajax
			({
				type: 'POST',
				url: '<?php $base_url; ?>span_save_data_lab_screen.php',
				data: 'action_type=view_detail_from_job&abc='+abc,
				success:function(html){
					$('#display_data_of_materials').html(html);
					var ss=abc.split("|");
					$('#report_span').text(ss[0]);
					$('#job_span').text(ss[1]);
					
				}
			});
		});
	
	

</script>
