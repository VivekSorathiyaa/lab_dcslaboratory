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
					SIGN AUTHORITY MASTER
						
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
							<div class="panel-heading">Sign Authority <a href="add_auth.php" class="glyphicon glyphicon-plus">Add</a></div>
							
							
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Authority Name</th>
										<th>Designation</th>
										<th>Authority Status</th>
										<th>Action</th>
				
									</tr>
								</thead>
								<tbody id="cityData">
									<?php
										$sel_ulr="select * from sign_authority where `is_status`=1";
										$query_ulr=mysqli_query($conn,$sel_ulr);
										if(mysqli_num_rows($query_ulr)>0)
										{
											while($one_year=mysqli_fetch_array($query_ulr))
											{
									?>
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td><?php echo $one_year['auth_name']; ?></td>
										<td><?php echo $one_year['auth_designation']; ?></td>										
										<td><?php if($one_year['is_active'] == "1") {
											echo '<span style="color:green;font-weight:bold;">Activate</span>';
											}else{
											echo '<span style="color:red;font-weight:bold;">Deactivate</span>';
											}?></td>
										<td>
											<a href="javascript:void(0);" class="glyphicon glyphicon-thumbs-up set_active" data-id="<?php echo $one_year['id'];?>"></a>
											
											<a href="edit_auth.php?auth_ids=<?php echo base64_encode($one_year['id']);?>" class="glyphicon glyphicon-edit"></a>
											
											<!--<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_year" data-id="<?php// echo $one_year['id'];?>" onclick="return confirm('Are you sure?')"></a>-->
										</td>
									</tr>
										<?php } }else{  ?>
									<tr><td colspan="5">No Data(s) found......</td></tr>
									<?php } ?>
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
$(document).on("click",".delete_year",function(){

var type= "delete";
var dele_id= $(this).attr("data-id");
billData = '&action_type='+type+'&dele_id='+dele_id;
$.ajax({
	type: 'POST',
	url: '<?php $base_url; ?>save_sign_auth.php',
	data: billData,
	beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
	},
	success:function(msg){
		document.getElementById("overlay_div").style.display="none";
		window.location.href="<?php echo $base_url; ?>sign_auth.php";				  
	}														
	});	

});

$(document).on("click",".set_active",function(){

var type= "set_active";
var set_active= $(this).attr("data-id");
billData = '&action_type='+type+'&set_active='+set_active;
$.ajax({
	type: 'POST',
	url: '<?php $base_url; ?>save_sign_auth.php',
	data: billData,
	beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
	},
	success:function(msg){
		document.getElementById("overlay_div").style.display="none";
		window.location.href="<?php echo $base_url; ?>sign_auth.php";				  
	}														
	});	

});



</script>