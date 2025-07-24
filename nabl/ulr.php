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
					ULR MASTER
						
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
							<div class="panel-heading">Cities <a href="add_ulr.php" class="glyphicon glyphicon-plus">Add</a></div>
							
							
							<table class="table table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Ulr No</th>
										<th>Ulr Status</th>
										<th>Action</th>
				
									</tr>
								</thead>
								<tbody id="cityData">
									<?php
										$sel_ulr="select * from ulr_no where `ulr_is_deleted`=0";
										$query_ulr=mysqli_query($conn,$sel_ulr);
										if(mysqli_num_rows($query_ulr)>0)
										{
											while($one_ulr=mysqli_fetch_array($query_ulr))
											{
									?>
									<tr>
										<td><?php echo '#'.$count; ?></td>
										<td><?php echo $one_ulr['ulr_no']; ?></td>
										<td><?php if($one_ulr['ulr_status'] == 0) {
											echo '<span style="color:green;font-weight:bold;">Activate</span>';
											}else{
											echo '<span style="color:red;font-weight:bold;">Deactivate</span>';
											}?></td>
										<td>
											<a href="javascript:void(0);" class="glyphicon glyphicon-thumbs-up set_active" data-id="<?php echo $one_ulr['ulr_id'];?>"></a>
											
											<a href="edit_ulr.php?ulr_ids=<?php echo base64_encode($one_ulr['ulr_id']);?>" class="glyphicon glyphicon-edit"></a>
											
											<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_ulr" data-id="<?php echo $one_ulr['ulr_id'];?>" onclick="return confirm('Are you sure?')"></a>
										</td>
									</tr>
										<?php } }else{  ?>
									<tr><td colspan="5">No Ulr(s) found......</td></tr>
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
$(document).on("click",".delete_ulr",function(){

var type= "delete";
var dele_id= $(this).attr("data-id");
billData = '&action_type='+type+'&dele_id='+dele_id;
$.ajax({
	type: 'POST',
	url: '<?php $base_url; ?>save_ulr.php',
	data: billData,
	beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
	},
	success:function(msg){
		document.getElementById("overlay_div").style.display="none";
		window.location.href="<?php echo $base_url; ?>ulr.php";				  
	}														
	});	

});

$(document).on("click",".set_active",function(){

var type= "set_active";
var set_active= $(this).attr("data-id");
billData = '&action_type='+type+'&set_active='+set_active;
$.ajax({
	type: 'POST',
	url: '<?php $base_url; ?>save_ulr.php',
	data: billData,
	beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
	},
	success:function(msg){
		document.getElementById("overlay_div").style.display="none";
		window.location.href="<?php echo $base_url; ?>ulr.php";				  
	}														
	});	

});



</script>