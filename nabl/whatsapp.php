
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
	<div class="row">
		
		<h1 style="text-align:center;">
		REPORTS REGISTER
		</h1>
	</div>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-info">
				<div class="col-md-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="active tab-pane" id="clients">
					<form class="" method="post" >
					   <div class="row">
									<div class="col-md-6">
										<input type="text" class="form-control select2 col-sm-12" id="numbers">
									</div>
									<div class="col-md-6">																			
										<button type="button" class="btn btn-info"  onclick="search_agency('search')" name="btn_add_data" id="btn_add_data" style="width:100%" ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
									</div>
									
								
																										
					</div>
					<hr width="80%">
					
					<br>
					<div class="row">
						<?php include("whatsapp_menu.php") ?>
						<div id="display_data">
						<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
						<thead>
							<tr>
								<th style="text-align:center;">Action</th>
								<th style="text-align:center;">Serial No</th>
								<th style="text-align:center;">File Number</th>
								<th style="text-align:center;">Var_1</th>
								<th style="text-align:center;">Var_2</th>
								<th style="text-align:center;">Var_3</th>
								<th style="text-align:center;">Var_4</th>
								<th style="text-align:center;">Var_5</th>
								<th style="text-align:center;">Var_6</th>
								<th style="text-align:center;">Var_7</th>
								<th style="text-align:center;">Var_8</th>
								<th style="text-align:center;">Var_9</th>
								<th style="text-align:center;">Var_10</th>
								<th style="text-align:center;">Status</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sele_materials="select * from whatapp_msg where `is_deleted`=0";
						$result_materials = mysqli_query($conn,$sele_materials);
						if(mysqli_num_rows($result_materials)>0)
						{
							$counting=1;
							while($row_materials =mysqli_fetch_array($result_materials))
							{
							?>
									<tr>	
										<td>
										<a href="javascript:void(0);" class="btn btn-danger delete_data" data-id="<?php echo $row_materials["msg_id"]?>">Delete</a>
										
										
										</td>
										<td><?php echo $counting;?></td>
										<td><?php echo $row_materials["file_no"]?></td>
										<td><?php echo $row_materials["var_1"]?></td>
										<td><?php echo $row_materials["var_2"]?></td>
										<td><?php echo $row_materials["var_3"]?></td>
										<td><?php echo $row_materials["var_4"]?></td>
										<td><?php echo $row_materials["var_5"]?></td>
										<td><?php echo $row_materials["var_6"]?></td>
										<td><?php echo $row_materials["var_7"]?></td>
										<td><?php echo $row_materials["var_8"]?></td>
										<td><?php echo $row_materials["var_9"]?></td>
										<td><?php echo $row_materials["var_10"]?></td>
										<td>
										<?php 
										if($row_materials["msg_send"]=="0")
										{
											echo "Pending";
										}elseif($row_materials["msg_send"]=="2")
										{
											echo "Error";											
										}else{
											echo "Sent";
										}
										?>
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

// add data
function search_agency(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'search') {
				var sel_material = $('#sel_material').val(); 
				var todate = $('#todate').val(); 
				var fromdate = $('#fromdate').val(); 
				
				billData = '&action_type='+type+'&sel_material='+sel_material+'&todate='+todate+'&fromdate='+fromdate;
				
			
				//exit();
				
    }
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>search_whatsapp.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},		
        success: function(msg,status, xhr){
		document.getElementById("overlay_div").style.display="none";
		
		$("#display_data").html(msg);
	
		//$(".class_submit").show();
		
        }
    });
}

$(document).on("click",".delete_data",function(){
	var ids= $(this).attr("data-id");
	billData = '&action_type=delete_data&ids='+ids;
	if(confirm("Are You Sure To Delete..?"))
	{
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>search_whatsapp.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},		
        success: function(msg,status, xhr){
		document.getElementById("overlay_div").style.display="none";
		alert("sSuccessfully Deleted");
		window.location.href="whatsapp.php";
		}
    });
}
	
})

</script>
