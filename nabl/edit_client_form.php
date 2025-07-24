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
$serial="SELECT * FROM  job WHERE `job_id`=$trf_no_id";
$res = mysqli_query($conn, $serial);
$get_one_job= mysqli_fetch_array($res);

$today= date("Y-m-d");

$job_serial="SELECT * FROM job ORDER BY job_id DESC";
$job_res = mysqli_query($conn, $job_serial);

if (mysqli_num_rows($job_res) > 0) {
	$job_r = mysqli_fetch_array($job_res);
	
	$sam_rec_date= $job_r["sw_date"];
	
	if($sam_rec_date < $today)
	{
		$starting_date=date('Y-m-d H:i:s', strtotime($sam_rec_date . ' +1 day'));
	}
	else
	{
		$starting_date= "";
	}
	
}else{
	$starting_date= "";
}



	$get_client_code=$get_one_job["client_code"];
	$get_clientname=$get_one_job["clientname"];
	$get_clientaddress=$get_one_job["clientaddress"];
	$get_clientphone=$get_one_job["clientphone"];
	$get_email=$get_one_job["email"];
	$get_client_gstno=$get_one_job["client_gstno"];
	$get_agency=$get_one_job["agency"];
	$get_agency_address=$get_one_job["agency_address"];
	$get_agency_mobile=$get_one_job["agency_mobile"];
	$get_agency_city=$get_one_job["agency_city"];
	$get_agency_pincode=$get_one_job["agency_pincode"];
	$get_agency_email=$get_one_job["agency_email"];
	$get_agency_gstno=$get_one_job["agency_gstno"];
	$get_nameofwork=$get_one_job["nameofwork"];
	$person_name=$get_one_job["person_name"];
	$person_auth_mobile=$get_one_job["person_auth_mobile"];
	$trf_ref=$get_one_job["trf_ref"];
	$scan_document=$get_one_job["scan_document"];
	$get_refno=$get_one_job["refno"];
	if($get_refno!=""){
		$get_date=date('d/m/Y', strtotime($get_one_job["date"]));
	}else{
		$get_date="";
	}
	
	$get_sw_date=$get_one_job["sw_date"];
	$get_sample_sent_by=$get_one_job["sample_sent_by"];
	$get_report_sent_to=$get_one_job["report_sent_to"];
	$get_sample_rec_date=$get_one_job["sample_rec_date"];
	$get_job_id_for_edit=$get_one_job["job_id"];
	$agree_nos=$get_one_job["agreement_no"];
	$nabl_type=$get_one_job["nabl_type"];
	
	$get_tpi_code=$get_one_job["tpi_code"];
	$get_tpi_name=$get_one_job["tpi_name"];
	$get_tpi_phone=$get_one_job["tpi_phone"];
	$get_tpi_email=$get_one_job["tpi_email"];
	$get_tpi_address=$get_one_job["tpi_address"];
	
	$get_pmc_code=$get_one_job["pmc_code"];
	$get_pmc_name=$get_one_job["pmc_name"];
	$get_pmc_phone=$get_one_job["pmc_phone"];
	$get_pmc_email=$get_one_job["pmc_email"];
	$get_pmc_address=$get_one_job["pmc_address"];
	$tpi_or_auth=$get_one_job["tpi_or_auth"];
	$pmc_heading=$get_one_job["pmc_heading"];
	$billing_to_id=$get_one_job["billing_to_id"];
	$perfoma_completed_by_biller=$get_one_job["perfoma_completed_by_biller"];
	
	$radio_1=$get_one_job["radio_1"];
	$radio_2=$get_one_job["radio_2"];
	$radio_3=$get_one_job["radio_3"];
	$radio_4=$get_one_job["radio_4"];
	$radio_5=$get_one_job["radio_5"];
	$radio_6=$get_one_job["radio_6"];
	$radio_7=$get_one_job["radio_7"];
	$radio_8=$get_one_job["radio_8"];
	$radio_9=$get_one_job["radio_9"];
	$radio_10=$get_one_job["radio_10"];
	$radio_11=$get_one_job["radio_11"];
	
	$acceptable=$get_one_job["acceptable"];
	$applicable=$get_one_job["applicable"];
	$deviation=$get_one_job["deviation"];
	
	if($perfoma_completed_by_biller=="0"){ $disabled_bill_to=""; }else{ $disabled_bill_to="disabled"; }

?>

