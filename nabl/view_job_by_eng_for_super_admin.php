<?php include("header.php");
  
?>

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
 
// update job table by report no and job no AND ALSO ENG LIGHT STATUS
$up_job="update job set `report_received`=1,`eng_light_status`=1 where `trf_no`='$txt_trf_no' AND `job_number`='$txt_jobs'";
mysqli_query($conn,$up_job);


//  update final_material_assign_master table if report not available in for this report no

$sel_final_material="select * from final_material_assign_master where `trf_no`='$txt_trf_no' AND `eng_light_status`!='2'";
$query_final_material=mysqli_query($conn,$sel_final_material);

if(!mysqli_num_rows($query_final_material) > 0){
	
	$up_job="update job set `eng_light_status`=2 where `trf_no`='$txt_trf_no' AND `job_number`='$txt_jobs'";
	mysqli_query($conn,$up_job);
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
		View Job
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body"  style="border:1px groove #ddd;">
							<br>
								<div class="row">
									<!--<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-2 control-label">S.R.F. No:</label>
									</div>-->
									
									<div class="col-sm-12">
									<label for="inputEmail3" class="col-sm-2 control-label">Lab No:</label>
									</div>
									
								</div>
								<div class="row">
									
										 <!-- <div class="col-sm-6">
										  </div>-->
										
										
										  
											<div class="col-sm-12">
											<input type="hidden" class="form-control" value="<?php echo $_GET['trf_no'];?>" id="txt_trf_no" name="txt_trf_no" >
												
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
											<th> Job No</th>
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
										  
											$show_go_button_once=0;
											$get_jobs="select  * from job where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]'";
											$query_job=mysqli_query($conn,$get_jobs);
											$job_row=mysqli_fetch_array($query_job);
											$getting_start_dates=date('d-m-Y',strtotime($job_row['sample_rec_date']));
											
											if($job_row["morr"]=="r"){
												
												$up_final="update final_material_assign_master set `light_status`='2' where `trf_no`='$_GET[trf_no]'";
												$query_up_final=mysqli_query($conn,$up_final);
											}
											
											$sel_span_tested_by="select * from span_material_assign where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' AND `tested_by`='$_GET[user_id]'";
											$query_span_tested_by=mysqli_query($conn,$sel_span_tested_by);
											
											$array_labs_nos=array();
											if(mysqli_num_rows($query_span_tested_by)>0)
											{
												while($one_span_tested_by=mysqli_fetch_array($query_span_tested_by))
												{
													if (!in_array($one_span_tested_by["lab_no"], $array_labs_nos))
													{
														array_push($array_labs_nos,$one_span_tested_by["lab_no"]);		
													}
												}
											}
										$count_of_materials=count($array_labs_nos);
										$material_count=1;
											foreach($array_labs_nos as $one_labs_nos)
											{
												
											$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$_GET[job_no]' AND `lab_no`='$one_labs_nos' ORDER BY final_material_id DESC";
										$result=mysqli_query($conn,$query);
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
										
										if($is_est==1 && $get_eng["report_sent_to_qm"]==1){
											$set_status="no";
										}elseif($is_est==1 && $get_eng["report_sent_to_qm"]==0){
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
										
										
										  ?>
										  <tr>
											
											<td><b><?php 
											
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
											<?php //echo $row['report_no']; ?><br>
											 <?php echo $row['lab_no']; ?><br>
											 
											<input type="hidden" name="labno" class="form-control" id="labno_<?php echo $material_count;?>" value="<?php echo $row['lab_no']; ?>" disabled style="width: 160px;">
											</td>
											<td style="width:250px;">
											<?php 
											$test_query="select * from span_material_assign WHERE `isdeleted`=0 AND `lab_no`='$row[lab_no]' AND `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' ORDER BY material_assign_id DESC";
										$result_for_test=mysqli_query($conn,$test_query);
										
										
										$print_test="";
										while($rows=mysqli_fetch_array($result_for_test))
										{
											
										
										$sel_test="select * from test_master where `test_id`=".$rows['test'];
										$result_test=mysqli_query($conn,$sel_test);
										$row_test=mysqli_fetch_array($result_test);
											
											echo $row_test['test_name']." , ";
											$print_test .=$row_test['test_name']." , ";
											
											$result_expected_date= $rows['expected_date'];
										}
										
										?>
										<input type="hidden" name="testlist" class="form-control" id="testlist_<?php echo $material_count;?>" value="<?php echo $print_test; ?>">
											
										</td>
											<td>
											  <input type="text" name="startdate" class="form-control startdate_class" id="startdate_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo date('d-m-Y',strtotime($get_eng['start_date']));
											  }else{ echo date('d-m-Y',strtotime($job_row['sample_rec_date']));} ?>" style="width: 120px;">
											</td>
											
											<!--<td>
											</td>-->
											  <input type="hidden" name="expdate" class="form-control expdate_class" id="expdate_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo date('d-m-Y',strtotime($get_eng['expected_date']));
											  }else{ echo date('d-m-Y',strtotime($result_expected_date));} ?>" style="width: 120px;">
											
											<?php
											
											$sdate = $job_row['sample_rec_date'];
											$edate = $row['expected_date'];

											$date_diff = abs(strtotime($edate) - strtotime($sdate));
											$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

											?>
											
											<td>
											<?php 
											if($row['is_sample']=="1"){ $set_bolding='width: 50px;font-weight: bold;';}else{ $set_bolding='width: 50px;';}
											?>
											  <input type="text" name="day" class="form-control day" id="day_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo $get_eng['days'];
											  }else{ echo $days;} ?>" style="<?php echo $set_bolding; ?>">
											</td>
											
											<td>
											  <input type="text" name="enddate" class="form-control enddate_class" id="enddate_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo date('d-m-Y',strtotime($get_eng['end_date']));
											  }else{ echo date('d-m-Y',strtotime($result_expected_date));} ?>" style="width: 120px;">
											</td>
											
											<td>
											<?php
											
													$tbl =  $row_mat["table_name"];
												    $query11 = "select * from $tbl WHERE lab_no='$row[lab_no]'  and `is_deleted`='0'";
													$result12 = mysqli_query($conn, $query11);
													$cnn =  mysqli_num_rows($result12);
													if ($cnn == 0) {?>
											
											<!--<button type="button" class="btn btn-warning btn-lg btn3d" onclick="saveMetal('<?php //echo $base_url.$row_mat["filename_lab"]; ?>','<?php //echo $row['lab_no']; ?>','<?php //echo $tbl;?>')" name="btn_save1" id="btn_save1" >LOAD</button>-->
									
											<?php 
											
											}
												
											if($is_est==1 && $get_eng["report_sent_to_qm"]==0){
											if($set_status  =="yes")
											{
											?>
											
											<a href="<?php echo $base_url.$row_mat["filename"];?>?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr.$row['ulr_no']."F"; ?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> Report</a>  
											
											<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d report_send_to_q_manager" data-id="<?php echo $row['lab_no'];?>" title="Report Send To Quality Managetr"><span class="glyphicon glyphicon-question-list"></span> Submit</a>
										<?php 
											}
										}else if($is_est==0){ 
											if($set_status=="yes")
											{
										?>
											<a href="<?php echo $base_url.$row_mat["filename"];?>?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr.$row['ulr_no']."F"; ?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span> Report</a>
											
											
											<a href="javascript:void(0);" class="btn btn-success btn-lg btn3d report_send_to_q_manager" data-id="<?php echo $row['lab_no'];?>" title="Report Send To Quality Managetr"><span class="glyphicon glyphicon-question-list"></span> Submit</a>
										<?php 
											}
										}else{  } 
										
											
										
										?>
											</td>
										  </tr>
										<?php 
									
										
										
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
										
										} 
										
										$material_count++;
										
										}
										
										?>
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

