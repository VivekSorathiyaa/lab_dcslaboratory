
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

$get_job_id= $_GET["job_id"];
$serial="SELECT * FROM  job WHERE job_id=".$get_job_id;
$res = mysqli_query($conn, $serial);
$get_one_job= mysqli_fetch_array($res);

$today= date("Y-m-d");



	$get_client_code=$get_one_job["client_code"];
	$get_clientname=$get_one_job["clientname"];
	$get_clientaddress=$get_one_job["clientaddress"];
	$get_clientphone=$get_one_job["clientphone"];
	$get_email=$get_one_job["email"];
	$get_client_pincode=$get_one_job["client_pincode"];
	$get_client_city=$get_one_job["client_city"];
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
	$scan_document=$get_one_job["scan_document"];
	$get_refno=$get_one_job["refno"];
	$get_date=$get_one_job["date"];
	$get_sample_sent_by=$get_one_job["sample_sent_by"];
	$get_report_sent_to=$get_one_job["report_sent_to"];
	$get_sample_rec_date=$get_one_job["sample_rec_date"];
	$get_condition_of_sample_receved=$get_one_job["condition_of_sample_receved"];
	$final_report_no=$get_one_job["report_no"];
	$get_job_id_for_edit=$get_one_job["job_id"];

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
		Customer Form
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
									
									<div class="col-md-12">
										<label for="inputEmail3" class="control-label">USE FOR EXISTING CUSTOMERS</label>
									</div>
																	
						</div>
					    <div class="row">
									<div class="col-md-5">																			
										<input type="text" class="col-sm-12 form-control" id="exist_client" tabindex="8" name="exist_client" placeholder="Enter Existing Customer Code">
									</div>
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">OR</label>
									</div>
									
									<div class="col-md-5" style="width:39%;">
										<select class="form-control select2 col-sm-12" tabindex="6"  data-placeholder="Select Existing Customer" id="sel_client" name="sel_client"  >
											<option value="">Select Customer</option>
											<?php
											$get_client="SELECT *FROM client";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while($r = mysqli_fetch_array($client_res)){?>
												<option value="<?php echo $r["client_code"]?>"><?php echo $r["clientname"]?></option>
												<?php } }?>
										</select>
									</div>
					</div>
					<hr width="80%">
					<div class="row">
									
						<div class="col-md-12">
							<label for="inputEmail3" class="control-label">USE FOR NEW CUSTOMERS</label>
						</div>
																	
					</div>

							<div class="row">									
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="client_code" tabindex="0" name="client_code" value="<?php echo $get_client_code;?>" required disabled> 
									</div>									
									<div class="col-md-4">
										<input type="text" class="col-sm-12 form-control" id="client_name" value="<?php echo $get_clientname;?>" tabindex="1" name="client_name" placeholder="Enter Customer Name" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-3">
											<input type="text" class="col-sm-12 form-control" id="phone" tabindex="2" value="<?php echo $get_clientphone;?>" name="phone" placeholder="Enter Phone no." required>
									</div>
									<div class="col-md-3">
										<input type="email" class="col-sm-12 form-control" id="email" value="<?php echo $get_email;?>" tabindex="3" name="email" placeholder="Enter Email Id."  required>
									</div>
									
							</div>
					
							<div class="row">									
									<div class="col-md-12">
										<textarea id="address" tabindex="4" style="height:50px" name="address" class="col-sm-12 form-control"required placeholder="Enter Address."><?php echo $get_clientaddress;?></textarea>
									</div>																									
								</div>
							
								<br>
								<div class="row">								
									<div class="col-md-2">
										<input type="email" class="col-sm-12 form-control" id="pincode" tabindex="5" placeholder="Enter Pincode." tabindex="8" name="pincode" value="<?php echo $get_client_pincode;?>" required>
									</div>								
									<div class="col-md-4">
										<select class="form-control col-sm-12 select2" tabindex="6"  data-placeholder="Select City."  id="sel_city" name="sel_city" required >
											<option value="">Select City</option>
											<option value="">Select City</option>
											<?php 
												$sql = "select * from city";
											
												$result = mysqli_query($conn, $sql);

													while($row = mysqli_fetch_assoc($result)) {
												
												?>
												<option value="<?php echo $row['id']; ?>" <?php if($row['id']== $get_client_city){ echo "selected";}?>>
												<?php echo $row['city_name']; ?></option>
												<?php  }?>
										</select>
										
									</div>
									<div class="col-md-1">
									<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-city">
									</div>
									<div class="col-md-5">
										<input type="text" placeholder="Enter GST No." class="col-sm-12 form-control" id="customer_gst_no" tabindex="7" name="customer_gst_no" value="<?php echo $get_client_gstno;?>" required>
									</div>
										
								</div>
								<hr style="border: 1px solid #ddd;">
								<!--FINAL-->
								<div class="row">
									
									<div class="col-md-12">
													<label for="inputEmail3" class="control-label">USE FOR EXISTING AGENCY</label>
												</div>
																				
								</div>
								<div class="row">
												<div class="col-md-5">																			
													<input type="text" class="col-sm-12 form-control" id="exist_agency_mo" tabindex="8" name="exist_agency_mo" placeholder="Enter Existing Agency Mobile No.">
												</div>
												<div class="col-md-2">
													<label for="inputEmail3" class="control-label">OR</label>
												</div>
												
												<div class="col-md-4" >
													<select class="form-control  col-sm-12" data-placeholder="Select Agency" tabindex="9"  id="select_agency" name="select_agency" required >
														<option value="">Select Agency</option>
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
														<input type="button" value="+" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-agency">
														
												</div>
								</div>
								<hr width="80%">
								<div class="row">																								
									<div class="col-md-12">
										<textarea id="agency_address" style="height:50px" tabindex="10"  name="agency_address" class="col-sm-12 form-control"required placeholder="Enter Agency Address."><?php echo $get_agency_address;?></textarea><span style="color:red;">*</span>
									</div>
								</div>
					
								<div class="row">								
									<div class="col-md-3">
										<input type="text" class="col-sm-12 form-control" id="agency_mobile" value="<?php echo $get_agency_mobile;?>" tabindex="11" name="agency_mobile" required placeholder="Enter Mobile No."><span style="color:red;">*</span>
									</div>
								
									<div class="col-md-2">
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
										<input type="text" class="col-sm-12 form-control" placeholder="Enter Pincode." id="agency_pincode" tabindex="13" name="agency_pincode" value="<?php echo $get_agency_pincode;?>" required><span style="color:red;">*</span>
									</div>
									
							
									<div class="col-md-3">
										<input type="text"  placeholder="Enter Email Id." class="col-sm-12 form-control" id="agency_email" tabindex="14" name="agency_email" value="<?php echo $get_agency_email;?>" required><span style="color:red;">*</span>
									</div>
								</div>							
								<div class="row">															
								<div class="col-md-3">
									<input type="text" class="col-sm-12 form-control"  placeholder="Enter GST No." id="agency_gst" tabindex="15" name="agency_gst" value="<?php echo $get_agency_gstno;?>" required>
								</div>
								</div>

								
							<hr style="border: 1px solid #ddd;">
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
							<hr style="border: 1px solid #ddd;">
							<div class="row">									
									<div class="col-md-12">
										<label for="inputEmail3" class="control-label">Document Upload</label>
									</div>
							</div>
							<div class="row">							
							<div class="col-md-6">
										<input type="text" placeholder="Enter Authority Person." class="col-sm-12 form-control" id="person_name" tabindex="17" name="person_name" value="<?php echo $person_name;?>">
							</div>													
							<div class="col-md-4">
										<input type="file" tabindex="18" class="col-sm-12 form-control" placeholder="" id="upload_img" name="upload_img">
							</div>
							<div class="col-md-2">
							<?php if($scan_document != ""){ ?>
							<a href="<?php echo $base_url."scan_document/".$scan_document;?>" target="_blank">Available</a>	
							<?php }?>
							</div>
							</div>													
						
							<hr style="border: 1px solid #ddd;">						
							<div class="row">									
									<div class="col-md-12">
										<label for="inputEmail3" class="control-label">JOB DETAILS</label>
									</div>
							</div>							
							<div class="row">
								
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" placeholder="REFRENCE NO." id="ref_no" tabindex="19" name="ref_no" value="<?php echo $get_refno;?>" required > 
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Date:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="date" tabindex="20" name="date" value="<?php echo date('d/m/Y', strtotime($get_date));?>" required > 
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Report No:</label>
									</div>
									<div class="col-md-6">
										<input type="text" class="col-sm-12 form-control" id="report_no"  name="report_no" value="<?php echo $final_report_no; ?>" required readonly> 
									</div>
									
							</div>
							<br>
							<div class="row">
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Select Sample Sent By:</label>
									</div>							
									<div class="col-md-2">
										<select class="form-control col-sm-12 select2" data-placeholder="Select Sample Sent By" tabindex="21"   id="sel_sent_by" name="sel_sent_by" required >
											<option value="">Select Sample Sent By</option>												
											<option value="0" <?php if($get_sample_sent_by== 0){ echo "selected";}?>>Customer</option>
											<option value="1" <?php if($get_sample_sent_by== 1){ echo "selected";}?>>Agency</option>
												
										</select><span style="color:red;">*</span>
									</div>	
										<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Select Report Sent To:</label>
									</div>										
									<div class="col-md-2">
										<select class="form-control col-sm-12 select2" tabindex="22" data-placeholder="Select Report Sent To"  id="sel_report_to" name="sel_report_to" required >
											<option value="">Select Report Sent To</option>
												<option value="0" <?php if($get_report_sent_to== 0){ echo "selected";}?>>Customer</option>
											<option value="1" <?php if($get_report_sent_to== 1){ echo "selected";}?>>Agency</option>
												
										</select><span style="color:red;">*</span>
									</div>									
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Sample received Date:</label>
									</div>
									<div class="col-md-3">
										<input type="text" class="col-sm-12 form-control" id="sample_rec_date" tabindex="23" name="sample_rec_date" value="<?php echo date('d/m/Y', strtotime($get_sample_rec_date));?>" required > <span style="color:red;">*</span>
									</div>
									<input type="hidden" name="edit_job_id" id="edit_job_id" value="<?php echo $get_job_id_for_edit; ?>">
									
							</div>
							
							<div class="row">
														
								<div class="col-md-4">
										<select class="form-control col-sm-12 select2" tabindex="24" data-placeholder="Select Condition of Sample Received" id="sel_by_condition" name="sel_by_condition" required >
											<option value="">Select Condition of Sample Received</option>
											<option value="0" <?php if($get_condition_of_sample_receved== 0){ echo "selected";}?>>Sealed</option>
											<option value="1" <?php if($get_condition_of_sample_receved== 1){ echo "selected";}?>>Unsealed</option>
												
										</select><span style="color:red;">*</span>
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
									
									<div class="col-sm-4" style="text-align: center;">
											<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('edit')" style="margin-bottom:25px;    border-radius: 20px;"> Edit Job</button>
									        <span id="available_msg" style="color:red;font-size:20px;"></span>
											
											
									</div>
									
									<div class="col-sm-4">
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
                <h4 class="modal-title">Add New Agency</h4>
              </div>
				<form id="form_agency" name="form_agency" method="post">
					<div class="modal-body">
						<div class="form-group">
												<div class="col-md-6">
													<label>Agency Name</label>
													<input type="text" class="form-control" name="agency_name" id="add_agency_name" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Mobile No</label>
													<input type="text" class="form-control" name="agency_mobile" id="add_agency_mobile" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Address</label>
													<textarea name="add_agency_address" id="add_agency_address" class="col-sm-12 form-control"required ></textarea>
												</div>
												
												<div class="col-md-6">
													<label>Agency City</label>
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
													<label>Agency Pincode</label>
													<input type="text" class="form-control" name="add_agency_pincode" id="add_agency_pincode" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Email</label>
													<input type="text" class="form-control" name="add_agency_email" id="add_agency_email" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Gstno</label>
													<input type="text" class="form-control" name="add_agency_gstno" id="add_agency_gstno" required >
												</div>
									
												<div class="col-md-6">
													<label>Agency Status</label>
													<select class="form-control col-md-7 col-xs-12" name="add_agency_status" id="add_agency_status">
														<option  value="0">Activate</option>
														<option value="1">Deactivate</option>
													<select>			
												</div>
												
								
											</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btn_add_agency" name="btn_add_agency" data-dismiss="modal">Add Agency</button>
					</div>
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
		
