<?php 
	include("include/header.php");
	include("include/sidebar.php");
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
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#clients" data-toggle="tab">Client</a></li>
							<li><a href="#job_tab" id="pass_anchor"data-toggle="tab">Job Inward</a></li>
						</ul>
							<div class="tab-content">
								<div class="active tab-pane" id="clients">
									<form method="post">
										<div class="row">
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Report Number:</label>
											</div>
											<div class="col-md-2">
												<input type="text" class="col-sm-12 form-control" id="report_number" tabindex="8" name="report_number">
											</div>
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Client Code:</label>
											</div>
											<div class="col-md-2">
												<input type="text" class="col-sm-12 form-control" id="client_code" tabindex="8" name="client_code">
											</div>
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Client Name:</label>
											</div>
											<div class="col-md-2">
												<input type="text" class="col-sm-12 form-control" id="client_name" tabindex="8" name="client_name">
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Number:</label>
											</div>
											<div class="col-md-2">
												<input type="text" class="col-sm-12 form-control" id="number" tabindex="8" name="number">
											</div>
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Email:</label>
											</div>
											<div class="col-md-2">
												<input type="text" class="col-sm-12 form-control" id="email" tabindex="8" name="email">
											</div>
											<div class="col-md-1">
												<label for="inputEmail3" class="control-label">Address:</label>
											</div>
											<div class="col-md-3">
												<textarea class="form-control" name="address" id="address"></textarea>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">City:</label>
											</div>
											<div class="col-md-2">
												<select class="form-control col-sm-12" tabindex="6"  data-placeholder="Select a category" id="sel_city" name="sel_city" required >
													<option value="">Select City</option>
												</select>
											</div>
											<div class="col-md-2">
												<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-city">
											</div>
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Category:</label>
											</div>
											<div class="col-md-2">
												<select class="form-control  col-sm-12" tabindex="6"  data-placeholder="Select a category" id="sel_category" name="sel_category" required >
													<option value="">Select category</option>
												</select>
											</div>
											<div class="col-md-2">
												<input type="button" value="+" class="col-sm-12 btn btn-info" data-toggle="modal" data-target="#modal-category">
											</div>
											
										</div>
										<br>
										<div class="row">
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Contact Person:</label>
											</div>
											<div class="col-md-2">
												<input type="text" class="col-sm-12 form-control" id="person" tabindex="8" name="person" required>
											</div>
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Person Detail:</label>
											</div>
											<div class="col-md-2">
												<input type="text" class="col-sm-12 form-control" id="person_detail" tabindex="8" name="person_detail" required>
											</div>
											
										</div>
										<br>
										<div class="row">
											<div class="col-sm-4"></div>
											<div class="col-sm-4">
												<button type="button" class="btn btn-info " id="btn_save_client" name="sub_client" tabindex="14">Save Client</button>
												<button type="button" class="btn btn-info " id="btn_next" name="btn_next" tabindex="14">Next</button>
											</div>
											<div class="col-sm-4"></div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="job_tab">
									<form class="" method="post" name="frm_job">
										<div class="row">
											<div class="col-md-12">
												<label for="inputEmail3" class="control-label">Job Detail</label>
											</div>
										</div>
										<hr style="border: 1px solid #ddd;">
										
										<div class="row">
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Ref Date:</label>
											</div>
											<div class="col-md-2">
												<input type="text" class="col-sm-12 form-control" id="ref_date" tabindex="8" name="ref_date" required > 
											</div>
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Ref Number:</label>
											</div>
											<div class="col-md-2">
												<input type="text" class="col-sm-12 form-control" id="ref_no" tabindex="8" name="ref_no" required > 
											</div>
											<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Material Rate:</label>
											</div>
											<div class="col-md-2">
												<select class="form-control col-sm-12" tabindex="6"  data-placeholder="Select a M. Rate" id="sel_mat_rate" name="sel_mat_rate" required >
													<option value="">Select Material Rate</option>
														
														<option value="0">Private</option>
														<option value="1">Garry</option>
														<option value="2">R & B</option>
															
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
													<option value="0">Client</option>
												</select>
											</div>
											<div class="col-md-1">
												<label for="inputEmail3" class="control-label">Consultant:</label>
											</div>
											<div class="col-md-3">
												<textarea id="consultant" name="consultant" class="col-sm-12 form-control"required ></textarea>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-3">
												<label for="inputEmail3" class="control-label">Name Of Work:</label>
											</div>
											<div class="col-md-5">
												<textarea id="editor1" name="editor1" class="col-sm-12 form-control"required ></textarea>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-sm-6"></div>
											<div class="col-sm-2">
												<input type="submit" class="btn btn-info " id="btn_save_job" name="btn_save_job" tabindex="14" value="Save job">
											</div>
											<div class="col-sm-4"></div>
										</div>
									</form>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div>
				  <!-- /.nav-tabs-custom -->
				</div>
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
	<?php 
		include("include/footer.php");
?>

