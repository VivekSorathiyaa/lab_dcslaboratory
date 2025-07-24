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
				IP Configuration Master
				
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
						<div class="panel panel-default mts-content">
							<div class="panel-heading">IP Configuration Master <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
							<div class="panel-body none formData" id="addForm">
								<h2 id="actionLabel">Add Ip</h2>
								<form class="form" id="mtForm">
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Ip Address</label>
													<input type="text" class="form-control" name="ipaddress" id="ipaddress"/>
												</div>
												<div class="col-md-6">
													<label>Remarks</label>
													<input type="text" class="form-control" name="Remarks" id="Remarks"/>			
												</div>
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">												
												<div class="col-md-12">
													<label>Status</label>
													<select class="form-control col-md-7 col-xs-12" name="status" id="status">
														<option  value="1">Activate</option>
														<option value="0">Dectivate</option>
													</select>			
												</div>
											</div>	
									</div>
									
									<div class="box-body">	
											<div class="form-group">
												<div class="box-footer">
													<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
													<a href="javascript:void(0);" class="btn btn-success" onclick="ipAction('add')">Add Ip</a>
												</div>
											</div>
									</div>				
								</form>
							</div>
							<div class="panel-body none formData" id="editForm">
								<h2 id="actionLabel">Edit Ip</h2>
								<form class="form" id="mtForm">
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Ip Address</label>
													<input type="text" class="form-control" name="ipaddress_edit" id="ipaddress_edit"/>
												</div>
												<div class="col-md-6">
													<label>Remarks</label>
													<input type="text" class="form-control" name="Remarks_edit" id="Remarks_edit"/>			
												</div>
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Status</label>
													<select class="form-control col-md-7 col-xs-12" name="status_edit" id="status_edit">
														<option  value="1">Activate</option>
														<option value="0">Dectivate</option>
													</select>			
												</div>
												
											</div>	
									</div>
									<div class="box-body">	
										<div class="form-group">
											<div class="box-footer">
												<input type="hidden" class="form-control" name="id" id="idEdit"/>
												<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
												<a href="javascript:void(0);" class="btn btn-success" onclick="ipAction('edit')">Update Ip</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Ip Address</th>
										<th>Remarks</th>
										<th>Ip Status</th>
			
									</tr>
								</thead>
								<tbody id="mtData">
									<?php
										include 'DB.php';
										$db = new DB();
										$mts = $db->getRows('ip_master',array('order_by'=>'id DESC'));
										if(!empty($mts)): $count = 0; foreach($mts as $mt): $count++;
					
									?>
									<?php
										if($mt['status'] == 1){
											
									?>
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td><?php echo $mt['ipaddress']; ?></td>
										<td><?php echo $mt['Remarks']; ?></td>
										<td><?php if($mt['status'] == 1) {echo "Activate";}else{echo "Deactivate";}?></td>
										<td>
										
											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editmt('<?php echo $mt['id']; ?>')"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?ipAction('delete','<?php echo $mt['id']; ?>'):false;"></a>
										</td>
									</tr>
										<?php }endforeach; else: ?>
									<tr><td colspan="5">No Ip's found......</td></tr>
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

//include("connection.php");

?>
<script>
function getmts(){
    $.ajax({
        type: 'POST',
        url: 'ipAction.php',
        data: 'action_type=view&'+$("#mtForm").serialize(),
        success:function(html){
            $('#mtData').html(html);
        }
    });
}

function ipAction(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var mtData = '';
    if (type == 'add') {
        mtData = $("#addForm").find('.form').serialize()+'&action_type='+type+'&id='+id;
    }else if (type == 'edit'){
        mtData = $("#editForm").find('.form').serialize()+'&action_type='+type;
    }else{
        mtData = 'action_type='+type+'&id='+id;
    }
    $.ajax({
        type: 'POST',
        url: 'ipAction.php',
        data: mtData,
        success:function(msg){
            if(msg == 'ok'){
				swal('Congratulations!', 'Ip data has been '+statusArr[type]+' successfully.', 'success');

                getmts();
                $('.form')[0].reset();
                $('.formData').slideUp();
            }else{
				swal('Error!', 'Some problem occurred, please try again.', 'error');

            }
        }
    });
}

function editmt(id){
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'ipAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
            $('#ipaddress_edit').val(data.ipaddress);
            $('#Remarks_edit').val(data.Remarks);
            $('#status_edit').val(data.status);          
            $('#editForm').slideDown();
        }
    });
}


</script>