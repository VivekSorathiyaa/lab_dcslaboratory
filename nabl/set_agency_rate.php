
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

if(isset($_POST["sub_rates"])){
 $achive_agency= $_POST["sel_agency"];	
 $template_number= $_POST["template_number"];	
 

$up_rate_one="update agency_rate_master set `is_active`='1' where `agency`='$achive_agency'";
$query_up_rate_one=mysqli_query($conn,$up_rate_one);
}

$sel_agency_tempalte="select * from agency_rate_master where `is_deleted`='0' ORDER BY `agency_rate_id` DESC";
$query_rtemplate= mysqli_query($conn,$sel_agency_tempalte);

if(mysqli_num_rows($query_rtemplate) >0){
	$get_template= mysqli_fetch_assoc($query_rtemplate);
	
	$set_template_id= intval($get_template["template_code"]) + 1;
	
}else{
	$set_template_id=1;
}

$dele="delete from  agency_rate_master where `is_active`='0'";
mysqli_query($conn,$dele);




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
		Set Agency Rate
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
									
									
									<div class="col-md-4">
										<select class="form-control select2 col-sm-12" tabindex="6"  data-placeholder="Select Agency" id="sel_agency" name="sel_agency">
											<option value="">Select Agency</option>
											<?php
											$get_agency="SELECT *FROM agency_master where `isdeleted`=0";
											$agency = mysqli_query($conn, $get_agency);
											if (mysqli_num_rows($agency) > 0) {
												while($r = mysqli_fetch_array($agency)){?>
												<option value="<?php echo $r["agency_id"]?>"><?php echo $r["agency_name"]?></option>
												<?php } }?>
										</select>
									</div>
									
									<div class="col-md-4">
										<select class="form-control select2 col-sm-12" tabindex="6"  data-placeholder="Rate Type" id="rate_type" name="rate_type">
											<option value="">Select Rate Type</option>
											<option value="0">Government</option>
											<option value="1">Private</option>
										</select>
									</div>
									<div class="col-md-4">																			
										<input type="text" class="col-sm-12 form-control" id="template_code" tabindex="8" name="template_code" placeholder="Template Code" value="<?php echo $set_template_id;?>" disabled>
									</div>
					</div>
					<br>
					<div class="row">
									
									
									<div class="col-md-4">																			
										<input type="text" class="col-sm-12 form-control" id="less" tabindex="8" name="less" placeholder="Less(%)">
									</div>
									
									<div class="col-md-4">																			
										<input type="text" class="col-sm-12 form-control" id="plus" tabindex="8" name="plus" placeholder="Plus(%)">
									</div>
									
									<div class="col-md-4">																			
										<button type="button" class="btn btn-info"  onclick="search_agency('search_agency')" name="btn_add_data" id="btn_add_data" style="width:100%" ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
									</div>
					</div>
					<hr width="80%">
					<br>
					<div class="row">
					<div class="col-md-12">
						<div id="put_exist_agency_data">
							
						</div>
						</div>
					</div>
					<br>
					<div class="row">
				
						<div id="display_data">
						</div>
					</div>
					<div class="row">
				
						<input type="submit" name="sub_rates" value="Save" class="btn btn-info btn3d class_submit" style="width:50%;margin-left: 25%;">
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
    if (type == 'search_agency') {
				var sel_agency = $('#sel_agency').val(); 
				var rate_type = $('#rate_type').val(); 
				var template_code = $('#template_code').val(); 
				var less = $('#less').val(); 
				var plus = $('#plus').val(); 
				
				
				
				if(sel_agency !="" && rate_type !="" && template_code !=""){
					
				billData = '&action_type='+type+'&id='+id+'&sel_agency='+sel_agency+'&rate_type='+rate_type+'&template_code='+template_code+'&less='+less+'&plus='+plus;
				}else{
					alert(" All Filled Required");
					return false;
				}
				
				//exit();
				
    }
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_agency_rate.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
		dataType:'json',
        success:function(msg){
		document.getElementById("overlay_div").style.display="none";
		
		$("#display_data").html(msg.var_design);
		$(".class_submit").show();
		
        }
    });
}

//on Agency change

$(document).on("change", "#sel_agency", function () {
				
		var sel_agency = $("#sel_agency").val();  
				
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_agency_rate.php',
        data: 'action_type=on_agency_change&sel_agency='+sel_agency,
		dataType:'json',
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(html){
		document.getElementById("overlay_div").style.display="none";	
			$("#put_exist_agency_data").html(html.exist_design);
        }
    });
	
	
});

// change rate on change
$(document).on("blur", ".change_rate_class", function () {
	var set_rates= $(this).val();
	var test_ids= $(this).attr("data-id");
	
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_agency_rate.php',
        data: 'action_type=set_rate_on_change&set_rates='+set_rates+'&test_ids='+test_ids,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(html){
		document.getElementById("overlay_div").style.display="none";	
			
        }
    });
	
});

// delete template on Click
$(document).on("click", ".delete_all_template", function () {
	var delete_all_template= $(this).attr("data-id");
	
	
	$.confirm({
        title: "warning",
        content: "Are You Sure To Delete This Template?",
        buttons: {
			confirm: function () {
	
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_agency_rate.php',
        data: 'action_type=delete_all_template&delete_all_template='+delete_all_template,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(html){
		document.getElementById("overlay_div").style.display="none";	
			window.location.href="<?php echo $base_url; ?>set_agency_rate.php";
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
	
});

//insert more entry by template no 
$(document).on("click", ".edit_agency_rate", function () {
	var template_no= $(this).attr("data-id");
	var template_no_for_new= $("#template_code").val();
	
	
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_agency_rate.php',
        data: 'action_type=insert_new_by_template_no&template_no='+template_no,
		dataType:'json',
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(html){
		document.getElementById("overlay_div").style.display="none";	
			//window.location.href="<?php echo $base_url; ?>set_agency_rate.php";
			$("#display_data").html(html.var_design);
			$(".class_submit").show();
        }
    });
	
});
</script>

