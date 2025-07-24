<?php
session_start();
include 'connection.php';
error_reporting(1);

if (isset($_POST['txt_new_category'])) {
   $txt_new_category = $_POST['txt_new_category'];
   $txt_category_remark = $_POST['txt_category_remark'];
   $curr_date = date("Y-m-d");


   $query = "INSERT INTO `category` 
         (`catname`,`Remarks`,`status`)
         VALUES
         ('$txt_new_category','$txt_category_remark',1)";
   $query_run = mysqli_query($conn, $query);
}
$sql = "select * from category";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
?>
   <option value="<?php echo $row['id']; ?>"><?php echo $row['catname']; ?></option>
<?php
}
?>