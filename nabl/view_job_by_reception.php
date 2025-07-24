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


	// checking if biller clicked print button of perfoma,invoice,eestimate any one done so this page can open 
  $get_jobs_print_copmlete="select  * from job where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' AND `print_done_by_biller_for_qm_see`=1";
 $query_job_print_copmlete=mysqli_query($conn,$get_jobs_print_copmlete);
 if(mysqli_num_rows($query_job_print_copmlete) <= 0)
 { ?>
	<script >
	alert("Sorry this Job Not Done By Biller...");
	window.location.href="<?php echo $base_url; ?>list_of_completed_job_report_for_reception.php";
	</script>
<?php  }
 
 
	$txt_trf_no= $_GET["trf_no"];
	$txt_jobs= $_GET["job_no"];  

// code for get test by report no and job no

$select_test_wise="select * from test_wise_material_rate where `trf_no`='$txt_trf_no' AND `job_no`='$txt_jobs'";
 $select_test_wise_query=mysqli_query($conn,$select_test_wise);
 
 // get_estimate if available
 $sel_estiamte="select * from estimate_total_span where `trf_no`='$txt_trf_no' AND `job_no`='$txt_jobs'";
 
 $estiamte_query= mysqli_query($conn,$sel_estiamte);
 if(mysqli_num_rows($estiamte_query) > 0){
	 
	 $get_estimate= mysqli_fetch_array($estiamte_query);
	 $get_rate_type= $get_estimate["rate_type"];
	 $get_gst_type= $get_estimate["gst_type"];
	 $get_c_gst_amt= $get_estimate["c_gst_amt"];
	 $get_s_gst_amt= $get_estimate["s_gst_amt"];
	 $get_grand_total= $get_estimate["grand_total"];
	 $get_total_amount= $get_estimate["total_amt"];
	 $get_total_amt_in_word= $get_estimate["total_amt_in_word"];
	 
 }else{
	 $get_rate_type="";
	 $get_gst_type="";
	 $get_c_gst_amt="";
	 $get_s_gst_amt="";
	 $get_grand_total="";
	 $get_total_amount="";
	 $get_total_amt_in_word="";
 }
 
// update job table by report no and lab no
$up_job="update job set `report_received`=1 where `trf_no`='$txt_trf_no' AND `job_number`='$txt_jobs'";

//$up_job="update job set `report_received`=1,`job_owner_eng_and_qm`=2 where `report_no`='$txt_report' AND `job_number`='$txt_jobs'";
mysqli_query($conn,$up_job);

// update engineer light 
$up_eng_light="update job_for_engineer set `eng_light_status`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_jobs' AND `eng_light_status`='0'";
mysqli_query($conn,$up_eng_light);

