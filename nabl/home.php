
 <script>window.location.href="../index.php";</script>
 <?php
 exit;
 ?>
 <?php include("connection.php");


	session_start();
	if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] !="")
	{
		if($_SESSION['nabl_type']=="nabl")
		{
			if($_SESSION['isadmin']==2){ ?>
				<script>window.location.href="task_asigner.php";</script>
			<?php }
			if($_SESSION['isadmin']==3){?>
				<script>window.location.href="dashbord_notice.php";</script>
			<?php }
			if($_SESSION['isadmin']==4){?>
				<script>window.location.href="task_asigner.php";</script>
			<?php }
			if($_SESSION['isadmin']==5){ ?>
			<script>window.location.href="task_asigner.php";</script>
			<?php }
			if($_SESSION['isadmin']==6){ ?>
			<script>window.location.href="task_asigner.php";</script>
			<?php }

		}
		elseif($_SESSION['nabl_type']=="non_nabl")
		{
			if($_SESSION['isadmin']==2){ ?>
				<script>window.location.href="non_nabl/task_asigner.php";</script>
			<?php }
			if($_SESSION['isadmin']==3){?>
				<script>window.location.href="non_nabl/dashbord_notice.php";</script>
			<?php }
			if($_SESSION['isadmin']==4){?>
				<script>window.location.href="non_nabl/task_asigner.php";</script>
			<?php }
			if($_SESSION['isadmin']==5){ ?>
			<script>window.location.href="non_nabl/task_asigner.php";</script>
			<?php }
			if($_SESSION['isadmin']==6){ ?>
			<script>window.location.href="non_nabl/task_asigner.php";</script>
			<?php }
		}
		else
		{
			if($_SESSION['isadmin']==6){ ?>
			<script>window.location.href="list_of_job_report_for_biller.php";</script>
			<?php }
			if($_SESSION['isadmin']==7){ ?>
			<script>window.location.href="office_biller_master_forms.php";</script>
			<?php }
			if($_SESSION['isadmin']==8){ ?>
			<script>window.location.href="calibration_entry_by_calibrator.php";</script>
			<?php }
			if($_SESSION['isadmin']==0){ ?>
			<script>window.location.href="master_forms.php";</script>
			<?php }
		}

	}
?>
<?php


	$query="select * from desktop_images ORDER BY desk_img_id DESC";
	$result=mysqli_query($conn,$query);
	$set_array=array();
	while($one_images=mysqli_fetch_array($result)){
		array_push($set_array,"images/desk_gallery/".$one_images["desk_img"]);
	}



	if(isset($_POST['btnsubmit']))
	{
				$name=$_POST['staff_email'];
				$password=$_POST['staff_pass'];
				// for login of nabl part
				$select_staff_multi="select * from multi_login where staff_email='$name' and staff_first_pass='$password'";
				$query_first=mysqli_query($conn,$select_staff_multi);
				$row_first=mysqli_fetch_array($query_first);

				if($name==$row_first['staff_email']  && $password==$row_first['staff_first_pass'])
				{

					$_SESSION['id']=$row_first['id'];
					$_SESSION['u_id']=$row_first['id'];
					$_SESSION['name']=$row_first['staff_fullname'];
					$_SESSION['isadmin']=$row_first['staff_isadmin'];
					$_SESSION['nabl_type']=$row_first['nabl'];

				}

				//for non-nabl part
				$select_staff_second="select * from multi_login where staff_email='$name' and staff_second_pass='$password'";
				$query_second=mysqli_query($conn,$select_staff_second);
				$row_second=mysqli_fetch_array($query_second);

				if($name==$row_second['staff_email']  && $password==$row_second['staff_second_pass'])
				{
					$_SESSION['id']=$row_second['id'];
					$_SESSION['u_id']=$row_second['id'];
					$_SESSION['name']=$row_second['staff_fullname'];
					$_SESSION['isadmin']=$row_second['staff_isadmin'];
					$_SESSION['nabl_type']=$row_second['non_nabl'];

				}

				//for admin and biller login
				$select_staff="select * from staff where staff_email='$name' and staff_pass='$password'";
				$query=mysqli_query($conn,$select_staff);
				$row=mysqli_fetch_array($query);

				if($name==$row['staff_email']  && $password==$row['staff_pass'])
				{

					$_SESSION['id']=$row['id'];
					$_SESSION['u_id']=$row['id'];
					$_SESSION['name']=$row['staff_fullname'];
					$_SESSION['isadmin']=$row['staff_isadmin'];
					$_SESSION['nabl_type']="blank";

				}


				//last condition to redirection to the pages
				if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] !="")
				{

					if($_SESSION['nabl_type']=="nabl")
					{
						if($_SESSION['isadmin']=="2"){ ?>
							<script>window.location.href="nabl/task_asigner.php";</script>
						<?php }
						if($_SESSION['isadmin']=="3"){?>
							<script>window.location.href="nabl/dashbord_notice.php";</script>
						<?php }
						if($_SESSION['isadmin']=="4"){?>
							<script>window.location.href="nabl/task_asigner.php";</script>
						<?php }
						if($_SESSION['isadmin']=="5"){ ?>
						<script>window.location.href="nabl/task_asigner.php";</script>
						<?php }
						if($_SESSION['isadmin']=="6"){ ?>
						<script>window.location.href="nabl/task_asigner.php";</script>
						<?php }


					}
					elseif($_SESSION['nabl_type']=="non_nabl")
					{
						if($_SESSION['isadmin']=="2"){ ?>
							<script>window.location.href="non_nabl/task_asigner.php";</script>
						<?php }
						if($_SESSION['isadmin']=="3"){?>
							<script>window.location.href="non_nabl/dashbord_notice.php";</script>
						<?php }
						if($_SESSION['isadmin']=="4"){?>
							<script>window.location.href="non_nabl/task_asigner.php";</script>
						<?php }
						if($_SESSION['isadmin']=="5"){ ?>
						<script>window.location.href="non_nabl/task_asigner.php";</script>
						<?php }
						if($_SESSION['isadmin']=="6"){ ?>
						<script>window.location.href="non_nabl/task_asigner.php";</script>
						<?php }
					}
					else
					{
						if($_SESSION['isadmin']=="6"){ ?>
						<script>window.location.href="nabl/list_of_job_report_for_biller.php";</script>
						<?php }
						if($_SESSION['isadmin']=="7"){ ?>
						<script>window.location.href="nabl/office_biller_master_forms.php";</script>
						<?php }
						if($_SESSION['isadmin']=="8"){ ?>
						<script>window.location.href="nabl/calibration_entry_by_calibrator.php";</script>
						<?php }
						if($_SESSION['isadmin']=="0"){ ?>
						<script>window.location.href="nabl/master_forms.php";</script>
						<?php }
					}

				}
				else
				{
					?>
					<script>window.location.href="index.php"; alert("INVALID EMAIL ID OR PASSWORD.. \n PLEASE INSERT VALID DATA..");</script>
					<?php
				}

	}




