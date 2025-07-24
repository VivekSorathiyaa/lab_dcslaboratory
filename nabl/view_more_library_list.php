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

if(!isset($_GET["id"]) || $_GET["id"]=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>view_library_list.php";
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
		EXTRA LIBRARY LIST FOR (<?php echo $_GET["id"];?>) - <?php echo $_GET["name"];?>
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
									<div class="col-md-2">
									<label>Start Date</label>
										<input type="text" class="form-control select2 col-sm-12" id="start_date" value="<?php echo date("d-m-Y")?>">
									</div>
									
									<div class="col-md-1">
									<label>Intimation Day</label>
										<input type="text" class="form-control select2 col-sm-12" id="days" value="0">
									</div>
									
									<div class="col-md-2">
									<label>End Date</label>
										<input type="text" class="form-control select2 col-sm-12" id="end_date" value="<?php echo date("d-m-Y")?>">
										<input type="hidden" id="unique_id" value="<?php echo $_GET["id"];?>">
									</div>
									<div class="col-md-3">
									<label>Narration</label>
										<input type="text" class="form-control col-sm-12" id="extra_narration" placeholder="Enter Narration">
									</div>
									
									<div class="col-md-2">	
									<label>&nbsp;</label>									
										<button type="button" class="btn btn-info"  onclick="add_more('add_more')" name="btn_add_data" id="btn_add_data" style="width:100%" ></i>&nbsp;Add</button>
									</div>
									
								
																										
					</div>
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
								<th style="text-align:center;">Start Date</th>
								<th style="text-align:center;">Intimation Alert Day</th>
								<th style="text-align:center;">End Date</th>
								<th style="text-align:center;">Narration</th>
								<th style="text-align:center;">Document 1</th>
								<th style="text-align:center;">Document 2</th>
								<th style="text-align:center;">Document 3</th>
								<th style="text-align:center;">Document 4</th>
								<th style="text-align:center;">Document 5</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sele_materials="select * from extra_library where `unique_id`='$_GET[id]'";
						$result_materials = mysqli_query($conn,$sele_materials);
						if(mysqli_num_rows($result_materials)>0)
						{
							$counting=1;
							while($row_materials =mysqli_fetch_array($result_materials))
							{
							?>
									<tr id="tr_<?php echo $row_materials["extra_id"]?>">	
										<td><?php echo $counting;?></td>
										<td style="text-align:center;">
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_data_extra" data-id="<?php echo $row_materials["extra_id"]?>"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-edit edit_data_extra" 
										data-id="<?php echo $row_materials["extra_id"]?>"
										data-start_date="<?php echo date('d-m-Y',strtotime($row_materials["start_date"]));?>"
										data-intimation_day="<?php echo $row_materials["day"]?>"
										data-end_date="<?php echo date('d-m-Y',strtotime($row_materials["end_date"]));?>"
										
										></a>
										
										
										</td>
										<td><?php echo $row_materials["unique_id"];?></td>
										<td><?php echo date("d/m/Y",strtotime($row_materials["start_date"]));?></td>
										<td><?php echo $row_materials["day"]?></td>
										<td><?php echo date("d/m/Y",strtotime($row_materials["end_date"]));?></td>
										<td><?php echo $row_materials["extra_narration"];?></td>
										<td style="text-align:center;">
										<?php if($row_materials["upload_1"]!=""){?>
										<a href="library_documents_extra/<?php echo $row_materials["upload_1"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_upload" data-id="<?php echo $row_materials["extra_id"]."|".$row_materials["upload_1"]."|upload_1"?>"></a>
										<?php }else{ ?>
										<input type="file" class="btn-primary form-control uplodings" id="uploads_1_<?php echo $row_materials["extra_id"];?>" style="width: 117px;font-size: 18px;" multiple >
										<?php } ?>
										</td>
										
										<td style="text-align:center;">
										<?php if($row_materials["upload_2"]!=""){?>
										<a href="library_documents_extra/<?php echo $row_materials["upload_2"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_upload" data-id="<?php echo $row_materials["extra_id"]."|".$row_materials["upload_2"]."|upload_2"?>"></a>
										<?php }else{ ?>
										<input type="file" class="btn-primary form-control uplodings" id="uploads_2_<?php echo $row_materials["extra_id"];?>" style="width: 117px;font-size: 18px;" multiple >
										<?php } ?>
										</td>
										
										<td style="text-align:center;">
										<?php if($row_materials["upload_3"]!=""){?>
										<a href="library_documents_extra/<?php echo $row_materials["upload_3"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_upload" data-id="<?php echo $row_materials["extra_id"]."|".$row_materials["upload_3"]."|upload_3"?>"></a>
										<?php }else{ ?>
										<input type="file" class="btn-primary form-control uplodings" id="uploads_3_<?php echo $row_materials["extra_id"];?>" style="width: 117px;font-size: 18px;" multiple >
										<?php } ?>
										</td>
										
										<td style="text-align:center;">
										<?php if($row_materials["upload_4"]!=""){?>
										<a href="library_documents_extra/<?php echo $row_materials["upload_4"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_upload" data-id="<?php echo $row_materials["extra_id"]."|".$row_materials["upload_4"]."|upload_4"?>"></a>
										<?php }else{ ?>
										<input type="file" class="btn-primary form-control uplodings" id="uploads_4_<?php echo $row_materials["extra_id"];?>" style="width: 117px;font-size: 18px;" multiple >
										<?php } ?>
										</td>
										
										<td style="text-align:center;">
										<?php if($row_materials["upload_5"]!=""){?>
										<a href="library_documents_extra/<?php echo $row_materials["upload_5"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_upload" data-id="<?php echo $row_materials["extra_id"]."|".$row_materials["upload_5"]."|upload_5"?>"></a>
										<?php }else{ ?>
										<input type="file" class="btn-primary form-control uplodings" id="uploads_5_<?php echo $row_materials["extra_id"];?>" style="width: 117px;font-size: 18px;" multiple >
										<?php } ?>
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
	<div class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label>Edit Liberary</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">Start Date</label>
								<div class="col-sm-4">
									<input type="text" class="form-control select2" id="edit_start_date">
									<input type="hidden" class="form-control" id="edit_lib_id">
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">Intimation Day</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="edit_day">
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">End Date</label>
								<div class="col-sm-4">
									<input type="text" class="form-control select2" id="edit_end_date">
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="col-sm-4">
									
								</div>
								<div class="col-sm-4">
									<button class="btn btn-primary form-control" id="submit_lib">Submit</button>
								</div>
								<div class="col-sm-4">
									
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
					
	
	

		
<?php include("footer.php");?>
<script>
$(document).ready(function(){
	$('#start_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	$('#end_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	$('#edit_start_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	$('#edit_end_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
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
/*
$(document).on('change','#start_date',function()
{
	var get_start_date= $("#start_date").val();
	var get_days= parseInt($("#days").val());
	var datePieces = get_start_date.split("-");
	var preFinalDate = [datePieces[1] , datePieces[0] , datePieces[2]];
	var someDate = new Date(preFinalDate.join("-"));
	someDate.setDate(someDate.getDate() + get_days);
	var dd = someDate.getDate();
	var mm = someDate.getMonth() + 1;
	var y = someDate.getFullYear();
	var get_end_date = dd +'-'+ mm +'-'+y;
	$("#end_date").val(get_end_date);

})

$(document).on('change','#end_date',function()
{
	var get_days= parseInt($("#days").val());
	var get_end_date= $("#end_date").val();
	var datePieces = get_end_date.split("-");
	var preFinalDate = [datePieces[1] , datePieces[0] , datePieces[2]];
	var someDate = new Date(preFinalDate.join("-"));
	someDate.setDate(someDate.getDate() - get_days);
	var dd = someDate.getDate();
	var mm = someDate.getMonth() + 1;
	var y = someDate.getFullYear();
	var start_date = dd +'-'+ mm +'-'+y;
	$("#start_date").val(start_date);

})

$(document).on('change','#days',function()
{
	var get_start_date= $("#start_date").val();
	var get_days= parseInt($("#days").val());
	var datePieces = get_start_date.split("-");
	var preFinalDate = [datePieces[1] , datePieces[0] , datePieces[2]];
	var someDate = new Date(preFinalDate.join("-"));
	someDate.setDate(someDate.getDate() + get_days);
	var dd = someDate.getDate();
	var mm = someDate.getMonth() + 1;
	var y = someDate.getFullYear();
	var get_end_date = dd +'-'+ mm +'-'+y;
	$("#end_date").val(get_end_date);

})*/


// add data
function add_more(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_more') {
				var start_date = $('#start_date').val(); 
				var end_date = $('#end_date').val(); 
				var days = $('#days').val(); 
				var unique_id = $('#unique_id').val(); 
				var extra_narration = $('#extra_narration').val(); 
				
				billData = '&action_type='+type+'&start_date='+start_date+'&end_date='+end_date+'&days='+days+'&unique_id='+unique_id+'&extra_narration='+extra_narration;
	}
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_library.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},		
        success: function(msg,status, xhr){
		document.getElementById("overlay_div").style.display="none";
		
		after_update();
		
        }
    });
}

$(document).on("click",".delete_data_extra",function(){
	var ids= $(this).attr("data-id");
	billData = '&action_type=delete_data_extra&ids='+ids;
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
	
});

$(document).on("click",".edit_data_extra",function(){
	var ids= $(this).attr("data-id");
	var start_date = $(this).attr("data-start_date");
	var intimation_day = $(this).attr("data-intimation_day");
	var end_date = $(this).attr("data-end_date");
	
	$('#edit_lib_id').val(ids);
	$('#edit_start_date').val(start_date);
	$('#edit_day').val(intimation_day);
	$('#edit_end_date').val(end_date);
	
	$('.modal').modal('show');
});

$(document).on("click","#submit_lib",function(){
	
	var start_date = $('#edit_start_date').val();
	var day = $('#edit_day').val();
	var end_date = $('#edit_end_date').val();
	var lib_id = $('#edit_lib_id').val();
	
	billData = '&action_type=edit_data_extra&ids='+lib_id+'&start_date='+start_date+'&day='+day+'&end_date='+end_date;
	$.ajax({
		type: 'POST',
		url: '<?php $base_url; ?>save_library.php',
		data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},		
		success: function(msg,status, xhr){
		document.getElementById("overlay_div").style.display="none";

		location.reload();
		}
	});
	
});

function after_update(){
	
	var unique_id = $('#unique_id').val(); 
	billData = '&action_type=after_update&unique_id='+unique_id;
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_library.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},		
        success: function(msg,status, xhr){
		document.getElementById("overlay_div").style.display="none";
		
		$("#display_data").html(msg);
		
        }
    });
	
}


$(document).on("change", ".uplodings", function () {
                var fd = new FormData();
                var files = $(this)[0].files[0];
				var idss=$(this).attr("id");
				var acb = $(this).val();
	
		if(acb ==""){
			alert("Please Select File First");
			return false;
		}
               var totalfiles = $(this)[0].files.length;
			   
			   for (var index = 0; index < totalfiles; index++) {
				  
				   var sizes = $(this)[0].files[index].size ;
				   if(sizes < 10380902)
					{
						 fd.append("file[]", $(this)[0].files[index]);
					}
			   }

			   
			   fd.append('action_type', "add_uploading");
                fd.append('idss', idss);
       
                $.ajax({
                    url: 'save_library.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        location.reload();
                    },
                });
            });
			
$(document).on("click",".delete_upload",function(){
	var ids= $(this).attr("data-id");
	billData = '&action_type=delete_upload&ids='+ids;
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
		location.reload();
		}
    });
}
	
});

</script>
