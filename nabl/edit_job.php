
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

$job_id= base64_decode($_GET["job_id"]);
$sel_jobs="SELECT * FROM job where job_id=".$job_id;
$get_jobs = mysqli_query($conn, $sel_jobs);

if (mysqli_num_rows($get_jobs) > 0) {
	$r = mysqli_fetch_array($get_jobs);
	
	$get_client_code=$r["client_code"];
	$get_category=$r["category"];
	$get_clientname=$r["clientname"];
	$get_alias=$r["alias"];
	$get_clientphone=$r["clientphone"];
	$get_email=$r["email"];
	$get_clientaddress=$r["clientaddress"];
	$get_client_city=$r["client_city"];
	$get_discount=$r["discount"];
	$get_person=$r["person"];
	$get_pmobile=$r["pmobile"];
	$get_accountant=$r["accountant"];
	$get_amobile=$r["amobile"];
	$get_manager=$r["manager"];
	$get_mmobile=$r["mmobile"];
	$get_authority=$r["authority"];
	$get_authaddress=$r["authaddress"];
	$get_authcity=$r["authcity"];
	$get_invoicetoauth=$r["invoicetoauth"];
	$get_jobno=$r["jobno"];
	$get_date=$r["date"];
	$get_refno=$r["refno"];
	$get_materialrate=$r["materialrate"];
	$get_refdate=$r["refdate"];
	$get_agency=$r["agency"];
	$get_consultant=$r["consultant"];
	$get_samplebroughtby=$r["samplebroughtby"];
	$get_nameofwork=strip_tags(html_entity_decode($r['nameofwork']),"<strong><em><br>");
	$get_remark=strip_tags(html_entity_decode($r['remark']),"<strong><em><br>");
	$get_edit_job_id=$r["job_id"];
	
}

?>