<?php include("footer.php");?>
<script>

 

  $(function () {
    $('.select2').select2();
  });
$(document).ready(function()
	{ 
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
				var pincode = $('#pincode').val(); 
				var sel_city = $('#sel_city').val();
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
				var ref_no = $('#ref_no').val();
				var date = $('#date').val();
				var report_no = $('#report_no').val();
				var sel_sent_by = $('#sel_sent_by').val();
				var sel_report_to = $('#sel_report_to').val();
				var sample_rec_date = $('#sample_rec_date').val();
				var sel_by_condition = $('#sel_by_condition').val();
				var person_name = $('#person_name').val();
				var edit_job_id = $('#edit_job_id').val();
				
				
				
			
				billData = '&action_type='+type+'&client_code='+client_code+'&client_name='+client_name+'&address='+address+'&phone='+phone+'&email='+email+'&pincode='+pincode+'&sel_city='+sel_city+'&customer_gst_no='+customer_gst_no+'&select_agency='+select_agency+'&agency_address='+agency_address+'&agency_mobile='+agency_mobile+'&sel_city_of_agency='+sel_city_of_agency+'&agency_pincode='+agency_pincode+'&agency_email='+agency_email+'&agency_gst='+agency_gst+'&name_of_work='+name_of_work+'&ref_no='+ref_no+'&date='+date+'&report_no='+report_no+'&sel_sent_by='+sel_sent_by+'&sel_report_to='+sel_report_to+'&sample_rec_date='+sample_rec_date+'&sel_by_condition='+sel_by_condition+'&person_name='+person_name+'&edit_job_id='+edit_job_id;
	
	}
	else{
			
	
				billData = 'action_type='+type+'&id='+id;
    }
	
	// set blank message to submit
	var error_msg="";
	if(client_name ==""){
		error_msg +="Client Name Required"+"<br>";
		
	}
	if(select_agency ==""){
		error_msg="Agency Name Required"+"<br>";
	}
	if(agency_address ==""){
		error_msg +="Agency Address Required"+"<br>";
	}
	if(agency_mobile ==""){
		error_msg +="Agency Mobile Number Required"+"<br>";
	}
	if(sel_city_of_agency ==""){
		error_msg +="Agency City Required"+"<br>";
	}
	if(sel_sent_by ==""){
		error_msg +="Sample Sent By Required"+"<br>";
	}
	if(sel_report_to ==""){
		error_msg +="Report Sent To Required"+"<br>";
	}
	if(sel_by_condition ==""){
		error_msg +="Client Name Required"+"<br>";
	}
	if(name_of_work ==""){
		error_msg +="Name Of Work Required"+"<br>";
	}
	if(agency_pincode ==""){
		error_msg +="Agency Pincode Required"+"<br>";
	}
	if(agency_email ==""){
		error_msg +="Agency Email Required"+"<br>";
	}
	if(agency_gst ==""){
		error_msg +="Agency Gst Number Required"+"<br>";
	}
	
	
	if(client_name !== "" && select_agency !== ""&& agency_address !== "" && agency_mobile !== ""&& sel_city_of_agency !== ""&& sel_sent_by !== ""&& sel_report_to !== ""&& sel_by_condition !== ""&& name_of_work !== ""&& agency_pincode !== ""&& agency_email !== ""&& agency_gst !== "")
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
		form_data.append("report_no", report_no);
		form_data.append("sel_sent_by", sel_sent_by);
		form_data.append("sel_report_to", sel_report_to);
		form_data.append("sample_rec_date", sample_rec_date);
		form_data.append("sel_by_condition", sel_by_condition);
		form_data.append("person_name", person_name);
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
			alert("Job Is Successfully Updated");
			window.location.href="<?php $base_url; ?>pending_job.php";
			
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
			$("#sel_city").html(data);   
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


<!---add Authority------->
$("#btn_add_auth").click(function(){
 var txt_new_auth = $('#txt_new_auth').val(); 
 var res = txt_new_auth.replace("&", "_");
 var postData = '&txt_new_auth='+res;
	  $.ajax({
		url : "<?php $base_url; ?>auth_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
		
			$("#sel_authority").html(data);
			$("#txt_new_auth").val("");
			
		   
		 }

	}); 

});


