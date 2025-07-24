<div class="row" style="text-align: center;background-color: #ababab;margin:0px 0px 0px 0px;">
			<?php if($_SESSION['isadmin']==0){ ?>
		
		<a class="active btn btn-default" href="master_dashboard.php" title="Home" style="width: 80px;height:75px;background:url(images/home.png);background-repeat:no-repeat;background-size:100% 102%"></a> 
	
		<a  class="btn btn-default" href="master_forms.php" title="MASTER FORMS" style="width: 80px;height: 75px;background:url(images/set.png);background-repeat:no-repeat;background-size:100% 102%"></a>

		
		
		
		<!--<a  class="btn btn-default" href="set_agency_rate.php" title="SET AGENCY RATE" style="width: 80px;height: 75px;background:url(images/agency.png);background-repeat:no-repeat;background-size:100% 102%"></a> -->
		
		<!--<a  class="btn btn-default" href="report_Status.php" title="REPORT STATUS" style="width: 80px;height: 75px;background:url(images/bill_1.png);background-repeat:no-repeat;background-size:100% 102%"></a>-->
		 
		
		<!--<a  class="btn btn-default" href="calibration_entry.php" title="CALIBRATION ENTRY" style="width: 80px;height: 75px;background:url(images/deli.png);background-repeat:no-repeat;background-size:100% 102%"></a> -->  
<?php }
 
