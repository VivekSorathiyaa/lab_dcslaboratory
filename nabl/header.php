<?php
error_reporting(1);
session_start();
include 'connection.php';
include 'connection_of_non_nabl_in_nabl.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $comp_name; ?></title> <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Bootstrap 3.3.7 -->
    <!-- <link rel="stylesheet" href="bower_components/buttons/bootstrap.min.css">-->
    <!-- Bootstrap 3.3.7 -->
    <!--<link rel="stylesheet" href="bower_components/buttons/dataTables.bootstrap.min.css">-->
    <!-- Bootstrap 3.3.7 -->
    <!--<link rel="stylesheet" href="bower_components/buttons/buttons.bootstrap.min.css">-->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css"> <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="bower_components/custom/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" href="image" type="images/favicon.jpg" sizes="16x16">
    <link rel="stylesheet" href="../bower_components/css/style.css">
    <style>
        .icon-bar {
            width: 100%;
            background-color: #555;
            overflow: auto;
        }

        .icon-bar a {
            float: left;
            width: 9%;
            text-align: center;
            padding: 10px 0;
            transition: all 0.3s ease;
            color: white;
            font-size: 36px;
        }

        .icon-bar a:hover {
            background-color: #000;
        }

        .icon-bar .active {
            background-color: #2196F3;
        }

        #overlay_div {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
            cursor: pointer;
            padding: 15% 0% 0% 40%;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse " style="font-size:14px;">
    <div id="overlay_div">
        <img src="images/work_light/loading.gif" width="150" height="150">
    </div>
    <div class="wrapper">
        <header class="main-header">



            <!-- Header Navbar: style can be found in header.less -->
            <!--<nav class="navbar navbar-static-top" style="margin-left: 0px;">
				<!-- Sidebar toggle button-->
            <!--<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>-->



            <!--<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">

							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="uplode/<?php //echo $_SESSION['u_id'].'.jpg';
                                                        ?>" class="user-image" alt="User Image">
									<span class="hidden-xs"><? php /// echo $_SESSION['name'];
                                                            ?></span>
								</a>
								<ul class="dropdown-menu">
									<li class="user-header">
										<img src="uplode/<?php //echo $_SESSION['u_id'].'.jpg';
                                                            ?>" class="img-circle" alt="User Image">
										<p>
											<?php $user_nm = $_SESSION['name'];
                                            $query = "select * from staff WHERE `staff_fullname`='$user_nm'";
                                            $result = mysqli_query($conn, $query);
                                            $row = mysqli_fetch_array($result);
                                            //echo $row['staff_fullname']."-".$row['staff_email'];
                                            ?>
											<small><?php //echo $row['staff_contactno'];
                                                    ?></small>
										</p>
									</li>
									<li class="user-footer">
										<div class="pull-left">
											<a href="profile.php" class="btn btn-default btn-flat">Profile</a>
										</div>
										<div class="pull-right">
											<a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>-->
            <!--</nav>-->
        </header>