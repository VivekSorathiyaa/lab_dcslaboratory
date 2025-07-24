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

$temporary_trf_no= $_GET["temporary_trf_no"];
$sel_jobs="select * from job where `temporary_trf_no`='$temporary_trf_no'";
$result_jobs_date=mysqli_query($conn,$sel_jobs);
$get_jobs_result=mysqli_fetch_array($result_jobs_date);
$sample_rec_date=$get_jobs_result["sample_rec_date"];	
$branch_name=$get_jobs_result["branch_name"];	
$branch_short_code=$get_jobs_result["branch_short_code"];	


$sel_ulr_no="SELECT * FROM ulr_sequence WHERE `branch_short_code`='$branch_short_code' order by ulr_sequence desc LIMIT 0,1";
$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
if(mysqli_num_rows($query_ulr_no) > 0)
{
	$result_ulr_no=mysqli_fetch_array($query_ulr_no);
	$last_ulr_no= intval($result_ulr_no["ulr_sequence"]) + 1;
}
else
{
$last_ulr_no=1;
}
?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}

/* only for 3d button effects */

.btn3d {
    transition:all .08s linear;
    position:relative;
    outline:medium none;
    -moz-outline-style:none;
    border:0px;
    margin-right:10px;
    margin-top:15px;
}
.btn3d:focus {
    outline:medium none;
    -moz-outline-style:none;
}
.btn3d:active {
    top:9px;
}
.btn-primary {
    box-shadow:0 0 0 1px #428bca inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #357ebd, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#428bca;
}
.btn-success {
    box-shadow:0 0 0 1px #5cb85c inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #4cae4c, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#5cb85c;
}
 .btn-info {
    box-shadow:0 0 0 1px #5bc0de inset, 0 0 0 2px rgba(255,255,255,0.15) inset, 0 8px 0 0 #46b8da, 0 8px 0 1px rgba(0,0,0,0.4), 0 8px 8px 1px rgba(0,0,0,0.5);
    background-color:#5bc0de;
}
.form-control { 
font-size: 20px;
height: 50px;
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
.form-control {
    border-radius: 0;
    box-shadow: none;
    border-color: black !important;
}
.select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
    border: 1px solid #151416 !important;
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
		
		<h1 style="text-align:center;">
		Set Ulr No
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove black;">
							<br>
								<div class="row">
								
									<div class="col-sm-2">
										<label for="inputEmail3" class=" control-label">Token No:</label>
										<input type="text" class="form-control" value="<?php echo $get_jobs_result['temporary_trf_no'];?>" id="txt_temporary_trf_no" name="txt_temporary_trf_no" readonly>
									</div>
								
									<div class="col-sm-2">
										<label for="inputEmail3" class=" control-label">S.R.F. No:</label>
										<input type="text" class="form-control" value="<?php echo $get_jobs_result['trf_no'];?>" id="txt_trf_no" name="txt_trf_no" readonly>
									</div>
								
									<div class="col-sm-2">
										<label for="inputEmail3" class=" control-label">Job No:</label>
										<input type="text" class="form-control" value="<?php echo $get_jobs_result['trf_no'];?>" id="txt_job_no" name="txt_job_no" readonly>
									</div>
									
									<div class="col-sm-2">
										<label for="inputEmail3" class=" control-label">Rec Sample Date:</label>
										<input type="text" class="form-control" value="<?php echo date("d/m/Y",strtotime($get_jobs_result['sample_rec_date']));?>" id="sample_rec_date" name="sample_rec_date" readonly>
									</div>
									
									<div class="col-sm-2">
										<label for="inputEmail3" class=" control-label">Branch Name:</label>
										<input type="text" class="form-control" id="branch_name" value="<?php echo $branch_name;?>" readonly>
										<input type="hidden" class="form-control" id="branch_short_code" value="<?php echo $branch_short_code;?>" readonly>
									</div>
								</div>
							<br>
								<div class="row">
								
									<div class="col-sm-6">
										<a href="javascript:void(0);" class="btn btn-primary btn3d apply_ulr_no"  title="Apply Ulr No"><span class="glyphicon glyphicon-question-ok"></span> Use Auto Ulr No</a>
										
										<input type="button" value="Reserved Ulr List" class="btn btn-primary btn3d" data-toggle="modal" data-target="#modal-reserve">
										
										<input type="button" value="Make Url Reserved" class="btn btn-primary btn3d" data-toggle="modal" data-target="#modal-tpi">
										<?php
										
										$counts_of_finals=0;
										$query_final_count="select * from final_material_assign_master WHERE `is_deleted`=0 AND `temporary_trf_no`='$_GET[temporary_trf_no]' AND `created_by_id`='$_SESSION[u_id]' AND `ulr_no`='0' ORDER BY final_material_id ASC";
										// $query_final_count="select * from final_material_assign_master WHERE `is_deleted`=0 AND `temporary_trf_no`='$_GET[temporary_trf_no]' AND `ulr_no`='0' ORDER BY final_material_id ASC";
										$result_final_count=mysqli_query($conn,$query_final_count);
										if(mysqli_num_rows($result_final_count) > 0)
										{
											while($get_final=mysqli_fetch_array($result_final_count))
											{
												$sel_mates="select * from material where `id`=".$get_final['material_id'];
												$result_mates=mysqli_query($conn,$sel_mates);
												$row_mates=mysqli_fetch_array($result_mates);
												$in_ulres=$row_mates["in_nabl"];
												
												if($in_ulres=="yes")
												{
													$counts_of_finals++;
												}
											}
										}
										//$counts_of_finals=mysqli_num_rows($result_final_count);
										
										$querys_date_wise_count= "SELECT * FROM ulr_sequence WHERE ulr_status='3' AND `ulr_sequence_date`='$sample_rec_date' AND `branch_short_code`='$branch_short_code'";
										$results_date_wise_count=mysqli_query($conn,$querys_date_wise_count);
										$count_of_date=mysqli_num_rows($results_date_wise_count);
										
										
										if($count_of_date >= $counts_of_finals && $count_of_date != 0 && $counts_of_finals != 0){
										?>
										<a href="javascript:void(0);" class="btn btn-primary btn3d use_reserved_ulr_no"  title="Apply Reserved  Ulr No"><span class="glyphicon glyphicon-question-ok"></span> Use Reserved Ulr No</a>
										<?php } ?>
									</div>
									
									<div class="col-sm-4"  style="color:green;font-size:15px;font-weight:bold;">
									<label>&nbsp;</label><br>
									<span id="put_ulr_message">&nbsp;</span>
									</div>
									
									<div class="col-sm-1">
										
										
										
									</div>
								</div>
							
							<br>
							<div class="row">
									<div class="col-lg-12">
									<div id="display_data_after_saved">
									<table class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Material Category</th>
										<th style="text-align:center;">Material</th>
										<th style="text-align:center;">Lab No</th>
										<th style="text-align:center;width:200px;">Ulr no</th>
										<!--<th style="text-align:center;">Action</th>-->
									</tr>
										
								</thead>
								<tbody>
									<?php
									
									    $count=1;
										$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `temporary_trf_no`='$_GET[temporary_trf_no]' AND `created_by_id`='$_SESSION[u_id]' ORDER BY final_material_id ASC";
										//$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `temporary_trf_no`='$_GET[temporary_trf_no]'  ORDER BY final_material_id ASC";
										$result=mysqli_query($conn,$query);
										$counts_of_final_material=mysqli_num_rows($result);
										while($row=mysqli_fetch_array($result))
										{
											
										$sel_cate="select * from material_category where `material_cat_id`=".$row['material_category'];
										$result_cat=mysqli_query($conn,$sel_cate);
										$row_cat=mysqli_fetch_array($result_cat);
										
										$sel_mat="select * from material where `id`=".$row['material_id'];
										$result_mat=mysqli_query($conn,$sel_mat);
										$row_mat=mysqli_fetch_array($result_mat);
										$in_ulr=$row_mat["in_nabl"];
										
										if($in_ulr=="yes")
										{
									?>
										<tr id="tr_<?php echo $row['final_material_id'];?>">
										<td style="white-space:nowrap;text-align:center;"><?php echo $count;?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_cat['material_cat_name'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row_mat['mt_name'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $row['lab_no'];?></td>
										<td style="white-space:nowrap;text-align:center;">
										<?php if($row['ulr_no']=='0'){?>
										<input type="text" name="txt_ulr" id="id_ulr_<?php echo $row['final_material_id'];?>" class="form-control class_ulr" style="width:200px;" placeholder="Enter ulr No">
										<input type="hidden" name="txt_final_material_id"  class="form-control class_final_mate_id" value="<?php echo $row['final_material_id'];?>">
										<?php }else{ echo $row['ulr_no'];}?>
										</td>
										</tr>
									<?php
									     $count++;
										}	
										}	
									?>
										<input type="hidden" name="txt_ulr" id="counts_of_final_material" value="<?php echo $counts_of_final_material?>" >
										<input type="hidden" value="<?php echo $get_jobs_result['sample_rec_date'];?>" id="txt_sam_rec_date" name="txt_sam_rec_date">
										<input type="hidden" value="blank"  id="ulr_status" name="ulr_status">
								</tbody>
								
							  </table>
									
									</div>
									</div>
							</div>
							<div class="row">
									<div class="col-md-5">&nbsp;</div>
									<div class="col-md-4">													
										<button type="button" class="btn btn-primary" id="btn_chk_and_save" name="btn_chk_and_save">Check & Save</button>
									</div>
							</div>
							<br>
							
							</div>
						
					</div>
				</div>
</section>	
</div>

<div class="modal fade" id="modal-reserve">
          <div class="modal-dialog" style="width:80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reserved Ulr number List For Date</h4>
              </div>
				<form id="form_reserve" name="form_client" method="post">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
									<table class="table table-bordered table-striped" width="100%"> 
									<thead>
									<tr>
										
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Branch Name</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Ulr No</th>
									</tr>
										
								</thead>
								<tbody>
									<?php
									
										$countss=1;
										$querys= "SELECT * FROM ulr_sequence WHERE ulr_status='3' order by ulr_sequence asc";
										$results=mysqli_query($conn,$querys);
										if(mysqli_num_rows($results) > 0)
										{
										
										while($rows=mysqli_fetch_array($results))
										{
									?>
										<tr>
										<td style="white-space:nowrap;text-align:center;"><?php echo $countss;?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $rows['branch_name'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo date("d-m-Y",strtotime($rows['ulr_sequence_date']));?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $rows['ulr_sequence'];?></td>
										
										</tr>
									<?php
									     $countss++;
										}	
										}	
									?>
								</tbody>
								
							  </table>
							 
							</div>
									
												
							</div>
					</div>
					
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
	
	<div class="modal fade" id="modal-tpi">
          <div class="modal-dialog" style="width:20%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Make Ulr No Reserved</h4>
              </div>
				<form id="form_tpi" name="form_client" method="post">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
									<div class="col-md-12">
										<label>Branch Name</label>
										<select class="form-control select2 " id="sel_branch" name="sel_branch">
											<option value="">Select Branch</option>
											<?php 
												$sel_branch = "select * from branches where `is_deleted`=0";
												$query_branch = mysqli_query($conn, $sel_branch);
												if(mysqli_num_rows($query_branch) > 0)
												{
												while($row_branch = mysqli_fetch_array($query_branch)) {
												?>
												<option value="<?php echo $row_branch['branch_short_code'].'|'.$row_branch['branch_name']; ?>"><?php echo $row_branch['branch_name'];?></option>
												<?php 
												} }
												?>
										</select>
									</div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-12">
										<label>Reservation Date</label>
										<input type="text" class="form-control" PlaceHolder="Enter Date" name="txt_data" id="reserved_date" required value="<?php echo date("d/m/Y")?>">
									</div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-12">	
										<label>Start Ulr No</label>
										<input type="text" class="form-control" PlaceHolder="Enter Start Ulr No" name="txt_start_url" id="txt_start_url" required value="<?php echo $last_ulr_no;?>" disabled>
									</div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-12">	
										<label>Last Ulr No</label>
										<input type="text" class="form-control" PlaceHolder="Enter Last Ulr No" name="txt_last_url" id="txt_last_url" required value="">
									</div>
							</div>
							<br>
							<div class="row">
									<div class="col-md-4">&nbsp;</div>
									<div class="col-md-4">													
										<button type="button" class="btn btn-primary" id="btn_add_ulr" name="btn_add_ulr" data-dismiss="modal">Submit</button>
									</div>
							</div>
									
												
							</div>
					</div>
					
				</form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
  
	
<?php include("footer.php");?>
<link rel="stylesheet" href="bower_components/custom/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="bower_components/custom/bootstrap-multiselect.js"></script>
		  	  
<script>

$('#reserved_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	});
$(function () {
    $('.select2').select2();
  });
$(document).ready(function(){
	   
});

$("#btn_add_ulr").click(function()
{
	var sel_branch = $('#sel_branch').val(); 
	var reserved_date = $('#reserved_date').val(); 
	var txt_start_url = $('#txt_start_url').val(); 
	var txt_last_url = $('#txt_last_url').val(); 
	
	if(sel_branch =="")
	{
		alert("Please Select Branch");
		return false;
	}
	
	if(reserved_date =="")
	{
		alert("Please Select Reservation Date");
		return false;
	}
	
	if((+txt_start_url) > (+txt_last_url))
	{
		alert("Please Enter Ulr No Properly");
		return false;
	}
	if(txt_start_url !="" && txt_last_url !="")
	{
		var postData = 'action_type=reserveing_ulr&reserved_date='+reserved_date+'&txt_start_url='+txt_start_url+'&txt_last_url='+txt_last_url+'&sel_branch='+sel_branch;
			
		$.ajax({
			url : "<?php $base_url; ?>save_url_file_for_other_software.php", 
			type: "POST",
			dataType:'JSON',
			data : postData,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success: function(data)
			{
				document.getElementById("overlay_div").style.display="none";
				if(data.set_status==0)
				{
					alert(data.message);
					 $("#ulr_status").val("blank");
					 $("#put_ulr_message").text("");
					 $(".class_ulr").val("");
				}
				else
				{
					alert(data.message);
					$("#ulr_status").val("blank");
					$("#put_ulr_message").text("");
					$(".class_ulr").val("");
				}
			}
		});
		 
	}
});

$(document).on("change","#sel_branch",function()
{
	var sel_branch = $('#sel_branch').val(); 
	if(sel_branch =="")
	{
		alert("Please Select Branch");
		return false;
	}
	
	if(sel_branch !="")
	{
		var postData = 'action_type=on_branch_changes&sel_branch='+sel_branch;
			
		$.ajax({
			url : "<?php $base_url; ?>save_url_file_for_other_software.php", 
			type: "POST",
			dataType:'JSON',
			data : postData,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success: function(data)
			{
				document.getElementById("overlay_div").style.display="none";
				if(data.set_status==0)
				{
					$("#txt_start_url").val(data.last_ulr_no);
				}
			}
		});
		 
	}
});



$(document).on("click",".apply_ulr_no",function(){
       var branch_short_code=$("#branch_short_code").val();
       var branch_name=$("#branch_name").val();
       var counts_of_final_material=$("#counts_of_final_material").val();
	  var final_mate_id_array=[];
	  $(".class_final_mate_id").each(function () {
		 final_mate_id_array.push($(this).val());
	   });
	  var postData = 'action_type=apply_ulr_no&counts_of_final_material='+counts_of_final_material+'&branch_short_code='+branch_short_code;
			
			$.ajax({
				url : "<?php $base_url; ?>save_url_file_for_other_software.php", 
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					//final_mate_id_array.reverse();
					var get_ulr_array=data.set_ulr_array;
					var keyword=get_ulr_array.toString();
					var ulr_no_array = keyword.split(",");
					
					var arrayLength = final_mate_id_array.length;
					for (var i = 0; i < arrayLength; i++) 
					{
						var set_ids= "#id_ulr_"+final_mate_id_array[i];
						$(set_ids).val(ulr_no_array[i]);
					}
					$("#ulr_status").val("auto_ulr_use");
					$("#put_ulr_message").text("Auto Ulr Will Set"+" For "+branch_name+" Branch.");
					document.getElementById("overlay_div").style.display="none";
					
				 }
			});
});


$(document).on("click",".use_reserved_ulr_no",function(){
			
			var branch_name=$("#branch_name").val();
			var branch_short_code=$("#branch_short_code").val();
			var sample_rec_date=$("#sample_rec_date").val();
			var postData = 'action_type=use_reserved_ulr_no&sample_rec_date='+sample_rec_date+'&branch_short_code='+branch_short_code;
			
			$.ajax({
				url : "<?php $base_url; ?>save_url_file_for_other_software.php", 
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					//final_mate_id_array.reverse();
					var get_ulr_array=data.set_ulr_array;
					var keyword=get_ulr_array.toString();
					var ulr_no_array = keyword.split(",");
					
					$("#ulr_status").val("reserved_ulr_use");
					$("#put_ulr_message").text("Reserved Ulr Will Set For "+branch_name+" Branch-->"+get_ulr_array);
					$(".class_ulr").val("");
					document.getElementById("overlay_div").style.display="none";
					
				 }
			});
});


$(document).on("click","#btn_chk_and_save",function(){
       
	  var txt_temporary_trf_no=$("#txt_temporary_trf_no").val();
	  var branch_name=$("#branch_name").val();
	  var branch_short_code=$("#branch_short_code").val();
	  var ulr_status=$("#ulr_status").val();
	  var sample_rec_date=$("#sample_rec_date").val();
	  
	  if(ulr_status == "blank")
	   {
		   alert("Please Set Ulr No First..");
		   return false;
	   }
	  var final_mate_id_array=[];
	  $(".class_final_mate_id").each(function () {
		 final_mate_id_array.push($(this).val());
	   });
	   
	  var ulr_box_error=0;
	  var url_array=[];
	  $(".class_ulr").each(function () {
		  if($(this).val()!="")
		  {
		    url_array.push($(this).val());
		  }else{
			ulr_box_error++;  
		  }
	   });
	   
	   if (url_array.length === 0) 
	   {
		   alert("No Material For Assign Url..");
		   return false;
	   }
	   
	   if(ulr_box_error != 0)
	   {
		   alert("all ulr no Required..");
		   return false;
	   }
	  var postData = 'action_type=chk_and_save&txt_sam_rec_date='+sample_rec_date+'&final_mate_id_array='+final_mate_id_array+'&url_array='+url_array+'&ulr_status='+ulr_status+'&branch_name='+branch_name+'&branch_short_code='+branch_short_code+'&txt_temporary_trf_no='+txt_temporary_trf_no;
			
			$.ajax({
				url : "<?php $base_url; ?>save_url_file_for_other_software.php", 
				type: "POST",
				dataType:'JSON',
				data : postData,
				beforeSend: function(){
					document.getElementById("overlay_div").style.display="block";
				},
				success: function(data)
				 {
					if(data.set_status=="0")
					{
						alert(data.msg);
					}else{
						alert(data.msg);
					}
					document.getElementById("overlay_div").style.display="none";
					//location.reload();
					window.location.href="<?php echo $base_url; ?>job_listing_for_second_reception.php";
					
				 }
			});
});

$(document).on("click",".use_url",function(){
	  var use_url=$(this).attr("data-id");
       
	  $(".class_ulr_puts").each(function () {
		 if($(this).val()=="")
		 {
			$(this).val(use_url);
			return false;
		 }
	   });	
});

$(document).on("click",".set_all_ulr_no",function(){
	 
       var get_all_ulr=[];
	  $(".class_ulr_puts").each(function () {
		 get_all_ulr.push($(this).val());
		 
	   });	
	   var countings=0;
	    $(".class_ulr").each(function () {
		 $(this).val(get_all_ulr[countings]);
		 countings++;
	   });
	   $('#modal-reserve').modal('hide');
	   $("#is_own").val("reserve");
});


// add data
function addData(type,id){
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
    if (type == 'add_material_assinging') {
				var txt_trf_no = $('#txt_trf_no').val(); 
				var txt_job_no = $('#txt_job_no').val(); 
				var select_material_category = $('#select_material_category').val(); 
				var select_material = $('#select_material').val(); 
				//var txt_lab_no = $('#txt_lab_no').val(); 
				var type_of_cement = $('#type_of_cement').val(); 
				var cement_grade = $('#cement_grade').val(); 
				var cement_brand = $('#cement_brand').val(); 
				var week_no = $('#week_no').val(); 
				var brick_source = $('#brick_source').val(); 
				var sample_de = $('#sample_de').val(); 
				var mark = $('#mark').val();
				var brick_specification = $('#brick_specification').val();
				var tanker_no = $('#tanker_no').val();
				var lot_no = $('#lot_no').val();
				var bitumin_grade = $('#bitumin_grade').val();
				var make = $('#make').val();
				var cube_grade = $('#cube_grade').val();
				var day_remark = $('#day_remark').val();
				var casting_date = $('#casting_date').val();
				var day = $('#day').val();
				var set_of_cube = $('#set_of_cube').val();
				var no_of_cube = $('#no_of_cube').val();
				var cc_identification = $('#cc_identification').val();
				var chainage_no = $('#chainage_no').val();
				var fdd_desc_sample = $('#fdd_desc_sample').val();
				var shape = $('#shape').val();
				var age = $('#age').val();
				var color = $('#color').val();
				var thickness = $('#thickness').val();
				var paver_grade = $('#paver_grade').val();
				var sample_type = $('#sample_type').val();
				var soil_source = $('#soil_source').val();
				var dia = $('#dia').val();
				var steel_grade = $('#steel_grade').val();
				var steel_brand = $('#steel_brand').val();
				var tile_source = $('#tile_source').val();
				var tiles_specification = $('#tiles_specification').val();
				var fine_agg_source = $('#fine_agg_source').val();
				var fine_agg_type = $('#fine_agg_type').val();
				var qa_spall_source = $('#qa_spall_source').val();
				var bitumin_mix = $('#bitumin_mix').val();
				var tiles_specification = $('#tiles_specification').val();
				var brand = $('#brand').val();
				var select_test = $('#select_test').val();
				var select_samp_condition = $('#select_samp_condition').val();
				var select_location = $('#select_location').val();
				var txt_is_sample = $('#txt_is_sample').val();
				
				
				var tested_by = $('#sel_tested_by').val();
				var reported_by = $('#reported_by').val();
				var ex_date_submission = $('#ex_date_submission').val();
				var chkmorr = $("input[name='radio']:checked").val();
				var exel_radio = $("input[name='exel_radio']:checked").val();
				
				// condition for steel_brand
				if(select_material_category !="" && select_material_category =="10" && dia=="")
				{
					alert("Please Enter Dia First...");
					return false;
				}
				
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="129" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
				// condition for cube and flexure
				if(select_material_category =="5" && select_material =="143" && casting_date=="")
				{
					alert("Please Enter Casting Date  First...");
					return false;
				}else{
					
					if(casting_date=="")
					{
						casting_date="0000-00-00";
					}
					
				}
				
			
				if(txt_trf_no !="" && select_material_category !="" && select_material !=""&& select_test !="" && tested_by !=""&& reported_by !=""){
					
				billData = '&action_type='+type+'&id='+id+'&txt_trf_no='+txt_trf_no+'&txt_job_no='+txt_job_no+'&select_material_category='+select_material_category+'&select_material='+select_material+'&type_of_cement='+type_of_cement+'&cement_grade='+cement_grade+'&cement_brand='+cement_brand+'&week_no='+week_no+'&brick_source='+brick_source+'&mark='+mark+'&brick_specification='+brick_specification+'&tanker_no='+tanker_no+'&lot_no='+lot_no+'&bitumin_grade='+bitumin_grade+'&make='+make+'&cube_grade='+cube_grade+'&day_remark='+day_remark+'&casting_date='+casting_date+'&day='+day+'&set_of_cube='+set_of_cube+'&no_of_cube='+no_of_cube+'&shape='+shape+'&age='+age+'&color='+color+'&thickness='+thickness+'&paver_grade='+paver_grade+'&sample_type='+sample_type+'&dia='+dia+'&steel_grade='+steel_grade+'&steel_brand='+steel_brand+'&tile_source'+tile_source+'&tiles_specification='+tiles_specification+'&brand='+brand+'&select_test='+select_test+'&tested_by='+tested_by+'&reported_by='+reported_by+'&ex_date_submission='+ex_date_submission+'&chkmorr='+chkmorr+'&exel_radio='+exel_radio+'&fine_agg_source='+fine_agg_source+'&qa_spall_source='+qa_spall_source+'&select_samp_condition='+select_samp_condition+'&select_location='+select_location+'&bitumin_mix='+bitumin_mix+'&txt_is_sample='+txt_is_sample+'&cc_identification='+cc_identification+'&chainage_no='+chainage_no+'&fine_agg_type='+fine_agg_type+'&fdd_desc_sample='+fdd_desc_sample+'&sample_de='+sample_de+'&soil_source='+soil_source;
				}else{
					alert(" All Filled Required");
					return false;
				}
				
				//exit();
				
    }else{
				
	
				billData = 'action_type='+type+'&id='+id;
				
    }
     $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>span_save_material.php',
        data: billData,
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(msg){
		document.getElementById("overlay_div").style.display="none";
          get_span_assign();
		  $("#btn_add_data_save").css("display", "block");
        }
    }); 
}	
</script>
