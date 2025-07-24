<?php
include 'connection.php';
error_reporting(1);

if (isset($_POST['txt_new_city'])) {
  echo "this=>" .  $txt_new_city = $_POST['txt_new_city'];


  $query = "INSERT INTO `city` 
         (`city_name`,`city_status`,`city_isdeleted`)
         VALUES
         ('$txt_new_city','0','0')";
  $query_run = mysqli_query($conn, $query);
  if ($query_run) {
    echo 'It is working';
  }
}

if (isset($_POST['txt_inv_month'])) {

  $query = "SELECT * FROM fyearmaster WHERE `fy_status`='1'";

  $qrys = mysqli_query($conn, $query);
  $no_of_rows = mysqli_num_rows($qrys);
  if ($no_of_rows > 0) {

    $r = mysqli_fetch_array($qrys);
    $year = $r['fy_name'];
  }

  $txt_inv_month = $_POST['txt_inv_month'];
  $sql = "select * from estimate_bill_total_master WHERE `bt_isdeleted`='0' AND `fy_id`='$year' and MONTH(inv_date)= $txt_inv_month";
  $result = mysqli_query($conn, $sql);
  $row_count = mysqli_num_rows($result);
  echo $row_count + 1;
  return true;
}



$sql = "select * from city";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
<?php
}

?>