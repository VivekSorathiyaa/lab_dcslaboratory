<?php include("header.php");?>
<?php //include("sidebar.php");
if($_SESSION['name']=="")
{
  ?>
  <script >
    window.location.href="index.php";
  </script>
  <?php
}

  if(isset($_GET['a']) /*you can validate the link here*/){
    $_SESSION['clicking']=$_GET['a'];
 }
?>

<style type="text/css">
 .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}


.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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

h3 a{
	color:white;
}

</style>
  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper"  style="margin-left: 0px !important;background:url(images/b1.jpg);background-repeat:no-repeat;background-size:100% 120%;overflow:hidden;">
		<!-- Content Header (Page header) -->
		<section class="content-header" >
			
			<h1>
				
				<a  class="btn btn-default pull-right dropdown-toggle" data-toggle="dropdown" href="#" title="VIEW" style="width: 70px;height: 70px;background:url(uplode/<?php echo $_SESSION['u_id'].'.jpg';?>);background-repeat:no-repeat;background-size:100% 102%;border-radius: 54px;">
		    </a>
		<ul class="dropdown-menu" style="margin: 4px 82% 0;top: 70px;background-color:brown;width:18%;">
		<li class="user-header">
										<img src="uplode/<?php echo $_SESSION['u_id'].'.jpg';?>" class="img-circle" alt="User Image" style="width:100px;height:100px;margin-left: 38%;">
										<p>
											<?php 	$user_nm=$_SESSION['name'];
												$query="select * from staff WHERE `staff_fullname`='$user_nm'";
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
			</h1>
			
	
		</section>
		<!-- Main content -->
		<section class="content">
			<!-- Small boxes (Stat box) -->
				
			
			<h2 class="page-header" style="border-bottom:0px;color:white;text-align:center;"><b><h1>MENU</h1></b></h2>
			<div class="row">
			<?php
			
			$roles_query="select * from staff WHERE `id`=".$_SESSION['u_id'];
			$roles_result=mysqli_query($conn,$roles_query);
			$roles_row=mysqli_fetch_array($roles_result);
			
		    $get_rolling= $roles_row["staff_isadmin"];
			$set_rolling= explode(",",$get_rolling);
			
			// Code For Reception 1	
				if (in_array(1, $set_rolling))
				{
					?>

					<div class="col-md-4">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-green">
							<div class="widget-user-image">
								<a href="job_listing.php?a=rec1"><img class="img-circle user_rotate" src="images/roles_images/one.jpg" alt="User Avatar" style="width: 300px;height: 300px;float: left;margin-left: 14px;"></a>
							</div>
							<!-- /.widget-user-image -->
							<h2 style="text-align:center;">
							<a href="job_listing.php?a=rec1" style="color:white;text-decoration:none;">
							<b>RECEPTION 1</b></a></h2>
							
						</div>
						
					</div>
					<!-- /.widget-user -->
				</div>
					<?php
				}
				
			// Code For Reception 2	
				if (in_array(2, $set_rolling))
				{
					?>
					<div class="col-md-4">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-green">
							<div class="widget-user-image">
								<a href="job_listing_for_second_reception.php?a=rec2"><img class="img-circle user_rotate" src="images/roles_images/rec_2.jpg" alt="User Avatar" style="width: 300px;height: 300px;float: left;margin-left: 14px;"></a>
							</div>
							<!-- /.widget-user-image -->
							<h2 style="text-align:center;">
							<a href="job_listing_for_second_reception.php?a=rec2" style="color:white;text-decoration:none;">
							<b>RECEPTION 2</b></a></h2>
							
							
						</div>
						
					</div>
					<!-- /.widget-user -->
				</div>
					<?php
				}
				
			// Code For Lab	
			//	if (in_array(3, $set_rolling))
			//	{
					?>
					<!--<div class="col-md-4">
				
					<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes 
						<div class="widget-user-header bg-green">
							<div class="widget-user-image">
								<a href="dashbord_notice.php?a=lab"><img class="img-circle user_rotate" src="images/roles_images/lab.jpg" alt="User Avatar" style="width: 300px;height: 300px;float: left;margin-left: 14px;"></a>
							</div>
							
							<h2 style="text-align:center;">
							<a href="dashbord_notice.php?a=lab" style="color:white;text-decoration:none;">
							<b>LAB</b></a></h2>
							
						</div>
						
					</div>
					
					
					</div>-->
					
					<?php
				//}
				
				// Code For Engineer	
				if (in_array(4, $set_rolling))
				{
					?>
					<div class="col-md-4">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-green">
							<div class="widget-user-image">
								<a href="job_listing_for_engineer.php?a=eng"><img class="img-circle user_rotate" src="images/roles_images/engineer.jpg" alt="User Avatar" style="width: 300px;height: 300px;float: left;margin-left: 14px;"></a>
							</div>
							<!-- /.widget-user-image -->
							<h2 style="text-align:center;">
							<a href="job_listing_for_engineer.php?a=eng" style="color:white;text-decoration:none;">
							<b>ENGINEERS</b></a></h2>							
							
						</div>
						
					</div>
					<!-- /.widget-user -->
					</div>
					<?php
				}
				
				
				// Code For Qm	
				if (in_array(5, $set_rolling))
				{
					?>
					<div class="col-md-4">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-green">
							<div class="widget-user-image">
								<a href="list_of_job_report_for_qm.php?a=qm"><img class="img-circle user_rotate" src="images/roles_images/manager.jpg" alt="User Avatar" style="width: 300px;height: 300px;float: left;margin-left: 14px;"></a>
							</div>
							<!-- /.widget-user-image -->
							<h2 style="text-align:center;">
							<a href="list_of_job_report_for_qm.php?a=qm" style="color:white;text-decoration:none;">
							<b>QUALITY MANAGER</b></a></h2>	
							
							
						</div>
						
					</div>
					<!-- /.widget-user -->
					</div>
					<?php
				}
				
				// Code For Biller	
				if (in_array(6, $set_rolling))
				{
					?>
					<div class="col-md-4">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-green">
							<div class="widget-user-image">
								<a href="list_of_job_report_for_biller.php?a=bill"><img class="img-circle user_rotate" src="images/roles_images/biller.jpg" alt="User Avatar" style="width: 300px;height: 300px;float: left;margin-left: 14px;"></a>
							</div>
							<!-- /.widget-user-image -->
						
							<h2 style="text-align:center;">
							<a href="list_of_job_report_for_biller.php?a=bill" style="color:white;text-decoration:none;">
							<b>BILLER</b></a></h2>	
							
						</div>
						
					</div>
					<!-- /.widget-user -->
					</div>
					<?php
				}
				
				// Code For Biller	
				if (in_array(0, $set_rolling))
				{
			?>
				<div class="col-md-4">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-green">
							<div class="widget-user-image">
								<a href="master_dashboard.php?a=super"><img class="img-circle user_rotate" src="images/roles_images/super.jpg" alt="User Avatar" style="width: 300px;height: 300px;float: left;margin-left: 14px;"></a>
							</div>
							<!-- /.widget-user-image -->
						
							<h2 style="text-align:center;">
							<a href="master_dashboard.php?a=super" style="color:white;text-decoration:none;">
							<b>SUPER ADMIN</b></a></h2>	
							
						</div>
						
					</div>
					<!-- /.widget-user -->
					</div>
					
					<?php
				}
				?>
				
			
		</section>

  </div>
  <?php include("footer.php");?> 
  <script>
		jQuery(document).ready(function(){
				
				jQuery(document).on('change', '.chka', function() {
					if(this.checked) {
					  // checkbox is checked
							var ids = $(this).attr('id');
							var types = "ACTIVATE";
							var billData = 'action_type='+types+'&id='+ids;
							
					}
					else
					{
							var ids = $(this).attr('id');
							var types = "DEACTIVATE";
							var billData = 'action_type='+types+'&id='+ids;
							
					}
						
					$.ajax({
						type: 'POST',
						url: '<?php echo $base_url; ?>user_act.php',
						data: billData,
						success:function(){
							
						}
					});

	
				});
		});
  </script>
  <!-- /.content-wrapper -->
 