$(document).ready(function()
{
	$(".all_chk").click(function () 
	{
       $(".chk_mate_class").prop('checked', $(this).prop('checked'));
	});

});



var count_of_materials='<?php echo $count_of_materials;?>';
var getting_start_dates='<?php echo $getting_start_dates;?>';


var i;
for (i = 1; i <= count_of_materials; i++) 
{
    var set_start_ids="#startdate_"+i;
    var set_end_ids="#enddate_"+i;
	
	$(set_start_ids).datepicker({
		  autoclose: true,
	      format: 'dd-mm-yyyy',
		  startDate: "'"+getting_start_dates+"'"
	});
	
	var get_start_dates=$(set_start_ids).val();
	$(set_end_ids).datepicker({
		  autoclose: true,
	      format: 'dd-mm-yyyy',
		  startDate: "'"+get_start_dates+"'"
	});
	
}

	

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
	
   location.reload();
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
	location.reload();
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
//send report to quality manage

$(document).on("click", ".report_send_to_q_manager", function () {
				var clicked_id = $(this).attr("data-id");  
				var txt_trf_no= $("#txt_trf_no").val();
				var job_no= $("#txt_job_no").val();
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Report To Quality Manager?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=send_to_qlty_manager&clicked_id='+clicked_id+'&txt_trf_no='+txt_trf_no,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>view_job_by_eng_for_super_admin.php?trf_no="+txt_trf_no+'&&job_no='+job_no;
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

//send ALL report to quality manage

$(document).on("click", ".all_report_send", function () {
				
				 
				var arr_chk = [];
				$('input.chk_mate_class:checkbox:checked').each(function () {
				arr_chk.push($(this).val());
				});
				if (arr_chk && arr_chk.length == 0) {
					alert("Please Check Atlist One Checkbox");
					return false;
				}
				var txt_trf_no= $("#txt_trf_no").val();
				var job_no= $("#txt_job_no").val();
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Send All Report To Bill?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=all_report_send&clicked_id='+arr_chk+'&txt_trf_no='+txt_trf_no,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>view_job_by_eng_for_super_admin.php?trf_no="+txt_trf_no+'&&job_no='+job_no;
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

//send job to print

$(document).on("click", ".job_send_to_complete", function () {
				var clicked_id = $(this).attr("data-id"); 
				var explode_report_job_no= clicked_id.split("|");
				var reports_no= explode_report_job_no[0];
				var jobs_no= explode_report_job_no[1];
	$.confirm({
        title: "warning",
        content: "Are You Sure To Sent To Bill This Job ?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=job_send_to_complete&clicked_id='+clicked_id,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>span_set_rate_final_bill.php?report_no="+reports_no+"&&job_no="+jobs_no;
			
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});

//LOAD Report


function saveMetal(url,labno1,tblnm){
	
	var txt_report_no= $("#txt_report_no").val();
	var job_no= $("#txt_job_no").val();
	var urls = url;
	var tblnms = tblnm;
	var lab_no = labno1;
	
	$.ajax({
        type: 'POST',
		dataType:'JSON',
        url: urls,
        data: 'action_type=save_file&job_no='+job_no+'&report_no='+txt_report_no+'&lab_no='+lab_no,		
		beforeSend: function(){
		document.getElementById("overlay_div").style.display="block";
		},
        success:function(data){
			//alert(data);
			var ds = data.test_check;
			if(tblnms=="wbm_11_2_mm")
			{
			calculations(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");
			}
			else if(tblnms=="wbm_13_2_mm")
			{
			calculations13_2(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="wbm_13_2_mm")
			{
			calculations13_2(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="wbm_53_22_4")
			{
			calculations53_22_4(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="wmm_53_22_4")
			{
			calculations_wmm_53_22_4(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="wbm_45_63_mm")
			{
			calculations45_63(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="wbm_45_90_mm")
			{
			calculations45_90(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="wmm_stone_dust")
			{
			cal_wmm_stone_dust(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="wmm_11_20_22_4_mm")
			{
			cal_wmm_11_20_22_4(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="wmm_45_75_mic")
			{
			cal_wmm_45_0_075(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="wmm_2_36_11_20_mm")
			{
			cal_wmm_2_36_11_20(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bitumin_span")
			{ 
			cal_bitumen(txt_report_no,job_no,lab_no,ds,data.grades,data.tank,data.lot,data.make,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="span_cement")
			{ 
			cal_span_cement(txt_report_no,job_no,lab_no,ds,data.type_of_cement,data.cement_grade,data.cement_brand,data.week_number,"<?php echo date('d-m-Y',strtotime($job_row['sample_rec_date'])); ?>","<?php echo $base_url;?>");	
			}
			else if(tblnms=="span_paver_block")
			{ 
			cal_paverblock(txt_report_no,job_no,lab_no,ds,data.paver_shape,data.paver_age,data.paver_thickness,data.paver_grade,data.paver_color,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="span_c_c_cube")
			{ 
			cal_cc_cube(txt_report_no,job_no,lab_no,ds,data.cube_grade,data.casting_date,data.day,data.set_of_cube,data.no_of_cube,data.day_remark,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="span_brick")
			{ 
			cal_brick(txt_report_no,job_no,lab_no,ds,data.mark,data.brick_specification,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="sand")
			{ 
			cal_sand(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bc_19_0_075_mm")
			{
			cal_bc_19_0_075(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bc_9_5_0_075_mm")
			{
			cal_bc_9_5_0_075(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");		
			}
			else if(tblnms=="bm_mix_material_40_mm")
			{
			cal_bm_mix(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="dbm_37_5_0_075_mm")
			{
			cal_dbm_mix(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="dbm_26_5_0_075_mm")
			{
			cal_dbm_mix_2(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_1")
			{
			cal_gsb_1_m4(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_5")
			{
			cal_gsb_5_m5(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bm_mix_material_19_mm")
			{
			cal_bm_mix_19(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_2")
			{
			cal_gsb_2_m4_1(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_6")
			{
			cal_gsb_6_m5(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bc_2_36_0_075_mm")
			{
			cal_bc_2_36_0_075(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="sdbc_10_mm")
			{
			cal_sdbc_10_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_2_m5")
			{
			cal_gsb_2_m5(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_1_m5")
			{
			cal_gsb_1_m5(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="coarse_aggregate")
			{
			cal_busg_mix_ca(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_3")
			{
			cal_gsb_3_mix_m4_1(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bc_19_0_13_2_mm")
			{
			cal_bc_19_0_13_2(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bc_13_2_9_5_mm")
			{
			cal_bc_13_2_9_5(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bm_26_5_19_mm")
			{
			cal_bm_26_5_19(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}	
			else if(tblnms=="bm_37_5_26_5_mm")
			{
			cal_bm_37_5_26_5(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bm_19_13_2_mm")
			{
			cal_bm_19_13_2(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bm_4_75_13_20_mm")
			{
			cal_bm_4_75_13_20(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="dbm_37_5_26_5_mm")
			{
			cal_dbm_37_5_26_5(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="dbm_19_0_13_2_mm")
			{
			cal_dbm_19_0_13_2(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="dbm_26_5_19_0_mm")
			{
			cal_dbm_26_5_19_0(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="dbm_13_2_4_75_mm")
			{
			cal_dbm_13_2_4_75(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}	
			else if(tblnms=="sdbc_9_50_13_2_mm")
			{
			cal_sdbc_9_50_13_2(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="53_0_26_5_mm")
			{
			cal_53_0_26_5_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="26_5_4_75_mm")
			{
			cal_26_5_4_75_gsv(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bc_9_5_4_75_mm")
			{
			cal_bc_9_5_4_75(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bc_4_75_2_36_mm")
			{
			cal_bc_4_75_2_36(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bm_4_75_2_36_mm")
			{
			cal_bm_4_75_2_36(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="dbm_4_75_2_36_mm")
			{
			cal_dbm_4_75_2_36(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="sdbc_9_50_4_75_mm")
			{
			cal_sdbc_9_50_4_75_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="sdbc_2_36_4_75_mm")
			{
			cal_sdbc_2_36_4_75_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="sdbc_2_36_0_075_mm")
			{
			cal_sdbc_2_36_0_075_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="key_aggregate")
			{
			cal_key_aggregate(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="busg_25_40_mm")
			{
			cal_busg_25_40_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="busg_10_20_mm")
			{
			cal_busg_10_20_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_1_m4")
			{
			cal_gsb_1_m4(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_2_m4")
			{
			cal_gsb_2_m4_2(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_3_m5")
			{
			cal_gsb_3_m5(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_4")
			{
			cal_gsb_4(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bm_2_36_0_075_mm")
			{
			cal_bm_2_36_0_075_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bm_2_36_0_075_mm")
			{
			cal_bm_2_36_0_075_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="bc_0_300_mm")
			{
			cal_bc_0_300_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="dbm_2_36_0_075_mm")
			{
			cal_dbm_2_36_0_075_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="stone_dust_below_2_36_mm")
			{
			cal_stone_dust_below_2_36_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="gsb_3_m4_2")
			{
			cal_gsb_3_m4_2(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="busg_6_10_mm")
			{
			cal_busg_6_10_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="busg_5_6_mm")
			{
			cal_busg_5_6_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="mss_11_2_0_090_mm")
			{
			cal_mss_11_2_0_090_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="mss_5_6_0_090_mm")
			{
			cal_mss_5_6_0_090_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="mss_13_2_5_6_mm")
			{
			cal_mss_13_2_5_6_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="mss_11_2_5_6_mm")
			{
			cal_mss_11_2_5_6_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="m_63_mm")
			{
			cal_m_63_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="m_40_mm")
			{
			cal_m_40_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="kapachi_20_mm")
			{
			cal_kapachi_20_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="k_16_mm")
			{
			cal_k_16_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="grit_12_5_mm")
			{
			cal_grit_12_5_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="kapachi_10_mm")
			{
			cal_kapachi_10_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="mss_5_6_2_80_mm")
			{
			cal_mss_5_6_2_80_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			else if(tblnms=="mss_2_80_0_090_mm")
			{
			cal_mss_2_80_0_090_mm(txt_report_no,job_no,lab_no,ds,"<?php echo $base_url;?>");	
			}
			document.getElementById("overlay_div").style.display="none";
			alert("Report Generated...");
			location.reload(true);
        }
    });
}
</script>