?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Log in | <?php  echo $comp_name;?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link rel="stylesheet" href="dist/css/blue.css">
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>

#overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5);
    z-index: 0;
    cursor: pointer;
}
	</style>
</head>
<body class="hold-transition" style="background:url(images/b1.jpg);background-repeat:no-repeat;background-size:100% 120%;overflow:hidden;">
<div id="overlay">
<div style="color: #fff;font-size: 38px;margin-top: 5%;text-align: center;font-family: Comic Sans MS;"><b><?php  echo $comp_name;?></b></div>
<!--<div style="color: white;font-size: 41px;margin-top: 10%;text-align: center;font-family: Comic Sans MS;"><b>MATTEST ENGINEERING SERVICES</b></div>-->
<div class="login-box" style="width: 250px;float:right;margin-right:20px;margin-top:7%;">

	<div class="login-logo"></div>
	<div class="login-logo"></div>

	<div class="login-box-body" style="border-radius:20px;background: transparent;">
		<label id="username-error" class="text-danger login-box-msg" style="padding-left:80px;" for="invalid"></label>
		<form  method="post">
			<div class="form-group has-feedback">
			<span class="glyphicon glyphicon-user form-control-feedback"></span>
				<input type="email" autofocus class="form-control" placeholder="Email"  name="staff_email" id="staff_email" style="border-radius:20px;background: transparent;color:white;">

			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" name="staff_pass" id="staff_pass" style="border-radius:20px;background: transparent;color:white;">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>

			</div>

			<div class="row">
				<div class="col-xs-6">
				<button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary btn-block btn-flat" style="margin-left:60px;border-radius:20px;background: transparent;color:white;">Sign In</button>

				</div>

			</div>
		</form>

		<div class="social-auth-links text-center">
		</div>

	</div>
</div>
<!-- /.login-box -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
		<form method="post">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Forgot Password</h4>
			</div>
			<div class="modal-body">
			  <div class="row">
				<div class="col-md-4">
					<label class="col-sm-12">Enter Email</label>
				</div>
				<div class="col-md-8">
					<input type="email" class="form-control col-sm-12" placeholder="Email"  name="forgot_email" id="forgot_email" >
				</div>
			  </div>

				<div class="row">
					<!-- /.col -->
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<button type="button" name="reset_password" id="reset_password" class="btn btn-primary btn-block btn-flat">Reset Password</button>
					</div>
					<div class="col-md-4"></div>
					<!-- /.col -->
				</div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			</form>
		  </div>

    </div>
    </div>
<!-- jQuery 2.2.3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="dist/js/icheck.min.js"></script>
<script>

		$(document).ready(function(){
			$("#reset_password").click(function(){
			$(".error").hide();
			var hasError = false;
			var newpass = $("#new_password").val();
			var checkVal = $("#confirm_password").val();
			var email = $("#forgot_email").val();
			if (newpass == '') {
				$("#new_password").after('<span class="error">Please enter a password.</span>');
				hasError = true;
			} else if (checkVal == '') {
				$("#confirm_password").after('<span class="error">Please re-enter your password.</span>');
				hasError = true;
			} else if (newpass != checkVal ) {
				$("#confirm_password").after('<span class="error">Passwords do not match.</span>');
				hasError = true;
			}

			if(hasError == true) {return false;}

			if(hasError == false) {
					$.ajax({
					type: "POST",
					url: "forgot_password.php",
					data: '&email='+email+'&newpass='+newpass,
					success: function(){

					}
					});
			};
		});

});


var images = <?php echo '["' . implode('", "', $set_array) . '"]' ?>;

//var images=['images/b1.jpg','images/b2.jpg','images/b3.jpg','images/b4.jpg','images/b5.jpg','images/b6.jpg','images/b7.jpg','images/b8.jpg','images/b9.jpg','images/b10.jpg','images/b11.jpg','images/b12.jpg','images/b13.jpg','images/b14.jpg','images/b15.jpg','images/b16.jpg','images/b17.jpg','images/b18.jpg','images/b19.jpg'];

setInterval(function(){
  var url=images[Math.floor(Math.random() * images.length)];
  document.body.style.backgroundImage = 'url('+url+')';
  document.body.style.backgroundRepeat = "no-repeat";
  document.body.style.backgroundSize = "100% 120%";
},5000);
</script>
</body>
</html>
