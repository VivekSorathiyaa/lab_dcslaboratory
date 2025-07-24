<?php

session_start();
include("connection.php");


if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		 if($_POST['action_type'] == 'upload_obs')
		{
			$idss= explode("|",$_POST["idss"]);
			$lab_nos=$idss[0];
			$final_id=$idss[1];
			
			$countfiles = count($_FILES['file']['name']);
			for($index = 0;$index < $countfiles;$index++)
			{
				 $ext = pathinfo($_FILES['file']['name'][$index], PATHINFO_EXTENSION);
				$x = pathinfo($_FILES['file']['name'][$index], PATHINFO_FILENAME);
				$filename= $lab_nos.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'][$index];
				$path = 'upload_wriiten_obs/';
				move_uploaded_file($tmp_name,$path.$filename);
				
				$up_final="update final_material_assign_master set `obs_by_eng`='1',`upload_obs`='$filename' where `final_material_id`=$final_id";	
				$up_finaled=mysqli_query($conn,$up_final);	
						
						
						
					
				
			}
			$fill = array($up_finaled);
			echo json_encode($fill);

		}elseif($_POST['action_type'] == 'add')
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
				
				
					 $sel="select * from final_material_assign_master WHERE `report_no`='$reports_nos'";
					$re_final=mysqli_query($conn,$sel);
					if(mysqli_num_rows($re_final) > 0)
					{
						//if not in scan table
						$sel_scan="select * from scanned_trf_document where `report_no`='$reports_nos'";
						$re_scan=mysqli_query($conn,$sel_scan);
						if(mysqli_num_rows($re_scan) == 0)
						{
						
						$get_finals=mysqli_fetch_array($re_final);
						$set_trf_nos=$get_finals["trf_no"];
						move_uploaded_file($tmp_name,$path.$filename);
						
						 $insert_scan="insert into scanned_trf_document (`trf_no`,`report_no`,`document`,`agency_email`,`billing_to_id`,`agency_name`,`created_by`) 
							values(
							'$set_trf_nos',
							'$reports_nos',
							'$filename',
							'$agency_email',
							'$billing_to_id',
							'$agency_name_email',
							'$_SESSION[u_id]')";
							$inserting=mysqli_query($conn,$insert_scan);
						$up_final="update final_material_assign_master set `is_scan`='1' where `trf_no`='$set_trf_nos' AND `report_no`='$reports_nos'";	
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

		}else if($_POST['action_type'] == 'perfoma_upload')
		{
			$perfoma_no=$_POST["txt_boxes"];
			
			$countfiles = count($_FILES['file']['name']);
			for($index = 0;$index < $countfiles;$index++)
			{
				$ext = pathinfo($_FILES['file']['name'][$index], PATHINFO_EXTENSION);
				$x = pathinfo($_FILES['file']['name'][$index], PATHINFO_FILENAME);
				$filename= $perfoma_no.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'][$index];
				$path = 'perfoma_pdf_upload/';
				
				
					//if not in scan table
						$sel_scan="select * from upload_perfoma where `perfoma_no`='$perfoma_no'";
						$re_scan=mysqli_query($conn,$sel_scan);
						if(mysqli_num_rows($re_scan) == 0)
						{
						
						move_uploaded_file($tmp_name,$path.$filename);
						
						$insert_scan="insert into upload_perfoma (`perfoma_no`,`documents`) values('$perfoma_no','$filename')";
							$inserting=mysqli_query($conn,$insert_scan);
						$up_final="update estimate_total_span set `is_perfoma_upload`='1' where `perfoma_no`='$perfoma_no'";	
						$up_finaled=mysqli_query($conn,$up_final);	
						
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

		}else if($_POST['action_type'] == 'invoice_upload')
		{
			$invoice_no=$_POST["txt_boxes"];
			$only_in_number=substr($invoice_no,1);
			
			$countfiles = count($_FILES['file']['name']);
			for($index = 0;$index < $countfiles;$index++)
			{
				$ext = pathinfo($_FILES['file']['name'][$index], PATHINFO_EXTENSION);
				$x = pathinfo($_FILES['file']['name'][$index], PATHINFO_FILENAME);
				$filename= $invoice_no.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'][$index];
				$path = 'invoice_pdf_upload/';
				
				
					//if not in scan table
						$sel_scan="select * from upload_invoice where `invoice_no`='$invoice_no'";
						$re_scan=mysqli_query($conn,$sel_scan);
						if(mysqli_num_rows($re_scan) == 0)
						{
						
						move_uploaded_file($tmp_name,$path.$filename);
						
						$insert_scan="insert into upload_invoice (`invoice_no`,`documents`) values('$invoice_no','$filename')";
							$inserting=mysqli_query($conn,$insert_scan);
						$up_final="update estimate_total_span set `is_invoice_upload`='1' where `invoice_no`='$only_in_number'";	
						$up_finaled=mysqli_query($conn,$up_final);	
						
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

		}else if($_POST['action_type'] == 'delete_eng_obs')
		{
			$clicked_id=explode("|",$_POST["clicked_id"]);
			$lab_nos=$clicked_id[0];
			$final_id=$clicked_id[1];
			$images=$clicked_id[2];
			$paths="upload_wriiten_obs/".$images;
				@unlink($paths);
				
				$up_final="update final_material_assign_master set `obs_by_eng`='0',`upload_obs`='' where `final_material_id`=$final_id";
				$up_finaled=mysqli_query($conn,$up_final);
			
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
		}else if($_POST['action_type'] == 'delete_perfoma_scan')
		{
			$explodes=explode("|",$_POST["clicked_id"]);
			$perfoma_no=$explodes[0];
			$perfoma_id=$explodes[1];
			$sel_docs="select * from upload_perfoma where `perfoma_no`='$perfoma_no' AND `perfoma_id`=$perfoma_id";
			$rep_docs=mysqli_query($conn,$sel_docs);
			if(mysqli_num_rows($rep_docs) > 0){
				$results=mysqli_fetch_array($rep_docs);
				$filesed=$results["documents"];
				$paths="perfoma_pdf_upload/".$filesed;
				@unlink($paths);
				
				$dels="delete from upload_perfoma where `perfoma_no`='$perfoma_no' AND `perfoma_id`=$perfoma_id";
				mysqli_query($conn,$dels);
				
				$up_final="update estimate_total_span set `is_perfoma_upload`='0',`is_perfoma_mail`='0' where `perfoma_no`='$perfoma_no'";	
				$up_finaled=mysqli_query($conn,$up_final);
			}
		}else if($_POST['action_type'] == 'delete_invoice_scan')
		{
			$explodes=explode("|",$_POST["clicked_id"]);
			$invoice_no=$explodes[0];
			$invoice_id=$explodes[1];
			$only_in_number=substr($invoice_no,1);
			$sel_docs="select * from upload_invoice where `invoice_no`='$invoice_no' AND `invoice_id`=$invoice_id";
			$rep_docs=mysqli_query($conn,$sel_docs);
			if(mysqli_num_rows($rep_docs) > 0){
				$results=mysqli_fetch_array($rep_docs);
				$filesed=$results["documents"];
				$paths="invoice_pdf_upload/".$filesed;
				@unlink($paths);
				
				$dels="delete from upload_invoice where `invoice_no`='$invoice_no' AND `invoice_id`=$invoice_id";
				mysqli_query($conn,$dels);
				
				$up_final="update estimate_total_span set `is_invoice_upload`='0',`is_invoice_mail`='0' where `invoice_no`='$only_in_number'";	
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
		}else if($_POST['action_type'] == 'resend_perfoma')
		{
			$perfoma_no=$_POST["datas"];
			$up_scan="update estimate_total_span set `is_perfoma_mail`='0' WHERE `perfoma_no`='$perfoma_no'";
				mysqli_query($conn,$up_scan);
			
		}else if($_POST['action_type'] == 'resend_invoice')
		{
			$invoice_no=$_POST["datas"];
			$up_scan="update estimate_total_span set `is_invoice_mail`='0' WHERE `invoice_no`='$invoice_no'";
				mysqli_query($conn,$up_scan);
			
		}
    exit;
	
}
?>