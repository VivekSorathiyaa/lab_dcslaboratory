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
	$temporary_trf_no= $_GET["temporary_trf_no"];  

 

 

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
   
  
<section class="content view-reports-by-eng-trf-box">
			<?php include("menu.php") ?>
			<div class="row">
		
		<h1 style="text-align:center;">
		View Reports
		</h1>
	</div>
<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						
							<div class="box-body">
							<br>
								<div class="row">
									<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-2 control-label">S.R.F. No:</label>
									</div>
									
									<div class="col-sm-6">
									<label for="inputEmail3" class="col-sm-2 control-label">Job No:</label>
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
								<div class="box box-info-inner">
									<div class="box-body">
									  <div class="table-responsive" id="display_data">
										<table class="table table-bordered no-margin">
										  <thead>
										  <tr>
											<th>material</th>
											<th> No</th>
											<th>Test List</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Exp. Sub. Date</th>
											<th>Days</th>
											<th>Action</th>
										  </tr>
										  </thead>
										  <tbody>
										  <?php
											$sel_static_ulr="select  * from ulr_no where `ulr_status`=0 AND `ulr_is_deleted`=0";
											$query_static_ulr=mysqli_query($conn,$sel_static_ulr);
											$result_static_ulr=mysqli_fetch_array($query_static_ulr);
											$static_ulr=$result_static_ulr["ulr_no"];
											
											$get_jobs="select  * from job where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' AND `temporary_trf_no`='$_GET[temporary_trf_no]'";
											$query_job=mysqli_query($conn,$get_jobs);
											$job_row=mysqli_fetch_array($query_job);
											
											$sel_span_materials="select * from span_material_assign where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' AND `temporary_trf_no`='$_GET[temporary_trf_no]' ";
											$result_span_materials=mysqli_query($conn,$sel_span_materials);
											
											$array_set_lab_ids=array();
											if(mysqli_num_rows($result_span_materials)>0)
											{
												while($one_labs_ids=mysqli_fetch_array($result_span_materials))
												{
													if (!in_array($one_labs_ids["lab_no"], $array_set_lab_ids))
													{
														array_push($array_set_lab_ids,$one_labs_ids["lab_no"]);
													}
												}
											}
											
											foreach($array_set_lab_ids as $one_lab_ids)
											{
											
											$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$_GET[job_no]' AND `lab_no`='$one_lab_ids' ORDER BY final_material_id DESC";
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
										$mat_prefix= $row_mat["mt_prefix"];
									if($set_status=="yes")
									{
										?>
										  <tr>
											<td><b><?php echo $row_mat["mt_name"];?></b>
											<input type="hidden" value="<?php echo $row['material_id'];?>" name="material_id_hidden" id="material_<?php echo $material_count;?>">
											</td>
											<td>
											 <b>Report No:</b> <?php echo $row['report_no']; ?><br>
											 <b>Lab No:</b> <?php echo $row['lab_no']; ?><br>
											 <b>Ulr No:</b> <?php echo $static_ulr.$row['ulr_no']."F"; ?>
											<!--<input type="text" name="labno" class="form-control" id="labno_<?php //echo $material_count;?>" value="<?php //echo $row['lab_no']; ?>" disabled style="width: 160px;">-->
											
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
											$casting_date_of_span= $rows['casting_date'];
											$span_days= $rows['cc_day'];
										}
										
										if($mat_prefix=="CC")
										{
											$starting_date= $casting_date_of_span;
											$span_daying= $span_days;
											$ending_date= date('Y-m-d', strtotime($starting_date. ' + '.$span_daying.' days'));
											
										}else
										{
											$starting_date= $job_row['sample_rec_date'];
											$span_daying="";
											$ending_date= $result_expected_date;
										}
										?>
										<input type="hidden" name="testlist" class="form-control" id="testlist_<?php echo $material_count;?>" value="<?php echo $print_test; ?>">
											
										</td>
											<td>
											  <input type="text" name="startdate" class="form-control startdate_class" id="startdate_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo date('d-m-Y',strtotime($get_eng['start_date']));
											  }else{ echo date('d-m-Y',strtotime($starting_date));} ?>" style="width: 120px;">
											</td>
											<td>
											  <input type="text" name="enddate" class="form-control enddate_class" id="enddate_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo date('d-m-Y',strtotime($get_eng['end_date']));
												  $var_na_name=date('d-m-Y',strtotime($get_eng['end_date']));
											  }else{ echo date('d-m-Y',strtotime($ending_date));
													 $var_na_name=date('d-m-Y',strtotime($ending_date));
											  } ?>" style="width: 120px;">
											  <?php if(date('l', strtotime($var_na_name))=="Wednesday"){ $colored="#F70000";}else{ $colored="#004500"; }?>
											  <span style="color:<?php echo $colored;?>;font-weight:bold;font-size:17px;"><?php  echo date('l', strtotime($var_na_name));?></span>
											</td>
											
											<td>
											  <input type="text" name="expdate" class="form-control expdate_class" id="expdate_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo date('d-m-Y',strtotime($get_eng['expected_date']));
												  $var_na_name_ex=date('d-m-Y',strtotime($get_eng['expected_date']));
											  }else{ echo date('d-m-Y',strtotime($ending_date));
													 $var_na_name_ex=date('d-m-Y',strtotime($ending_date));
											  } ?>" style="width: 120px;">
											  <?php if(date('l', strtotime($var_na_name_ex))=="Wednesday"){ $colored_ex="#F70000";}else{ $colored_ex="#004500"; }?>
											  <span style="color:<?php echo $colored_ex;?>;font-weight:bold;font-size:17px;"><?php  echo date('l', strtotime($var_na_name_ex));?></span>
											</td>
											
											<?php
											
											$sdate = $job_row['sample_rec_date'];
											$edate = $row['expected_date'];

											$date_diff = abs(strtotime($edate) - strtotime($sdate));
											$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
											
											if($span_daying !="")
											{
												$days_to_put= $span_daying;
											}else
											{
												$days_to_put= $days;
											}

											?>
											
											<td>
											  <input type="text" name="day" class="form-control day" id="day_<?php echo $material_count;?>" value="<?php if($is_est==1){
												  echo $get_eng['days'];
											  }else{ echo $days_to_put;} ?>" style="width: 50px;" disabled>
											</td>
											
											<td>
											  <a href="<?php echo $base_url.$row_mat["filename"];?>?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr.$row['ulr_no']."F"; ?>" class="btn btn-primary btn-lg btn3d" title="View Job"><span class="glyphicon glyphicon-question-list"></span>Report</a>
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
											
											$insert_eng="insert into job_for_engineer (`material_id`,`trf_no`,`job_no`,`lab_no`,`test_list`,`start_date`,`end_date`,`issue_date`,`days`,`expected_date`,`createdby`,`createddate`,`modifiedby`,`modifieddate`) values('$get_material_id','$get_trf_no','$get_job_no','$get_lab_id','$get_test_id','$starting_date','$ending_date','$ending_date','$days_to_put','$ending_date','$_SESSION[name]','0000-00-00','','0000-00-00')";
											
											$result_insert_eng=mysqli_query($conn,$insert_eng);
										}
										
										} 
										
										}
										?>
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
	
	var get_report_no= $("#txt_report_no").val();
	var get_job_no= $("#txt_job_no").val();
	
	
	// perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
	update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,get_report_no,get_job_no,get_expdate);
   
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
	
	var get_report_no= $("#txt_report_no").val();
	var get_job_no= $("#txt_job_no").val();
	
	
	// perameter 1 sdate 2 enddate 3 days 4 labid 5 materialid 6 testids 7 reportno 8 jobno 9 expdate
	update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,get_report_no,get_job_no,get_expdate);
});


