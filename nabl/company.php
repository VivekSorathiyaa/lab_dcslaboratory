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
				Staff Master
				
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
						<div class="panel panel-default taxs-content">
							<div class="panel-heading">Staff <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
							<div class="panel-body none formData" id="addForm">
								<h2 id="actionLabel">Add Staff</h2>
								<form class="form" id="taxForm">
									<div class="form-group">
										<div class="col-md-6">
											<label>Staff Fullame</label>
											<input type="text" class="form-control" name="staff_fullname" id="staff_fullname"/>
										</div>	
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<label>Staff Date Of Birth</label>
											<input type="text" class="form-control" name="staff_dob" id="staff_dob"/>
										</div>	
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<label>Staff Gender</label>
											<input name="staff_gender" id="staff_gender" type="radio" value="Male">Male
											<input name="staff_gender" id="staff_gender" type="radio" value="Female">Female
										</div>	
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<label>Staff Contact Number</label>
											<input type="text" class="form-control" name="staff_contactno" id="staff_contactno"/>
										</div>	
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<label>Company MD Name</label>
											<input type="email" class="form-control" name="staff_email" id="staff_email"/>
										</div>	
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<label>Company MD Name</label>
											<input type="text" class="form-control" name="com_mdname" id="com_mdname"/>
										</div>	
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<label>Company MD Name</label>
											<input type="text" class="form-control" name="com_mdname" id="com_mdname"/>
										</div>	
									</div>
									
									
									<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
									<a href="javascript:void(0);" class="btn btn-success" onclick="taxAction('add')">Add Tax</a>
								</form>
							</div>
							<div class="panel-body none formData" id="editForm">
								<h2 id="actionLabel">Edit Tax</h2>
								<form class="form" id="taxForm">
									<div class="form-group">
										<label>Tax CGST</label>
										<input type="text" class="form-control" name="tax_cgst" id="tax_cgst_edit"/>
									</div>
									<div class="form-group">
										<label>Tax SGST</label>
										<input type="text" class="form-control" name="tax_sgst" id="tax_sgst_edit"/>
									</div>
									<div class="form-group">
										<label>Tax IGST</label>
										<input type="text" class="form-control" name="tax_igst" id="tax_igst_edit"/>
									</div>
									<input type="hidden" class="form-control" name="id" id="idEdit"/>
									<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
									<a href="javascript:void(0);" class="btn btn-success" onclick="taxAction('edit')">Update Tax</a>
								</form>
							</div>
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Tax CGST</th>
										<th>Tax SGST</th>
										<th>Tax IGST</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="taxData">
									<?php
										include 'DB.php';
										$db = new DB();
										$taxs = $db->getRows('tax',array('order_by'=>'id DESC'));
										if(!empty($taxs)): $count = 0; foreach($taxs as $tax): $count++;
									?>
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td><?php echo $tax['tax_cgst']; ?></td>
										<td><?php echo $tax['tax_sgst']; ?></td>
										<td><?php echo $tax['tax_igst']; ?></td>
										<td>
											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="edittax('<?php echo $tax['id']; ?>')"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?taxAction('delete','<?php echo $tax['id']; ?>'):false;"></a>
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

//include("connection.php");

?>
<script>
function gettaxs(){
    $.ajax({
        type: 'POST',
        url: 'taxAction.php',
        data: 'action_type=view&'+$("#taxForm").serialize(),
        success:function(html){
            $('#taxData').html(html);
        }
    });
}

function taxAction(type,id){
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
        url: 'taxAction.php',
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

function edittax(id){
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'taxAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
            $('#tax_cgst_edit').val(data.tax_cgst);
            $('#tax_sgst_edit').val(data.tax_sgst);
            $('#tax_igst_edit').val(data.tax_igst);
            $('#editForm').slideDown();
        }
    });
}
</script>