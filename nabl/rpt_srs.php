	<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php
session_start();
include("connection.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
	</script>
	<?php
}


		 $rpt_no=$_POST['rpt_no'];


?>

					<div class="col-md-12">
						<div class="nav-tabs-custom">
							<div class="tab-pane" id="timeline">
								<ul class="timeline timeline-inverse">
									<li class="time-label">
										<span class="bg-green">
										 RECEPTION 1
										</span>
									</li>
									<?php if($rpt_no != "")
									{

										$q1 = "select * from job WHERE `jobisdeleted`='0' and `report_no`='$rpt_no'";
										$r1 = mysqli_query($conn, $q1);
										$row1=mysqli_fetch_array($r1);
										if((mysqli_num_rows($r1))>0)
										{
										?>
										<li class="time-label">
										<span class="bg-red">
										 <?php echo date('d/m/Y', strtotime($row1['date']));?>
										</span>
										</li>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border"><?php
													$sel_agency="select * from agency_master where `agency_id`=".$row1["agency"];
													$query_agency = mysqli_query($conn, $sel_agency);
													$get_agency = mysqli_fetch_array($query_agency);
													echo $get_agency['agency_name'];
												?> JOB INWARD SUCESSFULLY.
												 </h3>
											</div>
										</li>
										<?php
										}
										else
										{
										?>
											<li>
											<i class="fa fa-clock-o bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border"> NO JOB FOUND..
												 </h3>
											</div>
											</li>
										<?php
										}
									}
									else
									{?>
										<li>
											<i class="fa fa-clock-o bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border"> PLEASE ENTER VALID JOB NO.. / ENTER JOB NO..
												 </h3>
											</div>
										</li>

									<?php }
										$q2 = "select * from job WHERE `jobisdeleted`='0' and `report_no`='$rpt_no' and `send_to_second_reception`='1'";
										$r2 = mysqli_query($conn, $q2);
										$row2=mysqli_fetch_array($r2);
										if((mysqli_num_rows($r2))>0)
										{
									?>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">REPORT SEND TO RECEPTION 2
												 </h3>
											</div>
										</li>
									<?php
										}
										else
										{?>
												<li>
													<i class="fa fa-envelope bg-blue"></i>

													<div class="timeline-item">
														<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

														<h3 class="timeline-header no-border">PENDING TO SENDING RECEPTION 2
														 </h3>
													</div>
												</li>
										<?php
										}?>
										<li class="time-label">
										<span class="bg-green">
										 RECEPTION 2
										</span>
										</li>
										<?php
										$q3 = "select * from job WHERE `jobisdeleted`='0' and `report_no`='$rpt_no' and `send_to_second_reception`='1' and `material_assign`='1'";
										$r3 = mysqli_query($conn, $q3);
										$row3=mysqli_fetch_array($r3);
										if((mysqli_num_rows($r3))>0)
										{
									?>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">MATERIAL SELECTION SUCESSFULLY.
												 </h3>
											</div>
										</li>
									<?php
										}
										else
										{
									?>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">PENDING TO SELECTION OF MATERIAL.
												 </h3>
											</div>
										</li>
									<?php
										}

										$q4 = "select * from estimate_total_span WHERE `est_isdeleted`='0' and `report_no`='$rpt_no' and `is_billing`='0'";
										$r4 = mysqli_query($conn, $q4);
										$row4=mysqli_fetch_array($r4);
										if((mysqli_num_rows($r4))>0)
										{
									?>
										<li class="time-label">
										<span class="bg-red">
										 <?php echo date('d/m/Y', strtotime($row4['estimate_date']));?>
										</span>
										</li>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">
													ESTIMATE CREATED SUCCESSFULLY
												 </h3>
											</div>
										</li>

										<?php
										}
										else
										{?>
											<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">PENDING TO CREATED ESTIMATE
												 </h3>
											</div>
										</li>

										<?php }

										$q5 = "select * from job WHERE `job_lab_assign`='0' and `report_no`='$rpt_no' and `send_to_second_reception`='1' and `material_assign`='1'";
										$r5 = mysqli_query($conn, $q5);
										$row5=mysqli_fetch_array($r5);
										if((mysqli_num_rows($r5))>0)
										{
									?>

										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">
													SENDING TO LABORATORY FOR TESTING
												 </h3>
											</div>
										</li>

										<?php
										}
										else
										{?>
											<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">PENDING TO SENDING LABORATORY FOR TESTING
												 </h3>
											</div>
										</li>

										<?php }

										 $q6 = "select * from job WHERE `job_lab_progress`='1' and `report_no`='$rpt_no' and `send_to_second_reception`='1' and `material_assign`='1' and `report_job_printing`='0'";
										$r6 = mysqli_query($conn, $q6);
										$row6=mysqli_fetch_array($r6);
										if((mysqli_num_rows($r6))>0)
										{
									?>
										<li class="time-label">
										<span class="bg-red">
										 <?php echo date('d/m/Y', strtotime($row6['job_lab_progress_date']));?>
										</span>
										</li>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">
													LAB TEST CONTINUE ON JOB
												 </h3>
											</div>
										</li>

										<?php
										}
										else
										{?>
											<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">PENDING TO JOB TEST PENDING
												 </h3>
											</div>
										</li>

										<?php }
										 $q7 = "select * from job WHERE `job_lab_progress`='1' and `report_no`='$rpt_no' and `send_to_second_reception`='1' and `material_assign`='1' and `report_job_printing`='1'";
										$r7 = mysqli_query($conn, $q7);
										$row7=mysqli_fetch_array($r7);
										if((mysqli_num_rows($r7))>0)
										{

										?>
										<li class="time-label">
										<span class="bg-red">
										 <?php echo date('d/m/Y', strtotime($row7['job_lab_progress_end_date']));?>
										</span>
										</li>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">
													JOB TEST COMPLETE AND JOB GO FOR PREPARING REPORT
												 </h3>
											</div>
										</li>

										<?php
										}
										else
										{?>
											<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">JOB IS ON PROGRESS.
												 </h3>
											</div>
										</li>

										<?php }
										 $q8 = "select * from job WHERE `job_lab_progress`='1' and `report_no`='$rpt_no' and `send_to_second_reception`='1' and `material_assign`='1' and `report_job_printing`='1' and `report_received`='1' and `job_sent_to_qm`='0'";
										$r8 = mysqli_query($conn, $q8);
										$row8=mysqli_fetch_array($r8);
										if((mysqli_num_rows($r8))>0)
										{

										?>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">
													JOB REPORT GENERATED
												 </h3>
											</div>
										</li>

										<?php
										}
										else
										{?>
											<!--<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">


												<h3 class="timeline-header no-border">JOB REPORTS IS PENDING TO GENERATE.
												 </h3>
											</div>
										</li>-->

										<?php
											exit;
										}
										 $q9 = "select * from job WHERE `job_lab_progress`='1' and `report_no`='$rpt_no' and `send_to_second_reception`='1' and `material_assign`='1' and `report_job_printing`='1' and `report_received`='1' and `job_sent_to_qm`='1'";
										$r9 = mysqli_query($conn, $q9);
										$row9=mysqli_fetch_array($r9);
										if((mysqli_num_rows($r9))>0)
										{

										?>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">
													JOB REPORTS SEND TO QUALITY MANAGER FOR CHECKING
												 </h3>
											</div>
										</li>

										<?php
										}
										else
										{?>
											<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">JOB REPORTS ARE NOT SEND TO QUALITY MANAGER FOR CHECKING
												 </h3>
											</div>
										</li>

										<?php }
										 $q10 = "select * from job WHERE `job_lab_progress`='1' and `report_no`='$rpt_no' and `send_to_second_reception`='1' and `material_assign`='1' and `report_job_printing`='1' and `report_received`='1' and `job_sent_to_qm`='1' and `accepted_by_qm`='1'";
										$r10 = mysqli_query($conn, $q10);
										$row10=mysqli_fetch_array($r10);
										if((mysqli_num_rows($r10))>0)
										{

										?>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">
													JOB ACCEPTED BY QUALITY MANAGER.
												 </h3>
											</div>
										</li>

										<?php
										}
										else
										{?>
											<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">JOB IS CHECKING BY QUALITY MANAGER.
												 </h3>
											</div>
										</li>

										<?php }
										 $q11 = "select * from job WHERE `job_lab_progress`='1' and `report_no`='$rpt_no' and `send_to_second_reception`='1' and `material_assign`='1' and `report_job_printing`='1' and `report_received`='1' and `job_sent_to_qm`='1' and `accepted_by_qm`='1' and `appoved_by_qm_to_print`='1'";
										$r11 = mysqli_query($conn, $q11);
										$row11=mysqli_fetch_array($r11);
										if((mysqli_num_rows($r11))>0)
										{

										?>
										<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">
													JOB GO TO PRINT
												 </h3>
											</div>
										</li>

										<?php
										}
										else
										{?>
											<li>
											<i class="fa fa-envelope bg-blue"></i>

											<div class="timeline-item">
												<!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->

												<h3 class="timeline-header no-border">JOB NOT GOES TO PRINTING
												 </h3>
											</div>
										</li>

										<?php }?>
									<li class="time-label">
										<span class="bg-red">
										  10 Feb. 2014
										</span>
									</li>
									<li>
										<i class="fa fa-envelope bg-blue"></i>

										<div class="timeline-item">
											<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

											<h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
											 </h3>
										</div>
									</li>

												  <!-- END timeline item -->
												  <li>
													<i class="fa fa-clock-o bg-gray"></i>
												  </li>
												</ul>
											  </div>
											  <!-- /.tab-pane -->



											<!-- /.tab-content -->
										  </div>
										  <!-- /.nav-tabs-custom -->
										</div>
										<!-- /.col -->



<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
<script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>


</script>
