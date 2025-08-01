<?php
session_start();
include("header.php");
if ($_SESSION['name'] == "") {
	?>
	<script>
		window.location.href = "<?php echo $base_url; ?>index.php";
	</script>
	<?php
}

$serial = "SELECT * FROM client ORDER BY client_id DESC";
$res = mysqli_query($conn, $serial);

if (mysqli_num_rows($res) > 0) {
	$r = mysqli_fetch_assoc($res);
	$ser_no = $r["client_code"] + 1;
} else {
	$ser_no = 1;
}

$serial1 = "SELECT * FROM tpi ORDER BY tpi_id DESC";
$res1 = mysqli_query($conn, $serial1);

if (mysqli_num_rows($res1) > 0) {
	$r1 = mysqli_fetch_assoc($res1);
	$ser_no1 = $r1["tpi_code"] + 1;
} else {
	$ser_no1 = 1;
}

$serial2 = "SELECT * FROM pmc ORDER BY pmc_id DESC";
$res2 = mysqli_query($conn, $serial2);

if (mysqli_num_rows($res2) > 0) {
	$r2 = mysqli_fetch_assoc($res2);
	$ser_no2 = $r2["pmc_code"] + 1;
} else {
	$ser_no2 = 1;
}


$today = date("Y-m-d");

$job_serial = "SELECT * FROM job ORDER BY job_id DESC";
$job_res = mysqli_query($conn, $job_serial);

if (mysqli_num_rows($job_res) > 0) {
	$job_r = mysqli_fetch_array($job_res);

	$sam_rec_date = $job_r["sw_date"];
	$last_refno = $job_r["refno"];

	if ($sam_rec_date < $today) {
		$starting_date = date('Y-m-d H:i:s', strtotime($sam_rec_date));
	} else {
		$starting_date = "";
	}

} else {
	$starting_date = "";
	$last_refno = "";
}

?>

<?php

if (isset($_POST["btn_save_job"])) {
	?>
	<script>
		alert("Job Inserted Sucessfully.");
		window.location.href = "<?php $base_url; ?>client_form.php";
	</script>

<?php
}

