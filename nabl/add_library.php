
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

 $job_serial="SELECT * FROM document_library ORDER BY unique_id DESC";
$job_res = mysqli_query($conn, $job_serial);

if (mysqli_num_rows($job_res) > 0) {
	$job_r = mysqli_fetch_array($job_res);
	
	$exploding= explode("/",$job_r["unique_id"]);
	$plused= intval($exploding[2])+1;
	$sets= sprintf('%05d', $plused);
	$set_unique="RMLS/LIBS/".$sets;
}else{
	$set_unique="RMLS/LIBS/00001";
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
		Add Library
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
									<div class="col-md-4">
									<label>Document Type<span style="color:red;">*</span></label>
										<select name="doc_type" id="doc_type" required class="form-control select2">
										<option value="">Select Document Type</option>
										<option value="NABL DOCUMENT">NABL Document</option>
										<option value="GOV PROOF PERSONAL">Gov. Proof Personel/Staff</option>
										<option value="GOV PROOF RMS">Gov. Proof RMS</option>
										<option value="INSURANCE/POLICY">Insurance / Policy etc.</option>
										<option value="VEHICLE DETAIL">Vehicle Details / Policy </option>
										<option value="OTHER LAB DATA">Other Lab Data</option>
										<option value="STANDARD">Standard</option>
										<option value="CERTIFICATE & APPROVAL LETTERS OF RMS">Certificate & Approval Letters of RMS</option>
										<option value="LOAN DETAILS">Loan Details</option>
										<option value="BANKING DOCUMENTS">Banking Docs</option>
										<option value="TENDER">Tender</option>
										<option value="CUSTOMER DATA">Customer Data</option>
										<option value="CRM and RM Certificates">CRM and RM Certificates</option>
										<option value="OTHER">Other</option>
								
										</select>
									</div>
									<div class="col-md-4">
									<label>Unique Id<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="doc_id" id="doc_id" value="<?php echo $set_unique;?>" disabled required>
									</div>
									
									<div class="col-md-4">
									<label>Document Name<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="doc_name" id="doc_name" placeholder="Enter Document Name">
									</div>
					</div>
					<br>
					<div class="row">
									<div class="col-md-4">
									<label>Narration<span style="color:red;">*</span></label>
										<textarea id="editor1" name="editor1" tabindex="16" class="col-sm-12 form-control"required style="height:30px!important;"></textarea>
									</div>
									<div class="col-md-4">
									<label>Master Document</label>
										<input type="file" tabindex="18" class="col-sm-12 form-control" placeholder="" id="upload_img" name="upload_img">
									</div>
									
									<div class="col-md-2" style="text-align: center;">
											<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('add')" style="margin-bottom:25px;    border-radius: 20px;"> Save</button>
									        <span id="available_msg" style="color:red;font-size:20px;"></span>
									</div>
									
									<div class="col-md-2">
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
	$(function () {
    $('.select2').select2();
	$("#error_msg_show").hide();
  });
})

function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {		
				var doc_type = $('#doc_type').val(); 
				var doc_name = $('#doc_name').val(); 
				var name_of_work = CKEDITOR.instances.editor1.getData();
	}
	else{
			
	
				billData = 'action_type='+type+'&id='+id;
    }
	
	// set blank message to submit
	var error_msg="";
	if(doc_type ==""){
		error_msg +="Please Select Document Type"+"<br>";
	}
	if(doc_name ==""){
		error_msg +="Please Enter Document Name"+"<br>";
	}
	
	if(name_of_work ==""){
		error_msg +="Name Of Work Required"+"<br>";
	}
	
	

	
	
	if(doc_type !== ""&& doc_name !== ""&& name_of_work !== ""&& error_msg=="")
	{
		form_data = new FormData();
		var acb = $('#upload_img').val();
	
		if(acb !=""){
		form_data.append("file", document.getElementById('upload_img').files[0]);
		
		var name = document.getElementById("upload_img").files[0].name;
		
		var f = document.getElementById("upload_img").files[0];
		  var fsize = f.size||f.fileSize;
		  if(fsize > 5242880)
		  {
		   alert("File Size is very big");
		   return false;
		  }
			}
		
		form_data.append("action_type", type);
		form_data.append("doc_type", doc_type);
		form_data.append("doc_name", doc_name);
		form_data.append("name_of_work", name_of_work);
    $.ajax({
        url : "<?php $base_url; ?>save_library.php",
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
			alert("Document Is Successfully Saved");
		    window.location.href="<?php $base_url; ?>view_library_list.php";
			}
			
        }
    });
  }else{
	  alert("AllFields Required..");
	  $("#error_msg_put").html(error_msg);
	  $("#error_msg_show").show();
  }
}

</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>