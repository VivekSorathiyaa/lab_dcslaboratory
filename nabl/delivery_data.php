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
			<!--<div class="row">
		
		<h1 style="text-align:center;">
		View Reports
		</h1>
	</div>-->
<div class="row">
				
		<div class="row">
		
		<h1 style="text-align:center;">
		View Dispatched Reports For Reception
		</h1>
	</div>		
	<div class="row">
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
									<label>DISPATCH TYPE</label>
									</div>
									<div class="col-md-3">
									<label>REPORT NO:</label>
									</div>
									<div class="col-md-3">
									<label>ULR NO:</label>
									</div>
									<div class="col-md-3">
									<label>LAB NO:</label>
									</div>
							</div>
							<div class="row">
							     <div class="col-md-3">
								 <select id="search_dispatch_type" name="search_dispatch_type" class="form-control">
								 <option value="">Select-Type</option>
								 <option value="0">HAND TO HAND</option>
								 <option value="1">COURIER</option>
								 </select>
								 </div>
								 <div class="col-md-3">
									<input type="text" name="search_report_no" id="search_report_no" placeholder="Enter Report No" class="form-control">
								 </div>
								 
								 <div class="col-md-3">
									<input type="text" name="search_ulr_no" id="search_ulr_no" placeholder="Enter Ulr No" class="form-control">
								 </div>
								 
								 <div class="col-md-3">
									<input type="text" name="search_lab_no" id="search_lab_no" placeholder="Enter Lab No" class="form-control">
								 </div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-3">
									<label>&nbsp;</label>
									</div>
									<div class="col-md-3">
									<label>S.R.F. No:</label>
									</div>
									<div class="col-md-3">
									<label>DISPATCH DATE:</label>
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
								 
								 <div class="col-md-3">&nbsp;</div>
								 
								 
							</div>
							
							
							<div class="row">
								<div class="col-md-5">
								</div>
								<div class="col-md-3">
									<a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_qm"><span class="glyphicon glyphicon-question-ok"></span> Search</a>
									<a href="javascript:void(0);" class="btn btn-primary" onclick="location.reload()" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> View All</a>
								</div>
							</div>
						</div>
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">R</th>
										<th style="text-align:center;">Dispatched Type</th>
										<th style="text-align:center;">Report No</th>
										<!--<th style="text-align:center;">Ulr No</th>
										<th style="text-align:center;">Lab No</th>-->
										<th style="text-align:center;">S.R.F. No</th>
										<th style="text-align:center;">Agency Name</th>
										<th style="text-align:center;">Dispatched Date</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										
										$query="select * from report_dispatch WHERE `is_deleted`=0 ORDER BY dispatch_id DESC LIMIT 0,200";
										$result=mysqli_query($conn,$query);
										if(mysqli_num_rows($result)>0)
										{
										while($row=mysqli_fetch_array($result))
										{
											
											$count++;
											$selection="select * from job where `trf_no`='$row[trf_no]'";
											$qeryies=mysqli_query($conn,$selection);
											$row_job=mysqli_fetch_array($qeryies);
									
									?>
											<tr>
											<td style="text-align:center;"><?php echo $count;?></td>
											<td style="text-align:center;">
											<?php 
											if($row['dispatch_type']=="1"){ ?>
											<input type="checkbox" name="dispatch_id" class="dispatch_id" value="<?php echo $row["dispatch_id"]; ?>">
											<?php } ?>
											&nbsp;
											</td>
											<td style="white-space:nowrap;text-align:center;">
											<?php 
											if($row['dispatch_type']=="0"){ echo "HAND TO HAND"; }else{ echo "COURIER"; }
											?>
											</td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['report_no'];?></td>
											<!--<td style="white-space:nowrap;text-align:center;"><?php //echo $row['ulr_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php //echo $row['lab_no'];?></td>-->
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['trf_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row_job['agency_name'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['courier_date'];?></td>
											<td style="text-align:center;">
											<a href="javascript:void(0);" class="btn btn-primary btn-lg btn3d get_dispatch_report" data-id="<?php echo $row['dispatch_id'];?>" title="Merge" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-question-ok"></span>View</a>
											</td>
										</tr>
									<?php
										}	
										
										}
									?>
								</tbody>
								
							  </table>
								
							</div>
							<div class="row">
							<div class="col-md-5">&nbsp;</div>
							<div class="col-md-4">
							<a href="javascript:void(0);" class="btn btn-primary btn-lg btn3d get_for_update"  title="Merge" data-toggle="modal" data-target="#myModal_update"><span class="glyphicon glyphicon-question-ok"></span>Edit</a>
							</div>
							<div class="col-md-3">&nbsp;</div>
							</div>
						</div>
				<!-- /.box-body -->
				</div>
			</div>
		</div>
</section>	
</div>
<!-- modal for view-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 35%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<div id="display_data" style="text-align:center;">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 


<div id="myModal_update" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width: 35%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
		<div id="display_data_for_update" style="text-align:center;">
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
$(document).ready(function(){
	
	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
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

$(document).on("click", ".update_dispatch_reports", function () {
	
   var courier_date=$("#courier_date").val();	
   var courier_docate_no=$("#courier_docate_no").val();	
   var courier_contact_person=$("#courier_contact_person").val();	
   var courier_contact_person_mobile=$("#courier_contact_person_mobile").val();	
   var courier_contact_address=$("#courier_contact_address").val();	
   var hidden_all_ids=$("#hidden_all_ids").val();	
	
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: 'action_type=update_dispatch_reports&&courier_date='+courier_date+'&courier_docate_no='+courier_docate_no+'&courier_contact_person='+courier_contact_person+'&courier_contact_person_mobile='+courier_contact_person_mobile+'&courier_contact_address='+courier_contact_address+'&hidden_all_ids='+hidden_all_ids,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>list_of_dispatched_report_for_reception.php";
			
        }
    });

});

