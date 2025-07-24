<?php 
include("header.php");
include("sidebar.php");
//include("connection.php");

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
				Reference Master
				
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
						<div class="panel panel-default refs-content">
							<div class="panel-heading">Reference <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
							<div class="panel-body none formData" id="addForm">
								<h2 id="actionLabel">Add Reference</h2>
								<form class="form" id="refForm">
									<div class="box-body">
										<div class="form-group">
											<div class="col-md-6">
												<label>Reference Name</label>
												<input type="text" class="form-control" name="ref_name" id="ref_name"/>
											</div>
											<div class="col-md-6">
												<label>Reference Status</label>
												<select class="form-control col-md-7 col-xs-12" name="ref_status" id="ref_status">
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
												<a href="javascript:void(0);" class="btn btn-success" onclick="refAction('add')">Add Reference</a>
											</div>	
										</div>	
									</div>	
								</form>
							</div>
							<div class="panel-body none formData" id="editForm">
								<h2 id="actionLabel">Edit References</h2>
								<form class="form" id="refForm">
									<div class="box-body">
										<div class="form-group">
											<div class="col-md-6">
												<label>Reference Name</label>
												<input type="text" class="form-control" name="ref_name" id="ref_name_edit"/>
											</div>
											<div class="col-md-6">
												<label>Reference Status</label>
												<select class="form-control col-md-7 col-xs-12" name="ref_status" id="ref_status_edit">
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
												<a href="javascript:void(0);" class="btn btn-success" onclick="refAction('edit')">Update Reference</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Reference Name</th>
										<th>Reference Status</th>
				
									</tr>
								</thead>
								<tbody id="refData">
									<?php
										include 'DB.php';
										$db = new DB();
										$refs = $db->getRows('reference',array('order_by'=>'id DESC'));
										if(!empty($refs)): $count = 0; foreach($refs as $ref): $count++;
											
									?>
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td><?php echo $ref['ref_name']; ?></td>
										<td><?php if($ref['ref_status'] == 1) {echo "Activate";}else{echo "Deactivate";}?></td>
										<td>
											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editref('<?php echo $ref['id']; ?>')"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?refAction('delete','<?php echo $ref['id']; ?>'):false;"></a>
										</td>
									</tr>
											<?php  endforeach; ?>
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
function getrefs(){
    $.ajax({
        type: 'POST',
        url: 'refAction.php',
        data: 'action_type=view&'+$("#refForm").serialize(),
        success:function(html){
            $('#refData').html(html);
        }
    });
}

function refAction(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var refData = '';
    if (type == 'add') {
        refData = $("#addForm").find('.form').serialize()+'&action_type='+type+'&id='+id;
    }else if (type == 'edit'){
        refData = $("#editForm").find('.form').serialize()+'&action_type='+type;
    }else{
        refData = 'action_type='+type+'&id='+id;
    }
    $.ajax({
        type: 'POST',
        url: 'refAction.php',
        data: refData,
        success:function(msg){
            if(msg == 'ok'){
              
                getrefs();
                $('.form')[0].reset();
                $('.formData').slideUp();
            }else{
			   	swal('Error!', 'Some problem occurred, please try again.', 'error');
            }
        }
    });
}

function editref(id){
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'refAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
            $('#ref_name_edit').val(data.ref_name);
            $('#ref_status_edit').val(data.ref_status);
            $('#editForm').slideDown();
        }
    });
}
</script>