<?php

session_start();
include("connection.php");


if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		

		if($_POST['action_type'] == 'add')
		{
			$job_serial="SELECT * FROM calibration_document ORDER BY auto_id DESC";
			$job_res = mysqli_query($conn, $job_serial);

			if (mysqli_num_rows($job_res) > 0) {
				$job_r = mysqli_fetch_array($job_res);
				
				$exploding= explode("/",$job_r["auto_id"]);
				$plused= intval($exploding[2])+1;
				$sets= sprintf('%05d', $plused);
				$set_unique="RMLS/CALI/".$sets;
				$for_upload="RMLS_CALI_".$sets;
			}else{
				$set_unique="RMLS/CALI/00001";
				$for_upload="RMLS_CALI_00001";
			}
			
			$unique_id=$_POST['unique_id'];
			$equipment_name=$_POST['equipment_name'];
			$model=$_POST['model'];
			$man_sr_no=$_POST['man_sr_no'];
			$make=$_POST['make'];
			$manufacture_year=$_POST['manufacture_year'];
			$ranges=$_POST['ranges'];
			$accuracy=$_POST['accuracy'];
			$least_count=$_POST['least_count'];
			$location_of_use=$_POST['location_of_use'];
			$calibration_mode=$_POST['calibration_mode'];
			$intimation_day=$_POST['intimation_day'];
			$point_calibration=$_POST['point_calibration'];
			
			$duplicates="SELECT * FROM calibration_document where `unique_id`='$unique_id'";
			$res_duplicates = mysqli_query($conn, $duplicates);
			
			if (mysqli_num_rows($res_duplicates) ==0) 
			{
				if(isset($_FILES["file"]["name"]))
				{
					$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
					
					$filename= $for_upload.".".$ext;
					$tmp_name = $_FILES['file']['tmp_name'];
					$path = 'calibration_document/';
					move_uploaded_file($tmp_name,$path.$filename);
				}else{
					$filename="";
					
				}
				
				$insert_cali="INSERT INTO `calibration_document`(`auto_id`,`unique_id`,`equipment_name`,`model`,`man_ser_no`,`make`,`manufacture_year`,`ranges`,`accuracy`,`least_count`,`location_of_use`,`point_to_be_calibration`,`calibration_mode`,`intimation_day`,`user_manual`,`created_name`) values(
						'$set_unique',
						'$unique_id',
						'$equipment_name',
						'$model',
						'$man_sr_no',
						'$make',
						'$manufacture_year',
						'$ranges',
						'$accuracy',
						'$least_count',
						'$location_of_use',
						'$point_calibration',
						'$calibration_mode',
						'$intimation_day',
						'$filename',
						'$_SESSION[name]')";
					mysqli_query($conn,$insert_cali);	
					$fill = array("statuses" => "1");
			}
			else
			{
					$fill = array("statuses" => "0");
			}
			
			echo json_encode($fill);
		}
		
		else if($_POST['action_type'] == 'edit')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				
				$replacing=str_replace("/","_",$_POST['auto_id']);
				$filename= $replacing.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'calibration_document/';
				move_uploaded_file($tmp_name,$path.$filename);
				$where=",`user_manual`='$filename'";
			}else{
				$where="";
				
			}
			
			$unique_id=$_POST['unique_id'];
			$equipment_name=$_POST['equipment_name'];
			$model=$_POST['model'];
			$man_sr_no=$_POST['man_sr_no'];
			$make=$_POST['make'];
			$manufacture_year=$_POST['manufacture_year'];
			$ranges=$_POST['ranges'];
			$accuracy=$_POST['accuracy'];
			$least_count=$_POST['least_count'];
			$location_of_use=$_POST['location_of_use'];
			$calibration_mode=$_POST['calibration_mode'];
			$intimation_day=$_POST['intimation_day'];
			$point_calibration=$_POST['point_calibration'];
			$txt_id=$_POST['txt_id'];
			
			$job_update="update calibration_document SET `unique_id`='$unique_id',`equipment_name`='$equipment_name',`model`='$model',`man_ser_no`='$man_sr_no',`make`='$make',`manufacture_year`='$manufacture_year',`ranges`='$ranges',`accuracy`='$accuracy',`least_count`='$least_count',`location_of_use`='$location_of_use',`point_to_be_calibration`='$point_calibration',`calibration_mode`='$calibration_mode',`intimation_day`='$intimation_day'".$where." WHERE `calibration_id`='$txt_id'";
					$result_of_insert_only_job=mysqli_query($conn,$job_update);	
					$fill = array("statuses" => "1");
					echo json_encode($fill);
		}else if($_POST['action_type'] == 'delete_data')
		{
			$ids=$_POST['ids'];
			$job_serial="SELECT * FROM calibration_document where `calibration_id`=".$ids;
			$job_res = mysqli_query($conn, $job_serial);
			$rows = mysqli_fetch_array($job_res);
			if($rows["user_manual"]!="")
			{
				$set_path="calibration_document/".$rows["user_manual"];
				@unlink($set_path);
			}
			
			$job_update="DELETE FROM calibration_document where `calibration_id`=".$ids;
			$result_of_insert_only_job=mysqli_query($conn,$job_update);	
			$fill = array("statuses" => "1");
			echo json_encode($fill);
		}else if($_POST['action_type'] == 'delete_data_extra')
		{
			$extra_id=$_POST['ids'];
			$job_serial="SELECT * FROM extra_calibration where `extra_id`=".$extra_id;
			$job_res = mysqli_query($conn, $job_serial);
			$rows = mysqli_fetch_array($job_res);
			
			if($rows["scan_copy"]!="")
			{
				$set_path="extra_calibration_scan/".$rows["scan_copy"];
				@unlink($set_path);
			}
			
			if($rows["traceability"]!="")
			{
				$set_path="traceability/".$rows["traceability"];
				@unlink($set_path);
			}
			
			$job_update="DELETE FROM extra_calibration where `extra_id`=".$extra_id;
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
			if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				
				$filename= $_FILES['file']['name'];
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'extra_calibration_scan/';
				move_uploaded_file($tmp_name,$path.$filename);
			}
			
			if(isset($_FILES["traceability"]["name"]))
			{
				$ext = pathinfo($_FILES['traceability']['name'], PATHINFO_EXTENSION);
				
				$traceability= $_FILES['traceability']['name'];
				$tmp_name = $_FILES['traceability']['tmp_name'];
				$path = 'traceability/';
				move_uploaded_file($tmp_name,$path.$traceability);
			}else{
				$traceability="";
			}
			
			
			$cali_date= date('Y-m-d',strtotime($_POST["cali_date"]));
			$cali_inter_year=$_POST['cali_inter_year'];
			$due_date= date('Y-m-d',strtotime($_POST["due_date"]));
			$calibrated_by=$_POST['calibrated_by'];
			$reported_uom=$_POST['reported_uom'];
			$equip_sent_date=$_POST['equip_sent_date'];
			$equip_rec_date=$_POST['equip_rec_date'];
			$certi_rec_date=$_POST['certi_rec_date'];
			$master_equip=$_POST['master_equip'];
			$master_equip_date=$_POST['master_equip_date'];
			$explodings=explode("|",$_POST['unique_id']);
			$unique_id=$explodings[0];
			$auto_id=$explodings[1];
			
			
			$insert_extra="INSERT INTO `extra_calibration`(`auto_id`, `unique_id`,`calibration_date`, `calibration_interval_year`, `due_date`, `calibrated_by`, `reported_uom`, `date_of_equipment_sent`, `date_of_equipment_record`, `date_of_certificate_record`, `master_equipment_used`, `due_date_of_master_equipment`, `scan_copy`, `traceability`, `created_by`) values(
						'$auto_id',
						'$unique_id',
						'$cali_date',
						'$cali_inter_year',
						'$due_date',
						'$calibrated_by',
						'$reported_uom',
						'$equip_sent_date',
						'$equip_rec_date',
						'$certi_rec_date',
						'$master_equip',
						'$master_equip_date',
						'$filename',
						'$traceability',
						'admin')";
			mysqli_query($conn,$insert_extra);
			
			$fill = array("statuses" => "1");
			echo json_encode($fill);
			
		}else if($_POST['action_type'] == 'edit_more_calibration')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				
				$filename= $_FILES['file']['name'];
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'extra_calibration_scan/';
				move_uploaded_file($tmp_name,$path.$filename);
				$where_scan=",`scan_copy`='$filename'";
			}else{
				$where_scan="";
			}
			
			if(isset($_FILES["traceability"]["name"]))
			{
				$ext = pathinfo($_FILES['traceability']['name'], PATHINFO_EXTENSION);
				
				$traceability= $_FILES['traceability']['name'];
				$tmp_name = $_FILES['traceability']['tmp_name'];
				$path = 'traceability/';
				move_uploaded_file($tmp_name,$path.$traceability);
				$where_trace=",`traceability`='$traceability'";
			}else{
				$where_trace="";
			}
			
			
			$cali_date= date('Y-m-d',strtotime($_POST["cali_date"]));
			$cali_inter_year=$_POST['cali_inter_year'];
			$due_date= date('Y-m-d',strtotime($_POST["due_date"]));
			$calibrated_by=$_POST['calibrated_by'];
			$reported_uom=$_POST['reported_uom'];
			$equip_sent_date=$_POST['equip_sent_date'];
			$equip_rec_date=$_POST['equip_rec_date'];
			$certi_rec_date=$_POST['certi_rec_date'];
			$master_equip=$_POST['master_equip'];
			$master_equip_date=$_POST['master_equip_date'];
			$extra_id=$_POST['extra_id'];
			
			$job_update="update extra_calibration SET `calibration_date`='$cali_date',`calibration_interval_year`='$cali_inter_year',`due_date`='$due_date',`calibrated_by`='$calibrated_by',`reported_uom`='$reported_uom',`date_of_equipment_sent`='$equip_sent_date',`date_of_equipment_record`='$equip_rec_date',`date_of_certificate_record`='$certi_rec_date',`master_equipment_used`='$master_equip',`due_date_of_master_equipment`='$master_equip_date'".$where_scan.$where_trace." WHERE `extra_id`='$extra_id'";
			
			mysqli_query($conn,$job_update);
			
			$fill = array("statuses" => "1");
			echo json_encode($fill);
			
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
    exit;
	
}
?>