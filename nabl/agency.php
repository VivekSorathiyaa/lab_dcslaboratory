<?php include("header.php");?>
<?php 
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}
?>



<style>
/* required style*/ 
.none{display: none;}

/* optional styles */
table tr th, table tr td{font-size: 1.2rem;}

.glyphicon{font-size: 20px;}
.glyphicon-plus{float: right;}
a.glyphicon{text-decoration: none;}


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
					AGENCY  MASTER
						
					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
						
						<!-- /.box-header -->
						<!-- form start -->
						<div class="panel panel-default agencys-content">
							<div class="panel-heading">Agency <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
							<div class="panel-body none formData" id="addForm">
								<h2 id="actionLabel">Add Agency</h2>
								<form class="form" id="agencyForm">
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Agency Name</label>
													<input type="text" class="form-control" name="agency_name" id="agency_name" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Mobile No</label>
													<input type="text" class="form-control" name="agency_mobile" id="agency_mobile" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Address</label>
													<textarea name="agency_address" class="col-sm-12 form-control"required ></textarea>
												</div>
												
												<div class="col-md-6">
													<label>Agency City</label>
													<select class="form-control col-sm-12" tabindex="6"   id="sel_agency_city" name="sel_agency_city" required >
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
													<input type="text" class="form-control" name="agency_pincode" id="agency_pincode" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Email</label>
													<input type="text" class="form-control" name="agency_email" id="agency_email" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Gstno</label>
													<input type="text" class="form-control" name="agency_gstno" id="agency_gstno" required >
												</div>
									
												<div class="col-md-6">
													<label>Agency Status</label>
													<select class="form-control col-md-7 col-xs-12" name="agency_status" id="agency_status">
														<option  value="0">Activate</option>
														<option value="1">Deactivate</option>
													<select>			
												</div>
									
												<div class="col-md-6">
													<label>Make By </label>
													<select class="form-control col-md-7 col-xs-12" name="perfoma_make_by" id="perfoma_make_by">
														<option value="0">By Test</option>
														<option  value="1">By Material</option>
													<select>			
												</div>
												
												<div class="col-md-6">
													<label>Rate </label>
													<select class="form-control col-md-7 col-xs-12" name="add_rate" id="add_rate">
														<option value="1">Private</option>
														<option  value="0">Government</option>
													<select>			
												</div>
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
												<div class="box-footer">
													<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
													<a href="javascript:void(0);" class="btn btn-success" onclick="agencyAction('add')">Add Agency</a>
												</div>
											</div>
									</div>				
								</form>
							</div>
							<div class="panel-body none formData" id="editForm">
								<h2 id="actionLabel">Edit Agency</h2>
								<form class="form" id="agencyForm">
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Agency Name</label>
													<input type="text" class="form-control" name="agency_name_edit" id="agency_name_edit" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Mobile No</label>
													<input type="text" class="form-control" name="agency_mobile_edit" id="agency_mobile_edit" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Address</label>
													<textarea name="agency_address_edit" id="agency_address_edit" class="col-sm-12 form-control"required ></textarea>
												</div>
												
												<div class="col-md-6">
													<label>Agency City</label>
													<select class="form-control col-sm-12" tabindex="6"   id="sel_agency_city_edit" name="sel_agency_city_edit" required >
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
													<input type="text" class="form-control" name="agency_pincode_edit" id="agency_pincode_edit" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Email</label>
													<input type="text" class="form-control" name="agency_email_edit" id="agency_email_edit" required >
												</div>
												
												<div class="col-md-6">
													<label>Agency Gstno</label>
													<input type="text" class="form-control" name="agency_gstno_edit" id="agency_gstno_edit" required >
												</div>
									
												<div class="col-md-6">
													<label>Agency Status</label>
													<select class="form-control col-md-7 col-xs-12" name="agency_status_edit" id="agency_status_edit">
														<option  value="0">Activate</option>
														<option value="1">Deactivate</option>
													<select>			
												</div>
												
												<div class="col-md-6">
													<label>Make By </label>
													<select class="form-control col-md-7 col-xs-12" name="perfoma_make_by_edit" id="perfoma_make_by_edit">
														<option  value="0">By Test</option>
														<option value="1">By Material</option>
													<select>			
												</div>
												
												<div class="col-md-6">
													<label>Rate </label>
													<select class="form-control col-md-7 col-xs-12" name="add_rate_edit" id="add_rate_edit">
														<option value="1">Private</option>
														<option  value="0">Government</option>
													<select>			
												</div>
											</div>		
									</div>
									<input type="hidden" name="edit_id" id="edit_id">
									
									<div class="box-body">	
										<div class="form-group">
											<div class="box-footer">
												<input type="hidden" class="form-control" name="id" id="idEdit"/>
												<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
												<a href="javascript:void(0);" class="btn btn-success" onclick="agencyAction('edit')">Update Agency</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Agency Name</th>
										<th>Agency Mobile</th>
										<th>Agency Pincode</th>
										<th>Agency Email</th>
										<th>Agency Status</th>
			
									</tr>
								</thead>
								<tbody id="agencyData">
									<?php
										include 'DB.php';
										$db = new DB();
										$agencys = $db->getRows('agency_master',array('order_by'=>'agency_id DESC'));
										if(!empty($agencys)): $count = 0; foreach($agencys as $agency): $count++;
										if($agency['isdeleted']==0){
									?>
									<?php
										
											
									?>
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td><?php echo $agency['agency_name']; ?></td>
										<td><?php echo $agency['agency_mobile']; ?></td>
										<td><?php echo $agency['agency_pincode']; ?></td>
										<td><?php echo $agency['agency_email']; ?></td>
										<td><?php if($agency['agency_status'] == 0) {echo "Activate";}else{echo "Deactivate";}?></td>
										<td>
										
											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editagency('<?php echo $agency['agency_id']; ?>')"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?agencyAction('delete','<?php echo $agency['agency_id']; ?>'):false;"></a>
										</td>
									</tr>
										<?php
										}
										endforeach; ?>
									
									<?php endif; ?>
								</tbody>
							</table>
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
?>
<script>
$(function () {
    $('.select2').select2();
  });
