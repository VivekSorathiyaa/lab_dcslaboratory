
<?php 
session_start(); 
include("header.php");
include("sidebar.php");
include("connection.php");
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

	$get_client_code=$get_one_job["client_code"];
	$get_clientname=$get_one_job["clientname"];
	$get_clientaddress=$get_one_job["clientaddress"];
	$get_clientphone=$get_one_job["clientphone"];
	$get_email=$get_one_job["email"];
	$get_client_pincode=$get_one_job["client_pincode"];
	$get_client_city=$get_one_job["client_city"];
	$get_client_gstno=$get_one_job["client_gstno"];
	$get_agency=$get_one_job["	agency"];
	$get_agency_address=$get_one_job["agency_address"];
	$get_agency_mobile=$get_one_job["agency_mobile"];
	$get_agency_city=$get_one_job["agency_city"];
	$get_agency_pincode=$get_one_job["agency_pincode"];
	$get_agency_email=$get_one_job["agency_email"];
	$get_agency_gstno=$get_one_job["agency_gstno"];
	$get_nameofwork=$get_one_job["nameofwork"];
	$get_refno=$get_one_job["refno"];
	$get_date=$get_one_job["date"];
	$get_sample_sent_by=$get_one_job["sample_sent_by"];
	$get_sample_rec_date=$get_one_job["sample_rec_date"];
	$get_condition_of_sample_receved=$get_one_job["condition_of_sample_receved"];
	$final_report_no=$get_one_job["report_no"];
	

?>

<?php

		if(isset($_POST["btn_save_job"]))
		{
			?>
			 <script>
			 alert("Successfully Inserted");
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

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		
		<h1>
		Client Form
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="active tab-pane" id="clients">
					<form class="" method="post" >
					
					    <div class="row">
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Client Code:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="exist_client" tabindex="8" name="exist_client">
									</div>
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">OR</label>
									</div>
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Client:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control select2 col-sm-12" tabindex="6"  data-placeholder="Select a Client" id="sel_client" name="sel_client"  >
											<option value="">Select Client</option>
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
					<br>
					<div class="row">
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label"></label>
									</div>
									<div class="col-md-2">
										
									</div>
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">OR</label>
									</div>
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label"></label>
									</div>
									<div class="col-md-2">
										
									</div>
					</div>
						<br>	
							<div class="row">
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Client Code:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="client_code" tabindex="8" name="client_code" value="<?php echo $get_client_code;?>" required readonly> 
									</div>
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Client Name:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="client_name" tabindex="8" name="client_name" required value="<?php echo $get_clientname;?>">
									</div>
									
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Address:</label>
									</div>
									<div class="col-md-3">
										<textarea id="address" name="address" class="col-sm-12 form-control"required ><?php echo $get_clientaddress;?></textarea>
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-2">
											<label for="inputEmail3" class="control-label">Phone:</label>
									</div>
									<div class="col-md-2">
											<input type="text" class="col-sm-12 form-control" id="phone" tabindex="8" name="phone" required value="<?php echo $get_clientphone;?>">
									</div>
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Email:</label>
									</div>
									<div class="col-md-2">
										<input type="email" class="col-sm-12 form-control" id="email" tabindex="8" name="email" required value="<?php echo $get_email;?>">
									</div>
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Pincode:</label>
									</div>
									<div class="col-md-2">
										<input type="email" class="col-sm-12 form-control" id="pincode" tabindex="8" name="pincode" required value="<?php echo $get_client_pincode;?>">
									</div>
									
								</div>
								<br>
								
								<div class="row">
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">City:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control col-sm-12 select2" tabindex="6"   id="sel_city" name="sel_city" required >
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
									<div class="col-md-1">
									<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-city">
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Gst No:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="customer_gst_no" tabindex="8" name="customer_gst_no" required>
									</div>
									
									<!--<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Category:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control  col-sm-12 select2" tabindex="6"  data-placeholder="Select a category" id="sel_category" name="sel_category" required >
											<option value="">Select category</option>
											<?php 
												$cat_sql = "select * from category";
											
												$cat_result = mysqli_query($conn, $cat_sql);

													while($cat_row = mysqli_fetch_assoc($cat_result)) {
												
												?>
												<option value="<?php //echo $cat_row['id']; ?>">
												<?php //echo $cat_row['catname']; ?></option>
												<?php  }?>
										</select>
									</div>-->
									
								</div>
								<hr style="border: 1px solid #ddd;">
								<br>
								<!--<div class="row">
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Contact Person:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="person" tabindex="8" name="person" required>
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Person Mobile:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="person_mobile" tabindex="8" name="person_mobile" required>
									</div>
									
									
								</div>-->
								<div class="row">
							
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Agency:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control  col-sm-12 select2" tabindex="6"  data-placeholder="Select a Agency" id="select_agency" name="select_agency" required >
											<option value="">Select Agency</option>
											<?php 
												$cat_sql = "select * from agency";
											
												$cat_result = mysqli_query($conn, $cat_sql);

													while($cat_row = mysqli_fetch_assoc($cat_result)) {
												
												?>
												<option value="<?php echo $cat_row['agency_name']; ?>">
												<?php echo $cat_row['agency_name']; ?></option>
												<?php  }?>
										</select>
									</div>
									<div class="col-md-1">
										<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-agency">
										
									</div>
							
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Address:</label>
									</div>
									<div class="col-md-3">
										<textarea id="agency_address" name="agency_address" class="col-sm-12 form-control"required ></textarea>
									</div>
								
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Mobile:</label>
									</div>
									<div class="col-md-3">
										<input type="text" class="col-sm-12 form-control" id="agency_mobile" tabindex="8" name="agency_mobile" required>
									</div>
								</div>
								<br>
								<div class="row">
								<div class="col-md-1">
										<label for="inputEmail3" class="control-label">City:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control col-sm-12 select2" tabindex="6"   id="sel_city_of_agency" name="sel_city_of_agency" required >
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
									<div class="col-md-1">
									<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-city">
									</div>
									
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Pincode:</label>
									</div>
									<div class="col-md-3">
										<input type="text" class="col-sm-12 form-control" id="agency_pincode" tabindex="8" name="agency_pincode" required>
									</div>
									
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Email:</label>
									</div>
									<div class="col-md-3">
										<input type="text" class="col-sm-12 form-control" id="agency_email" tabindex="8" name="agency_email" required>
									</div>
								</div>
								<br>
							<div class="row">
							
								<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Gst No:</label>
								</div>
								<div class="col-md-3">
									<input type="text" class="col-sm-12 form-control" id="agency_gst" tabindex="8" name="agency_gst" required>
								</div>
								
								<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Name Of Work:</label>
									</div>
									<div class="col-md-7">
										<textarea id="editor1" name="editor1" class="col-sm-12 form-control"required ></textarea>
									</div>
							
							</div>
							<hr style="border: 1px solid #ddd;">
							<br>
							
							<div class="row">
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Ref No:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="ref_no" tabindex="8" name="ref_no" value="" required > 
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Date:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="date" tabindex="8" name="date" value="<?php echo date('d/m/Y')?>" required > 
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Report No:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="report_no" tabindex="8" name="report_no" value="<?php echo $final_report_no; ?>" required readonly> 
									</div>
									
								</div>
								<br>
							<div class="row">
							
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label"> Sample Sent By:</label>
									</div>
									<div class="col-md-3">
										<select class="form-control col-sm-12 select2" tabindex="6"  data-placeholder="Select a By" id="sel_sent_by" name="sel_sent_by" required >
											<option value="">Select Sent By</option>
											<option value="0">Customer</option>
											<option value="1">Agency</option>
												
										</select>
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Sample received Date:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="sample_rec_date" tabindex="8" name="sample_rec_date" value="<?php echo date('d/m/Y')?>" required > 
									</div>
									
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label"> Condition of Sample Received:</label>
									</div>
									<div class="col-md-3">
										<select class="form-control col-sm-12 select2" tabindex="6"  data-placeholder="Select a By" id="sel_by_condition" name="sel_by_condition" required >
											<option value="">Select Condition</option>
											<option value="0">Sealed</option>
											<option value="1">Unsealed</option>
												
										</select>
									</div>
							</div>
							<div class="row">
									<div class="col-sm-4">
									</div>
									
									<div class="col-sm-4">
											<button type="button" class="btn btn-info " id="btn_save_client" name="sub_client" tabindex="14" onclick="saveclient('add')">Save Client</button>
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
							<label for="inputEmail3" class="col-sm-2 control-label">Add Agency:</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Enter New Agency" id="txt_new_agency" name="txt_new_agency" class="form-control">											
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
	
	});

