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

$query="SELECT * FROM fyearmaster WHERE `fy_status`='1'";
  
     $qrys = mysqli_query($conn,$query);
    $no_of_rows=mysqli_num_rows($qrys);
    if($no_of_rows>0){
                
      $r = mysqli_fetch_array($qrys);
      $year=$r['fy_name'];      
    }
   $get_query = "select count(*) as cntesti from estimate_total_span_only_for_estimate WHERE `est_isdeleted`=0 ORDER BY est_id"; 
    $select_result = mysqli_query($conn, $get_query);
    
    $result=mysqli_fetch_array($select_result);
    $esticnt=$result['cntesti'];


    $get_query1 = "select count(*) as cntbill from estimate_total_span_bill_sequence WHERE `is_deleted`=0 ORDER BY bill_id"; 
    $select_result1 = mysqli_query($conn, $get_query1);
    
    $result1=mysqli_fetch_array($select_result1);
    $billcnt=$result1['cntbill'];

    $get_query2 = "select COUNT(*) as cnt from job WHERE `jobisdeleted`='0'"; 
    $select_result2 = mysqli_query($conn, $get_query2);
    
    $result2=mysqli_fetch_array($select_result2);
    $usercnt=$result2['cnt'];


    $get_query3 = "select count(*) as cntperforma from estimate_total_span WHERE `est_isdeleted`=0  AND `perfoma_completed_by_biller`='1' ORDER BY est_id"; 
    $select_result3 = mysqli_query($conn, $get_query3);
    
    $result3=mysqli_fetch_array($select_result3);
    $agencycnt=$result3['cntperforma'];
	
	
	$cur = date('Y-m-d');
	$get_query_cur = "select count(*) as cnt from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `sw_date` = $cur"; 
    $select_result_cur = mysqli_query($conn, $get_query_cur);
    
    $result_cur=mysqli_fetch_array($select_result_cur);
    $usercnt_cur=$result_cur['cnt'];

	 $get_query_es = "select sum(total_amt) as sm from estimate_total_span WHERE `est_isdeleted`='0' AND `estimate_date` = '$cur' and `is_billing`='0' AND `perfoma_completed_by_biller`='1'"; 
    $select_result1_es = mysqli_query($conn, $get_query_es);
    
	if(mysqli_num_rows($select_result1_es)>0)
	{
    $result1_es=mysqli_fetch_array($select_result1_es);
    $total_amt1=$result1_es['sm'];
	}
	else
	{
	 $total_amt1="0";	
	}
	
	/* $get_query_es = "select * from estimate_total_span WHERE `est_isdeleted`='0' AND `est_modifydate` = '$cur' and `is_billing`='1'";
    $select_result1_es = mysqli_query($conn, $get_query_es);
    $tt=0;    
	while($row1=mysqli_fetch_array($select_result1_es))
	{
		 $patytp=$row1['paytype'];
		
		if($patytp != 3)
		{
			$tt += $row1['total_amt'];
		}
	}*/


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
	
	<br>
	<div class="row calibration_class">

	</div>
	<h1 class="page-header" >register</h1>
	<div class="row">
				<div class="col-lg-3 col-xs-6">
				<!-- small box -->
					<div class="small-box box_design">
						<div class="icon">
							<i class="fa fa-book"></i>
						</div>
						<div class="inner">
							<h3><?php echo $usercnt;?></h3>
							<p>INWARD REGISTER</p>
							<a href="view_job_invert_register.php" class="small-box-footer a_design">MORE INFO <i class="fa fa-arrow-circle-right"></i></a>
						</div>
						
						
					</div>
				</div>
				
				<!-- ./col -->
	

				<div class="col-lg-3 col-xs-6">
				<!-- small box -->
					<div class="small-box box_design">
						<div class="icon">
							<i class="fa fa-book"></i>
						</div>
						<div class="inner">
							<h3><?php echo $billcnt;?></h3>
							<p>TOTAL BILLS</p>
							<a href="list_of_invoice_register.php" class="small-box-footer a_design">MORE INFO <i class="fa fa-arrow-circle-right"></i></a>
						</div>
						
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				<!-- small box -->
					<div class="small-box box_design">
						<div class="icon">
							<i class="fa fa-book"></i>
						</div>
						<div class="inner">
							<h3><?php echo $esticnt;?></h3>
							<p>TOTAL ESTIMATES</p>
							<a href="list_of_estimate_register.php" class="small-box-footer a_design">MORE INFO <i class="fa fa-arrow-circle-right"></i></a>
						</div>
						
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				<!-- small box -->
					<div class="small-box box_design">
						<div class="icon">
							<i class="fa fa-book"></i>
						</div>
						<div class="inner">
							<h3><?php echo $agencycnt;?></h3>
							<p>TOTAL PERFORMA</p>
							<a href="list_of_perfoma_register.php" class="small-box-footer a_design">MORE INFO <i class="fa fa-arrow-circle-right"></i></a>
						</div>
						
					</div>
				</div>				
				<!-- ./col -->
	</div>
	<br>
	<h1 class="page-header" >Today job status</h1>
	<div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box daily_design">
            <span class="info-box-icon bg-warning"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">JOB INWARD</span>
              <span class="info-box-number"><?php echo $usercnt_cur;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

		
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box daily_design">
            <span class="info-box-icon bg-warning"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">JOB AMOUNT</span>
              <span class="info-box-number"><?php echo $total_amt1;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
       
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->
	
	<br>
	<h1 class="page-header" >user work status</h1>
	<div class="row d-flex flex-wrap">
	
				<div class="col-md-4 mb-3">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2 h-100">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header ">
							<div class="widget-user-image ">
								<img class="img-circle user_rotate" style="width:60px;height:60px;" src="uplode/rec.png" alt="">
							</div>
							<!-- /.widget-user-image -->
							<h5 class="widget-user-username" style="font-weight:bold;">RECEPTION</h5>
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								
								<li><a href="multi_receptions_form_super.php">PENDING TRF</a></li>
								
								<li><a href="multi_receptions_form_super.php">PENDING PROCEED TRF</a></li>	
								
								<li><a href="multi_receptions_form_super.php">DISPATCH REPORT LIST</a></li>	
								
							
								<!--<li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>-->
							</ul>
						</div>
					</div>
					<!-- /.widget-user -->
				</div>
				
				
				<div class="col-md-4 mb-3">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2 h-100">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header ">
							<div class="widget-user-image">
								<img class="img-circle user_rotate" style="width:60px;height:60px;" src="uplode/eng.png">
								
							</div>
							<!-- /.widget-user-image -->
							<h3 class="widget-user-username" style="font-weight:bold;">ENGINEERS</h3>
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								<!--<li><a href="#">TOTAL JOBS <span class="pull-right badge bg-blue"><?php// echo $rre;?></span></a></li>-->
								<li><a href="eng_job_inward_from_lab.php">ARRIVAL JOBS</a></li>
								<!--<li><a href="eng_job_inward_from_lab.php">WORKING JOBS<span class="pull-right badge bg-black"><?php //echo $cnteng1;?></span></a></li>-->
								<li><a href="eng_job_inward_from_lab.php">PENDING JOBS</a></li>
								<!--<li><a href="#">TOTAL COMPLETED JOB <span class="pull-right badge bg-red"><?php //echo $cnt_jobs1;?></span></a></li>-->
							</ul>
						</div>
					</div>
					<!-- /.widget-user -->
				</div>
				<div class="col-md-4 mb-3">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2 h-100">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header ">
							<div class="widget-user-image">
								<img class="img-circle user_rotate" style="width:60px;height:60px;" src="uplode/qm.png" alt="">
							</div>
							<!-- /.widget-user-image -->
							<h3 class="widget-user-username" style="font-weight:bold;">QUALITY MANAGER</h3>
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								<!--<li><a href="#">TOTAL JOBS <span class="pull-right badge bg-blue"><?php// echo $rre;?></span></a></li>-->
								<li><a href="superadmin_arrived_jobs_of_qm.php">ARRIVED JOBS </a></li>
								<!--<li><a href="superadmin_pending_jobs_of_qm.php">PENDING JOBS<span class="pull-right badge bg-black"><?php echo $cnt_jobs1;?></span></a></li>-->
								<li><a href="superadmin_completed_jobs_of_qm.php">COMPLETED JOBS</a></li>
								<!--<li><a href="#">TOTAL COMPLETED JOB <span class="pull-right badge bg-red"><?php //echo $cnt_jobs1;?></span></a></li>-->
							</ul>
						</div>
					</div>
					<!-- /.widget-user -->
				</div>
				
				<div class="col-md-4 mb-3">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2 h-100">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header ">
							<div class="widget-user-image">
								<img class="img-circle user_rotate" style="width:60px;height:60px;" src="uplode/bill.png" >
							</div>
							<!-- /.widget-user-image -->
							<h3 class="widget-user-username" style="font-weight:bold;">BILLING</h3>
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								<!--<li><a href="#">TOTAL JOBS <span class="pull-right badge bg-blue"><?php// echo $rre;?></span></a></li>-->
								<li><a href="superadmin_pending_jobs_of_biller.php">ARRIVAL JOBS</a></li>
								<li><a href="superadmin_pending_estimates_of_biller.php">PERFOMA LIST </a></li>
								<li><a href="superadmin_pending_bills_of_biller.php">COMPLETE BILLS</a></li>
								
								<li><a href="list_biller_registers_for_super_admin.php">REGISTER </span></a></li>
								<li><a href="list_biller_cancelation_for_super_admin.php">CANCELATION </span></a></li>
								<!--<li><a href="#">TOTAL COMPLETED JOB <span class="pull-right badge bg-red"><?php //echo $cnt_jobs1;?></span></a></li>-->
							</ul>
						</div>
					</div>
					<!-- /.widget-user -->
				</div>
				
				<div class="col-md-4 mb-3">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2 h-100">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header ">
							<div class="widget-user-image">
								<img class="img-circle user_rotate" style="width:60px;height:60px;" src="uplode/scanner.png" >
							</div>
							<!-- /.widget-user-image -->
							<h3 class="widget-user-username" style="font-weight:bold;">SCANNER</h3>
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								<!--<li><a href="#">TOTAL JOBS <span class="pull-right badge bg-blue"><?php// echo $rre;?></span></a></li>-->
								<li><a href="list_of_completed_job_for_scanner_in_super_admin.php">PENDING SCANNING JOB</a></li>
								<li><a href="list_of_job_completed_by_scanner_in_super_admin.php">COMPLETE SCANNING JOB</a></li>
							</ul>
						</div>
					</div>
					<!-- /.widget-user -->
				</div>
				

	</div>

	<br>
	<h1 class="page-header" >user list</h1>
	<div class="row">
		<div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-black">
                <div class="box-header with-border">
                  <h3 class="box-title">LIST OF USERS</h3>

                  <div class="box-tools pull-right">
                   <!-- <span class="label label-danger">8 New Members</span>-->
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>-->
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
						<?php
								 $query_rec3 = "select * from multi_login WHERE `staff_isdeleted`='0' AND `staff_isadmin` in ('2','5','4','9') ORDER BY `staff_isadmin` ASC";
									$sel_dt = mysqli_query($conn, $query_rec3);					 									
									while($rw=mysqli_fetch_array($sel_dt))
									{
										?>
									<li class="d-flex align-items-center">
									  <a href="profile_1.php?uid=<?php echo $rw['id'];?>" >
									  <img class="eng_rotate user_rotate myElement" src="uplode/<?php echo $rw['id'].'.jpg';?>"  style="width:50px;height:50px;" alt="<?php echo $rw['staff_fullname'];?>"></a>
									  <div>
											<a class="users-list-name" href="profile_1.php?uid=<?php echo $rw['id'];?>"><b><?php echo $rw['staff_fullname'];?></b></a>
											<span class="users-list-date"><a href="profile_1.php?uid=<?php echo $rw['id'];?>">(
												<?php
													if($rw['staff_isadmin']=="2")
													{
														echo "RECEPTION";
													}
													else if($rw['staff_isadmin']=="4")
													{
														echo "ENGINEER";
													}
													else if($rw['staff_isadmin']=="5")
													{
														echo "QUALITY MANAGER";
													}
													else if($rw['staff_isadmin']=="9")
													{
														echo "SCANNER";
													}
												?>
											)</a></span>
									  </div>
									  
									</li>
					
									<?php
									}
										?>
                    </ul>
                 </div>
                </div>
            </div>
	</div>
</section>	
</div>  
<?php include("footer.php");?>
<script>
var myVar = setInterval("showTime()", 60000);

function showTime(){
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;


$.ajax({
       type: 'POST',
       url: '<?php echo $base_url; ?>save_calibratoin.php',
       data: 'action_type=noti_of_calibration&'+'&today_date='+today,
dataType:'JSON',
       success:function(html){
           $('.calibration_class').html(html.design);

       }
   });

}
</script>