$find_query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `trf_no`='$_GET[trf_no]' AND `dispatch_by_reception`='0' ORDER BY final_material_id DESC";
$find_result=mysqli_query($conn,$find_query);
if(mysqli_num_rows($find_result) == 0){
	$update_jobs="update job set `dispatch_by_reception`='1', `light_indication`='5' where `trf_no`='$_GET[trf_no]'";
	$result_update_jobs=mysqli_query($conn,$update_jobs);
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
   
  
<section class="content">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		View Reports
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									<div class="col-md-6">
									<label for="inputEmail3" class="col-md-2 control-label">S.R.F. No:</label>
									</div>
									
									<div class="col-md-6">
									<label for="inputEmail3" class="col-md-2 control-label">Lab No:</label>
									</div>
									
								</div>
								<div class="row">
									
										  <div class="col-md-6">
											<input type="text" class="form-control" value="<?php echo $_GET['trf_no'];?>" id="txt_trf_no" name="txt_trf_no" disabled>
										  </div>
										
										
										  
											<div class="col-md-6">
												
													<input type="text" class="form-control" value="<?php echo $_GET['job_no'];?>" id="txt_job_no" name="txt_job_no" disabled>
											</div>
								</div>
								<br>
								
								
							<div class="panel-group">
								<div class="box box-info">
									<div class="box-body">
									  <div class="table-responsive" id="display_data">
										<table class="table no-margin" id="example2">
										  <thead>
										  <tr>
											<th>
											<input type="checkbox" name="chk_all_report" class="chk_all_report" value="">
											Select All Reports
											</th>
											<th>material</th>
											<th>Report No</th>
											<th>Lab No</th>
											<th>Ulr No</th>
											<th>Action</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
											
											$sel_static_ulr="select  * from ulr_no where `ulr_status`=0 AND `ulr_is_deleted`=0";
											$query_static_ulr=mysqli_query($conn,$sel_static_ulr);
											$result_static_ulr=mysqli_fetch_array($query_static_ulr);
											$static_ulr=$result_static_ulr["ulr_no"];
											
											$get_jobs="select  * from job where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]'";
											$query_job=mysqli_query($conn,$get_jobs);
											$job_row=mysqli_fetch_array($query_job);
											$contact_person_name=$job_row["person_name"];
											$contact_person_mobile=$job_row["person_auth_mobile"];
											$billing_to_id=$job_row["billing_to_id"];
											
											$age_query="select * from agency_master WHERE `isdeleted`=0 AND `agency_id`='$billing_to_id'";
											$age_result=mysqli_query($conn,$age_query);
											if(mysqli_num_rows($age_result) > 0)
											{
												$gets_age=mysqli_fetch_array($age_result);
												$age_name=$gets_age["agency_name"];
												$age_add=$gets_age["agency_address"];
											}else{
												$age_name="";
												$age_add="";
											}
											
									    $query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `trf_no`='$_GET[trf_no]' ORDER BY final_material_id DESC";
										$result=mysqli_query($conn,$query);
										$material_count=1;
										while($row=mysqli_fetch_array($result))
										{
											
										$sel_cate="select * from material_category where `material_cat_id`=".$row['material_category'];
										$result_cat=mysqli_query($conn,$sel_cate);
										$row_cat=mysqli_fetch_array($result_cat);
										
										$sel_mat="select * from material where `id`=".$row['material_id'];
										$result_mat=mysqli_query($conn,$sel_mat);
										$row_mat=mysqli_fetch_array($result_mat);
									
										?>
										  <tr>
											<td>
											<?php
											if($row["dispatch_by_reception"]=="0")
											{
													$sel_by_lab_no="select `accepted_by_qm` from job_for_engineer WHERE `accepted_by_qm`='1' AND `lab_no`='$row[lab_no]'";
													$result_by_lab_no=mysqli_query($conn,$sel_by_lab_no);
											if(mysqli_num_rows($result_by_lab_no) > 0)
											{
											?>
											<input type="checkbox" name="chk_report" class="chk_report" value="<?php echo $row["trf_no"]."|".$row["job_no"]."|".$row["report_no"]."|".$row["lab_no"]."|".$static_ulr.$row["ulr_no"]."F"."|".$row["final_material_id"]; ?>">
											<?php
										     }else
											 {
												 echo '<span style="color:red;font-size: 20px;">Pending</span>';
											 }
										     }else{ echo '<span style="color:green;font-size: 20px;">Dispatched</span>'; }
											?>
											</td>
											<td><b><?php echo $row_mat["mt_name"];?></b>
											<input type="hidden" value="<?php echo $row['material_id'];?>" name="material_id_hidden" id="material_<?php echo $material_count;?>">
											</td>
											<td style="width:250px;">
											<?php echo $row['report_no']; ?>
											</td>
											<td>
											<?php echo $row['lab_no']; ?>  
											</td>
											<td>
											<?php echo $static_ulr.$row['ulr_no']."F"; ?>  
											</td>
											<td>
											
											  <!--<a href="<?php //echo $base_url.$row_mat["filename"];?>?trf_no=<?php //echo $row['trf_no']; ?>&&job_no=<?php //echo $row['job_no']; ?>&&lab_no=<?php //echo $row['lab_no']; ?>&&report_no=<?php //echo $row['report_no']; ?>&&ulr=<?php //echo $static_ulr.$row['ulr_no']."F"; ?>" class="btn btn-primary btn-lg btn3d" target="_blank" title="View Job"><span class="glyphicon glyphicon-question-list"></span>Report</a>-->
											</td>
										  </tr>
									
										<?php 
									
										$material_count++;
										
									} ?>
										<tr>
											<td colspan="8">&nbsp;
											</td>
										</tr>
										  </tbody>
										</table>
									  </div>
									</div>
								</div>
							</div>
							   <div class="box box-info">
									<div class="row">
									<div class="col-md-12"><h1 style="text-align:center;">Dispatch Detail</h2></div>
									</div>
									<div class="row">
												<div class="col-md-1">
												<label for="inputEmail3" class="control-label">Dispatch Type:</label>
												</div>
												<div class="col-md-3">
													<input type="radio" style="width:33px;height:25px;" name="dispatch_type" value="0" checked><span style="font-size:20px;" ><b>Hand</b></span>
													<input type="radio" style="width:33px;height:25px;"name="dispatch_type" value="1"><span style="font-size:20px;"><b>Courier<b></span>
												</div>
												<div class="col-md-2">
												<label for="inputEmail3" class="control-label">Remark:</label>
												</div>
												<div class="col-md-3">
														<input type="text"  class="form-control" name="remark" id="remark" value="" placeholder="Enter Remark">
												</div>
									 </div>
									 <br>
									 <div class="row" id="hand_hide_show">
										 <div class="col-md-1">
											<label for="inputEmail3" class="control-label">Receiver Name:</label>
										 </div>
										 <div class="col-md-3">
											<input type="text"  class="form-control" name="receiver_name" id="receiver_name" value="<?php echo $contact_person_name;?>" placeholder="Enter Receiver Name" >
										 </div>
										 <div class="col-md-2">
											<label for="inputEmail3" class="control-label">Receiver Mobile No:</label>
										 </div>
										 <div class="col-md-3">
											<input type="text"  class="form-control" name="receiver_mobile" id="receiver_mobile" value="<?php echo $contact_person_mobile;?>" placeholder="Enter Receiver Mobile No" >
										 </div>
									 </div>
									 
								<div id="courier_hide_show" style="Display:none;">
									 <div class="row">
										 <div class="col-md-1">
											<label for="inputEmail3" class="control-label">Courier Company:</label>
										 </div>
										 <div class="col-md-3">
											<input type="text"  class="form-control" name="courier_company" id="courier_company" value="" placeholder="Enter Courier Company Name" >
										 </div>
										 <div class="col-md-1">
											<label for="inputEmail3" class="control-label">Courier Date:</label>
										 </div>
										 <div class="col-md-3">
											<input type="text"  class="form-control" name="courier_date" id="courier_date" value="<?php echo date('d/m/Y')?>">
										 </div>
										 <div class="col-md-1">
											<label for="inputEmail3" class="control-label">Docate No:</label>
										 </div>
										 <div class="col-md-3">
											<input type="text"  class="form-control" name="courier_docate_no" id="courier_docate_no" value="" placeholder="Enter Courier Docate No" >
										 </div>
									 </div>
									 <br>
									 <div class="row">
										 
										 <div class="col-md-1">
											<label for="inputEmail3" class="control-label">Contact Person:</label>
										 </div>
										 <div class="col-md-5">
											<input type="text"  class="form-control" name="Contact_person" id="Contact_person" value="<?php echo $contact_person_name;?>" placeholder="Enter Contact Person" >
										 </div>
										 <div class="col-md-1">
											<label for="inputEmail3" class="control-label">Contact Person Mobile No:</label>
										 </div>
										 <div class="col-md-5">
											<input type="text"  class="form-control" name="Contact_person_mobile" id="Contact_person_mobile" value="<?php echo $contact_person_mobile;?>" placeholder="Enter Contact Person Mobile No" >
										 </div>
										
										 <div class="col-md-1">
											<label for="inputEmail3" class="control-label">Address:</label>
										 </div>
										 <div class="col-md-5" style="margin-top:20px;">
										 <?php
										 ?>
											<textarea  class="form-control" name="address" id="address" placeholder="Enter Address">
											<?php
												echo  $age_name.',&#13;&#10;'.$age_add;
											?>
											</textarea>
										 </div>
									 </div>
								</div>
									 <br>
									 <div class="row">
										 <div class="col-md-5">&nbsp;</div>
										 <div class="col-md-6">
										 <a href="javascript:void(0);" class="btn btn-primary btn-lg btn3d saving_dispatch_reports" title="Merge"><span class="glyphicon glyphicon-question-ok"></span>SAVE</a>
										 </div>
										 
									 </div>
								</div>
							<br>
						</div>
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>
	  	  
<script>
$(document).ready(function(){
	$('#courier_date').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
		
	var table = $('#example2').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    } );ffffff

});