<?php

		if(isset($_POST["btn_save_job"]))
		{
			?>
			 <script>
			 alert("Job Updated Sucessfully.");
			 window.location.href="<?php $base_url; ?>client_form.php";
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
		Edit Job Inward
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
					
					<div style="border:0px solid black;padding:5px">
						        <div class="row">
												<div class="col-md-4" >
													<label>Agency / Contractor / Customer<span style="color:red;">*</span></label>
													<select class="form-control  select2 col-sm-12" data-placeholder="Select Agency" tabindex="9"  id="select_agency" name="select_agency" required >
														<option value="0">Select Agency</option>
														<?php 
															$cat_sql = "select * from agency_master where `isdeleted`=0";
														
															$cat_result = mysqli_query($conn, $cat_sql);

																while($cat_row = mysqli_fetch_assoc($cat_result)) {
															
															?>
															<option value="<?php echo $cat_row['agency_id']; ?>" <?php if($cat_row['agency_id']== $get_agency){ echo "selected";}?>>
															<?php echo $cat_row['agency_name']; ?></option>
															<?php  }?>
													</select>
												</div>
												<div class="col-md-1">
														<input type="button" value="NEW" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-agency" style="margin-top:28px;">
												</div>
												<div class="col-md-1">
														<a data-toggle="collapse" href="#collapse1" class="col-sm-10 btn btn-info" style="margin-top:28px;">View</a>
												</div>
												
												<div class="col-md-4">
												<label>Client(End Customer):</label>
										<select class="form-control select2 col-sm-12" tabindex="6"  id="sel_client" name="sel_client"  >
											<option value="0">Select Client(End Customer)</option>
											<?php
											$get_client="SELECT * FROM client where `clientisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while($r = mysqli_fetch_array($client_res)){?>
												<option value="<?php echo $r["client_code"]?>" <?php if($get_client_code==$r["client_code"]){ echo "selected";}?> ><?php echo $r["clientname"]?></option>
												<?php } }?>
										</select>
									</div>
									<div class="col-md-1">
										<input type="button" value="NEW" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-client" style="margin-top:28px;">
									</div>
									<div class="col-md-1">
										<a data-toggle="collapse" href="#collapse2" class="col-sm-10 btn btn-info" style="margin-top:28px;">View</a>
									</div>
								</div>
								<div id="collapse1" class="panel-collapse collapse">
								<div class="row">																								
									<div class="col-md-12">
									<label>Agency Address:</label>
										<textarea id="agency_address" style="height:50px" tabindex="10"  name="agency_address" class="col-sm-12 form-control"required placeholder="Enter Agency Address."><?php echo $get_agency_address;?></textarea><span style="color:red;">*</span>
									</div>
								</div>
								<br>
					
								<div class="row">								
									<div class="col-md-3">
									<label>Agency Mobile No:</label>
										<input type="text" class="col-sm-12 form-control" id="agency_mobile" value="<?php echo $get_agency_mobile;?>" tabindex="11" name="agency_mobile" required placeholder="Enter Mobile No."><span style="color:red;">*</span>
									</div>
								
									<div class="col-md-2">
									<label>Agency City:</label>
										<select class="form-control col-sm-12" tabindex="12"  data-placeholder="Select City" id="sel_city_of_agency" name="sel_city_of_agency" required >
											<option value="">Select City</option>
											<?php 
												$sql = "select * from city";
											
												$result = mysqli_query($conn, $sql);

													while($row = mysqli_fetch_assoc($result)) {
												
												?>
												<option value="<?php echo $row['id']; ?>" <?php if($row['id']== $get_agency_city){ echo "selected";}?>>
												<?php echo $row['city_name']; ?></option>
												<?php  }?>
										</select>
										
									</div>
									<div class="col-md-1">
									<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-city">
									</div>
								
									<div class="col-md-3">
									<label>Agency Pincode:</label>
										<input type="text" class="col-sm-12 form-control" placeholder="Enter Pincode." id="agency_pincode" tabindex="13" name="agency_pincode" value="<?php echo $get_agency_pincode;?>" required><span style="color:red;">*</span>
									</div>
									
							
									<div class="col-md-3">
									<label>Agency Email:</label>
										<input type="text"  placeholder="Enter Email Id." class="col-sm-12 form-control" id="agency_email" tabindex="14" name="agency_email" value="<?php echo $get_agency_email;?>" required><span style="color:red;">*</span>
									</div>
								</div>	
								<br>								
								<div class="row">															
									<div class="col-md-3">
									<label>Agency Gst:</label>
										<input type="text" class="col-sm-12 form-control"  placeholder="Enter GST No." id="agency_gst" tabindex="15" name="agency_gst" value="<?php echo $get_agency_gstno;?>" required>
									</div>
								</div>
							</div>
                </div>
						<div style="border:0px solid black;padding:5px">
					  
							<div id="collapse2" class="panel-collapse collapse">
									
									<div class="row">									
									<div class="col-md-2">
									<label>Customer Code :</label>
										<input type="text" class="col-sm-12 form-control" id="client_code" tabindex="0" name="client_code" value="<?php echo $get_client_code;?>" required disabled> 
									</div>									
									<div class="col-md-4">
									<label>Customer Name:</label>
										<input type="text" class="col-sm-12 form-control" id="client_name" value="<?php echo $get_clientname;?>" tabindex="1" name="client_name" placeholder="Enter Customer Name" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-3">
									<label>Customer Phone Number:</label>
											<input type="text" class="col-sm-12 form-control" id="phone" tabindex="2" value="<?php echo $get_clientphone;?>" name="phone" placeholder="Enter Phone no." required>
									</div>
									<div class="col-md-3">
									<label>Customer Email:</label>
										<input type="email" class="col-sm-12 form-control" id="email" value="<?php echo $get_email;?>" tabindex="3" name="email" placeholder="Enter Email Id."  required>
									</div>
									
							</div>
							<br>
					
							<div class="row">									
									<div class="col-md-6">
									<label>Customer Address:</label>
										<textarea id="address" tabindex="4" style="height:50px" name="address" class="col-sm-12 form-control"required placeholder="Enter Address."><?php echo $get_clientaddress;?></textarea>
									</div>																									
																
									<div class="col-md-6">
									<label>Customer Gst No:</label>
										<input type="text" placeholder="Enter GST No." class="col-sm-12 form-control" id="customer_gst_no" tabindex="7" name="customer_gst_no" value="<?php echo $get_client_gstno;?>" required>
									</div>
										
								</div>
							</div>
			</div>
					<div style="border:0px solid black;padding:5px">
						 <div class="row">
									<div class="col-md-4">
									    <label>
										<input type="text"  name="tpi_or_auth" id="tpi_or_auth" value="<?php echo $tpi_or_auth;?>"></label>
										<select class="form-control select2 col-sm-12" tabindex="6"  data-placeholder="Select Existing tpi" id="sel_tpi" name="sel_tpi"  >
											<option value="0">Select TPI</option>
											<?php
											$get_client="SELECT *FROM tpi where `tpiisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while($r = mysqli_fetch_array($client_res)){?>
												<option value="<?php echo $r["tpi_code"]?>" <?php if($get_tpi_code==$r["tpi_code"]){ echo "selected";}?> ><?php echo $r["tpi_name"]?></option>
												<?php } }?>
										</select>
									</div>
									<div class="col-md-1">
										<input type="button" value="NEW" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-tpi" style="margin-top:28px;">
									</div>
									<div class="col-md-1">
										<a data-toggle="collapse" href="#collapse3" class="col-sm-10 btn btn-info" style="margin-top:28px;">View</a>
									</div>
									
									<div class="col-md-4">
									   <label><input type="text" name="pmc_heading" id="pmc_heading"  value="<?php echo $pmc_heading;?>"></label>
										<select class="form-control select2 col-sm-12" tabindex="6"  data-placeholder="Select Existing Customer" id="sel_pmc" name="sel_pmc"  >
											<option value="0">Select PMC</option>
											<?php
											$get_client="SELECT *FROM pmc where `pmcisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while($r = mysqli_fetch_array($client_res)){?>
												<option value="<?php echo $r["pmc_code"]?>" <?php if($get_pmc_code==$r["pmc_code"]){ echo "selected";}?>><?php echo $r["pmcname"]?></option>
												<?php } }?>
										</select>
									</div>
									<div class="col-md-1">
										<input type="button" value="+" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-pmc" style="margin-top:20px;">
									</div>
									<div class="col-md-1">
										<a data-toggle="collapse" href="#collapse4" class="col-sm-10 btn btn-info" style="margin-top:20px;">View</a>
									</div>
					</div>
					<div id="collapse3" class="panel-collapse collapse">
									<div class="row">									
									<div class="col-md-2">
									<label>TPI Code :</label>
										<input type="text" class="col-sm-12 form-control" id="tpi_code" tabindex="0" name="tpi_code" value="<?php echo $get_tpi_code;?>" required disabled> 
									</div>									
									<div class="col-md-5">
									<label>TPI Name:</label>
										<input type="text" class="col-sm-12 form-control" id="tpi_name" tabindex="1" name="tpi_name" placeholder="Enter TPI Name" value="<?php echo $get_tpi_name;?>" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-2">
									<label>TPI Phone Number:</label>
											<input type="text" class="col-sm-12 form-control" id="tpi_phone" tabindex="2" name="tpi_phone" placeholder="Enter Phone no." value="<?php echo $get_tpi_phone;?>" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-3">
									<label>TPI Email:</label>
										<input type="email" class="col-sm-12 form-control" id="tpi_email" tabindex="3" name="tpi_email" placeholder="Enter Email Id." value="<?php echo $get_tpi_email;?>"  required>
									</div>
								</div>
						        <br>
								<div class="row">									
									<div class="col-md-6">
									<label>TPI Address:</label>
										<textarea id="tpi_address" tabindex="4" style="height:50px" name="tpi_address" class="col-sm-12 form-control"required placeholder="Enter Address.">
										<?php echo $get_tpi_address;?>
										</textarea>
									</div>
								</div>
							</div>
							
				</div>
							<div style="border:0px solid black;padding:5px">
							<div id="collapse4" class="panel-collapse collapse">
									<div class="row">									
									<div class="col-md-2">
									<label>PMC Code :</label>
										<input type="text" class="col-sm-12 form-control" id="pmc_code" tabindex="0" name="pmc_code" value="<?php echo $get_pmc_code;?>" required disabled> 
									</div>									
									<div class="col-md-5">
									<label>PMC Name:</label>
										<input type="text" class="col-sm-12 form-control" id="pmc_name" tabindex="1" name="pmc_name" placeholder="Enter Customer Name" value="<?php echo $get_pmc_name;?>" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-2">
									<label>PMC Phone Number:</label>
											<input type="text" class="col-sm-12 form-control" id="pmc_phone" tabindex="2" name="pmc_phone" placeholder="Enter Phone no." value="<?php echo $get_pmc_phone;?>" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-3">
									<label>PMC Email:</label>
										<input type="email" class="col-sm-12 form-control" id="pmc_email" tabindex="3" name="pmc_email" placeholder="Enter Email Id." value="<?php echo $get_pmc_email;?>"  required>
									</div>
									
								</div>
						        <br>
								<div class="row">									
									<div class="col-md-6">
									<label>PMC Address:</label>
										<textarea id="pmc_address" tabindex="4" style="height:50px" name="pmc_address" class="col-sm-12 form-control"required placeholder="Enter Address.">
										<?php echo $get_pmc_address;?>
										</textarea>
									</div>
								</div>
							</div>
							
				</div>
				<hr style="border: 1px solid #ddd;">
							<div class="row">
							<div class="col-md-5">
										<label for="inputEmail3" class="control-label">Name Of Work<span style="color:red;">*</span></label>
							</div>
							<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Doc. Upload<span style="color:red;">*</span></label>
							</div>
							<div class="col-md-2">
								<label for="inputEmail3" class="control-label"></label>
							</div>
							<div class="col-md-2">
								<label for="inputEmail3" class="control-label">Agree. No</label>
							</div>
							<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Sample Delivered By<span style="color:red;">*</span></label>
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
							<?php if($scan_document != ""){ ?>
								<div class="col-md-2">
									<a href="<?php echo $base_url."scan_document/".$scan_document;?>" target="_blank">Available</a>	
								</div>
								<?php }?>
							<div class="col-md-2">
								<input type="text" class="col-sm-12 form-control"  placeholder="Enter Agreement No." id="agreement_no" tabindex="15" name="agreement_no" value="<?php echo $agree_nos?>" >
							</div>
							<div class="col-md-2">
								<input type="text" placeholder="Delivered By Person Name" class="col-sm-12 form-control" id="person_name" tabindex="17" name="person_name" value="<?php echo $person_name;?>">
								</div>
							<br>
							<div class="col-md-2">
								<label>Delivered By<span style="color:red;">*</span></label>
								<input type="text" placeholder="Mobile No" class="col-sm-12 form-control" id="person_auth_mobile" tabindex="17" name="person_auth_mobile"  value="<?php echo $person_auth_mobile;?>">
							</div>
							<div class="col-md-2">
								<label>Reference No:</label>
								<input type="text" class="col-sm-12 form-control" placeholder="REFRENCE NO." id="ref_no" tabindex="19" name="ref_no" value="<?php echo $get_refno;?>" required > 
							</div>
							<div class="col-md-2">
								<label for="inputEmail3" class="control-label">Reference Date:</label>
								<input type="text" class="col-sm-12 form-control" id="date" tabindex="20" name="date" value="<?php echo $get_date;?>" required > 
							</div>
							<br>
							<div class="col-md-2">
								<label for="inputEmail3" class="control-label">Select Sample Sent By:</label>
								<select class="form-control col-sm-12 select2" data-placeholder="Select Sample Sent By" tabindex="21"   id="sel_sent_by" name="sel_sent_by" required >
											<option value="">Select Sample Sent By</option>												
											<option value="0" <?php if($get_sample_sent_by== 0){ echo "selected";}?>>Client</option>
											<option value="1" <?php if($get_sample_sent_by== 1){ echo "selected";}?>>Agency</option>
								</select>
							</div>
							<div class="col-md-2">
								<label>Physical S.R.F. No:</label>
									<input type="text" class="col-sm-12 form-control" placeholder="TRF REFERENCE NO." id="trf_ref" tabindex="19" name="trf_ref" value="<?php echo $trf_ref;?>"> 
							</div>	
							<div class="col-md-2">
								<label for="inputEmail3" class="control-label">Select Report Sent To:</label>
								<select class="form-control col-sm-12 select2" tabindex="22" data-placeholder="Select Report Sent To"  id="sel_report_to" name="sel_report_to" required >
											<option value="">Select Report Sent To</option>
											<option value="0" <?php if($get_report_sent_to== 0){ echo "selected";}?>>Client</option>
											<option value="1" <?php if($get_report_sent_to== 1){ echo "selected";}?>>Agency</option>
								</select>
							</div>
							<div class="col-md-2">
										<label for="inputEmail3" class="col-sm-12 p-0 control-label">Sample received Date:</label>
										<?php echo date('d/m/Y', strtotime($get_sample_rec_date));?>
										<input type="hidden" class="col-sm-12 form-control" id="sample_rec_date" tabindex="23" name="sample_rec_date" value="<?php echo date('d/m/Y', strtotime($get_sample_rec_date));?>" required > 
									<input type="hidden" name="edit_job_id" id="edit_job_id" value="<?php echo $get_job_id_for_edit; ?>">
							</div>
							<br>
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
							<div class="row">
								<div class="col-sm-12" style="text-align: center;">
											<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('edit')" style="margin-bottom:25px;    border-radius: 20px;"> Edit Job</button>
									        <span id="available_msg" style="color:red;font-size:20px;"></span>
											
											
									</div>
									</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
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

					
	<div class="modal fade" id="modal-category">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Category</h4>
              </div>
				<form id="form_ctegory" name="form_ctegory" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Add category:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter New category" id="txt_new_category" name="txt_new_category" class="form-control">											
							</div>
						</div>
						<br><br><br>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">category Remark:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter Category Remark" id="txt_category_remark" name="txt_category_remark" class="form-control">											
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_category" name="btn_add_category" data-dismiss="modal">Add Agency</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
	
	<div class="modal fade" id="modal-city">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New City</h4>
              </div>
				<form id="form_city" name="form_city" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Add City:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter New City" id="txt_new_city" name="txt_new_city" class="form-control">											
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_city" name="btn_add_city" data-dismiss="modal">Add City</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>	
	
	<div class="modal fade" id="modal-auth">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Authority</h4>
              </div>
				<form id="form_auth" name="form_auth" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Add Authority:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter New Authority" id="txt_new_auth" name="txt_new_auth" class="form-control">											
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_auth" name="btn_add_auth" data-dismiss="modal">Add Authority</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
	
	<div class="modal fade" id="modal-authcity">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New City</h4>
              </div>
				<form id="form_city" name="form_city" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Add City:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter New City" id="txt_new_auth_city" name="txt_new_auth_city" class="form-control">											
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_auth_city" name="btn_add_auth_city" data-dismiss="modal">Add City</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
	
	
	<div class="modal fade" id="modal-agency">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Agency/Contractor/Customer</h4>
              </div>
				<form id="form_agency" name="form_agency" method="post">
					<div class="modal-body">
						<div class="form-group">
												<div class="col-md-6">
													<label>Agency/Contractor/Customer Name</label>
													<input type="text" class="form-control" name="agency_name" id="add_agency_name" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency/Contractor/Customer Mobile No</label>
													<input type="text" class="form-control" name="agency_mobile" id="add_agency_mobile" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency/Contractor/Customer Address</label>
													<textarea name="add_agency_address" id="add_agency_address" class="col-sm-12 form-control"required ></textarea>
												</div>
												
												<div class="col-md-6">
													<label>Agency/Contractor/Customer City</label>
													<select class="form-control col-sm-12" tabindex="6"   id="add_sel_agency_city" name="sel_agency_city" required >
													<option value="">Select City</option>
													<?php 
													$sql = "select * from city";
												
													$result = mysqli_query($conn, $sql);

														while($row = mysqli_fetch_assoc($result)) {
													
													?>
													<option value="<?php echo $row['id']; ?>">
													<?php echo $row['city_name']; ?></option>
													<?php  }?>
													</select>
										
												</div>
												
												<div class="col-md-6">
													<label>Agency/Contractor/Customer Pincode</label>
													<input type="text" class="form-control" name="add_agency_pincode" id="add_agency_pincode" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency/Contractor/Customer Email</label>
													<input type="text" class="form-control" name="add_agency_email" id="add_agency_email" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency/Contractor/Customer Gstno</label>
													<input type="text" class="form-control" name="add_agency_gstno" id="add_agency_gstno" required >
												</div>
									
												<div class="col-md-6">
													<label>Agency/Contractor/Customer Status</label>
													<select class="form-control col-md-7 col-xs-12" name="add_agency_status" id="add_agency_status">
														<option  value="0">Activate</option>
														<option value="1">Deactivate</option>
													<select>			
												</div>
												<div class="col-md-6">													
													<select class="form-control col-md-7 col-xs-12" name="add_perfoma_make_by" id="add_perfoma_make_by">
														<option  value="0" selected>By Test</option>
														<option value="1">By Material</option>
													<select>			
												</div>
												
												<div class="col-md-6">													
													<select class="form-control col-md-7 col-xs-12" name="add_rate" id="add_rate">
														<option  value="0">Government</option>
														<option value="1" selected >Private</option>
													<select>			
												</div>
												
								
											</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_agency" name="btn_add_agency" data-dismiss="modal">Add Agency/Contractor/Customer</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
	
	<div class="modal fade" id="modal-client">
          <div class="modal-dialog" style="width:80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Client(End Customer)</h4>
              </div>
				<form id="form_client" name="form_client" method="post">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
									<div class="col-md-6">													
											<input type="text" class="form-control" PlaceHolder="Enter Client(End Customer) Name." name="add_client_name" id="add_client_name" required >
										</div>
										
										<div class="col-md-6">												
											<input type="text" class="form-control"  PlaceHolder="Enter client(End Customer) Mobile No." name="add_client_mobile" id="add_client_mobile" required >
										</div>
									</div>
												<br>
												<div class="row">
												<div class="col-md-6">												
													<input type="text" class="form-control"  PlaceHolder="Enter client(End Customer) email." name="add_client_email" id="add_client_email" required >
										
												</div>
												<div class="col-md-6">												
													<input type="text" class="form-control" placeholder="Enter Client(End Customer) Gst" name="add_client_gst" id="add_client_gst" value="" required >
												</div>
												</div>
												<br>
												<div class="row">
												<div class="col-md-6">													
													<textarea name="add_client_address" placeholder="Enter Client(End Customer) Address." id="add_client_address" class="col-sm-12 form-control"required ></textarea>
												</div>
												</div>
												
								
											</div>
					</div>
					<div class="modal-footer">	
					
						<button type="button" class="btn btn-primary" id="btn_add_client" name="btn_add_client" data-dismiss="modal">Add client(End Customer)</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
	
	<div class="modal fade" id="modal-tpi">
          <div class="modal-dialog" style="width:80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New tpi</h4>
              </div>
				<form id="form_tpi" name="form_client" method="post">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
									<div class="col-md-6">													
											<input type="text" class="form-control" PlaceHolder="Enter tpi Name." name="add_tpi_name" id="add_tpi_name" required >
										</div>
										
										<div class="col-md-6">												
											<input type="text" class="form-control"  PlaceHolder="Enter tpi Mobile No." name="add_tpi_mobile" id="add_tpi_mobile" required >
										</div>
									</div>
												<br>
												<div class="row">
												<div class="col-md-6">												
													<input type="text" class="form-control"  PlaceHolder="Enter tpi email." name="add_tpi_email" id="add_tpi_email" required >
										
												</div>
												</div>
												
												
								
											</div>
					</div>
					<div class="modal-footer">	
					
						<button type="button" class="btn btn-primary" id="btn_add_tpi" name="btn_add_tpi" data-dismiss="modal">Add Tpi</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
	
	<div class="modal fade" id="modal-pmc">
          <div class="modal-dialog" style="width:80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New pmc</h4>
              </div>
				<form id="form_pmc" name="form_pmc" method="post">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
									<div class="col-md-6">													
											<input type="text" class="form-control" PlaceHolder="Enter pmc Name." name="add_pmc_name" id="add_pmc_name" required >
										</div>
										
										<div class="col-md-6">												
											<input type="text" class="form-control"  PlaceHolder="Enter pmc Mobile No." name="add_pmc_mobile" id="add_pmc_mobile" required >
										</div>
									</div>
												<br>
												<div class="row">
												<div class="col-md-6">												
													<input type="text" class="form-control"  PlaceHolder="Enter pmc email." name="add_pmc_email" id="add_pmc_email" required >
										
												</div>
												</div>
												
												
								
											</div>
					</div>
					<div class="modal-footer">	
					
						<button type="button" class="btn btn-primary" id="btn_add_pmc" name="btn_add_pmc" data-dismiss="modal">Add Pmc</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
	
	<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align:center;font-size:30px;">Verify Given Instruction Before Inward</h5>
                
            </div>
            <div class="modal-body instr_modal">
                <table style="width:100%;" border="1">
					<tr>
						<td colspan="4" style="text-align:center;font-size:20px;">REQUIREMENT REVIEW</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; Information provided by you are intends to place in the public domain by testing laboratory, are you agree?</td>
						<td><input type="radio" name="radio_1" value="yes" <?php if($radio_1=="yes"){ echo "checked";}?>>YES</td>
						<td><input type="radio" name="radio_1" value="no" <?php if($radio_1=="no"){ echo "checked";}?>>NO</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; Do wish to incorporate the conformity statement in the Test Report?</td>
						<td><input type="radio" name="radio_2" value="yes" <?php if($radio_2=="yes"){ echo "checked";}?>>YES</td>
						<td><input type="radio" name="radio_2" value="no" <?php if($radio_2=="no"){ echo "checked";}?>>NO</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; Whether decision rule defined clearly and agreed by the customer?</td>
						<td><input type="radio" name="radio_3" value="yes" <?php if($radio_3=="yes"){ echo "checked";}?>>YES</td>
						<td><input type="radio" name="radio_3" value="no" <?php if($radio_3=="no"){ echo "checked";}?>>NO</td>
					</tr>
					
					<tr>
						<td colspan="4" style="text-align:center;font-size:20px;">CHECKLIST-TEST ITEM/SAMPLE RECEIVING</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; Does sample bear proper indentification/label?</td>
						<td><input type="radio" name="radio_4" value="yes" <?php if($radio_4=="yes"){ echo "checked";}?>>YES</td>
						<td><input type="radio" name="radio_4" value="no" <?php if($radio_4=="no"){ echo "checked";}?>>NO</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; Does sample have sufficient Quantity?</td>
						<td><input type="radio" name="radio_5" value="yes" <?php if($radio_5=="yes"){ echo "checked";}?>>YES</td>
						<td><input type="radio" name="radio_5" value="no" <?php if($radio_5=="no"){ echo "checked";}?>>NO</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; Does sample pack in proper bag/container?</td>
						<td><input type="radio" name="radio_6" value="yes" <?php if($radio_6=="yes"){ echo "checked";}?>>YES</td>
						<td><input type="radio" name="radio_6" value="no" <?php if($radio_6=="no"){ echo "checked";}?>>NO</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; Test witness by the customer?</td>
						<td><input type="radio" name="radio_7" value="yes" <?php if($radio_7=="yes"){ echo "checked";}?>>YES</td>
						<td><input type="radio" name="radio_7" value="no" <?php if($radio_7=="no"){ echo "checked";}?>>NO</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; Sample condition for Testing at the time of receipt:</td>
						<td><input type="radio" name="acceptable" value="yes" <?php if($acceptable=="yes"){ echo "checked";}?>>Acceptable</td>
						<td><input type="radio" name="acceptable" value="no" <?php if($acceptable=="no"){ echo "checked";}?>>Not Acceptable</td>
					</tr>
					
					<tr>
						<td colspan="4" style="text-align:center;font-size:20px;">REQUIREMENT REVIEW</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; The requirements, including the test methods to be used,are adequately defined,documented and understood by the laboratory;</td>
						<td><input type="radio" name="radio_8" value="yes" <?php if($radio_8=="yes"){ echo "checked";}?>>YES</td>
						<td><input type="radio" name="radio_8" value="no" <?php if($radio_8=="no"){ echo "checked";}?>>NO</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; The laboratory has the capability and resources to meet the requirements;</td>
						<td><input type="radio" name="radio_9" value="yes" <?php if($radio_9=="yes"){ echo "checked";}?>>YES</td>
						<td><input type="radio" name="radio_9" value="no" <?php if($radio_9=="no"){ echo "checked";}?>>NO</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; The appropriate test method is selected and is capable of meeting the customer's requirements.</td>
						<td><input type="radio" name="radio_10" value="yes" <?php if($radio_10=="yes"){ echo "checked";}?>>YES</td>
						<td><input type="radio" name="radio_10" value="no" <?php if($radio_10=="no"){ echo "checked";}?>>NO</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; Request / Contrat review process repeated as amendment is received after work has commenced and the
