<?php 
session_start();
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
				Add Agency	
			</h1>
			
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Add Agency</h3>
						</div>
						<!-- /.box-header -->
						<!-- form start -->
						<div class="panel panel-default taxs-content">
				<div class="panel-heading">Agency <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
				<div class="panel-body none formData" id="addForm">
					<h2 id="actionLabel">Add Agency</h2>
					<form class="form" id="taxForm">
						<div class="box-body">
							<div class="form-group">
								<div class="col-md-6">
									<label>Agency Name</label>
									<input type="text" class="form-control" name="agency_name" id="agency_name"/>
								</div>
								<div class="col-md-6">
									<label>Agency Status</label>
									<select class="form-control col-md-7 col-xs-12" name="agency_status" id="agency_status">
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
									<a href="javascript:void(0);" class="btn btn-success" onclick="actionagency('add')">Add Agency</a>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="panel-body none formData" id="editForm">
					<h2 id="actionLabel">Edit Agency</h2>
					<form class="form" id="taxForm">
						<div class="box-body">
							<div class="form-group">
								<div class="col-md-6">
									<label>Agency Name</label>
									<input type="text" class="form-control" name="agency_name" id="agency_name_edit"/>
								</div>
								<div class="col-md-6">
									<label>Agency Status</label>
									<select class="form-control col-md-7 col-xs-12" name="agency_status" id="agency_status_edit">
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
									<a href="javascript:void(0);" class="btn btn-success" onclick="actionagency('edit')">Update Agency</a>
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
							<th>Agency Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="taxData">
						<?php
							include 'DB.php';
							$db = new DB();
							$agencies = $db->getRows('agency',array('order_by'=>'id DESC'));
							if(!empty($agencies)): $count = 0; foreach($agencies as $agency): $count++;
						?>
						<tr>
							<td><?php echo '#'.$count; ?></td>
							<td><?php echo $agency['agency_name']; ?></td>
							<td><?php echo $agency['agency_status']; ?></td>
							<td>
								<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editagency('<?php echo $agency['id']; ?>')"></a>
								<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?actionagency('delete','<?php echo $agency['id']; ?>'):false;"></a>
							</td>
						</tr>
						<?php endforeach; else: ?>
						<tr><td colspan="5">No tax(s) found......</td></tr>
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
function gettaxs(){
    $.ajax({
        type: 'POST',
        url: 'actionagency.php',
        data: 'action_type=view&'+$("#taxForm").serialize(),
        success:function(html){
            $('#taxData').html(html);
        }
    });
}

function actionagency(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var taxData = '';
    if (type == 'add') {
        taxData = $("#addForm").find('.form').serialize()+'&action_type='+type+'&id='+id;
    }else if (type == 'edit'){
        taxData = $("#editForm").find('.form').serialize()+'&action_type='+type;
    }else{
        taxData = 'action_type='+type+'&id='+id;
    }
    $.ajax({
        type: 'POST',
        url: 'actionagency.php',
        data: taxData,
        success:function(msg){
            if(msg !== 'ok'){
                alert('tax data has been '+statusArr[type]+' successfully.');
                gettaxs();
                $('.form')[0].reset();
                $('.formData').slideUp();
            }else{
                alert('Some problem occurred, please try again.');
            }
        }
    });
}

function editagency(id){
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'actionagency.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
            $('#agency_name_edit').val(data.agency_name);
            $('#agency_status_edit').val(data.agency_status);
            $('#editForm').slideDown();
        }
    });
}
</script>