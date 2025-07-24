
<?php 
session_start(); 
include("header.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="<?php echo $base_url; ?>index.php";
	</script>
	<?php
}

if(isset($_POST["subs"]))
{
	$titles=$_POST["titles"];
	$txt_msg=$_POST["txt_msg"];
   $sql = "INSERT into text_msg (title,msg) values ('$titles','$txt_msg')";
    $result = mysqli_query($conn, $sql);
      header("Refresh:0"); 
}


?>

<style>
.form-control { 
font-size: 17px;; 
}

/* only for 3d button effects */

.


.btn-primary {
    box-shadow:0 0 0 1px #428bca inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#428bca;


</style>

<div class="content-wrapper" style="margin-left: 0px !important;">

	<!-- Content Header (Page header) -->

	<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
	<?php include("menu.php") ?>
	<div class="row">
		
		<h1 style="text-align:center;">
		Add Message
		</h1>
	</div>
	<div class="row">
			<div class="col-md-12">
			<?php include("whatsapp_menu.php") ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<div class="box box-info">
				<div class="col-md-12">
			<div class="nav-tabs-custom">
				<div class="tab-content">
					<div class="active tab-pane" id="clients">
					<div class="add_class">
					<form method="post" enctype="multipart/form-data">
					   <div class="row">
									<div class="col-md-12">
										<input type="text" class="form-control select2" name="titles" id="" placeholder="Please Enter Title" required style="width:200px;"><br>
										<textarea name="txt_msg" id="" placeholder="Please Enter Body Text" required style="min-width:400px;" rows="10">
										</textarea>
										<br>
										<input type="submit" class="btn btn-primary" name="subs" value="Submit">
									</div>
					</div>
					</form>
					</div>
					
					<div class="edit_class" style="display:none;">
					<form method="post" enctype="multipart/form-data">
					   <div class="row">
									<div class="col-md-12">
										<input type="text" class="form-control select2" name="edit_titles" id="titles" placeholder="Please Enter Title" required style="width:200px;"><br>
										<textarea name="edit_txt_msg" id="txt_msg" placeholder="Please Enter Body Text" required style="min-width:400px;" rows="10">
										</textarea>
										<input type="text" name="edit_ids" id="edit_ids">
										<br>
										<input type="submit" class="btn btn-primary" name="edit_subs" value="Submit">
									</div>
					</div>
					</form>
					</div>
					<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
						<thead>
							<tr>
								<th style="text-align:center;">Serial No</th>
								<th style="text-align:center;">Title</th>
								<th style="text-align:center;">Message</th>
								<th style="text-align:center;">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sele_materials="select * from text_msg where `is_deleted`=0";
						$result_materials = mysqli_query($conn,$sele_materials);
						if(mysqli_num_rows($result_materials)>0)
						{
							$counting=1;
							while($row_materials =mysqli_fetch_array($result_materials))
							{
							?>
									<tr>	
										<td><?php echo $counting;?></td>
										<td><?php echo $row_materials["title"]?></td>
										<td><?php echo $row_materials["msg"]?></td>
										<td>
										<a href="javascript:void(0);" class="btn btn-success get_data" data-id="<?php echo $row_materials["msg_id"]?>">Edit</a>
										<a href="javascript:void(0);" class="btn btn-danger delete_data" data-id="<?php echo $row_materials["msg_id"]?>">Delete</a>
										
										
										</td>
										
									</tr>	
									<?php 
									$counting++;
									
								
							
							
							}
						}
						?>
					</tbody>
					</table>
					</div>
			 
					<!-- /.tab-pane -->

					</div>
				<!-- /.tab-content -->
			</div>
          <!-- /.nav-tabs-custom -->
        </div>
</section>
</div>
</div>	
<?php include("footer.php");?>
<script>
$(document).on("click",".delete_data",function(){
	var ids= $(this).attr("data-id");
	billData = '&action_type=delete_txt_msg&ids='+ids;
	if(confirm("Are You Sure To Delete..?"))
	{
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>search_whatsapp.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},		
        success: function(msg,status, xhr){
		document.getElementById("overlay_div").style.display="none";
		alert("Successfully Deleted");
		window.location.href="add_msg.php";
		}
    });
}
	
})

$(document).on("click",".get_data",function(){
	var ids= $(this).attr("data-id");
	billData = '&action_type=get_data&ids='+ids;
	
	$.ajax({
         type: 'POST',
        url: '<?php $base_url; ?>search_whatsapp.php',
        data: billData,
		dataType:'JSON',
        success:function(msg){
          
		  alert("kk");
        }
    });

	
})
</script>