amendment has been communicated to lab personnel</td>
						<td><input type="radio" name="applicable" value="yes" <?php if($applicable=="yes"){ echo "checked";}?>>Applicable</td>
						<td><input type="radio" name="applicable" value="no" <?php if($applicable=="no"){ echo "checked";}?>>Not Applicable</td>
					</tr>
					
					<tr>
						<td colspan="2">&#8226; Intimate the Customer,if any deviation from the request/contract: </td>
						<td><input type="radio" name="deviation" value="yes" <?php if($deviation=="yes"){ echo "checked";}?>>Deviation</td>
						<td><input type="radio" name="deviation" value="no" <?php if($deviation=="no"){ echo "checked";}?>>No Deviation</td>
					</tr>
					
					<tr>
						<td>&#8226; Difference has been satisfactorily resolved before any work commenced.</td>
						<td><input type="radio" name="radio_11" value="yes" <?php if($radio_11=="yes"){ echo "checked";}?>>Yes</td>
						<td><input type="radio" name="radio_11" value="no" <?php if($radio_11=="no"){ echo "checked";}?>>NO</td>
						<td><input type="radio" name="radio_11" value="na" <?php if($radio_11=="na"){ echo "checked";}?>>NA</td>
					</tr>
					<tr>
						<td colspan="4">
							<a href="#" class="close btn btn-primary" data-dismiss="modal" style="font-size:18px;opacity:1;border:1px solid black;color:#fff;font-weight: 300;">SAVE</a>
						</td>
					</tr>
				</table>
				<br>
            </div>
        </div>
    </div>
