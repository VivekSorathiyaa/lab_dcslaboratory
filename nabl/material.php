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
					MATERIAL MASTER 
						
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
							<div class="panel-heading">Material <a href="javascript:void(0);" class="glyphicon glyphicon-plus" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Add</a></div>
							<div class="panel-body none formData" id="addForm">
								<h2 id="actionLabel">Add Material</h2>
								<form class="form" id="mtForm">
									<div class="box-body">	
										<div class="form-group">
											<div class="col-md-6">
												<label>Material Category</label>
												<select class="form-control col-md-7 col-xs-12" name="sel_mt_category" id="sel_mt_category">
													<option value="">Select Category</option>
													<?php
															include 'DB.php';
															$db = new DB();
															$cat_mts = $db->getRows('material_category',array('order_by'=>'material_cat_id DESC'));
															if(!empty($cat_mts)){
															foreach($cat_mts as $one_cat){
																if($one_cat['material_cat_isdelete']==0){
													?>
													<option value="<?php echo $one_cat['material_cat_id']?>"> 
													<?php echo $one_cat['material_cat_name']?>
													</option>
													<?php } } } ?>
												</select>
											</div>
											<div class="col-md-6">
												<label>Material Name</label>
												<input type="text" class="form-control" name="mt_name" id="mt_name"/>
											</div>
										</div>	
									</div>
									<div class="box-body">	
										<div class="form-group">
											<div class="col-md-6">
												<label>File Name</label>
												<input type="text" class="form-control" name="filename" id="filename"  required />	
												<input type="hidden" class="form-control" name="per_day_limit" id="per_day_limit" value="0" required />			
											</div>
											<div class="col-md-6">
													<label>Prefix (FOR REPORT)</label>
													<input type="text" class="form-control" name="prefix" id="prefix" required />			
											</div>	
										</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
												
												<div class="col-md-6">
													<label>File Name For Save</label>
													<input type="text" class="form-control" name="filename_lab" id="filename_lab"  required />			
												</div>
												<div class="col-md-6">
													<label>Table Name</label>
													<input type="text" class="form-control" name="table_name" id="table_name"  required />			
												</div>
												
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
												
												<div class="col-md-6">
													<label>REPORT URL</label>
													<input type="text" class="form-control" name="print_report" id="print_report"  required />			
												</div>
												<div class="col-md-6">
													<label>BACK SHEET URL</label>
													<input type="text" class="form-control" name="print_back" id="print_back"  required />			
												</div>
												
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
												
												<div class="col-md-4">
													<label>OTHER RATE</label>
													<input type="text" class="form-control" name="rate_other" id="rate_other"  required />			
												</div>
												<div class="col-md-4">
													<label>GOVT. RATE</label>
													<input type="text" class="form-control" name="rate_govt" id="rate_govt"  required />			
												</div>
												<div class="col-md-2">
													<label>PRIVATE RATE</label>
													<input type="text" class="form-control" name="rate_private" id="rate_private"  required />			
												</div>
												
												<div class="col-md-2">
													<label>IN NABL</label>
													<select name="sel_nabl" id="sel_nabl" class="form-control">
													<option value="no">NO</option>
													<option value="yes">YES</option>
													</select>
												</div>
												
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
												<div class="box-footer">
													<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
													<a href="javascript:void(0);" class="btn btn-success" onclick="mtAction('add')">Add Material</a>
												</div>
											</div>
									</div>				
								</form>
							</div>
							<div class="panel-body none formData" id="editForm">
								<h2 id="actionLabel">Edit Material</h2>
								<form class="form" id="mtForm">
								
								    <div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>Material Category</label>
													<select class="form-control col-md-7 col-xs-12" name="sel_mt_category_edit" id="sel_mt_category_edit">
													<option value="">Select Category</option>
													<?php
										
										$cat_mts = $db->getRows('material_category',array('order_by'=>'material_cat_id DESC'));
										if(!empty($cat_mts)){
										foreach($cat_mts as $one_cat){
											if($one_cat['material_cat_isdelete']==0){
											?>
										<option value="<?php echo $one_cat['material_cat_id']?>"> 
										<?php echo $one_cat['material_cat_name']?>
										</option>
										<?php } } } ?>
									</select>
												</div>
												
												<div class="col-md-6">
													<label>Material Name</label>
													<input type="text" class="form-control" name="mt_name_edit" id="mt_name_edit"/>
												</div>
												
											</div>	
									</div>
									
									<div class="box-body">	
											<div class="form-group">
												
												<div class="col-md-6">
													<label>File Name</label>
													<input type="text" class="form-control" name="filename_edit" id="filename_edit"  required />	
													<input type="hidden" class="form-control" name="per_day_limit_edit" id="per_day_limit_edit" value="0" required />			
												</div>
												<div class="col-md-6">
													<label>Prefix(FOR REPORT)</label>
													<input type="text" class="form-control" name="prefix_edit" id="prefix_edit"  required />			
												</div>
												
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>File Name For Save</label>
													<input type="text" class="form-control" name="filename_lab_edit" id="filename_lab_edit"  required />			
												</div>
												<div class="col-md-6">
													<label>Table Name</label>
													<input type="text" class="form-control" name="table_name_edit" id="table_name_edit"  required />			
												</div>
												
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
												<div class="col-md-6">
													<label>REPORT URL</label>
													<input type="text" class="form-control" name="print_report_edit" id="print_report_edit"  required />			
												</div>
												<div class="col-md-6">
													<label>BACK SHEET URL</label>
													<input type="text" class="form-control" name="print_back_edit" id="print_back_edit"  required />			
												</div>
												
											</div>	
									</div>
									<div class="box-body">	
											<div class="form-group">
												
												<div class="col-md-4">
													<label>OTHER RATE</label>
													<input type="text" class="form-control" name="rate_other_edit" id="rate_other_edit"  required />			
												</div>
												<div class="col-md-4">
													<label>GOVT. RATE</label>
													<input type="text" class="form-control" name="rate_govt_edit" id="rate_govt_edit"  required />			
												</div>
												<div class="col-md-2">
													<label>PRIVATE RATE</label>
													<input type="text" class="form-control" name="rate_private_edit" id="rate_private_edit"  required />			
												</div>
												
												<div class="col-md-2">
												<label>IN NABL</label>
													<select name="edit_sel_nabl" id="edit_sel_nabl" class="form-control">
													<option value="no">NO</option>
													<option value="yes">YES</option>
													</select>		
												</div>
												
											</div>	
									</div>
									
									<div class="box-body">	
										<div class="form-group">
											<div class="box-footer">
												<input type="hidden" class="form-control" name="id" id="idEdit"/>
												<a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
												<a href="javascript:void(0);" class="btn btn-success" onclick="mtAction('edit')">Update Material</a>
											</div>
										</div>
									</div>
								</form>
							</div>
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>ACTION</th>
										<th>Material Name</th>
										<th>Material category</th>
										<!--<th>Test Limit Per Day</th>
										<th>Prefix</th>-->
										<th>File Name</th>
										<th>File Name For Save</th>
										<th>Table Name</th>
										<th>REPORT URL</th>
										<th>BACK URL</th>
										<th>IN NABL</th>
										<th>OTHER RATE</th>
										<th>PRIAVATE RATE</th>
										<th>GOVT RATE</th>
			
									</tr>
								</thead>
								<tbody id="mtData">
									<?php
										//include 'DB.php';
										//$db = new DB();
										$mts = $db->getRows('material',array('order_by'=>'mt_name ASC'));
										if(!empty($mts)): $count = 0; foreach($mts as $mt): $count++;
					
									?>
									<?php
										if($mt['mt_status'] == 1){
										$sel_cate="select * from material_category where material_cat_id=".$mt['mat_category_id'];
										$get_category= mysqli_fetch_array(mysqli_query($conn,$sel_cate));
										
									?>
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td class="d-flex gap-1">
										
											<a href="set_material_wise_test.php?m_c_id=<?php echo base64_encode($mt['mat_category_id']."|".$mt['id']);?>" target="" title="Add Test" class="glyphicon glyphicon-filter"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editmt('<?php echo $mt['id']; ?>')" title=" Edit Material"></a>
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?mtAction('delete','<?php echo $mt['id']; ?>'):false;" title="Delete Material"></a>
										</td>
										<td><?php echo $mt['mt_name']; ?></td>
										<td><?php echo $get_category['material_cat_name']; ?></td>
										<!--<td><?php //echo $mt['per_day_limit']; ?></td>
										<td><?php //echo $mt['mt_prefix']; ?></td>-->
										<td><?php echo $mt['filename']; ?></td>
										<td><?php echo $mt['filename_lab']; ?></td>
										<td><?php echo $mt['table_name']; ?></td>
										<td><?php echo $mt['print_report']; ?></td>
										<td><?php echo $mt['print_back']; ?></td>
										<td><?php echo $mt['in_nabl']; ?></td>
										<td><?php echo $mt['rate_other']; ?></td>
										<td><?php echo $mt['rate_private']; ?></td>
										<td><?php echo $mt['rate_govt']; ?></td>
										
									</tr>
										<?php }endforeach; else: ?>
									<tr><td colspan="5">No mt(s) found......</td></tr>
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
        url: 'mtAction.php',
        data: 'action_type=view&'+$("#mtForm").serialize(),
        success:function(html){
            $('#mtData').html(html);
        }
    });
}

function mtAction(type,id){
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
        url: 'mtAction.php',
        data: mtData,
        success:function(msg){
            if(msg == 'ok'){
				swal('Congratulations!', 'Material data has been '+statusArr[type]+' successfully.', 'success');

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
        url: 'mtAction.php',
        data: 'action_type=data&id='+id,
        success:function(data){
            $('#idEdit').val(data.id);
			$('#sel_mt_category_edit').val(data.mat_category_id).prop('selected', true);
            $('#mt_name_edit').val(data.mt_name);
            $('#prefix_edit').val(data.mt_prefix);
            $('#filename_edit').val(data.filename);
            $('#filename_lab_edit').val(data.filename_lab);
            $('#table_name_edit').val(data.table_name);
            $('#print_report_edit').val(data.print_report);
            $('#print_back_edit').val(data.print_back);
            $('#per_day_limit_edit').val(data.per_day_limit);
            $('#rate_other_edit').val(data.rate_other);
            $('#rate_private_edit').val(data.rate_private);
            $('#rate_govt_edit').val(data.rate_govt);
            $('#edit_sel_nabl').val(data.in_nabl).prop('checked', true);
            $('#editForm').slideDown();
        }
    });
}


</script>