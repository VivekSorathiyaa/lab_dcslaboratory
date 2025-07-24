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
					MATERIAL CATEGORY MASTER
						
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
							<div class="panel-heading">Material Category Master <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
							<div class="panel-body none formData" id="addForm">
								<h2 id="actionLabel">Add Material Category</h2>
								<form class="form" id="mtForm">
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Material Category Name</label>
													<input type="text" class="form-control" name="material_catname" id="material_catname"/>
												</div>
												<div class="col-md-6">
													<label>Material Category Prefix</label>
													<input type="text" class="form-control" name="prefix" id="prefix"/>
												</div>
												
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">												
												<div class="col-md-6">
													<label>Engineer</label>
													<select class="form-control col-md-7 col-xs-12" name="engineer" id="engineer">
														<option  value="0">Select Enginner</option>
														<?php
														$sel_staff="select * from multi_login where `staff_isadmin`='4' AND `staff_isdeleted`=0";
														$query_staff=mysqli_query($conn,$sel_staff);
														if(mysqli_num_rows($query_staff)>0)
														{
															while($one_staff=mysqli_fetch_array($query_staff))
															{ ?>
															<option  value="<?php echo $one_staff['id'];?>"><?php echo $one_staff['staff_fullname'];?></option>	
															<?php }
														}
														?>
														<option  value="420">BILLER</option>
													</select>			
												</div>
												<div class="col-md-6">
													<label>Category Status</label>
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
													<a href="javascript:void(0);" class="btn btn-success" onclick="mate_catAction('add')">Add Material Category</a>
												</div>
											</div>
									</div>				
								</form>
							</div>
							<div class="panel-body none formData" id="editForm">
								<h2 id="actionLabel">Edit Material Category</h2>
								<form class="form" id="mtForm">
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Material Category Name</label>
													<input type="text" class="form-control" name="mate_catname_edit" id="mate_catname_edit"/>
												</div>
												<div class="col-md-6">
													<label>Material Category Prefix</label>
													<input type="text" class="form-control" name="prefix_edit" id="prefix_edit"/>
												</div>
												
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
											    <div class="col-md-6">
													<label>Engineer</label>
													<select class="form-control col-md-7 col-xs-12" name="engineer_edit" id="engineer_edit">
														<option  value="0">Select Enginner</option>
														<?php
														$sel_staff="select * from multi_login where `staff_isadmin`='4' AND `staff_isdeleted`=0";
														$query_staff=mysqli_query($conn,$sel_staff);
														if(mysqli_num_rows($query_staff)>0)
														{
															while($one_staff=mysqli_fetch_array($query_staff))
															{ ?>
															<option  value="<?php echo $one_staff['id'];?>"><?php echo $one_staff['staff_fullname'];?></option>	
															<?php }
														}
														?>
														<option  value="420">BILLER</option>
													</select>			
												</div>
												<div class="col-md-6">
													<label>Material Category Status</label>
													<select class="form-control col-md-7 col-xs-12" name="mate_status_edit" id="mate_status_edit">
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
												<a href="javascript:void(0);" class="btn btn-success" onclick="mate_catAction('edit')">Update Category</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Material Category Name</th>
										<th>Material Category Prefix</th>
										<th>Material Category Engineer</th>
										<th>Material Category Status</th>
						</tr>
								</thead>
								<tbody id="mtData">
									<?php
										include 'DB.php';
										$db = new DB();
										$mts = $db->getRows('material_category',array('order_by'=>'material_cat_id DESC'));
										if(!empty($mts)): $count = 0; foreach($mts as $mt): $count++;
										$sel_staff_name="select * from multi_login where `id`=$mt[material_engineer] AND `staff_isdeleted`=0";
										$query_staff_name=mysqli_query($conn,$sel_staff_name);
										$one_staff_name=mysqli_fetch_array($query_staff_name);
					                     if($mt['material_cat_isdelete']==0){
									?>
									
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td><?php echo $mt['material_cat_name']; ?></td>
										<td><?php echo $mt['cat_prefix']; ?></td>
										<td>
										<?php 
										if($one_staff_name['staff_fullname'] != ""){
										echo $one_staff_name['staff_fullname'];
										}else{
											echo "BILLER";
										}										
										?>
										</td>
										<td><?php if($mt['material_cat_status'] == 1) {echo "Activate";}else{echo "Deactivate";}?></td>
										<td>
										
											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editmt('<?php echo $mt['material_cat_id']; ?>')"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?mate_catAction('delete','<?php echo $mt['material_cat_id']; ?>'):false;"></a>
										</td>
									</tr>
										<?php } endforeach; ?>
									
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
        url: 'material_catAction.php',
        data: 'action_type=view&'+$("#mtForm").serialize(),
        success:function(html){
            $('#mtData').html(html);
        }
    });
}

function mate_catAction(type,id){
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
        url: 'material_catAction.php',
        data: mtData,
        success:function(msg){
			location.reload();
            if(msg == 'ok'){
				swal('Congratulations!', 'Category data has been '+statusArr[type]+' successfully.', 'success');

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
        url: 'material_catAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.material_cat_id);
            $('#mate_catname_edit').val(data.material_cat_name);
            $('#prefix_edit').val(data.cat_prefix);
            $('#engineer_edit').val(data.material_engineer);
            $('#mate_status_edit').val(data.material_cat_status);
            $('#editForm').slideDown();
        }
    });
}


</script>