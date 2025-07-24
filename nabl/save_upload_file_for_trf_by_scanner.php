<?php
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'upload_excel')
	{
		$txt_trf_no= $_POST["txt_trf_no"];
		$txt_ref_no= $_POST["txt_ref_no"];
		
		$replace_date= str_replace("/","-",$_POST['txt_ref_date']);
		$txt_ref_date= date('Y-m-d', strtotime($replace_date));
		
		$replace_sam_date= str_replace("/","-",$_POST['txt_sample_date']);
		$txt_sample_date= date('Y-m-d', strtotime($replace_sam_date));
		
		//create folder if not available 
		if (!file_exists('scanned_document/TRF_NO_'.$txt_trf_no)) {
		mkdir('scanned_document/TRF_NO_'.$txt_trf_no, 0777, true);
		}
		
		if(isset($_FILES["file"]["name"]))
			{
				$set_document_no="TRF_".$txt_trf_no."_".rand(99,9999);
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$filename= $set_document_no.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'scanned_document/TRF_NO_'.$txt_trf_no."/";
				move_uploaded_file($tmp_name,$path.$filename);
			}else{
				$filename="";
				
			}
			
		
			
		$insert_estimate="insert into scanned_trf_document (`trf_no`,`ref_no`,`ref_date`,`rec_sam_date`,`document`,`created_by`) 
						values(
						'$txt_trf_no',
						'$txt_ref_no',
						'$txt_ref_date',
						'$txt_sample_date',
						'$filename',
						'$_SESSION[u_id]')";
						$result_insert_estimate=mysqli_query($conn,$insert_estimate);
						$fill = array($result_insert_estimate);
					    echo json_encode($fill);
		
		
	}else if($_POST['action_type'] == 'delete_uploaded_documents')
	{
		
		$clicked_id= explode("|",$_POST["clicked_id"]);
		$doc_id=$clicked_id[0];
		$doc_file=$clicked_id[1];
		$txt_trf_no=$_POST["txt_trf_no"];
		
		$pathing='scanned_document/TRF_NO_'.$txt_trf_no."/";
		$set_paths= $pathing.$doc_file;
		
		@unlink($set_paths);
		$del_perf="delete from scanned_trf_document where `document_id`=".$doc_id;
		$delt_perfoma=mysqli_query($conn,$del_perf);
		$fill = array($delt_perfoma);
		echo json_encode($fill);
		
		
	}
	else if($_POST['action_type'] == 'complete_job_by_scanner')
	{
		$txt_trf_no=$_POST["clicked_id"];
		
		$updates="update job set  `job_completed_by_scanner`='1' where `trf_no`='$txt_trf_no'";
		$delt_perfoma=mysqli_query($conn,$updates);
	}
	else if($_POST['action_type'] == 'reward_to_scanner')
	{
		$txt_trf_no=$_POST["clicked_id"];
		
		$updates="update job set  `job_completed_by_scanner`='0' where `trf_no`='$txt_trf_no'";
		$delt_perfoma=mysqli_query($conn,$updates);
	}
}

?>