$(document).on('click','.get_dispatch_report',function(){
			var abc = $(this).attr('data-id');
			$.ajax
			({
				type: 'POST',
				url: '<?php $base_url; ?>span_save_material.php',
				data: 'action_type=get_dispatch_report&abc='+abc,
				success:function(html){
					$('#myModal_update').modal('hide');
					$('#display_data').html(html);
				}
			});
		});
		

		
$(document).on("click", ".get_for_update", function () {
					
					
		var chk_array = [];
     var oTable = $("#example2").dataTable();        
	 $(".dispatch_id:checked", oTable.fnGetNodes()).each(function() {
		 chk_array.push($(this).val());      
		 });
					
		if (chk_array.length === 0) {
			alert("Please Select Atlist One Report");
			$('#myModal_update').modal('hide');
			$('#display_data_for_update').html("");
			return false;
		}
		
				 $.ajax({
						type: 'POST',
						url: '<?php $base_url; ?>span_save_material.php',
						data: 'action_type=get_for_update&chk_array='+chk_array,
						success:function(html){
							$('#myModal').modal('hide');
							$('#display_data_for_update').html(html);
							
						}
					});
			
	});
	
$(".search_job_by_qm").click(function()
{
					
	var search_dispatch_type = $('#search_dispatch_type').val(); 
	var search_report_no = $('#search_report_no').val(); 
	var search_ulr_no = $('#search_ulr_no').val(); 
	var search_lab_no = $('#search_lab_no').val(); 
	var search_trf_no = $('#search_trf_no').val(); 
	var search_sam_date = $('#search_sam_date').val(); 
					
	if(search_dispatch_type =="" && search_report_no =="" && search_ulr_no =="" && search_lab_no =="" && search_trf_no =="" && search_sam_date =="")
	{
		alert("Please Atlist One select");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&search_trf_no='+search_trf_no+'&search_sam_date='+search_sam_date+'&search_dispatch_type='+search_dispatch_type+'&search_report_no='+search_report_no+'&search_ulr_no='+search_ulr_no+'&search_lab_no='+search_lab_no;
			
		$.ajax({
			url : "<?php echo $base_url; ?>search_delivery_data_by_qm.php",
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
</script>