</div>
		
<?php include("footer.php");?>
<script>

 

  $(function () {
    $('.select2').select2();
  });
$(document).ready(function()
	{ 
		$("#myModal").modal('show');
		$('#btn_edit_data').hide();
		$('#btn_next').hide();
		$("#error_msg_show").hide();
	
	});

// client save
function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'edit') {		
				var client_code = $('#client_code').val(); 
				var client_name = $('#client_name').val(); 
				var address = $('#address').val(); 
				var phone = $('#phone').val(); 
				var email = $('#email').val(); 
				var pincode = ""; 
				var sel_city = "";
				var customer_gst_no = $('#customer_gst_no').val();
				var select_agency = $('#select_agency').val();
				var agency_address = $('#agency_address').val();
				var agency_mobile = $('#agency_mobile').val();
				var sel_city_of_agency = $('#sel_city_of_agency').val();
				var agency_pincode = $('#agency_pincode').val();
				var agency_email = $('#agency_email').val();
				var agency_gst = $('#agency_gst').val();
				//var name_of_work = $('#editor1').val();
				var name_of_work = CKEDITOR.instances.editor1.getData();
				//var name_of_work = $('[name="editor1"]').val();
				var agreement_no = $('#agreement_no').val();
				var ref_no = $('#ref_no').val();
				var date = $('#date').val();
				//var sw_date = $('#sw_date').val();
				var sw_date = $('#sample_rec_date').val();
				//var report_no = $('#report_no').val();
				var sel_sent_by = $('#sel_sent_by').val();
				var sel_report_to = $('#sel_report_to').val();
				var sample_rec_date = $('#sample_rec_date').val();
				var person_name = $('#person_name').val();
				var person_auth_mobile = $('#person_auth_mobile').val();
				var trf_ref = $('#trf_ref').val();
				var edit_job_id = $('#edit_job_id').val();
				
				var tpi_code = $('#tpi_code').val();
				var tpi_name = $('#tpi_name').val();
				var tpi_phone = $('#tpi_phone').val();
				var tpi_email = $('#tpi_email').val();
				var tpi_address = $('#tpi_address').val();
				
				var pmc_code = $('#pmc_code').val();
				var pmc_name = $('#pmc_name').val();
				var pmc_phone = $('#pmc_phone').val();
				var pmc_email = $('#pmc_email').val();
				var pmc_address = $('#pmc_address').val();
				
				var radio_nabl="";
				var tpi_or_auth=$("#tpi_or_auth").val();
				var pmc_heading=$("#pmc_heading").val();
				var billing_to=$("#billing_to").val();
				
				var radio_1=$( 'input[name=radio_1]:checked' ).val();
				var radio_2=$( 'input[name=radio_2]:checked' ).val();
				var radio_3=$( 'input[name=radio_3]:checked' ).val();
				var radio_4=$( 'input[name=radio_4]:checked' ).val();
				var radio_5=$( 'input[name=radio_5]:checked' ).val();
				var radio_6=$( 'input[name=radio_6]:checked' ).val();
				var radio_7=$( 'input[name=radio_7]:checked' ).val();
				var radio_8=$( 'input[name=radio_8]:checked' ).val();
				var radio_9=$( 'input[name=radio_9]:checked' ).val();
				var radio_10=$( 'input[name=radio_10]:checked' ).val();
				var radio_11=$( 'input[name=radio_11]:checked' ).val();
				var acceptable=$( 'input[name=acceptable]:checked' ).val();
				var applicable=$( 'input[name=applicable]:checked' ).val();
				var deviation=$( 'input[name=deviation]:checked' ).val();
				
				if(!radio_nabl)
				{
                radio_nabl="";
				}
				
				if(billing_to =="")
				{
				alert("select Bill To First");
				return false;
				}
				
				
				
			
				billData = '&action_type='+type+'&client_code='+client_code+'&client_name='+client_name+'&address='+address+'&phone='+phone+'&email='+email+'&pincode='+pincode+'&sel_city='+sel_city+'&customer_gst_no='+customer_gst_no+'&select_agency='+select_agency+'&agency_address='+agency_address+'&agency_mobile='+agency_mobile+'&sel_city_of_agency='+sel_city_of_agency+'&agency_pincode='+agency_pincode+'&agency_email='+agency_email+'&agency_gst='+agency_gst+'&name_of_work='+name_of_work+'&ref_no='+ref_no+'&date='+date+'&sel_sent_by='+sel_sent_by+'&sel_report_to='+sel_report_to+'&sample_rec_date='+sample_rec_date+'&person_name='+person_name+'&person_auth_mobile='+person_auth_mobile+'&trf_ref='+trf_ref+'&edit_job_id='+edit_job_id+'&agreement_no='+agreement_no;
	
	}
	else{
			
	
				billData = 'action_type='+type+'&id='+id;
    }
	
	// set blank message to submit
	var error_msg="";
	if(client_name ==""){
		//error_msg +="Client Name Required"+"<br>";
		
	}
	if(select_agency ==""){
		//error_msg="Agency Name Required"+"<br>";
	}
	if(agency_address ==""){
		//error_msg +="Agency Address Required"+"<br>";
	}
	if(agency_mobile ==""){
	//	error_msg +="Agency Mobile Number Required"+"<br>";
	}
	
	
	if(name_of_work ==""){
		error_msg +="Name Of Work Required"+"<br>";
	}
	
	
	if(customer_gst_no.length < 13 || customer_gst_no.length > 15){
		//error_msg +="Customer Gst Not Proper"+"<br>";
	}
	var xyz = $('#upload_img').val();
	if(xyz ==""){
// 		error_msg +="Please Upload Letter"+"<br>";
	}
	
	if(person_name !== ""&& person_auth_mobile !== ""&& name_of_work !== ""&& error_msg=="")
	{
		form_data = new FormData();
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
		
		form_data.append("action_type", type);
		form_data.append("client_code", client_code);
		form_data.append("client_name", client_name);
		form_data.append("address", address);
		form_data.append("phone", phone);
		form_data.append("email", email);
		form_data.append("pincode", pincode);
		form_data.append("sel_city", sel_city);
		form_data.append("customer_gst_no", customer_gst_no);
		form_data.append("select_agency", select_agency);
		form_data.append("agency_address", agency_address);
		form_data.append("agency_mobile", agency_mobile);
		form_data.append("sel_city_of_agency", sel_city_of_agency);
		form_data.append("agency_pincode", agency_pincode);
		form_data.append("agency_email", agency_email);
		form_data.append("agency_gst", agency_gst);
		form_data.append("name_of_work", name_of_work);
		form_data.append("ref_no", ref_no);
		form_data.append("date", date);
		form_data.append("sw_date", sw_date);
		form_data.append("sel_sent_by", sel_sent_by);
		form_data.append("sel_report_to", sel_report_to);
		form_data.append("sample_rec_date", sample_rec_date);
		form_data.append("person_name", person_name);
		form_data.append("person_auth_mobile", person_auth_mobile);
		form_data.append("trf_ref", trf_ref);
		form_data.append("edit_job_id", edit_job_id);
		form_data.append("agreement_no", agreement_no);
		form_data.append("tpi_code", tpi_code);
		form_data.append("tpi_name", tpi_name);
		form_data.append("tpi_phone", tpi_phone);
		form_data.append("tpi_email", tpi_email);
		form_data.append("tpi_address", tpi_address);
		form_data.append("pmc_code", pmc_code);
		form_data.append("pmc_name", pmc_name);
		form_data.append("pmc_phone", pmc_phone);
		form_data.append("pmc_email", pmc_email);
		form_data.append("pmc_address", pmc_address);
		form_data.append("radio_nabl", radio_nabl);
		form_data.append("tpi_or_auth", tpi_or_auth);
		form_data.append("pmc_heading", pmc_heading);
		form_data.append("billing_to", billing_to);
		
		form_data.append("radio_1", radio_1);
		form_data.append("radio_2", radio_2);
		form_data.append("radio_3", radio_3);
		form_data.append("radio_4", radio_4);
		form_data.append("radio_5", radio_5);
		form_data.append("radio_6", radio_6);
		form_data.append("radio_7", radio_7);
		form_data.append("radio_8", radio_8);
		form_data.append("radio_9", radio_9);
		form_data.append("radio_10", radio_10);
		form_data.append("radio_11", radio_11);
		form_data.append("acceptable", acceptable);
		form_data.append("applicable", applicable);
		form_data.append("deviation", deviation);
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
			alert("Job Is Successfully Updated");
			window.location.href="<?php $base_url; ?>job_listing_for_second_reception.php";
		}
    });
  }else{
	  alert("AllFields Required..");
	  $("#error_msg_put").html(error_msg);
	  $("#error_msg_show").show();
  }
}





