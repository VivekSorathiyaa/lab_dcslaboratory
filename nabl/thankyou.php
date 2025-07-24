<?php include("connection.php");
	session_start();
	if(isset($_SESSION['isadmin']) && $_SESSION['isadmin'] !="")
	{
		if($_SESSION['nabl_type']=="nabl")
		{
			if($_SESSION['isadmin']==2){ ?>
				<script>window.location.href="nabl/job_listing_for_second_reception.php";</script>
			<?php }
			if($_SESSION['isadmin']==3){?>
				<script>window.location.href="nabl/dashbord_notice.php";</script>
			<?php }
			if($_SESSION['isadmin']==4){?>
				<script>window.location.href="nabl/job_listing_for_engineer.php";</script>
			<?php }
			if($_SESSION['isadmin']==5){ ?>
			<script>window.location.href="nabl/list_of_job_report_for_qm.php";</script>
			<?php }
			
		}
		elseif($_SESSION['nabl_type']=="non_nabl")
		{
			if($_SESSION['isadmin']==2){ ?>
				<script>window.location.href="non_nabl/job_listing_for_second_reception.php";</script>
			<?php }
			if($_SESSION['isadmin']==3){?>
				<script>window.location.href="non_nabl/dashbord_notice.php";</script>
			<?php }
			if($_SESSION['isadmin']==4){?>
				<script>window.location.href="non_nabl/job_listing_for_engineer.php";</script>
			<?php }
			if($_SESSION['isadmin']==5){ ?>
			<script>window.location.href="non_nabl/list_of_job_report_for_qm.php";</script>
			<?php }
		}
		else
		{
			if($_SESSION['isadmin']==6){ ?>
			<script>window.location.href="nabl/list_of_job_report_for_biller.php";</script>
			<?php }
			if($_SESSION['isadmin']==7){ ?>
			<script>window.location.href="nabl/office_biller_master_forms.php";</script>
			<?php }
			if($_SESSION['isadmin']==8){ ?>
			<script>window.location.href="nabl/calibration_entry_by_calibrator.php";</script>
			<?php }
			if($_SESSION['isadmin']==0){ ?>
			<script>window.location.href="nabl/master_dashboard.php";</script>
			<?php }
		}
		
	}
	
	
	$query="select * from desktop_images ORDER BY desk_img_id DESC";
	$result=mysqli_query($conn,$query);
	$set_array=array();
	while($one_images=mysqli_fetch_array($result)){
		array_push($set_array,"images/desk_gallery/".$one_images["desk_img"]);
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
<div style="color: #fff;font-size: 38px;margin-top: 60px;text-align: center;font-family: Comic Sans MS;"><b><?php  echo $comp_name;?></b></div>
<div style="color: white;font-size: 41px;margin-top: 100px;text-align: center;font-family: Comic Sans MS;"><b>Thank You For Using Mattest  Management System</b></div>

<div style="color: white;font-size: 41px;margin-top: 100px;text-align: center;font-family: Comic Sans MS;"><b>Now You Have Been Logged Out Of Mattest Management System  Successfully,<br> <img src="images/hand.gif" style="width:50px;height:50px;"><a href="../index.php" style="color:white;text-decoration:underline;">Click Here</a> For Return To Mattest Engineering Serives</b></div>
<div class="login-box" style="width: 250px;float:right;margin-right:20px;margin-top:210px;">
	
	<div class="login-logo"></div>
	<div class="login-logo"></div>
	
	
</div>
<!-- /.login-box -->
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
