<?php
include 'connection.php';
  
if(isset($_POST['txt_new_ref'])){
   $txt_new_ref = $_POST['txt_new_ref'];


$query = "INSERT INTO `reference` 
         (`ref_name`,`ref_status`,`ref_isdeleted`)
         VALUES
         ('$txt_new_ref','1','1')";
         $query_run= mysqli_query($conn,$query);
         
}
$sql = "select * from reference";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
   ?>
  <option value="<?php echo $row['id'];?>"><?php echo $row['ref_name'];?></option>
  <?php
}
?>
