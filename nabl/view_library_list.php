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
		LIBRARY LIST
		</h1>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="add_library.php" class="btn btn-primary">Add LIBRARY</a>
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
								<th style="text-align:center;">Unique Id</th>
								<th style="text-align:center;">Document Type</th>
								<th style="text-align:center;">Document Name</th>
								<th style="text-align:center;">Document Narration</th>
								<th style="text-align:center;width:1px;">Master Upload</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sele_materials="select * from document_library where `is_deleted`=0 ORDER BY library_id DESC LIMIT 0,100";
						$result_materials = mysqli_query($conn,$sele_materials);
						if(mysqli_num_rows($result_materials)>0)
						{
							$counting=1;
							while($row_materials =mysqli_fetch_array($result_materials))
							{
							?>
									<tr id="tr_<?php echo $row_materials["library_id"]?>">	
										<td><?php echo $counting;?></td>
										<td style="text-align:center;">
										<a href="edit_library.php?id=<?php echo $row_materials["library_id"];?>" class="glyphicon glyphicon-edit"></a>
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_data" data-id="<?php echo $row_materials["library_id"]?>"></a>
										
										
										</td>
										<td><?php echo $row_materials["unique_id"]?></td>
										<td><?php echo $row_materials["doc_type"]?></td>
										<td><?php echo $row_materials["doc_name"]?></td>
										<td><?php echo $row_materials["doc_narration"]?></td>
										<td style="text-align:center;width:12%;">
										<?php if($row_materials["master_upload"]!=""){?>
										<a href="library_documents/<?php echo $row_materials["master_upload"]?>" target="_blank" class="btn btn-success"><i class="glyphicon glyphicon-eye-open"></i></a>
										<?php }else{ echo "-";} ?>
										
										<a href="view_more_library_list.php?id=<?php echo $row_materials["unique_id"];?>&&name=<?php echo $row_materials["doc_name"];?>" class="btn btn-primary" target="_blank" Title="Extra"><i class="glyphicon glyphicon-play"></i></a>
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
        url: '<?php $base_url; ?>save_library.php',
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
