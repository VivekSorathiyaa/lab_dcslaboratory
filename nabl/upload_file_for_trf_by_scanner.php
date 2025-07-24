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


	
	
$txt_trf_no= $_GET["trf_no"]; 

// to get job for agency id
$sel_job="select * from job where `trf_no`='$txt_trf_no'";
$query_job= mysqli_query($conn,$sel_job);
$result_job=mysqli_fetch_array($query_job);
$refno= $result_job["refno"];


$ref_date= date('d/m/Y', strtotime($result_job["date"]));
$rec_sam_date= date('d/m/Y', strtotime($result_job["sample_rec_date"]));

$completed_satus=$result_job["job_completed_by_scanner"];
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
					FILE UPLOAD FOR S.R.F. No: <?php echo $_GET["trf_no"];?>
				</h1>
			</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">S.R.F. No:</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Reference No:</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Reference Date:</label>
									</div>
									
									<div class="col-sm-3">
									<label for="inputEmail3" class="col-sm-2 control-label">Receive sample Date:</label>
									</div>
								</div>
								<div class="row">
									
										  <div class="col-sm-3">
											<input type="text" class="form-control" value="<?php echo $txt_trf_no;?>" id="txt_trf_no" name="txt_trf_no" disabled>
										  </div>
										
										
										  
											<div class="col-sm-3">
												
													<input type="text" class="form-control" value="<?php echo $refno;?>" id="txt_ref_no" name="txt_ref_no" disabled>
											</div>
										
										  
											
											
											<div class="col-md-3">
													<input type="text"  class="form-control" name="txt_ref_date" id="txt_ref_date" value="<?php echo $ref_date;?>" disabled>
											
											</div>
											
											<div class="col-md-3">
													<input type="text"  class="form-control" name="txt_sample_date" id="txt_sample_date" value="<?php echo $rec_sam_date;?>" disabled>
											
											</div>
									
								</div>
								<br>
							<?php //if($completed_satus=="0") {?>
							<div class="panel-group">
								<div class="box box-info">
									<div class="box-body">
									  <div class="table-responsive" id="display_data" style="min-height:150px;">
										<table class="table no-margin">
										  <thead>
										  <tr>
											<th>&nbsp;</th>
											<th>&nbsp;</th>
										  </tr>
										  <tr>
											<th>
											<label for="inputEmail3" class="control-label">
											UPLOAD EXCEL:
											</label>
											</th>
											<th><input type="file" name="txt_excel" id="txt_excel" class="form-control"></th>
											
										  </tr>
										  </thead>
										  <tbody>
										  
										  </tbody>
										</table>
									  </div>
									</div>
								</div>
							</div>
							<br>
							<div class="box box-info">
							<br>
							<div class="row">
									<div class="col-md-5">
									</div>
									<div class="col-md-6">
									<button type="button" class="btn btn-info"  onclick="saveclient('upload_excel')" style="width:150px;font-size:20px;">Upload</button> 
									</div>
						   </div>
							<?php// } ?>
								<br>
								<br>
								<br>
								<div class="table-responsive" style="min-height:150px;" border="1">
										<table class="table no-margin" align="center">
										  <thead>
										  <tr>
											<th colspan="6" style="text-align:center;font-size:30px;">List Of Uploaded File For S.R.F. No <?php echo $_GET["trf_no"]?></th>
										  </tr>
										  <tr>
											<th>&nbsp;</th>
											<th>Sr NO</th>
											<th>Reference No</th>
											<th>Reference Date</th>
											<th>Receive Sample Date</th>
											<th>ACTION</th>
										  </tr>
										  <?php
                                          $sel_excel="select * from scanned_trf_document where `trf_no`='$_GET[trf_no]' AND `is_deleted`=0 ORDER BY `document_id` DESC";
										  $query_excel=mysqli_query($conn,$sel_excel);
										  if(mysqli_num_rows($query_excel)>0)
										  {
											$counting=1;
											while($one_excel=mysqli_fetch_array($query_excel))
											{  
										  ?>
											  <tr>
												<td>&nbsp;</td>
												<td><?php echo $counting;?></td>
												<td><?php echo $one_excel["ref_no"];?></td>
												<td><?php echo date("d/m/Y",strtotime($one_excel["ref_date"]));?></td>
												<td><?php echo date("d/m/Y",strtotime($one_excel["rec_sam_date"]));?></td>
												<td>
												<a class="btn btn-success" href="scanned_document/TRF_NO_<?php echo $one_excel["trf_no"]."/".$one_excel["document"];?>" target="_blank" style="width:150px;font-size:20px;">Download</a>
												&nbsp;
												<button type="button" class="btn btn-danger delete_uploaded_documents"  id="<?php echo $one_excel["document_id"]."|".$one_excel["document"];?>" style="width:150px;font-size:20px;">Delete</button>
												</td>
											  </tr>
										  <?php
											$counting++;										  
										    }
										   }
										   ?>
										  </thead>
										  <tbody>
										  
										  </tbody>
										</table>
								 </div>
								 <br>
								</div>
							
							
							
							</div>
						
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>
		  	  
<script>
$(document).ready(function(){





function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'upload_excel') {		
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_ref_no = $('#txt_ref_no').val(); 
				var txt_ref_date = $('#txt_ref_date').val(); 
				var txt_sample_date = $('#txt_sample_date').val(); 
	}
	
	form_data = new FormData();
		var acb = $('#txt_excel').val();
	
		if(acb !=""){
		form_data.append("file", document.getElementById('txt_excel').files[0]);
		
		var name= document.getElementById('txt_excel').files[0].name;
		var ext = name.split('.').pop().toLowerCase();
		 if(jQuery.inArray(ext, ['png','jpg','jpeg','pdf','xlsx','zip']) == -1)
		 {
		  alert("Invalid  File Format only\n 'png','jpg','jpeg','pdf','xlsx','zip'");
		  return false;
		 }
		 
		 var f = document.getElementById("txt_excel").files[0];
		 var fsize = f.size||f.fileSize;
		 if(fsize > 40000000)
		 {
		  alert("File Size is very big\n Maximum Size:35 MB");
		  return false;
		 }
		
		}else{
			alert("Upload Excel First...");
			return false;
		}
		
		if(txt_trf_no ==""){
			alert("Sorry  somethng Went Wrong...");
			return false;
		}
		
		
		form_data.append("action_type", type);
		form_data.append("txt_trf_no", txt_trf_no);
		form_data.append("txt_ref_no", txt_ref_no);
		form_data.append("txt_ref_date", txt_ref_date);
		form_data.append("txt_sample_date", txt_sample_date);
		
    $.ajax({
        url : "<?php $base_url; ?>save_upload_file_for_trf_by_scanner.php",
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
			alert("Successfully Upload..");
		    window.location.href="<?php $base_url; ?>upload_file_for_trf_by_scanner.php?trf_no="+txt_trf_no;
			
        }
    });
  
}

});



$(document).on("click",".delete_uploaded_documents",function(){
    
    var clicked_id=$(this).attr("id");
	var txt_trf_no = $('#txt_trf_no').val();
   billData = '&action_type=delete_uploaded_documents&clicked_id='+clicked_id+'&txt_trf_no='+txt_trf_no;			
   
   if(confirm("Are you Sure To Delete ?"))
   {
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_upload_file_for_trf_by_scanner.php',
        data: billData,
		dataType:'JSON',
        success:function(msg){
			alert("Successfully Deleted..");
          window.location.href="<?php $base_url; ?>upload_file_for_trf_by_scanner.php?trf_no="+txt_trf_no;
		}
    });
   }
});
</script>