if($_SESSION['isadmin']==2){ ?>
		<a  class="btn btn-default" href="client_form.php" title="ADD JOB" style="width: 80px;height: 75px;background:url(images/jobs.png);background-repeat:no-repeat;background-size:100% 102%"></a> 
		
		<a class="active btn btn-default" href="job_listing_for_second_reception.php" title="Home" style="width: 80px;height:75px;background:url(images/home.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<a class="active btn btn-default" href="deleted_job_list_for_reception.php" title="Deleted Job" style="width: 80px;height:75px;background:url(images/delete.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<a class="active btn btn-default" href="list_of_completed_job_report_for_reception.php" title="Completed Jobs" style="width: 80px;height:75px;background:url(images/complete_job.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<a class="active btn btn-default" href="list_of_dispatched_report_for_reception.php" title="Dispatched Report List" style="width: 80px;height:75px;background:url(images/report.png);background-repeat:no-repeat;background-size:100% 102%"></a> 
		
		<a class="active btn btn-default" href="view_job_invert_register_for_rec.php" title="Register" style="width: 80px;height:75px;background:url(images/report.png);background-repeat:no-repeat;background-size:100% 102%"></a>
<?php } 

if($_SESSION['isadmin']==4){ ?>
		<a class="active btn btn-default" href="job_listing_for_engineer.php" title="Home" style="width: 80px;height:75px;background:url(images/home.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		<!--<a class="btn btn-default" href="pending_job_listing.php" title="PENDING JOB" style="width: 80px;height:75px;background:url(images/jobs.png);background-repeat:no-repeat;background-size:100% 102%"></a>-->
		<?php if($_SESSION['u_id']=="4"){?>
		<a class="active btn btn-default" href="list_of_completed_jobs_work_for_engineer_to_view.php" title="Completed Jobs" style="width: 80px;height:75px;background:url(images/complete_job.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		<?php } ?>
<?php }

if($_SESSION['isadmin']==5){ ?>
		<a class="active btn btn-default" href="list_of_job_report_for_qm.php" title="Home" style="width: 80px;height:75px;background:url(images/home.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<!--<a class="active btn btn-default" href="list_of_pending_job_report_for_qm.php" title="Pending Jobs" style="width: 80px;height:75px;background:url(images/pending_job.png);background-repeat:no-repeat;background-size:100% 102%"></a>-->
		
		<a class="active btn btn-default" href="list_of_completed_job_report_for_qm.php" title="Completed Jobs" style="width: 80px;height:75px;background:url(images/complete_job.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<!--<a class="btn btn-default" href="list_of_report_for_only_view_for_qm.php" title="View Reports" style="width: 80px;height:75px;background:url(images/report.png);background-repeat:no-repeat;background-size:100% 102%"></a>-->
		
		<a  class="btn btn-default" href="delivery_data.php" title="SEARCH DELIVERY REPORT" style="width: 80px;height: 75px;background:url(images/deli.png);background-repeat:no-repeat;background-size:100% 102%"></a> 
		
<?php }

if($_SESSION['isadmin']==6){ ?>
		<a class="active btn btn-default" href="list_of_job_report_for_biller.php" title="Home" style="width: 80px;height:75px;background:url(images/home.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<a class="active btn btn-default" href="list_of_completed_perfoma_for_biller.php" title="Completed Perfoma" style="width: 80px;height:75px;background:url(images/jobs.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<a class="active btn btn-default" href="list_of_completed_perfoma_only_view_for_biller.php" title="Completed Perfoma For View" style="width: 80px;height:75px;background:url(images/complete_job.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<a class="active btn btn-default" href="list_of_final_bill_by_biller.php" title="Bill List" style="width: 80px;height:75px;background:url(images/bill_list.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<a class="active btn btn-default" href="list_biller_registers.php" title="All Registers" style="width: 80px;height:75px;background:url(images/registers.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<a class="active btn btn-default" href="list_biller_cancelation.php" title="CANCELATION" style="width: 80px;height:75px;background:url(images/canceled.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		
		
		
<?php } 
if($_SESSION['isadmin']==9){ ?>
		<a class="active btn btn-default" href="list_of_completed_job_for_scanner.php" title="Home" style="width: 80px;height:75px;background:url(images/home.png);background-repeat:no-repeat;background-size:100% 102%"></a>
		
		<a class="active btn btn-default" href="list_of_job_completed_by_scanner.php" title="Completed Jobs" style="width: 80px;height:75px;background:url(images/complete_job.png);background-repeat:no-repeat;background-size:100% 102%"></a>
	 
		
<?php }


 
?>
		<a  class="btn btn-default pull-right dropdown-toggle" data-toggle="dropdown" href="#" title="VIEW" style="width: 70px;height: 70px;background:url(uplode/<?php echo $_SESSION['u_id'].'.jpg';?>);background-repeat:no-repeat;background-size:100% 102%;border-radius: 54px;">
		</a>
		<ul class="dropdown-menu" style="margin: 4px 82% 0;top: 70px;background-color:#ababab;width:18%;">
		<li class="user-header">
										<img src="uplode/<?php echo $_SESSION['u_id'].'.jpg';?>" class="img-circle" alt="User Image" style="width:100px;height:100px;margin-left: 38%;">
										<p>
											<?php 	
												$user_id=$_SESSION['u_id'];
												if($_SESSION['nabl_type']=="blank")
												{
													$query="select * from staff WHERE `id`='$user_id'";
												}
												else
												{
													$query="select * from multi_login WHERE `id`='$user_id'";
												}
												$result=mysqli_query($conn,$query);
												$row=mysqli_fetch_array($result);
												?>
												<small style="font-size: 20px;padding: 10px;color: white;">Name : <?php echo $row['staff_fullname'];?></small><br>
												<small style="font-size: 20px;padding: 10px;color: white;">Email : <?php echo $row['staff_email'];?></small><br>
											<small style="font-size: 20px;padding: 10px;color: white;">Mobile :<?php echo $row['staff_contactno'];?></small>
										</p>
									</li>
									<li class="user-footer">
										<div class="pull-left">
											<a href="profile.php" class="btn btn-default btn-flat" style="background:url(images/profile.png);background-repeat:no-repeat;background-size:100% 102%;width: 70px;height: 70px;"title="VIEW PROFILE"></a>
										</div>
										<div class="pull-right">
											<a href="logout.php" class="btn btn-default btn-flat" style="background:url(images/logout.png);background-repeat:no-repeat;background-size:100% 102%;width: 70px;height: 70px;"title="LOGOUT"></a>
										</div>
									</li>
    </ul>
</div>
