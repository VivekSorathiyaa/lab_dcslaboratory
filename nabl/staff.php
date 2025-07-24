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
					STAFF MASTER
						
					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
						
						<!-- /.box-header -->
						<!-- form start -->
						<div class="panel panel-default staffs-content">
							<div class="panel-heading">Staff <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
							<div class="panel-body none formData" id="addForm">
								<h2 id="actionLabel">Add Staff</h2>
								<form class="form" id="staffForm" enctype="multipart/form-data" >
								
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Staff Fullame</label>
													<input type="text" class="form-control" name="staff_fullname" id="staff_fullname"/>
												</div>	
											
								
												<!-- /.input group -->
												<div class="col-md-6">
													<label>Staff Date Of Birth</label><br>
												
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="staff_dob" name="staff_dob">
													</div>
												</div>	
											</div>
										</div>	
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Staff Gender</label><br>
													<input name="staff_gender" id="staff_gender1" type="radio" value="Male">Male<br>
													<input name="staff_gender" id="staff_gender2" type="radio" value="Female">Female
												</div>	
											
												<div class="col-md-6">
													<label>Staff Contact Number</label>
													<input type="text" class="form-control" name="staff_contactno" id="staff_contactno"/>
												</div>	
											</div>
										</div>
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Staff Email</label>
													<input type="email" class="form-control" name="staff_email" id="staff_email"/>
												</div>	
												<div class="col-md-3">
													<label>Staff Password(NABL)</label>
													<input type="password" class="form-control" name="staff_pass" id="staff_pass"/>
												</div>
												<div class="col-md-3">
													<label>Staff Password(DIRECT NABL)</label>
													<input type="password" class="form-control" name="staff_pass_non" id="staff_pass_non"/>
												</div>	
											</div>
										</div>
										<div class="box-body">	
											<div class="form-group">
												
											
												<div class="col-md-6">
													<label>Staff Residential Address</label>
													<textarea class="form-control" name="staff_address" id="staff_address"></textarea>
												</div>
												<div class="col-md-6">
													<label>Staff Status</label>
													<select class="form-control col-md-7 col-xs-12" name="staff_status" id="staff_status">
														<option  value="1">Activate</option>
														<option value="0">Dectivate</option>
													<select>										
												</div>													
											</div>
										</div>
											
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Staff Role</label>
													
												<!-- <div class="checkbox">
													<label>
														<input type="checkbox" name="roles[]"value="1"> Reception 1
													</label>
												 </div>
												 
												 <div class="checkbox">
													<label>
														<input type="checkbox" name="roles[]"value="2"> Reception 2
													</label>
												 </div>
												 
												 <div class="checkbox">
													<label>
														<input type="checkbox" name="roles[]"value="4"> Engineer 
													</label>
												 </div>
												 
												 <div class="checkbox">
													<label>
														<input type="checkbox" name="roles[]"value="5"> Quality Manager 
													</label>
												 </div>
												 
												 <div class="checkbox">
													<label>
														<input type="checkbox" name="roles[]"value="6"> Biller 
													</label>
												 </div>-->
													<select class="form-control col-md-7 col-xs-12" name="staff_role" id="staff_role">
														<option value="">Select Role</option>
														<option  value="2">Reception</option>
														<option  value="4">Analyst</option>
														<option  value="5">QualityManager</option>
														<option  value="5">Director</option>
														<option  value="5">Technical Manager</option>
														<option  value="5">Scenior Analyst</option>
														<!--<option  value="6">Biller</option>-->
													</select>										
												</div>
												<div class="col-md-6">
													<label>PAN Card Detail</label>
													<input type="email" class="form-control" name="staff_pan" id="staff_pan"/>
												</div>				
											</div>
										</div>
										
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Bank Account No.</label>
													<input type="email" class="form-control" name="staff_acc" id="staff_acc"/>
												</div>
												<div class="col-md-6">
													<label>Bank Account Name</label>
													<input type="email" class="form-control" name="staff_accname" id="staff_accname"/>
												</div>
											</div>
										</div>
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Bank Account Branch</label>
													<input type="email" class="form-control" name="staff_branch" id="staff_branch"/>
												</div>
												<div class="col-md-6">
													<label>Bank IFSC Code</label>
													<input type="email" class="form-control" name="staff_ifsc" id="staff_ifsc"/>
												</div>
											</div>
										</div>
										
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<div class="checkbox">
													<label>
														<input type="checkbox" name="nabl_type[]" value="nabl"> &nbsp;&nbsp;&nbsp;<b>NABL</b>
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="nabl_type[]"value="direct_nabl"> &nbsp;&nbsp;&nbsp;&nbsp;<b>DIRECT NABL</b>
													</label>
												 </div>
												</div>
												
											</div>
										</div>
										
										
											
										<div class="box-body">	
											<div class="form-group">
												<div class="box-footer text-center">
														<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
														<a href="javascript:void(0);" class="btn btn-primary" onclick="staffAction('add')">Add Staff</a>
												</div>
											</div>								
										</div>					
								</form>
							</div>
							<div class="panel-body none formData" id="editForm">
								<h2 id="actionLabel">Edit Staff</h2>
								<form class="form" id="staffFormEdit" enctype="multipart/form-data" role="form">
					
								
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Staff Fullame</label>
													<input type="text" class="form-control" name="staff_fullname_edit" id="staff_fullname_edit"/>
												</div>	
											
											
												<div class="col-md-6">
													<label>Staff Date Of Birth</label><br>
												
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="staff_dob_edit" name="staff_dob_edit">
													</div>
												</div>	
											</div>
										</div>	
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Staff Gender</label><br>
													<input name="staff_gender_edit" id="staff_gender_edit1" type="radio" value="Male">Male<br>
													<input name="staff_gender_edit" id="staff_gender_edit2" type="radio" value="Female">Female
												</div>	
										
												<div class="col-md-6">
													<label>Staff Contact Number</label>
													<input type="text" class="form-control" name="staff_contactno_edit" id="staff_contactno_edit"/>
												</div>	
											</div>
										</div>
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Staff Email</label>
													<input type="email" class="form-control" name="staff_email_edit" id="staff_email_edit"/>
												</div>	
												<div class="col-md-3">
													<label>Staff Password(NABL)</label>
													<input type="password" class="form-control" name="staff_pass_edit" id="staff_pass_edit"/>
												</div>	
												<div class="col-md-3">
													<label>Staff Password(DIRECT NABL)</label>
													<input type="password" class="form-control" name="staff_pass_non_edit" id="staff_pass_non_edit"/>
												</div>
											</div>
										</div>
										<div class="box-body">	
											<div class="form-group">
											
												<div class="col-md-6">
													<label>Staff Residential Address</label>
													<textarea class="form-control" name="staff_address_edit" id="staff_address_edit"></textarea>
												</div>
												<div class="col-md-6">
													<label>Staff Status</label>
													<select class="form-control col-md-7 col-xs-12" name="staff_status_edit" id="staff_status_edit">
														<option  value="1">Activate</option>
														<option value="0">Dectivate</option>
													<select>										
												</div>	
											</div>
										</div>		
										<div class="box-body">	
											<div class="form-group">
												
											
												<div class="col-md-6">
													<label>Staff Role</label>
													
												<!-- <div class="checkbox">
													<label>
														<input type="checkbox" name="edit_roles[]"value="1" class="staff_role_edit"> Reception 1
													</label>
												 </div>
												 
												 <div class="checkbox">
													<label>
														<input type="checkbox" name="edit_roles[]"value="2" class="staff_role_edit"> Reception 2
													</label>
												 </div>
												 
												 <div class="checkbox">
													<label>
														<input type="checkbox" name="edit_roles[]"value="4" class="staff_role_edit"> Engineer 
													</label>
												 </div>
												 
												 <div class="checkbox">
													<label>
														<input type="checkbox" name="edit_roles[]"value="5" class="staff_role_edit"> Quality Manager 
													</label>
												 </div>
												 
												 <div class="checkbox">
													<label>
														<input type="checkbox" name="edit_roles[]"value="6" class="staff_role_edit"> Biller 
													</label>
												 </div>-->
													<select class="form-control col-md-7 col-xs-12" name="staff_role_edit" id="staff_role_edit">
														<option value="">Select Role</option>
														<option  value="2">Reception</option>
														<option  value="4">Analyst</option>
														<option  value="5">Quality Manger</option>
														<option  value="5">Technical Manager</option>
														<option  value="5">Director</option>
														<option  value="5">Scenior Analyst</option>
														<!--<option  value="6">Biller</option>-->
													</select>										
												</div>													
											<div class="col-md-6">
													<label>PAN Card Detail</label>
													<input type="email" class="form-control" name="staff_pan_edit" id="staff_pan_edit"/>
												</div>				
											</div>
										</div>
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Bank Account No.</label>
													<input type="email" class="form-control" name="staff_acc_edit" id="staff_acc_edit"/>
												</div>
												<div class="col-md-6">
													<label>Bank Account Name</label>
													<input type="email" class="form-control" name="staff_accname_edit" id="staff_accname_edit"/>
												</div>
											</div>
										</div>
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Bank Account Branch</label>
													<input type="email" class="form-control" name="staff_branch_edit" id="staff_branch_edit"/>
												</div>
												<div class="col-md-6">
													<label>Bank IFSC Code</label>
													<input type="email" class="form-control" name="staff_ifsc_edit" id="staff_ifsc_edit"/>
												</div>
											</div>
										</div>
										
										<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<div class="checkbox">
													<label>
														<input type="checkbox" name="edit_nabl_type[]" value="nabl"> &nbsp;&nbsp;&nbsp;<b>NABL</b>
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														<input type="checkbox" name="edit_nabl_type[]"value="direct_nabl"> &nbsp;&nbsp;&nbsp;&nbsp;<b>DIRECT NABL</b>
													</label>
												 </div>
												</div>
												
											</div>
										</div>
										
										
										
										
										<div class="box-body">	
											<div class="form-group">
												<div class="box-footer text-center">
														<input type="hidden" class="form-control" name="id" id="idEdit"/>
														<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
														<a href="javascript:void(0);" class="btn btn-primary" onclick="staffAction('edit')">Update Staff</a>
												</div>
											</div>								
										</div>				
								</form>
							</div>
								
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Staff Full name</th>
										<th>Staff Date Of birth</th>
										<th>Staff Gender</th>
										<th>Staff Contact Number</th>
										<th>Staff Email</th>
										<th>Staff First Password</th>
										<th>Staff Second Password</th>
										<th>Staff Address</th>
										<th>Staff Status</th>
										<th>Staff Pan No</th>
										<th>Staff Account No.</th>
										<th>Staff Account Name</th>
										<th>Staff Branch</th>
										<th>Staff IFSC Code</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="staffData">
									<?php
										include 'DB.php';
										$db = new DB();
										$staffs = $db->getRows('multi_login',array('order_by'=>'id DESC'));
										if(!empty($staffs)): $count = 0; foreach($staffs as $staff): $count++;
											if($staff['staff_isdeleted'] == 0){
									?>
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td><?php echo $staff['staff_fullname']; ?></td>
										<td><?php echo date('d/m/Y', strtotime($staff['staff_dob']));?></td>
										<td><?php echo $staff['staff_gender']; ?></td>
										<td><?php echo $staff['staff_contactno']; ?></td>
										<td><?php echo $staff['staff_email']; ?></td>
										<td><?php echo $staff['staff_first_pass']; ?></td>
										<td><?php echo $staff['staff_second_pass']; ?></td>
										<!--<td><img height="40px;" width="40px;"src="<?php //echo $staff['staff_image']; ?>"></td>-->			
										<td><?php echo $staff['staff_address']; ?></td>
										<td><?php if($staff['staff_status'] == 1) {echo "Activate";}else{echo "Deactivate";}?></td>
										
										<td><?php echo $staff['staff_pan']; ?></td>
										<td><?php echo $staff['staff_acc']; ?></td>
										<td><?php echo $staff['staff_accname']; ?></td>
										<td><?php echo $staff['staff_branch']; ?></td>
										<td><?php echo $staff['staff_ifsc']; ?></td>
										<td>
											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editstaff('<?php echo $staff['id']; ?>')"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?staffAction('delete','<?php echo $staff['id']; ?>'):false;"></a>
										</td>
									</tr>
											<?php }endforeach; else: ?>
									<tr><td colspan="5">No staff(s) found......</td></tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /.box -->
				</div>
				<!--/.col (right) -->
			</div>
		</section>
			<!-- /.row -->
		<!-- /.content -->
	</div>

