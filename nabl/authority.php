<?php 
include("header.php");
include("sidebar.php");
//include("connection.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
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
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Authority Master
				
			</h1>
			
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
						
						<!-- /.box-header -->
						<!-- form start -->
						<div class="panel panel-default auths-content">
							<div class="panel-heading">Authority <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
							<div class="panel-body none formData" id="addForm">
								<h2 id="actionLabel">Add Authority</h2>
								<form class="form" id="authForm">
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Authority Name</label>
													<input type="text" class="form-control" name="auth_name" id="auth_name"/>
												</div>
												<div class="col-md-6">
													<label>Authority Status</label>
													<select class="form-control col-md-7 col-xs-12" name="auth_status" id="auth_status">
														<option  value="1">Activate</option>
														<option value="0">Dectivate</option>
													<select>			
												</div>
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
												<div class="box-footer">
													<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
													<a href="javascript:void(0);" class="btn btn-success" onclick="authAction('add')">Add Authority</a>
												</div>
											</div>
									</div>				
								</form>
							</div>
							<div class="panel-body none formData" id="editForm">
								<h2 id="actionLabel">Edit Authority</h2>
								<form class="form" id="authForm">
									
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Authority Name</label>
													<input type="text" class="form-control" name="auth_name" id="auth_name_edit"/>
												</div>
												<div class="col-md-6">
													<label>Authority Status</label>
													<select class="form-control col-md-7 col-xs-12" name="auth_status" id="auth_status_edit">
														<option  value="1">Activate</option>
														<option value="0">Dectivate</option>
													<select>			
												</div>
											</div>	
									</div>
									
									<div class="box-body">	
										<div class="form-group">
											<div class="box-footer">
												<input type="hidden" class="form-control" name="id" id="idEdit"/>
												<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
												<a href="javascript:void(0);" class="btn btn-success" onclick="authAction('edit')">Update auth</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Authority Name</th>
										<th>Authority Status</th>
			
									</tr>
								</thead>
								<tbody id="authData">
									<?php
										include 'DB.php';
										$db = new DB();
										$auths = $db->getRows('authority',array('order_by'=>'id DESC'));
										if(!empty($auths)): $count = 0; foreach($auths as $auth): $count++;
					
									?>
									<?php
										
											
									?>
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td><?php echo $auth['auth_name']; ?></td>
										
										<td><?php if($auth['auth_status'] == 1) {echo "Activate";}else{echo "Deactivate";}?></td>
										<td>
										
											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editauth('<?php echo $auth['id']; ?>')"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?authAction('delete','<?php echo $auth['id']; ?>'):false;"></a>
										</td>
									</tr>
										<?php endforeach; ?>
									
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
function getauths(){
    $.ajax({
        type: 'POST',
        url: 'authAction.php',
        data: 'action_type=view&'+$("#authForm").serialize(),
        success:function(html){
            $('#authData').html(html);
        }
    });
}

function authAction(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var authData = '';
    if (type == 'add') {
        authData = $("#addForm").find('.form').serialize()+'&action_type='+type+'&id='+id;
    }else if (type == 'edit'){
        authData = $("#editForm").find('.form').serialize()+'&action_type='+type;
    }else{
        authData = 'action_type='+type+'&id='+id;
    }
    $.ajax({
        type: 'POST',
        url: 'authAction.php',
        data: authData,
        success:function(msg){
            if(msg == 'ok'){
				swal('Congratulations!', 'Reference data has been '+statusArr[type]+' successfully.', 'success');

                getauths();
                $('.form')[0].reset();
                $('.formData').slideUp();
            }else{
				swal('Error!', 'Some problem occurred, please try again.', 'error');
            }
        }
    });
}

function editauth(id){
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'authAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
            $('#auth_name_edit').val(data.auth_name);
            $('#auth_status_edit').val(data.auth_status);
            $('#editForm').slideDown();
        }
    });
}
</script>