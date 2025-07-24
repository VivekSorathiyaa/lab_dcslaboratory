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



$temporary_trf_no= $_GET["temporary_trf_no"];
$serial="SELECT * FROM  job WHERE `temporary_trf_no`='$temporary_trf_no'";
$res = mysqli_query($conn, $serial);
$get_one_job= mysqli_fetch_array($res);





	$client_code=$get_one_job["client_code"];
	$agency=$get_one_job["agency"];
	$tpi_code=$get_one_job["tpi_code"];
	$pmc_code=$get_one_job["pmc_code"];
	$get_nameofwork=$get_one_job["nameofwork"];
	$agreement_no=$get_one_job["agreement_no"];
	$get_refno=$get_one_job["refno"];
	$person_name=$get_one_job["person_name"];
	$person_auth_mobile=$get_one_job["person_auth_mobile"];
	$sel_sent_by=$get_one_job["sample_sent_by"];
	$condition_of_sample_receved=$get_one_job["condition_of_sample_receved"];
	$trf_no=$get_one_job["trf_no"];
	$billing_to_id=$get_one_job["billing_to_id"];
	$tpi_or_auth=$get_one_job["tpi_or_auth"];
	$pmc_heading=$get_one_job["pmc_heading"];
	if($get_refno!="")
	{
		$get_refdate=date("d-m-Y",strtotime($get_one_job["date"]));		
	}else{
		$get_refdate="";		
	}
	$trf_no=$get_one_job["trf_no"];
	$scan_document=$get_one_job["scan_document"];

	$sample_rec_date=date("d-m-Y",strtotime($get_one_job["sample_rec_date"]));

?>