?>

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
		Job Inward
		</h1>
	</div>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-info border-0">
				<div class="col-md-12 p-0">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="active tab-pane" id="clients">
					<form class="" method="post" >
					
					<div style="border:0px solid black;padding:5px">
								<div class="row">
												
												<div class="col-md-4" >
													<label>Agency / Contractor / Customer<span style="color:red;">*</span></label>
													<select class="form-control  select2 col-sm-12" tabindex="9"  id="select_agency" name="select_agency" required >
														<option value="0">Select Agency</option>
														<?php
														$cat_sql = "select * from agency_master where `isdeleted`=0";

														$cat_result = mysqli_query($conn, $cat_sql);

														while ($cat_row = mysqli_fetch_assoc($cat_result)) {

															?>
																<option value="<?php echo $cat_row['agency_id']; ?>">
																<?php echo str_replace("zxctxavb", "'", $cat_row['agency_name']); ?></option>
															<?php } ?>
													</select>
												</div>
												<div class="col-md-1">
														<input type="button" value="NEW" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-agency" style="margin-top:28px;">
												</div>
												<div class="col-md-1">
														<a data-toggle="collapse" href="#collapse1" class="col-sm-10 btn btn-info" style="margin-top:28px;">View</a>
												</div>
												
												<div class="col-md-4" >
										<label>Client(End Customer):</label>
										<select class="form-control select2 col-sm-12" tabindex="6"   id="sel_client" name="sel_client">
											<option value="0">Select Client(End Customer)</option>
											<?php
											$get_client = "SELECT *FROM client where `clientisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while ($r = mysqli_fetch_array($client_res)) { ?>
														<option value="<?php echo $r["client_code"] ?>"><?php echo str_replace("zxctxavb", "'", $r['clientname']); ?></option>
													<?php }
											} ?>
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
										<textarea id="agency_address" style="height:50px" tabindex="10"  name="agency_address" class="col-sm-12 form-control"required placeholder="Enter Agency Address."></textarea><span style="color:red;">*</span>
									</div>
								</div>
								<br>
								<div class="row">								
									<div class="col-md-3">
									<label>Agency Mobile No:</label>
										<input type="text" class="col-sm-12 form-control" id="agency_mobile" tabindex="11" name="agency_mobile" required placeholder="Enter Mobile No."><span style="color:red;">*</span>
									</div>
								
									<div class="col-md-2">
									<label>Agency City:</label>
										<select class="form-control  col-sm-12" tabindex="12"  data-placeholder="Select City" id="sel_city_of_agency" name="sel_city_of_agency" required >
											<option value="">Select City</option>
											<?php
											$sql = "select * from city";

											$result = mysqli_query($conn, $sql);

											while ($row = mysqli_fetch_assoc($result)) {

												?>
													<option value="<?php echo $row['id']; ?>">
													<?php echo $row['city_name']; ?></option>
												<?php } ?>
										</select>
										
									</div>
									<div class="col-md-1">
									<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-city">
									</div>
								
									<div class="col-md-3">
									<label>Agency Pincode:</label>
										<input type="text" class="col-sm-12 form-control" placeholder="Enter Pincode." id="agency_pincode" tabindex="13" name="agency_pincode" >
									</div>
									
							
									<div class="col-md-3">
									<label>Agency Email:</label>
										<input type="text"  placeholder="Enter Email Id." class="col-sm-12 form-control" id="agency_email" tabindex="14" name="agency_email" >
									</div>
								</div>
								<br>
								<div class="row">															
								<div class="col-md-3">
								<label>Agency Gst:</label>
									<input type="text" class="col-sm-12 form-control"  placeholder="Enter GST No." id="agency_gst" tabindex="15" name="agency_gst" >
								</div>
								</div>
						</div>
					</div>
					<div style="border:0px solid black;padding:5px">
									
									<div id="collapse2" class="panel-collapse collapse">
									
									<div class="row">									
									<div class="col-md-2">
									<label>Customer Code :</label>
										<input type="text" class="col-sm-12 form-control" id="client_code" tabindex="0" name="client_code" value="<?php echo $ser_no; ?>" required disabled> 
									</div>									
									<div class="col-md-5">
									<label>Customer Name:</label>
										<input type="text" class="col-sm-12 form-control" id="client_name" tabindex="1" name="client_name" placeholder="Enter Customer Name" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-2">
									<label>Customer Phone Number:</label>
											<input type="text" class="col-sm-12 form-control" id="phone" tabindex="2" name="phone" placeholder="Enter Phone no." required><span style="color:red;">*</span>
									</div>
									<div class="col-md-3">
									<label>Customer Email:</label>
										<input type="email" class="col-sm-12 form-control" id="email" tabindex="3" name="email" placeholder="Enter Email Id."  required>
									</div>
									
								</div>
								<br>
								<div class="row">									
									<div class="col-md-6">
									<label>Customer Address:</label>
										<textarea id="address" tabindex="4" style="height:50px" name="address" class="col-sm-12 form-control"required placeholder="Enter Address."></textarea>
									</div>
									<div class="col-md-6">
									<label>Customer Gst No:</label>
										<input type="text" placeholder="Enter GST No." class="col-sm-12 form-control" id="customer_gst_no" tabindex="7" name="customer_gst_no" required>
									</div>
								</div>
								
								</div>
							
				</div>
				<div style="border:0px solid black;padding:5px">
						<div class="row">
									
									<div class="col-md-4">
										<label>
										<input type="text" value="TPI" name="tpi_or_auth" id="tpi_or_auth"></label>
										<select class="form-control select2 col-sm-12" tabindex="6"  7 id="sel_tpi" name="sel_tpi"  >
											<option value="0">Select TPI</option>
											<?php
											$get_client = "SELECT *FROM tpi where `tpiisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while ($r = mysqli_fetch_array($client_res)) { ?>
														<option value="<?php echo $r["tpi_code"] ?>"><?php echo str_replace("zxctxavb", "'", $r['tpi_name']); ?></option>
													<?php }
											} ?>
										</select>
									</div>
									<div class="col-md-1">
										<input type="button" value="NEW" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-tpi" style="margin-top:28px;">
									</div>
									<div class="col-md-1">
										<a data-toggle="collapse" href="#collapse3" class="col-sm-10 btn btn-info" style="margin-top:28px;">View</a>
									</div>
									
									<div class="col-md-4">
										<label><input type="text" value="PMC" name="pmc_heading" id="pmc_heading"></label>
										<select class="form-control select2 col-sm-12" tabindex="6"   id="sel_pmc" name="sel_pmc"  >
											<option value="0">Select PMC</option>
											<?php
											$get_client = "SELECT *FROM pmc where `pmcisdeleted`=0";
											$client_res = mysqli_query($conn, $get_client);
											if (mysqli_num_rows($client_res) > 0) {
												while ($r = mysqli_fetch_array($client_res)) { ?>
														<option value="<?php echo $r["pmc_code"] ?>"><?php echo str_replace("zxctxavb", "'", $r['pmcname']); ?></option>
													<?php }
											} ?>
										</select>
									</div>
									<div class="col-md-1">
										<input type="button" value="NEW" class="col-sm-10 btn btn-info" data-toggle="modal" data-target="#modal-pmc" style="margin-top:28px;">
									</div>
									<div class="col-md-1">
										<a data-toggle="collapse" href="#collapse4" class="col-sm-10 btn btn-info" style="margin-top:28px;">View</a>
									</div>
					</div>
									<div id="collapse3" class="panel-collapse collapse">
									<div class="row">									
									<div class="col-md-2">
									<label>TPI Code :</label>
										<input type="text" class="col-sm-12 form-control" id="tpi_code" tabindex="0" name="tpi_code" value="<?php echo $ser_no1; ?>" required disabled> 
									</div>									
									<div class="col-md-5">
									<label>TPI Name:</label>
										<input type="text" class="col-sm-12 form-control" id="tpi_name" tabindex="1" name="tpi_name" placeholder="Enter TPI Name" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-2">
									<label>TPI Phone Number:</label>
											<input type="text" class="col-sm-12 form-control" id="tpi_phone" tabindex="2" name="tpi_phone" placeholder="Enter Phone no." required><span style="color:red;">*</span>
									</div>
									<div class="col-md-3">
									<label>TPI Email:</label>
										<input type="email" class="col-sm-12 form-control" id="tpi_email" tabindex="3" name="tpi_email" placeholder="Enter Email Id."  required>
									</div>
									
								</div>
								<br>
								<div class="row">									
									<div class="col-md-6">
									<label>TPI Address:</label>
										<textarea id="tpi_address" tabindex="4" style="height:50px" name="tpi_address" class="col-sm-12 form-control"required placeholder="Enter Address."></textarea>
									</div>
								</div>
							</div>
							
				</div>
					<div style="border:0px solid black;padding:5px">
						
									<div id="collapse4" class="panel-collapse collapse">
									<div class="row">									
									<div class="col-md-2">
									<label>PMC Code :</label>
										<input type="text" class="col-sm-12 form-control" id="pmc_code" tabindex="0" name="pmc_code" value="<?php echo $ser_no2; ?>" required disabled> 
									</div>									
									<div class="col-md-5">
									<label>PMC Name:</label>
										<input type="text" class="col-sm-12 form-control" id="pmc_name" tabindex="1" name="pmc_name" placeholder="Enter Customer Name" required><span style="color:red;">*</span>
									</div>
									<div class="col-md-2">
									<label>PMC Phone Number:</label>
											<input type="text" class="col-sm-12 form-control" id="pmc_phone" tabindex="2" name="pmc_phone" placeholder="Enter Phone no." required><span style="color:red;">*</span>
									</div>
									<div class="col-md-3">
									<label>PMC Email:</label>
										<input type="email" class="col-sm-12 form-control" id="pmc_email" tabindex="3" name="pmc_email" placeholder="Enter Email Id."  required>
									</div>
									
								</div>
								<br>
								<div class="row">									
									<div class="col-md-6">
									<label>PMC Address:</label>
										<textarea id="pmc_address" tabindex="4" style="height:50px" name="pmc_address" class="col-sm-12 form-control"required placeholder="Enter Address."></textarea>
									</div>
								</div>
								</div>
							
				</div>
							<hr style="border: 1px solid #ddd;">
							
							<div class="row">
							<div class="col-md-6">
										<label for="inputEmail3" >Name Of Work<span style="color:red;">*</span></label>
							</div>
							<div class="col-md-2">
										<label for="inputEmail3" >Doc. Upload</label>
							</div>
							<div class="col-md-2">
										<label for="inputEmail3" >Agree. No</label>
							</div>
							<div class="col-md-2">
										<label for="inputEmail3" >Sample Delivered By<span style="color:red;">*</span></label>
							</div>
							</div>
							<div class="row">
							
							<div class="col-md-6">
										<textarea id="editor1" name="editor1" tabindex="16" class="col-sm-12 form-control"required style="height:50px!important;"></textarea>
							</div>
							<div class="col-md-2">
										<input type="file" tabindex="18" class="col-sm-12 form-control" placeholder="" id="upload_img" name="upload_img">
							</div>
							<div class="col-md-2">
									<input type="text" class="col-sm-12 form-control"  placeholder="Enter Agreement No." id="agreement_no" tabindex="15" name="agreement_no" >
							</div>
							<div class="col-md-2">
									<input type="text" placeholder="Delivered By Person Name" class="col-sm-12 form-control" id="person_name" tabindex="17" name="person_name">
							</div>
							<div class="col-md-2">
								<label>Delivered By<span style="color:red;">*</span></label>
								<input type="text" placeholder="Mobile No" class="col-sm-12 form-control" id="person_auth_mobile" tabindex="17" name="person_auth_mobile">
							</div>
							<div class="col-md-2">
								<label>Reference No:</label>
									<input type="text" class="col-sm-12 form-control" placeholder="REFERENCE NO." id="ref_no" tabindex="19" name="ref_no" value="" required> 
							</div>
							<div class="col-md-2">
										<label for="inputEmail3" > Reference Date:</label>
										<input type="text" class="col-sm-12 form-control" id="date" tabindex="20" name="date" value="" required disabled> 
							</div>
							<div class="col-md-2">
								<label for="inputEmail3" >Select Sample Sent By:</label>
								<select class="form-control col-sm-12 select2" data-placeholder="Select Sample Sent By" tabindex="21"   id="sel_sent_by" name="sel_sent_by" required >
									<option value="">Select Sample Sent By</option>
									<option value="0">Client</option>
									<option value="1" selected>Agency</option>
										
								</select>
							</div>
							<div class="col-md-2">
								<label>Physical S.R.F. No:</label>
									<input type="text" class="col-sm-12 form-control" placeholder="TRF REFERENCE NO." id="trf_ref" tabindex="19" name="trf_ref" value="" required> 
							</div>								
							<div class="col-md-2">
								<label for="inputEmail3" >Select Report Sent To:</label>
								<select class="form-control col-sm-12 select2" tabindex="22" data-placeholder="Select Report Sent To"  id="sel_report_to" name="sel_report_to" required >
									<option value="">Select Report Sent To</option>
									<option value="0">Client</option>
									<option value="1" selected>Agency</option>
										
								</select>
							</div>									
							<div class="col-md-2">
								<label for="inputEmail3" >Sample received Date:</label>
								<input type="text" class="col-sm-12 form-control" id="sample_rec_date" tabindex="23" name="sample_rec_date" value="" required >
							</div>
							<br>
							<div class="col-md-1">
								<label for="inputEmail3" class="control-label">JOB MODE</label>
							</div>
												
							<div class="col-md-2">
									<input type="radio" name="radio_nabl" value="nabl" class="radio_nabl" checked>
									<label for="inputEmail3" class="control-label">NABL</label>
									
									<!--<input type="radio" name="radio_nabl" value="non_nabl" class="radio_nabl" >
									<label for="inputEmail3" class="control-label">NON-NABL</label>-->
							</div>
							<br>
							<div class="col-md-4" >
								<label>Bill TO:</label>
								<select class="form-control select2 col-sm-12" tabindex="6" id="billing_to" name="billing_to">
									<option value="">Select Billing To</option>
									<?php
									$cat_sql = "select * from agency_master where `isdeleted`=0";

									$cat_result = mysqli_query($conn, $cat_sql);

									while ($cat_row = mysqli_fetch_assoc($cat_result)) {

										?>
														<option value="<?php echo $cat_row['agency_id']; ?>">
														<?php echo str_replace("zxctxavb", "'", $cat_row['agency_name']); ?></option>
													<?php } ?>
								</select>
								<?php //echo $last_refno; ?>
							</div>
									<div class="col-md-2">
										<label>Branch:</label>
										<select class="form-control select2 form-select" tabindex="6" id="sel_branch" name="sel_branch">
											<option value="">Select Branch</option>
											<?php
											$sel_branch = "select * from branches where `is_deleted`=0";
											$query_branch = mysqli_query($conn, $sel_branch);
											if (mysqli_num_rows($query_branch) > 0) {
												while ($row_branch = mysqli_fetch_array($query_branch)) {
													?>
														<option value="<?php echo $row_branch['branch_id'] . '|' . $row_branch['branch_name'] . '|' . $row_branch['branch_short_code']; ?>"><?php echo $row_branch['branch_name']; ?></option>
													<?php
												}
											}
											?>
										</select>
									</div>
									<div class="col-md-12" style="text-align: center;">
											<button type="button" class="btn btn-primary btn-lg btn3d " id="btn_save_client" name="sub_client" tabindex="25" onclick="saveclient('add')" style="margin-top:25px; border-radius: 20px;"> Save Job</button>
											<span id="available_msg" style="color:red;font-size:20px;"></span>
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
									
									
									
									<div class="col-sm-4">
									</div>
								</div>
							
							
						</form>
					</div>
			  <div id = "myDiv" style="display:none"><img id = "myImage" src = "https://cdn-images-1.medium.com/max/1600/0*JVdgKzSfU4q4psf6.gif"></div>
					<!-- /.tab-pane -->

					</div>
				<!-- /.tab-content -->
			</div>
		  <!-- /.nav-tabs-custom -->
		</div>