// client save
function saveclient(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add') {		
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
				var sample_rec_date = $('#sample_rec_date').val();
				var sel_by_condition = $('#sel_by_condition').val();
				
				
			
				billData = '&action_type='+type+'&client_code='+client_code+'&client_name='+client_name+'&address='+address+'&phone='+phone+'&email='+email+'&pincode='+pincode+'&sel_city='+sel_city+'&customer_gst_no='+customer_gst_no+'&select_agency='+select_agency+'&agency_address='+agency_address+'&agency_mobile='+agency_mobile+'&sel_city_of_agency='+sel_city_of_agency+'&agency_pincode='+agency_pincode+'&agency_email='+agency_email+'&agency_gst='+agency_gst+'&name_of_work='+name_of_work+'&ref_no='+ref_no+'&date='+date+'&report_no='+report_no+'&sel_sent_by='+sel_sent_by+'&sample_rec_date='+sample_rec_date+'&sel_by_condition='+sel_by_condition;
	
	}
	else{
			
	
				billData = 'action_type='+type+'&id='+id;
    }
	
	if(client_code !== ""&& client_name !== ""&& address !== ""&& phone !== ""&& email !== ""&& pincode !== ""&& sel_city !== ""&& customer_gst_no !== ""&& select_agency !== ""&& agency_address !== "" && agency_mobile !== ""&& sel_city_of_agency !== ""&& agency_pincode !== ""&& agency_email !== ""&& agency_gst !== ""&& ref_no !== ""&& report_no !== ""&& sel_sent_by !== ""&& sel_by_condition !== ""&& name_of_work !== "")
	{
		
    $.ajax({
        url : "<?php $base_url; ?>savetest_master.php",
		type: "POST",
		dataType:'JSON',
		data : billData,
        success:function(data){
			window.location.href="<?php $base_url; ?>job_listing.php";
			
        }
    });
  }else{
	  alert("AllFields Required..");
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
 var txt_new_agency = $('#txt_new_agency').val(); 
 var postData = '&txt_new_agency='+txt_new_agency;
 
	  $.ajax({
		url : "<?php $base_url; ?>agency_Data.php",
		type: "POST",
		data : postData,
		success: function(data,status,  xhr)
		 {
		
			$("#select_agency").html(data);
		   $('#txt_new_agency').val("");
		 }

	}); 

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
