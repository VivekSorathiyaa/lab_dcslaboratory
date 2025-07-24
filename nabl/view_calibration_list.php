
<?php 
session_start(); 
include("header.php");
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

<div class="content-wrapper" style="margin-left: 0px !important;">

	<!-- Content Header (Page header) -->

	<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
	<?php include("menu.php") ?>
	<div class="row main_breadcrumb">
		<h1>
		CALIBRATION LIST
		</h1>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="add_calibration.php" class="btn btn-primary">ADD CALIBRATION</a>
	</div>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-info">
				<div class="col-md-12 p-0">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="active tab-pane" id="clients">
					<form class="" method="post" >
					   
					<hr width="80%">
					
					<br>
					<div class="row">
						<div id="display_data">
						<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
						<thead>
							<tr>
								<th style="text-align:center;width:2px;">Sr No</th>
								<th style="text-align:center;width:2px;">Action</th>
								<th style="text-align:center;">Auto Id</th>
								<th style="text-align:center;">Unique Id</th>
								<th style="text-align:center;">Equipment Name</th>
								<th style="text-align:center;">Model</th>
								<th style="text-align:center;">Man Sr No</th>
								<th style="text-align:center;">Make</th>
								<th style="text-align:center;">Manufacture Year</th>
								<th style="text-align:center;">Ranges</th>
								<th style="text-align:center;">Accuracy</th>
								<th style="text-align:center;">Least Of Count</th>
								<th style="text-align:center;">Location Of Use</th>
								<th style="text-align:center;">Point To Be Calibration</th>
								<th style="text-align:center;">Calibration Mode</th>
								<th style="text-align:center;">Intimation Day</th>
								<th style="text-align:center;width:1px;">User Manual</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sele_materials="select * from calibration_document where `is_deleted`=0 ORDER BY calibration_id DESC LIMIT 0,250";
						$result_materials = mysqli_query($conn,$sele_materials);
						if(mysqli_num_rows($result_materials)>0)
						{
							$counting=1;
							while($row_materials =mysqli_fetch_array($result_materials))
							{
								
								// if extra table empty by auto id than delete function working
								
							?>
									<tr id="tr_<?php echo $row_materials["calibration_id"]?>">	
										<td><?php echo $counting;?></td>
										<td style="text-align:center;">
										<a href="excel_of_calibration.php?id=<?php echo base64_encode($row_materials["calibration_id"]);?>" class="glyphicon glyphicon-print" target="_blank"></a>
										
										<a href="edit_calibration.php?id=<?php echo $row_materials["calibration_id"];?>" class="glyphicon glyphicon-edit"></a>
										<?php
										$extras="SELECT * FROM extra_calibration where `unique_id`='$row_materials[auto_id]'";
										$job_extras = mysqli_query($conn, $extras);
										if(mysqli_num_rows($job_extras)==0)
										{
										?>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_data" data-id="<?php echo $row_materials["calibration_id"]?>"></a>
										<?php
										}
										?>
										
										</td>
										<td><?php echo $row_materials["auto_id"]?></td>
										<td><?php echo $row_materials["unique_id"]?></td>
										<td><?php echo $row_materials["equipment_name"]?></td>
										<td><?php echo $row_materials["model"]?></td>
										<td><?php echo $row_materials["man_ser_no"]?></td>
										<td><?php echo $row_materials["make"]?></td>
										<td><?php echo $row_materials["manufacture_year"]?></td>
										<td><?php echo $row_materials["ranges"]?></td>
										<td><?php echo $row_materials["accuracy"]?></td>
										<td><?php echo $row_materials["least_count"]?></td>
										<td><?php echo $row_materials["location_of_use"]?></td>
										<td><?php echo $row_materials["point_to_be_calibration"]?></td>
										<td><?php echo $row_materials["calibration_mode"]?></td>
										<td><?php echo $row_materials["intimation_day"]?></td>
										<td style="text-align:center;">
										<?php if($row_materials["user_manual"]!=""){?>
										<a href="calibration_document/<?php echo $row_materials["user_manual"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<?php }else{ echo "-";} ?>
										
										<a href="view_more_calibration_list.php?id=<?php echo $row_materials["auto_id"]."|".$row_materials["unique_id"];?>" class="glyphicon glyphicon-play" target="_blank" Title="Extra"></a>
										</td>
									</tr>	
									<?php 
									$counting++;
									
								
							
							
							}
						}
						?>
					</tbody>
					</table>
						</div>
					</div>
						
					</form>
					</div>
			 
					<!-- /.tab-pane -->

					</div>
				<!-- /.tab-content -->
			</div>
          <!-- /.nav-tabs-custom -->
        </div>
</section>
</div>
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
})

$(document).on("click",".delete_data",function(){
	var ids= $(this).attr("data-id");
	billData = '&action_type=delete_data&ids='+ids;
	if(confirm("Are You Sure To Delete..?"))
	{
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_calibration.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},		
        success: function(msg,status, xhr){
		document.getElementById("overlay_div").style.display="none";
		alert("Successfully Deleted");
		var sets="#tr_"+ids;
		$(sets).remove();
		}
    });
}
	
})

</script>
