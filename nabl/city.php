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
					CITY MASTER
						
					</h1>
				</div>
			<div class="row" style="margin: 0px 0px 0px 0px;">
			<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
						
						<!-- /.box-header -->
						<!-- form start -->
						<div class="panel panel-default citys-content">
							<div class="panel-heading">Cities <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
							<div class="panel-body none formData" id="addForm">
								<h2 id="actionLabel">Add Cities</h2>
								<form class="form" id="cityForm">
									<div class="box-body">
										<div class="form-group">
											<div class="col-md-6">
												<label>City Name</label>
												<input type="text" class="form-control" name="city_name" id="city_name"/>
											</div>
											<div class="col-md-6">
												<label>City Status</label>
												<select class="form-control col-md-7 col-xs-12" name="city_status" id="city_status">
													<option  value="0">Activate</option>
													<option value="1">Dectivate</option>
												<select>
											</div>
										</div>
									</div>
									<div class="box-body">	
										<div class="form-group">
											<div class="box-footer">
												<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
												<a href="javascript:void(0);" class="btn btn-success" onclick="cityAction('add')">Add City</a>
											</div>	
										</div>	
									</div>	
								</form>
							</div>
							<div class="panel-body none formData" id="editForm">
								<h2 id="actionLabel">Edit Cities</h2>
								<form class="form" id="cityForm">
									<div class="box-body">
										<div class="form-group">
											<div class="col-md-6">
												<label>City Name</label>
												<input type="text" class="form-control" name="city_name" id="city_name_edit"/>
											</div>
											<div class="col-md-6">
												<label>City Status</label>
												<select class="form-control col-md-7 col-xs-12" name="city_status" id="city_status_edit">
													<option  value="0">Activate</option>
													<option value="1">Dectivate</option>
												<select>
											</div>
										</div>
									</div>
									
									<div class="box-body">	
										<div class="form-group">
											<div class="box-footer">
												<input type="hidden" class="form-control" name="id" id="idEdit"/>
												<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
												<a href="javascript:void(0);" class="btn btn-success" onclick="cityAction('edit')">Update City</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>City Name</th>
										<th>City Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="cityData">
									<?php
										include 'DB.php';
										$db = new DB();
										$citys = $db->getRows('city',array('order_by'=>'id DESC'));
										if(!empty($citys)): $count = 0; foreach($citys as $city): $count++;
											 if($city['city_isdeleted'] == 0){
									?>
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td><?php echo $city['city_name']; ?></td>
										<td><?php if($city['city_status'] == 0) {echo "Activate";}else{echo "Deactivate";}?></td>
										<td>
											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editcity('<?php echo $city['id']; ?>')"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?cityAction('delete','<?php echo $city['id']; ?>'):false;"></a>
										</td>
									</tr>
											<?php } endforeach; else: ?>
									<tr><td colspan="5">No city(s) found......</td></tr>
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
function getcitys(){
    $.ajax({
        type: 'POST',
        url: 'cityAction.php',
        data: 'action_type=view&'+$("#cityForm").serialize(),
        success:function(html){
            $('#cityData').html(html);
        }
    });
}

function cityAction(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var cityData = '';
    if (type == 'add') {
        cityData = $("#addForm").find('.form').serialize()+'&action_type='+type+'&id='+id;
    }else if (type == 'edit'){
        cityData = $("#editForm").find('.form').serialize()+'&action_type='+type;
    }else{
        cityData = 'action_type='+type+'&id='+id;
    }
    $.ajax({
        type: 'POST',
        url: 'cityAction.php',
        data: cityData,
        success:function(msg){
            if(msg == 'ok'){
				swal('Congratulations!', 'City has been '+statusArr[type]+' successfully.', 'success');

                getcitys();
                $('.form')[0].reset();
                $('.formData').slideUp();
				
			}
			else{
				swal('Error!', 'Some problem occurred, please try again.', 'error');
            }
		}
    });
}

function editcity(id){
    $.ajax({
        type: 'POST',
        dataType:'JSON',
        url: 'cityAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
            $('#city_name_edit').val(data.city_name);
            $('#city_status_edit').val(data.city_status);
            $('#editForm').slideDown();
        }
    });
}

</script>