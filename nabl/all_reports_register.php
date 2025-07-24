
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
		REPORTS REGISTER
		</h1>
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
									<div class="col-md-12">
										<select class="form-control select2 col-sm-12" tabindex="6"  data-placeholder="Select Material" id="sel_material" name="sel_material">
											<option value="">Select Material</option>
											<?php
											$select_query = "select * from material WHERE `mt_isdeleted`='0'";
											$result_select = mysqli_query($conn,$select_query);
											if(mysqli_num_rows($result_select)>0)
											{
											    while($row_users =mysqli_fetch_array($result_select))
												{ ?>
													<option value="<?php echo $row_users['id'];?>"><?php echo $row_users['mt_name'];?></option>
												<?php }
											}
											?>
												
										</select>
									</div>
									
								
																										
					</div>
					<br>
					<div class="row">
									
									
									<div class="col-md-4">																			
										<input type="text" class="col-sm-12 form-control" id="fromdate" tabindex="8" name="fromdate" placeholder="FROM DATE (DD/MM/YYYY)">
									</div>
									
									<div class="col-md-4">																			
										<input type="text" class="col-sm-12 form-control" id="todate" tabindex="8" name="todate" placeholder="TO DATE (DD/MM/YYYY)">
									</div>
									
									<div class="col-md-4">																			
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
    if (type == 'search') {
				var sel_material = $('#sel_material').val(); 
				var todate = $('#todate').val(); 
				var fromdate = $('#fromdate').val(); 
				
				billData = '&action_type='+type+'&sel_material='+sel_material+'&todate='+todate+'&fromdate='+fromdate;
				
			
				//exit();
				
    }
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>search_all_reports_register.php',
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
}

</script>