<?php 
include("footer.php");

?>
<script>
$('#staff_dob').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
	
$('#staff_dob_edit').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    });
function getstaffs(){
    $.ajax({
        type: 'POST',
        url: 'staffAction.php',
        data: 'action_type=view&'+$("#staffForm").serialize(),
        success:function(html){
            $('#staffData').html(html);
        }
    });
}

function staffAction(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var staffData = '';
		
		
		
	
			
    if (type == 'add') {
		
		var staff_role=$("#staff_role").val();
		if(staff_role==""){
			alert("Select Role First");
			return false;
		}
		
		var array_nabl_or_non = [];
            $.each($("input[name='nabl_type[]']:checked"), function(){
                array_nabl_or_non.push($(this).val());
            });
			
		if (array_nabl_or_non.length === 0) {
			alert("Atleast One Nabl Type Must be Select");
			return false;
			}
		
        staffData = $("#addForm").find('.form').serialize()+'&action_type='+type+'&id='+id;
    }else if (type == 'edit'){
		var staff_role_edit=$("#staff_role_edit").val();
		if(staff_role_edit==""){
			alert("Select Role First");
			return false;
		}
		
		var array_nabl_or_non = [];
            $.each($("input[name='edit_nabl_type[]']:checked"), function(){
                array_nabl_or_non.push($(this).val());
            });
			
		if (array_nabl_or_non.length === 0) {
			alert("Atleast One Nabl Type Must be Select");
			return false;
			}
		
		
        staffData = $("#editForm").find('.form').serialize()+'&action_type='+type;
    }else{
        staffData = 'action_type='+type+'&id='+id;
    }
	
		
	
     $.ajax({
        type: 'POST',
        url: 'staffAction.php',
        data: staffData,
        success:function(msg){
            if(msg !== 'ok'){
                alert('staff data has been '+statusArr[type]+' successfully.');
                 getstaffs();
                $('.form')[0].reset();
                $('.formData').slideUp();
            }else{
                alert('Some problem occurred, please try again.');
            }
        }
    }); 


}

