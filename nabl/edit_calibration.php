
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
$calibration_id=$_GET["id"];
$job_serial="SELECT * FROM calibration_document WHERE `calibration_id`=".$calibration_id;
$job_res = mysqli_query($conn, $job_serial);
$job_r = mysqli_fetch_array($job_res);
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
		Add Calibration
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
									<label>Auto Id</label>
										<input type="text" class="form-control" name="auto_id" id="auto_id" value="<?php echo $job_r['auto_id'];?>" disabled required>
									</div>
									
									<div class="col-md-4">
									<label>Unique Id<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="unique_id" id="unique_id" value="<?php echo $job_r['unique_id'];?>"  placeholder="Enter Unique Id" required>
									</div>
									
									<div class="col-md-4">
									<label>Equipment Name<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="equipment_name" id="equipment_name" placeholder="Enter Equipment Name" value="<?php echo $job_r['equipment_name'];?>">
									</div>
					</div>
					<br>
					<div class="row">
									<div class="col-md-4">
									<label>Model<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="model" id="model" value="<?php echo $job_r['model'];?>"  placeholder="Enter Model" required>
									</div>
									
									<div class="col-md-4">
									<label>Man Sr. No.<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="man_sr_no" id="man_sr_no" value="<?php echo $job_r['man_ser_no'];?>"  placeholder="Enter Man Sr. No." required>
									</div>
									
									<div class="col-md-4">
									<label>Make<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="make" id="make" placeholder="Enter Make" value="<?php echo $job_r['make'];?>">
									</div>
					</div>
					<br>
					<div class="row">
									<div class="col-md-4">
									<label>Manufacture Year<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="manufacture_year" id="manufacture_year" value="<?php echo $job_r['manufacture_year'];?>"  placeholder="Enter Manufacture Year" required>
									</div>
									
									<div class="col-md-4">
									<label>Ranges.<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="ranges" id="ranges" value="<?php echo $job_r['ranges'];?>"  placeholder="Enter Ranges" required>
									</div>
									
									<div class="col-md-4">
									<label>Accuracy<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="accuracy" id="accuracy" placeholder="Enter Accuracy" value="<?php echo $job_r['accuracy'];?>">
									</div>
					</div>
					<br>
					<div class="row">
									<div class="col-md-4">
									<label>Least Count<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="least_count" id="least_count" value="<?php echo $job_r['least_count'];?>"  placeholder="Enter Least Count" required>
									</div>
									
									<div class="col-md-4">
									<label>Location Of Use<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="location_of_use" id="location_of_use" value="<?php echo $job_r['location_of_use'];?>"  placeholder="Enter Location Of Use" required>
									</div>
									
									<div class="col-md-4">
									<label>Point Tobe Calibration</label>
										<input type="text" class="form-control" name="point_calibration" id="point_calibration" placeholder="Enter Point Tobe Calibration" value="<?php echo $job_r['point_to_be_calibration'];?>">
									</div>
					</div>
					
					<br>
					<div class="row">
									<div class="col-md-4">
									<label>Calibration Mode<span style="color:red;">*</span></label>
										<select name="calibration_mode" id="calibration_mode" class="form-control">
											<option value="">Select Calibration Mode</option>
											<option value="At Lab" <?php if($job_r['calibration_mode']=="At Lab"){ echo "selected";}?>>At Lab</option>
											<option value="Sent To Cali. Lab" <?php if($job_r['calibration_mode']=="Sent To Cali. Lab"){ echo "selected";}?>>Sent To Cali. Lab</option>
										</select>
									</div>
									
									<div class="col-md-4">
									<label>Intimation Alert Day<span style="color:red;">*</span></label>
										<input type="text" class="form-control" name="intimation_day" id="intimation_day" value="<?php echo $job_r['intimation_day'];?>"  placeholder="Enter Intimation Alert Day" required>
									</div>
									
									<div class="col-md-4">
									<label>User Manual</label>
										<input type="file" tabindex="18" class="col-sm-12 form-control" placeholder="" id="upload_img" name="upload_img">
									</div>
									<input type="hidden" name="txt_id" id="txt_id" value="<?php echo $job_r['calibration_id'];?>">
									
					</div>
					<br>
					<div class="row">
									<div class="col-md-4">&nbsp;</div>
									<div class="col-md-4" style="text-align: center;">
											<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('edit')" style="margin-bottom:25px;border-radius: 20px;"> Edit</button>
									        <span id="available_msg" style="color:red;font-size:20px;"></span>
									</div>
									
									<div class="col-md-4">
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
    if (type == 'edit') {		
				var unique_id = $('#unique_id').val(); 
				var equipment_name = $('#equipment_name').val(); 
				var model = $('#model').val(); 
				var man_sr_no = $('#man_sr_no').val(); 
				var make = $('#make').val(); 
				var manufacture_year = $('#manufacture_year').val(); 
				var ranges = $('#ranges').val(); 
				var accuracy = $('#accuracy').val(); 
				var least_count = $('#least_count').val(); 
				var location_of_use = $('#location_of_use').val(); 
				var point_calibration = $('#point_calibration').val(); 
				var calibration_mode = $('#calibration_mode').val(); 
				var intimation_day = $('#intimation_day').val(); 
				var auto_id = $('#auto_id').val(); 
				var txt_id = $('#txt_id').val(); 
	}
	else{
			
	
				billData = 'action_type='+type+'&id='+id;
    }
	
	// set blank message to submit
	var error_msg="";
	if(unique_id ==""){
		error_msg +="Please Enter Unique Id"+"<br>";
	}
	
	if(equipment_name ==""){
		error_msg +="Please Enter Equipment Name"+"<br>";
	}
	
	if(model ==""){
		error_msg +="Please Enter Model"+"<br>";
	}
	
	if(man_sr_no ==""){
		error_msg +="Please Enter man sr no"+"<br>";
	}
	
	if(make ==""){
		error_msg +="Please Enter make"+"<br>";
	}
	
	if(manufacture_year ==""){
		error_msg +="Please Enter manufacture year"+"<br>";
	}
	
	if(ranges ==""){
		error_msg +="Please Enter ranges"+"<br>";
	}
	
	if(accuracy ==""){
		error_msg +="Please Enter accuracy"+"<br>";
	}
	
	if(least_count ==""){
		error_msg +="Please Enter least count"+"<br>";
	}
	
	if(location_of_use ==""){
		error_msg +="Please Enter location of use"+"<br>";
	}
	
	if(calibration_mode ==""){
		error_msg +="Please Select calibration mode"+"<br>";
	}
	
	if(intimation_day ==""){
		error_msg +="Please Enter intimation day"+"<br>";
	}
	
	

	
	
	if(unique_id !== "" && equipment_name !== "" && model !== "" && man_sr_no!=="" && make!=="" && manufacture_year!=="" && ranges!=="" && accuracy!=="" && least_count!=="" && location_of_use!=="" && calibration_mode!=="" && intimation_day!=="" && error_msg=="")
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
		form_data.append("unique_id", unique_id);
		form_data.append("equipment_name", equipment_name);
		form_data.append("model", model);
		form_data.append("man_sr_no", man_sr_no);
		form_data.append("make", make);
		form_data.append("manufacture_year", manufacture_year);
		form_data.append("ranges", ranges);
		form_data.append("accuracy", accuracy);
		form_data.append("least_count", least_count);
		form_data.append("location_of_use", location_of_use);
		form_data.append("calibration_mode", calibration_mode);
		form_data.append("intimation_day", intimation_day);
		form_data.append("point_calibration", point_calibration);
		form_data.append("auto_id", auto_id);
		form_data.append("txt_id", txt_id);
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
			alert("Calibration Is Successfully Updated");
		    window.location.href="<?php $base_url; ?>view_calibration_list.php";
			}
			if(data.statuses=='0'){
			alert("Sorry....Unique Id Is Already Available.");
		    return false;
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