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
					 EMERGENCY JOB 
						
					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">EMERGENCY JOB</h3>
				</div>
				<!-- /.box-header -->
					
						<div class="box-body">
							

							<div id="display_data">
								<table id="example1" class="table table-bordered table-striped" style="width:100%">
									<thead>
									<tr>
										<!--<th style="text-align:center;">Action</th>
										<th style="text-align:center;"></th>
										<th style="text-align:center;">Client Name</th>	
										<th style="text-align:center;">Client Address</th>
										<th style="text-align:center;">Client Phone</th>
										<th style="text-align:center;">Email</th>
										<th style="text-align:center;">Client Gst No</th>
										<th style="text-align:center;">Client city</th>
										<th style="text-align:center;">Agency</th>
										<th style="text-align:center;">Agency Address</th>
										<th style="text-align:center;" >Agency Mobile</th>
										<th style="text-align:center;">Agency City</th>
										<th style="text-align:center;">Agency Gstno</th>
										<th style="text-align:center;">Agency Email</th>
										<th style="text-align:center;">Name of Work</th>
										<th style="text-align:center;">Authorized Name</th>
										<th style="text-align:center;">Ref No</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Job Number</th>
										<th style="text-align:center;">Sample Sent By</th>
										<th style="text-align:center;">Sample Rec Date</th>-->
										
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Job No</th>
										
								
									</tr>
								</thead>
								<tbody>
									<?php
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1'  AND `report_job_printing`='0' ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										$current_date= date("Y-m-d");
										$next_date= date('Y-m-d', strtotime($current_date. ' + 2 days'));
			
					
									while($row=mysqli_fetch_array($result))
									{
										if($row["job_lab_progress"]=='0')
										{
											
											$final_query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_number]' AND `expected_date` <= '$next_date' ORDER BY final_material_id DESC";
											$final_result=mysqli_query($conn,$final_query);
												if(mysqli_num_rows($final_result) > 0)
												{
													while($final_row=mysqli_fetch_array($final_result))
													{?>
														
														<tr>
															
														<td>
																<?php echo $final_row["report_no"]; ?>
																
																
														</td>	
														<td>
																
																<?php echo $final_row["job_no"]; ?>
																
														</td>
														</tr>
													<?php
													}
												}
											
										}
										else
										{
											
											$final_query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_number]' AND `expected_date` <= '$next_date' ORDER BY final_material_id DESC";
											$final_result=mysqli_query($conn,$final_query);
												if(mysqli_num_rows($final_result) > 0)
												{
													while($final_row1=mysqli_fetch_array($final_result))
													{?>
														<tr>
															
														<td>
															<?php echo $final_row1["report_no"]; ?>
															
														</td>
														<td>
															
															<?php echo $final_row1["job_no"]; ?>
														</td>	
														</tr>
														
													<?php
													}
												}
											
										}
										
										
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

	
		
	$(function () {
		$('.select2').select2()
	})
</script>
<script>


	$("#btn_search").click(function(){
					
					var from_date = $('#from_date').val(); 
					var to_date = $('#to_date').val(); 
					var agency = $('#agency').val(); 
					var clientname = $('#clientname').val(); 
					
					var postData = '&from_date='+from_date+'&to_date='+to_date+'&agency='+agency+'&clientname='+clientname;
			
					$.ajax({
						url : "<?php echo $base_url; ?>search_emergency_job.php",
						type: "POST", 
						data : postData,
						beforeSend: function(){
							document.getElementById("overlay_div").style.display="block";
						},
						success: function(data,status,  xhr)
						 {
							document.getElementById("overlay_div").style.display="none";
							$("#display_data").html(data);

						 }

					}); 
	});
	
	
	function deleteData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
  
     if (type == 'delete'){
		
			billData = 'action_type='+type+'&id='+id;
				
    }
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>delete_ess_bill.php',
        data: billData,
        success:function(msg){
            if(msg == 'ok'){
                alert('Bill data has been '+statusArr[type]+' successfully.');
                getbills();
              
				  window.location.href="<?php echo $base_url; ?>view_est_bill.php";
				
            }else{
                alert('Bill data has been '+statusArr[type]+' successfully.');
				 window.location.href="<?php echo $base_url; ?>view_est_bill.php";
            }
        }
    });
}

$(window).load(function() {
    var vWidth = $(window).width();
    var vHeight = $(window).height();
    $('.table > section').css('width', vWidth).css('height', vHeight);
});

$(window).resize(function() {
    var vWidth = $(window).width();
    var vHeight = $(window).height();
    $('.table > section').css('width', vWidth).css('height', vHeight);
});
</script>
