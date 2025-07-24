
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
		Fail Send
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
					   <!--<div class="row">
									<div class="col-md-6">
										<input type="text" class="form-control select2 col-sm-12" id="numbers">
									</div>
									<div class="col-md-6">																			
										<button type="button" class="btn btn-info"  onclick="search_agency('search')" name="btn_add_data" id="btn_add_data" style="width:100%" ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
									</div>
									
								
																										
					</div>-->
					<div class="row">
						<div id="display_data">
						<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
						<thead>
							<tr>
								<th style="text-align:center;">Serial No</th>
								<th style="text-align:center;"><input type="checkbox" id="chk_all">ALL</th>
								<th style="text-align:center;">Mobile No</th>
								<th style="text-align:center;">message</th>
								<th style="text-align:center;">Status message</th>
								<th style="text-align:center;">Status</th>
								<th style="text-align:center;">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sele_materials="select * from send_list where `is_deleted`=0 AND `sent_msg`=2 LIMIT 0,400";
						$result_materials = mysqli_query($conn,$sele_materials);
						if(mysqli_num_rows($result_materials)>0)
						{
							$counting=1;
							while($row_materials =mysqli_fetch_array($result_materials))
							{
								$msg_id=$row_materials["msg_id"];
								$sel_msg="select * from whatapp_msg where msg_id=".$msg_id;
								$result_msg = mysqli_query($conn,$sel_msg);
								$row_msg =mysqli_fetch_array($result_msg);
								$coumns=$row_msg["phone_column"];
							?>
									<tr>	
										<td style="text-align:center;"><?php echo $counting;?></td>
										<td style="text-align:center;"><input type="checkbox" class="chk_number" value=<?php echo $row_materials["send_id"]?>></td>
										<td style="text-align:center;"><?php echo $row_msg["var_3"];?></td>
										<td style="text-align:center;" title="<?php echo $row_materials["text_msg"];?>"><?php echo substr($row_materials["text_msg"],0,50);?></td>
										<td style="text-align:center;"><?php echo $row_materials["delivery_status"];?></td>
										<td style="text-align:center;color:red;">Fail</td>
										<td style="text-align:center;">
										<a href="javascript:void(0)" class="btn btn-primary resend_it" data-id="<?php echo $row_materials["send_id"]?>" >Resend All</a>
										</td>
									</tr>	
									<?php 
									$counting++;
							}
						}
						?>
					</tbody>
					</table>
					<a href="javascript:void(0)" id="all_submit" class="btn btn-primary">Resend All</a>
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
	var table = $('#example2').DataTable( {
        'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    });
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

$(document).on("click",".resend_it",function(){
	var ids= $(this).attr("data-id");
	billData = '&action_type=resend_it&ids='+ids;
	if(confirm("Are You Sure To Resend..?"))
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
		alert("Successfuly Save to Send");
		window.location.href="pending_send.php";
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

$(document).on("click","#all_submit", function(){
	
				var error_msg = ""; 
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
				billData = '&action_type=all_submit&chk_number_arrray='+chk_number_arrray;
				if(confirm("Are You Sure To Resend ALL..?"))
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
						alert("Successfully Saved To Send");
						window.location.href="pending_send.php";
						
						
						}
					});
				}
			}else{
				alert(error_msg)
				return false;
			}
})
</script>
