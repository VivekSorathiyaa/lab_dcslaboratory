<?php include("header.php");?>
<?php include("sidebar.php");?>
<?php include("connection.php");
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Assigned Material
	    </h1>
      
    </section>

    <!-- Main content -->
  
<section class="content">
<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Assigned Material</h3>
				</div>
				<!-- /.box-header -->
					
						<div class="box-body">
							<form class="form" id="billing" method="post">
								<div class="box-body">
									<div class="row">	
										<div class="col-lg-4">
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">From Date:</label>

											  <div class="col-sm-9">
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="from_date" name="from_date" value="<?php echo date("d-m-Y");?>" tabindex="1">
													</div>
											  </div>
											</div>
										</div>
										
										<div class="col-lg-4"> 
											<div class="form-group">
											  <label for="inputEmail3" class="col-sm-3 control-label">To Date:</label>

											  <div class="col-sm-9">
												<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="to_date" name="to_date" value="<?php echo date("d/m/Y");?>" tabindex="2">
													</div>
											  </div>
											</div>
										</div>
										
										
										
										<div class="col-lg-4">
											
											<div class="form-group">
											 
											  <div class="col-sm-12">
												<input type="button" class="btn btn-info pull-right" name="btn_search" id="btn_search" value="Search" tabindex="5">

											  </div>
											</div>
										</div>
									</div>
									<br>
									
								</div>
							</form>
							<hr style="border-top: 1px solid;">

							<br>
							<div id="display_data">
								<table id="example1" class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										<th style="text-align:center;">Action</th>
										<th style="text-align:center;">Report Number</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Created By</th>
									</tr>
										
								</thead>
								<tbody>
									<?php
										$count=0;
										$query="select * from material_assign_total WHERE `assign_status`=1 AND `isdeleted`=0 ORDER BY assign_id_total DESC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											
											
									?>
											<tr>
											<td style="text-align:center;">
											
												<a href="<?php echo $base_url; ?>edit_assigned_report.php?report_no=<?php echo $row['report_number'];?>&&mate_rate=<?php echo $row['mate_rate'];?>" class="glyphicon glyphicon-pencil" title="Material Assign"></a>
												&nbsp;&nbsp;&nbsp;
												<a href="<?php echo $base_url; ?>material_report.php?report_no=<?php echo $row['report_number'];?>" class="glyphicon glyphicon-th-list" title="View Assigned Material"></a>
										    
											</td>
					
											
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['report_number'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['date'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['createdby'];?></td>
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


	$("#btn_search").click(function(){
					
					var from_date = $('#from_date').val(); 
					var to_date = $('#to_date').val(); 
					
					var postData = '&from_date='+from_date+'&to_date='+to_date;
			
					$.ajax({
						url : "<?php echo $base_url; ?>search_assign_listing.php",
						type: "POST",
						data : postData,
						success: function(data,status,  xhr)
						 {
							
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

</script>