</section>
</div>
</div>

<!-----error msg div Start-------->
					
<!-----error msg div Stop-------->					
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
		  <!-- /.
modal-dialog -->
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
		  <div class="modal-dialog" style="width:80%">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add New Agency/Contractor/Customer</h4>
			  </div>
				<form id="form_agency" name="form_agency" method="post">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
									<div class="col-md-6">													
											<input type="text" class="form-control" PlaceHolder="Enter Agency/Contractor/Customer Name." name="agency_name" id="add_agency_name" required >
										</div>
										
										<div class="col-md-6">												
											<input type="text" class="form-control"  PlaceHolder="Enter Agency/Contractor/Customer Mobile No." name="add_agency_mobile" id="add_agency_mobile" required >
										</div>
									</div>
												<br>
												<div class="row">
												<div class="col-md-6">													
													<textarea name="add_agency_address" placeholder="Enter Agency/Contractor/Customer Address." id="add_agency_address" class="col-sm-12 form-control"required ></textarea>
												</div>
												
												<div class="col-md-6">												
													<select class="form-control col-sm-12" placeholder="Select City" tabindex="6"   id="add_sel_agency_city" name="sel_agency_city" required >
													<option value="">Select City</option>
													<?php
													$sql = "select * from city";

													$result = mysqli_query($conn, $sql);

													while ($row = mysqli_fetch_assoc($result)) {

														?>
														<option value="<?php echo $row['id']; ?>">
														<?php echo $row['city_name']; ?></option>
													<?php } ?>
													</select>
										
												</div>
												</div>
												<br>
												<div class="row">
												<div class="col-md-6">												
													<input type="text" class="form-control" placeholder="Enter Agency/Contractor/Customer Pincode" name="add_agency_pincode" id="add_agency_pincode" required >
												</div>
												
												<div class="col-md-6">													
													<input type="text" class="form-control" placeholder="Enter Agency/Contractor/Customer EmailId" name="add_agency_email" id="add_agency_email" required >
												</div>
												</div>
												<br>
												<div class="row">
												<div class="col-md-6">													
													<input type="text" class="form-control" placeholder="Enter Agency/Contractor/Customer GST No." name="add_agency_gstno" id="add_agency_gstno" required >
												</div>
									
												<div class="col-md-6">													
													<select class="form-control col-md-7 col-xs-12" name="add_agency_status" id="add_agency_status">
														<option  value="0">Activate</option>
														<option value="1">Deactivate</option>
													<select>			
												</div>
									
												</div>
												<br>
												<div class="row">
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
												<br>
												<div class="row">
												<div class="row">
												<div class="col-md-12">
												<label>ENTER CITY IF NOT AVAILABLE</label>											
												</div>
												</div>
												<div class="col-md-6">	
													<label>SELECT STATE</label>
													<select name="sel_state" id="sel_state" class="form-control">
													<option value="">Select State</option>
													<?php
													$get_state = "SELECT * FROM state where `is_deleted`=0 ORDER BY state_id DESC";
													$get_state_res = mysqli_query($conn, $get_state);
													if (mysqli_num_rows($get_state_res) > 0) {
														while ($r = mysqli_fetch_array($get_state_res)) { ?>
																	<option value="<?php echo $r["state_id"] ?>"><?php echo $r['state_name']; ?></option>
														<?php
														}
													}
													?>
													</select>
												</div>
												<div class="col-md-6">	
													<label>ENTER CITY</label>
													<input type="text" class="form-control" placeholder="Enter City Name." name="txt_city_name" id="txt_city_name">
												</div>
									
												
												</div>
												
								
											</div>
					</div>
					<div class="modal-footer">	
					
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
						<td colspan="4" style="text-align:center;font-size:20px;">REVIEW REMARKS</td>
					</tr>
					
					<tr>
						<td colspan="2">1. Method of testing, capability and resources acceptable</td>
						<td><input type="radio" name="radio_1" value="yes" checked>YES</td>
						<td><input type="radio" name="radio_1" value="no" >NO</td>
					</tr>
					
					<tr>
						<td colspan="2">2. Testing services requested may please be carried out.</td>
						<td><input type="radio" name="radio_2" value="yes" checked>YES</td>
						<td><input type="radio" name="radio_2" value="no" >NO</td>
					</tr>
					
					<tr>
						<td colspan="2">3. Terms and Conditions of Testing acceptable as per review remarks.</td>
						<td><input type="radio" name="radio_3" value="yes" checked>YES</td>
						<td><input type="radio" name="radio_3" value="no" >NO</td>
					</tr>
					
					
					<tr>
						<td colspan="2">4. Statement of Conformity Required/Not Required by the Customer</td>
						<td><input type="radio" name="radio_4" value="yes">YES</td>
						<td><input type="radio" name="radio_4" value="no" checked>NO</td>
						
						<input type="radio" name="radio_5" value="no" style="visibility: hidden" checked>
																										 
						<input type="radio" name="radio_6" value="no"style="visibility: hidden" checked>
																										 
						<input type="radio" name="radio_7" value="no"style="visibility: hidden" checked>
					</tr>
					
						
					
					
					
					
					<tr>
						<td colspan="4" style="text-align:center;font-size:20px;">REQUIREMENT REVIEW</td>
					</tr>
					
					<tr>
						<td colspan="2">1. Requirements defined and understood.</td>
						<td><input type="radio" name="radio_8" value="yes" checked>YES</td>
						<td><input type="radio" name="radio_8" value="no" >NO</td>
					</tr>
					
					<tr>
						<td colspan="2">2. Capability and Resources available</td>
						<td><input type="radio" name="radio_9" value="yes" checked>YES</td>
						<td><input type="radio" name="radio_9" value="no" >NO</td>
					</tr>
					
					<tr>
						<td colspan="2">3. Condition of Sample Received </td>
						<td colspan="2"><input type="radio" name="acceptable" value="OK">Ok
						<input type="radio" name="acceptable" value="Sealed" checked>Sealed
						<input type="radio" name="acceptable" value="Open" >Open</td>
						<input type="radio" name="applicable" style="visibility: hidden" value="no" checked>
						<input type="radio" name="radio_10" value="no" style="visibility: hidden" checked>
						<input type="radio" name="deviation" style="visibility: hidden" value="yes" checked>
						<input type="radio" name="radio_11" style="visibility: hidden" value="na" checked>
					</tr>
					
					
					
					<tr>
						<td colspan="4" style="text-align:center;">
							<a href="#" class="close btn btn-primary" data-dismiss="modal" style="font-size:18px;opacity:1;border:1px solid black;color:#fff;font-weight: 300;">SAVE</a>
						</td>
					</tr>
				</table>
				<br>
			</div>
		</div>
	</div>