// add city
$("#btn_add_city").click(function(){  
	var txt_new_city = $('#txt_new_city').val(); 
	var postData = '&txt_new_city='+txt_new_city;
 
	$.ajax({
		url : "<?php $base_url; ?>Form_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			$("#sel_city_of_agency").html(data);   
			
		 }

	}); 

});


// add category
$("#btn_add_category").click(function(){
 var txt_new_category = $('#txt_new_category').val(); 
 var txt_category_remark = $('#txt_category_remark').val(); 
 var postData = '&txt_new_category='+txt_new_category+'&txt_category_remark='+txt_category_remark;
 
	  $.ajax({
		url : "<?php $base_url; ?>category_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
		
			$("#sel_category").html(data);
			$("#sel_category_job").html(data);
		   $('#txt_new_agency').val("");
		 }

	}); 

});



<!---Agency------->
$("#btn_add_agency").click(function(){
 var agency_name = $('#add_agency_name').val(); 
 var agency_mobile = $('#add_agency_mobile').val(); 
 var agency_address = $('#add_agency_address').val(); 
 var sel_agency_city = $('#add_sel_agency_city').val(); 
 var agency_pincode = $('#add_agency_pincode').val(); 
 var agency_email = $('#add_agency_email').val(); 
 var agency_gstno = $('#add_agency_gstno').val(); 
 var agency_status = $('#add_agency_status').val(); 
 var add_perfoma_make_by = $('#add_perfoma_make_by').val(); 
 var add_rate = $('#add_rate').val(); 
 var postData = '&agency_name='+agency_name+'&agency_mobile='+agency_mobile+'&agency_address='+agency_address+'&sel_agency_city='+sel_agency_city+'&agency_pincode='+agency_pincode+'&agency_email='+agency_email+'&agency_gstno='+agency_gstno+'&agency_status='+agency_status+'&add_perfoma_make_by='+add_perfoma_make_by+'&add_rate='+add_rate;
	
	if(agency_name!=""){
	  $.ajax({
		url : "<?php $base_url; ?>agency_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
		
			$("#select_agency").html(data);
			$("#billing_to").html(data);
		   $('#txt_new_agency').val("");
		   $( '#form_agency' ).each(function(){
				this.reset();
			});
		 }

	}); 
}else{
	alert("All Fields Are Required..");
	return false;
}
});

