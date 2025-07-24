
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

$explodings=explode("|",$_GET["id"]);
$auto_id=$explodings[0];
$unique_id=$explodings[1];

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
		EXTRA CALIBRATION LIST FOR (<?php echo $unique_id;?>)
		</h1>
	</div>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-info">
				<div class="col-md-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="active tab-pane" id="clients">
					<a data-toggle="collapse" href="#collapse1" class="btn btn-primary" style="" id="add_material_button">Add Calibration Details</a>
					<form class="" method="post" >
					<br>
						<div class="row panel-collapse collapse" id="collapse1">
						   <div class="row">
										<div class="col-md-1">&nbsp;</div>
										<div class="col-md-2">
										<label>Calibration Date<span style="color:red;">*</span></label>
											<input type="text" class="form-control select2 col-sm-12" id="cali_date" value="<?php echo date("d-m-Y")?>" placeholder="Enter Calibration Date">
										</div>
										
										<div class="col-md-3">
										<label>Calibration Interval Year<span style="color:red;">*</span></label>
											<input type="text" class="form-control select2 col-sm-12" id="cali_inter_year" value="" placeholder="Enter Calibration Interval Year">
										</div>
										
										<div class="col-md-2">
										<label>Due Date<span style="color:red;">*</span></label>
											<input type="text" class="form-control select2 col-sm-12" id="due_date" value="<?php echo date("d-m-Y")?>" placeholder="Enter Due Date">
										</div>
										
										<div class="col-md-3">
										<label>Calibrated By<span style="color:red;">*</span></label>
											<input type="text" class="form-control select2 col-sm-12" id="calibrated_by" value="" placeholder="Enter Calibrated By">
										</div>
							</div>
							<br>
							<div class="row">
										<div class="col-md-1">&nbsp;</div>
										<div class="col-md-4">
										<label>Reported UOM</label>
											<input type="text" class="form-control select2 col-sm-12" id="reported_uom" value="">
										</div>
										
										<div class="col-md-1">
										<label>Upload Scan Copy<span style="color:red;">*</span></label>
										<input type="file" tabindex="18" class="col-sm-12 form-control" placeholder="" id="upload_img" name="upload_img">
										</div>
										
										<div class="col-md-2">
										<label>Date of Equipment Sent</label>
											<input type="text" class="form-control select2 col-sm-12" id="equip_sent_date" value="" placeholder="Enter Date of Equipment Sent">
										</div>
										
										<div class="col-md-3">
										<label>Date of Equipment Received</label>
											<input type="text" class="form-control select2 col-sm-12" id="equip_rec_date" value="" placeholder="Enter Date of Equipment Received">
										</div>
											<input type="hidden" id="unique_id" value="<?php echo $_GET["id"];?>">
										
										
							</div>
							
							<br>
							<div class="row">
										<div class="col-md-1">&nbsp;</div>
										<div class="col-md-2">
										<label>Date of Certificate Received</label>
											<input type="text" class="form-control select2 col-sm-12" id="certi_rec_date" value="" placeholder="Enter Date of Certificate Received">
										</div>
										
										<div class="col-md-4">
										<label>Master Equipment Used</label>
											<input type="text" class="form-control select2 col-sm-12" id="master_equip" value="" placeholder="Enter Master Equipment Used">
										</div>
										
										<div class="col-md-2">
										<label>Due Date of Master Equipment Used</label>
											<input type="text" class="form-control select2 col-sm-12" id="master_equip_date" value="" placeholder="Enter Due  Date of Master Equipment Used">
										</div>
										
										<div class="col-md-2">
										<label>Traceability of Master Equipment</label>
											<input type="file" tabindex="18" class="col-sm-12 form-control" placeholder="" id="traceability" name="traceability">
										</div>
											<input type="hidden" id="unique_id" value="<?php echo $_GET["id"];?>">
										
										
							</div>
							<br>
							<div class="row">
										<div class="col-md-5">&nbsp;</div>	
										<div class="col-md-4">	
										<label>&nbsp;</label>									
											<button type="button" class="btn btn-info"  onclick="add_more('add_more')" name="btn_add_data" id="btn_add_data" style="width:50%" ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Add Extra Calibration</button>
										</div>
									<div class="col-md-3">
									<div class="" id="error_msg_show">
									<div class="row" id="error-container">
										 <div class="span">  
											 <div class="alert alert-error">
												<button type="button" class="close" data-dismiss="alert">×</button>
												 <div id="error_msg_put"></div>
											 </div>
										   </div>
										</div>
									</div>
									</div>
							</div>
						</div>
					<hr>
					
					<br>
					<div class="row">
						<div id="display_data">
						<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
						<thead>
							<tr>
								<th style="text-align:center;width:2px;">Sr No</th>
								<th style="text-align:center;width:2px;">Action</th>
								<th style="text-align:center;">auto_id</th>
								<th style="text-align:center;">Unique Id</th>
								<th style="text-align:center;">Calibration Date</th>
								<th style="text-align:center;">Calibration Interval year</th>
								<th style="text-align:center;">Due Date</th>
								<th style="text-align:center;">Calibrated By</th>
								<th style="text-align:center;">Reported uom</th>
								<th style="text-align:center;">Equipment Sent Date</th>
								<th style="text-align:center;">Equipment Received Date</th>
								<th style="text-align:center;">Certificate Received Date</th>
								<th style="text-align:center;">Master Equipment Used</th>
								<th style="text-align:center;">Master Equipment Due Date</th>
								<th style="text-align:center;">Scan Copy</th>
								<th style="text-align:center;">traceability</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sele_materials="select * from extra_calibration where `unique_id`='$auto_id'";
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
										
										<a href="edit_extra_calibration.php?id=<?php echo $row_materials["extra_id"]."|".$row_materials["auto_id"]."|".$row_materials["unique_id"]?>" class="glyphicon glyphicon-edit"></a>
										
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_data_extra" data-id="<?php echo $row_materials["extra_id"]?>"></a>
										
										
										</td>
										<td><?php echo $row_materials["auto_id"];?></td>
										<td><?php echo $row_materials["unique_id"];?></td>
										<td><?php echo date("d/m/Y",strtotime($row_materials["calibration_date"]));?></td>
										<td><?php echo $row_materials["calibration_interval_year"]?></td>
										<td><?php echo date("d/m/Y",strtotime($row_materials["due_date"]));?></td>
										<td><?php echo $row_materials["calibrated_by"]?></td>
										<td><?php echo $row_materials["reported_uom"]?></td>
										<td><?php echo $row_materials["date_of_equipment_sent"]?></td>
										<td><?php echo $row_materials["date_of_equipment_record"]?></td>
										<td><?php echo $row_materials["date_of_certificate_record"]?></td>
										<td><?php echo $row_materials["master_equipment_used"]?></td>
										<td><?php echo $row_materials["due_date_of_master_equipment"]?></td>
										<td style="text-align:center;">
										<?php if($row_materials["scan_copy"]!=""){?>
										<a href="extra_calibration_scan/<?php echo $row_materials["scan_copy"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<?php }?>
										
										</td>
										
										<td style="text-align:center;">
										<?php if($row_materials["traceability"]!=""){?>
										<a href="traceability/<?php echo $row_materials["traceability"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<?php }?>
										
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
	$("#error_msg_show").hide();
	
	$('#cali_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	
	$('#due_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	
	$('#equip_sent_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	
	$('#equip_rec_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	
	$('#certi_rec_date').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	
	$('#master_equip_date').datepicker({
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

// add data
function add_more(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_more') 
	{
				var cali_date = $('#cali_date').val(); 
				var cali_inter_year = $('#cali_inter_year').val(); 
				var due_date = $('#due_date').val(); 
				var calibrated_by = $('#calibrated_by').val(); 
				var reported_uom = $('#reported_uom').val(); 
				var equip_sent_date = $('#equip_sent_date').val(); 
				var equip_rec_date = $('#equip_rec_date').val(); 
				var certi_rec_date = $('#certi_rec_date').val(); 
				var master_equip = $('#master_equip').val(); 
				var master_equip_date = $('#master_equip_date').val(); 
				var unique_id = $('#unique_id').val(); 
	}
	
	var error_msg="";
	if(cali_date ==""){
		error_msg +="Please Enter Calibration Date"+"<br>";
	}
	if(cali_inter_year ==""){
		error_msg +="Please Enter Calibration Interval Year"+"<br>";
	}
	if(due_date ==""){
		error_msg +="Please Enter Due Date"+"<br>";
	}
	if(calibrated_by ==""){
		error_msg +="Please Enter Calibrated By"+"<br>";
	}
	
	form_data = new FormData();
	var acb = $('#upload_img').val();
	if(acb !="")
	{
		form_data.append("file", document.getElementById('upload_img').files[0]);
		
		var name = document.getElementById("upload_img").files[0].name;
		
		var f = document.getElementById("upload_img").files[0];
		  var fsize = f.size||f.fileSize;
		  if(fsize > 5242880)
		  {
		   alert("File Size is very big");
		   return false;
		  }
	}else{
		error_msg +="Please Upload Scan Copy"+"<br>";
	}
	
	
	var traceability = $('#traceability').val();
	if(traceability !="")
	{
		form_data.append("traceability", document.getElementById('traceability').files[0]);
		
		var name = document.getElementById("traceability").files[0].name;
		
		var f = document.getElementById("traceability").files[0];
		  var fsize = f.size||f.fileSize;
		  if(fsize > 5242880)
		  {
		   alert("File Size is very big");
		   return false;
		  }
	}
	
	if(error_msg=="")
	{
		
		form_data.append("action_type", type);
		form_data.append("cali_date", cali_date);
		form_data.append("cali_inter_year", cali_inter_year);
		form_data.append("due_date", due_date);
		form_data.append("calibrated_by", calibrated_by);
		form_data.append("reported_uom", reported_uom);
		form_data.append("equip_sent_date", equip_sent_date);
		form_data.append("equip_rec_date", equip_rec_date);
		form_data.append("certi_rec_date", certi_rec_date);
		form_data.append("master_equip", master_equip);
		form_data.append("master_equip_date", master_equip_date);
		form_data.append("unique_id", unique_id);
    
	$.ajax({
        url : "<?php $base_url; ?>save_calibration.php",
		type: "POST",
		dataType:'JSON',
		data : form_data,
		processData: false,
		contentType: false,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(data){
			document.getElementById("overlay_div").style.display="none";
			if(data.statuses=='1'){
			alert("Calibration Is Successfully Saved");
		    location.reload();
			}
			
        }
    });
	}else{
	  alert("AllFields Required..");
	  $("#error_msg_put").html(error_msg);
	  $("#error_msg_show").show();
  }
	}

$(document).on("click",".delete_data_extra",function(){
	var ids= $(this).attr("data-id");
	billData = '&action_type=delete_data_extra&ids='+ids;
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
