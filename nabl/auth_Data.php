<?php
include 'connection.php';
error_reporting(1);
if (isset($_POST['txt_new_auth'])) {
  $txt_new_auth = $_POST['txt_new_auth'];


  $query = "INSERT INTO `authority` 
         (`auth_name`,`auth_status`,`auth_isdeleted`)
         VALUES
         ('$txt_new_auth','1','0')";
  $query_run = mysqli_query($conn, $query);
}
$sql = "select * from authority";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['auth_name']; ?></option>
<?php
}
?>