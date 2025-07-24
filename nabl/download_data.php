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
  
	if($_SESSION['isadmin'] =="2")
	{ 
	
		$get_jobs_print_copmlete="select  * from job where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]' AND `print_done_by_biller_for_qm_see`=1";
		 $query_job_print_copmlete=mysqli_query($conn,$get_jobs_print_copmlete);
		 if(mysqli_num_rows($query_job_print_copmlete) <= 0)
		 {
	?>
	<script >
	alert("Sorry this Job Not Done By Biller...");
	window.location.href="<?php echo $base_url; ?>list_of_completed_job_report_for_reception.php";
	</script>
	<?php } 
	} ?>
		
	<?php 
 

$query="SELECT * FROM fyearmaster WHERE `fy_status`='1'";
  
     $qrys = mysqli_query($conn,$query);
    $no_of_rows=mysqli_num_rows($qrys);
    if($no_of_rows>0){
                
      $r = mysqli_fetch_array($qrys);
      $year=$r['fy_name'];      
    }
   $get_query = "select COUNT(*) as cnt from estimate_total_span WHERE `est_isdeleted`='0'"; 
    $select_result = mysqli_query($conn, $get_query);
    
    $result=mysqli_fetch_array($select_result);
    $esticnt=$result['cnt'];


    $get_query1 = "select COUNT(*) as cnt from estimate_total_span WHERE `est_isdeleted`='0' AND `is_billing`='1'"; 
    $select_result1 = mysqli_query($conn, $get_query1);
    
    $result1=mysqli_fetch_array($select_result1);
    $billcnt=$result1['cnt'];

    $get_query2 = "select COUNT(*) as cnt from job WHERE `jobisdeleted`='0'"; 
    $select_result2 = mysqli_query($conn, $get_query2);
    
    $result2=mysqli_fetch_array($select_result2);
    $usercnt=$result2['cnt'];


    $get_query3 = "select COUNT(*) as cnt from agency_master"; 
    $select_result3 = mysqli_query($conn, $get_query3);
    
    $result3=mysqli_fetch_array($select_result3);
    $agencycnt=$result3['cnt'];
	
	
	$cur = date('Y-m-d');
	$get_query_cur = "select COUNT(*) as cnt from job WHERE `jobisdeleted`='0' and `jobcreateddate` = '$cur'"; 
    $select_result_cur = mysqli_query($conn, $get_query_cur);
    
    $result_cur=mysqli_fetch_array($select_result_cur);
    $usercnt_cur=$result_cur['cnt'];

	 $get_query_es = "select sum(total_amt) as sm from estimate_total_span WHERE `est_isdeleted`='0' AND `estimate_date` = '$cur' and `is_billing`='0'"; 
    $select_result1_es = mysqli_query($conn, $get_query_es);
    
    $result1_es=mysqli_fetch_array($select_result1_es);
    $total_amt=$result1_es['sm'];
	
	
	 $get_query_es = "select * from estimate_total_span WHERE `est_isdeleted`='0' AND `est_modifydate` = '$cur' and `is_billing`='1'";
    $select_result1_es = mysqli_query($conn, $get_query_es);
    $tt=0;    
	while($row1=mysqli_fetch_array($select_result1_es))
	{
		 $patytp=$row1['paytype'];
		
		if($patytp != 3)
		{
			$tt += $row1['total_amt'];
		}
	}

$testings="http://192.168.0.195/geo_lab/";
?>

<style>
#billing label {
    display: block;
    text-align: center;
    line-height: 150%;
    font-size: .85em;
}


.a_design{
	
	    border-bottom-right-radius: 48px;
		width: 96%;
}
.box_design{
	border-bottom-right-radius: 50px;
    border-top-right-radius: 50px;
}
.daily_design{
	border-radius: 50px;
}

.user_rotate{
	transition: 0.90s;
  -webkit-transition: 0.90s;
  -moz-transition: 0.90s;
  -ms-transition: 0.90s;
  -o-transition: 0.90s;
}
.user_rotate:hover {
   transition: 5s;
  -webkit-transition: 0.90s;
  -moz-transition: 0.90s;
  -ms-transition: 0.90s;
  -o-transition: 0.90s;
  -webkit-transform: rotate(360deg);
  -moz-transform: rotate(360deg);
  -o-transform: rotate(360deg);
  -ms-transform: rotate(360deg);
  transform: rotate(360deg);
}