<?php


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
		Edit Trf Details For No : <?php echo $trf_no." (Date:".$sample_rec_date.")";?>
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
					<div style="border:3px solid black;padding:5px">
					   <div class="row">
							<div class="col-md-12" style="border: 2px solid black;font-size: 22px;font-style: bold;font-family: book antiqa;margin-left: 1.4%;width: 97%;">
								<label for="inputEmail3" class="control-label">EDIT TRF DETAILS</label>
							</div>
						</div>
					   <br>
					<div class="row">									
									<div class="col-md-6">
									<label>Client(End Customer):</label>
										<select class="form-control select2 col-sm-12" tabindex="6"   id="client_code" name="client_code"  >
											<option value="">Select Client(End Customer)</option>
											<?php
											$get_client="SELECT *FROM client where `clientisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while($r = mysqli_fetch_array($client_res)){?>
												<option value="<?php echo $r["client_code"]?>" <?php if($client_code==$r["client_code"]){ echo "selected"; }?>><?php echo str_replace("zxctxavb","'",$r['clientname']);?></option>
												<?php } }?>
										</select>
									</div>
									<div class="col-md-6">
									<label>Agency / Contractor / Customer*:</label>
											<select class="form-control  select2 col-sm-12"  tabindex="9"  id="select_agency" name="select_agency" required >
														<option value="">Select Agency</option>
														<?php 
															$cat_sql = "select * from agency_master where `isdeleted`=0";
														
															$cat_result = mysqli_query($conn, $cat_sql);

																while($cat_row = mysqli_fetch_assoc($cat_result)) {
															
															?>
															<option value="<?php echo $cat_row['agency_id']; ?>" <?php if($agency==$cat_row['agency_id']){ echo "selected"; } ?>>
															<?php echo str_replace("zxctxavb","'",$cat_row['agency_name']);?></option>
															<?php  }?>
													</select>
									</div>
									</div>
									<br>
									<div class="row">									
									<div class="col-md-6">
									<label><input type="text" name="tpi_or_auth" id="tpi_or_auth" value="<?php echo $tpi_or_auth; ?>">:</label>
										<select class="form-control select2 col-sm-12" tabindex="6"   id="sel_tpi" name="sel_tpi"  >
											<option value="">Select TPI</option>
											<?php
											$get_client="SELECT *FROM tpi where `tpiisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while($r = mysqli_fetch_array($client_res)){?>
												<option value="<?php echo $r["tpi_code"];?>" <?php if($tpi_code==$r["tpi_code"]){ echo "selected";}?> ><?php echo str_replace("zxctxavb","'",$r['tpi_name']);?></option>
												<?php } }?>
										</select>
									</div>
									<div class="col-md-6">
									<label><input type="text" name="pmc_heading" id="pmc_heading" value="<?php echo $pmc_heading; ?>">:</label>
											<select class="form-control select2 col-sm-12" tabindex="6"   id="sel_pmc" name="sel_pmc"  >
											<option value="">Select PMC</option>
											<?php
											$get_client="SELECT *FROM pmc where `pmcisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while($r = mysqli_fetch_array($client_res)){?>
												<option value="<?php echo $r["pmc_code"]?>" <?php if($pmc_code==$r["pmc_code"]){ echo "selected";}?>><?php echo str_replace("zxctxavb","'",$r['pmcname']);?></option>
												<?php } }?>
										</select>
									</div>
									</div>
									
									<br>
									<div class="row">
									<div class="col-md-3">
									<label>Reference No:</label>
										<input type="text" class="col-sm-12 form-control" id="ref_no" value="<?php echo $get_refno;?>" tabindex="1" name="ref_no" placeholder="Enter Reference No" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-2">
									<label>Reference Date:</label>
										<input type="text" class="col-sm-12 form-control" id="ref_date" value="<?php echo $get_refdate;?>" tabindex="1" name="ref_date" placeholder="Enter Reference No" required>
									</div>
									<div class="col-md-3">
									<label>Agreement No:</label>
											<input type="text" class="col-sm-12 form-control" id="agreement_no" tabindex="2" value="<?php echo $agreement_no;?>" name="agreement_no" placeholder="Enter Agreement No." required>
									</div>
									<div class="col-md-2">
									<label for="inputEmail3" class="control-label">Document Upload</label>
												<input type="file" tabindex="18" class="col-sm-12 form-control" placeholder="" id="upload_img" name="upload_img">
									</div>
									<div class="col-md-2">
									<?php if($scan_document != ""){ ?>
									<a href="<?php echo $base_url."scan_document/".$scan_document;?>" target="_blank" class="btn btn-primary">Available</a>	
									<?php }?>
									</div>
									
									</div>
									<br>
									<div class="row">
									<div class="col-md-3">
									<label>Sample Delivered By*:</label>
										<input type="text" class="col-sm-12 form-control" id="person_name" value="<?php echo $person_name;?>" tabindex="1" name="person_name" placeholder="Sample Delivered By" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-2">
									<label>Delivered By No:</label>
										<input type="text" class="col-sm-12 form-control" id="person_auth_mobile" value="<?php echo $person_auth_mobile;?>" tabindex="1" name="person_auth_mobile" placeholder="Sample Delivered By No" required>
									</div>
									
									<div class="col-md-2">
									<label for="inputEmail3" class="control-label">Select Sample Sent By:</label>
										<select class="form-control col-sm-12 select2" data-placeholder="Select Sample Sent By" tabindex="21"   id="sel_sent_by" name="sel_sent_by" required >
											<option value="">Select Sample Sent By</option>
											<option value="0" <?php if($sel_sent_by=="0"){ echo "selected";}?>>Client</option>
											<option value="1" <?php if($sel_sent_by=="1"){ echo "selected";}?> >Agency</option>
												
										</select>
									</div>
									<div class="col-md-2">
									<label for="inputEmail3" class="control-label">Select Report Sent To:</label>
										<select class="form-control col-sm-12 select2" tabindex="22" data-placeholder="Select Report Sent To"  id="sel_report_to" name="sel_report_to" required >
											<option value="">Select Report Sent To</option>
											<option value="0" <?php if($condition_of_sample_receved=="0"){ echo "selected";}?>>Client</option>
											<option value="1" <?php if($condition_of_sample_receved=="1"){ echo "selected";}?>>Agency</option>
												
										</select>
									</div>
									
									<div class="col-md-2">
									<label>Bill to:</label>
											<select class="form-control  select2 col-sm-12"  tabindex="9"  id="bill_to" name="bill_to" required >
														<option value="">Select Bill To</option>
														<?php 
															$cat_sql = "select * from agency_master where `isdeleted`=0";
														
															$cat_result = mysqli_query($conn, $cat_sql);

																while($cat_row = mysqli_fetch_assoc($cat_result)) {
															
															?>
															<option value="<?php echo $cat_row['agency_id']; ?>" <?php if($billing_to_id==$cat_row['agency_id']){ echo "selected"; } ?>>
															<?php echo str_replace("zxctxavb","'",$cat_row['agency_name']);?></option>
															<?php  }?>
													</select>
									</div>
									</div>
							<br>
							<div class="row">
							<div class="col-md-12">
										<label for="inputEmail3" class="control-label">Name Of Work<span style="color:red;">*</span></label>
							</div>
							</div>
							<div class="row">
							
							<div class="col-md-12">
										<textarea id="editor1" name="editor1" tabindex="16" class="col-sm-12 form-control"required >
											<?php echo $get_nameofwork;?>
										</textarea>
							</div>
							</div>
							
							<div class="row">
							<br>
							<div class="col-md-12" style="text-align:center;">
										<input type="hidden" name="trf_nos" value="<?php echo $trf_no;?>" id="trf_nos">
										<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('edit_trf_by_rec')" style="margin-bottom:25px;    border-radius: 20px;"> Edit Job</button>
							</div>
							</div>
							<div class="row">
							<br>
							<div class="col-sm-4">
									<div class="" id="error_msg_show" >
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
							<br>
							
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

 
$("#error_msg_show").hide();
  $(function () {
    $('.select2').select2();
  });


