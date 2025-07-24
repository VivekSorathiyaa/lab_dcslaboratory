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
<?php

				if(isset($_POST['btn_estimate'])){
				  
					$job_update="update job_id_to_material SET `assign_status`='1' WHERE `createdby_id`='$_SESSION[u_id]' AND `assign_status`='0'";
				
					$result_of_update=mysqli_query($conn,$job_update);
					
					?>
					<script >
						window.location.href="<?php echo $base_url; ?>list_assigned_job_no.php";
					</script>
					<?php
				}
				
				if(!isset($_POST['btn_estimate'])){
					
					$delete="DELETE FROM  job_id_to_material WHERE `createdby_id`='$_SESSION[u_id]' AND assign_status='0'";
					$result_of_delete=mysqli_query($conn,$delete);
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
       Report Wise Material
	    </h1>
      
    </section>

    <!-- Main content -->
  
<section class="content">
<div class="row">
        <div class="col-xs-12">
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Report Wise Material</h3>
				</div>
				<!-- /.box-header -->
					
						<div class="box-body">
							<form class="form" id="billing" method="post">
								<div class="box-body">
									<div>
								<table id="example1" class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										<th style="text-align:center;">FAction</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Lab No</th>
										<th style="text-align:center;">Material Category</th>
										<th style="text-align:center;">Material</th>
										<th style="text-align:center;">Qty</th>
										<th style="text-align:center;">Created By</th>
										
								</thead>
								<tbody>
									<?php
									    $get_report_no= $_GET["report_no"];
										$count=0;
										$query="select * from material_assign WHERE `report_number`='$get_report_no' AND `isdeleted`=0 AND `assign_status`=1 ORDER BY assign_id DESC";
										$result=mysqli_query($conn,$query);
										
										while($row=mysqli_fetch_array($result))
										{
											$count++;
										$hidden_gst_type=$row["gst_type"];
										$hidden_direct_path=$row["direct_path"];
											
									?>
											<tr>
											<td style="text-align:center;">
											
												<button type="button" class="btn btn-info class_add" id="btn_click" data-id="<?php echo $row['assign_id'];?>" name="btn_click">View</button>
										    
											</td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['report_number'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['lab_id'];?></td>
											<?php
											// select category											
											$sel_category="select * from material_category where `material_cat_id`=".$row['material_category'];
											$category_query= mysqli_fetch_array(mysqli_query($conn,$sel_category));
											$get_category=$category_query["material_cat_name"];
											
											
											// select material
											$sel_material="select * from material where `id`=".$row['material'];
											$material_query= mysqli_fetch_array(mysqli_query($conn,$sel_material));
											$get_material=$material_query["mt_name"];

											?>
											<td style="white-space:nowrap;text-align:center;"><?php echo $get_category;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $get_material;?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['qty'];?></td>
											<td style="white-space:nowrap;text-align:center;"><?php echo $row['createdby'];?></td>
											
										
											
										</tr>
									<?php
										}	
									?>
								</tbody>
								
							  </table>
								
							</div>
									<br>
									
								</div>
							</form>
							<hr style="border-top: 1px solid;">

							<br>
								<form  class="form" id="add_with_job_id" method="post">
							<div id="display_data">
								<table id="example1" class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										<th style="text-align:center;">Material Name</th>
										<th style="text-align:center;">Lab Id</th>
										<th style="text-align:center;">job  Id</th>
										<th style="text-align:center;">Qty</th>
										<th style="text-align:center;">Testing Start Date</th>
										<th style="text-align:center;">Testing End Date</th>
									</tr>	
								</thead>
								<tbody>
								</tbody>
								
							  </table>
							</div>
								<div class="row">
								<button type="button" class="btn btn-info  pull-right" id="add_job"  name="btn_job"  style="margin-right: 86px;margin-top: 20px;" >Add</button>
								</div>
								</form>
								
								<form  class="form" id="edit_with_job_id" method="post">
							<div id="display_data_for_edit">
								
							</div>
							
							
								<button type="button" class="btn btn-info  pull-right" id="edit_job"  name="edit_job"  style="margin-right: 86px;margin-top: 40px;" >Edit</button>
								</div>
								
								</form>
								
								
							<hr style="border-top: grey 2px solid;">

							<br>
							<div id="display_data_after_add_data">
								
							</div>
						</div>
						<div class="box-footer">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
									
											<div class="col-sm-6">
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
												<div class="col-xs-2"></div>
													
											</div>
											<div class="col-sm-6">
											<form name="main_form" method="post">
												<div class="col-xs-2">
												<input type="hidden" name="gst_type_to_save" value="<?php echo $hidden_gst_type;?>">
												<input type="hidden" name="direct_path_to_save" value="<?php echo $hidden_direct_path;?>">
												<input type="hidden" name="report_no_to_save" value="<?php echo $_GET['report_no'];?>">
												<input type="hidden" name="date_to_save" value="<?php echo date('Y-m-d');?>">
												<button type="submit" class="btn btn-info pull-right" id="btn_estimate" name="btn_estimate" tabindex="20" style="width:100px">Edit</button>
												</div>
											</form>
												<div class="col-xs-2">
												<!--<button type="submit" class="btn btn-info pull-right" tabindex="21" id="btn_report" name="btn_report">Report</button>-->
												</div>
												
											</div>
										</div>
									</div>
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
	$("#add_job").hide();
	$("#edit_job").hide();
	getbills();
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

	$('#start_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	})
	$('#end_date').datepicker({
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
						url : "<?php echo $base_url; ?>search_job_listing.php",
						type: "POST",
						data : postData,
						success: function(data,status,  xhr)
						 {
							
							$("#display_data").html(data);

						 }

					}); 
	});
	
	


$(".class_add").click(function(){
				var clicked_id = $(this).attr("data-id");  
				
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=view_by_id&clicked_id='+clicked_id,
        success:function(html){
			$("#add_job").show();
			$("#edit_job").hide();
			$('#display_data_for_edit').html("");
            $('#display_data').html(html);
			
        }
    });
});




$("#add_job").click(function(){
				var get_form=$("#add_with_job_id").serialize();

				
	 $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=add&get_form='+get_form,
        success:function(html){
			$("#add_job").hide();
			$("#edit_job").hide();
            $('#display_data').html("Success inserted");
			getbills();
        }
    });
});

$("#edit_job").on("click",function(){

				var get_form=$("#edit_with_job_id").serialize();

			
	 $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=edit_job&get_form='+get_form,
        success:function(html){
			$("#add_job").hide();
			$("#edit_job").hide();
            $('#display_data').html("");
            $('#display_data_for_edit').html("");
			
			getbills();
        }
    });
});

function getbills(){
				 
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=view_after_add_data_in_edit&report_no=<?php echo $_GET["report_no"]; ?>',
        success:function(html){
			$('#display_data').html("");
            $('#display_data_for_edit').html("");
            $('#display_data_after_add_data').html(html);
			
        }
    });
}

function editData(id){
				
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=view_by_id_for_edit&id='+id,
        success:function(html){
			
			$("#add_job").hide();
			$("#edit_job").show();
			$('#display_data').html("");
            $('#display_data_for_edit').html(html);
        }
    });
}

function deleteData(type,id){
	if(type=="delete")
	{		
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=delete_job_by_id&id='+id,
        success:function(html){
			
			$("#add_job").hide();
			$("#edit_job").hide();
			$('#display_data').html("");
            $('#display_data_for_edit').html("");
            getbills();
        }
    });
}
}

</script>
