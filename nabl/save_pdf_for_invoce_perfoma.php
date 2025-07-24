<?php

session_start();
include("connection.php");


if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		 if($_POST['action_type'] == 'add')
		{
			$txt_explodes= explode("|",$_POST["txt_boxes"]);
			$reports_nos=$txt_explodes[0];
			$trf_nos=$txt_explodes[1];
			$agency_email=$txt_explodes[2];
			$billing_to_id=$txt_explodes[3];
			$agency_name_email=$txt_explodes[4];
			
			/* if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				
				$filename= "TRF_".$trf_nos."_".$reports_nos.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'scanned_document/';
				move_uploaded_file($tmp_name,$path.$filename);
			}else{
				$filename="";
				
			} */
			$countfiles = count($_FILES['file']['name']);
			for($index = 0;$index < $countfiles;$index++)
			{
				$ext = pathinfo($_FILES['file']['name'][$index], PATHINFO_EXTENSION);
				$x = pathinfo($_FILES['file']['name'][$index], PATHINFO_FILENAME);
				$filename= $x.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'][$index];
				$path = 'scanned_document/';
				
				
					$sel="select * from final_material_assign_master WHERE `report_no`='$x'";
					$re_final=mysqli_query($conn,$sel);
					if(mysqli_num_rows($re_final) > 0)
					{
						//if not in scan table
						$sel_scan="select * from scanned_trf_document where `report_no`='$x'";
						$re_scan=mysqli_query($conn,$sel_scan);
						if(mysqli_num_rows($re_scan) == 0)
						{
						
						$get_finals=mysqli_fetch_array($re_final);
						$set_trf_nos=$get_finals["trf_no"];
						move_uploaded_file($tmp_name,$path.$filename);
						
						$insert_scan="insert into scanned_trf_document (`trf_no`,`report_no`,`document`,`agency_email`,`billing_to_id`,`agency_name`,`created_by`) 
							values(
							'$set_trf_nos',
							'$x',
							'$filename',
							'$agency_email',
							'$billing_to_id',
							'$agency_name_email',
							'$_SESSION[u_id]')";
							$inserting=mysqli_query($conn,$insert_scan);
						$up_final="update final_material_assign_master set `is_scan`='1' where `trf_no`='$set_trf_nos' AND `report_no`='$x'";	
						$up_finaled=mysqli_query($conn,$up_final);	
						
						}
						
					}
				
			}
				$sel_finals="select * from final_material_assign_master where `is_scan`='0' AND `trf_no`='$trf_nos'";
				$query_final=mysqli_query($conn,$sel_finals);
				if(mysqli_num_rows($query_final)==0)
				{
						$up_job="update job set `is_scan`='1' where `trf_no`='$trf_nos'";
						mysqli_query($conn,$up_job);
				}
				
					$fill = array($up_finaled);
					echo json_encode($fill);

		}else if($_POST['action_type'] == 'delete_scaned')
		{
			$explodes=explode("|",$_POST["clicked_id"]);
			$report_no=$explodes[0];
			$trf_no=$explodes[1];
			$sel_docs="select * from scanned_trf_document where `trf_no`='$trf_no' AND `report_no`='$report_no'";
			$rep_docs=mysqli_query($conn,$sel_docs);
			if(mysqli_num_rows($rep_docs) > 0){
				$results=mysqli_fetch_array($rep_docs);
				$filesed=$results["document"];
				$paths="scanned_document/".$filesed;
				@unlink($paths);
				
				$dels="delete from scanned_trf_document where `trf_no`='$trf_no' AND `report_no`='$report_no'";
				mysqli_query($conn,$dels);
				
				$up_final="update final_material_assign_master set `is_scan`='0' where `trf_no`='$trf_no' AND `report_no`='$report_no'";	
				$up_finaled=mysqli_query($conn,$up_final);
			}
		}else if($_POST['action_type'] == 'update_emails')
		{
			$datas=$_POST["datas"];
			$txt_val=$_POST["txt_val"];
			$updates="update agency_master set `agency_email`='$txt_val' WHERE `agency_id`=".$datas;
			mysqli_query($conn,$updates);
			
		}else if($_POST['action_type'] == 'marking')
		{
			$explodes=explode(",",$_POST["chk_array"]);
			foreach($explodes as $keyed => $one_chk)
			{
				$up_scan="update scanned_trf_document set `mail_status`='1' WHERE `scan_id`=".$one_chk;
				mysqli_query($conn,$up_scan);
			}
		}
    exit;
	
}
?>