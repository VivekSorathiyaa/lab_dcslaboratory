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
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}



</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   
  
<section class="content" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
	<div class="row">
		
		<h1 style="text-align:center;">
		Desktop Images
		</h1>
	</div>
	<div class="row">
			<div class="col-xs-12">
				<div class="box box-info">
					
					<!-- /.box-header -->
						
						
							<div class="box-body">
								<a class="btn btn-primary" href="add_desktop_images.php">Add Gallery</a>
								
								<hr style="border-top: 1px solid;">

								<br>
								<div id="display_data">
									<table id="example1" class="table table-bordered table-striped" style="width:100%;">
										<thead>
										<tr>
											<th style="text-align:center;">Sr No.</th>
											<th style="text-align:center;">Images</th>
											<th style="text-align:center;">Action</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
											$count=0;
											$query="select * from desktop_images ORDER BY desk_img_id DESC";
											$result=mysqli_query($conn,$query);
											while($row=mysqli_fetch_array($result))
											{
												$count++;
											
										?>
												<tr id="tr_<?php echo $row['desk_img_id'];?>">
												<td style="text-align:center;"><?php echo $count;?></td>
												<td style="text-align:center;">
												<img src="../images/desk_gallery/<?php echo $row['desk_img'];?>" width="50" height="50">
												</td>
												
												<td style="text-align:center;">
												 
												 <a href="javascript:void(0)" class="btn_delete" data-id="<?php echo $row['desk_img_id'];?>">
												 Delete
												 </a>
												</td>
												
												
											</tr>
										<?php
											}	
										?>
									</tbody>
									<tfoot>
								   <tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										
									</tr>
									 <tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										
									</tr>
								   </tfoot>
									
								  </table>
									
								</div>
							</div>
					<!-- /.box-body -->
					</div>
				</div>
	</div>
	
	<br>
</section>	
</div>  
	
<?php include("footer.php");?>		  

<script>


 $(document).on("click", ".btn_delete", function () {
				var clicked_id = $(this).attr("data-id");  
				var set_tr_id="#tr_"+clicked_id;
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Images?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>delete_desk_image.php',
        data: 'action_type=delete_desk_image&clicked_id='+clicked_id,
        success:function(){
			$(set_tr_id).remove();
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

</script>
