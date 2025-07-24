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

/* only for 3d button effects */

.btn3d {
    transition:all .08s linear;
    position:relative;
    outline:medium none;
    -moz-outline-style:none;
    border:0px;
    margin-right:10px;
    margin-top:15px;
}
.btn3d:focus {
    outline:medium none;
    -moz-outline-style:none;
}
.btn3d:active {
    top:9px;
}
.btn-primary {
    box-shadow:0 0 0 1px #428bca inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#428bca;
}
.btn-success {
    box-shadow:0 0 0 1px #5cb85c inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #4cae4c, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#5cb85c;
}
 .btn-info {
    box-shadow:0 0 0 1px #5bc0de inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #46b8da, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#5bc0de;
}
.btn-warning {
    box-shadow:0 0 0 1px #f0ad4e inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #eea236, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#f0ad4e;
}
.form-control { 
font-size: 15px;
height: 50px;
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
			<div class="col-md-2">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="span_add_new_perfoma.php" class="btn btn-primary btn3d"><span class="glyphicon glyphicon-question-ok"></span> Add Quotation</a>
			</div>
			
			<div class="col-md-7">
				<h1 style="text-align:center;">
					Quotation List
				</h1>
			</div>
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
									<div class="col-md-1">&nbsp;</div>
									<div class="col-md-3">
									<label>Agency</label>
									</div>
									<div class="col-md-3">
									<label>Quotation No:</label>
									</div>
									<div class="col-md-5">&nbsp;</div>
									
							</div>
							<div class="row">
							     <div class="col-md-1">&nbsp;</div>
							     <div class="col-md-3">
								 <select class="form-control  select2 col-sm-12" data-placeholder="Select Agency" tabindex="9"  id="select_agency" name="select_agency" required >
														<option value="">Select Agency</option>
														<?php 
															$cat_sql = "select * from agency_master";
														
															$cat_result = mysqli_query($conn, $cat_sql);

																while($cat_row = mysqli_fetch_assoc($cat_result)) {
															
															?>
															<option value="<?php echo $cat_row['agency_id']; ?>">
															<?php echo $cat_row['agency_name']; ?></option>
															<?php  }?>
											 </select>
								 </div>
								 <div class="col-md-3">
									<input type="text" name="search_qouation_no" id="search_qouation_no" placeholder="Enter Quotation No" class="form-control">
								 </div>
								 
								 <div class="col-md-3">
									 <select class="form-control  select2 col-sm-12"  tabindex="9"  id="select_status" name="select_status" required >
										<option value="">Select Status</option>
										<option value="pending">Pending</option>
										<option value="complete">Complete</option>
										<option value="cancel">Cancel</option>
									 </select>
								 </div>
								 
								 <div class="col-md-3">
									<a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_rec"><span class="glyphicon glyphicon-question-ok"></span> Search</a>
									<a href="javascript:void(0);" class="btn btn-primary" onclick="location.reload()" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> View All</a>
								</div>
								 
								 
							</div>
							
							
							
						</div>
						<br>
						
						<div id="display_data_report">
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;width:1%;">Serial No</th>
										<th style="text-align:center;width:1%;">Action</th>
										<th style="text-align:center;width:1%;">Status</th>
										<th style="text-align:center;width:1%;">Agency Name</th>
										<th style="text-align:center;width:1%;">Quotation No</th>
										<th style="text-align:center;width:1%;">Quotation Date</th>
										<th style="text-align:center;width:1%;">Sub Total</th>
										<th style="text-align:center;width:1%;">Discount Percentage</th>
										<th style="text-align:center;width:1%;">Discount Amount</th>
										<th style="text-align:center;width:1%;">Grand Total</th>
										<th style="text-align:center;width:1%;">Sgst</th>
										<th style="text-align:center;width:1%;">Cgst</th>
										<th style="text-align:center;width:1%;">Igst</th>
										<th style="text-align:center;width:1%;">Total</th>
										<!--<th style="text-align:center;">Ulr No</th>
										<th style="text-align:center;">Lab No</th>
										<th style="text-align:center;">S.R.F. No</th>-->
									</tr>
								</thead>
								<tbody>
									<?php
										$count=0;
										
										$query="select * from quotations WHERE `est_isdeleted`=0 ORDER BY quotations_id DESC LIMIT 0,200";
										$result=mysqli_query($conn,$query);
										if(mysqli_num_rows($result)>0)
										{
										while($row=mysqli_fetch_array($result))
										{
											
											$count++;
											$rowing=mysqli_fetch_array($results);
											
											if($row["agency_id"]!= ""){
											$sel_agency="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$row["agency_id"];
											$result_agency =mysqli_query($conn,$sel_agency);
											$row_agency =mysqli_fetch_array($result_agency);
											$agency_name=$row_agency["agency_name"];
											}else{
												$agency_name="";
											}
											
											if($row['statues']=="pending"){ $colors="#f1cf99";} 
											if($row['statues']=="complete"){ $colors="#a2f563";}
											if($row['statues']=="cancel"){ $colors="#f17676";}
									
									?>
											<tr style="background-color:<?php echo $colors;?>;">
											<td style="text-align:center;background-color:white;"><?php echo $count;?></td>
											<td style="text-align:center;background-color:white;">
											
											
											<a href="javascript:void(0);" class="change_status" data-id="<?php echo $row['quotations_id'].'|'.$row['statues'];?>" title="Status"><span class="fa fa-refresh"></span></a>
											
											<a href="edit_qoutation.php?quotations_id=<?php echo $row['quotations_id']?>" title="Edit"><span class="fa fa-edit"></span></a>
											
											<a href="extra_qoutation_print.php?quotations_id=<?php echo $row['quotations_id']?>" title="Edit" target="_blank"><span class="fa fa-print"></span></a>
											
											<a href="javascript:void(0);" class="delete_quatation" data-id="<?php echo $row['quotations_id'];?>" title="Delete"><span class="fa fa-trash"></span></a>
											
											
											</td>
											<td style="white-space:nowrap;text-align:center;">
											<?php echo $row["statues"];?>
											</td>
											
											<td style="white-space:nowrap;text-align:center;">
											<?php echo $agency_name;?>
											</td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['quatation_no'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo date("d-m-Y",strtotime($row['quatation_date']));?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo floatval($row['grand_total']) + floatval($row['discount_amount']);?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['discount_percent'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['discount_amount'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['grand_total'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row["s_gst_amt"];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['c_gst_amt'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['i_gst_amt'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['total_amt'];?></td>
											
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
							<!--<a href="javascript:void(0);" class="btn btn-primary btn-lg btn3d get_for_update"  title="Merge" data-toggle="modal" data-target="#myModal_update"><span class="glyphicon glyphicon-question-ok"></span>Edit</a>-->
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
		pageLength: 100,
    } );

});
$(".search_job_by_rec").click(function()
{
					
	var select_agency = $('#select_agency').val(); 
	var search_qouation_no = $('#search_qouation_no').val();  
	var select_status = $('#select_status').val();  
					
	if(select_agency =="" && search_qouation_no =="" && select_status =="")
	{
		alert("Please Atlist One select");
		return false;
	}
		var postData = '&type=search_all_job_for_admin&select_agency='+select_agency+'&search_qouation_no='+search_qouation_no+'&select_status='+select_status;
			
		$.ajax({
			url : "<?php echo $base_url; ?>search_all_job_for_admin.php",
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

$(document).on('click', '.delete_quatation', function(e)
	{
		if(confirm("Are You Sure To Delete This Qoutation..?"))
		{
		
			var id = $(this).attr("data-id");
			var billData = 'action_type=delete_quatation'+'&id='+id;
			$.ajax({
			url : "<?php $base_url; ?>save_span_add_new_perfoma.php",
			type: "POST",
			dataType:'JSON',
			data : billData,
			success: function(data,status,  xhr)
			 {
			
				alert("Qoutation Successfully Deleted..");
					window.location.href="<?php echo $base_url; ?>list_of_quoations.php";
			 }

			});
		}	
		
	});

$(document).on('click', '.change_status', function(e)
	{
			var id = $(this).attr("data-id");
			var billData = 'action_type=change_status'+'&id='+id;
			$.ajax({
			url : "<?php $base_url; ?>save_span_add_new_perfoma.php",
			type: "POST",
			dataType:'JSON',
			data : billData,
			success: function(data,status,  xhr)
			 {
				window.location.href="<?php echo $base_url; ?>list_of_quoations.php";
			 }

			});
	});
</script>