<?php

session_start();
include("connection.php");


if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		

		if($_POST['action_type'] == 'add')
		{
			$job_serial="SELECT * FROM document_library ORDER BY unique_id DESC";
			$job_res = mysqli_query($conn, $job_serial);

			if (mysqli_num_rows($job_res) > 0) {
				$job_r = mysqli_fetch_array($job_res);
				
				$exploding= explode("/",$job_r["unique_id"]);
				$plused= intval($exploding[2])+1;
				$sets= sprintf('%05d', $plused);
				$set_unique="RMLS/LIBS/".$sets;
				$for_upload="RMLS_LIBS_".$sets;
			}else{
				$set_unique="RMLS/LIBS/00001";
				$for_upload="RMLS_LIBS_00001";
			}
			
			
			
			if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				
				$filename= $for_upload.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'library_documents/';
				move_uploaded_file($tmp_name,$path.$filename);
			}else{
				$filename="";
				
			}
			
			$doc_type=$_POST['doc_type'];
			$doc_name=$_POST['doc_name'];
			$name_of_work=$_POST['name_of_work'];
			
			$insert_library="INSERT INTO `document_library`(`unique_id`, `doc_type`,`doc_name`, `doc_narration`,`master_upload`,`created_by`) values(
						'$set_unique',
						'$doc_type',
						'$doc_name',
						'$name_of_work',
						'$filename',
						'$_SESSION[name]')";
					$result_of_insert_only_job=mysqli_query($conn,$insert_library);	
					$fill = array("statuses" => "1");
					echo json_encode($fill);
		}
		
		else if($_POST['action_type'] == 'edit')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				
				$replacing=str_replace("/","_",$_POST['doc_id']);
				$filename= $replacing.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'library_documents/';
				move_uploaded_file($tmp_name,$path.$filename);
				$where=",`master_upload`='$filename'";
			}else{
				$where="";
				
			}
			
			$doc_type=$_POST['doc_type'];
			$doc_name=$_POST['doc_name'];
			$name_of_work=$_POST['name_of_work'];
			$doc_id=$_POST['doc_id'];
			
			$job_update="update document_library SET `doc_type`='$doc_type',`doc_name`='$doc_name',`doc_narration`='$name_of_work' ".$where." WHERE `unique_id`='$doc_id'";
					$result_of_insert_only_job=mysqli_query($conn,$job_update);	
					$fill = array("statuses" => "1");
					echo json_encode($fill);
		}else if($_POST['action_type'] == 'delete_data')
		{
			$ids=$_POST['ids'];
			$job_serial="SELECT * FROM document_library where `library_id`=".$ids;
			$job_res = mysqli_query($conn, $job_serial);
			$rows = mysqli_fetch_array($job_res);
			if($rows["master_upload"]!="")
			{
				$set_path="library_documents/".$rows["master_upload"];
				@unlink($set_path);
			}
			
			$job_extra="SELECT * FROM extra_library where `unique_id`='$rows[unique_id]'";
			$res_extra = mysqli_query($conn, $job_extra);
			
			if(mysqli_num_rows($res_extra) > 0)
			{
				while($rows_extra = mysqli_fetch_array($res_extra))
				{
					if($rows_extra["upload_1"]!="")
					{
						$set_path="library_documents_extra/".$rows_extra["upload_1"];
						@unlink($set_path);
					}
					if($rows_extra["upload_2"]!="")
					{
						$set_path="library_documents_extra/".$rows_extra["upload_2"];
						@unlink($set_path);
					}
					if($rows_extra["upload_3"]!="")
					{
						$set_path="library_documents_extra/".$rows_extra["upload_3"];
						@unlink($set_path);
					}
					if($rows_extra["upload_4"]!="")
					{
						$set_path="library_documents_extra/".$rows_extra["upload_4"];
						@unlink($set_path);
					}
					if($rows_extra["upload_5"]!="")
					{
						$set_path="library_documents_extra/".$rows_extra["upload_5"];
						@unlink($set_path);
					}
					
					$extra_delete="DELETE FROM extra_library where `extra_id`=".$rows_extra["extra_id"];
					$result_of_insert_only_job=mysqli_query($conn,$extra_delete);	
				}
			}
			
			$job_update="DELETE FROM document_library where `library_id`=".$ids;
			$result_of_insert_only_job=mysqli_query($conn,$job_update);	
			$fill = array("statuses" => "1");
			echo json_encode($fill);
		}else if($_POST['action_type'] == 'delete_data_extra')
		{
			$extra_id=$_POST['ids'];
			$job_serial="SELECT * FROM extra_library where `extra_id`=".$extra_id;
			$job_res = mysqli_query($conn, $job_serial);
			$rows = mysqli_fetch_array($job_res);
			
			if($rows["upload_1"]!="")
			{
				$set_path="library_documents_extra/".$rows["upload_1"];
				@unlink($set_path);
			}
			
			if($rows["upload_2"]!="")
			{
				$set_path="library_documents_extra/".$rows["upload_2"];
				@unlink($set_path);
			}
			
			if($rows["upload_3"]!="")
			{
				$set_path="library_documents_extra/".$rows["upload_3"];
				@unlink($set_path);
			}
			
			if($rows["upload_4"]!="")
			{
				$set_path="library_documents_extra/".$rows["upload_4"];
				@unlink($set_path);
			}
			
			if($rows["upload_5"]!="")
			{
				$set_path="library_documents_extra/".$rows["upload_5"];
				@unlink($set_path);
			}
			
			$job_update="DELETE FROM extra_library where `extra_id`=".$extra_id;
			$result_of_insert_only_job=mysqli_query($conn,$job_update);	
			$fill = array("statuses" => "1");
			echo json_encode($fill);
		}else if($_POST['action_type'] == 'delete_upload')
		{
			$ids=explode("|",$_POST['ids']);
			$extra_id=$ids[0];
			$doc_name=$ids[1];
			$column_name=$ids[2];
			$set_path="library_documents_extra/".$doc_name;
			@unlink($set_path);
			
			$updates="update extra_library SET `".$column_name."`='' WHERE `extra_id`=".$extra_id;
			mysqli_query($conn,$updates);
			$fill = array("statuses" => "1");
			echo json_encode($fill);
		}else if($_POST['action_type'] == 'add_more')
		{
			$start_date= date('Y-m-d',strtotime($_POST["start_date"]));
			$end_date= date('Y-m-d',strtotime($_POST["end_date"]));
			$days=$_POST['days'];
			$unique_id=$_POST['unique_id'];
			$extra_narration=$_POST['extra_narration'];
			
			$insert_library="INSERT INTO `extra_library`(`unique_id`, `start_date`,`day`, `end_date`, `extra_narration`) values(
						'$unique_id',
						'$start_date',
						'$days',
						'$end_date',
						'$extra_narration')";
					$result_of_insert_only_job=mysqli_query($conn,$insert_library);
			
		}else if($_POST['action_type'] == 'after_update')
		{
			$unique_id=$_POST['unique_id'];
		?>
			<table id="example2" class="table table-bordered table-striped" style="width:100%;margin:0px auto;padding:0px;">
						<thead>
							<tr>
								<th style="text-align:center;width:2px;">Sr No</th>
								<th style="text-align:center;width:2px;">Action</th>
								<th style="text-align:center;">Unique Id</th>
								<th style="text-align:center;">Start Date</th>
								<th style="text-align:center;">Intimation Alert Day</th>
								<th style="text-align:center;">End Date</th>
								<th style="text-align:center;">Document 1</th>
								<th style="text-align:center;">Document 2</th>
								<th style="text-align:center;">Document 3</th>
								<th style="text-align:center;">Document 4</th>
								<th style="text-align:center;">Document 5</th>
							</tr>
						</thead>
						<tbody>
						<?php
						 $sele_materials="select * from extra_library where `unique_id`='$unique_id' ORDER BY extra_id DESC";
						$result_materials = mysqli_query($conn,$sele_materials);
						if(mysqli_num_rows($result_materials)>0)
						{
							$counting=1;
							while($row_materials =mysqli_fetch_array($result_materials))
							{
							?>
									<tr id="tr_<?php echo $row_materials["extra_id"]?>">	
										<td><?php echo $counting;?></td>
										<td style="text-align:center;">
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_data_extra" data-id="<?php echo $row_materials["extra_id"]?>"></a>
										
										
										</td>
										<td><?php echo $row_materials["unique_id"];?></td>
										<td><?php echo date("d/m/Y",strtotime($row_materials["start_date"]));?></td>
										<td><?php echo $row_materials["day"]?></td>
										<td><?php echo date("d/m/Y",strtotime($row_materials["end_date"]));?></td>
										<td style="text-align:center;">
										<?php if($row_materials["upload_1"]!=""){?>
										<a href="library_documents_extra/<?php echo $row_materials["upload_1"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_upload" data-id="<?php echo $row_materials["extra_id"]."|".$row_materials["upload_1"]."|upload_1"?>"></a>
										<?php }else{ ?>
										<input type="file" class="btn-primary form-control uplodings" id="uploads_1_<?php echo $row_materials["extra_id"];?>" style="width: 117px;font-size: 18px;" multiple >
										<?php } ?>
										</td>
										
										<td style="text-align:center;">
										<?php if($row_materials["upload_2"]!=""){?>
										<a href="library_documents_extra/<?php echo $row_materials["upload_2"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_upload" data-id="<?php echo $row_materials["extra_id"]."|".$row_materials["upload_2"]."|upload_2"?>"></a>
										<?php }else{ ?>
										<input type="file" class="btn-primary form-control uplodings" id="uploads_2_<?php echo $row_materials["extra_id"];?>" style="width: 117px;font-size: 18px;" multiple >
										<?php } ?>
										</td>
										
										<td style="text-align:center;">
										<?php if($row_materials["upload_3"]!=""){?>
										<a href="library_documents_extra/<?php echo $row_materials["upload_3"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_upload" data-id="<?php echo $row_materials["extra_id"]."|".$row_materials["upload_3"]."|upload_3"?>"></a>
										<?php }else{ ?>
										<input type="file" class="btn-primary form-control uplodings" id="uploads_3_<?php echo $row_materials["extra_id"];?>" style="width: 117px;font-size: 18px;" multiple >
										<?php } ?>
										</td>
										
										<td style="text-align:center;">
										<?php if($row_materials["upload_4"]!=""){?>
										<a href="library_documents_extra/<?php echo $row_materials["upload_4"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_upload" data-id="<?php echo $row_materials["extra_id"]."|".$row_materials["upload_4"]."|upload_4"?>"></a>
										<?php }else{ ?>
										<input type="file" class="btn-primary form-control uplodings" id="uploads_4_<?php echo $row_materials["extra_id"];?>" style="width: 117px;font-size: 18px;" multiple >
										<?php } ?>
										</td>
										
										<td style="text-align:center;">
										<?php if($row_materials["upload_5"]!=""){?>
										<a href="library_documents_extra/<?php echo $row_materials["upload_5"]?>" target="_blank" class="glyphicon glyphicon-eye-open"></a>
										<a href="javascript:void(0);" class="glyphicon glyphicon-trash delete_upload" data-id="<?php echo $row_materials["extra_id"]."|".$row_materials["upload_5"]."|upload_5"?>"></a>
										<?php }else{ ?>
										<input type="file" class="btn-primary form-control uplodings" id="uploads_5_<?php echo $row_materials["extra_id"];?>" style="width: 117px;font-size: 18px;" multiple >
										<?php } ?>
										</td>
									</tr>	
									<?php 
									$counting++;
									
								
							
							
							}
						}
						?>
					</tbody>
					</table>
			
			
		<?php } if($_POST['action_type'] == 'add_uploading')
		{
			$idss= explode("_",$_POST["idss"]);
			$upload_nos=$idss[1];
			$extra_id=$idss[2];
			$set_field="upload_".$upload_nos;
			$set_name="upload_".$upload_nos."_".$extra_id;
			
			$countfiles = count($_FILES['file']['name']);
			for($index = 0;$index < $countfiles;$index++)
			{
				$ext = pathinfo($_FILES['file']['name'][$index], PATHINFO_EXTENSION);
				$x = pathinfo($_FILES['file']['name'][$index], PATHINFO_FILENAME);
				$filename= $set_name.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'][$index];
				$path = 'library_documents_extra/';
				
				move_uploaded_file($tmp_name,$path.$filename);
						
				$update_scan="update extra_library set `".$set_field."`='$filename' where `extra_id`=".$extra_id;
				mysqli_query($conn,$update_scan);
			}
				

		}
		
		if($_POST['action_type'] == 'edit_data_extra')
		{
			$ids = $_POST["ids"];
			$start_date = date("Y-m-d",strtotime($_POST["start_date"]));
			$day = $_POST["day"];
			$end_date = date("Y-m-d",strtotime($_POST["end_date"]));
			
			$upd_data_extra = "UPDATE `extra_library` SET `start_date`='$start_date', `day`='$day', `end_date`='$end_date' WHERE `extra_id`='$ids'";
			mysqli_query($conn,$upd_data_extra);
		}
		
		
		
		
		
		
    exit;
	
}
?>