function update_table_job_for_engineer(get_start_date,get_end_date,diffDays,get_lab_id,get_material_id,get_test_id,get_report_no,get_job_no,get_expdate){
	
	var billData = '&action_type=update_engineer'+'&get_start_date='+get_start_date+'&get_end_date='+get_end_date+'&diffDays='+diffDays+'&get_lab_id='+get_lab_id+'&get_material_id='+get_material_id+'&get_test_id='+get_test_id+'&get_report_no='+get_report_no+'&get_job_no='+get_job_no+'&get_expdate='+get_expdate;
	
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
			window.location.href="<?php echo $base_url; ?>view_job_by_qlty_manager.php?trf_no="+txt_trf_no+'&&job_no='+job_no;
			
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
				var txt_report_no= $("#txt_report_no").val();
				var job_no= $("#txt_job_no").val();
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Accept This Report?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>save_span_engineer.php',
        data: 'action_type=report_send_to_eng&clicked_id='+clicked_id+'&txt_report_no='+txt_report_no,
        success:function(html){
			window.location.href="<?php echo $base_url; ?>view_job_by_qlty_manager.php?report_no="+txt_report_no+'&&job_no='+job_no;
			
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
			window.location.href="<?php echo $base_url; ?>view_job_by_qlty_manager.php?trf_no="+txt_trf_no+'&&job_no='+job_no;
			
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
