<?php
 
  include "include/connection.php";


  if(empty($_SESSION['um_fullname']))
  {
    header('Location:index.php');   
    exit;
  }
  else
  { 
    $isadmin = $_SESSION['isadmin'];
    $user_role = $_SESSION['user_role'];
    $um_id = $_SESSION['um_id'];
    $um_fullname = $_SESSION['um_fullname'];
    $isstatus = $_SESSION['isstatus'];
    $um_image = $_SESSION['um_image'];
    $email_id = $_SESSION['email_id'];
    $um_mobileno = $_SESSION['um_mobileno'];
    $location_address = $_SESSION['location_address'];
    $createddate = $_SESSION['createddate'];
  }

  if($isadmin == 2)
  {
        
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="uploads/user/<?php echo $um_image; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info" style="margin-top: 4%;">
          <p><?php echo ucwords($um_fullname); ?></p>
        </div>
      </div>
                  
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-tower"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="user.php"><i class="fa fa-circle-o"></i> User Master</a></li>

            <li><a href="department_master.php"><i class="fa fa-circle-o"></i> Department Master</a></li>

            <li><a href="document_type_master.php"><i class="fa fa-circle-o"></i> Document Master</a></li>

            <li><a href="payment_type_master.php"><i class="fa fa-circle-o"></i> Payment Master</a></li>

            <li><a href="notice_master.php"><i class="fa fa-circle-o"></i> Notice Master</a></li>

            <li><a href="agency.php"><i class="fa fa-circle-o"></i> Agency Master</a></li>

            <li><a href="authority.php"><i class="fa fa-circle-o"></i> Authority Master</a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i>
            <span>Task Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="task_master.php"><i class="fa fa-circle-o"></i> Assign Master</a></li>

            <li><a href="task_master_view.php"><i class="fa fa-circle-o"></i> Assign Master View</a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Assigned Task</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pending.php"><i class="fa fa-circle-o"></i>Pending</a></li>

            <li><a href="completed.php"><i class="fa fa-circle-o"></i>Completed</a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bank"></i>
            <span>Inward Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="add_inward.php"><i class="fa fa-circle-o"></i> Add Inward</a></li>

            <li><a href="view_inward.php"><i class="fa fa-circle-o"></i> View Inward</a></li>

            <li><a href="pay_inward.php"><i class="fa fa-circle-o"></i> Pay Inward</a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="inward_report.php"><i class="fa fa-circle-o"></i>Inward Report</a></li>

            <li><a href="pay_inward_report.php"><i class="fa fa-circle-o"></i>Pay Inward Report</a></li>

            <li><a href="attendance_report.php"><i class="fa fa-circle-o"></i>Attendance Report</a></li>

            <li><a href="task_report.php"><i class="fa fa-circle-o"></i>Task Report</a></li>

          </ul>
        </li>

        <br>

        <li class="treeview">
          <form action="#" method="post">
            
              <input type="submit" name="check_in" id="check_in" class="btn btn-success" value="&nbsp;&nbsp;Check-In&nbsp;&nbsp;"/>
            </center>
        </form>
        </li>

        <br>

        <li class="treeview">
          <form action="#" method="post">
            
              <input type="submit" name="check_out" id="check_out" class="btn btn-warning" value="Check-Out"/>
            </center>
          </form>
        </li>
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


<!------------------ Check-In / Check-Out QUERY --------------------------------->
<?php 

  if (isset($_POST['check_in']))
  {
    date_default_timezone_set('Asia/Kolkata');
    $in_date = date('Y-m-d');
    $in_time = date('h:i:s'); 

    $ci_select = "SELECT * FROM mg_attendance_master WHERE um_id = '$um_id' AND att_date = '$in_date' "; 
    $ci_query = mysqli_query($conn,$ci_select);

    if (mysqli_num_rows($ci_query) > 0)
    {
        $message = "You Are Already Check-In";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>document.location.href = String( document.location.href ).replace( '#','');</script>";
    }

    else
    {
        $ci_insert = "INSERT INTO `mg_attendance_master` (`um_id`,`att_date`,`absent_present_flag`,`intime`) VALUES ('$um_id','$in_date','0','$in_time')";
        $ci_result = mysqli_query($conn,$ci_insert);
        
    }

  }

  else if (isset($_POST['check_out']))
  {
    date_default_timezone_set('Asia/Kolkata');
    $out_date = date('Y-m-d');
    $out_time = date('h:i:s'); 

    $co_select = "SELECT * FROM mg_attendance_master WHERE um_id = '$um_id' AND att_date = '$out_date'  AND absent_present_flag = '1'"; 
    $co_query = mysqli_query($conn,$co_select);

    if (mysqli_num_rows($co_query) > 0)
    {
      $message = "You Are Already Check-Out";
      echo "<script type='text/javascript'>alert('$message');</script>";
      echo "<script>document.location.href = String( document.location.href ).replace( '#','');</script>";
    }

    else
    {
      $co_insert = "UPDATE mg_attendance_master SET outtime = '$out_time', absent_present_flag = '1' WHERE att_date = '$out_date' AND um_id = '$um_id' AND absent_present_flag = '0'";
      $co_result = mysqli_query($conn,$co_insert);
    }
  }
  
?>
<!------------------------------- / ---------------------------------------------->
<?php 
  }

  else if($isadmin == 0 || $isadmin == 1)
  {
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="uploads/user/<?php echo $um_image; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info" style="margin-top: 4%;">
          <p><?php echo ucwords($um_fullname); ?></p>
        </div>
      </div>
                  
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <!-- <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-tower"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="department_master.php"><i class="fa fa-circle-o"></i> Department Master</a></li>

            <li><a href="document_type_master.php"><i class="fa fa-circle-o"></i> Document Master</a></li>

            <li><a href="payment_type_master.php"><i class="fa fa-circle-o"></i> Payment Master</a></li>

            <li><a href="notice_master.php"><i class="fa fa-circle-o"></i> Notice Master</a></li>

            <li><a href="agency.php"><i class="fa fa-circle-o"></i> Agency Master</a></li>

            <li><a href="authority.php"><i class="fa fa-circle-o"></i> Authority Master</a></li>

          </ul>
        </li> -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i>
            <span>Task Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="user_task_master.php"><i class="fa fa-circle-o"></i> Assign Master</a></li>

            <li><a href="user_task_master_view.php"><i class="fa fa-circle-o"></i> Assign Master View</a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Assigned Task</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="user_pending.php"><i class="fa fa-circle-o"></i>Pending</a></li>

            <li><a href="user_completed.php"><i class="fa fa-circle-o"></i>Completed</a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bank"></i>
            <span>Inward Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="user_add_inward.php"><i class="fa fa-circle-o"></i> Add Inward</a></li>

            <li><a href="user_view_inward.php"><i class="fa fa-circle-o"></i> View Inward</a></li>

            <li><a href="user_pay_inward.php"><i class="fa fa-circle-o"></i> Pay Inward</a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="user_inward_report.php"><i class="fa fa-circle-o"></i>Inward Report</a></li>

            <li><a href="user_pay_inward_report.php"><i class="fa fa-circle-o"></i>Pay Inward Report</a></li>

            <li><a href="user_attendance_report.php"><i class="fa fa-circle-o"></i>Attendance Report</a></li>

            <li><a href="user_task_report.php"><i class="fa fa-circle-o"></i>Task Report</a></li>

          </ul>
        </li>

        <br>

        <li class="treeview">
          <form action="#" method="post">
            
              <input type="submit" name="check_in" id="check_in" class="btn btn-success" value="&nbsp;&nbsp;Check-In&nbsp;&nbsp;"/>
            </center>
        </form>
        </li>

        <br>

        <li class="treeview">
          <form action="#" method="post">
            
              <input type="submit" name="check_out" id="check_out" class="btn btn-warning" value="Check-Out"/>
            </center>
          </form>
        </li>
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


<!------------------ Check-In / Check-Out QUERY --------------------------------->
<?php 

  if (isset($_POST['check_in']))
  {
    date_default_timezone_set('Asia/Kolkata');
    $in_date = date('Y-m-d');
    $in_time = date('H:i:s'); 

    $ci_select = "SELECT * FROM mg_attendance_master WHERE um_id = '$um_id' AND att_date = '$in_date' "; 
    $ci_query = mysqli_query($conn,$ci_select);

    if (mysqli_num_rows($ci_query) > 0)
    {
        $message = "You Are Already Check-In";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>document.location.href = String( document.location.href ).replace( '#','');</script>";
    }

    else
    {
        $ci_insert = "INSERT INTO `mg_attendance_master` (`um_id`,`att_date`,`absent_present_flag`,`intime`) VALUES ('$um_id','$in_date','0','$in_time')";
        $ci_result = mysqli_query($conn,$ci_insert);
        
    }

  }

  else if (isset($_POST['check_out']))
  {
    date_default_timezone_set('Asia/Kolkata');
    $out_date = date('Y-m-d');
    $out_time = date('H:i:s'); 

    $co_select = "SELECT * FROM mg_attendance_master WHERE um_id = '$um_id' AND att_date = '$out_date'  AND absent_present_flag = '1'"; 
    $co_query = mysqli_query($conn,$co_select);

    if (mysqli_num_rows($co_query) > 0)
    {
      $message = "You Are Already Check-Out";
      echo "<script type='text/javascript'>alert('$message');</script>";
      echo "<script>document.location.href = String( document.location.href ).replace( '#','');</script>";
    }

    else
    {
      $co_insert = "UPDATE mg_attendance_master SET outtime = '$out_time', absent_present_flag = '1' WHERE att_date = '$out_date' AND um_id = '$um_id' AND absent_present_flag = '0'";
      $co_result = mysqli_query($conn,$co_insert);
    }
  }
  
?>
<!------------------------------- / ---------------------------------------------->
<?php
  }
?>