// client save
function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
	form_data = new FormData();
    if (type == 'edit_trf_by_rec') {		
				var client_code = $('#client_code').val(); 
				var select_agency = $('#select_agency').val(); 
				var sel_tpi = $('#sel_tpi').val(); 
				var sel_pmc = $('#sel_pmc').val(); 
				var ref_no = $('#ref_no').val(); 
				var ref_date = $('#ref_date').val(); 
				var agreement_no = $('#agreement_no').val(); 
				var person_name = $('#person_name').val(); 
				var person_auth_mobile = $('#person_auth_mobile').val(); 
				var sel_sent_by = $('#sel_sent_by').val(); 
				var sel_report_to = $('#sel_report_to').val(); 
				var tpi_or_auth = $('#tpi_or_auth').val(); 
				var pmc_heading = $('#pmc_heading').val(); 
				var bill_to = $('#bill_to').val(); 
				var name_of_work = CKEDITOR.instances.editor1.getData();
				
				var acb = $('#upload_img').val();
				
				if(acb !=""){
						form_data.append("file", document.getElementById('upload_img').files[0]);
						
						var name = document.getElementById("upload_img").files[0].name;
						
						var ext = name.split('.').pop().toLowerCase();
						  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg','pdf']) == -1) 
						  {
						   alert("Invalid  File Format");
						   return false;
						  }
						  
						  var f = document.getElementById("upload_img").files[0];
						  var fsize = f.size||f.fileSize;
						  if(fsize > 5242880)
						  {
						   alert("File Size is very big");
						   return false;
						  }
					  
				}
				
				var edit_job_id = $('#trf_nos').val();				
	}
	
	// set blank message to submit
	var error_msg="";
	if(client_code ==""){
		error_msg +="Client Name Required"+"<br>";
		
	}if(person_name ==""){
		error_msg +="Enter Sample Delivered By"+"<br>";
		
	}if(person_auth_mobile ==""){
		error_msg +="Enter Sample Delivered By No"+"<br>";
		
	}if(select_agency ==""){
		//error_msg +="Please Select Agency"+"<br>";
		
	}
	
	
	
	if(person_name !== "" && person_auth_mobile !== "")
	{
		
		form_data.append("action_type", type);
		form_data.append("client_code", client_code);
		form_data.append("select_agency", select_agency);
		form_data.append("sel_tpi", sel_tpi);
		form_data.append("sel_pmc", sel_pmc);
		form_data.append("ref_no", ref_no);
		form_data.append("ref_date", ref_date);
		form_data.append("agreement_no", agreement_no);
		form_data.append("person_name", person_name);
		form_data.append("person_auth_mobile", person_auth_mobile);
		form_data.append("sel_sent_by", sel_sent_by);
		form_data.append("sel_report_to", sel_report_to);
		form_data.append("name_of_work", name_of_work);
		form_data.append("tpi_or_auth", tpi_or_auth);
		form_data.append("pmc_heading", pmc_heading);
		form_data.append("bill_to", bill_to);
		form_data.append("edit_job_id", edit_job_id);
		
    $.ajax({
        url : "<?php $base_url; ?>savetest_master.php",
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
			alert("Trf Is Successfully Updated");
			location.reload();
			
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
