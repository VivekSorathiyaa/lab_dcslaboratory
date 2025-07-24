<?php
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
  
	if($_POST['action_type'] == 'delete_desk_image'){
		$clicked_id=$_POST['clicked_id'];
		
		$sel_img="select * from desktop_images WHERE `desk_img_id`=".$clicked_id;
	    $get_image=mysqli_query($conn,$sel_img);
		$getting_image=mysqli_fetch_array($get_image);
		
		$delete_path="images/desk_gallery/".$getting_image["desk_img"];
		@unlink($delete_path);
		
		$job_delete="delete from  desktop_images WHERE `desk_img_id`=".$clicked_id;
		$result_of_job_delete=mysqli_query($conn,$job_delete);
	
}

}
?>


