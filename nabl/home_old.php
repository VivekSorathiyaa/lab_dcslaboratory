<?php include("header.php");?>
<?php include("sidebar.php");
if($_SESSION['name']=="")
{
  ?>
  <script >
    window.location.href="index.php";
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
   $get_query = "select COUNT(*) as cnt from estimate_bill_total_master WHERE `fy_id`='$year' AND `bt_isdeleted`='0'"; 
    $select_result = mysqli_query($conn, $get_query);
    
    $result=mysqli_fetch_array($select_result);
    $esticnt=$result['cnt'];


    $get_query1 = "select COUNT(*) as cnt from bill_totalmaster WHERE `fy_id`='$year' AND `bt_isdeleted`='0'"; 
    $select_result1 = mysqli_query($conn, $get_query1);
    
    $result1=mysqli_fetch_array($select_result1);
    $billcnt=$result1['cnt'];

    $get_query2 = "select COUNT(*) as cnt from job_invert WHERE `iss_estimate`='0'"; 
    $select_result2 = mysqli_query($conn, $get_query2);
    
    $result2=mysqli_fetch_array($select_result2);
    $usercnt=$result2['cnt'];


    $get_query3 = "select COUNT(*) as cnt from agency"; 
    $select_result3 = mysqli_query($conn, $get_query3);
    
    $result3=mysqli_fetch_array($select_result3);
    $agencycnt=$result3['cnt'];

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

</style>
  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Dashboard 
				<small><?php echo $comp_name; ?> MATERIAL TESTING LAB</small>
			</h1>
		</section>
		<!-- Main content -->
		<section class="content">
			<!-- Small boxes (Stat box) -->
				
			<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?php echo $usercnt;?></h3>
							<p>PENDING INWARD JOBS</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="view_job_invert.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				
				<!-- ./col -->
				<?php if($_SESSION['isadmin']!="2"){ ?>

				<div class="col-lg-3 col-xs-6">
				<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?php echo $billcnt;?></h3>
							<p>TOTAL BILLS</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="view_bill.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?php echo $esticnt;?></h3>
							<p>TOTAL ESTIMATES</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="view_est_bill.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?php echo $agencycnt;?></h3>
							<p>TOTAL AGENCY</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="agency.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<?php } ?>
				<!-- ./col -->
			</div>
			<h2 class="page-header">Work Status By User</h2>
			<div class="row">
				<div class="col-md-4">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-green">
							<div class="widget-user-image">
								<img class="img-circle" src="images/user7-128x128.jpg" alt="User Avatar">
							</div>
							<!-- /.widget-user-image -->
							<h3 class="widget-user-username">Nadia Carmichael</h3>
							<h5 class="widget-user-desc">Lead Developer</h5>
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								<li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
								<li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
								<li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
								<li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
							</ul>
						</div>
					</div>
					<!-- /.widget-user -->
				</div>
				<div class="col-md-4">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-red">
							<div class="widget-user-image">
								<img class="img-circle" src="images/user7-128x128.jpg" alt="User Avatar">
							</div>
							<!-- /.widget-user-image -->
							<h3 class="widget-user-username">Nadia Carmichael</h3>
							<h5 class="widget-user-desc">Lead Developer</h5>
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								<li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
								<li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
								<li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
								<li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
							</ul>
						</div>
					</div>
					<!-- /.widget-user -->
				</div>
				<div class="col-md-4">
				<!-- Widget: user widget style 1 -->
					<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
						<div class="widget-user-header bg-blue">
							<div class="widget-user-image">
								<img class="img-circle" src="images/user7-128x128.jpg" alt="User Avatar">
							</div>
							<!-- /.widget-user-image -->
							<h3 class="widget-user-username">Nadia Carmichael</h3>
							<h5 class="widget-user-desc">Lead Developer</h5>
						</div>
						<div class="box-footer no-padding">
							<ul class="nav nav-stacked">
								<li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
								<li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
								<li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
								<li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
							</ul>
						</div>
					</div>
					<!-- /.widget-user -->
				</div>
			<!-- /.row -->
			<!-- Main row -->
			<div class="row">
			<!-- Left col -->
				<section class="col-lg-12">
				<!-- Custom tabs (Charts with tabs)-->
					<div class="col-lg-12 col-xs-12">
						<!--<img src="images/logo.jpg" align="center" />-->
					</div>
				</section>
			</div>
							<h2 class="page-header">USER LIST</h2>
							<div id="display_data">
									<table id="example1" class="table table-bordered table-striped display">
										<thead>
										<tr>
										<th style="text-align:center;">STATUS</th>																		
											<th style="text-align:center;">USER FULL NAME</th>
											<th style="text-align:center;">USER NAME</th>
											<th style="text-align:center;">MOBILE NO.</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
										
										
											$query="select * from staff";
											$result=mysqli_query($conn,$query);
											while($row=mysqli_fetch_array($result))
											{
																																										
										?>
												<tr>
												<td style="text-align:center;">
													<label class="switch">
													  <input type="checkbox" class="chka" id="<?php echo $row['id'];?>" name="chk" <?php if($row['staff_status']=="1"){echo "checked";}?>>
													  <span class="slider round"></span>
													</label>																				
												</td>
						
											
												
												<td style="text-align:center;"><?php echo $row['staff_fullname'];?></td>
												<td style="text-align:center;"><?php echo $row['staff_email'];?></td>
												<td style="text-align:center;"><?php echo $row['staff_contactno'];?></td>
												
												
												
												</tr>
										<?php
											}	
										?>
									  
									</tbody>
								  </table>
								</div>

				
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
 