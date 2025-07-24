
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




?>


<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}

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
		Whatsapp Campaign
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
					<form class="" method="post" >
					   <div class="row">
									<div class="col-md-2">
									<label>File Number</label>
										<select name="sel_var" id="sel_var" required class="form-control select2">
										<option value="">Select File Number</option>
										<?php
										$sel_num="select `file_no` from whatapp_msg where `msg_send`=0 GROUP BY file_no";
										$rersults=mysqli_query($conn,$sel_num);
										if(mysqli_num_rows($rersults) > 0){
											while($ones=mysqli_fetch_array($rersults)){ ?>
											<option value="<?php echo $ones['file_no'];?>"><?php echo $ones['file_no'];?></option>	
											<?php }
										}
										?>
										</select>
									</div>
									<div class="col-md-2">
									<label>Msg Title</label>
										<select name="sel_msg" id="sel_msg" required class="form-control select2">
										<option value="">Select Message Title</option>
										<?php
										$sel_num="select * from text_msg where `is_deleted`=0";
										$rersults=mysqli_query($conn,$sel_num);
										if(mysqli_num_rows($rersults) > 0){
											while($ones=mysqli_fetch_array($rersults)){ ?>
											<option value="<?php echo $ones['msg_id'];?>"><?php echo $ones['title'];?></option>	
											<?php }
										}
										?>
										</select>
									</div>
									
									<div class="col-md-2">
									<label>Time In Second</label>
										<input type="text" class="form-control" name="txt_time" id="txt_time" placeholder="Enter Time In Second" value="10" required>
									</div>
									<div class="col-md-2">	
									<label style="color:white;">Time In Second</label>									
										<button type="button" class="btn btn-info"  onclick="search_agency('search')" name="btn_add_data" id="btn_add_data" style="width:100%" ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
									</div>
									
								
																										
					</div>
					<hr width="80%">
					
					<br>
					<div class="row">
						<div id="display_data">
						
						</div>
					</div>
						
					</form>
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
$(document).ready(function(){
	$(".class_submit").hide();
})

// add data
function search_agency(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    var error_msg = '';
    if (type == 'search') 
	{
				var sel_var = $('#sel_var').val(); 
				var sel_msg = $('#sel_msg').val(); 
				var txt_time = $('#txt_time').val(); 
				
				if(sel_var ==""){
				error_msg += 'Please Select File Number\n';	
				}
				if(sel_msg ==""){
				error_msg += 'Please Select Message Title\n';	
				}
				if(txt_time ==""){
				error_msg += 'Please Enter Time';	
				}
				
			if(error_msg=="")
			{
				billData = '&action_type='+type+'&sel_var='+sel_var;
				$.ajax({
					type: 'POST',
					url: '<?php $base_url; ?>search_whatsapp.php',
					data: billData,
					beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
					},		
					success: function(msg,status, xhr){
					document.getElementById("overlay_div").style.display="none";
					
					$("#display_data").html(msg);
				
					//$(".class_submit").show();
					
					}
				});
			}else{
				alert(error_msg)
				return false;
			}
}
}

$(document).on("click",".delete_data",function(){
	var ids= $(this).attr("data-id");
	billData = '&action_type=delete_data&ids='+ids;
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
		alert("sSuccessfully Deleted");
		window.location.href="whatsapp.php";
		}
    });
}
	
})

$(document).on("change","#chk_all", function(){
	if($("#chk_all").prop('checked') == true)
	{
		$('input:checkbox').not(this).prop('checked', this.checked);
	}else{
		$('input:checkbox').not(this).prop('checked', this.checked);
		
	}
})

$(document).on("change",".chk_number", function(){
	if($(this).prop('checked') == false)
	{
		$("#chk_all").not(this).prop('checked', this.checked);
	}
})

$(document).on("click","#save_for_whts", function(){
	
				var sel_var = $('#sel_var').val(); 
				var sel_msg = $('#sel_msg').val(); 
				var txt_time = $('#txt_time').val(); 
				var error_msg = ""; 
				
				if(sel_var ==""){
				error_msg += 'Please Select File Number\n';	
				}
				if(sel_msg ==""){
				error_msg += 'Please Select Message Title\n';	
				}
				if(txt_time ==""){
				error_msg += 'Please Enter Time';	
				}
				var chk_number_arrray=[];
				$('input:checkbox.chk_number').each(function () {
				if(this.checked){
					chk_number_arrray.push($(this).val());
				}
				
				});
				
				if (chk_number_arrray.length === 0) {
					error_msg += 'Please Select Atleast One Record';
				}
				
			if(error_msg=="")
			{
				billData = '&action_type=save_for_whts&sel_var='+sel_var+'&sel_msg='+sel_msg+'&txt_time='+txt_time+'&chk_number_arrray='+chk_number_arrray;
				$.ajax({
					type: 'POST',
					url: '<?php $base_url; ?>search_whatsapp.php',
					data: billData,
					beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
					},		
					success: function(msg,status, xhr){
					document.getElementById("overlay_div").style.display="none";
					alert("Successfully Saved To Send");
					window.location.href="campaign.php";
					
					
					}
				});
			}else{
				alert(error_msg)
				return false;
			}
})

$(document).on("click","#update_links", function(){
	
				var url_links = $('#url_links').val(); 
				var txt_api = $('#txt_api').val(); 
				var error_msg = ""; 
				
				if(url_links ==""){
				error_msg += 'Please Enter Whatsapp Link\n';	
				}
				if(txt_api ==""){
				error_msg += 'Please Enter  Whatsapp Api\n';	
				}
			if(error_msg=="")
			{
				billData = '&action_type=update_links&url_links='+url_links+'&txt_api='+txt_api;
				$.ajax({
					type: 'POST',
					url: '<?php $base_url; ?>search_whatsapp.php',
					data: billData,
					beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
					},		
					success: function(msg,status, xhr){
					document.getElementById("overlay_div").style.display="none";
					//alert("Successfully Saved To Send");
					//window.location.href="campaign.php";
					}
				});
			}else{
				alert(error_msg)
				return false;
			}
})

$(document).on("click","#try_id", function(){
	
				var error_msg = ""; 
				
			if(error_msg=="")
			{
				billData = '&action_type=try_id';
				$.ajax({
					type: 'POST',
					url: '<?php $base_url; ?>send_messages.php',
					data: billData,
					beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
					},		
					success: function(msg,status, xhr){
					document.getElementById("overlay_div").style.display="none";
					//alert("Successfully Saved To Send");
					//window.location.href="campaign.php";
					alert(msg);
					}
				});
			}else{
				alert(error_msg)
				return false;
			}
})

</script>
