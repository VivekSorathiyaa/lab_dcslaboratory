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



$trf_no_id= $_GET["trf_no"];
$serial="SELECT * FROM  job WHERE `trf_no`='$trf_no_id'";
$res = mysqli_query($conn, $serial);
$get_one_job= mysqli_fetch_array($res);


	$client_code=$get_one_job["client_code"];
	$get_clientname=$get_one_job["clientname"];
	$agency_name=$get_one_job["agency_name"];
	$agency=$get_one_job["agency"];
	$tpi_or_auth=$get_one_job["tpi_or_auth"];
	$tpi_code=$get_one_job["tpi_code"];
	$pmc_heading=$get_one_job["pmc_heading"];
	$pmc_code=$get_one_job["pmc_code"];
	$get_nameofwork=$get_one_job["nameofwork"];
	$agreement_no=$get_one_job["agreement_no"];
	$person_name=$get_one_job["person_name"];
	$person_auth_mobile=$get_one_job["person_auth_mobile"];
	$get_refno=$get_one_job["refno"];
	$nabl_type=$get_one_job["nabl_type"];
	$get_sample_rec_date=$get_one_job["sample_rec_date"];
	$billing_to_id=$get_one_job["billing_to_id"];
	$perfoma_completed_by_biller=$get_one_job["perfoma_completed_by_biller"];
	
	if($perfoma_completed_by_biller=="0"){ $disabled_bill_to=""; }else{ $disabled_bill_to="disabled"; }
	
	if($get_refno!=""){
		$get_date=date('d-m-Y', strtotime($get_one_job["date"]));
	}else{
		$get_date="";
	}
	$trf_no=$get_one_job["trf_no"];
	$scan_document=$get_one_job["scan_document"];
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

	<section class="content edit-only-trf" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
	<?php include("menu.php") ?>
	<div class="row">
		<h1 style="text-align:center;">
		Edit Trf Details
		</h1>
	</div>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-info">
				<div class="col-md-12 p-0">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="active tab-pane" id="clients">
					<form class="" method="post" >
					<div>
					   <div class="row">
							<div class="col-md-12" style="font-size: 22px;font-style: bold;">
								<label for="inputEmail3" class="control-label p-0">EDIT TRF DETAILS</label>
							</div>
						</div>
					   <br>
					<div class="row">									
									<div class="col-md-6">
									<label>Agency Name:</label>
										<select class="form-control  select2 col-sm-12" data-placeholder="Select Agency" tabindex="9"  id="select_agency" name="select_agency" required >
														<option value="0">Select Agency</option>
														<?php 
															$cat_sql = "select * from agency_master where `isdeleted`=0";
														
															$cat_result = mysqli_query($conn, $cat_sql);

																while($cat_row = mysqli_fetch_assoc($cat_result)) {
															
															?>
															<option value="<?php echo $cat_row['agency_id']; ?>" <?php if($cat_row['agency_id']== $agency){ echo "selected";}?>>
															<?php echo $cat_row['agency_name']; ?></option>
															<?php  }?>
													</select>
									</div>
									<div class="col-md-6">
									<label>Select Client(End Customer):</label>
											<select class="form-control select2 col-sm-12" tabindex="6"  data-placeholder="Select Existing Customer" id="sel_client" name="sel_client"  >
											<option value="0">Select Client(End Customer)</option>
											<?php
											$get_client="SELECT * FROM client where `clientisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while($r = mysqli_fetch_array($client_res)){?>
												<option value="<?php echo $r["client_code"]?>" <?php if($client_code==$r["client_code"]){ echo "selected";}?> ><?php echo $r["clientname"]?></option>
												<?php } }?>
										</select>
									</div>
									</div>
									<br>
									<div class="row">
									<div class="col-md-6">
									    <label>
										<input type="text"  name="tpi_or_auth" id="tpi_or_auth" value="<?php echo $tpi_or_auth;?>"></label>
										<select class="form-control select2 col-sm-12" tabindex="6"  data-placeholder="Select Existing tpi" id="sel_tpi" name="sel_tpi"  >
											<option value="0">Select TPI</option>
											<?php
											$get_client="SELECT *FROM tpi where `tpiisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while($r = mysqli_fetch_array($client_res)){?>
												<option value="<?php echo $r["tpi_code"]?>" <?php if($tpi_code==$r["tpi_code"]){ echo "selected";}?> ><?php echo $r["tpi_name"]?></option>
												<?php } }?>
										</select>
									</div>
									<!--<div class="col-md-1">
										<input type="button" value="NEW" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-tpi" style="margin-top:20px;">
									</div>-->
									<div class="col-md-6">
									   <label><input type="text" name="pmc_heading" id="pmc_heading"  value="<?php echo $pmc_heading;?>"></label>
										<select class="form-control select2 col-sm-12" tabindex="6"  data-placeholder="Select Existing Customer" id="sel_pmc" name="sel_pmc"  >
											<option value="0">Select PMC</option>
											<?php
											$get_client="SELECT *FROM pmc where `pmcisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while($r = mysqli_fetch_array($client_res)){?>
												<option value="<?php echo $r["pmc_code"]?>" <?php if($pmc_code==$r["pmc_code"]){ echo "selected";}?>><?php echo $r["pmcname"]?></option>
												<?php } }?>
										</select>
									</div>
									<!--<div class="col-md-1">
										<input type="button" value="+" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-pmc" style="margin-top:20px;">
									</div>-->
									</div>
									<br>
									<hr style="border: 1px solid #ddd;">
							<br>
							<div class="row">
							<div class="col-md-5">
										<label for="inputEmail3" class="control-label"><center>Name Of Work<span style="color:red;">*</span></center></label>
							</div>
							<div class="col-md-2">
										<label for="inputEmail3" class="control-label"><center>Doc. Upload
										<?php if($scan_document != ""){ ?>
										<a href="<?php echo $base_url."scan_document/".$scan_document;?>" target="_blank" >Available</a>	
										<?php }?>
										</center></label>
							</div>
							<div class="col-md-2">
										<label for="inputEmail3" class="control-label"><center>Agree. No</center></label>
							</div>
							<div class="col-md-2">
										<label for="inputEmail3" class="control-label"><center>Reference No</center></label>
							</div>
							</div>
							<div class="row">
							
							<div class="col-md-5">
										<textarea id="editor1" name="editor1" tabindex="16" class="col-sm-12 form-control"required >
											<?php echo $get_nameofwork;?>
										</textarea>
							</div>
							<div class="col-md-2">
										<input type="file" tabindex="18" class="col-sm-12 form-control" placeholder="" id="upload_img" name="upload_img">
							</div>
								
							<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="agreement_no" tabindex="2" value="<?php echo $agreement_no;?>" name="agreement_no" placeholder="Enter Agreement No." required>
							</div>
							<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="ref_no" value="<?php echo $get_refno;?>" tabindex="1" name="ref_no" placeholder="Enter Reference No" required>
							</div>
							<br>
							<div class="col-md-2">
								<label for="inputEmail3" class="control-label">Reference Date:</label>
								<input type="text" class="col-sm-12 form-control" id="date" tabindex="20" name="date" value="<?php echo $get_date;?>" required > 
							</div>
							<div class="col-md-2">
								<label for="inputEmail3" class="control-label">Sample Delivered By:<span style="color:red;">*</span></label>
								<input type="text" placeholder="Delivered By Person Name" class="col-sm-12 form-control" id="person_name" tabindex="17" name="person_name" value="<?php echo $person_name;?>">
							</div>
							<div class="col-md-2">
								<label>Delivered By<span style="color:red;">*</span></label>
								<input type="text" placeholder="Mobile No" class="col-sm-12 form-control" id="person_auth_mobile" tabindex="17" name="person_auth_mobile"  value="<?php echo $person_auth_mobile;?>">
							</div>
							<br>
							<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Sample received Date:</label>
										<?php echo date('d/m/Y', strtotime($get_sample_rec_date));?>
							</div>
							<div class="col-md-1">
										<label for="inputEmail3" class="control-label">JOB MODE</label>
										<?php echo $nabl_type; ?>
							</div>
							<br>
							<div class="col-md-4" >
									    <label>Bill TO:</label>
										<select class="form-control select2 col-sm-12" tabindex="6" id="billing_to" name="billing_to" <?php echo $disabled_bill_to; ?> >
											<option value="">Select Billing To</option>
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
							<br>
							<div class="col-md-12" style="text-align:center;">
										<input type="hidden" name="trf_nos" value="<?php echo $trf_no;?>" id="trf_nos">
										<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('edit_only_trf')" style="border-radius: 20px;"> Edit Job</button>
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

 

  $(function () {
    $('.select2').select2();
  });