$("input[name='dispatch_type']").change(function(e)
{
		var dispatch_type=$( 'input[name=dispatch_type]:checked' ).val();
		
		
		if(dispatch_type=="0"){
			$("#hand_hide_show").show();
			$("#courier_hide_show").hide();
			
		}
		if(dispatch_type=="1"){
			$("#courier_hide_show").show();
			$("#hand_hide_show").hide();
		}		
});

$("input[name='chk_all_report']").change(function(e)
{
		var checked = $(this).is(':checked');
		if(checked)
		{
			$(".chk_report").attr("checked",true);
		}else{
			$(".chk_report").attr("checked",false);
		}				
});

//bill merging by test code
$(document).on("click", ".saving_dispatch_reports", function () {
					
					
		var chk_array = [];
        var oTable = $("#example2").dataTable();
	    $(".chk_report:checked", oTable.fnGetNodes()).each(function() {
		 chk_array.push($(this).val());      
		 });
					
		if (chk_array.length === 0) {
			alert("Please Select Atlist One Report");
			return false;
		}
		
		var dispatch_type=$( 'input[name=dispatch_type]:checked' ).val();
		var remark=$( '#remark' ).val();
		var receiver_name=$( '#receiver_name' ).val();
		var receiver_mobile=$( '#receiver_mobile' ).val();
		var courier_company=$( '#courier_company' ).val();
		var courier_date=$( '#courier_date' ).val();
		var courier_docate_no=$( '#courier_docate_no' ).val();
		var Contact_person=$( '#Contact_person' ).val();
		var Contact_person_mobile=$( '#Contact_person_mobile' ).val();
		var address=$( '#address' ).val();
		var txt_trf_no=$( '#txt_trf_no' ).val();
		var txt_job_no=$( '#txt_job_no' ).val();
		
		
		//hand
		if(dispatch_type=="0"){
			if(receiver_name=="")
			{
				alert("Please Enter Receiver Name");
				return false;
			}
			if(receiver_mobile=="")
			{
				alert("Please Enter Receiver Mobile No");
				return false;
			}
			
		}
		//courier
		if(dispatch_type=="1"){
			if(courier_company=="")
			{
				alert("Please Enter Courier Company Name");
				return false;
			}
			if(Contact_person=="")
			{
				alert("Please Enter Courier Contact  Person");
				return false;
			}
			if(Contact_person_mobile=="")
			{
				alert("Please Enter Courier Contact  Person Mobile No");
				return false;
			}
			if(address=="")
			{
				alert("Please Enter Address");
				return false;
			}
		}


		$.confirm({
			title: "Confirmation",
			content: "Are You Sure To Dispatch Reports ?",
			buttons: {
			confirm: function () 
			{
				    $.ajax({
						type: 'POST',
						url: '<?php $base_url; ?>save_span_engineer.php',
						data: 'action_type=save_dispatch_reports&dispatch_type='+dispatch_type+"&remark="+remark+"&receiver_name="+receiver_name+"&receiver_mobile="+receiver_mobile+"&courier_company="+courier_company+"&courier_date="+courier_date+"&courier_docate_no="+courier_docate_no+"&Contact_person="+Contact_person+"&Contact_person_mobile="+Contact_person_mobile+"&address="+address+"&chk_array="+chk_array,
						success:function(html){
							window.location.href="<?php echo $base_url; ?>view_job_by_reception.php?trf_no="+txt_trf_no+"&&job_no="+txt_job_no;
							
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
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('address')
    //bootstrap WYSIHTML5 - text editor
    $('.address').wysihtml5()
  })
</script>
