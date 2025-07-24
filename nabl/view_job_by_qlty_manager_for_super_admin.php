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
$up_eng_light="update job_for_engineer set `eng_light_status`=1 where `trf`='$txt_trf_no' AND `job_no`='$txt_jobs' AND `eng_light_status`='0'";
mysqli_query($conn,$up_eng_light);
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
									<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-2 control-label">S.R.F. No:</label>
									</div>
									
									<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-2 control-label">Lab No:</label>
									</div>
									
								</div>
								<div class="row">
									
										  <div class="col-sm-6">
											<input type="text" class="form-control" value="<?php echo $_GET['trf_no'];?>" id="txt_trf_no" name="txt_trf_no" disabled>
										  </div>
										
										
										  
											<div class="col-sm-6">
												
													<input type="text" class="form-control" value="<?php echo $_GET['job_no'];?>" id="txt_job_no" name="txt_job_no" disabled>
											</div>
								</div>
								<br>
								
								
							<div class="panel-group">
								<div class="box box-info">
									<div class="box-body">
									  <div class="table-responsive" id="display_data">
										<table class="table no-margin">
										  <thead>
										  <tr>
											<th>material</th>
											<th> No</th>
											<th>Test List</th>
											<th>Start Date</th>
											<th>Days</th>
											<th>End Date</th>
											<!--<th>Exp. Sub. Date</th>-->
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
											
											$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$_GET[job_no]' ORDER BY final_material_id DESC";
										$result=mysqli_query($conn,$query);
										$material_count=1;
										while($row=mysqli_fetch_array($result))
										{
											
										// get lab id to check record
										
										 $sel_eng="Select * from job_for_engineer where `lab_no`='$row[lab_no]'";
										$query_eng= mysqli_query($conn,$sel_eng);
										if(mysqli_num_rows($query_eng) > 0){
											$is_est=1;
											$get_eng= mysqli_fetch_array($query_eng);
										}else{
											$is_est=0;
											
										}
										
										if($is_est==1 && $get_eng["appoved_by_qm_to_print"]=="1"){
											 $set_status="no";
										}
										if($is_est==1 && $get_eng["appoved_by_qm_to_print"]=="0"){
											$set_status="yes";
										}else{
											$set_status="yes";
										}
										
										
											
										$sel_cate="select * from material_category where `material_cat_id`=".$row['material_category'];
										$result_cat=mysqli_query($conn,$sel_cate);
										$row_cat=mysqli_fetch_array($result_cat);
										
										$sel_mat="select * from material where `id`=".$row['material_id'];
										$result_mat=mysqli_query($conn,$sel_mat);
										$row_mat=mysqli_fetch_array($result_mat);
									if($set_status=="yes")
									{
										?>
										  <tr>
											<td><b>
											<?php 
											//echo $row_mat["mt_name"];
											
							if(strpos($row_mat["mt_name"],"WMM (MIX MATERIAL)") !== false || 
							strpos($row_mat["mt_name"],"GSB - I MIX (M4-1)") !== false || 
							strpos($row_mat["mt_name"],"GSB - II MIX (M4-2)") !== false || 
							strpos($row_mat["mt_name"],"GSB - III MIX (M4-1)") !== false || 
							strpos($row_mat["mt_name"],"GSB - IV MIX (M5)") !== false || 
							strpos($row_mat["mt_name"],"GSB - V MIX (M5)") !== false || 
							strpos($row_mat["mt_name"],"GSB - VI MIX (M5)") !== false || 
							strpos($row_mat["mt_name"],"GSB - I MIX (M5)") !== false || 
							strpos($row_mat["mt_name"],"GSB - III MIX (M5)") !== false || 
							strpos($row_mat["mt_name"],"GSB - II MIX (M5)") !== false || 
							strpos($row_mat["mt_name"],"GSB - I MIX (M4-2)") !== false || 
							strpos($row_mat["mt_name"],"GSB - II MIX (M4-1)") !== false || 
							strpos($row_mat["mt_name"],"GSB - III MIX (M4-2)") !== false || 
							strpos($row_mat["mt_name"],"MSS - A (MIX MATERIAL)") !== false || 
							strpos($row_mat["mt_name"],"MSS - B (MIX MATERIAL)") !== false || 
							strpos($row_mat["mt_name"],"BUSG - CA") !== false || 
							strpos($row_mat["mt_name"],"BUSG - KA") !== false || 
							strpos($row_mat["mt_name"],"BM - 2 (MIX MATERIAL)") !== false|| 
							strpos($row_mat["mt_name"],"BM - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_mat["mt_name"],"BC - 2 (MIX MATERIAL)") !== false|| 
							strpos($row_mat["mt_name"],"BC - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_mat["mt_name"],"DBM - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_mat["mt_name"],"DBM - 2 (MIX MATERIAL)") !== false|| 
							strpos($row_mat["mt_name"],"SDBC - 1 (MIX MATERIAL)") !== false|| 
							strpos($row_mat["mt_name"],"SDBC - 2 (MIX MATERIAL)") !== false)
							{
								
								
								$ansss = $row_mat["mt_name"];								
							}
							else
							{
									if(strpos($row_mat["mt_name"],"WMM") !== false || 
									strpos($row_mat["mt_name"],"WBM") !== false || 
									strpos($row_mat["mt_name"],"RCC") !== false || 
									strpos($row_mat["mt_name"],"GSB") !== false || 
									strpos($row_mat["mt_name"],"BM") !== false || 
									strpos($row_mat["mt_name"],"BC") !== false || 
									strpos($row_mat["mt_name"],"SDBC") !== false || 
									strpos($row_mat["mt_name"],"MSS") !== false || 
									strpos($row_mat["mt_name"],"DBM") !== false || 
									strpos($row_mat["mt_name"],"BUSG") !== false)
									{
										$ans = substr($row_mat["mt_name"],strpos($row_mat["mt_name"],"(") + 1);
										$explodeing = explode(")",$ans);
										$second = $explodeing[0];								
										$ansss = $second;
									}
									else
									{
										if(strpos($row_mat["mt_name"],"C.C.Cube") !== false || strpos($row_mat["mt_name"],"Flexural Strength of Concrete Beam") !== false)
										{
											$ansss = "Concrete";
										}
										else
										{
											if(strpos($row_mat["mt_name"],"FLY ASH BRICK") !== false || strpos($row_mat["mt_name"],"BURNT CLAY BRICK") !== false)
											{
												$ansss = "Brick";
											}
											else
											{
												$ansss =$row_mat["mt_name"];
											}
											
										}
										
									}
								
							}
											echo $ansss;
											
											
											?></b>
											<input type="hidden" value="<?php echo $row['material_id'];?>" name="material_id_hidden" id="material_<?php echo $material_count;?>">
											</td>
											<td>
											 <b>Report No:</b> <?php echo $row['report_no']; ?><br>
											 <b>Lab No:</b> <?php echo $row['lab_no']; ?><br>
											 
											<input type="hidden" name="labno" class="form-control" id="labno_<?php echo $material_count;?>" value="<?php echo $row['lab_no']; ?>" disabled style="width: 160px;">
											</td>
											<td style="width:250px;">
											<?php 
											$test_query="select * from span_material_assign WHERE `isdeleted`=0 AND `lab_no`='$row[lab_no]' AND `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' ORDER BY material_assign_id DESC";
										$result_for_test=mysqli_query($conn,$test_query);
										
										
										$print_test="";
										$tested_by="";
										while($rows=mysqli_fetch_array($result_for_test))
										{
											
										
										$sel_test="select * from test_master where `test_id`=".$rows['test'];
										$result_test=mysqli_query($conn,$sel_test);
										$row_test=mysqli_fetch_array($result_test);
											
											echo $row_test['test_name']." , ";
											$print_test .=$row_test['test_name']." , ";
											
											$result_expected_date= $rows['expected_date'];
											$tested_by=$rows['tested_by'];
										}
										
										?>
										<input type="hidden" name="testlist" class="form-control" id="testlist_<?php echo $material_count;?>" value="<?php echo $print_test; ?>">
											
										</td>
											<td>
											  <input type="text" name="startdate" class="form-control startdate_class" id="startdate_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo date('d-m-Y',strtotime($get_eng['start_date']));
											  }else{ echo date('d-m-Y',strtotime($job_row['sample_rec_date']));} ?>" style="width: 120px;">
											</td>
											
											
											<!--<td></td>-->
											  <input type="hidden" name="expdate" class="form-control expdate_class" id="expdate_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo date('d-m-Y',strtotime($get_eng['expected_date']));
											  }else{ echo date('d-m-Y',strtotime($result_expected_date));} ?>" style="width: 120px;">
											</td>
											
											<?php
											
											$sdate = $job_row['sample_rec_date'];
											$edate = $row['expected_date'];

											$date_diff = abs(strtotime($edate) - strtotime($sdate));
											$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

											?>
											
											<td>
											  <input type="text" name="day" class="form-control day" id="day_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo $get_eng['days'];
											  }else{ echo $days;} ?>" style="width: 50px;" >
											</td>
											
											<td>
											  <input type="text" name="enddate" class="form-control enddate_class" id="enddate_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo date('d-m-Y',strtotime($get_eng['end_date']));
											  }else{ echo date('d-m-Y',strtotime($result_expected_date));} ?>" style="width: 120px;">
											</td>
											
											<td>
											  <a href="<?php echo $base_url.$row_mat["filename"];?>?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr.$row['ulr_no']."F"; ?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span>Report</a>
											<?php
											
											if($get_eng["report_sent_to_qm"]=="1")
											{
											?>
											
											
											<?php
											//if scan document available in job
											
											$sel_jobs="select * from job where`trf_no`='$row[trf_no]' AND `job_number`='$row[job_no]'";
											$query_jobs= mysqli_query($conn,$sel_jobs);
											
											if(mysqli_num_rows($query_jobs) > 0){
												
											$get_jobs=mysqli_fetch_array($query_jobs);
											if($get_jobs['scan_document'] !=""){
											?>
											
											<a href="<?php echo $base_url."scan_document/".$get_jobs['scan_document'] ?>" class="btn btn-warning  btn3d" title="Downlaod Document" download><span class="glyphicon glyphicon-question-downlaod"></span> Download</a>
											
											<?php } }?>
											
											<!--<a href="<?php //echo $base_url.$row_mat["filename"];?>?lab_no=<?php //echo $row['lab_no']; ?>&&job_no=<?php// echo $_GET['job_no']; ?>&&report_no=<?php //echo $_GET['report_no']; ?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span>Report</a>-->
											&nbsp;
											<?php

											if($get_eng["accepted_by_qm"]==0){?>
											<a href="javascript:void(0);" class="btn btn-info btn-lg btn3d report_send_to_eng" data-id="<?php echo $row['lab_no']."|".$tested_by?>" title="Report Send To Accept"><span class="glyphicon glyphicon-question-list"></span> Reward</a>
											
											<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d report_send_to_accept" data-id="<?php echo $row['lab_no'];?>" title="Report Send To Accept"><span class="glyphicon glyphicon-question-list"></span> Accept Report</a>
											<!--<a href="javascript:void(0);" class="btn btn-danger btn-lg btn3d report_send_to_eng" data-id="<?php //echo $row['lab_no'];?>" title="Report Send To Engineer"><span class="glyphicon glyphicon-question-list"></span> Reward</a>-->
											<?php } else{
											if($get_eng["appoved_by_qm_to_print"]==0){
											?>
											<a href="javascript:void(0);" class="btn btn-warning btn-lg btn3d report_send_to_print" data-id="<?php echo $row['lab_no'];?>" title="Report Send To Accept"><span class="glyphicon glyphicon-question-list"></span>Send To Print</a>
											
											<?php }else{
												echo '<span style="color:green;font-size: 30px;">Report Sent</span>';
											}
											} 
											}else{
												
												echo '<span style="color:#f39c12;font-size: 30px; margin: 18%;">Pending</span>';
											}
											
											?>
											</td>
										  </tr>
									
										<?php 
									}
										$material_count++;
										
										//on load insert record if not available
										
										$sel_eng="Select * from job_for_engineer where `lab_no`='$row[lab_no]'";
										$query_eng= mysqli_query($conn,$sel_eng);
										
										$start_date= date('Y-m-d',strtotime($job_row['sample_rec_date']));
										$end_date= date('Y-m-d',strtotime($row['expected_date']));
										$dayses= $days;
										$get_lab_id= $row['lab_no'];
										$get_material_id= $row['material_id'];
										$get_test_id= $print_test;
										
										$get_trf_no= $_GET['trf_no'];
										$get_job_no= $_GET['job_no'];
										$get_expdate= date('Y-m-d',strtotime($row['expected_date']));
										
										if(mysqli_num_rows($query_eng) < 1 ){
											
											$insert_eng="insert into job_for_engineer (`material_id`,`trf_no`,`job_no`,`lab_no`,`test_list`,`start_date`,`end_date`,`issue_date`,`days`,`expected_date`,`createdby`,`createddate`,`modifiedby`,`modifieddate`) values('$get_material_id','$get_trf_no','$get_job_no','$get_lab_id','$get_test_id','$start_date','$end_date','$end_date','$dayses','$get_expdate','$_SESSION[name]','0000-00-00','','0000-00-00')";
											
											$result_insert_eng=mysqli_query($conn,$insert_eng);
										}
										
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
							<br>
						</div>
					</div>
				</div>