function editstaff(id){
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'staffAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
			var date = data.staff_dob;
			var d=new Date(date.split("/").reverse().join("-"));
			var dd=d.getDate();
			var mm=d.getMonth()+1;
			var yy=d.getFullYear();
			var newdate=dd+"/"+mm+"/"+yy;
            $('#idEdit').val(data.id);
            $('#staff_fullname_edit').val(data.staff_fullname);
            $('#staff_dob_edit').val(newdate);
            $('#staff_gender_edit').val(data.staff_gender);
			$('#staff_contactno_edit').val(data.staff_contactno);
            $('#staff_email_edit').val(data.staff_email);
            $('#staff_pass_edit').val(data.staff_first_pass);
            $('#staff_pass_non_edit').val(data.staff_second_pass);
            $('#staff_address_edit').val(data.staff_address);
            $('#staff_status_edit').val(data.staff_status);
            $('#staff_pan_edit').val(data.staff_pan);
            $('#staff_acc_edit').val(data.staff_acc);
            $('#staff_accname_edit').val(data.staff_accname);
            $('#staff_branch_edit').val(data.staff_branch);
            $('#staff_ifsc_edit').val(data.staff_ifsc); 
			$("input[value='" + data.nabl + "']").prop('checked', true);
			$("input[value='" + data.non_nabl + "']").prop('checked', true);
			$("input[value='" + data.staff_gender + "']").prop('checked', true);
			var get_array_of_roles=data.staff_isadmin;
			var res = get_array_of_roles.split(",");
			
			$('#staff_status_edit option[value="'+ data.staff_status +'"]').attr("selected", "selected");
			$('#staff_role_edit option[value="'+ data.staff_isadmin +'"]').attr("selected", "selected");
			
			$('#staff_modifiedby_edit').val(data.staff_modifiedby);
            $('#staff_modifieddate_edit').val(data.staff_modifieddate);
            $('#editForm').slideDown();
        }
    });
}

</script>
      