</div>		
<?php include("footer.php"); ?>
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
	if (type == 'add' || type == 'add_and_next') {		
				var client_code = $('#client_code').val(); 
				var tester = $('#tester').val(); 
				
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
				
				//var name_of_work = $('#editor1').val();
				var name_of_work = CKEDITOR.instances.editor1.getData();
				//var name_of_work = $('[name="editor1"]').val();
				var agreement_no = $('#agreement_no').val();
				var ref_no = $('#ref_no').val();
				var trf_ref = $('#trf_ref').val();
				var date = $('#date').val();
				//var sw_date = $('#sw_date').val();
				var sw_date = $('#sample_rec_date').val();
				//var report_no = $('#report_no').val();
				var sel_sent_by = $('#sel_sent_by').val();
				var sel_report_to = $('#sel_report_to').val();
				var sample_rec_date = $('#sample_rec_date').val();
				var person_name = $('#person_name').val();
				var person_auth_mobile = $('#person_auth_mobile').val();
				var radio_nabl=$( 'input[name=radio_nabl]:checked' ).val();
				var tpi_or_auth=$("#tpi_or_auth").val();
				var pmc_heading=$("#pmc_heading").val();
				var billing_to=$("#billing_to").val();
				var sel_branch=$("#sel_branch").val();
				
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
				
			
				billData = '&action_type='+type+'&client_code='+client_code+'&client_name='+client_name+'&address='+address+'&phone='+phone+'&email='+email+'&pincode='+pincode+'&sel_city='+sel_city+'&customer_gst_no='+customer_gst_no+'&select_agency='+select_agency+'&agency_address='+agency_address+'&agency_mobile='+agency_mobile+'&sel_city_of_agency='+sel_city_of_agency+'&agency_pincode='+agency_pincode+'&agency_email='+agency_email+'&agency_gst='+agency_gst+'&name_of_work='+name_of_work+'&ref_no='+ref_no+'&trf_ref='+trf_ref+'&date='+date+'&sel_sent_by='+sel_sent_by+'&sel_report_to='+sel_report_to+'&sample_rec_date='+sample_rec_date+'&person_name='+person_name+'&person_auth_mobile='+person_auth_mobile+'&agreement_no='+agreement_no+'&tpi_code='+tpi_code+'&tpi_name='+tpi_name+'&tpi_phone='+tpi_phone+'&tpi_email='+tpi_email+'&tpi_address='+tpi_address+'&pmc_code='+pmc_code+'&pmc_name='+pmc_name+'&pmc_phone='+pmc_phone+'&pmc_email='+pmc_email+'&pmc_address='+pmc_address;
				
	
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
	if(sel_sent_by ==""){
		error_msg +="Sample Sent By Required"+"<br>";
	}
	if(sel_report_to ==""){
		error_msg +="Report Sent To Required"+"<br>";
	}
	
	if(name_of_work ==""){
		error_msg +="Name Of Work Required"+"<br>";
	}
	
	if(person_name ==""){
		error_msg +="Enter Person Name"+"<br>";
	}
	
	if(person_auth_mobile ==""){
		error_msg +="Enter Person Mobile No"+"<br>";
	}
	
	if(person_auth_mobile.length != 10){
		error_msg +="Enter Person Mobile No Properly"+"<br>";
	}
	if(customer_gst_no.length < 13 || customer_gst_no.length > 15){
		//error_msg +="Customer Gst Not Proper"+"<br>";
	}
	if(radio_nabl ==""){
		error_msg +="select nabl Type"+"<br>";
	}
	if(billing_to ==""){
		error_msg +="select Bill To"+"<br>";
	}
	if(sel_branch ==""){
		error_msg +="select Branch"+"<br>";
	}
	if(sw_date ==""){
		error_msg +="Please Select Received Sample Dte"+"<br>";
	}
	var xyz = $('#upload_img').val();
	if(xyz ==""){
	//	error_msg +="Please Upload Letter"+"<br>";
	}
	
	
	if(person_name !== ""&& person_auth_mobile !== ""&& name_of_work !== ""&& radio_nabl !== "" && error_msg=="")
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
		form_data.append("trf_ref", trf_ref);
		form_data.append("date", date);
		form_data.append("sw_date", sw_date);
		//form_data.append("report_no", report_no);
		form_data.append("sel_sent_by", sel_sent_by);
		form_data.append("sel_report_to", sel_report_to);
		form_data.append("sample_rec_date", sample_rec_date);
		form_data.append("person_name", person_name);
		form_data.append("agreement_no", agreement_no);
		form_data.append("person_auth_mobile", person_auth_mobile);
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
		form_data.append("sel_branch", sel_branch);
		
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
			if(data.statuses=='1'){
			alert("Job Is Successfully Saved");
			window.location.href="<?php $base_url; ?>job_listing_for_second_reception.php";
			}else{
				alert("Please Login By Reception First..");
			window.location.href="<?php $base_url; ?>index.php";
			}
			
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
	if(txt_new_city ==""){
		alert("Please Enter City Name...!");
		return false;
	}
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
 let str = $('#add_agency_name').val();
let newStr = str.replace(/'/g,'zxctxavb');
let newStr1 = newStr.replace(/&/g,'qwerfdsa');
var agency_mobile = $('#add_agency_mobile').val(); 
 var agency_address = $('#add_agency_address').val(); 
 var sel_agency_city = $('#add_sel_agency_city').val(); 
 var agency_pincode = $('#add_agency_pincode').val(); 
 var agency_email = $('#add_agency_email').val(); 
 var agency_gstno = $('#add_agency_gstno').val(); 
 var agency_status = $('#add_agency_status').val(); 
 var add_perfoma_make_by = $('#add_perfoma_make_by').val(); 
 var add_rate = $('#add_rate').val(); 
 var sel_state = $('#sel_state').val();
 var txt_city_name = $('#txt_city_name').val();

if(agency_name == ""){
	alert("Enter Name...");
	return false;
	} 
if(agency_mobile == ""){
	alert("Enter Mobile No...");
	return false;
	}
if(agency_mobile != "" && agency_mobile.length != 10){
	alert("Enter Mobile No Properly...");
	return false;
	}
if(agency_address == ""){
	alert("Enter Address...");
	return false;
	}
if(agency_gstno != "" && agency_gstno.length != 15){
	alert("Enter Gst No Properly...");
	return false;
	} 
 
	
	

 
 var postData = '&agency_name='+newStr1+'&agency_mobile='+agency_mobile+'&agency_address='+agency_address+'&sel_agency_city='+sel_agency_city+'&agency_pincode='+agency_pincode+'&agency_email='+agency_email+'&agency_gstno='+agency_gstno+'&agency_status='+agency_status+'&txt_city_name='+txt_city_name+'&sel_state='+sel_state+'&add_perfoma_make_by='+add_perfoma_make_by+'&add_rate='+add_rate;
	
	if(newStr1!=""){
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

function set_agency_again(){
	
}

$("#btn_add_client").click(function(){
 var add_client_name = $('#add_client_name').val(); 
 let newStr = add_client_name.replace(/'/g,'zxctxavb');
let newStr1 = newStr.replace(/&/g,'qwerfdsa');
 var add_client_mobile = $('#add_client_mobile').val(); 
 var add_client_email = $('#add_client_email').val(); 
 var add_client_gst = $('#add_client_gst').val(); 
 var add_client_address = $('#add_client_address').val();  
 var postData = '&add_client_name='+newStr1+'&add_client_mobile='+add_client_mobile+'&add_client_email='+add_client_email+'&add_client_gst='+add_client_gst+'&add_client_address='+add_client_address;
 
 if(add_client_name == ""){
	alert("Enter Name...");
	return false;
	} 
if(add_client_mobile == ""){
	alert("Enter Mobile No...");
	return false;
	}
if(add_client_mobile != "" && add_client_mobile.length != 10){
	alert("Enter Mobile No Properly...");
	return false;
	}

if(add_client_gst != "" && add_client_gst.length != 15){
	alert("Enter Gst No Properly...");
	return false;
	} 
	
	if(newStr1!=""){
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
 let newStr = add_tpi_name.replace(/'/g,'zxctxavb');
let newStr1 = newStr.replace(/&/g,'qwerfdsa');
 var add_tpi_mobile = $('#add_tpi_mobile').val(); 
 var add_tpi_email = $('#add_tpi_email').val();  
 var postData = '&add_tpi_name='+newStr1+'&add_tpi_mobile='+add_tpi_mobile+'&add_tpi_email='+add_tpi_email;
	
	if(newStr1!=""){
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
 let newStr = add_pmc_name.replace(/'/g,'zxctxavb');
let newStr1 = newStr.replace(/&/g,'qwerfdsa');
 var add_pmc_mobile = $('#add_pmc_mobile').val(); 
 var add_pmc_email = $('#add_pmc_email').val();  
 var postData = '&add_pmc_name='+newStr1+'&add_pmc_mobile='+add_pmc_mobile+'&add_pmc_email='+add_pmc_email;
	
	if(newStr1!=""){
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
				 // $('#sel_city').val(data.client_city).prop('selected', true);
				  $('#sel_category').val(data.category).prop('selected', true);
				   $('#person').val(data.person);
				  $('#person_mobile').val(data.pmobile);
				 
				  
				 
				  
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
				  //$('#sel_city').val(data.client_city).prop('selected', true);
				  //$('#pincode').val(data.pincode);
				  $('#customer_gst_no').val(data.gst_no);
				  
			}

		}); 
	});


// get exist client by enter client code
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
						//$('#billing_to').attr("disabled", false);
						if(data.billing_to_id != 0)
						{
							$("#billing_to").val(data.billing_to_id).change();
						}
					}else{
						//$('#billing_to').attr("disabled", true); 
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
						//$('#billing_to').attr("disabled", false);
						if(data.billing_to_id != 0)
						{
							$("#billing_to").val(data.billing_to_id).change();
						}
					}else{
						//$('#billing_to').attr("disabled", true); 
					}
				}
			}

		}); 
	});



	