</section>	
</div>
  
	
<?php include("footer.php");?>
	  	  
<script>
$(document).ready(function(){
	

});

$('.startdate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
	
$('.enddate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});
$('.expdate_class').datepicker({
		  autoclose: true,
	  format: 'dd-mm-yyyy'
	});

//  start date change

$(document).on('change','.startdate_class',function(){
	var get_start_date= $(this).val();
	var get_id= $(this).attr('id');
	var only_id=get_id.split("_");
	var set_id="#enddate_"+only_id[1];
	var get_end_date= $(set_id).val();
	
	var a = moment(get_start_date,'D/M/YYYY');
	var b = moment(get_end_date,'D/M/YYYY');
	var diffDays = b.diff(a, 'days');
	
	var set_day="#day_"+only_id[1];
	$(set_day).val(diffDays);
	
	var labs_id="#labno_"+only_id[1];
	var get_lab_id=$(labs_id).val();
	
	var material_id="#material_"+only_id[1];
	var get_material_id=$(material_id).val();
	
	var test_id="#testlist_"+only_id[1];
	var get_test_id=$(test_id).val();
	
	var expdate="#expdate_"+only_id[1];
	var get_expdate=$(expdate).val();
	
	var txt_trf_no= $("#txt_trf_no").val();
	var get_job_no= $("#txt_job_no").val();
	
	
	// perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
	update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,txt_trf_no,get_job_no,get_expdate);
   
});

//  end date change

$(document).on('change','.enddate_class',function(){
	var get_end_date= $(this).val();
	var get_id= $(this).attr('id');
	var only_id=get_id.split("_");
	var set_id="#startdate_"+only_id[1];
	var get_start_date= $(set_id).val();
	
	var a = moment(get_start_date,'D/M/YYYY');
	var b = moment(get_end_date,'D/M/YYYY');
	var diffDays = b.diff(a, 'days');
	
	var set_day="#day_"+only_id[1];
	$(set_day).val(diffDays);
     
	 var labs_id="#labno_"+only_id[1];
	var get_lab_id=$(labs_id).val();
	
	var material_id="#material_"+only_id[1];
	var get_material_id=$(material_id).val();
	
	var test_id="#testlist_"+only_id[1];
	var get_test_id=$(test_id).val();
	
	var expdate="#expdate_"+only_id[1];
	var get_expdate=$(expdate).val();
	
	var txt_trf_no= $("#txt_trf_no").val();
	var get_job_no= $("#txt_job_no").val();
	
	
	// perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
	update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,txt_trf_no,get_job_no,get_expdate);
});


