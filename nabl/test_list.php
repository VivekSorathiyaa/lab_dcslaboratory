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
$gets_variables= base64_decode($_GET["codes"]);

$clicked_id=explode("|",$gets_variables);
$final_mat_id=$clicked_id[0];
$tempo_trf_no=$clicked_id[1];
$mate_names=$clicked_id[2];

$tests="select * from test_wise_material_rate where `final_material_id`='$final_mat_id' AND `temporary_trf_no`='$tempo_trf_no'";
$result_test=mysqli_query($conn,$tests);

?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}





.mede_class{
	color:red;
}
.select2{
	
	width:200px;
}
.visually-hidden {
    position: absolute;
    left: -100vw;
    
    /* Note, you may want to position the checkbox over top the label and set the opacity to zero instead. It can be better for accessibilty on some touch devices for discoverability. */
}

</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   <?php
  //set session job and report no
  ?>
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
				<h1 style="text-align:center;">Test List of <?php echo $mate_names; ?> Material</h1>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-body"  style="border:1px groove #ddd;">
						
						<table class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">test Name</th>
										<th style="text-align:center;">Action</th>
									</tr>
										
								</thead>
								<tbody>
									<?php
										$count=1;
										while($row=mysqli_fetch_array($result_test))
										{
										
										$sel_tests="select `test_name` from test_master where `test_id`=".$row["test_id"];
										$query_test= mysqli_query($conn,$sel_tests);
										$get_test=mysqli_fetch_array($query_test);
										
									?>
										<tr id="tr_<?php echo $row['test_wise_id'];?>">
										<td style="white-space:nowrap;text-align:center;"><?php echo $count;?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $get_test['test_name'];?></td>
										<td style="text-align:center;">
											<button type="button" class="btn btn-info delete_one_test"  id="<?php echo $row['test_wise_id'];?>" name="btn_add_data" style="width:100px;font-size:20px;" >Delete</button>
										</td>
										</tr>
									<?php
									     $count++;
										}	
									?>
								</tbody>
								
							  </table>
						</div>
					</div>
				</div>
			</div>
</section>	
  
	
<?php include("footer.php");?>	  	  
<script>
$(document).on("click",".delete_one_test",function(){
	
	var id= $(this).attr("id");
	var postData = '&action_type=delete_one_test&id='+id;
			
		$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Test?",
        buttons: {
			confirm: function () 
			{
				$.ajax({
						url : "<?php $base_url; ?>span_save_material.php", 
						type: "POST",
						data : postData,
						beforeSend: function(){
							document.getElementById("overlay_div").style.display="block";
						},
						success: function(data)
						 {
							document.getElementById("overlay_div").style.display="none";
							var set_ids= "#tr_"+id;
							$(set_ids).remove();
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