$("#btn_add_client").click(function(){
 var add_client_name = $('#add_client_name').val(); 
 var add_client_mobile = $('#add_client_mobile').val(); 
 var add_client_email = $('#add_client_email').val(); 
 var add_client_gst = $('#add_client_gst').val(); 
 var add_client_address = $('#add_client_address').val();  
 var postData = '&add_client_name='+add_client_name+'&add_client_mobile='+add_client_mobile+'&add_client_email='+add_client_email+'&add_client_gst='+add_client_gst+'&add_client_address='+add_client_address;
	
	if(add_client_name!=""){
	  $.ajax({
		url : "<?php $base_url; ?>clients_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			if(data=="client already exist")
			{
				alert("client already exist");
				return false;
			}else{
				$("#sel_client").html(data);
		        $( '#form_client' ).each(function(){
				this.reset();
			});
			}
			
		 }

	}); 
}else{
	alert("All Fields Are Required..");
	return false;
}
});


$("#btn_add_tpi").click(function(){
 var add_tpi_name = $('#add_tpi_name').val(); 
 var add_tpi_mobile = $('#add_tpi_mobile').val(); 
 var add_tpi_email = $('#add_tpi_email').val(); 
 var postData = '&add_tpi_name='+add_tpi_name+'&add_tpi_mobile='+add_tpi_mobile+'&add_tpi_email='+add_tpi_email;
	
	if(add_tpi_name!=""){
	  $.ajax({
		url : "<?php $base_url; ?>tpi_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			
				$("#sel_tpi").html(data);
		        $( '#form_tpi' ).each(function(){
				this.reset();
			});
			
			
		 }

	}); 
}else{
	alert("All Fields Are Required..");
	return false;
}
});