$(document).on('change','.day',function(){
	var diffDays= parseInt($(this).val());
	var get_id= $(this).attr('id');
	var only_id=get_id.split("_");
	var set_id="#startdate_"+only_id[1];
	var get_start_date= $(set_id).val();
	
	var datePieces = get_start_date.split("-");
	var preFinalDate = [datePieces[2] , datePieces[1] , datePieces[0]];
    
	var someDate = new Date(preFinalDate.join("-"));
	someDate.setDate(someDate.getDate() + diffDays);
	
	var dd = someDate.getDate();
	var mm = someDate.getMonth() + 1;
	var y = someDate.getFullYear();
	var get_end_date = dd +'-'+ mm +'-'+y;
	var set_end_date="#enddate_"+only_id[1];
	
	$(set_end_date).val(get_end_date);
	
	var labs_id="#labno_"+only_id[1];
	var get_lab_id=$(labs_id).val();
	
	var material_id="#material_"+only_id[1];
	var get_material_id=$(material_id).val();
	
	var test_id="#testlist_"+only_id[1];
	var get_test_id=$(test_id).val();
	
	var expdate="#expdate_"+only_id[1];
	var get_expdate=$(expdate).val();
	
	var txt_trf_no= $("#txt_trf_no").val();
	var get_job_no= $("#txt_job_no").val();
	
	
	// perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
	update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,txt_trf_no,get_job_no,get_expdate);
	location.reload();
});


