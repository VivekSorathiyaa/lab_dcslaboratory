<?php 
include("header.php");


if(isset($_POST['update'])){
	
	$dob_day=substr($_POST['dob'],0,2);
	$dob_month=substr($_POST['dob'],3,2);
	$dob_year=substr($_POST['dob'],6,4);
	$new_dob_date = $dob_year."-".$dob_month."-".$dob_day;
	$curr_date=date("Y-m-d");
	
	if($_SESSION['nabl_type']=="blank")
	{
		$update="update staff SET `staff_fullname`='$_POST[fullname]',`staff_dob`='$new_dob_date',`staff_email`='$_POST[email]',`staff_gender`='$_POST[gender]',`staff_address`='$_POST[address]',`staff_contactno`='$_POST[contact]',`staff_modifiedby`='$_SESSION[name]',`staff_modifieddate`='$curr_date' WHERE `id`=$_SESSION[u_id]";
	}
	else
	{
		$update="update multi_login SET `staff_fullname`='$_POST[fullname]',`staff_dob`='$new_dob_date',`staff_email`='$_POST[email]',`staff_gender`='$_POST[gender]',`staff_address`='$_POST[address]',`staff_contactno`='$_POST[contact]',`staff_modifiedby`='$_SESSION[name]',`staff_modifieddate`='$curr_date' WHERE `id`=$_SESSION[u_id]";
	}
	
	
	if(isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == 0){
	$target_dir = "uplode/";
	$target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
	
	$pro_image_name= $target_dir.$_SESSION['u_id'].".jpg";
	
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
	}
	
	if ($uploadOk == 0) {
   // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $pro_image_name)) {
       // echo "The file ". basename( $_FILES["profile_image"]["name"]). " has been uploaded.";
    } else {
       // echo "Sorry, there was an error uploading your file.";
    }
}
}
					
	$result_of_update=mysqli_query($conn,$update);	
	if ($result_of_update) {

		?>
		<script>
		
		alert("update Sucessfully");

		</script>
		
	<?php
	}
	
}
?> 
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
		View Profile
		</h1>
	</div>
		<div class="row">
			<div class="col-md-3">

			  <!-- Profile Image -->
				<div class="box box-primary">
					<div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle" src="uplode/<?php echo $_SESSION['u_id'].'.jpg';?>" alt="User profile picture">
							
							<?php $user_id=$_SESSION['u_id'];
							if($_SESSION['nabl_type']=="blank")
							{
								$query="select * from staff WHERE `id`=$user_id";
							}else
							{
      							$query="select * from multi_login WHERE `id`=$user_id";
								
							}
							$result=mysqli_query($conn,$query);
							$row=mysqli_fetch_array($result);
							
							?>
						<h3 class="profile-username text-center"><?php  echo $row['staff_fullname'];?></h3>
						<p class="text-muted text-center"><?php  echo $row['staff_email'];?></p>
					</div>
					<!-- /.box-body -->
				</div>
          <!-- /.box -->

          <!-- About Me Box -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">About Me</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					<strong><i class="fa fa-user margin-r-5"></i> Gender</strong>

					<p class="text-muted">
						<?php  echo $row['staff_gender'];?>
					</p>
					<hr>
					<strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
					<p class="text-muted"><?php echo $row['staff_address'];?></p>
						<hr>
					<strong><i class="fa fa-map-marker margin-r-5"></i> Contact Number</strong>
					<p class="text-muted"><?php echo $row['staff_contactno'];?></p>
					<hr>
				</div>
            <!-- /.box-body -->
			</div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
					<!--<li><a href="#change_password" data-toggle="tab">change password</a></li>-->
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="settings">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label  class="col-sm-2 control-label">Fullname</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $row['staff_fullname'];?>" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Date of Birth</label>
								<div class="col-sm-10">
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" class="form-control pull-right" tabindex="5" id="dob" name="dob" value="<?php echo date('d/m/Y', strtotime($row['staff_dob']));?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Email</label>
									<div class="col-sm-10">
										<input type="email" class="form-control" id="email" name="email" value="<?php echo $row['staff_email'];?>">
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Gender</label>
								<div class="col-sm-10">
									<input type="radio" name="gender" id="gen_male" value="Male" <?php if ($row['staff_gender'] == 'Male') {echo ' checked ';} ?> />Male&nbsp;
									<input type="radio" name="gender" id="gen_female" value="Female" <?php if ($row['staff_gender'] == 'Female') {echo ' checked ';} ?> />Female
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Address</label>
								<div class="col-sm-10">
									<textarea class="form-control" id="address" name="address"><?php echo $row['staff_address'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Contact No.</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="contact" name="contact" value="<?php echo $row['staff_contactno'];?>">
								</div>
							</div> 
							<div class="form-group">
								<label class="col-sm-2 control-label">Profile Image</label>
								<div class="col-sm-10">
									<input type="file" name="profile_image">
								</div>
							</div>							
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="update" name="update">Update Information</button>
								</div>
							</div>
						</form>
					</div>
			  
					<!-- /.tab-pane -->

					<div class="tab-pane" id="change_password">
						<form class="form-horizontal" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">Old Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="old_pass" name="old_pass" placeholder="Enter Old Password">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">New Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Enter New Password">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Confirm Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="con_pass" name="con_pass" placeholder="Enter Confirm Password">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-primary" id="change_pass" name="change_pass">Change Password</button>
								</div>
							</div>
						</form>
					</div>
				<!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("footer.php");?>		  
<script>
	$('#dob').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy'
    })
</script>