function getagencys(){
    $.ajax({
        type: 'POST',
        url: 'agencyAction.php',
        data: 'action_type=view&'+$("#agencyForm").serialize(),
        success:function(html){
            $('#agencyData').html(html);
        }
    });
}

function agencyAction(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var agencyData = '';
    if (type == 'add') {
        agencyData = $("#addForm").find('.form').serialize()+'&action_type='+type+'&id='+id;
    }else if (type == 'edit'){
        agencyData = $("#editForm").find('.form').serialize()+'&action_type='+type;
    }else{
        agencyData = 'action_type='+type+'&id='+id;
    }
    $.ajax({
        type: 'POST',
        url: 'agencyAction.php',
        data: agencyData,
        success:function(msg){
            if(msg == 'ok'){
				swal('Congratulations!', 'Agency data has been '+statusArr[type]+' successfully.', 'success');
                getagencys();
                $('.form')[0].reset();
                $('.formData').slideUp();
            }else{

			   	swal('Error!', 'Some problem occurred, please try again.', 'error');

            }
        }
    });
}

function editagency(id){
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'agencyAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
            $('#agency_name_edit').val(data.agency_name);
            $('#agency_mobile_edit').val(data.agency_mobile);
            $('#agency_address_edit').val(data.agency_address);
            $('#sel_agency_city_edit').val(data.agency_city);
            $('#agency_pincode_edit').val(data.agency_pincode);
            $('#agency_email_edit').val(data.agency_email);
            $('#agency_gstno_edit').val(data.agency_gstno);
            $('#agency_status_edit').val(data.agency_status);
            $('#perfoma_make_by_edit').val(data.perfoma_make_by);
            $('#add_rate_edit').val(data.rate_by);
            $('#edit_id').val(data.agency_id);
            $('#editForm').slideDown();
        }
    });
}
</script>