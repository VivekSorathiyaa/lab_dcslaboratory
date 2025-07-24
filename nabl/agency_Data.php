<?php
session_start();
include 'connection.php';
error_reporting(1);

if (isset($_POST['agency_name'])) {
  //$agency_names = str_replace("zxctxavb","'",$_POST['agency_name']);
  $agency_name = str_replace("qwerfdsa", "&", $_POST['agency_name']);
  $agency_mobile = $_POST['agency_mobile'];
  $agency_address = $_POST['agency_address'];
  $sel_agency_city = $_POST['sel_agency_city'];
  $agency_pincode = $_POST['agency_pincode'];
  $agency_email = $_POST['agency_email'];
  $agency_gstno = $_POST['agency_gstno'];
  $agency_status = $_POST['agency_status'];
  $add_perfoma_make_by = $_POST['add_perfoma_make_by'];
  $add_rate = $_POST['add_rate'];
  $txt_city_name = $_POST['txt_city_name'];
  $sel_state = $_POST['sel_state'];
  $curr_date = date("Y-m-d");

  if ($sel_agency_city == "" && $sel_state != "") {
    $ins_city = "INSERT INTO `city` (`state_id`,`state_name`,`city_name`,`city_status`,`city_isdeleted`)
         VALUES
         ('$sel_state','$sel_state','$txt_city_name',0,0)";
    mysqli_query($conn, $ins_city);
    $sel_agency_city = $txt_city_name;
  }


  $query = "INSERT INTO `agency_master` 
         (`agency_name`,`agency_address`,`agency_mobile`,`agency_city`,`agency_pincode`,`agency_email`,`agency_gstno`,`agency_status`,`perfoma_make_by`,`rate_by`)
         VALUES
         ('$agency_name','$agency_address','$agency_mobile','$sel_agency_city','$agency_pincode','$agency_email','$agency_gstno',$agency_status,$add_perfoma_make_by,$add_rate)";
  $query_run = mysqli_query($conn, $query);
}
?>
<option value="">Select Agency</option>
<?php
$sql = "select * from agency_master where `isdeleted`=0";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
?>
  <option value="<?php echo $row['agency_id']; ?>"><?php echo str_replace("zxctxavb", "'", $row['agency_name']); ?></option>
<?php
}
?>