$("#btn_add_pmc").click(function(){
 var add_pmc_name = $('#add_pmc_name').val(); 
 var add_pmc_mobile = $('#add_pmc_mobile').val(); 
 var add_pmc_email = $('#add_pmc_email').val(); 
 var add_pmc_gst = $('#add_pmc_gst').val(); 
 var add_pmc_address = $('#add_pmc_address').val();  
 var postData = '&add_pmc_name='+add_pmc_name+'&add_pmc_mobile='+add_pmc_mobile+'&add_pmc_email='+add_pmc_email+'&add_pmc_gst='+add_pmc_gst+'&add_pmc_address='+add_pmc_address;
	
	if(add_pmc_name!=""){
	  $.ajax({
		url : "<?php $base_url; ?>pmc_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			
				$("#sel_pmc").html(data);
		        $( '#form_pmc' ).each(function(){
				this.reset();
			});
			
			
		 }

	}); 
}else{
	alert("All Fields Are Required..");
	return false;
}
});

$("#exist_agency_mo").change(function(){
				
			
				var len = $('#exist_agency_mo').val().length;
				if(len>=10)
				{
				var exist_agency_mo = $('#exist_agency_mo').val();

				var postData = '&exist_agency_mo='+exist_agency_mo;
				
				
		$.ajax({
			url : "<?php $base_url; ?>get_exist_client.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				var cnt =  data.cnt;
				if(parseInt(cnt)==0)
				{
					alert("Agency Not Exists Please Enter Agency Data.!!!");
				}
				else
				{
				   $('#agency_address').val(data.agency_address); 
				  $('#agency_mobile').val(data.agency_mobile); 
				  $('#sel_city_of_agency').val(data.agency_city).prop('selected', true); 
				  $('#agency_pincode').val(data.agency_pincode); 
				  $('#agency_email').val(data.agency_email); 
				  $('#agency_gst').val(data.agency_gstno);
				  $('#select_agency').val(data.agency_id).prop('selected', true);
					}
				 
				  
				 
				  
 			 }

		}); 
			}

    });
	