// add Authority city
$("#btn_add_auth_city").click(function(){  
	var txt_new_city = $('#txt_new_auth_city').val(); 
	var postData = '&txt_new_city='+txt_new_city;

	$.ajax({
		url : "<?php $base_url; ?>Form_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
			$("#sel_auth_city").html(data);     
			$('#txt_new_city').val("");
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
 var postData = '&agency_name='+agency_name+'&agency_mobile='+agency_mobile+'&agency_address='+agency_address+'&sel_agency_city='+sel_agency_city+'&agency_pincode='+agency_pincode+'&agency_email='+agency_email+'&agency_gstno='+agency_gstno+'&agency_status='+agency_status;
	
	if(agency_name!=""){
	  $.ajax({
		url : "<?php $base_url; ?>agency_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
		
			$("#select_agency").html(data);
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
				  $('#sel_city').val(data.client_city).prop('selected', true);
				  $('#sel_category').val(data.category).prop('selected', true);
				   $('#person').val(data.person);
				  $('#person_mobile').val(data.pmobile);
				 
				  
				 
				  
 			 }

		}); 
    });
	
	
// get exist agency by code
$("#select_agency").change(function(){
				
				var select_agency = $('#select_agency').val();
                
				var postData = '&select_agency='+select_agency;
				
				
		$.ajax({
			url : "<?php $base_url; ?>get_exist_client.php",
			type: "POST",
			dataType:'JSON',
			data : postData,
			success: function(data,status,  xhr)
			 {
				
				 
				  $('#agency_address').val(data.agency_address); 
				  $('#agency_mobile').val(data.agency_mobile); 
				  $('#sel_city_of_agency').val(data.agency_city).prop('selected', true); 
				  $('#agency_pincode').val(data.agency_pincode); 
				  $('#agency_email').val(data.agency_email); 
				  $('#agency_gst').val(data.agency_gstno);
				  
				  
				 
				  
 			 }

		}); 
    });


// get exist client by select client	
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
				  $('#sel_city').val(data.client_city).prop('selected', true);
				  $('#pincode').val(data.pincode);
				  $('#customer_gst_no').val(data.gst_no);
				  
			}

		}); 
    });


	
$('#date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })

$('#sample_rec_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
	
	
	
// set report no  on date change	
$("#date").on("change",function(){
	
	var get_date= $('#date').val();;
	var postingData = 'action_type=through_date&get_dating='+get_date;
	$.ajax({
			url : "<?php $base_url; ?>savetest_master.php",
			type: "POST",
			dataType:'JSON',
			data : postingData,
			success: function(data)
			 {
				$('#report_no').val(data.report_numburing);
		
 			 }

		});
	
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