function update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,txt_trf_no,get_job_no,get_expdate){
	
	var billData = '&action_type=update_engineer'+'&get_start_date='+get_start_date+'&get_end_date='+get_end_date+'&diffDays='+diffDays+'&get_lab_id='+get_lab_id+'&get_material_id='+get_material_id+'&get_test_id='+get_test_id+'&txt_trf_no='+txt_trf_no+'&get_job_no='+get_job_no+'&get_expdate='+get_expdate;
	
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: billData,
        success:function(msg){
          
        }
    });
	
	
}
//send report to accept by quality manager

$(document).on("click", ".report_send_to_accept", function () {
				var clicked_id = $(this).attr("data-id");  
				var txt_trf_no= $("#txt_trf_no").val();
				var job_no= $("#txt_job_no").val();
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=report_send_to_accept&clicked_id='+clicked_id+'&txt_trf_no='+txt_trf_no,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>view_job_by_qlty_manager_for_super_admin.php?trf_no="+txt_trf_no+'&&job_no='+job_no;
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

$(document).on("click", ".report_send_to_eng", function () {
				var clicked_id = $(this).attr("data-id");  
				var txt_trf_no= $("#txt_trf_no").val();
				var job_no= $("#txt_job_no").val();
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Reward This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=report_send_to_eng&clicked_id='+clicked_id+'&txt_trf_no='+txt_trf_no,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>view_job_by_qlty_manager_for_super_admin.php?trf_no="+txt_trf_no+'&&job_no='+job_no;
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

//send report to print by quality manager

$(document).on("click", ".report_send_to_print", function () {
				var clicked_id = $(this).attr("data-id");  
				var txt_trf_no= $("#txt_trf_no").val();
				var job_no= $("#txt_job_no").val();
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Print This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=report_send_to_print&clicked_id='+clicked_id+'&txt_trf_no='+txt_trf_no,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>view_job_by_qlty_manager_for_super_admin.php?trf_no="+txt_trf_no+'&&job_no='+job_no;
			
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