$("#select_agency").change(function(){
				
				var select_agency = $('#select_agency').val();
                
				var postData = 'action_type=select_agency_on_change&select_agency='+select_agency;
				
				
		$.ajax({
			url : "<?php $base_url; ?>get_on_change_agency.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				if(data.statuses==1){
					$("#sel_client").val(data.client_code).change();
				}
			}

		}); 
    });


// get exist client by select client	
$("#sel_client").change(function(){
				
				var select_agency = $('#select_agency').val();
				var sel_client = $('#sel_client').val();
				var postData = 'action_type=get_now_on_change&select_agency='+select_agency+'&sel_client='+sel_client;
				
				
		$.ajax({
			url : "<?php $base_url; ?>get_on_change_agency.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				if(data.statuses==1){
					CKEDITOR.instances["editor1"].setData(data.nameofwork);
					$("#sel_pmc").val(data.pmc_code).change();
					$("#sel_tpi").val(data.tpi_code).change();
					$("input[name=radio_nabl][value=" + data.nabl_type + "]").prop('checked', true);
					$("#person_name").val(data.person_name);
					$("#person_auth_mobile").val(data.person_auth_mobile);
					$("#tpi_or_auth").val(data.tpi_or_auth);
					$("#pmc_heading").val(data.pmc_heading);
					
					if(data.perfoma_completed_by_biller=="0"){
						$('#billing_to').attr("disabled", false);
						$("#billing_to").val(data.billing_to_id).change();
					}else{
						$('#billing_to').attr("disabled", true); 
					}
					
				}else{
					CKEDITOR.instances["editor1"].setData(data.nameofwork);
					$("#sel_pmc").val(data.pmc_code).change();
					$("#sel_tpi").val(data.tpi_code).change();
					$("input[name=radio_nabl][value=" + data.nabl_type + "]").prop('checked', true);
					$("#person_name").val(data.person_name);
					$("#person_auth_mobile").val(data.person_auth_mobile);
					$("#tpi_or_auth").val(data.tpi_or_auth);
					$("#pmc_heading").val(data.pmc_heading);
					
					if(data.perfoma_completed_by_biller=="0"){
						$('#billing_to').attr("disabled", false);
						$("#billing_to").val(data.billing_to_id).change();
					}else{
						$('#billing_to').attr("disabled", true); 
					}
					
				}
			}

		}); 
    });

