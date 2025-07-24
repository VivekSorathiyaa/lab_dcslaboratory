<?php   

    session_start();  
    include("include/connection.php");  

  if(isset($_POST['submit']))
      {   
        $email=$_POST['email'];    
        $password=$_POST['password'];

        $select="select * from mg_user_master where email_id='$email' and password='$password' and istatus='0'  and isdeleted='0'";    
        $query=mysqli_query($conn,$select);   
        $row=mysqli_fetch_array($query);  

        if($email==$row['email_id']  && $password==$row['password'])    
        { 

          if($row['isadmin'] == 0)
          {
            $_SESSION['user_role']="User";
            
          }
          else if($row['isadmin'] == 1)
          {
            $_SESSION['user_role']="Admin";
          }
          else if($row['isadmin'] == 2)
          {
            $_SESSION['user_role']="Super Admin";
          }


        $_SESSION['isadmin']=$row['isadmin']; 
        $_SESSION['um_id']=$row['um_id'];     
        $_SESSION['um_fullname']=$row['um_fullname'];             
        $_SESSION['istatus']=$row['istatus'];                 
        $_SESSION['um_image']=$row['um_image'];
        $_SESSION['email_id']=$row['email_id'];                 
        $_SESSION['um_mobileno']=$row['um_mobileno'];             
        $_SESSION['location_address']=$row['location_address'];
        $_SESSION['createddate']=$row['createddate'];
    
?>      
        <script>window.location.href="user.php";</script>      
<?php   
        }   
        else
        {
?>      
          <script>window.location.href="login.php";</script>      
<?php   
        }           
    }
               
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MEGHRAJ LAB | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url('images/login.jpg'); background-repeat: no-repeat; background-size: cover;background-attachment: fixed;">
<div >  
  <div class="login-box" >

    <div class="login-logo">
      <b>MEGHRAJ</b> Lab</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">LOGIN</p>

      <form action ="" method="post">
        <div class="form-group has-feedback">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <!-- <div class="form-group has-feedback">
            <select id="finance" class="form-control">
              <option value="0">2019-20</option>
              <option value="1">2020-21</option>
            </select>                  
        </div> -->
        
        <div class="row">
          
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <!-- <a href="#">I forgot my password</a><br> -->
      

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
</div>
<!-- jQuery 3 -->
<script src="plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
