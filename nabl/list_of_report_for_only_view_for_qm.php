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
   
  
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		View Reports Lst
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
							<div class="panel-group">
								<div class="box box-info">
									<div class="box-body">
									  <div class="table-responsive" id="display_data">
										<table class="table no-margin" id="example1" style="width:100%;">
										  <thead>
										  <tr>
											<th>Serial No</th>
											<th>Report No</th>
											<th>Job No</th>
											<th>Lab No</th>
											<!--<th>Test List</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Exp. Sub. Date</th>
											<th>Days</th>-->
											<th>Action</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
											
										//$sel_eng="Select * from job_for_engineer where `report_sent_to_qm`=1 AND `appoved_by_qm_to_print`=0";
										
										$sel_eng="Select * from job_for_engineer where `report_sent_to_qm`=1";
										$query_eng= mysqli_query($conn,$sel_eng);
										$material_count=1;
										while($row=mysqli_fetch_array($query_eng))
										{
										
										
										$sel_mat="select * from material where `id`=".$row['material_id'];
										$result_mat=mysqli_query($conn,$sel_mat);
										$row_mat=mysqli_fetch_array($result_mat);
										
										  ?>
										  <tr>
											<td><b><?php echo $material_count;?></b></td>
											<td><b><?php echo $row["report_no"];?></b></td>
											<td><b><?php echo $row["job_no"];?></b></td>
											<td><b><?php echo $row["lab_no"];?></b></td>
											<td>
											  <a href="<?php echo $base_url.$row_mat["filename"];?>?lab_no=<?php echo $row['lab_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&report_no=<?php echo $row['report_no']; ?>" class="btn btn-primary btn-lg btn3d" title="View Job" target="_blank"><span class="glyphicon glyphicon-question-list"></span> Report</a>
											</td>
										  </tr>
										<?php 
									
										$material_count++;
										} ?>
										  </tbody>
										</table>
									  </div>
									</div>
								</div>
							</div>
							<br>
						</div>
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>
	  	  
<script>
$(document).ready(function(){
	
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
	

});

$('.startdate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	
$('.enddate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
$('.expdate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
</script>
