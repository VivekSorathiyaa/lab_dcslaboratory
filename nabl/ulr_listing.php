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


$sel_ulr_no="SELECT * FROM ulr_sequence order by ulr_sequence desc LIMIT 0,1";
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
		Ulr List
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove black;">
							<a data-toggle="collapse" href="#collapse1" class="btn btn-primary" style="margin-left:45%;width:3%;;" id="add_material_button"><i class="fa fa-search" aria-hidden="true"></i></a>
						<br>
						<div id="collapse1" class="panel-collapse collapse">
							<div class="row">
									<div class="col-md-4">
									<label>DATE:</label>
									</div>
									<div class="col-md-4">
									<label>MONTH:</label>
									</div>
							</div>
							<div class="row">
							    <div class="col-md-4">
									<input type="text" name="search_sam_date" id="search_sam_date" placeholder="Enter Date in (Y-m-d) Format" class="form-control">
								 </div>
								 
								 <div class="col-md-4">
									<select id="search_sam_month" class="form-control">
										<option value="">Select Month</option>
										<option value="01">01</option>
										<option value="02">02</option>
										<option value="03">03</option>
										<option value="04">04</option>
										<option value="05">05</option>
										<option value="06">06</option>
										<option value="07">07</option>
										<option value="08">08</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
								 </div>
								 <div class="col-md-4">
									<a href="javascript:void(0);" class="btn btn-primary btn3d search_job_by_rec" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> Search</a>
									<a href="javascript:void(0);" class="btn btn-primary" onclick="location.reload()" style="margin-top: 16px;"><span class="glyphicon glyphicon-question-ok"></span> View All</a>
								</div>
							</div>
						</div>
							<br>
								<div class="row">
									<div class="col-sm-6">
										<input type="button" value="Make Url Reserved" class="btn btn-primary btn3d" data-toggle="modal" data-target="#modal-tpi">
									</div>
								</div>
							
							<br>
							<div class="row">
									<div class="col-lg-12">
									<div id="display_data_after_saved">
									<table class="table table-bordered table-striped" width="100%" id="example2"> 
									<thead>
									<tr>
										
										<th style="text-align:center;">Serial No</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Ulr No</th>
										<th style="text-align:center;">Job No</th>
										<th style="text-align:center;">Unique Identification No</th>
										<th style="text-align:center;">Trf No</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Status</th>
									</tr>
										
								</thead>
								<tbody>
									<?php
									
										$countss=1;
										$querys= "SELECT * FROM ulr_sequence order by ulr_sequence ASC";
										$results=mysqli_query($conn,$querys);
										if(mysqli_num_rows($results) > 0)
										{
										
										while($rows=mysqli_fetch_array($results))
										{
									?>
										<tr>
										<td style="white-space:nowrap;text-align:center;"><?php echo $countss;?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo date("d-m-Y",strtotime($rows['ulr_sequence_date']));?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $rows['ulr_sequence'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $rows['job_no'];?></td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $rows['lab_no'];?></td>
										<td style="white-space:nowrap;text-align:center;">
										<?php 
											//echo $rows['lab_no'];
											$only_year=date("Y",strtotime($rows['ulr_sequence_date']));
											$only_month=date("m",strtotime($rows['ulr_sequence_date']));
											echo "DCS/".$only_year."/".$only_month."/".sprintf('%02d', $rows["trf_no"]);
										?>
										</td>
										<td style="white-space:nowrap;text-align:center;"><?php echo $rows['report_no'];?></td>
										<td style="white-space:nowrap;text-align:center;">
										<?php 
										if($rows['ulr_status']=="2"){ echo '<span style="font-weight:bold;color:red;">Used</span>';} else { echo '<span style="font-weight:bold;color:green;">Reserved</span>';}
										?>
										</td>
										
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
										$querys= "SELECT * FROM ulr_sequence WHERE ulr_status='3' order by ulr_sequence ASC";
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

$('#search_sam_date').datepicker({
		  autoclose: true,
	  format: 'yyyy-mm-dd'
	});
	
$('#reserved_date').datepicker({
		  autoclose: true,
	  format: 'dd/mm/yyyy'
	});
$(function () {
    $('.select2').select2();
  });
$(document).ready(function(){
	var table = $('#example2').DataTable( {
        'autoWidth': true,
		'scrollX': true,
		buttons: [ 'excel' ],
		'pageLength': '10'
    } );
	   
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
					 location.reload();
				}
				else
				{
					alert(data.message);
					$("#ulr_status").val("blank");
					$("#put_ulr_message").text("");
					$(".class_ulr").val("");
					location.reload();
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

$(".search_job_by_rec").click(function()
{
					
	var search_sam_date = $('#search_sam_date').val(); 
	var search_sam_month = $('#search_sam_month').val(); 
	if(search_sam_date =="" && search_sam_month =="")
	{
		alert("Please Atlist One select");
		return false;
	}
		var postData = '&search_sam_date='+search_sam_date+'&search_sam_month='+search_sam_month;
			
		$.ajax({
			url : "<?php echo $base_url; ?>search_ulr_list.php",
			type: "POST",
			data : postData,
			beforeSend: function(){
				document.getElementById("overlay_div").style.display="block";
			},
			success: function(data,status,  xhr)
			{
				document.getElementById("overlay_div").style.display="none";
				$("#display_data_after_saved").html(data);
			}
			}); 
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