$('#date').datepicker({
	  autoclose: true,
	  format: 'dd/mm/yyyy'
	})

var starting_date='<?php echo $starting_date; ?>';

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
	
}
$('#sw_date').datepicker({
	  autoclose: true,
	  format: 'dd/mm/yyyy',
	}).on("change", function() {
		
			
			var date_input = document.getElementById("sw_date").value.split('/');						
			var date = new Date(date_input[2], date_input[1]- 1, date_input[0]);					
			var newdate = new Date(date.getFullYear(), date.getMonth(), date.getDate());
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			if(mm <= 9)
			mm = '0'+mm;
			if(dd <= 9)
			dd = '0'+dd;
			var someFormattedDate = dd + '/' + mm + '/' + y;				
			document.getElementById('sample_rec_date').value = someFormattedDate;		
			/*$('#sample_rec_date').datepicker({
			  autoclose: true,
			  format: 'dd/mm/yyyy',
			  startDate: "'"+someFormattedDate+"'"
			});	*/
			
		});
		
		var d_one = new Date();
var curr_date1 = d_one.getDate();
var curr_month1 = d_one.getMonth() + 1; //Months are zero based
var curr_year1 = d_one.getFullYear();
var ended_date=(curr_date1 + "/" + curr_month1 + "/" + curr_year1);

 $('#sample_rec_date').datepicker({
	  autoclose: true,
	  format: 'dd/mm/yyyy',
	  endDate: "'"+ended_date+"'"
	}); 



