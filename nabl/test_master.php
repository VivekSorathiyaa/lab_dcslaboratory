<?php include("header.php");
error_reporting(1); ?>
<?php
if ($_SESSION['name'] == "") {
?>
	<script>
		window.location.href = "<?php echo $base_url; ?>index.php";
	</script>
<?php
}
?>



<style>
	/* required style*/
	.none {
		display: none;
	}

	/* optional styles */
	table tr th,
	table tr td {
		font-size: 1.2rem;
	}

	.glyphicon {
		font-size: 20px;
	}

	.glyphicon-plus {
		float: right;
	}

	a.glyphicon {
		text-decoration: none;
	}

	
</style>
<div class="content-wrapper" style="margin-left: 0px !important;">

	<!-- Main content -->
	<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
		<?php include("menu.php") ?>
		<div class="row" style="margin: 0px 0px 0px 0px;">

			<h1 style="text-align:center;">
				TEST MASTER

			</h1>
		</div>
		<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">

					<!-- /.box-header -->
					<!-- form start -->
					<div class="panel panel-default mts-content">
						<div class="panel-heading">Test Master <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
						<div class="panel-body none formData" id="addForm">
							<h2 id="actionLabel">Add Test</h2>
							<form class="form" id="mtForm">
								<div class="row">
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-12">
													<label>Select Category</label>
													<select class="form-control col-md-7 col-xs-12" name="mat_category_id" id="mat_category_id">
														<option value="">select category</option>
														<?php
														$select_category = "select * from material_category where material_cat_status = 1 and material_cat_isdelete = 0";
														$qry_select_category = mysqli_query($conn, $select_category);
														if (mysqli_num_rows($qry_select_category) > 0) {
															while ($rows = mysqli_fetch_array($qry_select_category)) {

														?>
																<option value="<?php echo $rows['material_cat_id']; ?>"><?php echo $rows['material_cat_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Name</label>
													<input type="text" class="form-control" name="test_name" id="test_name" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>HSN Code</label>
													<input type="text" class="form-control" name="hsn_code" id="hsn_code" value="998346" />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Code</label>
													<input type="text" class="form-control" name="test_code" id="test_code" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Rate</label>
													<input type="text" class="form-control" name="test_rate" id="test_rate" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Rate Private</label>
													<input type="text" class="form-control" name="test_rate_private" id="test_rate_private" />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Rate Government</label>
													<input type="text" class="form-control" name="test_rate_gov" id="test_rate_gov" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Required Days For Perform Test</label>
													<input type="text" class="form-control" name="per_day_limit" id="per_day_limit" />
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Method</label>
													<input type="text" class="form-control" name="test_method" id="test_method" />
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Testing Capacity Limit Per Day</label>
													<input type="text" class="form-control" name="cap_per_day" id="cap_per_day" />
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-md-4">
													<label>IN NABL</label>
													<select name="in_nabl" id="in_nabl" class="form-control">
													<option value="yes">YES</option>
													<option value="no">NO</option>
													</select>
												</div>

								</div>


								<div class="box-body">
									<div class="form-group">
										<div class="box-footer">
											<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
											<a href="javascript:void(0);" class="btn btn-success" onclick="mate_catAction('add')">Add Test</a>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-body none formData" id="editForm">
							<h2 id="actionLabel">Edit Test</h2>
							<form class="form" id="mtForm">
								<div class="row">
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-12">
													<label>Select Category</label>
													<select class="form-control col-md-7 col-xs-12" name="edit_mat_category_id" id="edit_mat_category_id">
														<option value="">select category</option>
														<?php
														$select_category = "select * from material_category where material_cat_status = 1 and material_cat_isdelete = 0";
														$qry_select_category = mysqli_query($conn, $select_category);
														if (mysqli_num_rows($qry_select_category) > 0) {
															while ($rows = mysqli_fetch_array($qry_select_category)) {

														?>
																<option value="<?php echo $rows['material_cat_id']; ?>"><?php echo $rows['material_cat_name']; ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Name</label>
													<input type="text" class="form-control" name="edit_test_name" id="edit_test_name" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>HSN Code</label>
													<input type="text" class="form-control" name="edit_hsn_code" id="edit_hsn_code" />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Code</label>
													<input type="text" class="form-control" name="edit_test_code" id="edit_test_code" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Rate</label>
													<input type="text" class="form-control" name="edit_test_rate" id="edit_test_rate" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Rate Private</label>
													<input type="text" class="form-control" name="edit_test_rate_private" id="edit_test_rate_private" />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Rate Goverment</label>
													<input type="text" class="form-control" name="edit_test_rate_gov" id="edit_test_rate_gov" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Required Days For Perform Test</label>
													<input type="text" class="form-control" name="edit_per_day_limit" id="edit_per_day_limit" />
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Test Method</label>
													<input type="text" class="form-control" name="edit_test_method" id="edit_test_method" />
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="box-body">
											<div class="form-group">
												<div class="col-md-6">
													<label>Testing Capacity Limit Per Day</label>
													<input type="text" class="form-control" name="edit_cap_per_day" id="edit_cap_per_day" />
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
													<label>IN NABL</label>
													<select name="edit_in_nabl" id="edit_in_nabl" class="form-control">
													<option value="yes">YES</option>
													<option value="no">NO</option>
													</select>
												</div>

								</div>
								<div class="box-body">
									<div class="form-group">
										<div class="box-footer">
											<input type="hidden" class="form-control" name="id" id="idEdit" />
											<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
											<a href="javascript:void(0);" class="btn btn-success" onclick="mate_catAction('edit')">Update Test</a>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div id="data_test">
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Category Name</th>
										<th>Test Name</th>
										<th>HSN Code</th>
										<th>Test Rate</th>
										<th>Test Rate Private</th>
										<th>Test Rate Goverment</th>
										<th>Required Days For Perform Test</th>
										<th>Test Method</th>
										<th>Test Code</th>
										<th>Capacity / Day</th>
										<th>In Nabl</th>
									</tr>
								</thead>
								<tbody id="mtData">
									<?php
									$select_record = "select * from test_master where test_isdeleted='0'";
									$select_qry_test = mysqli_query($conn, $select_record);
									if (mysqli_num_rows($select_qry_test) > 0) {
										$count = 1;
										while ($rows_rec = mysqli_fetch_array($select_qry_test)) {
											$cat_id_rec = $rows_rec['mat_category_id'];
											//$mat_id_rec = $rows_rec['material_id'];
											$get_cat_name = "select * from material_category where material_cat_id = '$cat_id_rec'";
											$qry_select_cat = mysqli_query($conn, $get_cat_name);
											if (mysqli_num_rows($qry_select_cat) > 0) {
												while ($row_cat = mysqli_fetch_array($qry_select_cat)) {
													$category_name_by_id = $row_cat['material_cat_name'];
												}
											}
											/* $get_mat_name = "select * from material where id='$mat_id_rec' and mat_category_id = '$cat_id_rec'";
												$qry_select_mat = mysqli_query($conn,$get_mat_name);
												if(mysqli_num_rows($qry_select_mat) > 0)
												{	
													while($row_mat = mysqli_fetch_array($qry_select_mat))
													{
														$material_name_by_id = $row_mat['mt_name'];
													}
												} */
									?>
											<tr>
												<td><?php echo '#' . $count; ?></td>
												<td><?php echo $category_name_by_id; ?></td>

												<td><?php echo $rows_rec['test_name']; ?></td>
												<td><?php echo $rows_rec['hsn_code']; ?></td>
												<td><?php echo $rows_rec['test_rate']; ?></td>
												<td><?php echo $rows_rec['test_rate_private']; ?></td>
												<td><?php echo $rows_rec['test_rate_gov']; ?></td>
												<td><?php echo $rows_rec['per_day_limit']; ?></td>
												<td><?php echo $rows_rec['test_method']; ?></td>
												<td><?php echo $rows_rec['test_code']; ?></td>
												<td><?php echo $rows_rec['cap_per_day']; ?></td>
												<td><?php echo $rows_rec['in_nabl']; ?></td>
												<td class="d-flex gap-1">
													<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editmt('<?php echo $rows_rec['test_id']; ?>')"></a>
													<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?mate_catAction('delete','<?php echo $rows_rec['test_id']; ?>'):false;"></a>
												</td>
											</tr>
									<?php
											$count++;
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>

<?php
include("footer.php");

//include("connection.php");

?>
<script>
	function getmts() {
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_test_master_for_master_dashboard.php',
			data: 'action_type=view&' + $("#mtForm").serialize(),
			success: function(html) {
				$('#data_test').html(html);
			}
		});
	}

	function mate_catAction(type, id) {
		id = (typeof id == "undefined") ? '' : id;
		var statusArr = {
			add: "added",
			edit: "updated",
			delete: "deleted"
		};
		var mtData = '';
		if (type == 'add') {
			mtData = $("#addForm").find('.form').serialize() + '&action_type=' + type + '&id=' + id;

		} else if (type == 'edit') {
			mtData = $("#editForm").find('.form').serialize() + '&action_type=' + type;

		} else {
			mtData = 'action_type=' + type + '&id=' + id;
		}
		$.ajax({
			type: 'POST',
			url: '<?php $base_url; ?>save_test_master_for_master_dashboard.php',
			data: mtData,

			success: function(msg) {

				swal('Congratulations!', 'Test data has been ' + statusArr[type] + ' successfully.', 'success');
				getmts();
				$('.form')[0].reset();
				$('.formData').slideUp();


			}
		});
	}

	function editmt(id) {
		$.ajax({
			type: 'POST',
			dataType: 'JSON',
			url: '<?php $base_url; ?>save_test_master_for_master_dashboard.php',
			data: 'action_type=data&id=' + id,
			success: function(data) {

				$('#idEdit').val(data.test_id);
				$('#edit_mat_category_id').val(data.mat_category_id);
				/*$('#edit_material_id').val(data.material_id);
			$("#edit_material_id").append("<option value='"+data.material_id+"'selected>"+data.material_name_by_id+"</option>");*/
				$('#edit_test_name').val(data.test_name);
				$('#edit_hsn_code').val(data.hsn_code);
				$('#edit_test_rate').val(data.test_rate);
				$('#edit_test_rate_private').val(data.test_rate_private);
				$('#edit_test_rate_gov').val(data.test_rate_gov);
				$('#edit_per_day_limit').val(data.per_day_limit);
				$('#edit_test_code').val(data.test_code);
				$('#edit_test_method').val(data.test_method);
				$('#edit_cap_per_day').val(data.cap_per_day);
				$('#edit_in_nabl').val(data.in_nabl).prop('checked', true);
				$('#editForm').slideDown();
			}
		});
	}
	//Get materiaL FROM category
	/*$("#mat_category_id").change(function(){
	      var mat_category_id = $('#mat_category_id').val();
			
		  var postData = 'action_type=get_material_by_category&mat_category_id='+mat_category_id;
				
				$.ajax({
					url : "<?php $base_url; ?>save_test_master_for_master_dashboard.php",
					type: "POST",
					dataType:'JSON',
					data : postData,
					success: function(data)
					 {
						
						$('#material_id').html(data.all_material);	
							
					 
					 }
				});
	});
	$("#edit_mat_category_id").change(function(){
	      var mat_category_id = $('#edit_mat_category_id').val();
			
		  var postData = 'action_type=get_material_by_category&mat_category_id='+mat_category_id;
				
				$.ajax({
					url : "<?php $base_url; ?>save_test_master_for_master_dashboard.php",
					type: "POST",
					dataType:'JSON',
					data : postData,
					success: function(data)
					 {
						
						$('#edit_material_id').html(data.all_material);	
							
					 
					 }
				});
	});*/
</script>