.eng_rotate:hover {  
   opacity: 1;
   
   /*Reflection*/
  -webkit-box-reflect: below 0px -webkit-gradient(linear, left top, left bottom, from(transparent), color-stop(.7, transparent), to(rgba(0,0,0,0.4)));
 
   /*Glow*/
  -webkit-box-shadow: 0px 0px 20px rgba(255,255,255,0.8);
  -moz-box-shadow: 0px 0px 20px rgba(255,255,255,0.8);
  box-shadow: 0px 0px 20px rgba(255,255,255,0.8);
}
</style>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px !important;">
   
  
<section class="content download-data-box" style="padding: 0px;
     margin-right: auto;
     margin-left: auto; 
     padding-left: 0px; 
     padding-right: 0px; ">
			<?php include("menu.php") ?>
			<div class="row">
				<h1 style="text-align:center;font-size:26px;">Download Section For (S.R.F. No:<?php echo $_GET['trf_no'];?>)	</h1>
			</div>

	<div class="row">
		<div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">List of reports</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
						<?php
											$sel_static_ulr="select  * from ulr_no where `ulr_status`=0 AND `ulr_is_deleted`=0";
											$query_static_ulr=mysqli_query($conn,$sel_static_ulr);											
											$result_static_ulr=mysqli_fetch_array($query_static_ulr);											
											$static_ulr=$result_static_ulr["ulr_no"];
											$get_jobs="select  * from job where `trf_no`='$_GET[trf_no]' AND `job_number`='$_GET[job_no]'";
											$query_job=mysqli_query($conn,$get_jobs);
											$job_row=mysqli_fetch_array($query_job);
											
											if($job_row["morr"]=="r"){
												
												$up_final="update final_material_assign_master set `light_status`='2' where `trf_no`='$_GET[trf_no]'";
												$query_up_final=mysqli_query($conn,$up_final);
											}
											
											$query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$_GET[job_no]' ORDER BY final_material_id DESC";
										$result=mysqli_query($conn,$query);
										$material_count=1;
										$merged_all_report_print=array();
										$merged_all_back_cal_print=array();
										while($row=mysqli_fetch_array($result))
										{
										    $sel_end_date="select `end_date` from job_for_engineer where  `trf_no`='$_GET[trf_no]' AND `job_no`='$_GET[job_no]' AND `lab_no`='$row[lab_no]'";
											$result_end_date=mysqli_query($conn,$sel_end_date);
											$row_end_date=mysqli_fetch_array($result_end_date);
											$get_end_date=$row_end_date["end_date"];
											$today_dates= date("Y-m-d");
											//if($get_end_date <= $today_dates)
											//{
											$sel_mat="select * from material where `id`=".$row['material_id'];
											$result_mat=mysqli_query($conn,$sel_mat);
											$row_mat=mysqli_fetch_array($result_mat);
											if($row["accept_by_tm"]=="1")
											{											
										
						?>
                    <li>
					  <div class="col-md-11">
						  <!-- USERS LIST -->
						  <div class="box box-info-inner list-report-box">
							<div class="box-header">
							 <span class="mailbox-attachment-icon"><i class="fa fa-file"></i></span>

							  <div class="mailbox-attachment-info" style="height: auto;width:100%;">
								<span style="font-size: 18px;"><b><?php echo $row_mat["mt_name"];?></b></span>
								<span class="mailbox-attachment-size" style="font-size: 15px;margin-top:5px;"> REPORT NO: <?php echo $row['report_no']; ?><br> ULR NO: <?php echo $static_ulr.$row['ulr_no']."F"; ?><br>
							    </span>
									
										<?php
										$strs = $base_url.'print_report/'.$row_mat["print_report"].'?lab_no='.$row["lab_no"].'&&job_no='.$_GET["job_no"].'&&report_no='.$_GET["report_no"].'&&tbl_name='.$row_mat["table_name"];?>
									   <a target = '_blank' href="<?php echo $base_url.'print_report/'?><?php echo $row_mat["print_report"];?>?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr.$row['ulr_no']."F"; ?>&&tbl_name=<?php echo $row_mat["table_name"];?>" class="btn btn-default btn-xs pull-left" style="font-size: 12px;padding: 10px;border-radius: 20px;margin-top: 20px;"><i class="fa fa-print" ></i> REPORT PRINT</a>

									    <!--<?php ?>
										<a target = '_blank' href="<?php echo $base_url.'back_cal_report/'?><?php echo $row_mat["print_back"];?>?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr.$row['ulr_no']."F"; ?>&&tbl_name=<?php echo $row_mat["table_name"];?>" class="btn btn-default btn-xs pull-right" style="font-size: 12px;padding: 10px;border-radius: 20px;margin-top: 20px;"><i class="fa fa-print"></i>OBSERVATION PRINT</a>
									    <?php  ?>-->
										
										<a href="<?php echo $base_url . "upload_wriiten_obs/" . $get_jobs['upload_obs'] ?>" class="btn btn-success  btn3d" title="Downlaod Document" download><span class="glyphicon glyphicon-question-downlaod"></span> Download</a>

										<?php
										$merging_all_report_print = $base_url.'print_report_for_excel/'.$row_mat["print_report"]."?job_no=".$row["job_no"].'&&report_no='.$row['report_no'].'&&lab_no='.$row["lab_no"].'&&trf_no='.$row["trf_no"];
										?>
										<!--<a target = '_blank' href="<?php echo $base_url.'print_report_source/'?><?php echo $row_mat["print_back"];?>?trf_no=<?php echo $row['trf_no']; ?>&&job_no=<?php echo $row['job_no']; ?>&&lab_no=<?php echo $row['lab_no']; ?>&&report_no=<?php echo $row['report_no']; ?>&&ulr=<?php echo $static_ulr.$row['ulr_no']."F"; ?>&&tbl_name=<?php echo $row_mat["table_name"];?>" class="btn btn-default btn-xs pull-left" style="font-size: 12px;padding: 10px;border-radius: 20px;margin-top: 10px;" download="<?php echo $row_mat["table_name"];?>"><i class="fa fa-print" ></i>SOURCE CODE</a> --> 


										<!--<form action="export_excel.php" method="POST" target="_blank">
										<input type="hidden" name="file_names" value="<?php echo $row_mat["print_report"]; ?>">
										<input type="hidden" name="merged_reports" value="<?php echo $merging_all_report_print; ?>">
										<input type="submit" name="submit_report" value="EXCEL" class="btn btn-default form-control fa fa-print pull-right" style="height: 35px;font-size: 13px;padding: 7px;border-radius: 20px;margin-top: 10px;width:100px;">
										</form> -->
							  </div>
							
							</div>
						  </div>
					</div>
                    </li>
					<?php
					
					$merging_all_report_print = $base_url.$testings.'nabl/print_report/'.$row_mat["print_report"]."?trf_no=".$row["trf_no"].'&&job_no='.$row['job_no'].'&&lab_no='.$row["lab_no"].'&&report_no='.$row["report_no"].'&&ulr='.$static_ulr.$row["ulr_no"].'F'.'&&tbl_name='.$row_mat["table_name"];
						
					$merging_all_back_cal_print =$base_url.$testings.'nabl/back_cal_report/'.$row_mat["print_back"].'?trf_no='.$row["trf_no"].'&&job_no='.$row["job_no"].'&&lab_no='.$row["lab_no"].'&&report_no='.$row["report_no"].'&&ulr='.$static_ulr.$row["ulr_no"].'F'.'&&tbl_name='.$row_mat["table_name"];
						
						array_push($merged_all_report_print,$merging_all_report_print);
						array_push($merged_all_back_cal_print,$merging_all_back_cal_print);
					}
					//}
					}
						$implode_reports=implode(",",$merged_all_report_print);				
						$implode_back_cals=implode(",",$merged_all_back_cal_print);				
					?>
                    
                  </ul>
                  <!-- /.users-list -->
                </div>
               
			<!--   <div class="row m-0" style="">
			
					<div class="col-md-3">
					<form action="bulk_reports_back_cal_print.php" method="POST" target="_blank">
					<input type="hidden" name="chk_trf" value="<?php echo $base_url.$testings; ?>nabl/print_trf.php?trf_no=<?php echo $_GET['trf_no'];?>&&job_no=<?php echo $_GET['job_no'];?>&&temporary_trf_no=<?php echo $_GET['temporary_trf_no'];?>">
					<input type="submit" name="submit_trf" value="TRF" class="btn btn-primary form-control" style="height:0%;">
					</form>
					</div>
					
					<div class="col-md-3">
					<form action="bulk_reports_back_cal_print.php" method="POST" target="_blank">
					<input type="hidden" name="chk_job_card" value="<?php echo $base_url.$testings; ?>nabl/print_job_card.php?trf_no=<?php echo $_GET['trf_no'];?>&&job_no=<?php echo $_GET['job_no'];?>&&temporary_trf_no=<?php echo $_GET['temporary_trf_no'];?>">
					<input type="submit" name="submit_job_card" value="JOB CARD" class="btn btn-primary form-control" style="height:0%;">
					</form>
					</div>
					
					<div class="col-md-3">
					<form action="bulk_reports_back_cal_print.php" method="POST" target="_blank">
					<input type="hidden" name="merged_reports" value="<?php echo $implode_reports;?>">
					<input type="submit" name="submit_report" value="ALL REPORTS" class="btn btn-primary form-control" style="height:0%;">
					</form>
					</div>
					<?php if($_SESSION['isadmin'] !="2"){ ?>
					<div class="col-md-3">
					<form action="bulk_reports_back_cal_print.php" method="POST" target="_blank">
					<input type="hidden" name="merged_back_cal" value="<?php echo $implode_back_cals;?>">
					<input type="submit" name="submit_back_cal" value="ALL OBSERVATION SHEET" class="btn btn-primary form-control" style="height:0%;">
					</form>
					</div>
					<?php } ?>
					
					
			</div> -->
			<br>



                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
			
	</div>
	<br>
	