// On customer_gst_no entering	
$("#customer_gst_no").on("keyup",function(){
	
	var customer_gst_no= $('#customer_gst_no').val();
	customer_gst_no_lngth=customer_gst_no.length;
	if(customer_gst_no_lngth < 13 || customer_gst_no_lngth > 15){
	$('#customer_gst_no').css('border-color', 'red');		
	}else{
	$('#customer_gst_no').css('border-color', '');		
	}
	
});

$("#ref_no").on("change",function(){
	
	var ref_no= $('#ref_no').val();
	if(ref_no !=""){
		$('#date').prop("disabled", false);
	}else{
		$('#date').prop("disabled", true);
	}
	
});



//on software date changes
/*$(document).on("change","#sw_date",function(){
	var get_sw_dates= $('#sw_date').val();
	alert(get_sw_dates);
	var arr1 = get_sw_dates.split('/');
	var dt = arr1[0];
	var m = arr1[1];
	var yr = arr1[2];
	var sd = yr+"-"+m+"-"+dt;
	var d1 = new Date(sd);
	
var curr_date1 = d1.getDate();
var curr_month1 = d1.getMonth() + 1; //Months are zero based
var curr_year1 = d1.getFullYear();
var started_date1=(curr_date1 + "/" + curr_month1 + "/" + curr_year1);
	$('#sample_rec_date').datepicker({
	  autoclose: true,
	  format: 'dd/mm/yyyy',
	  startDate: "'"+started_date1+"'"
	});
	
	
});*/
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