// client save
function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
	form_data = new FormData();
    if (type == 'edit_only_trf') {		
				var sel_client = $('#sel_client').val(); 
				var select_agency = $('#select_agency').val(); 
				var ref_no = $('#ref_no').val(); 
				var date = $('#date').val(); 
				var person_name = $('#person_name').val(); 
				var person_auth_mobile = $('#person_auth_mobile').val(); 
				var agreement_no = $('#agreement_no').val(); 
				var tpi_or_auth = $('#tpi_or_auth').val(); 
				var sel_tpi = $('#sel_tpi').val(); 
				var pmc_heading = $('#pmc_heading').val(); 
				var pmc_code = $('#sel_pmc').val(); 
				var billing_to=$("#billing_to").val();
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
				
				
				
			
				//billData = '&action_type='+type+'&client_name='+client_name+'&name_of_work='+name_of_work+'&ref_no='+ref_no+'&edit_job_id='+edit_job_id+'&agreement_no='+agreement_no+'&agency_name='+agency_name;
	
	}
	else{
			
	
				billData = 'action_type='+type+'&id='+id;
    }
	
	// set blank message to submit
	var error_msg="";
	if(sel_client ==""){
		error_msg +="Client Name Required"+"<br>";
		
	}
	
	
	
	if(sel_client !== "")
	{
		
		form_data.append("action_type", type);
		form_data.append("sel_client", sel_client);
		form_data.append("select_agency", select_agency);
		
		form_data.append("name_of_work", name_of_work);
		form_data.append("ref_no", ref_no);
		form_data.append("person_name", person_name);
		form_data.append("date", date);
		form_data.append("person_auth_mobile", person_auth_mobile);
		
		form_data.append("edit_job_id", edit_job_id);
		form_data.append("agreement_no", agreement_no);
		form_data.append("tpi_or_auth", tpi_or_auth);
		form_data.append("tpi_code", sel_tpi);
		form_data.append("pmc_heading", pmc_heading);
		form_data.append("pmc_code", pmc_code);
		form_data.append("billing_to", billing_to);
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