// get exist client by enter client code
$("#exist_client").change(function(){
				
				var exist_client = $('#exist_client').val();
                
				var postData = '&exist_client='+exist_client;
				
				
		$.ajax({
			url : "<?php $base_url; ?>get_exist_client.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				 
				  $('#client_code').val(data.client_code); 
				  $('#client_name').val(data.clientname); 
				  $('#phone').val(data.clientphone); 
				  $('#email').val(data.email); 
				  $('#address').val(data.clientaddress); 
				  $('#sel_category').val(data.category).prop('selected', true);
				   $('#person').val(data.person);
				  $('#person_mobile').val(data.pmobile);
				 
				  
				 
				  
 			 }

		}); 
    });
	
	$("#sel_client").change(function(){
				
				var exist_client = $('#sel_client').val();
                
				var postData = '&exist_client='+exist_client;
				
				
		$.ajax({
			url : "<?php $base_url; ?>get_exist_client.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				  
				  $('#client_code').val(data.client_code); 
				  $('#client_name').val(data.clientname); 
				  $('#address').val(data.clientaddress); 
				  $('#phone').val(data.clientphone); 
				  $('#email').val(data.email); 
				  //$('#sel_city').val(data.client_city).prop('selected', true);
				  //$('#pincode').val(data.pincode);
				  $('#customer_gst_no').val(data.gst_no);
				  
			}

		}); 
    });
	
	
// get exist agency by code
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
$("#sel_clientz").change(function(){
				
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
	
	
	
// get exist client by select TPI	
$("#sel_tpi").change(function(){
				
				var exist_tpi = $('#sel_tpi').val();
                
				var postData = '&exist_tpi='+exist_tpi;
				
				
		$.ajax({
			url : "<?php $base_url; ?>get_exist_client.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				  
				  $('#tpi_code').val(data.tpi_code); 
				  $('#tpi_name').val(data.tpi_name); 
				  $('#tpi_address').val(data.tpi_address); 
				  $('#tpi_phone').val(data.tpi_phone); 
				  $('#tpi_email').val(data.tpi_email); 
				  //$('#sel_city').val(data.client_city).prop('selected', true);
				  //$('#pincode').val(data.pincode);
				  //$('#customer_gst_no').val(data.gst_no);
				  
			}

		}); 
    });
	
	// get exist client by select TPI	
$("#exist_tpi").change(function(){
				
				var exist_tpi = $('#exist_tpi').val();
                
				var postData = '&exist_tpi='+exist_tpi;
				
				
		$.ajax({
			url : "<?php $base_url; ?>get_exist_client.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				  
				  $('#tpi_code').val(data.tpi_code); 
				  $('#tpi_name').val(data.tpi_name); 
				  $('#tpi_address').val(data.tpi_address); 
				  $('#tpi_phone').val(data.tpi_phone); 
				  $('#tpi_email').val(data.tpi_email); 
				  //$('#sel_city').val(data.client_city).prop('selected', true);
				  //$('#pincode').val(data.pincode);
				  //$('#customer_gst_no').val(data.gst_no);
				  
			}

		}); 
    });

// get exist client by select TPI	
$("#sel_pmc").change(function(){
				
				var sel_pmc = $('#sel_pmc').val();
                
				var postData = '&exist_pmc='+sel_pmc;
				
				
		$.ajax({
			url : "<?php $base_url; ?>get_exist_client.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				  
				  $('#pmc_code').val(data.pmc_code); 
				  $('#pmc_name').val(data.pmc_name); 
				  $('#pmc_address').val(data.pmc_address); 
				  $('#pmc_phone').val(data.pmc_phone); 
				  $('#pmc_email').val(data.pmc_email); 
				  //$('#sel_city').val(data.client_city).prop('selected', true);
				  //$('#pincode').val(data.pincode);
				  //$('#customer_gst_no').val(data.gst_no);
				  
			}

		}); 
    });
	
	$("#exist_pmc").change(function(){
				
				var sel_pmc = $('#exist_pmc').val();
                
				var postData = '&exist_pmc='+sel_pmc;
				
				
		$.ajax({
			url : "<?php $base_url; ?>get_exist_client.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				  
				  $('#pmc_code').val(data.pmc_code); 
				  $('#pmc_name').val(data.pmc_name); 
				  $('#pmc_address').val(data.pmc_address); 
				  $('#pmc_phone').val(data.pmc_phone); 
				  $('#pmc_email').val(data.pmc_email); 
				  //$('#sel_city').val(data.client_city).prop('selected', true);
				  //$('#pincode').val(data.pincode);
				  //$('#customer_gst_no').val(data.gst_no);
				  
			}

		}); 
    });


	
$('#date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })

var starting_date='<?php echo $starting_date;?>';

if(starting_date !="")
{
	var d = new Date(starting_date);
	
var curr_date = d.getDate();
var curr_month = d.getMonth() + 1; //Months are zero based
var curr_year = d.getFullYear();
var started_date=(curr_date + "/" + curr_month + "/" + curr_year);
var d_one = new Date();
var curr_date1 = d_one.getDate();
var curr_month1 = d_one.getMonth() + 1; //Months are zero based
var curr_year1 = d_one.getFullYear();
var ended_date=(curr_date1 + "/" + curr_month1 + "/" + curr_year1);


	$('#sw_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  startDate: "'"+started_date+"'",
	  endDate: "'"+ended_date+"'"
    });
	
}else{
	$('#sw_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
    });
}

$('#sample_rec_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  startDate: "'"+started_date+"'"
    });

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