<?php

		if(isset($_POST["btn_edit_job"]))
		{
				
					$date_day=substr($_POST['date'],0,2);
					$date_month=substr($_POST['date'],3,2);
					$date_year=substr($_POST['date'],6,4);
					$new_date = $date_year."-".$date_month."-".$date_day;
					
					$ref_day=substr($_POST['ref_date'],0,2);
					$ref_month=substr($_POST['ref_date'],3,2);
					$ref_year=substr($_POST['ref_date'],6,4);
					$new_ref_date = $ref_year."-".$ref_month."-".$ref_day;
			
			$job_no=$_POST["job_no"];
			$client_code=$_POST["job_client_code"];
			$job_category=$_POST["sel_category_job"];
			$job_client_name=$_POST["job_client_name"];
			$job_alias=$_POST["job_alias"];
			$job_phone=$_POST["job_phone"];
			$job_email=$_POST["job_email"];
			$job_address=$_POST["job_address"];
			$sel_city_job=$_POST["sel_city_job"];
			$job_discount=$_POST["job_discount"];
			$job_person=$_POST["job_person"];
			$job_person_mobile=$_POST["job_person_mobile"];
			$job_accountant=$_POST["job_accountant"];
			$job_acc_mobile=$_POST["job_acc_mobile"];
			$job_manager=$_POST["job_manager"];
			$job_manager_mobile=$_POST["job_manager_mobile"];
			
			$sel_authority=$_POST["sel_authority"];
			$sel_auth_city=$_POST["sel_auth_city"];
			$auth_address=$_POST["auth_address"];
			
			if(isset($_POST["invo_to_auth"]))
			{
				$invoce_to= $_POST["invo_to_auth"];
			}
			else
			{
				$invoce_to=0;
			}
			
			$ref_no=$_POST["ref_no"];
			$sel_mat_rate=$_POST["sel_mat_rate"];
			$select_agency=$_POST["select_agency"];
			$sel_brought_by=$_POST["sel_brought_by"];
			$consultant=$_POST["consultant"];
			$nameofwork=$_POST["editor1"];
			$remarks=$_POST["editor2"];
			$curr_date=date("Y-m-d");
			$edit_job_id=$_POST["edit_job_id"];
			
		
		
			$update_job="update job set `client_code`='$client_code',`category`='$job_category',`clientname`='$job_client_name',`alias`='$job_alias',`client_city`='$sel_city_job',`clientphone`='$job_phone',`email`='$job_email',`clientaddress`='$job_address',`discount`='$job_discount',`person`='$job_person',`pmobile`='$job_person_mobile',`accountant`='$job_accountant',`amobile`='$job_acc_mobile',`manager`='$job_manager',`mmobile`='$job_manager_mobile',`authority`='$sel_authority',`authaddress`='$auth_address',`authcity`='$sel_auth_city',`invoicetoauth`='$invoce_to',`jobno`='$job_no',`date`='$new_date',`refno`='$ref_no',`materialrate`='$sel_mat_rate',`refdate`='$new_ref_date',`agency`='$select_agency',`consultant`='$consultant',`samplebroughtby`='$sel_brought_by',`nameofwork`='$nameofwork',`remark`='$remarks',`jobcreatedby`='$_SESSION[name]',`jobcreateddate`='$curr_date',`jobmodifiedby`='$_SESSION[name]',`jobmodifieddate`='$curr_date',`jobisstatus`='0',`jobisdeleted`='0' where job_id=".$edit_job_id;
		
			
			mysqli_query($conn,$update_job);
			
			?>
					<script>alert("Job Updated Successfully");</script>
				<script>window.location.href="<?php echo $base_url; ?>job_listing.php";</script>
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
				
				<div class="tab-conten">
			  
					<div class="tab-pane" id="job_tab">
						<form class="" method="post" name="frm_job">
							<div class="row">
								<div class="col-md-12">
								<label for="inputEmail3" class="control-label">Client Detail </label>
								</div>
							</div>
							<hr style="border: 1px solid #ddd;">
							<div class="row">
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Client Code:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_client_code" tabindex="8" name="job_client_code" value="<?php echo $get_client_code;?>" required > 
									</div>
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Client Name:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_client_name" tabindex="8" name="job_client_name" value="<?php echo $get_clientname;?>" required>
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Alias:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_alias" tabindex="8" name="job_alias" value="<?php echo $get_alias;?>" required>
									</div>
									
								</div>
								<br>
								<div class="row">
									<div class="col-md-2">
											<label for="inputEmail3" class="control-label">Phone:</label>
									</div>
									<div class="col-md-2">
											<input type="text" class="col-sm-12 form-control" id="job_phone" tabindex="8" name="job_phone"  value="<?php echo $get_clientphone;?>" required>
									</div>
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Email:</label>
									</div>
									<div class="col-md-2">
										<input type="email" class="col-sm-12 form-control" id="job_email" tabindex="8" name="job_email" value="<?php echo $get_email;?>" required>
									</div>
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Address:</label>
									</div>
									<div class="col-md-3">
										<textarea id="job_address" name="job_address" class="col-sm-12 form-control"required >
										<?php echo $get_clientaddress;?>
										</textarea>
									</div>
								</div>
								<br>
								
								<div class="row">
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">City:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control col-sm-12" tabindex="6"  data-placeholder="Select a category" id="sel_city_job" name="sel_city_job" required >
											<option value="">Select City</option>
											<?php 
												$sql = "select * from city";
											
												$result = mysqli_query($conn, $sql);

													while($row = mysqli_fetch_assoc($result)) {
												
												?>
												<option value="<?php echo $row['id']; ?>" <?php if($row['id']==$get_client_city){ echo "selected";}?>>
												<?php echo $row['city_name']; ?></option>
												<?php  }?>
										</select>
										
									</div>
									<div class="col-md-1">
									<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-city">
									</div>
									
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Category:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control  col-sm-12" tabindex="6"  data-placeholder="Select a category" id="sel_category_job" name="sel_category_job" required >
											<option value="">Select category</option>
											<?php 
												$cat_sql = "select * from category";
											
												$cat_result = mysqli_query($conn, $cat_sql);

													while($cat_row = mysqli_fetch_assoc($cat_result)) {
												
												?>
												<option value="<?php echo $cat_row['id']; ?>" <?php if($cat_row['id']==$get_category){ echo "selected";}?>>
												<?php echo $cat_row['catname']; ?></option>
												<?php  }?>
										</select>
									</div>
									<div class="col-md-1">
										<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-category">
										
									</div>
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Discount:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_discount" tabindex="8" name="job_discount" value="<?php echo $get_discount; ?>" required>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Contact Person:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_person" tabindex="8" name="job_person" value="<?php echo $get_person;?>" required>
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Person Mobile:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_person_mobile" tabindex="8" name="job_person_mobile" value="<?php echo $get_pmobile;?>" required>
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Accountant:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_accountant" tabindex="8" name="job_accountant" value="<?php echo $get_accountant;?>" required>
									</div>
								</div>
								<br>
								
								<div class="row">
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Accountant mobile:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_acc_mobile" tabindex="8" name="job_acc_mobile" value="<?php echo $get_amobile;?>" required>
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Manager :</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_manager" tabindex="8" name="job_manager" value="<?php echo $get_manager;?>" required>
									</div>
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">manager Mobile:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_manager_mobile" tabindex="8" name="job_manager_mobile" value="<?php echo $get_mmobile;?>" required>
									</div>
								</div><br><br>
								
								<div class="row">
								<div class="col-md-12">
								<label for="inputEmail3" class="control-label">Name Of Report </label>
								</div>
							</div>
								<hr style="border: 1px solid #ddd;">
								
							<div class="row">
							
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Authority:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control  col-sm-12" tabindex="6"  data-placeholder="Select a Authority" id="sel_authority" name="sel_authority" required >
											<option value="">Select Authority</option>
											<?php 
												$cat_sql = "select * from authority";
											
												$cat_result = mysqli_query($conn, $cat_sql);

													while($cat_row = mysqli_fetch_assoc($cat_result)) {
												
												?>
												<option value="<?php echo $cat_row['id']; ?>" <?php if($cat_row['id']==$get_authority){ echo "selected";}?>>
												<?php echo $cat_row['auth_name']; ?></option>
												<?php  }?>
										</select>
									</div>
									<div class="col-md-1">
										<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-auth">
										
									</div>
							
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label"> Auth City:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control col-sm-12" tabindex="6"  data-placeholder="Select a City" id="sel_auth_city" name="sel_auth_city" required >
											<option value="">Select City</option>
											<?php 
												$sql = "select * from city";
											
												$result = mysqli_query($conn, $sql);

													while($row = mysqli_fetch_assoc($result)) {
												
												?>
												<option value="<?php echo $row['id']; ?>" <?php if($row['id']==$get_authcity){ echo "selected";}?>>
												<?php echo $row['city_name']; ?></option>
												<?php  }?>
										</select>
										
									</div>
									<div class="col-md-1">
									<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-authcity">
									</div>
									
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Auth Address:</label>
									</div>
									<div class="col-md-3">
										<textarea id="auth_address" name="auth_address" class="col-sm-12 form-control"required >
										<?php echo $get_authaddress;?>
										</textarea>
									</div>
								</div>
								
								<br>
								<div class="row">
								<div class="col-md-6">
								<label for="inputEmail3" class="control-label">
                                <input type="checkbox" name="invo_to_auth" id="invo_to_auth" class="" value="1" <?php if($get_invoicetoauth==1){ echo "checked";}?>>
								Invoice To Authority</label>
								</div>
								</div>
								
								<br>
								<div class="row">
								<div class="col-md-12">
								<label for="inputEmail3" class="control-label">Job Detail </label>
								</div>
								</div>
								
								<hr style="border: 1px solid #ddd;">
								<div class="row">
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Job No:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="job_no" tabindex="8" name="job_no" value="<?php echo $get_jobno;?>" required > 
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Date:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="date" tabindex="8" name="date" value="<?php echo date('d/m/Y', strtotime($get_date));?>" required > 
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Ref Date:</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="col-sm-12 form-control" id="ref_date" tabindex="8" name="ref_date" value="<?php echo date('d/m/Y', strtotime($get_refdate));?>" required > 
									</div>
								</div>
								<br>
								
								<div class="row">
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Ref No:</label>
									</div>
									<div class="col-md-6">
										<input type="text" class="col-sm-12 form-control" id="ref_no" tabindex="8" name="ref_no" value="<?php echo $get_refno;?>" required > 
									</div>
									
									<div class="col-md-2">
										<label for="inputEmail3" class="control-label">Material Rate:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control col-sm-12" tabindex="6"  data-placeholder="Select a M. Rate" id="sel_mat_rate" name="sel_mat_rate" required >
											<option value="">Select Material Rate</option>
											
											<option value="0" <?php if($get_materialrate==0){ echo "selected";}?>>Private</option>
											<option value="1" <?php if($get_materialrate==1){ echo "selected";}?>>Garry</option>
											<option value="2" <?php if($get_materialrate==2){ echo "selected";}?>>R & B</option>
												
										</select> 
									</div>
									
								</div>
								<br>
								
								<div class="row">
							
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Agency:</label>
									</div>
									<div class="col-md-2">
										<select class="form-control  col-sm-12" tabindex="6"  data-placeholder="Select a Agency" id="select_agency" name="select_agency" required >
											<option value="">Select Agency</option>
											<?php 
												$cat_sql = "select * from agency";
											
												$cat_result = mysqli_query($conn, $cat_sql);

													while($cat_row = mysqli_fetch_assoc($cat_result)) {
												
												?>
												<option value="<?php echo $cat_row['agency_name']; ?>" <?php if($cat_row['agency_name']==$get_agency){ echo "selected";}?>>
												<?php echo $cat_row['agency_name']; ?></option>
												<?php  }?>
										</select>
									</div>
									<div class="col-md-1">
										<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-agency">
										
									</div>
							
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label"> Sample brought By:</label>
									</div>
									<div class="col-md-3">
										<select class="form-control col-sm-12" tabindex="6"  data-placeholder="Select a By" id="sel_brought_by" name="sel_brought_by" required >
											<option value="">Select Brought By</option>
											
												<option value="0" <?php if($get_samplebroughtby==0){ echo "selected";}?>>Client</option>
												
										</select>
										
									</div>
								
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Consultant:</label>
									</div>
									<div class="col-md-3">
										<textarea id="consultant" name="consultant" class="col-sm-12 form-control"required >
										<?php echo $get_consultant;?>
										</textarea>
									</div>
								</div>
								<br>
								
								<div class="row">
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Name Of Work:</label>
									</div>
									<div class="col-md-5">
										<textarea id="editor1" name="editor1" class="col-sm-12 form-control"required >
										<?php echo $get_nameofwork; ?>
										</textarea>
									</div>
									
									<div class="col-md-1">
										<label for="inputEmail3" class="control-label">Remark:</label>
									</div>
									<div class="col-md-5">
										<textarea id="editor2" name="editor2" class="col-sm-12 form-control"required >
										<?php echo $get_remark;?>
										</textarea>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-6">
									</div>
									<input type="hidden" name="edit_job_id" value="<?php echo $get_edit_job_id;?>">
									<div class="col-sm-2">
											<input type="submit" class="btn btn-info " id="btn_edit_job" name="btn_edit_job" tabindex="14" value="Update job">
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
			$("#sel_city_job").html(data);   
			$('#txt_new_city').val("");
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



	
$('#date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })

$('#ref_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
</script>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