</section>	
</div>  
	
<?php include("footer.php");?>		  
		  
<script>

</script>
<script>


	/*$("#btn_search").click(function(){
					
					var from_date = $('#from_date').val(); 
					var to_date = $('#to_date').val(); 
					
					var postData = '&from_date='+from_date+'&to_date='+to_date+'&get_by_rece_second=get_by_rece_second';
			
					$.ajax({
						url : "<?php echo $base_url; ?>search_job_listing.php",
						type: "POST",
						data : postData,
						success: function(data,status,  xhr)
						 {
							
							$("#display_data").html(data);

						 }

					}); 
	});*/
	
	
	/*function deleteData(type,id){ 
    id = (typeof id == "undefined")?'':id;
    var statusArr = {add:"added",edit:"updated",delete:"deleted"};
    var billData = '';
  
     if (type == 'delete'){
		
			billData = 'action_type='+type+'&id='+id;
				
    }
    $.ajax({
        type: 'POST',
        url: '<?php echo $base_url; ?>delete_ess_bill.php',
        data: billData,
        success:function(msg){
			alert("kkkkkk");
            if(msg == 'ok'){
                alert('Bill data has been '+statusArr[type]+' successfully.');
                getbills();
              
				  window.location.href="<?php echo $base_url; ?>view_est_bill.php";
				
            }else{
                alert('Bill data has been '+statusArr[type]+' successfully.');
				 window.location.href="<?php echo $base_url; ?>view_est_bill.php";
            }
        }
    });
}*/

	$(document).on("click", ".submitted_jobs", function () {
				alert("NO SUBMITTED JOBS FOUND..");
					
	
	});
	
	$(document).on("click", ".pending_jobs", function () {
				alert("NO PENDING JOBS FOUND..");
					
	
	});


	/*$(document).on("click", ".send_to_second", function () {
				var clicked_id = $(this).attr("data-id");  
				
    
	$.confirm({
        title: "warning",
        content: "Are You Sure To Send This Job?",
        buttons: {
			confirm: function () {
	$.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=send_job_to_second_reception&clicked_id='+clicked_id,
        success:function(html){
			get_jobs();
        }
    });
	
	},
            cancel: function () {
				return;
            }
			}
        })
});*/

/*function get_jobs(){
		
    $.ajax({
        type: 'POST',
        url: '<?php $base_url; ?>addData.php',
        data: 'action_type=get_jobing_for_first_reception',
        success:function(html){
            $('#display_data').html(html);
        }
    });
}
*/
</script>
